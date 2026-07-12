<?php use \Modules\Taxido\Enums\ServiceCategoryEnum; ?>
<?php use \Modules\Taxido\Enums\ServicesEnum; ?>
<?php use \Modules\Taxido\Enums\RideStatusEnum; ?>
<?php
    $locations = $rideRequest->locations;
    $locationCoordinates = $rideRequest->location_coordinates;
    $settings = getTaxidoSettings();
    $paymentLogoUrl = getPaymentLogoUrl($rideRequest->payment_method);
    $currencySymbol = getDefaultCurrencySymbol();
    $cs = $rideRequest?->currency_symbol ?? $currencySymbol;
    $paymentstatuscolorClasses = getPaymentStatusColorClasses();
    $ridestatuscolorClasses = getRideStatusColorClasses();
?>

<?php $__env->startSection('title', __('taxido::static.rides.riderequests')); ?>
<?php $__env->startSection('content'); ?>
    <div class="row ride-dashboard">
        <div class="col-12">
            <div class="default-sorting mt-0">
                <div class="welcome-box">
                    <div class="d-flex">
                        <h2><?php echo e(__('taxido::static.rides.ride_request_details')); ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-6">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-no-border">
                            <div class="header-top">
                                <h5 class="m-0"><?php echo e(__('taxido::static.rides.general_detail')); ?></h5>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <ul class="ride-details-list">
                                <li>
                                    <?php echo e(__('taxido::static.rides.service')); ?> :
                                    <span id="service-name"><?php echo e($rideRequest->service->name); ?></span>
                                </li>
                                <li>
                                    <?php echo e(__('taxido::static.rides.service_category')); ?> :
                                    <span id="service-category"><?php echo e($rideRequest?->service_category?->name); ?></span>
                                </li>
                                <?php if($rideRequest?->service?->name == ServicesEnum::PARCEL): ?>
                                <li><strong><?php echo e(__('taxido::static.rides.parcel_otp')); ?>: </strong>
                                    <span id="parcel-otp"><?php echo e($rideRequest?->parcel_delivered_otp); ?></span>
                                </li>
                                <?php endif; ?>
                                <li>
                                    <?php echo e(__('taxido::static.rides.ride_distance')); ?> :
                                    <span id="ride-distance"><?php echo e($rideRequest?->distance); ?> <?php echo e($rideRequest?->distance_unit ?? 'KM'); ?></span>
                                </li>
                                <li>
                                    <?php echo e(__('taxido::static.rides.total')); ?> :
                                    <span id="ride-fare"><?php echo e($cs . number_format(round($rideRequest?->total, 2), 2)); ?></span>
                                </li>
                                <li>
                                    <?php echo e(__('taxido::static.rides.payment_method')); ?> :
                                    <span>
                                        <img class="img-fluid h-30" alt="" id="payment-method-img"
                                            src="<?php echo e($paymentLogoUrl ?: asset('images/payment/cod.png')); ?>">
                                    </span>
                                </li>
                                <li>
                                    <?php echo e(__('taxido::static.rides.status')); ?> :
                                    <span id="ride-status" class="badge badge-<?php echo e(\Modules\Taxido\Models\RideStatus::getColorCodeByStatus($rideRequest?->status)); ?>">
                                        <?php echo e(\Modules\Taxido\Models\RideStatus::getDescriptionByStatus($rideRequest?->status)); ?>

                                    </span>
                                </li>

                                <li>
                                    <?php echo e(__('taxido::static.rides.cancellation_reason')); ?> :
                                    <span id="cancellation-reason">
                                        <?php echo e($rideRequest->cancellation_reason); ?>

                                    </span>
                                </li>

                                <ul class="list-unstyled mt-3">

                                </ul>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-12">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header card-no-border">
                                    <div class="header-top">
                                        <h5 class="m-0"><?php echo e(__('taxido::static.rides.rider_information')); ?></h5>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="personal h-custom-scrollbar">
                                        <div class="information">
                                            <div class="border-image">
                                                <div class="profile-img">
                                                    <div class="initial-letter">
                                                         <span id="rider-initial"><?php echo e(strtoupper($rideRequest?->rider['name'][0] ?? 'G')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="personal-rating">
                                                <h5 id="rider-name"><?php echo e($rideRequest['rider']['name']  ?? 'G'); ?></h5>
                                                <div class="rating">
                                                    <span><?php echo e(__('taxido::static.rides.rating')); ?>:</span>
                                                    <span id="rider-rating">
                                                            <?php
                                                                $averageRating = 0;
                                                                if (
                                                                    isset($rideRequest['rider']['reviews']) &&
                                                                    count($rideRequest['rider']['reviews']) > 0
                                                                ) {
                                                                    $averageRating = (int) collect(
                                                                        $rideRequest['rider']['reviews'],
                                                                    )->avg('rating');
                                                                }
                                                                $totalStars = 5;
                                                            ?>
                                                            <?php for($i = 0; $i < $averageRating; $i++): ?>
                                                                <img src="<?php echo e(asset('images/dashboard/star.svg')); ?>"
                                                                    alt="Filled Star">
                                                            <?php endfor; ?>
                                                            <?php for($i = $averageRating; $i < $totalStars; $i++): ?>
                                                                <img src="<?php echo e(asset('images/dashboard/outline-star.svg')); ?>"
                                                                    alt="Outlined Star">
                                                            <?php endfor; ?>
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="personal-details-list">
                                            <li>
                                                <?php echo e(__('taxido::static.rides.email')); ?>:
                                                <span id="rider-email"><?php echo e($rideRequest->rider['email'] ?? 'N/A'); ?> </span>
                                            </li>
                                            <?php if(isset($rideRequest->rider['phone']) && isset($rideRequest->rider['country_code'])): ?>
                                                <?php
                                                    $contactNumber = '+'.$rideRequest->rider['country_code'].$rideRequest->rider['phone'];
                                                ?>
                                            <?php else: ?>
                                                <?php
                                                    $contactNumber = 'N/A';
                                                ?>
                                            <?php endif; ?>
                                            <li>
                                                <?php echo e(__('taxido::static.rides.contact_number')); ?>:
                                                <span id="rider-phone">
                                                    <?php echo e($contactNumber); ?>

                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" id="driverInformationCard" style="display: none;">
                    <div class="card">
                        <div class="card-header card-no-border">
                            <div class="header-top">
                                <h5 class="m-0"><?php echo e(__('taxido::static.rides.driver_information')); ?></h5>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="personal h-custom-scrollbar">
                                <div class="information" id="driver-info">
                                    <div class="border-image">
                                        <div class="profile-img">
                                            <div class="initial-letter">
                                                <span id="driver-initial"></span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="personal-rating">
                                        <h5 class="text-decoration-none" id="driver-name">Waiting for driver...</h5>
                                        <div class="rating">
                                            <span>
                                                <?php echo e(__('taxido::static.rides.rating')); ?>:
                                            </span>
                                            <span id="driver-rating">

                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <!-- <div class="information-details"> -->
                                    <ul class="personal-details-list">
                                        <li>
                                            <?php echo e(__('taxido::static.rides.phone')); ?>:
                                            <span id="driver-phone">N/A</span>
                                        </li>
                                        <li><?php echo e(__('taxido::static.riders.vehicle_num')); ?>:
                                            <span id="vehicle-plate-number">
                                            N/A
                                            </span>

                                        </li>
                                        <li id="driver-phone">
                                            <?php echo e(__('taxido::static.rides.vehicle_model')); ?>:
                                            <span id="vehicle-model">N/A</span>
                                        </li>
                                        <?php if(!in_array($rideRequest?->service_category?->slug, [ServiceCategoryEnum::RENTAL])): ?>
                                        <li>
                                            <span><?php echo e(__('taxido::static.rides.vehicle_type')); ?>: </span>
                                            <div class="vehicle-image">
                                                <img id="vehicle-type-image" src="" class="img-fluid">
                                            </div>
                                            <span id="vehicle-type-name">N/A</span>
                                        </li>
                                        <?php endif; ?>
                                    </ul>

                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-6">
            <div class="card maps-view h-auto">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <div>
                            <h5 class="m-0"><?php echo e(__('taxido::static.rides.map_view')); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="map-view" id="map-view" loading="lazy"></div>
                    <div class="accordion" id="location-view">
                        <div class="accordion-item location-details">
                            <div class="accordion-header contentbox-title">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#location-viewCollapse">
                                    <h4><?php echo e(__('taxido::static.rides.location_details')); ?></h4>
                                </button>
                            </div>
                            <div id="location-viewCollapse" class="accordion-collapse collapse show"
                                data-bs-parent="#location-view">
                                <div class="accordion-body">
                                    <div class="">
                                        <ul class="tracking-path" id="locations-list">
                                            <?php
                                                $points = range('A', 'Z');
                                            ?>
                                            <?php $__currentLoopData = $rideRequest->locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($loop->last): ?>
                                                    <li class="end-point">
                                                        <?php echo e($location); ?><span><?php echo e($points[$index]); ?></span>
                                                    </li>
                                                <?php else: ?>
                                                    <li class="stop-point">
                                                        <?php echo e($location); ?><span><?php echo e($points[$index]); ?></span>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if($rideRequest->ride_status_activities->isNotEmpty()): ?>
            <div class="card m-0 h-auto">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <div class="booking-title">
                            <h5 class="m-0">Ride #<?php echo e($rideRequest->ride_number); ?> Activities</h5>
                            <h6>Created <?php echo e($rideRequest->created_at->format('j F Y, h:i A')); ?></h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="booking-details-box">
                        <div class="booking-content">
                            <ul class="booking-number-list">
                                <?php $__currentLoopData = $rideRequest->ride_status_activities->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <div class="activity-dot"></div>
                                        <div class="circle <?php echo e(\Modules\Taxido\Models\RideStatus::getActivityClassByStatus($activity->status)); ?>"></div>
                                        <div class="booking-number-box">
                                            <div class="left-box">
                                                <h6 class="date"><?php echo e(\Carbon\Carbon::parse($activity->created_at)->format('d-m-Y')); ?></h6>
                                                <h6 class="name"><?php echo e(ucfirst(str_replace('_', ' ', $activity->status))); ?></h6>
                                                <h6 class="text-pra"><?php echo e($activity->ride_status ? $activity->ride_status->description : \Modules\Taxido\Models\RideStatus::getDescriptionByStatus($activity->status)); ?></h6>
                                            </div>
                                            <div class="right-box">
                                                <h6><?php echo e(\Carbon\Carbon::parse($activity->created_at)->format('h:i A')); ?></h6>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php if(in_array($rideRequest?->service?->slug, [ServicesEnum::PARCEL])): ?>
        <div class="col-xxl-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="parcel-box">
                            <div class="left-box">
                                <img id="cargo-image" src="<?php echo e($rideRequest->cargo_image?->original_url ?? asset('images/nodata1.webp')); ?>"
                                    class="img-fluid" alt="">
                            </div>
                            <ul class="right-list">
                                <li><span><?php echo e(__('taxido::static.rides.receiver_name')); ?>:</span>
                                    <span id="receiver-name"><?php echo e($rideRequest?->parcel_receiver['name']); ?></span>
                                </li>
                                <li>
                                    <span><?php echo e(__('taxido::static.rides.receiver_no')); ?>:</span>
                                    <span id="receiver-phone">
                                        <?php if(isDemoModeEnabled()): ?>
                                            <?php echo e(__('taxido::static.demo_mode')); ?>

                                        <?php else: ?>
                                            +<?php echo e($rideRequest?->parcel_receiver['country_code'] ?? ''); ?> <?php echo e($rideRequest?->parcel_receiver['phone'] ?? ''); ?>

                                        <?php endif; ?>
                                    </span>
                                </li>
                                <li><span><?php echo e(__('taxido::static.rides.parcel_otp')); ?>:</span>
                                    <span id="parcel-otp-display"><?php echo e($rideRequest?->parcel_delivered_otp); ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php if($settings['location']['map_provider'] == 'google_map'): ?>
    <?php if ($__env->exists('taxido::admin.ride.google')) echo $__env->make('taxido::admin.ride.google', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php elseif($settings['location']['map_provider'] == 'osm'): ?>
    <?php if ($__env->exists('taxido::admin.ride.osm')) echo $__env->make('taxido::admin.ride.osm', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>

<?php $__env->startPush('scripts'); ?>
<!-- Echo scripts handled by master layout -->

<script>
    const rideStatusColorClasses = <?php echo json_encode($ridestatuscolorClasses, 15, 512) ?>;
    // Get the ride request ID from the PHP variable
    const rideRequestId = "<?php echo e($rideRequest->id); ?>";

    // Function to render rating stars
    function renderRating(rating) {
        let stars = '';
        const totalStars = 5;
        for (let i = 0; i < rating; i++) {
            stars += `<img src="<?php echo e(asset('images/dashboard/star.svg')); ?>" alt="Filled Star">`;
        }
        for (let i = rating; i < totalStars; i++) {
            stars += `<img src="<?php echo e(asset('images/dashboard/outline-star.svg')); ?>" alt="Outlined Star">`;
        }
        return stars;
    }

    // Function to update driver details
    function updateDriverDetails(driver) {
        if (!driver || !driver.id) {
            $('#driverInformationCard').hide();
            return;
        }

        let driverName = driver.name + " (" + driver.id + ")";
        $('#driver-name').text(driverName);
        $('#driver-initial').text(driver.name ? driver.name[0].toUpperCase() : '');
        $('#vehicle-model').text(driver.vehicle_info?.model || 'N/A');
        $('#driver-rating').html(renderRating(driver.rating_count || 0));
        $('#driver-phone').text(driver.phone ? `+${driver.country_code} ${driver.phone}` : 'N/A');
        $('#vehicle-plate-number').text(driver.vehicle_info?.plate_number || 'N/A');

        if ($('#vehicle-type-name').length) {
            $('#vehicle-type-name').text(driver.vehicle_info?.vehicle_name || 'N/A');
            $('#vehicle-type-image').attr('src', driver.vehicle_info?.vehicle_image_url || '');
        }
        $('#driverInformationCard').show();
    }

    // Listen for real-time updates via Echo
    function initEcho() {
        console.log("<====== window.Echo & rideRequestId ======> ", window.Echo, rideRequestId);
        if (typeof window.Echo !== 'undefined' && rideRequestId) {
            window.Echo.private('ride-request-status.' + rideRequestId)
                .listen('.ride.request.status', (data) => {
                    if (!data) return;

                    $('#service-name').text(data?.service?.name || '');
                    $('#service-category').text(data?.service_category?.name || '');
                    $('#ride-distance').text(`${data?.distance || '0.0'} ${data?.distance_unit || 'KM'}`);
                    $('#ride-fare').text(`<?php echo e($cs); ?>${Math.round(data?.total * 100) / 100 || 0}`);

                    if (data.payment_method) {
                        $('#payment-method-img').attr('src', data.payment_method === 'cash' ?
                            "<?php echo e(asset('images/payment/cod.png')); ?>" : "<?php echo e(asset('images/payment/cod.png')); ?>");
                    }

                    if (data.rider) {
                        $('#rider-name').text(data.rider.name || 'Unknown');
                        $('#rider-initial').text(data.rider.name ? data.rider.name[0].toUpperCase() : '');
                        $('#rider-rating').html(renderRating(data.rider.rating_count || 0));
                    }

                    $('#cancellation-reason').text(data.cancellation_reason || '');

                    // Update locations
                    if (data.locations) {
                        let locationsHtml = '';
                        const points = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');
                        data.locations.forEach((location, index) => {
                            const isLast = index === data.locations.length - 1;
                            locationsHtml += `
                                <li class="${isLast ? 'end-point' : 'stop-point'}">
                                    ${location}<span>${points[index]}</span>
                                </li>`;
                        });
                        $('#locations-list').html(locationsHtml);
                    }

                    if (data.status) {
                        let rideStatus = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                        let badgeColor = rideStatusColorClasses[rideStatus] || 'secondary';
                        $('#ride-status').text(rideStatus).removeClass().addClass(`badge badge-${badgeColor}`);

                        // If accepted, redirect to ride details
                        if (data.status === 'accepted' && data.ride_id) {
                            window.location.href = `/admin/ride/details/${data.ride_id}`;
                        }
                    }

                    // Update driver info from payload
                    if (data.driver) {
                        updateDriverDetails(data.driver);
                    } else {
                        $('#driverInformationCard').hide();
                    }
                });
        } else {
            // Check again in 100ms
            setTimeout(initEcho, 100);
        }
    }

    initEcho();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/admin/ride-request/details.blade.php ENDPATH**/ ?>