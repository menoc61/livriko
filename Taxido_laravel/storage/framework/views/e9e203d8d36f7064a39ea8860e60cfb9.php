<?php use \Modules\Taxido\Models\WithdrawRequest; ?>
<?php use \Modules\Taxido\Models\DriverWallet; ?>
<?php use \Modules\Taxido\Models\Driver; ?>
<?php use \App\Enums\RoleEnum; ?>
<?php use \Modules\Taxido\Enums\RoleEnum as TaxidoRoleEnum; ?>
<?php
$roleName = getCurrentRoleName();
if (getCurrentRoleName() == TaxidoRoleEnum::DRIVER) {
$driver = Driver::where('id', getCurrentUserId())->first();
}
$dateRange = getStartAndEndDate(request('sort'), request('start'), request('end'));
$start_date = $dateRange['start'] ?? null;
$end_date = $dateRange['end'] ?? null;
?>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('fleet_manager.index')): ?>
<?php if($roleName  != TaxidoRoleEnum::FLEET_MANAGER && $roleName  != TaxidoRoleEnum::DRIVER): ?>
    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-4 col-sm-6 total-rides">
            <a href="<?php echo e(route('admin.fleet-manager.index')); ?>">
                <div class="card">
                    <span class="bg-primary"></span>
                    <span class="bg-primary"></span>
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h4><?php echo e(getTotalFleetManagers($start_date, $end_date)); ?></h4>
                                <h6><?php echo e(__('taxido::static.widget.fleet_managers_info')); ?></h6>
                                <div class="d-flex">
                                    <?php if(getTotalRidersPercentage($start_date, $end_date)['status'] == 'decrease'): ?>
                                        <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-down.svg')); ?>"
                                            alt="">
                                        <p class="text-danger me-2">
                                        <?php else: ?>
                                            <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-up.svg')); ?>"
                                                alt="">
                                        <p class="text-primary me-2">
                                    <?php endif; ?>
                                    <?php echo e(getTotalRidersPercentage($start_date, $end_date)['percentage']); ?></p>

                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="ride-icon bg-primary">
                                    <img src="<?php echo e(asset('images/dashboard/riders/car.svg')); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
    </div>
<?php endif; ?>
<?php endif; ?>

<?php if($roleName  != TaxidoRoleEnum::DRIVER): ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vehicle_info.index')): ?>
    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-4 col-sm-6 total-rides">
            <a href="<?php echo e(route('admin.vehicle-info.verified')); ?>">
                <div class="card">
                    <span class="bg-warning"></span>
                    <span class="bg-warning"></span>
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h4><?php echo e(getFleetVehicles($start_date, $end_date, true)); ?></h4>
                                <h6><?php echo e(__('taxido::static.widget.fleet_vehicle_type')); ?></h6>
                                <div class="d-flex">
                                    <?php if(getTotalDriversPercentage($start_date, $end_date, true)['status'] == 'decrease'): ?>
                                        <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-down.svg')); ?>"
                                            alt="">
                                        <p class="text-danger me-2">
                                        <?php else: ?>
                                            <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-up.svg')); ?>"
                                                alt="">
                                        <p class="text-primary me-2">
                                    <?php endif; ?>
                                    <?php echo e(getTotalDriversPercentage($start_date, $end_date, true)['percentage']); ?></p>

                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="ride-icon bg-warning">
                                    <img src="<?php echo e(asset('images/dashboard/riders/user.svg')); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
    </div>
<?php endif; ?>
<?php endif; ?>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dispatcher.index')): ?>
    <?php if($roleName != TaxidoRoleEnum::DISPATCHER): ?>
    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-4 col-sm-6 total-rides">
        <a href="<?php echo e(route('admin.dispatcher.index')); ?>">
            <div class="card">
                <span class="bg-tertiary"></span>
                <span class="bg-tertiary"></span>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <h4><?php echo e(getTotalDispatchers($start_date, $end_date, false)); ?></h4>
                            <h6><?php echo e(__('taxido::static.widget.dispatcher')); ?></h6>
                            <div class="d-flex">
                                <?php if(getTotalDriversPercentage($start_date, $end_date, false)['status'] == 'decrease'): ?>
                                    <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-down.svg')); ?>"
                                        alt="">
                                    <p class="text-danger me-2">
                                    <?php else: ?>
                                        <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-up.svg')); ?>"
                                            alt="">
                                    <p class="text-primary me-2">
                                <?php endif; ?>
                                <?php echo e(getTotalDriversPercentage($start_date, $end_date, false)['percentage']); ?></p>

                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="ride-icon bg-tertiary">
                                <img src="<?php echo e(asset('images/dashboard/riders/user.svg')); ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php endif; ?>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('peak_zone.index')): ?>
<!-- Peak Zone -->
<div class="col-xxl-3 col-xl-4 col-lg-6 col-md-4 col-sm-6 total-rides">
    <a href="<?php echo e(route('admin.peakZone.index')); ?>">
        <div class="card">
            <span class="bg-light"></span>
            <span class="bg-light"></span>
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h4><?php echo e(getPeakZones($start_date, $end_date)); ?></h4>
                        <h6><?php echo e(__('taxido::static.widget.peak_zone')); ?></h6>
                        <div class="d-flex">
                            <?php if(getTotalRidesPercentage($start_date, $end_date)['status'] == 'decrease'): ?>
                            <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-down.svg')); ?>"
                                alt="">
                            <p class="text-danger me-2">
                                <?php else: ?>
                                <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-up.svg')); ?>"
                                    alt="">
                            <p class="text-primary me-2">
                                <?php endif; ?>
                                <?php echo e(getTotalRidesPercentage($start_date, $end_date)['percentage']); ?>

                            </p>

                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="ride-icon bg-light">
                            <img src="<?php echo e(asset('images/dashboard/riders/ride.svg')); ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
<?php endif; ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/admin/widgets/total-fleet-managers.blade.php ENDPATH**/ ?>