<?php
    $settings = getSettings();
    $announcement = $settings['announcement']['admin'] ?? null;
    $locale = app()->getLocale();
    $text = $announcement['text'][$locale] ?? $announcement['text']['en'] ?? '';
    $buttonText = $announcement['button_text'][$locale] ?? $announcement['button_text']['en'] ?? '';
?>

<?php if($announcement && $announcement['status']): ?>
<div class="sub-header">
    <h6 class="offer-text"><?php echo e($text); ?>

        <?php if(isset($announcement['link']) && $announcement['link'] && $buttonText): ?>
        <a href="<?php echo e($announcement['link']); ?>" class="btn" target="_blank"><?php echo e($buttonText); ?></a>
        <?php endif; ?>
    </h6>
</div>
<?php endif; ?>


<!-- Page Header Start-->
<div class="page-main-header">
    <div class="main-header row">
        <div class="main-header-left d-lg-none d-flex">
            <div
                class="d-flex align-items-center flex-lg-row flex-row-reverse justify-content-lg-between justify-content-end gap-md-3 gap-2">
                <div class="logo-wrapper">
                    <a href="<?php echo e(route('admin.dashboard.index')); ?>">
                        <?php if(isset(getSettings()['general']['light_logo_image'])): ?>
                        <img src="<?php echo e(getSettings()['general']['light_logo_image']?->original_url); ?>" alt="user"
                            class="light-mode">
                        <img src="<?php echo e(getSettings()['general']['dark_logo_image']?->original_url); ?>" alt="user"
                            class="dark-mode">
                        <?php else: ?>
                        <img src="<?php echo e(asset('images/logo.svg')); ?>" alt="user">
                        <?php endif; ?>
                    </a>
                </div>
                <a href="javascript:void(0)" class="toggle">
                    <img src="<?php echo e(asset('images/svg/toggle.svg')); ?>" class="sidebar-toggle" alt="">
                </a>
            </div>
        </div>
        <div class="nav-left w-auto d-lg-block d-none">
            <ul class="nav-menus">
                <li class="onhover-dropdown">
                    <div class="quick-dropdown-box">
                        <div class="d-flex gap-1 align-items-center new-btn custom-padding">
                            <span><?php echo e(__('static.quick_links')); ?></span>
                            <i class="ri-add-line add"></i>
                        </div>
                        <div class="onhover-show-div">
                            <div class="dropdown-title">
                                <h4><?php echo e(__('static.quick_links')); ?></h4>
                            </div>
                            <?php
                            $quickLinks = collect(get_quick_links())->filter(function ($link) {
                            return !isset($link['permission']) || auth()->user()->can($link['permission']);
                            })?->toArray() ?? [];
                            ?>
                            <ul class="h-custom-scrollbar dropdown-list">
                                <?php $__empty_1 = true; $__currentLoopData = $quickLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li>
                                    <a href="<?php echo e(route($link['route'])); ?>">
                                        <div class="svg-box">
                                            <i class="<?php echo e($link['icon']); ?>"></i>
                                        </div>
                                        <span><?php echo e(__($link['label_key'])); ?></span>
                                    </a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li class="no-notifications">
                                    <div class="media"></div>
                                </li>
                                <?php endif; ?>
                            </ul>
                            <?php if(!count($quickLinks)): ?>
                            <div class="no-data mt-3 mb-3">
                                <img src="<?php echo e(url('/images/no-data.png')); ?>" alt="">
                                <h6 class="mt-2"><?php echo e(__('static.quick_links_not_found')); ?></h6>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="nav-right col">
            <ul class="nav-menus">
                <li class="d-flex onhover-dropdown">
                    <a href="<?php echo e(route('admin.clear.cache')); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom"
                         data-bs-title="Clear Cache">
                        <i class="ri-brush-line"></i>
                    </a>
                </li>

                <li class="onhover-dropdown">
                    <a href="<?php echo e(route('home')); ?>" target="_blank" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        data-bs-title="Browse Frontend">
                        <i class="ri-global-line"></i>
                    </a>
                </li>
                <li class="onhover-dropdown">
                    <a class="txt-dark" href="javascript:void(0)">
                        <h6 class="mb-0 text-dark"><?php echo e(strtoupper(Session::get('locale', 'en'))); ?></h6>
                    </a>
                    <ul class="language-dropdown onhover-show-div p-20  language-dropdown-hover">
                        <?php $__empty_1 = true; $__currentLoopData = getLanguages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li>
                            <a href="<?php echo e(route('admin.lang', @$lang?->locale)); ?>"
                                data-lng="<?php echo e(@$lang?->locale); ?>"><img class="active-icon"
                                    src="<?php echo e(@$lang?->flag ?? asset('images/flags/default.png')); ?>"><span><?php echo e(@$lang?->name); ?>

                                    (<?php echo e(@$lang?->locale); ?>)
                                </span></a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li>
                            <a href="<?php echo e(route('admin.lang', 'en')); ?>" data-lng="en"><img class="active-icon"
                                    src="<?php echo e(asset('images/flags/US.png')); ?>"><a href="javascript:void(0)"
                                    data-lng="en"><?php echo e(__('static.english')); ?></a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="dark-light-mode onhover-dropdown" id="dark-mode">
                    <i class="ri-moon-line  light-mode"></i>
                    <i class="ri-sun-line dark-mode"></i>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sos.index')): ?>
                <li class="sos-alert onhover-dropdown" id="sos-alert">
                    <span class="sos-text">SOS</span>

                    <?php
                    $sosNotifications = auth()
                    ?->user()
                    ?->notifications()
                    ?->where('type', 'Modules\Taxido\Notifications\SOSAlertNotification')
                    ?->whereNull('read_at')
                    ?->latest()
                    ?->take(5)
                    ?->get();
                    ?>
                    <?php if($sosNotifications?->count() > 0): ?>
                    <span class="badge badge-danger"><?php echo e($sosNotifications->count()); ?></span>
                    <?php endif; ?>

                    <div class="notification-dropdown onhover-show-div">
                        <h5 class="dropdown-title"><?php echo e(__('static.recent_sos_alerts')); ?></h5>
                        <ul class="notification-box custom-scrollbar" id="sos-notification-list">
                            <?php $__empty_1 = true; $__currentLoopData = $sosNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li data-id="<?php echo e($notification->id); ?>">
                                <div class="media">
                                    <div class="d-flex align-items-start gap-2">
                                        <div class="media-img bg-white">
                                            <i class="ri-alert-line text-danger"></i>
                                        </div>
                                        <div class="media-content">
                                            <div>
                                                <a href="javascript:void(0)" class="text-dark">
                                                    SOS Alert:
                                                    <?php echo e($notification->data['message'] ?? 'Location: ' . $notification->data['coordinates']['lat'] . ', ' . $notification->data['coordinates']['lng']); ?>

                                                </a>
                                                <p><?php echo e($notification->created_at->diffForHumans()); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="no-notifications">
                                <div class="media">
                                    <div class="no-data mt-3">
                                        <img src="<?php echo e(url('/images/no-data.png')); ?>" alt="">
                                        <h6 class="mt-2"><?php echo e(__('static.no_sos_alert_found')); ?></h6>
                                    </div>
                                </div>
                            </li>
                            <?php endif; ?>
                        </ul>
                        <?php if($sosNotifications->count()): ?>
                            <?php if(Route::has('admin.sos-alerts.index')): ?>
                            <div class="dropdown-footer">
                                <a class="btn btn-solid view-chat w-100"
                                    href="<?php echo e(route('admin.sos-alerts.index')); ?>"><?php echo e(__('static.all_sos_alerts')); ?></a>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </li>
                <?php endif; ?>

                <li class="onhover-dropdown">
                    <div class="notify-bell">
                        <i class="ri-notification-2-line"></i>
                    </div>
                    <?php
                    $notifications = auth()
                    ?->user()
                    ?->notifications()
                    ?->whereNull('read_at')
                    ->where('type', '!=', 'Modules\Taxido\Notifications\SOSAlertNotification')
                    ->latest()
                    ->take(5)
                    ->get();
                    ?>
                    <?php if($notifications?->count() > 0): ?>
                    <span class="badge badge-secondary"><?php echo e($notifications->count()); ?></span>
                    <?php endif; ?>
                    <div class="notification-dropdown onhover-show-div">
                        <h5 class="dropdown-title"><?php echo e(__('static.recent_notifications')); ?></h5>
                        <ul class="notification-box custom-scrollbar" id="notification-list">
                            <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li data-id="<?php echo e($notification->id); ?>">
                                <div class="media">
                                    <div class="d-flex align-items-start gap-2">
                                        <div class="media-img bg-white">
                                            <?php if($notification->module == 'ticket'): ?>
                                            <i class="ri-ticket-2-line text-primary"></i>
                                            <?php else: ?>
                                            <i class="ri-notification-2-line text-primary"></i>
                                            <?php endif; ?>
                                        </div>
                                        <div class="media-content">
                                            <div>
                                                <a href="javascript:void(0)"
                                                    class="text-dark"><?php echo e($notification->data['message'] ?? null); ?></a>
                                                <p><?php echo e($notification->created_at->diffForHumans()); ?></p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="no-notifications">
                                <div class="media">
                                    <div class="no-data mt-3">
                                        <img src="<?php echo e(url('/images/no-data.png')); ?>" alt="">
                                        <h6 class="mt-2"><?php echo e(__('static.no_notification_found')); ?></h6>
                                    </div>
                            </li>
                            <?php endif; ?>
                        </ul>
                        <?php if($notifications->count()): ?>
                        <div class="dropdown-footer">
                            <a class="btn btn-solid view-chat w-100"
                                href="<?php echo e(route('admin.notification.index')); ?>"><?php echo e(__('static.all_notifications')); ?></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </li>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('chat.index')): ?>
                <?php
                    $chatRepo = app(\App\Repositories\Admin\ChatRepository::class);
                    $totalUnread = $chatRepo->getTotalUnreadCount();
                    $recentChats = $chatRepo->getRecentChats();
                ?>
                <li class="onhover-dropdown" id="chat-notification">
                    <i class="ri-chat-3-line"></i>
                    <span class="badge badge-primary" id="chat-notification-count" style="<?php echo e($totalUnread > 0 ? '' : 'display: none;'); ?>"><?php echo e($totalUnread); ?></span>
                    <div class="notification-dropdown onhover-show-div">
                        <h5 class="dropdown-title"><?php echo e(__('static.chats.recent_chats')); ?></h5>
                        <ul class="notification-box custom-scrollbar" id="chat-notification-list">
                            <?php $__empty_1 = true; $__currentLoopData = $recentChats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li>
                                    <a href="<?php echo e(route('admin.chat.index')); ?>?room_id=<?php echo e($chat['chat_id']); ?>">
                                        <div class="media">
                                            <?php if($chat['image']): ?>
                                                <img class="img-fluid rounded-circle me-3" src="<?php echo e($chat['image']); ?>" style="width: 35px; height: 35px;">
                                            <?php else: ?>
                                                <div class="user-round me-3" style="width: 35px; height: 35px; background: #eee; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                    <h6 class="mb-0" style="font-size: 12px;"><?php echo e(strtoupper($chat['name'][0])); ?></h6>
                                                </div>
                                            <?php endif; ?>
                                            <div class="media-body">
                                                <h6 class="mb-0"><?php echo e($chat['name']); ?></h6>
                                                <p class="mb-0" style="font-size: 11px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;">
                                                    <?php echo e($chat['last_message']['message'] ?? 'New Message'); ?>

                                                </p>
                                            </div>
                                            <?php if($chat['unread_count'] > 0): ?>
                                                <span class="badge bg-primary ms-auto"><?php echo e($chat['unread_count']); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li class="no-notifications">
                                    <div class="media">
                                        <div class="no-data mt-3">
                                            <img src="<?php echo e(asset('images/no-user.png')); ?>" alt="">
                                            <h6 class="mt-2 text-center"><?php echo e(__('static.chats.no_chats_found')); ?></h6>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <?php if(count($recentChats) > 0): ?>
                        <div class="dropdown-footer">
                            <a class="btn btn-solid view-chat w-100" href="<?php echo e(route('admin.chat.index')); ?>"><?php echo e(__('static.chats.view_all_chats')); ?></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </li>
                <?php endif; ?>

                <li class="onhover-dropdown">
                    <div class="media align-items-center profile-box">
                        <div class="profile-img">
                            <?php if(Auth::user()->profile_image): ?>
                            <img src="<?php echo e(Auth::user()->profile_image->original_url); ?>">
                            <?php else: ?>
                            <div class="user-round">
                                <h6><?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?></h6>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="d-lg-block d-none">
                            <h6><?php echo e(Auth::user()->name); ?></h6>
                            <span class="d-md-block d-none"><?php echo e(Auth::user()->getRoleNames()->first()); ?></span>
                        </div>
                    </div>
                    <div class="profile-dropdown onhover-show-div profile-dropdown-hover custom-scrollbar">
                        <ul>
                            <?php if(Route::has('admin.account.profile')): ?>
                            <li>
                                <a href="<?php echo e(route('admin.account.profile')); ?>">
                                    <i class="ri-user-line"></i>
                                    <span><?php echo e(__('static.edit_profile')); ?></span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?php echo e(route('admin.logout')); ?>"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="ri-logout-box-line"></i>
                                    <span><?php echo e(__('static.logout')); ?></span>
                                </a>
                                <form action="<?php echo e(route('admin.logout')); ?>" method="POST" class="d-none"
                                    id="logout-form">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Header Ends -->
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/layouts/partials/header.blade.php ENDPATH**/ ?>