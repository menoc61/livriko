<?php use \Modules\Ticket\Models\Executive; ?>
<?php
    $dateRange = tx_getDate(request('sort'), request('start_date'), request('end_date'));
    $start_date = $dateRange['start'] ?? null;
    $end_date = $dateRange['end'] ?? null;
    $executiveRatings = getTopExecutives($start_date, $end_date);
?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/vendors/flatpickr.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('title', __('ticket::static.ticket.dashboard')); ?>
<?php $__env->startSection('content'); ?>
    <div class="row support-dashboard">
        <div class="col-12">
            <div class="default-sorting mt-0">
                <div class="support-title sorting mt-0">
                    <h4> <?php echo e(__('ticket::static.dashboard.support_ticket')); ?></h4>
                    <div>

                        <form action="<?php echo e(route('admin.ticket.dashboard')); ?>" method="GET" id="sort-form">
                            <div class="support-title sorting m-0">
                                <div class="select-sorting">
                                    <label for=""><?php echo e(__('ticket::static.dashboard.sort_by')); ?></label>
                                    <div class="select-form">
                                        <select class="select-2 form-control sort" id="sort" name="sort">
                                            <option class="select-placeholder" value="today"
                                                <?php echo e(request('sort') == 'today' ? 'selected' : ''); ?>>
                                                <?php echo e(__('static.today')); ?>

                                            </option>
                                            <option class="select-placeholder" value="this_week"
                                                <?php echo e(request('sort') == 'this_week' ? 'selected' : ''); ?>>
                                                <?php echo e(__('static.this_week')); ?>

                                            </option>
                                            <option class="select-placeholder" value="this_month"
                                                <?php echo e(request('sort') == 'this_month' ? 'selected' : ''); ?>>
                                                <?php echo e(__('static.this_month')); ?>

                                            </option>
                                            <option class="select-placeholder" value="this_year"
                                                <?php echo e(request('sort') == 'this_year' || !request('sort') ? 'selected' : ''); ?>>
                                                <?php echo e(__('static.this_year')); ?>

                                            </option>
                                            <option class="select-placeholder" value="custom"
                                                <?php echo e(request('sort') == 'custom' ? 'selected' : ''); ?>>
                                                <?php echo e(__('static.custom_range')); ?>

                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $startDate = request('start');
                                $endDate = request('end');
                                $selectedRange = $startDate && $endDate ? "$startDate to $endDate" : '';
                            ?>

                            <div class="form-group <?php echo e(request('sort') == 'custom' ? '' : 'd-none'); ?>" id="custom-date-range">
                                <input type="text" class="form-control filter-dropdown" id="start_end_date"
                                    name="start_end_date" placeholder="<?php echo e(__('ticket::static.report.select_date')); ?>"
                                    value="<?php echo e($selectedRange); ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.index')): ?>
            <div class="col-xxl-3 col-sm-6">
                <a class="widget-card" href="<?php echo e(route('admin.user.index')); ?>">
                    <div class="card">
                        <div class="card-body support-bg-img">
                            <div class="widget-content">
                                <div class="support-details">
                                    <span><?php echo e(__('ticket::static.dashboard.total_users')); ?></span>
                                    <h4><?php echo e(tx_getUsersCount()); ?></h4>
                                    <div class="d-flex">
                                        <?php $usersPercentage = tx_getUsersPercentage(); ?>
                                        <?php if($usersPercentage['status'] == 'decrease'): ?>
                                            <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-down.svg')); ?>" alt="">
                                            <p class="text-danger me-2">
                                        <?php elseif($usersPercentage['status'] == 'increase'): ?>
                                            <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-up.svg')); ?>" alt="">
                                            <p class="text-primary me-2">
                                        <?php else: ?>
                                            <p class="text-primary me-2">
                                        <?php endif; ?>
                                        <?php echo e($usersPercentage['percentage']); ?></p>
                                    </div>
                                </div>
                                <div class="widget-round b-primary">
                                    <div class="bg-round">
                                        <svg>
                                            <use xlink:href="<?php echo e(asset('images/dashboard/support/user.svg#user')); ?>">
                                            </use>
                                        </svg>
                                        <svg class="half-circle">
                                            <use xlink:href="<?php echo e(asset('images/dashboard/support/1.svg#support')); ?>">
                                            </use>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket.department.index')): ?>
            <div class="col-xxl-3 col-sm-6">
                <a class="widget-card" href="<?php echo e(route('admin.department.index')); ?>">
                    <div class="card">
                        <div class="card-body support-bg-img">
                            <div class="widget-content">
                                <div class="support-details">
                                    <span><?php echo e(__('ticket::static.dashboard.total_departments')); ?></span>
                                    <h4><?php echo e(tx_getDepartmentsCount()); ?></h4>
                                    <div class="d-flex">
                                        <?php $deptsPercentage = tx_getDepartmentsPercentage(); ?>
                                        <?php if($deptsPercentage['status'] == 'decrease'): ?>
                                            <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-down.svg')); ?>" alt="">
                                            <p class="text-danger me-2">
                                        <?php elseif($deptsPercentage['status'] == 'increase'): ?>
                                            <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-up.svg')); ?>" alt="">
                                            <p class="text-primary me-2">
                                        <?php else: ?>
                                            <p class="text-primary me-2">
                                        <?php endif; ?>
                                        <?php echo e($deptsPercentage['percentage']); ?></p>
                                    </div>
                                </div>
                                <div class="widget-round b-warning">
                                    <div class="bg-round">
                                        <img src="<?php echo e(asset('images/dashboard/support/layout.svg')); ?>" alt="">
                                        <img src="<?php echo e(asset('images/dashboard/support/2.svg')); ?>" class="half-circle"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket.ticket.index')): ?>
            <div class="col-xxl-3 col-sm-6">
                <a class="widget-card" href="<?php echo e(route('admin.ticket.index')); ?>">
                    <div class="card">
                        <div class="card-body support-bg-img">
                            <div class="widget-content">
                                <div class="support-details">
                                    <span><?php echo e(__('ticket::static.dashboard.total_tickets')); ?></span>
                                    <h4><?php echo e(tx_getTicketsCount()); ?></h4>
                                    <div class="d-flex">
                                        <?php $ticketsPercentage = tx_getTicketsPercentage(); ?>
                                        <?php if($ticketsPercentage['status'] == 'decrease'): ?>
                                            <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-down.svg')); ?>" alt="">
                                            <p class="text-danger me-2">
                                        <?php elseif($ticketsPercentage['status'] == 'increase'): ?>
                                            <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-up.svg')); ?>" alt="">
                                            <p class="text-primary me-2">
                                        <?php else: ?>
                                            <p class="text-primary me-2">
                                        <?php endif; ?>
                                        <?php echo e($ticketsPercentage['percentage']); ?></p>
                                    </div>
                                </div>
                                <div class="widget-round b-tertiary">
                                    <div class="bg-round">
                                        <img src="<?php echo e(asset('images/dashboard/support/total.svg')); ?>" alt="">
                                        <img src="<?php echo e(asset('images/dashboard/support/3.svg')); ?>" class="half-circle"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xxl-3 col-sm-6">
                <a class="widget-card" href="<?php echo e(route('admin.ticket.index', ['filter' => 'open'])); ?>">
                    <div class="card">
                        <div class="card-body support-bg-img">
                            <div class="widget-content">
                                <div class="support-details">
                                    <span><?php echo e(__('ticket::static.dashboard.total_open_tickets')); ?></span>
                                    <h4><?php echo e(tx_getOpenTicketsCount()); ?></h4>
                                    <div class="d-flex">
                                        <?php $openTicketsPercentage = tx_getOpenTicketsPercentage(); ?>
                                        <?php if($openTicketsPercentage['status'] == 'decrease'): ?>
                                            <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-down.svg')); ?>" alt="">
                                            <p class="text-danger me-2">
                                        <?php elseif($openTicketsPercentage['status'] == 'increase'): ?>
                                            <img class="me-1" src="<?php echo e(asset('images/dashboard/riders/arrow-up.svg')); ?>" alt="">
                                            <p class="text-primary me-2">
                                        <?php else: ?>
                                            <p class="text-primary me-2">
                                        <?php endif; ?>
                                        <?php echo e($openTicketsPercentage['percentage']); ?></p>
                                    </div>
                                </div>
                                <div class="widget-round b-light">
                                    <div class="bg-round">
                                        <img src="<?php echo e(asset('images/dashboard/support/open.svg')); ?>" alt="">
                                        <img src="<?php echo e(asset('images/dashboard/support/4.svg')); ?>" class="half-circle"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xxl-3 col-sm-6">
                <a class="widget-card" href="<?php echo e(route('admin.ticket.index', ['filter' => 'closed'])); ?>">
                    <div class="card">
                        <div class="card-body support-bg-img">
                            <div class="widget-content">
                                <div class="support-details">
                                    <span><?php echo e(__('ticket::static.dashboard.total_closed_tickets')); ?></span>
                                    <h4><?php echo e(tx_getClosedTicketsCount()); ?></h4>
                                </div>
                                <div class="widget-round b-light">
                                    <div class="bg-round">
                                        <img src="<?php echo e(asset('images/dashboard/support/cancel.svg')); ?>" alt="">
                                        <img src="<?php echo e(asset('images/dashboard/support/4.svg')); ?>" class="half-circle"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xxl-3 col-sm-6">
                <a class="widget-card" href="<?php echo e(route('admin.ticket.index', ['filter' => 'solved'])); ?>">
                    <div class="card">
                        <div class="card-body support-bg-img">
                            <div class="widget-content">
                                <div class="support-details">
                                    <span><?php echo e(__('ticket::static.dashboard.total_solved_tickets')); ?></span>
                                    <h4><?php echo e(tx_getSolvedTicketsCount()); ?></h4>
                                </div>
                                <div class="widget-round b-tertiary">
                                    <div class="bg-round">
                                        <img src="<?php echo e(asset('images/dashboard/support/done.svg')); ?>" alt="">
                                        <img src="<?php echo e(asset('images/dashboard/support/3.svg')); ?>" class="half-circle"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xxl-3 col-sm-6">
                <a class="widget-card" href="<?php echo e(route('admin.ticket.index', ['filter' => 'pending'])); ?>">
                    <div class="card">
                        <div class="card-body support-bg-img">
                            <div class="widget-content">
                                <div class="support-details">
                                    <span><?php echo e(__('ticket::static.dashboard.total_pending_tickets')); ?></span>
                                    <h4><?php echo e(tx_getPendingTicketsCount()); ?></h4>
                                </div>
                                <div class="widget-round b-warning">
                                    <div class="bg-round">
                                        <img src="<?php echo e(asset('images/dashboard/support/pending.svg')); ?>" alt="">
                                        <img src="<?php echo e(asset('images/dashboard/support/2.svg')); ?>" class="half-circle"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xxl-3 col-sm-6">
                <a class="widget-card" href="<?php echo e(route('admin.ticket.index', ['filter' => 'hold'])); ?>">
                    <div class="card">
                        <div class="card-body support-bg-img">
                            <div class="widget-content">
                                <div class="support-details">
                                    <span><?php echo e(__('ticket::static.dashboard.total_hold_tickets')); ?></span>
                                    <h4><?php echo e(tx_getHoldTicketsCount()); ?></h4>
                                </div>
                                <div class="widget-round b-primary">
                                    <div class="bg-round">
                                        <img src="<?php echo e(asset('images/dashboard/support/hand.svg')); ?>" alt="">
                                        <svg class="half-circle">
                                            <use xlink:href="<?php echo e(asset('images/dashboard/support/1.svg#support')); ?>">
                                            </use>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endif; ?>

        <div class="col-xxl-7">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <div>
                            <h5 class="m-0"><?php echo e(__('ticket::static.dashboard.tickets')); ?></h5>
                        </div>
                        <div class="card-header-right-icon">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="tickets-chart">
                        <div id="tickets-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-5">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <div>
                            <h5 class="m-0"><?php echo e(__('ticket::static.dashboard.ratings')); ?></h5>
                        </div>
                        <a href="<?php echo e(route('admin.executive.index')); ?>">
                            <span><?php echo e(__('ticket::static.dashboard.view_all')); ?></span>
                        </a>
                    </div>
                </div>
                <div class="card-body rating-executive p-0">
                    <div class="table-responsive h-custom-scrollbar">
                        <table class="table display">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('ticket::static.dashboard.agent_name')); ?></th>
                                    <th><?php echo e(__('ticket::static.dashboard.rating')); ?></th>
                                    <th><?php echo e(__('ticket::static.dashboard.replied')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $executiveRatings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $executive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php if($executive['profile_image_url']): ?>
                                                    <img src="<?php echo e(asset($executive['profile_image_url'])); ?>"
                                                        alt="" class="img">
                                                <?php else: ?>
                                                    <div class="initial-letter">
                                                        <span><?php echo e(strtoupper($executive['name'][0])); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="flex-grow-1">
                                                    <h5><?php echo e($executive['name']); ?></h5>
                                                    <span><?php echo e($executive['email']); ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="rating">
                                                <img src="<?php echo e(asset('images/dashboard/star.svg')); ?>" alt="">
                                                <span>(<?php echo e(number_format($executive['ratings'], 1)); ?>)</span>
                                            </div>
                                        </td>
                                        <td><?php echo e($executive['tickets_handled']); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr class="table-not-found">
                                        <div class="table-no-data">
                                            <img src="<?php echo e(asset('images/dashboard/data-not-found.svg')); ?>"
                                                alt="data not found" />
                                            <h6 class="text-center">
                                                <?php echo e(__('ticket::static.widget.no_data_available')); ?>

                                            </h6>
                                        </div>
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
                            <h5 class="m-0"><?php echo e(__('ticket::static.dashboard.latest_tickets')); ?></h5>
                        </div>
                        <a href="<?php echo e(route('admin.ticket.index')); ?>">
                            <span><?php echo e(__('ticket::static.dashboard.view_all')); ?></span>
                        </a>
                    </div>
                </div>
                <div class="card-body top-drivers rating-executive latest-tickets p-0">
                    <div class="table-responsive h-custom-scrollbar">
                        <table class="table display">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('ticket::static.dashboard.ticket_id')); ?></th>
                                    <th><?php echo e(__('ticket::static.dashboard.ticket_name')); ?></th>
                                    <th><?php echo e(__('ticket::static.dashboard.ticket_status')); ?></th>
                                    <th><?php echo e(__('ticket::static.dashboard.ticket_subject')); ?></th>
                                    <th><?php echo e(__('ticket::static.dashboard.ticket_created')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = tx_getLatestTickets(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <span class="bg-light-primary">#<?php echo e($item->ticket_number); ?></span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2 user-name">
                                                <?php if($item->user): ?>
                                                    <?php if($item->user->profile_image?->original_url): ?>
                                                        <img src="<?php echo e($item->user->profile_image->original_url); ?>"
                                                            alt="" class="img-fluid" />
                                                    <?php else: ?>
                                                        <div class="initial-letter">
                                                            <?php echo e(strtoupper(substr($item->user->name, 0, 1))); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="user-details">
                                                        <a><?php echo e($item->user->name); ?></a>
                                                        <h6><?php echo e($item->user->email); ?></h6>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="initial-letter">
                                                        <?php echo e(strtoupper(substr($item->name, 0, 1))); ?>

                                                    </div>
                                                    <div class="user-details">
                                                        <a><?php echo e($item->name); ?></a>
                                                        <h6><?php echo e($item->email); ?></h6>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-<?php echo e($item->ticketStatus->color); ?>"><?php echo e($item->ticketStatus->name); ?></span>
                                        </td>
                                        <td><span><?php echo e($item->subject); ?></span></td>
                                        <td><span><?php echo e($item->created_at->diffForHumans()); ?></span></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    

                                    <div class="table-no-data">
                                        <img src="<?php echo e(asset('images/dashboard/data-not-found.svg')); ?>" class="img-fluid"
                                            alt="data not found" />
                                        
                                        <h6 class="text-center"><?php echo e(__('ticket::static.widget.no_data_available')); ?>

                                        </h6>
                                    </div>
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
                            <h5 class="m-0"><?php echo e(__('ticket::static.dashboard.department_tickets')); ?></h5>
                        </div>
                        <div class="card-header-right-icon">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0 departments">
                    <div class="departments-chart">
                        <div id="departments-chart"></div>
                    </div>
                </div>
                <div id="departments-not-found-image" class="no-data-found" style="display:none;">
                    <img src="<?php echo e(asset('images/result-failure-icon.svg')); ?>" alt="No Data" class="img-fluid">
                    <span><?php echo e(__('ticket::static.widget.no_data_available')); ?></span>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/apex-chart.js')); ?>"></script>
    <script src="<?php echo e(asset('js/flatpickr/flatpickr.js')); ?>"></script>
    <script src="<?php echo e(asset('js/flatpickr/rangePlugin.js')); ?>"></script>
    <script>
        (function($) {
            "use strict";

            $(document).ready(function() {

                const filterVal = $('#sort').val();
                const $customDateRange = $("#custom-date-range");
                const $startEndDate = $("#start_end_date");

                if ($startEndDate.length) {
                    flatpickr("#start_end_date", {
                        mode: "range",
                        dateFormat: "m-d-Y",
                        defaultDate: "<?php echo e($selectedRange); ?>",
                        onClose: function (selectedDates, dateStr, instance) {
                            if (selectedDates.length === 2) {
                                const startDate = flatpickr.formatDate(selectedDates[0], "m-d-Y");
                                const endDate = flatpickr.formatDate(selectedDates[1], "m-d-Y");
                                const urlParams = new URLSearchParams(window.location.search);
                                urlParams.set("sort", "custom");
                                urlParams.set("start", startDate);
                                urlParams.set("end", endDate);
                                history.pushState(null, null, `${window.location.pathname}?${urlParams.toString()}`);
                                location.reload();
                            }
                        }
                    });
                }

                $('#sort').on('change', function() {

                    const selectedSort = $(this).val();

                    if (selectedSort === 'custom') {
                        $('#custom-date-range').removeClass('d-none');
                    } else {
                        window.history.replaceState(null, null, location.pathname);
                        $('#custom-date-range').addClass('d-none');
                        const urlParams = new URLSearchParams(window.location.search);
                        urlParams.set('sort', selectedSort);
                        window.location.href = `${window.location.pathname}?${urlParams.toString()}`;
                    }
                });

                const statusData = <?php echo json_encode($statusChart, 15, 512) ?> ?? [];

                if (statusData && statusData.labels && statusData.values) {
                    var statusChartOptions = {
                        series: [{
                            name: "Ticket",
                            data: statusData.values,
                        }],
                        chart: {
                            type: "bar",
                            toolbar: {
                                show: false,
                            },
                            height: 410,
                        },
                        grid: {
                            show: true,
                            strokeDashArray: 3,
                            borderColor: "#6A71854D",
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: "25%",
                                borderRadius: 13,
                                borderRadiusApplication: "end",
                                distributed: true,
                                barHeight: "100%",
                            },
                        },
                        xaxis: {
                            show: true,
                            categories: statusData.labels,
                            labels: {
                                show: true,
                                style: {
                                    fontSize: "14px",
                                    fontWeight: 500,
                                    fontFamily: "Rubik, sans-serif",
                                    colors: "#8D8D8D",
                                },
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            tooltip: {
                                enabled: false,
                            },
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        legend: {
                            show: false,
                        },
                        yaxis: {
                            show: true,
                            tickAmount: 5,
                            showForNullSeries: true,
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                style: {
                                    fontSize: "14px",
                                    fontWeight: 500,
                                    fontFamily: "Rubik, sans-serif",
                                    colors: "#3D434A",
                                },
                            },
                        },
                        colors: ["#199675", "#F39159", "#ECB238", "#47A1E5", "#86909C", "#D94238"],
                        fill: {
                            opacity: 1,
                        },
                    };

                    var statusChart = new ApexCharts(document.querySelector("#tickets-chart"),
                        statusChartOptions);
                    statusChart.render();
                } else {
                    console.log("Error: Invalid status data.");
                }

                const departmentData = <?php echo json_encode($departmentChart, 15, 512) ?> ?? [];

                function areAllValuesZero(values) {
                    return values.every(value => value === 0);
                }

                if (departmentData.values && departmentData.values.length > 0 && !areAllValuesZero(
                        departmentData.values)) {
                    var departmentChartOptions = {
                        chart: {
                            type: 'polarArea',
                            height: 380,
                        },
                        stroke: {
                            colors: ['#fff']
                        },
                        fill: {
                            opacity: 0.8
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        legend: {
                            show: true,
                            position: 'bottom',
                            labels: {
                                colors: '#333',
                            },
                        },
                        series: departmentData.values,
                        labels: departmentData.labels,
                        colors: ['#199675', '#ff5443', '#ffb900', '#ECB238', '#47A1E5', '#86909C'],
                        responsive: [{
                            breakpoint: 991,
                        }],
                    };

                    var departmentChart = new ApexCharts(document.querySelector("#departments-chart"),
                        departmentChartOptions);
                    departmentChart.render();

                    $('#departments-not-found-image').hide();
                } else {
                    $('#departments-chart').hide();
                    $('#departments-not-found-image').show();
                }
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Ticket/resources/views/admin/ticket/dashboard.blade.php ENDPATH**/ ?>