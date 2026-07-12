<?php use \Modules\Taxido\Models\WithdrawRequest; ?>
<?php use \Modules\Taxido\Models\DriverWallet; ?>
<?php use \Modules\Taxido\Models\Driver; ?>
<?php use \App\Enums\RoleEnum; ?>
<?php use \Modules\Taxido\Enums\RoleEnum as TaxidoRoleEnum; ?>
<?php

    $roleName = getCurrentRoleName();
    if ($roleName == TaxidoRoleEnum::DRIVER) {
        $driver = Driver::where('id', getCurrentUserId())->first();
    }
    $dateRange = getStartAndEndDate(request('sort'), request('start'), request('end'));
    $start_date = $dateRange['start'] ?? null;
    $end_date = $dateRange['end'] ?? null;
?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('rider.index')): ?>
        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-4 col-sm-6 total-rides">
            <a href="<?php echo e(route('admin.rider.index')); ?>">
                <div class="card">
                    <span class="bg-primary"></span>
                    <span class="bg-primary"></span>
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h4><?php echo e(getTotalRiders($start_date, $end_date)); ?></h4>
                                <h6><?php echo e(__('taxido::static.widget.total_riders')); ?></h6>
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
<?php if($roleName != TaxidoRoleEnum::DRIVER): ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('driver.index')): ?>

        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-4 col-sm-6 total-rides">
            <a href="<?php echo e(route('admin.driver.index')); ?>">

                <div class="card">
                    <span class="bg-warning"></span>
                    <span class="bg-warning"></span>
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h4><?php echo e(getTotalDrivers($start_date, $end_date, true)); ?></h4>
                                <h6><?php echo e(__('taxido::static.widget.total_verified_drivers')); ?></h6>
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
        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-4 col-sm-6 total-rides">
            <a href="<?php echo e(route('admin.driver.unverified-drivers')); ?>">

                <div class="card">
                    <span class="bg-tertiary"></span>
                    <span class="bg-tertiary"></span>
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h4><?php echo e(getTotalDrivers($start_date, $end_date, false)); ?></h4>
                                <h6><?php echo e(__('taxido::static.widget.total_unverified_drivers')); ?></h6>
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

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ride.index')): ?>
    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-4 col-sm-6 total-rides">
        <a href="<?php echo e(route('admin.ride.index')); ?>">

            <div class="card">
                <span class="bg-light"></span>
                <span class="bg-light"></span>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <h4><?php echo e(getTotalRides($start_date, $end_date)); ?></h4>
                            <h6><?php echo e(__('taxido::static.widget.total_rides')); ?></h6>
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
                                <?php echo e(getTotalRidesPercentage($start_date, $end_date)['percentage']); ?></p>

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
    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-4 col-sm-6 total-rides">
        <div class="card">
            <span class="bg-light"></span>
            <span class="bg-light"></span>
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h4>
                            <?php echo e(formatCurrency(getTotalRidesEarnings($start_date, $end_date))); ?>

                        </h4>

                        <h6><?php echo e(__('taxido::static.widget.revenue')); ?></h6>
                        <div class="d-flex">
                            <?php if(getTotalRidesEarningsPercentage($start_date, $end_date)['status'] == 'decrease'): ?>
                                <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-down.svg')); ?>"
                                    alt="">
                                <p class="text-danger me-2">
                                <?php else: ?>
                                    <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-up.svg')); ?>"
                                        alt="">
                                <p class="text-primary me-2">
                            <?php endif; ?>
                            <?php echo e(getTotalRidesEarningsPercentage($start_date, $end_date)['percentage']); ?></p>

                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="ride-icon bg-light">
                            <img src="<?php echo e(asset('images/dashboard/riders/revenue.svg')); ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-4 col-sm-6 total-rides">
        <div class="card">
            <span class="bg-tertiary"></span>
            <span class="bg-tertiary"></span>
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h4>
                            <?php echo e(formatCurrency(getTotalRidesEarnings($start_date, $end_date, 'cash'))); ?>

                        </h4>

                        <h6><?php echo e(__('taxido::static.widget.offline_payment')); ?></h6>
                        <div class="d-flex">
                            <?php if(getTotalRidesEarningsPercentage($start_date, $end_date, 'cash')['status'] == 'decrease'): ?>
                                <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-down.svg')); ?>"
                                    alt="">
                                <p class="text-danger me-2">
                                <?php else: ?>
                                    <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-up.svg')); ?>"
                                        alt="">
                                <p class="text-primary me-2">
                            <?php endif; ?>
                            <?php echo e(getTotalRidesEarningsPercentage($start_date, $end_date, 'cash')['percentage']); ?></p>

                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="ride-icon bg-tertiary">
                            <img src="<?php echo e(asset('images/dashboard/riders/offline-payment.svg')); ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-4 col-sm-6 total-rides">

        <div class="card">
            <span class="bg-warning"></span>
            <span class="bg-warning"></span>
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h4>
                        <?php echo e(formatCurrency(getTotalRidesEarnings($start_date, $end_date, 'online'))); ?>


                        </h4>

                        <h6><?php echo e(__('taxido::static.widget.online_payment')); ?></h6>
                        <div class="d-flex">
                            <?php if(getTotalRidesEarningsPercentage($start_date, $end_date, 'online')['status'] == 'decrease'): ?>
                                <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-down.svg')); ?>"
                                    alt="">
                                <p class="text-danger me-2">
                                <?php else: ?>
                                    <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-up.svg')); ?>"
                                        alt="">
                                <p class="text-primary me-2">
                            <?php endif; ?>
                            <?php echo e(getTotalRidesEarningsPercentage($start_date, $end_date, 'online')['percentage']); ?></p>

                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="ride-icon bg-warning">
                            <img src="<?php echo e(asset('images/dashboard/riders/online.svg')); ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if($roleName != TaxidoRoleEnum::DRIVER): ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('withdraw_request.index')): ?>
    <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-4 col-sm-6 total-rides">
        <a href="<?php echo e(route('admin.withdraw-request.index')); ?>">

            <div class="card">
                <span class="bg-primary"></span>
                <span class="bg-primary"></span>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <h4>
                                <?php echo e(formatCurrency(getTotalWithdrawals($start_date, $end_date))); ?>

                            </h4>
                            <h6><?php echo e(__('taxido::static.widget.withdraw_request')); ?></h6>
                            <div class="d-flex">
                                <?php if(getTotalWithdrawRequestsPercentage($start_date, $end_date)['status'] == 'decrease'): ?>
                                    <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-down.svg')); ?>"
                                        alt="">
                                    <p class="text-danger me-2">
                                    <?php else: ?>
                                        <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-up.svg')); ?>"
                                            alt="">
                                    <p class="text-primary me-2">
                                <?php endif; ?>
                                <?php echo e(getTotalWithdrawRequestsPercentage($start_date, $end_date)['percentage']); ?></p>

                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="ride-icon bg-primary">
                                <img src="<?php echo e(asset('images/dashboard/riders/money.svg')); ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
<?php endif; ?>
<?php endif; ?>

<?php if(getCurrentRoleName() == TaxidoRoleEnum::FLEET_MANAGER): ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('fleet_wallet.index')): ?>
        <div class="col-xxl-3 col-sm-6 total-rides">
            <a href="<?php echo e(route('admin.fleet-wallet.index')); ?>">
                <div class="card">
                    <span class="bg-tertiary"></span>
                    <span class="bg-tertiary"></span>
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h4>
                                    <?php echo e(getDefaultCurrency()?->symbol); ?><?php echo e(number_format(getFleetWalletBalance(getCurrentUserId(), $start_date, $end_date), 2)); ?>

                                </h4>

                                <h6><?php echo e(__('taxido::static.widget.Wallet_balance')); ?></h6>
                                <div class="d-flex">
                                    <?php if(getTotalWalletsPercentage($start_date, $end_date)['status'] == 'decrease'): ?>
                                        <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-down.svg')); ?>"
                                            alt="">
                                        <p class="text-danger me-2">
                                        <?php else: ?>
                                            <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-up.svg')); ?>"
                                                alt="">
                                        <p class="text-primary me-2">
                                    <?php endif; ?>
                                    <?php echo e(getTotalWalletsPercentage($start_date, $end_date)['percentage']); ?></p>

                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="ride-icon bg-tertiary">
                                    <img src="<?php echo e(asset('images/dashboard/riders/wallet.svg')); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php if(getCurrentRoleName() == TaxidoRoleEnum::DRIVER): ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('driver_wallet.index')): ?>
        <div class="col-xxl-3 col-sm-6 total-rides">
            <a href="<?php echo e(route('admin.driver-wallet.index')); ?>">
                <div class="card">
                    <span class="bg-tertiary"></span>
                    <span class="bg-tertiary"></span>
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h4>
                                    <?php echo e(getDefaultCurrency()?->symbol); ?><?php echo e(number_format(getDriverWalletBalance(getCurrentUserId(), $start_date, $end_date), 2)); ?>

                                </h4>

                                <h6><?php echo e(__('taxido::static.widget.Wallet_balance')); ?></h6>
                                <div class="d-flex">
                                    <?php if(getTotalWalletsPercentage($start_date, $end_date)['status'] == 'decrease'): ?>
                                        <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-down.svg')); ?>"
                                            alt="">
                                        <p class="text-danger me-2">
                                        <?php else: ?>
                                            <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-up.svg')); ?>"
                                                alt="">
                                        <p class="text-primary me-2">
                                    <?php endif; ?>
                                    <?php echo e(getTotalWalletsPercentage($start_date, $end_date)['percentage']); ?></p>

                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="ride-icon bg-tertiary">
                                    <img src="<?php echo e(asset('images/dashboard/riders/wallet.svg')); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('driver_review.index')): ?>
        <div class="col-xxl-3 col-sm-6 total-rides">
            <a href="<?php echo e(route('admin.driver-review.index')); ?>">
                <div class="card">
                    <span class="bg-primary"></span>
                    <span class="bg-primary"></span>
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h4>
                                    <?php echo e(getDriverReviewsCount(getCurrentUserId(), $start_date, $end_date)); ?>

                                </h4>

                                <h6><?php echo e(__('taxido::static.widget.reviews')); ?></h6>
                                <div class="d-flex">
                                    <?php if(getTotalReviewsPercentage($start_date, $end_date)['status'] == 'decrease'): ?>
                                        <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-down.svg')); ?>"
                                            alt="">
                                        <p class="text-danger me-2">
                                        <?php else: ?>
                                            <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-up.svg')); ?>"
                                                alt="">
                                        <p class="text-primary me-2">
                                    <?php endif; ?>
                                    <?php echo e(getTotalReviewsPercentage($start_date, $end_date)['percentage']); ?></p>

                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="ride-icon bg-primary">
                                    <img src="<?php echo e(asset('images/dashboard/riders/review.svg')); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('driver_document.index')): ?>
        <div class="col-xxl-3 col-sm-6 total-rides">
            <a href="<?php echo e(route('admin.driver-document.index')); ?>">
                <div class="card">
                    <span class="bg-warning"></span>
                    <span class="bg-warning"></span>
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h4>
                                    <?php echo e(getDriverDocumentsCount(getCurrentUserId(), $start_date, $end_date)); ?>

                                </h4>

                                <h6><?php echo e(__('taxido::static.widget.documents')); ?></h6>
                                <div class="d-flex">
                                    <?php if(getTotalDocumentsPercentage($start_date, $end_date)['status'] == 'decrease'): ?>
                                        <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-down.svg')); ?>"
                                            alt="">
                                        <p class="text-danger me-2">
                                        <?php else: ?>
                                            <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-up.svg')); ?>"
                                                alt="">
                                        <p class="text-primary me-2">
                                    <?php endif; ?>
                                    <?php echo e(getTotalDocumentsPercentage($start_date, $end_date)['percentage']); ?></p>

                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="ride-icon bg-warning">
                                    <img src="<?php echo e(asset('images/dashboard/riders/document.svg')); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/admin/widgets/statistics.blade.php ENDPATH**/ ?>