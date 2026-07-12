<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

/**
 * SocketService
 * ─────────────────────────────────────────────────────────────────────────────
 * Reusable HTTP client for communicating with the Node.js Socket.io server.
 * Laravel → Node.js via internal REST API (REST Bridge pattern).
 *
 * Usage:
 *   app(SocketService::class)->emit('ride:new_request', 'driver:42', $data);
 *   app(SocketService::class)->emitBatch([...]);
 *   app(SocketService::class)->getState('driver', '42');
 *   app(SocketService::class)->queryNearbyDrivers($lat, $lng, $radius, $driverIds);
 *
 * Copy this file to any Laravel project. Register in AppServiceProvider as singleton.
 * ─────────────────────────────────────────────────────────────────────────────
 */
class SocketService
{
    private string $serverUrl;
    private string $secret;
    private int    $emitTimeout;   // ms — fire-and-forget is non-blocking anyway
    private int    $readTimeout;   // ms — for state reads

    public function __construct()
    {
        $this->serverUrl   = rtrim(config('socket.server_url', 'http://localhost:3000'), '/');
        $this->secret      = config('socket.secret', '');
        $this->emitTimeout = (int) config('socket.emit_timeout_ms', 500);
        $this->readTimeout = (int) config('socket.read_timeout_ms', 2000);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Emit helpers
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Emit a single event to a room — fire-and-forget (non-blocking).
     *
     * @param  string $event  e.g. 'ride:new_request'
     * @param  string $room   e.g. 'driver:42', 'rider:10', 'chat:1_5'
     * @param  array  $data
     */
    public function emit(string $event, string $room, array $data = []): void
    {
        $this->post('/emit', compact('event', 'room', 'data'), async: true);
    }

    /**
     * Emit multiple events in a single HTTP round-trip.
     *
     * @param  array $events  [['event'=>'...', 'room'=>'...', 'data'=>[...]], ...]
     */
    public function emitBatch(array $events): void
    {
        if (empty($events)) return;
        $this->post('/emit/batch', ['events' => $events], async: true);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // State reads (synchronous — Laravel needs return value)
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Find nearest online drivers (replaces Realtime driverTrack query).
     *
     * @param  float    $lat
     * @param  float    $lng
     * @param  float    $radiusMeter
     * @param  int[]    $driverIds    optional whitelist
     * @return array    [['id'=>int, 'distance'=>int], ...]  sorted by distance
     */
    public function queryNearbyDrivers(float $lat, float $lng, float $radiusMeter, array $driverIds = []): array
    {
        $params = http_build_query([
            'lat'        => $lat,
            'lng'        => $lng,
            'radius'     => $radiusMeter,
            'driver_ids' => implode(',', $driverIds),
        ]);

        $response = $this->get("/state/drivers/nearby?{$params}");
        return $response['drivers'] ?? [];
    }

    /**
     * Get a single driver's in-memory state.
     * Replaces: getRealtimeData('driverTrack', $driverId)
     */
    public function getDriverState(int|string $driverId): array
    {
        return $this->get("/state/driver/{$driverId}")['data'] ?? [];
    }

    /**
     * Get a single ride's in-memory state.
     */
    public function getRideState(int|string $rideId): array
    {
        return $this->get("/state/ride/{$rideId}")['data'] ?? [];
    }

    /**
     * Get a generic document from in-memory state.
     * Replaces: getRealtimeData($collection, $docId)
     */
    public function getState(string $collection, string $docId): array
    {
        return $this->get("/state/collection/{$collection}/{$docId}")['data'] ?? [];
    }

    /**
     * Query a generic collection with filters.
     * Replaces: queryRealtimeData($collection, $filters)
     */
    public function queryState(string $collection, array $filters = []): array
    {
        $params = '';
        if (!empty($filters)) {
            $query = [];
            foreach ($filters as [$field, , $value]) {   // [field, op, value]
                $query["filter[{$field}]"] = $value;
            }
            $params = '?' . http_build_query($query);
        }
        return $this->get("/state/collection/{$collection}{$params}")['data'] ?? [];
    }

    // ─────────────────────────────────────────────────────────────────────────
    // HTTP transport (internal)
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * POST to Node server.
     * @param  bool $async  true = fire-and-forget (200ms timeout, errors silenced)
     */
    private function post(string $path, array $body, bool $async = false): ?array
    {
        try {
            $timeout = $async ? ($this->emitTimeout / 1000) : ($this->readTimeout / 1000);

            $response = Http::timeout($timeout)
                ->withHeaders(['X-Socket-Secret' => $this->secret])
                ->post($this->serverUrl . $path, $body);

            if (!$async && $response->ok()) {
                return $response->json();
            }
        } catch (\Throwable $e) {
            if (!$async) {
                Log::warning("[SocketService] POST {$path} failed: " . $e->getMessage());
            }
            // Async: silent — Node being down must never break the user flow
        }

        return null;
    }

    /**
     * GET from Node server (synchronous state read).
     */
    private function get(string $path): array
    {
        try {
            $response = Http::timeout($this->readTimeout / 1000)
                ->withHeaders(['X-Socket-Secret' => $this->secret])
                ->get($this->serverUrl . $path);

            if ($response->ok()) {
                return $response->json() ?? [];
            }
        } catch (\Throwable $e) {
            Log::warning("[SocketService] GET {$path} failed: " . $e->getMessage());
        }

        return [];
    }
}
