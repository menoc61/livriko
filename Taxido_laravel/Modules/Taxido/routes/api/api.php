<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "api" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['localization','throttle:api']], function () {

    // Home Screen
    Route::get('home-screen', 'HomeScreenController@index')->name('home.index');

    // Rider Authentication
    Route::post('rider/login', 'AuthController@login')->middleware('throttle:5,1');
    Route::post('rider/forgot-password', 'AuthController@forgotPassword')->middleware('throttle:5,1');
    Route::post('rider/verify-token', 'AuthController@verifyRiderToken')->middleware('throttle:5,1');
    Route::post('rider/register', 'AuthController@riderRegister')->middleware('throttle:5,1');
    Route::post('rider/update-password', 'AuthController@updatePassword')->middleware('throttle:5,1');
    Route::post('rider/social/login', 'AuthController@socialLogin')->middleware('throttle:5,1');
    Route::delete('rider/deleteAccount', 'AuthController@deleteAccount');
    Route::post('rider/firebase/auth', 'AuthController@verifyFirebaseAuthToken')->middleware('throttle:5,1');

    // Driver Authentication
    Route::post('driver/login', 'DriverAuthController@login')->middleware('throttle:5,1');
    Route::post('driver/verify-token', 'DriverAuthController@verifyDriverToken')->middleware('throttle:5,1');
    Route::post('driver/register', 'DriverAuthController@driverRegister')->middleware('throttle:5,1');
    Route::post('driver/forgot-password', 'DriverAuthController@forgotPassword')->middleware('throttle:5,1');
    Route::post('driver/update-password', 'DriverAuthController@updatePassword')->middleware('throttle:5,1');
    Route::delete('driver/deleteAccount', 'DriverAuthController@deleteAccount');
    Route::post('driver/firebase/auth', 'DriverAuthController@verifyFirebaseAuthToken')->middleware('throttle:5,1');

    // Fleet Authentication
    Route::post('fleet/login', 'FleetAuthController@login')->middleware('throttle:5,1');
    Route::post('fleet/verify-token', 'FleetAuthController@verifyFleetToken')->middleware('throttle:5,1');
    Route::post('fleet/register', 'FleetAuthController@fleetRegister')->middleware('throttle:5,1');

    // Settings
    Route::get('cabbooking/settings', 'SettingController@index');

    // Services
    Route::apiResource('service', 'ServiceController', ['only' => ['index', 'show']]);

    // Service Categories
    Route::apiResource('serviceCategory', 'ServiceCategoryController', ['only' => ['index', 'show']]);

    // Driver Rules
    Route::apiResource('driverRule', 'DriverRuleController', ['only' => ['index', 'show']]);

    // Vehicle Types
    Route::apiResource('vehicleType', 'VehicleTypeController', ['only' => ['index', 'show']]);

    // Nearest Drivers
    Route::post('nearest-drivers', 'DriverController@getNearestDrivers')?->name('nearest.driver.index');
    Route::post('find-driver', 'DriverController@findDriver');

    // Documents
    Route::apiResource('document', 'DocumentController', ['only' => ['index', 'show']]);

    // Zones
    Route::apiResource('zone', 'ZoneController', ['only' => ['index', 'show']]);
    Route::get('zone-by-point', 'ZoneController@getZoneIds')->name('get.zoneId');

    // Banners
    Route::apiResource('banner', 'BannerController', ['only' => ['index', 'show']]);

    // Rider Invoice
    Route::get('ride/rider-invoice/{invoice_id}', 'RideController@getRiderInvoice')->name('ride.rider.invoice');

    // Driver Invoice
    Route::get('ride/driver-invoice/{invoice_id}', 'RideController@getDriverInvoice')->name('ride.driver.invoice');

    // Preferences
    Route::apiResource('preference', 'PreferenceController', ['only' => ['index', 'show']]);

    Route::group(['middleware' => ['auth:sanctum'], 'as' => 'api.'], function () {

        // Dashboard
        Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');

        // Riders
        Route::get('rider/self', 'AuthController@self');
        Route::post('rider/updateProfile', 'AuthController@updateProfile');
        Route::post('rider/updatePhoneOrEmail', 'AuthController@updatePhoneOrEmail');
        Route::post('rider/verifyPhoneOrEmail', 'AuthController@verifyPhoneOrEmail');

        // Drivers
        Route::get('driver/self', 'DriverAuthController@self');
        Route::get('driver/find-driver/self', 'DriverAuthController@findDriverSelf');
        Route::post('update/payment-account', 'DriverAuthController@updatePaymentAccount');
        Route::post('update/vehicle', 'DriverAuthController@updateVehicle');
        Route::post('update/document', 'DriverAuthController@updateDocument');
        Route::post('driver/updateProfile', 'DriverAuthController@updateProfile');
        Route::post('driver/updatePhoneOrEmail', 'DriverAuthController@updatePhoneOrEmail');
        Route::post('driver/verifyPhoneOrEmail', 'DriverAuthController@verifyPhoneOrEmail');


        Route::apiResource('driver', 'DriverController', ['only' => ['index']]);
        Route::post('driver/zone-update', 'DriverController@driverZone')->name('driver.zone.update');
        Route::post('driver/update-location', 'DriverController@updateLocation')->name('driver.location.update');
        Route::get('driver/ambulance', 'DriverController@getAmbulance')->name('ambulance.index');

        // Fleet
        Route::get('fleet/self', 'FleetAuthController@self');

        // Vehicle Types
        Route::post('vehicleType/locations', 'VehicleTypeController@getVehicleTypeByLocations')->name('vehicle.location');

        // Hourly Packages
        Route::apiResource('hourlyPackage', 'HourlyPackageController', ['only' => ['index', 'show']]);

        // Extra Charges
        Route::apiResource('extraCharge', 'ExtraChargeController', ['only' => ['index', 'show']]);

        // Cancellation Reasons
        Route::apiResource('cancellationReason', 'CancellationReasonController', ['only' => ['index', 'show']]);

        // Notices
        Route::apiResource('notice', 'NoticeController', ['only' => ['index', 'show']]);

        // Coupons
        Route::apiResource('coupon', 'CouponController', ['only' => ['index', 'show']]);
        Route::apiResource('rental-vehicle', 'RentalVehicleController');
        Route::put('rental-vehicle/{id}/{status}', 'RentalVehicleController@status')->middleware('can:rental_vehicle.edit');

        // Zones
        Route::apiResource('zone', 'ZoneController', ['except' => ['show', 'index']]);

        // Ride Requests
        Route::apiResource('rideRequest', 'RideRequestController', ['except' => ['show']])->middleware('throttle:20,1');
        Route::post('accept-ride-request', 'RideRequestController@accept')->middleware('throttle:20,1');
        Route::post('reject-ride-request', 'RideRequestController@reject')->middleware('throttle:20,1');
        Route::post('rental/rideRequest', 'RideRequestController@rental')->middleware('throttle:20,1');
        Route::post('ambulance/rideRequest', 'RideRequestController@ambulance')->middleware('throttle:20,1');

        // Soses
        Route::apiResource('sos', 'SOSController', ['except' => ['show', 'edit', 'update']]);
        Route::get('sos/{sos}', 'SOSController@show')->name('sos.show');

        // SOS Alerts
        Route::apiResource('sos-alert', 'SOSAlertController', ['only' => ['index', 'update', 'store']])->middleware('throttle:20,1');

        // Plans
        Route::apiResource('plan', 'PlanController', ['only' => ['index', 'show']]);
        Route::post('plan-purchase', 'PlanController@purchase')->name('plan.purchase');

        // Rides
        Route::apiResource('ride', 'RideController');
        Route::post('ride/start-ride', 'RideController@startRide')->name('ride.start')->middleware(['can:ride.edit', 'throttle:20,1']);
        Route::post('ride/payment', 'RideController@payment')->name('ride.payment')->middleware('throttle:20,1');
        Route::post('ride/verify-payment', 'RideController@verifyPayment')->name('ride.verify.payment')->middleware('throttle:20,1');
        Route::post('ride/verify-coupon', 'RideController@verifyCoupon')->name('ride.verify.coupon')->middleware('can:ride.create');
        Route::post('ride/verify-otp', 'RideController@verifyOtp')->name('ride.verify-otp')->middleware('throttle:20,1');
        Route::post('ride/ambulance/start-ride', 'RideController@ambulanceStartRide')->name('ride.ambulance.start')->middleware(['can:ride.edit', 'throttle:20,1']);
        Route::get('ride-location/{ride}', 'RideController@getRideLocation');
        Route::post('ride/location/charge', 'RideController@getRideLocationCharges')->name('ride.location.charge')->middleware('can:ride.index');

        // Bids
        Route::apiResource('bid', 'BidController');

        // Rider Wallets
        Route::get('riderWallet/history', 'RiderWalletController@index')->middleware('can:rider_wallet.index');
        Route::post('rider/top-up', 'RiderWalletController@topUp')->middleware('throttle:20,1');

        // Driver Wallets
        Route::get('driverWallet/history', 'DriverWalletController@index')->middleware('can:driver_wallet.index');
        Route::post('driver/withdraw-request', 'DriverWalletController@withdrawRequest')->middleware(['can:withdraw_request.create', 'throttle:20,1']);
        Route::get('driverWallet/withdraw-request', 'DriverWalletController@getWithdrawRequest')->middleware('can:withdraw_request.index');
        Route::post('driver/top-up', 'DriverWalletController@topUp')->middleware('throttle:20,1');


        // Fleet Wallets
        Route::get('fleetWallet/history', 'FleetWalletController@index')->middleware('can:fleet_wallet.index');
        Route::post('fleet/withdraw-request', 'FleetWalletController@withdrawRequest')->middleware(['can:fleet_withdraw_request.create', 'throttle:20,1']);
        Route::get('fleetWallet/withdraw-request', 'FleetWalletController@getWithdrawRequest')->middleware('can:fleet_withdraw_request.index');

        // Rider Reviews
        Route::apiResource('riderReview', 'RiderReviewController');

        // Driver Reviews
        Route::apiResource('driverReview', 'DriverReviewController');

        // Payment Account
        Route::apiResource('paymentAccount', 'PaymentAccountController', ['only' => ['index', 'update', 'store']]);

        // Locations
        Route::apiResource('location', 'LocationController', ['except' => ['show']]);

        // Referral Bonus
        Route::apiResource('referralBonus', 'ReferralBonusController', ['except' => ['show']]);

        // Incentive - Unified API
        Route::get('incentive', 'IncentiveController@index');
        Route::post('incentive/process-ride', 'IncentiveController@processRideIncentives');

        // ---------------------------------- FleetManager -----------------------------------------

        Route::prefix('fleet')->name('fleet.')->group(function () {

            // Vehicle Info
            Route::apiResource('vehicleInfo', 'VehicleInfoController');

            // Fleet Driver
            Route::post('driver', 'DriverController@fleetDriverRegister');
            // Route::put('driver', 'DriverController@fleetDriverUpdate')->middleware('can:driver.update');
            Route::put('driver', 'DriverController@fleetDriverUpdate')->middleware('can:driver.edit');
            Route::delete('driver/{driver}', 'DriverController@fleetDriverDelete')->middleware('can:driver.destroy');
            Route::get('driver-location', 'DriverController@driverLocation')->middleware('can:driver.index');

        });
    });
});
