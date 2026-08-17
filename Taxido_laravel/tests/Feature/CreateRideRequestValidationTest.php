<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Validator;
use Modules\Taxido\Http\Requests\Api\CreateRideRequest;
use Modules\Taxido\Models\RideRequest;
use Tests\TestCase;

class CreateRideRequestValidationTest extends TestCase
{
    protected $seed = true;

    public function test_start_time_and_ride_type_rules_exist(): void
    {
        $request = new CreateRideRequest();

        $rules = $request->rules();

        $this->assertArrayHasKey('start_time', $rules);
        $this->assertArrayHasKey('ride_type', $rules);
    }

    public function test_valid_schedule_values_pass_validation(): void
    {
        $request = new CreateRideRequest();

        $rules = $request->rules();
        unset($rules['service_id'], $rules['service_category_id'], $rules['vehicle_type_id'], $rules['coupon']);

        $validator = Validator::make([
            'start_time' => now()->addHours(4)->toDateTimeString(),
            'ride_type'  => 'schedule',
            'locations'  => ['A', 'B'],
            'service_id' => 1,
            'location_coordinates' => [['lat' => 6.5244, 'lng' => 3.3792]],
        ], $rules);

        $this->assertFalse($validator->fails(), implode(', ', $validator->errors()->all()));
    }

    public function test_is_schedule_marker_detects_future_start_time(): void
    {
        $ride = new RideRequest([
            'start_time' => now()->addDays(2)->toDateTimeString(),
        ]);

        $this->assertTrue($ride->isScheduleRideRequest());
    }

    public function test_is_schedule_marker_rejects_past_instant_ride(): void
    {
        $ride = new RideRequest([
            'start_time'        => now()->subDays(2)->toDateTimeString(),
            'ride_type'         => 'instant',
        ]);

        $this->assertFalse($ride->isScheduleRideRequest());
    }
}