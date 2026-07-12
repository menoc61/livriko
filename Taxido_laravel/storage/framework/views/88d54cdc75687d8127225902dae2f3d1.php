<?php $__env->startSection('title', __('taxido::front.history')); ?>
<?php
        $ridestatuscolorClasses = getRideStatusColorClasses();
        $settings = getTaxidoSettings();
?>
<?php $__env->startSection('detailBox'); ?>
<div class="dashboard-details-box table-details-box">
    <div class="dashboard-title">
        <h3><?php echo e(__('taxido::front.history')); ?></h3>
        <a href="<?php echo e(route('front.cab.ride.create')); ?>">+ <?php echo e(__('taxido::front.create_ride')); ?></a>
    </div>

    <div class="driver-document driver-details">
        <div class="table-responsive">
            <table class="table history-table display">
                <?php if($rides->count()): ?>
                    <thead>
                        <tr>
                            <th><?php echo e(__('taxido::front.ride_number')); ?></th>
                            <th><?php echo e(__('taxido::front.driver')); ?></th>
                            <th><?php echo e(__('taxido::front.service')); ?></th>
                            <th><?php echo e(__('taxido::front.ride_status')); ?></th>
                            <th><?php echo e(__('taxido::front.total_amount')); ?></th>
                            <th><?php echo e(__('taxido::front.created_at')); ?></th>
                            <th><?php echo e(__('taxido::front.action')); ?></th>
                        </tr>
                    </thead>
                <?php endif; ?>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $rides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ride): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <span class="badge badge-primary bg-light-primary">#<?php echo e($ride->ride_number); ?></span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center profile-box">
                                    <div class="customer-image">
                                        <?php if($ride->driver && $ride->driver->profile_image?->original_url): ?>
                                            <img src="<?php echo e($ride->driver->profile_image->original_url); ?>" alt="<?php echo e($ride->driver->name); ?>" class="img-fluid">
                                        <?php else: ?>
                                            <div class="initial-letter">
                                                <span><?php echo e(strtoupper($ride->driver->name[0] ?? 'N/A')); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="profile-name flex-grow-1">
                                        <h5><?php echo e($ride->driver->name ?? 'Unknown Driver'); ?></h5>
                                        <span>
                                            <?php if(isDemoModeEnabled()): ?>
                                                <?php echo e(__('demo_mode')); ?>

                                            <?php else: ?>
                                                <?php echo e($ride->driver->email ?? 'N/A'); ?>

                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo e($ride->service->name ?? 'N/A'); ?></td>
                            <td>
                                <span class="badge badge-<?php echo e($ridestatuscolorClasses[ucfirst($ride->ride_status?->name)] ?? 'completed'); ?>">
                                    <?php echo e($ride->ride_status->name ?? 'Pending'); ?>

                                </span>
                            </td>
                            <td><?php echo e(getDefaultCurrency()->symbol); ?><?php echo e(number_format($ride->total, 2)); ?></td>
                            <td><?php echo e($ride->created_at->format('Y-m-d h:i:s A')); ?></td>
                            <td>
                                <a href="<?php echo e(route('front.cab.ride.show', $ride->id)); ?>" class="action-icon">
                                    <i class="ri-eye-line"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7">
                                <div class="dashboard-no-data">
                                    <svg>
                                        <use xlink:href="<?php echo e(asset('images/dashboard/front/no-ride.svg#noRide')); ?>"></use>
                                    </svg>
                                    <h6><?php echo e(__('taxido::front.no_rides')); ?></h6>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination-main">
            <ul class="pagination-box">
                <?php echo e($rides->links()); ?>

            </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('taxido::front.account.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/front/account/history.blade.php ENDPATH**/ ?>