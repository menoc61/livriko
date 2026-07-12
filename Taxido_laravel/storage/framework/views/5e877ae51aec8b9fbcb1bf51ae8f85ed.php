<?php use \Modules\Taxido\Enums\RoleEnum; ?>
<?php
$dateRange = getStartAndEndDate(request('sort'), request('start'), request('end'));
$start_date = $dateRange['start'] ?? null;
$end_date = $dateRange['end'] ?? null;
$roleName = getCurrentRoleName();
?>

<?php if($roleName != RoleEnum::DRIVER): ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('driver.index')): ?>
<div class="col-xxl-5 col-xl-6">
    <div class="card top-height">
        <div class="card-header card-no-border">
            <div class="header-top">
                <div>
                    <h5 class="m-0"><?php echo e(__('taxido::static.widget.top_drivers')); ?></h5>
                </div>
                <a href=<?php echo e(route('admin.driver.index')); ?>><span><?php echo e(__('taxido::static.widget.view_all')); ?></span></a>
            </div>
        </div>
        <div class="card-body top-drivers p-0">
            <div class="table-responsive h-custom-scrollbar">
                <table class="table display" style="width:100%">
                    <thead>
                        <tr>
                            <th><?php echo e(__('taxido::static.widget.driver_name')); ?></th>
                            <th><?php echo e(__('taxido::static.widget.total_rides')); ?></th>
                            <th><?php echo e(__('taxido::static.widget.ratings')); ?></th>
                            <th><?php echo e(__('taxido::static.widget.earnings')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = getTopDrivers($start_date,$end_date); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="customer-image">
                                        <?php if($driver?->profile_image?->original_url): ?>
                                        <img src="<?php echo e($driver->profile_image->original_url); ?>" alt=""
                                            class="img">
                                        <?php else: ?>
                                        <div class="initial-letter">
                                            <span><?php echo e(strtoupper($driver->name[0])); ?></span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-grow-1">

                                        <h5>
                                        <?php echo e($driver?->name); ?>

                                        </h5>
                                        <span>
                                            <?php if(isDemoModeEnabled()): ?>
                                                <?php echo e(__('taxido::static.demo_mode')); ?>

                                            <?php else: ?>
                                                <?php echo e($driver->email); ?>

                                            <?php endif; ?>
                                        </span>
                                        <div class="active-status <?php if($driver->is_online): ?> 'active-online' <?php else: ?> 'active-offline' <?php endif; ?> "></div>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo e(getTotalDriverRides($driver->id)); ?></td>
                            <td>
                                <div class="rating">
                                    <img src="<?php echo e(asset('images/dashboard/star.svg')); ?>" alt="">
                                    <span>(<?php echo e(number_format($driver->rating_count, 1)); ?>)</span>
                                </div>
                            </td>
                            <td><?php echo e(formatCurrency(getDriverWallet($driver->id)) ?? 0); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="table-no-data">
                            <img src="<?php echo e(asset('images/dashboard/data-not-found.svg')); ?>" class="img-fluid"
                                alt="data not found">
                            <h6 class="text-center">
                                <?php echo e(__('taxido::static.widget.no_data_available')); ?>

                            </h6>
                        </div>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/admin/widgets/top-drivers.blade.php ENDPATH**/ ?>