<div class="col-xxl-3 col-xl-4 col-lg-5">
    <div class="left-profile-box">
        <div class="close-box btn d-lg-none">
            <span>Menu</span>
            <button class="btn sidebar-close-btn">
                <i class="ri-close-line"></i>
            </button>
        </div>
          <div class="profile-box">
            <div class="profile-bg">
                <img src="<?php echo e(asset('images/profile-bg.png')); ?>" class="img-fluid" />
            </div>

            <div class="profile-img position-relative">
                <?php if(Auth::user()?->profile_image): ?>
                    <img src="<?php echo e(Auth::user()?->profile_image?->original_url); ?>" alt="" class="img-fluid user-img">
                <?php else: ?>

                    <div class="initial-letter">
                        <span><?php echo e(strtoupper(Auth::user()?->name[0] ?? 'N/A')); ?></span>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('front.cab.updateProfileImage')); ?>" method="POST" enctype="multipart/form-data" id="profileImageForm">
                     <?php echo csrf_field(); ?>
                  <input type="file" name="profile_image" id="profileImageInput"
                        accept=".jpg, .png, .jpeg" style="display: none;"
                        onchange="document.getElementById('profileImageForm').submit();">

                  <label for="profileImageInput" class="icon btn position-absolute">
                      <svg>
                          <use xlink:href="<?php echo e(asset('images/svg/camera.svg#camera')); ?>"></use>
                      </svg>
                  </label>
              </form>
            </div>
            <div class="profile-name">
                <h4><?php echo e(Auth::user()?->name); ?></h4>
                <h5><?php echo e(Auth::user()?->email); ?></h5>
            </div>
        </div>

        <ul class="dashboard-option">
            <li>
                <a href="<?php echo e(route('front.cab.dashboard.index')); ?>"
                    class="<?php echo e(request()->routeIs('front.cab.dashboard.index') ? 'active' : ''); ?>">
                    <i class="ri-home-5-line"></i> <?php echo e(__('taxido::front.dashboard')); ?>

                </a>
            </li>
            <li>
                <a href="<?php echo e(route('front.cab.notification.index')); ?>"
                    class="<?php echo e(request()->routeIs('front.cab.notification.index') ? 'active' : ''); ?>">
                    <i class="ri-notification-line"></i> <?php echo e(__('taxido::front.notification')); ?>

                </a>
            </li>
            <li>
                <a href="<?php echo e(route('front.cab.history.index')); ?>"
                    class="<?php echo e(request()->routeIs('front.cab.history.index') ? 'active' : ''); ?>">
                    <i class="ri-history-line"></i> <?php echo e(__('taxido::front.history')); ?>

                </a>
            </li>
            <li>
                <a href="<?php echo e(route('front.cab.wallet.index')); ?>"
                    class="<?php echo e(request()->routeIs('front.cab.wallet.index') ? 'active' : ''); ?>">
                    <i class="ri-wallet-line"></i> <?php echo e(__('taxido::front.my_wallet')); ?>

                </a>
            </li>
            <li>
                <a href="<?php echo e(route('front.cab.location.index')); ?>"
                    class="<?php echo e(request()->routeIs('front.cab.location.index') ? 'active' : ''); ?>">
                    <i class="ri-map-pin-line"></i> <?php echo e(__('taxido::front.saved_location')); ?>

                </a>
            </li>
            <li>
                <a href="<?php echo e(route('front.cab.chat.index')); ?>"
                    class="<?php echo e(request()->routeIs('front.cab.chat.index') ? 'active' : ''); ?>">
                    <i class="ri-customer-service-2-line"></i> <?php echo e(__('taxido::front.support_chat')); ?>

                </a>
            </li>
        </ul>
       <div class="logout-box">
            <form action="<?php echo e(route('front.cab.logout')); ?>" method="POST" id="logoutForm">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn text-danger" id="logoutButton">
                    <i class="ri-logout-box-r-line"></i> <?php echo e(__('taxido::front.log_out')); ?>

                </button>
            </form>
        </div>
    </div>

    <div class="profile-bg-overlay"></div>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
    document.getElementById('logoutForm').addEventListener('submit', function(e) {
        const button = document.getElementById('logoutButton');
        button.disabled = true;
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/front/account/sidebar.blade.php ENDPATH**/ ?>