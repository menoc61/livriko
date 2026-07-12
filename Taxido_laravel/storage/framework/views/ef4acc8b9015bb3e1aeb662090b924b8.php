<?php $__env->startSection('title', __('taxido::static.drivers.driver_details')); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $colorClasses = [
            'Pending' => 'warning',
            'Approved' => 'primary',
            'Rejected' => 'danger',
        ];
        $services = getAllServices();
        $rides = $driver?->rides;
        $paymentMethodColorClasses = getPaymentStatusColorClasses();
        $ridestatuscolorClasses = getRideStatusColorClasses();
        $settings = getTaxidoSettings();
    ?>

    <div class="row driver-dashboard">
        <div class="col-12">
            <div class="default-sorting mt-0">
            </div>
        </div>
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <div>
                            <h5 class="m-0"><?php echo e(__('taxido::static.drivers.personal_information')); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="personal">
                        <div class="information">
                            <div class="border-image">
                                <div class="profile-img">
                                    <?php if($driver?->profile_image?->original_url): ?>
                                        <img src="<?php echo e($driver?->profile_image?->original_url); ?>" alt="">
                                    <?php else: ?>
                                        <div class="initial-letter">
                                            <span><?php echo e(strtoupper($driver?->name[0])); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="personal-rating">
                                <h5><?php echo e($driver?->name); ?></h5>

                                <span><?php echo e(__('taxido::static.drivers.rating')); ?>:
                                    <?php
                                        $averageRating = (int) $driver?->reviews?->avg('rating');
                                        $totalStars = 5;
                                    ?>


                                    <?php for($i = 0; $i < $averageRating; $i++): ?>
                                        <img src="<?php echo e(asset('images/dashboard/star.svg')); ?>" alt="Filled Star">
                                    <?php endfor; ?>
                                    <?php for($i = $averageRating; $i < $totalStars; $i++): ?>
                                        <img src="<?php echo e(asset('images/dashboard/outline-star.svg')); ?>" alt="Outlined Star">
                                    <?php endfor; ?>
                            </div>
                        </div>
                        <a href="<?php echo e(route('admin.driver.edit', ['driver' => $driver?->id])); ?>"
                            class="btn btn-primary"><?php echo e(__('taxido::static.drivers.edit_profile')); ?></a>
                    </div>
                    <div class="information-details">
                        <ul>

                            <li> <strong> <?php echo e(__('taxido::static.drivers.contact_number')); ?> : </strong>
                                <?php if(isDemoModeEnabled()): ?>
                                    <?php echo e(__('static.demo_mode')); ?>

                                <?php else: ?>
                                    + <?php echo e($driver?->country_code); ?> <?php echo e($driver?->phone); ?>

                                <?php endif; ?>
                            </li>
                            <li><strong><?php echo e(__('taxido::static.drivers.email')); ?> :
                                </strong><?php echo e(isDemoModeEnabled() ? __('static.demo_mode') : (isset($driver?->email) ? $driver?->email : '')); ?>

                            </li>
                            <li><strong><?php echo e(__('taxido::static.drivers.city')); ?> : </strong><?php echo e($driver?->address?->city); ?>

                            </li>
                            <li><strong><?php echo e(__('taxido::static.drivers.country')); ?> :
                                </strong><?php echo e($driver?->address?->country?->name); ?></li>
                        </ul>
                        <ul>
                            <li><strong><?php echo e(__('taxido::static.drivers.total_rides')); ?> :
                                </strong><?php echo e($driver?->rides?->count()); ?></li>
                            <li><strong><?php echo e(__('taxido::static.drivers.total_earnings')); ?> :
                                </strong><?php echo e(getDefaultCurrency()?->symbol); ?>

                                <?php echo e(number_format($driver?->total_driver_commission, 2)); ?>

                            </li>
                            <li><strong><?php echo e(__('taxido::static.drivers.wallet')); ?> :
                                </strong>
                                <a href="<?php echo e(url('admin/driver-wallet')); ?>?driver_id=<?php echo e($driver->id); ?>">
                                    <?php echo e(number_format($driver?->wallet?->balance, 2)); ?></a>
                            </li>
                            </li>
                            <li><strong><?php echo e(__('taxido::static.drivers.pending_withdraw_request')); ?> :
                                </strong><?php echo e($driver?->pending_withdraw_requests_count); ?>

                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <div>
                            <h5 class="m-0"><?php echo e(__('taxido::static.drivers.driver_documents')); ?></h5>
                        </div>
                        <a href="<?php echo e(route('admin.driver.document', ['id' => $driver->id])); ?>" class="text-decoration-none">
                            <span><?php echo e(__('taxido::static.drivers.view_all')); ?></span>
                        </a>

                    </div>
                </div>
                <div class="card-body driver-document p-0">
                    <div class="table-responsive h-custom-scrollbar">
                        <table class="table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('taxido::static.drivers.document')); ?></th>
                                    <th><?php echo e(__('taxido::static.drivers.status')); ?></th>
                                    <th><?php echo e(__('taxido::static.drivers.created_at')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $driver?->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <div class="licence">
                                                <?php if($document?->document_image?->original_url): ?>
                                                    <img src="<?php echo e($document?->document_image?->original_url); ?>"
                                                        class="img-fluid" alt="">
                                                <?php else: ?>
                                                    <div class="initial-letter">
                                                        <span><?php echo e(strtoupper($driver?->name[0])); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                                <span><?php echo e($document?->document?->name); ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-<?php echo e($colorClasses[ucfirst($document->status)] ?? 'primary'); ?>"><?php echo e(ucfirst($document->status)); ?></span>
                                        </td>
                                        <td>
                                            <?php echo e($document?->created_at->format('Y-m-d h:i:s A')); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="9">
                                            <div class="table-no-data d-flex">
                                                <img src="<?php echo e(asset('images/dashboard/data-not-found.svg')); ?>"
                                                    alt="data not found">
                                                <h6><?php echo e(__('taxido::static.drivers.no_documents')); ?></h6>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-body drivers-details-tabs pb-0">
                    <div class="tabs-container">
                        <div>
                            <ul class="nav nav-tabs horizontal-tab custom-scroll" id="account" role="tablist">
                                <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link <?php if($key === 0): ?> active <?php endif; ?>"
                                            id="tab-<?php echo e($service->id); ?>-tab" data-bs-toggle="tab"
                                            data-bs-target="#tab-<?php echo e($service->id); ?>" type="button" role="tab"
                                            aria-controls="tab-<?php echo e($service->id); ?>"
                                            aria-selected="<?php echo e($key === 0 ? 'true' : 'false'); ?>">
                                            <i class="ri-roadster-line"></i>
                                            <?php echo e($service->name); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="tab-pane fade <?php if($key === 0): ?> show active <?php endif; ?>"
                                    id="tab-<?php echo e($service->id); ?>" role="tabpanel"
                                    aria-labelledby="tab-<?php echo e($service->id); ?>-tab">

                                    <div class="driver-document driver-details">
                                        <div class="table-responsive h-custom-scrollbar">
                                            <table class="table display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo e(__('taxido::static.drivers.ride_number')); ?></th>
                                                        <th><?php echo e(__('taxido::static.drivers.rider')); ?></th>
                                                        <th><?php echo e(__('taxido::static.drivers.service')); ?></th>
                                                        <th><?php echo e(__('taxido::static.drivers.category')); ?></th>
                                                        <th><?php echo e(__('taxido::static.drivers.ride_status')); ?></th>
                                                        <th><?php echo e(__('taxido::static.drivers.total')); ?></th>
                                                        <th><?php echo e(__('taxido::static.drivers.created_at')); ?></th>
                                                        <th><?php echo e(__('taxido::static.drivers.action')); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__empty_2 = true; $__currentLoopData = $rides?->where('service_id', $service?->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ride): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                                        <tr>
                                                            <td>
                                                                <span
                                                                    class="bg-light-primary">#<?php echo e($ride?->ride_number); ?></span>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="customer-image">
                                                                        <?php if($ride?->rider['profile_image']?->original_url ?? null): ?>
                                                                            <img src="<?php echo e($ride?->rider['profile_image']?->original_url); ?>"
                                                                                alt="">
                                                                        <?php else: ?>
                                                                            <div class="initial-letter">
                                                                                <span><?php echo e(strtoupper($ride?->rider['name'][0])); ?></span>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="flex-grow-1">

                                                                        <h5><?php echo e($ride?->rider['name']); ?></h5>
                                                                        <span>
                                                                            <?php if(isDemoModeEnabled()): ?>
                                                                                <?php echo e(__('static.demo_mode')); ?>

                                                                            <?php else: ?>
                                                                                <?php echo e($ride?->rider['email']); ?>

                                                                            <?php endif; ?>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><?php echo e($ride?->service?->name); ?></td>
                                                            <td><?php echo e($ride?->service_category?->name); ?></td>
                                                            <td>
                                                                <div
                                                                    class='badge badge-<?php echo e($ridestatuscolorClasses[ucfirst($ride->ride_status->name)]); ?>'>
                                                                    <?php echo e($ride->ride_status->name); ?>

                                                                </div>
                                                            </td>
                                                            <td><?php echo e(getDefaultCurrency()->symbol); ?><?php echo e($ride->total); ?></td>
                                                            <td><?php echo e($ride?->created_at->format('Y-m-d h:i:s A')); ?></td>

                                                            <td>
                                                                <a href="<?php echo e(route('admin.ride.details', $ride->id)); ?>"
                                                                    class="action-icon">
                                                                    <i class="ri-eye-line"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                                        <tr>
                                                            <td colspan="9">
                                                                <div class="table-no-data d-flex">
                                                                    <img src = "<?php echo e(asset('images/dashboard/data-not-found.svg')); ?>"
                                                                        alt="data not found">
                                                                    <h6><?php echo e(__('taxido::static.riders.no_rides')); ?></h6>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-3 col-md-6">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <div>
                            <h5 class="m-0"><?php echo e(__('taxido::static.drivers.vehicle_information')); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0 px-0">
                    <div class="vehicle-information h-custom-scrollbar">
                        <ul>
                            <?php if($driver->vehicle_info): ?>
                                <li><strong><?php echo e(__('taxido::static.drivers.model')); ?> :
                                    </strong> <?php echo e($driver?->vehicle_info?->model); ?></li>
                                <li><strong><?php echo e(__('taxido::static.drivers.vehicle_type')); ?> :
                                    </strong> <?php echo e($driver?->vehicle_info?->vehicle?->name); ?></li>
                                <li><strong><?php echo e(__('taxido::static.drivers.color')); ?> :
                                    </strong> <?php echo e($driver?->vehicle_info?->color); ?></li>
                                <li><strong><?php echo e(__('taxido::static.drivers.seats')); ?> :
                                    </strong> <?php echo e($driver?->vehicle_info?->seat); ?></li>
                                <li><strong><?php echo e(__('taxido::static.drivers.plate_number')); ?> :
                                    </strong> <?php echo e($driver?->vehicle_info?->plate_number); ?></li>
                            <?php else: ?>
                                <li class="table-no-data d-flex">
                                    <img src="<?php echo e(asset('images/dashboard/data-not-found.svg')); ?>" alt="data not found">
                                    <h6 class="text-center"><?php echo e(__('taxido::static.drivers.vehicle_info')); ?></h6>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-md-6">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <div>
                            <h5 class="m-0"><?php echo e(__('taxido::static.drivers.bank_details')); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0 px-0">
                    <div class="vehicle-information bank-details h-custom-scrollbar">
                        <ul>
                            <?php if($driver->payment_account): ?>
                                <li><strong><?php echo e(__('taxido::static.drivers.account_holder_name')); ?> :
                                    </strong> <?php echo e($driver?->payment_account?->bank_holder_name); ?>

                                </li>
                                <li><strong><?php echo e(__('taxido::static.drivers.bank_name')); ?> :
                                    </strong> <?php echo e($driver?->payment_account?->bank_name); ?></li>
                                <li><strong><?php echo e(__('taxido::static.drivers.account_number')); ?> :
                                    </strong> <?php echo e($driver?->payment_account?->bank_account_no); ?></li>
                                <li><strong><?php echo e(__('taxido::static.drivers.routing_number')); ?> :
                                    </strong> <?php echo e($driver?->payment_account?->routing_number); ?></li>
                                <li><strong><?php echo e(__('taxido::static.drivers.swift_code')); ?> :
                                    </strong> <?php echo e($driver?->payment_account?->swift); ?></li>
                            <?php else: ?>
                                <li class="table-no-data d-flex">
                                    <img src="<?php echo e(asset('images/dashboard/data-not-found.svg')); ?>" alt="data not found">
                                    <h6 class="text-center"><?php echo e(__('taxido::static.riders.no_bank_details')); ?></h6>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <div>
                            <h5 class="m-0"><?php echo e(__('taxido::static.drivers.current_driver_location')); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body driver-document driver-rules pt-0">
                    <div class="location-map" style="flex-grow: 1;">
                        <div id="map_canvas"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <div>
                            <h5 class="m-0"><?php echo e(__('taxido::static.drivers.rider_reviews')); ?></h5>
                        </div>
                        <a href="<?php echo e(route('admin.rider-review.index')); ?>" class="text-decoration-none">
                            <span><?php echo e(__('taxido::static.drivers.view_all')); ?></span>
                        </a>
                    </div>
                </div>
                <div class="card-body driver-document driver-review p-0">
                    <div class="table-responsive h-custom-scrollbar">
                        <table class="table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('taxido::static.drivers.rider')); ?></th>
                                    <th><?php echo e(__('taxido::static.drivers.rating')); ?></th>
                                    <th><?php echo e(__('taxido::static.drivers.message')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $driver?->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="customer-image">
                                                    <?php if($review && $review->rider): ?>
                                                        <?php if($review->rider->profile_image && $review->rider->profile_image->original_url): ?>
                                                            <img src="<?php echo e($review->rider->profile_image->original_url); ?>" alt="">
                                                        <?php else: ?>
                                                            <div class="initial-letter">
                                                                <span><?php echo e(strtoupper($review->rider->name[0])); ?></span>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5><?php echo e($review?->rider?->name); ?></h5>
                                                    <span>
                                                        <?php if(isDemoModeEnabled()): ?>
                                                            <?php echo e(__('static.demo_mode')); ?>

                                                        <?php else: ?>
                                                            <?php echo e($review?->rider?->email); ?>

                                                        <?php endif; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="rating">
                                                <?php
                                                    $averageRating = (int) $review?->rating;
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

                                            </div>
                                        </td>
                                        <td>
                                            <p><?php echo e($review?->message); ?></p>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="3">
                                            <div class="table-no-data d-flex">
                                                <img src="<?php echo e(asset('images/dashboard/data-not-found.svg')); ?>"
                                                    alt="data not found">
                                                <h6><?php echo e(__('taxido::static.riders.no_reviews')); ?></h6>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <div>
                            <h5 class="m-0"><?php echo e(__('taxido::static.drivers.withdraw_requests')); ?></h5>
                        </div>
                        <a href="<?php echo e(route('admin.withdraw-request.index')); ?>" class="text-decoration-none">
                            <span><?php echo e(__('taxido::static.drivers.view_all')); ?></span>
                        </a>
                    </div>
                </div>
                <div class="card-body driver-document withdraw-request p-0">
                    <div class="table-responsive h-custom-scrollbar">
                        <table class="table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('taxido::static.drivers.amount')); ?></th>
                                    <th><?php echo e(__('taxido::static.drivers.status')); ?></th>
                                    <th><?php echo e(__('taxido::static.drivers.payment_type')); ?></th>
                                    <th><?php echo e(__('taxido::static.drivers.created_at')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $driver?->withdrawRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdrawRequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($withdrawRequest?->amount); ?></td>
                                        <td>
                                            <span
                                                class="badge badge-<?php echo e($colorClasses[ucfirst($withdrawRequest->status)] ?? 'primary'); ?>"><?php echo e(ucfirst($withdrawRequest->status)); ?></span>
                                        </td>
                                        <td><?php echo e($withdrawRequest?->payment_type); ?></td>
                                        <td><?php echo e($withdrawRequest?->created_at->format('Y-m-d h:i:s A')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="9">
                                            <div class="table-no-data d-flex">
                                                <img src="<?php echo e(asset('images/dashboard/data-not-found.svg')); ?>"
                                                    alt="data not found">
                                                <h6><?php echo e(__('taxido::static.drivers.no_withdraw_requests')); ?></h6>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php if($settings['location']['map_provider'] == 'google_map'): ?>
    <?php if ($__env->exists('taxido::admin.driver.google')) echo $__env->make('taxido::admin.driver.google', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php elseif($settings['location']['map_provider'] == 'osm'): ?>
    <?php if ($__env->exists('taxido::admin.driver.osm')) echo $__env->make('taxido::admin.driver.osm', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/admin/driver/details.blade.php ENDPATH**/ ?>