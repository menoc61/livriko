<?php $__env->startSection('content'); ?>
    <section class="user-dashboard-section section-b-space">
        <div class="container">
            <div class="row">
                <?php if ($__env->exists('taxido::front.account.sidebar')) echo $__env->make('taxido::front.account.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <div class="col-xxl-9 col-xl-8 col-lg-7">
                    <div class="right-details-box">
                      <button class="btn-show-menu btn d-xl-none">Show menu</button>
                        <?php echo $__env->yieldContent('detailBox'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        $(".btn-show-menu").click(function() {
            $(".left-profile-box, .profile-bg-overlay").addClass("show");
        });

        $(".sidebar-close-btn,.profile-bg-overlay").click(function(){
            $(".left-profile-box,.profile-bg-overlay").removeClass("show");
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('front.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/front/account/master.blade.php ENDPATH**/ ?>