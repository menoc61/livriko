<?php use \Illuminate\Support\Arr; ?>
<?php
    $ridestatuscolorClasses = getRideStatusColorClasses();
    $dateRange = getStartAndEndDate(request('sort'), request('start'), request('end'));
    $start_date = $dateRange['start'] ?? null;
    $end_date = $dateRange['end'] ?? null;
    $serviceCategories = getAllServices();
?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ride.index')): ?>
    <div class="col-xxl-5 col-xl-6">
        <div class="card">
            <div class="card-header card-no-border">
                <div class="header-top">
                    <div>
                        <h5 class="m-0"><?php echo e(__('taxido::static.widget.recent_rides')); ?></h5>
                    </div>
                    <a href="<?php echo e(route('admin.ride.index')); ?>">
                        <span><?php echo e(__('taxido::static.widget.view_all')); ?></span>
                    </a>
                </div>
                <div class="rides-tab analytics-section">
                    <ul class="nav nav-tabs horizontal-tab custom-scroll" id="ride-tabs" role="tablist">
                        <?php $__empty_1 = true; $__currentLoopData = $serviceCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $serviceCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link <?php if($key === 0): ?> active <?php endif; ?>"
                                    id="tab-<?php echo e($serviceCategory->id); ?>-tab" data-bs-toggle="tab"
                                    href="#tab-<?php echo e($serviceCategory->id); ?>" role="tab"
                                    aria-controls="tab-<?php echo e($serviceCategory->id); ?>"
                                    aria-selected="<?php echo e($key === 0 ? 'true' : 'false'); ?>">
                                    <?php echo e($serviceCategory->name); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link disabled" href="#" role="tab" aria-disabled="true">
                                    <?php echo e(__('taxido::static.widget.no_categories_available')); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="card-body top-drivers recent-rides p-0">
                <div class="tab-content">
                    <?php $__empty_1 = true; $__currentLoopData = $serviceCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $serviceCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="tab-pane fade <?php if($key === 0): ?> show active <?php endif; ?>"
                            id="tab-<?php echo e($serviceCategory->id); ?>" role="tabpanel"
                            aria-labelledby="tab-<?php echo e($serviceCategory->id); ?>-tab">

                            <div class="table-responsive h-custom-scrollbar">
                                <table class="table display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th><?php echo e(__('taxido::static.widget.ride_id')); ?></th>
                                            <th><?php echo e(__('taxido::static.widget.driver_name')); ?></th>
                                            <th><?php echo e(__('taxido::static.widget.distance')); ?></th>
                                            <th><?php echo e(__('taxido::static.widget.status')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_2 = true; $__currentLoopData = getRecentRides($start_date, $end_date, $serviceCategory->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ride): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                            <?php if($ride?->driver): ?>
                                                <tr>
                                                    <td>
                                                        <a href="<?php echo e(route('admin.ride.details', $ride->id)); ?>"><span
                                                                class="bg-light-primary">
                                                                #<?php echo e($ride->ride_number); ?></span></a>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="customer-image">
                                                                <?php if($ride?->driver?->profile_image?->original_url): ?>
                                                                    <img src="<?php echo e($ride?->driver->profile_image?->original_url); ?>"
                                                                        alt="" class="img">
                                                                <?php else: ?>
                                                                    <div class="initial-letter">
                                                                        <span><?php echo e(strtoupper($ride?->driver?->name[0])); ?></span>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="flex-grow-1">


                                                                <?php echo e($ride?->driver?->name); ?>

                                                                <span><?php if(isDemoModeEnabled()): ?>
                                                                    <?php echo e(__('taxido::static.demo_mode')); ?>

                                                                <?php else: ?>
                                                                    <?php echo e($ride?->driver?->email); ?>

                                                                <?php endif; ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?php echo e($ride?->distance); ?> <?php echo e(ucfirst($ride?->distance_unit)); ?></td>
                                                    <?php if($ride?->ride_status): ?>
                                                    <td>
                                                        <span
                                                            class="badge badge-<?php echo e($ridestatuscolorClasses[ucfirst($ride?->ride_status?->name)]); ?>">
                                                            <?php echo e($ride?->ride_status?->name); ?>

                                                        </span>
                                                    </td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                            <tr class="table-not-found">
                                                <div class="table-no-data">
                                                    <img src="<?php echo e(asset('images/dashboard/data-not-found.svg')); ?>"
                                                        alt="data not found" />
                                                    <h6 class="text-center">
                                                        <?php echo e(__('taxido::static.widget.no_data_available')); ?></h6>
                                                </div>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr class="table-not-found">
                            <div class="table-data">
                                <img src = "<?php echo e(asset('images/dashboard/data-not-found.svg')); ?>" alt="data not found">
                            </div>
                            <td colspan="5" class="text-center">
                                <?php echo e(__('taxido::static.widget.no_data_available')); ?></td>
                        </tr>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/admin/widgets/recent-rides.blade.php ENDPATH**/ ?>