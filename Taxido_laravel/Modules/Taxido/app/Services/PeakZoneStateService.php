<?php

namespace Modules\Taxido\Services;

use Modules\Taxido\Models\PeakZone;
use Illuminate\Support\Facades\Redis;

class PeakZoneStateService
{
    private const KEY_PEAK_ZONE_LOCATIONS = 'peak_zone_locations';
    private const KEY_PEAK_ZONE_METADATA = 'peak_zone_metadata:';
    private const KEY_PEAK_ZONES_BY_ZONE = 'peak_zones_by_zone:';

    public function setActive(PeakZone $peakZone, array $polygonCoordinates): void
    {
        $center = $polygonCoordinates[0] ?? null;
        if (!$center) return;
        Redis::geoadd(self::KEY_PEAK_ZONE_LOCATIONS, $center['lng'], $center['lat'], (string) $peakZone->id);
        $metadata = [
            'id' => (string)$peakZone->id,
            'name' => $peakZone->name,
            'active' => true,
            'zone_id' => $peakZone->zone_id,
            'starts_at' => $peakZone->starts_at?->toDateTimeString(),
            'ends_at' => $peakZone->ends_at?->toDateTimeString(),
            'coordinates' => $polygonCoordinates,
            'distance_price_percentage' => $peakZone->distance_price_percentage,
        ];

        Redis::set(self::KEY_PEAK_ZONE_METADATA . $peakZone->id, json_encode($metadata));
        Redis::sadd(self::KEY_PEAK_ZONES_BY_ZONE . $peakZone->zone_id, (string) $peakZone->id);
        if ($peakZone->ends_at) {
            $ttl = (int) ceil(now()->diffInSeconds($peakZone->ends_at, false)) + 300;
            if ($ttl > 0) {
                Redis::expire(self::KEY_PEAK_ZONE_METADATA . $peakZone->id, $ttl);
            }
        }
    }

    public function setInactive(int $peakZoneId, ?int $zoneId = null): void
    {
        if (!$zoneId) {
            $metadata = Redis::get(self::KEY_PEAK_ZONE_METADATA . $peakZoneId);
            if ($metadata) {
                $metadata = json_decode($metadata, true);
                $zoneId = $metadata['zone_id'] ?? null;
            }
        }

        Redis::zrem(self::KEY_PEAK_ZONE_LOCATIONS, (string) $peakZoneId);
        Redis::del(self::KEY_PEAK_ZONE_METADATA . $peakZoneId);

        if ($zoneId) {
            Redis::srem(self::KEY_PEAK_ZONES_BY_ZONE . $zoneId, (string) $peakZoneId);
        }
    }

    public function getActiveByZone(int $zoneId): array
    {
        $ids = Redis::smembers(self::KEY_PEAK_ZONES_BY_ZONE . $zoneId);
        if (empty($ids)) {
            return [];
        }

        $peakZones = [];
        foreach ($ids as $id) {
            $metadata = Redis::get(self::KEY_PEAK_ZONE_METADATA . $id);
            if ($metadata) {
                $peakZones[] = json_decode($metadata, true);
            } else {
                // If metadata is gone (expired), remove from zone set
                Redis::srem(self::KEY_PEAK_ZONES_BY_ZONE . $zoneId, (string) $id);
            }
        }

        return $peakZones;
    }
}
