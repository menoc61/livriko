<?php

namespace Modules\Taxido\Broadcasts;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class DriverTrackUpdateBroadcast implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param  int $driverId
     * @param  array $data
     */
    public function __construct(
        public readonly int  $driverId,
        public readonly array $data = []
    ) {}

    public function broadcastOn(): array
    {
        return [
            new PresenceChannel('driver-notification.' . $this->driverId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'driver.track_update';
    }

    public function broadcastWith(): array
    {
        return $this->data;
    }
}
