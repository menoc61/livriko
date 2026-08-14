<?php

namespace Tests\Feature;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Modules\Taxido\Models\Driver;
use Modules\Taxido\Repositories\Api\RideRequestRepository;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RideRequestConcurrencyTest extends TestCase
{
    protected $seed = false;

    protected function setUp(): void
    {
        parent::setUp();
        app()->setLocale('en');

        // Feature tests sharing the in-memory DB may leave seeded rows behind
        // (e.g. the app-wide $seed on ExampleTest). Normalise state so each
        // test asserts against a predictable dataset.
        $this->query('ride_status_activities')->delete();
        $this->query('rides')->delete();
        $this->query('ride_requests')->delete();
        $this->query('model_has_roles')->delete();
        $this->query('users')->delete();
    }

    private function makeDriver(int $id): void
    {
        $role = Role::query()->firstOrCreate([
            'name' => 'driver',
            'guard_name' => 'web',
        ]);

        $this->query('users')->insert([
            'id' => $id,
            'name' => 'Driver '.$id,
            'email' => 'driver'.$id.'@example.com',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->query('model_has_roles')->insertOrIgnore([
            'role_id' => $role->id,
            'model_type' => User::class,
            'model_id' => $id,
        ]);
    }

    private function makeRideRequest(array $attributes = []): int
    {
        return $this->query('ride_requests')->insertGetId(array_merge([
            'ride_number' => 1001,
            'current_driver_id' => null,
            'driver_acceptance_expires_at' => null,
            'total_seats' => 4,
            'booked_seats' => 2,
            'available_seats' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ], $attributes));
    }

    private function setStatus(int $rideRequestId, string $status): void
    {
        $this->query('ride_status_activities')->insert([
            'ride_request_id' => $rideRequestId,
            'status' => $status,
            'changed_at' => now()->toDateTimeString(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function query(string $table)
    {
        return DB::table($table);
    }

    public function test_assignable_request_can_be_claimed(): void
    {
        $this->makeDriver(1);
        $this->actingAs(Driver::find(1));

        $id = $this->makeRideRequest(['current_driver_id' => 1]);
        $this->setStatus($id, 'requested');

        $locked = app(RideRequestRepository::class)->lockAssignableRideRequest($id);

        $this->assertNotNull($locked);
        $this->assertSame($id, $locked->id);
    }

    public function test_rejects_when_ride_already_exists(): void
    {
        $id = $this->makeRideRequest();
        $this->setStatus($id, 'requested');
        $this->query('rides')->insert([
            'ride_number' => 1001,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->expectException(Exception::class);
        $this->expectExceptionCode(409);
        $this->expectExceptionMessage('already been accepted');

        app(RideRequestRepository::class)->lockAssignableRideRequest($id);
    }

    public function test_rejects_when_status_is_not_assignable(): void
    {
        $id = $this->makeRideRequest();
        $this->setStatus($id, 'accepted');

        $this->expectException(Exception::class);
        $this->expectExceptionCode(409);

        app(RideRequestRepository::class)->lockAssignableRideRequest($id);
    }

    public function test_rejects_when_another_driver_is_current(): void
    {
        $this->makeDriver(1);
        $this->makeDriver(2);
        $this->actingAs(Driver::find(1));

        $id = $this->makeRideRequest(['current_driver_id' => 2]);
        $this->setStatus($id, 'requested');

        $this->expectException(Exception::class);
        $this->expectExceptionCode(409);
        $this->expectExceptionMessage('no longer assigned');

        app(RideRequestRepository::class)->lockAssignableRideRequest($id);
    }

    public function test_rejects_expired_offer(): void
    {
        $this->makeDriver(1);
        $this->actingAs(Driver::find(1));

        $id = $this->makeRideRequest([
            'current_driver_id' => 1,
            'driver_acceptance_expires_at' => now()->subMinute(),
        ]);
        $this->setStatus($id, 'requested');

        $this->expectException(Exception::class);
        $this->expectExceptionCode(409);
        $this->expectExceptionMessage('expired');

        app(RideRequestRepository::class)->lockAssignableRideRequest($id);
    }

    public function test_rejects_invalid_seat_counts_at_acceptance(): void
    {
        $id = $this->makeRideRequest(['total_seats' => 4, 'booked_seats' => 8, 'available_seats' => 0]);
        $this->setStatus($id, 'requested');

        $this->expectException(Exception::class);
        $this->expectExceptionCode(422);

        app(RideRequestRepository::class)->lockAssignableRideRequest($id);
    }
}
