<?php

namespace Modules\Taxido\Listeners;

use Modules\Taxido\Services\DriverStateService;

/**
 * SyncDriverStateListener
 * ─────────────────────────────────────────────────────────────────────────────
 * Decoupled handler for Taxido real-time events.
 * Registered dynamically via RealtimeManager.
 */
class SyncDriverStateListener
{
    /**
     * Handle the real-time sync.
     */
    public function handle(string $collection, string $docId, array $data, string $operation = 'update'): void
    {
        // 1. Handle Driver Tracking (Redis GEO Sync)
        if ($collection === 'driverTrack') {
            $driverState = app(DriverStateService::class);

            if ($operation === 'delete') {
                $driverState->setDriverOffline((int) $docId);
            } else {
                $driverState->updateDriverLocation(
                    (int) $docId,
                    (float) ($data['lat'] ?? 0),
                    (float) ($data['lng'] ?? 0),
                    $data
                );
            }
        }

        // Add more Taxido-specific handlers here as needed
    }
}
