<?php

namespace Modules\Taxido\Http\Traits;

use Carbon\Carbon;
use Modules\Taxido\Broadcasts\PeakZoneBroadcast;
use Sk\Geohash\Geohash;
use Modules\Taxido\Models\Zone;
use Modules\Taxido\Models\Ride;
use Modules\Taxido\Models\RideRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Taxido\Services\PeakZoneStateService;
use Modules\Taxido\Models\PeakZone;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Objects\LineString;

trait PeakZoneTrait
{
    protected function generatePolygonCoordinates(float $centerLat, float $centerLng, float $radiusKm, int $numPoints = 8): array
    {
        $coordinates = [];
        $earthRadius = 6371; // km

        for ($i = 0; $i < $numPoints; $i++) {
            $bearing = deg2rad(360 / $numPoints * $i);
            $latRad = deg2rad($centerLat);
            $lngRad = deg2rad($centerLng);
            $distRatio = $radiusKm / $earthRadius;

            $newLatRad = asin(sin($latRad) * cos($distRatio) + cos($latRad) * sin($distRatio) * cos($bearing));
            $newLngRad = $lngRad + atan2(
                sin($bearing) * sin($distRatio) * cos($latRad),
                cos($distRatio) - sin($latRad) * sin($newLatRad)
            );

            $coordinates[] = [
                'lat' => rad2deg($newLatRad),
                'lng' => rad2deg($newLngRad),
            ];
        }

        $coordinates[] = $coordinates[0];
        return $coordinates;
    }

    protected function hasOverlappingPeakZone(int $zoneId, Polygon $newPolygon): bool
    {
        $wkt = $newPolygon->toWKT();

        return PeakZone::where('zone_id', $zoneId)
            ->where('is_active', true)
            ->whereNotNull('polygon')
            ->whereRaw('ST_Intersects(polygon, ST_GeomFromText(?, 4326))', [$wkt])
            ->exists();
    }


    protected function deactivateOverlappingPeakZones(int $zoneId, Polygon $newPolygon): void
    {
        $overlappingPeakZones = PeakZone::where('zone_id', $zoneId)
            ->where('is_active', true)
            ->whereNotNull('polygon')
            ->whereRaw('ST_Intersects(polygon, ST_GeomFromText(?, 4326))', [$newPolygon->toWKT()])
            ->get();

        foreach ($overlappingPeakZones as $peakZone) {
            $now = Carbon::now();
            $peakZone->update([
                'is_active' => false,
                'ends_at' => $now,
                'updated_at' => $now,
            ]);

            app(PeakZoneStateService::class)->setInactive($peakZone->id, $zoneId);
            Log::info("Deactivated overlapping peak zone", ['peak_zone_id' => $peakZone->id]);
        }
    }

    protected function validateAndGeneratePeakZone(float $pickLat, float $pickLng, int $zoneId, string $timezone): ?PeakZone
    {
        $zone = Zone::find($zoneId);
        if (!$zone || !$zone->minutes_choosing_peak_zone || !$zone->peak_price_increase_percentage) {
            return null;
        }

        if (
            $zone->minutes_choosing_peak_zone <= 0 ||
            $zone->peak_price_increase_percentage <= 0 ||
            $zone->peak_zone_geographic_radius <= 0 ||
            $zone->total_rides_in_peak_zone <= 0
        ) {
            Log::warning('Invalid peak zone parameters', ['zone_id' => $zoneId]);
            return null;
        }

        $searchRadius = $zone->peak_zone_geographic_radius;
        $expiryDuration = $zone->minutes_peak_zone_active;
        $minimumNoRides = $zone->total_rides_in_peak_zone;
        $distancePricePercentage = $zone->peak_price_increase_percentage;

        // Use UTC for database comparison (stored as UTC)
        $subTime = Carbon::now()->subMinutes($zone->minutes_choosing_peak_zone);

        // Escape the $ so PHP does not interpolate $[0] as a variable.
        // MySQL must receive the literal path: $[0].lat / $[0].lng
        $jsonLat = '$[0].lat';
        $jsonLng = '$[0].lng';
        $haversine = "(6371 * acos(LEAST(1, cos(radians({$pickLat})) * cos(radians(JSON_EXTRACT(location_coordinates, '{$jsonLat}'))) * cos(radians(JSON_EXTRACT(location_coordinates, '{$jsonLng}')) - radians({$pickLng})) + sin(radians({$pickLat})) * sin(radians(JSON_EXTRACT(location_coordinates, '{$jsonLat}'))))))";

        // Count accepted rides
        $rideCount = Ride::whereRaw("{$haversine} < ?", [$searchRadius])
            ->where('created_at', '>=', $subTime)
            ->whereHas('zones', fn($q) => $q->where('zone_id', $zoneId))
            ->count();

        // Also count pending ride requests (demand before a driver accepts)
        $requestCount = RideRequest::whereRaw("{$haversine} < ?", [$searchRadius])
            ->where('created_at', '>=', $subTime)
            ->whereHas('zones', fn($q) => $q->where('zone_id', $zoneId))
            ->count();

        $totalDemand = $rideCount + $requestCount;
        Log::info('Peak zone demand check', [
            'zone_id'       => $zoneId,
            'rides'         => $rideCount,
            'requests'      => $requestCount,
            'total'         => $totalDemand,
            'threshold'     => $minimumNoRides,
            'radius_km'     => $searchRadius,
            'since'         => $subTime->toDateTimeString(),
        ]);

        if ($totalDemand < $minimumNoRides) {
            return null;
        }

        $polygonCoordinates = $this->generatePolygonCoordinates($pickLat, $pickLng, $searchRadius, 8);
        $points = array_map(fn($c) => new Point($c['lat'], $c['lng']), $polygonCoordinates);
        $lineString = new LineString($points);
        $polygon = new Polygon([$lineString], 4326);
        $startsAt = Carbon::now();
        $endsAt = $startsAt->copy()->addMinutes($expiryDuration);
        $existingActiveZone = PeakZone::where('zone_id', $zoneId)
            ->where('is_active', true)
            ->whereNotNull('polygon')
            ->whereRaw('ST_Contains(polygon, ST_GeomFromText(?, 4326))', ["POINT($pickLat $pickLng)"])
            ->first();

        if ($existingActiveZone) {
            $newEndsAt = Carbon::now()->addMinutes($zone->minutes_peak_zone_active);
            if (!$existingActiveZone->ends_at || $existingActiveZone->ends_at->lt($newEndsAt)) {
                $existingActiveZone->update(['ends_at' => $newEndsAt, 'updated_at' => Carbon::now()]);
                app(PeakZoneStateService::class)->setActive($existingActiveZone, $existingActiveZone->locations ?? []);
            }

            Log::info('Extended existing active peak zone', ['peak_zone_id' => $existingActiveZone->id]);
            $peakZones = app(PeakZoneStateService::class)->getActiveByZone($zoneId);
            broadcast(new PeakZoneBroadcast($zoneId, $peakZones))->toOthers();

            return $existingActiveZone;
        }

        if ($this->hasOverlappingPeakZone($zoneId, $polygon)) {
            Log::info('Overlap detected with existing active peak zone', ['zone_id' => $zoneId]);
            return null;
        }

        return DB::transaction(function () use (
            $zone, $polygon, $startsAt, $endsAt, $polygonCoordinates,
            $pickLat, $pickLng, $distancePricePercentage
        ) {
            $this->deactivateOverlappingPeakZones($zone->id, $polygon);
            $peakZone = PeakZone::create([
                'zone_id' => $zone->id,
                'name' => "Peak Zone {$zone->name} - " . $startsAt->format('YmdHis'),
                'polygon' => $polygon,
                'is_active' => true,
                'starts_at' => $startsAt,
                'ends_at' => $endsAt,
                'distance_price_percentage' => $distancePricePercentage,
            ]);

            $peakZone->update(['locations' => $polygonCoordinates]);
            $geohash = (new Geohash())->encode($pickLat, $pickLng, 12);
            app(PeakZoneStateService::class)->setActive($peakZone, $polygonCoordinates);
            Log::info('Created new peak zone', ['peak_zone_id' => $peakZone->id]);

            // Broadcast update
            $peakZones = app(PeakZoneStateService::class)->getActiveByZone($zone->id);
            broadcast(new PeakZoneBroadcast($zone->id, $peakZones))->toOthers();

            return $peakZone;
        });
    }

    protected function findActivePeakZone(float $lat, float $lng, int $zoneId): ?PeakZone
    {
        return PeakZone::where('zone_id', $zoneId)
            ->where('is_active', true)
            ->whereNotNull('polygon')
            ->whereRaw('ST_Contains(polygon, ST_GeomFromText(?, 4326))', ["POINT($lat $lng)"])
            ->where(function ($q) {
                $q->where(function ($sq) {
                    $sq->where('starts_at', '<=', now())
                       ->where('ends_at', '>=', now());
                })->orWhere(function ($sq) {
                    $sq->whereNull('starts_at')
                       ->whereNull('ends_at')
                       ->where('created_at', '>=', now()->subMinutes(60));
                });
            })
            ->orderBy('starts_at', 'desc')
            ->first();
    }

    protected function getPeakZones($coordinates)
    {
        $pickup = $coordinates[0] ?? null;
        if (!$pickup || !isset($pickup['lat'], $pickup['lng'])) {
            Log::warning('getPeakZones: Invalid pickup coordinates');
            return null;
        }

        $zone = getZoneByPoint($pickup['lat'], $pickup['lng'])?->first();
        if (!$zone || !$zone->peak_price_increase_percentage) {
            return null;
        }

        $peakZone = $this->findActivePeakZone($pickup['lat'], $pickup['lng'], $zone->id);

        if (!$peakZone) {
            $peakZone = $this->validateAndGeneratePeakZone(
                $pickup['lat'],
                $pickup['lng'],
                $zone->id,
                config('app.timezone')
            );
        }

        if ($peakZone) {
            $peakZone->refresh();
            if (!$peakZone->isActiveNow()) {
                Log::info('Peak zone expired during request', ['peak_zone_id' => $peakZone->id]);
                return null;
            }
        }

        return $peakZone;
    }

    protected function calculatePeakZoneEarnings(int $peakZoneId, ?Carbon $from = null, ?Carbon $to = null): array
    {
        $peakZone = PeakZone::findOrFail($peakZoneId);
        $query = Ride::where('peak_zone_id', $peakZoneId)?->where('payment_status', 'COMPLETED');
        if ($from) $query->where('start_time', '>=', $from);
        if ($to) $query->where('start_time', '<=', $to);
        $surgeSum = $query->sum('peak_zone_charge');
        $rideCount = $query->count();

        return [
            'peak_zone_id' => $peakZoneId,
            'peak_zone_name' => $peakZone->name,
            'zone_id' => $peakZone->zone_id,
            'zone_name' => $peakZone->zone->name ?? 'Unknown',
            'total_surge_charges' => round($surgeSum, 2),
            'platform_earnings' => round($surgeSum * 0.2, 2),
            'ride_count' => $rideCount,
        ];
    }
}
