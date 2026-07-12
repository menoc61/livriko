<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Taxido\Broadcasts\BidAcceptedOnRideRequestBroadcast;
use Modules\Taxido\Broadcasts\BiddingStatusBroadcast;
use Modules\Taxido\Broadcasts\DocumentVerifyBroadcast;
use Modules\Taxido\Broadcasts\DriverRideRequestBroadcast;
use Modules\Taxido\Events\CreateBidEvent;
use Modules\Taxido\Broadcasts\DriverTrackUpdateBroadcast;
use Modules\Taxido\Broadcasts\RideAcceptedBroadcast;
use Modules\Taxido\Broadcasts\RideNoDriverFoundBroadcast;
use Modules\Taxido\Broadcasts\RideRequestStatusUpdateBroadcast;
use Modules\Taxido\Broadcasts\RideStatusBroadcast;
use Modules\Taxido\Models\Bid;
use Modules\Taxido\Models\Driver;
use Modules\Taxido\Models\Ride;
use Modules\Taxido\Models\RideRequest;

/**
 * TestReverbBroadcast
 * ─────────────────────────────────────────────────────────────────────────────
 * Manually fires every Taxido Reverb broadcast event so you can verify the
 * WebSocket connection and channel auth without needing the mobile app.
 *
 * Usage:
 *   php artisan taxido:test-broadcast --event=all
 *   php artisan taxido:test-broadcast --event=instant-ride
 *   php artisan taxido:test-broadcast --event=bidding
 *   php artisan taxido:test-broadcast --event=driver-request  --driver=1 --ride-request=1
 *   php artisan taxido:test-broadcast --event=ride-accepted   --ride=1 --rider=1 --driver=1
 *   php artisan taxido:test-broadcast --event=no-driver       --ride-request=1
 *   php artisan taxido:test-broadcast --event=bid-accepted    --ride-request=1 --bid=1 --ride=1
 *   php artisan taxido:test-broadcast --event=bid-status      --ride=1 --bid=1
 *   php artisan taxido:test-broadcast --event=ride-status     --ride=1
 *   php artisan taxido:test-broadcast --event=driver-track    --driver=1
 *   php artisan taxido:test-broadcast --event=doc-verify      --user=1
 */
class TestReverbBroadcast extends Command
{
    protected $signature = 'taxido:test-broadcast
        {--event=all             : Event to fire (all|instant-ride|bidding|driver-request|ride-accepted|no-driver|bid-accepted|bid-status|ride-status|driver-track|doc-verify)}
        {--driver=1              : Driver ID}
        {--rider=1               : Rider / User ID}
        {--ride=1                : Ride ID}
        {--ride-request=1        : RideRequest ID}
        {--bid=1                 : Bid ID}
        {--user=1                : User ID (for doc-verify)}';

    protected $description = 'Fire Taxido Reverb broadcast events for manual testing. Open reverb-test.html in browser first.';

    // ─── IDs resolved from DB or synthetic ──────────────────────────────────
    private int $driverId;
    private int $riderId;
    private int $rideId;
    private int $rideRequestId;
    private int $bidId;
    private int $userId;

    public function handle(): int
    {
        $this->resolveIds();
        $event = $this->option('event');

        $this->info("🔌 Taxido Reverb Broadcast Tester");
        $this->info("──────────────────────────────────────");
        $this->info("  Driver ID      : {$this->driverId}");
        $this->info("  Rider ID       : {$this->riderId}");
        $this->info("  Ride ID        : {$this->rideId}");
        $this->info("  RideRequest ID : {$this->rideRequestId}");
        $this->info("  Bid ID         : {$this->bidId}");
        $this->line('');

        match ($event) {
            'all'            => $this->fireAll(),
            'instant-ride'   => $this->fireInstantRideFlow(),
            'bidding'        => $this->fireBiddingFlow(),
            'bid-new'        => $this->fireBidNew(),
            'driver-request' => $this->fireDriverRequest(),
            'ride-accepted'  => $this->fireRideAccepted(),
            'no-driver'      => $this->fireNoDriver(),
            'bid-accepted'   => $this->fireBidAccepted(),
            'bid-status'     => $this->fireBidStatus(),
            'ride-status'    => $this->fireRideStatus(),
            'driver-track'   => $this->fireDriverTrack(),
            'doc-verify'     => $this->fireDocVerify(),
            default          => $this->error("Unknown event: {$event}"),
        };

        return self::SUCCESS;
    }

    // ─── Full flows ──────────────────────────────────────────────────────────

    private function fireAll(): void
    {
        $this->warn('🚀 Firing ALL broadcast events...');
        $this->fireInstantRideFlow();
        sleep(1);
        $this->fireBiddingFlow();
        sleep(1);
        $this->fireRideStatus();
        sleep(1);
        $this->fireDriverTrack();
        sleep(1);
        $this->fireDocVerify();
    }

    private function fireInstantRideFlow(): void
    {
        $this->warn('── INSTANT RIDE FLOW ──');

        // 1. Driver receives ride assignment
        $this->fire('DriverRideRequestBroadcast (type=request)', function () {
            $rideRequest = $this->getRideRequest();
            event(new DriverRideRequestBroadcast($rideRequest, $this->driverId, 'request'));
        });
        $this->line("   → Listen: private-driver-ride-request-{$this->driverId}  |  .driver.ride.request");
        sleep(1);

        // 2. Driver times out
        $this->fire('DriverRideRequestBroadcast (type=timeout)', function () {
            $rideRequest = $this->getRideRequest();
            event(new DriverRideRequestBroadcast($rideRequest, $this->driverId, 'timeout'));
        });
        $this->line("   → Listen: private-driver-ride-request-{$this->driverId}  |  .driver.ride.request");
        sleep(1);

        // 3. Ride accepted
        $this->fireRideAccepted();
        sleep(1);

        // 4. Simulate cancellation (no driver found)
        $this->fireNoDriver();
    }

    private function fireBiddingFlow(): void
    {
        $this->warn('── BIDDING FLOW ──');

        // 0. Driver places a bid → rider receives it
        $this->fireBidNew();
        sleep(1);

        // 1. All drivers notified
        $this->fire('DriverRideRequestBroadcast (type=request, bidding)', function () {
            $rideRequest = $this->getRideRequest();
            event(new DriverRideRequestBroadcast($rideRequest, $this->driverId, 'request'));
        });
        $this->line("   → Listen: private-driver-ride-request-{$this->driverId}  |  .driver.ride.request");
        sleep(1);

        // 2. Rider accepts a bid
        $this->fireBidAccepted();
        sleep(1);

        // 3. Rejected driver's bid channel
        $this->fireBidStatus();
        sleep(1);

        // 4. Ride request status echo
        $this->fire('RideRequestStatusUpdateBroadcast', function () {
            broadcast(new RideRequestStatusUpdateBroadcast($this->rideRequestId, $this->rideId, 'accepted'));
        });
        $this->line("   → Listen: private-ride-request-{$this->rideRequestId}  |  .ride.status_update");
    }

    // ─── Individual events ───────────────────────────────────────────────────

    private function fireDriverRequest(): void
    {
        $this->fire('DriverRideRequestBroadcast', function () {
            $rideRequest = $this->getRideRequest();
            event(new DriverRideRequestBroadcast($rideRequest, $this->driverId, 'request'));
        });
        $this->line("   → Channel : private-driver-ride-request-{$this->driverId}");
        $this->line("   → Event   : .driver.ride.request");
    }

    private function fireRideAccepted(): void
    {
        $this->fire('RideAcceptedBroadcast', function () {
            $ride = $this->getRide();
            broadcast(new RideAcceptedBroadcast($ride, $this->riderId, [
                'driver_name'               => 'Test Driver',
                'is_on_ride'                => '1',
                'phone'                     => '+919876543210',
                'model'                     => 'Swift Dzire',
                'plate_number'              => 'GJ01AB0001',
                'profile_image_url'         => null,
                'vehicle_type_map_icon_url' => null,
                'ride_id'                   => $this->rideId,
            ]));
        });
        $this->line("   → Channel : private-rider.{$this->riderId}");
        $this->line("   → Event   : .ride.accepted");

        sleep(1);

        $this->fire('DriverTrackUpdateBroadcast (on accept)', function () {
            broadcast(new DriverTrackUpdateBroadcast($this->driverId, [
                'id'          => (string) $this->driverId,
                'driver_id'   => (string) $this->driverId,
                'driver_name' => 'Test Driver',
                'is_on_ride'  => '1',
                'ride_id'     => $this->rideId,
            ]));
        });
        $this->line("   → Channel : private-driver-notification-{$this->driverId}");
        $this->line("   → Event   : .driver.track_update");

        sleep(1);

        $this->fire('RideRequestStatusUpdateBroadcast (on accept)', function () {
            broadcast(new RideRequestStatusUpdateBroadcast($this->rideRequestId, $this->rideId, 'accepted'));
        });
        $this->line("   → Channel : private-ride-request.{$this->rideRequestId}");
        $this->line("   → Event   : .ride.status_update");
    }

    private function fireNoDriver(): void
    {
        $this->fire('RideNoDriverFoundBroadcast', function () {
            $rideRequest = $this->getRideRequest();
            broadcast(new RideNoDriverFoundBroadcast($rideRequest));
        });
        $this->line("   → Channel : private-rider.{$this->riderId}");
        $this->line("   → Event   : .ride.no_driver_found");
    }

    private function fireBidNew(): void
    {
        $this->fire('CreateBidEvent (driver places bid → rider receives bid.new)', function () {
            $rideRequest = $this->getRideRequest();
            $driver      = \Modules\Taxido\Models\Driver::findOrFail($this->driverId);
            event(new CreateBidEvent($rideRequest, $driver, 250.00));
        });
        $this->line("   → Channel : private-ride-request.{$this->rideRequestId}");
        $this->line("   → Event   : .bid.new");
        $this->line("   → Rider subscribes to private-ride-request.{rideRequestId} and listens .bid.new");
    }

    private function fireBidAccepted(): void
    {
        $this->fire('BidAcceptedOnRideRequestBroadcast', function () {
            broadcast(new BidAcceptedOnRideRequestBroadcast($this->rideRequestId, $this->bidId, $this->rideId));
        });
        $this->line("   → Channel : private-ride-request.{$this->rideRequestId}");
        $this->line("   → Event   : .bid.status  (status=accepted)");
    }

    private function fireBidStatus(): void
    {
        $this->fire('BiddingStatusBroadcast (rejected driver)', function () {
            $ride = $this->getRide();
            $bid  = $this->getBid();
            broadcast(new BiddingStatusBroadcast($ride, $bid));
        });
        $this->line("   → Channel : private-bid-status.{$this->bidId}");
        $this->line("   → Event   : .bid.status");
    }

    private function fireRideStatus(): void
    {
        $this->fire('RideStatusBroadcast', function () {
            $ride = $this->getRide();
            broadcast(new RideStatusBroadcast($ride));
        });
        $this->line("   → Channel : private-ride-status.{$this->rideId}");
        $this->line("   → Event   : .ride.status");
    }

    private function fireDriverTrack(): void
    {
        $this->fire('DriverTrackUpdateBroadcast', function () {
            broadcast(new DriverTrackUpdateBroadcast($this->driverId, [
                'id'          => (string) $this->driverId,
                'driver_id'   => (string) $this->driverId,
                'driver_name' => 'Test Driver',
                'is_on_ride'  => '0',
                'ride_id'     => $this->rideId,
            ]));
        });
        $this->line("   → Channel : private-driver-notification.{$this->driverId}");
        $this->line("   → Event   : .driver.track_update");
    }

    private function fireDocVerify(): void
    {
        $this->fire('DocumentVerifyBroadcast', function () {
            $user = \App\Models\User::findOrFail($this->userId);
            broadcast(new DocumentVerifyBroadcast($user, 1, 'Test: Document Verified'));
        });
        $this->line("   → Channel : private-document-verification.{$this->userId}");
        $this->line("   → Event   : .document.verified.{$this->userId}");
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    private function fire(string $label, \Closure $fn): void
    {
        $this->line('');
        $this->info("▶ Firing: {$label}");
        try {
            $fn();
            $this->line("  <fg=green>✓ Dispatched successfully</>");
        } catch (\Throwable $e) {
            $this->error("  ✗ Failed: " . $e->getMessage());
        }
    }

    private function resolveIds(): void
    {
        $this->driverId      = (int) $this->option('driver');
        $this->riderId       = (int) $this->option('rider');
        $this->rideId        = (int) $this->option('ride');
        $this->rideRequestId = (int) $this->option('ride-request');
        $this->bidId         = (int) $this->option('bid');
        $this->userId        = (int) $this->option('user');

        // Auto-resolve from DB if defaults are still 1 and a real record exists
        if ($this->rideRequestId === 1) {
            $rr = RideRequest::latest()->first();
            if ($rr) {
                $this->rideRequestId = $rr->id;
                $this->riderId       = (int) ($rr->rider_id ?? $this->riderId);
            }
        }
        if ($this->rideId === 1) {
            $ride = Ride::latest()->first();
            if ($ride) {
                $this->rideId  = $ride->id;
                $this->riderId = (int) ($ride->rider_id ?? $this->riderId);
                $this->driverId = (int) ($ride->driver_id ?? $this->driverId);
            }
        }
        if ($this->bidId === 1) {
            $bid = Bid::latest()->first();
            if ($bid) {
                $this->bidId    = $bid->id;
                $this->driverId = (int) ($bid->driver_id ?? $this->driverId);
            }
        }
        if ($this->driverId === 1) {
            $driver = Driver::latest()->first();
            if ($driver) $this->driverId = $driver->id;
        }
        if ($this->userId === 1) {
            $this->userId = $this->driverId; // fallback: use driver as the user
        }
    }

    private function getRideRequest(): RideRequest
    {
        return RideRequest::findOrFail($this->rideRequestId);
    }

    private function getRide(): Ride
    {
        return Ride::findOrFail($this->rideId);
    }

    private function getBid(): Bid
    {
        return Bid::findOrFail($this->bidId);
    }
}
