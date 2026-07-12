<?php $__env->startSection('title', __('taxido::front.notifications')); ?>
<?php $__env->startSection('detailBox'); ?>
<div class="dashboard-details-box">
    <div class="dashboard-title">
        <h3><?php echo e(__('taxido::front.notification')); ?></h3>
        <form action="<?php echo e(route('front.cab.notifications.markAsRead')); ?>" method="POST" style="display: inline;">
            <?php echo csrf_field(); ?>
            <a class="btn p-0">
                <i class="ri-check-double-line"></i>
                <?php echo e(__('taxido::front.mark_as_all_read')); ?>

            </a>
        </form>
    </div>
    <ul class="notification-list">
        <?php
            $notifications = auth()->user()->notifications()->paginate(10);
        ?>
        <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li class="<?php if(!$notification->read_at): ?> unread <?php endif; ?>">
                <i class="ri-time-line"></i>
                <div class="notification-content">
                    <p><?php echo e($notification->data['message']); ?>

                    <span><?php echo e($notification->created_at->format('Y-m-d h:i:s A')); ?></span></p>
                </div>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="dashboard-no-data">
                <svg>
                    <use xlink:href="<?php echo e(asset('images/dashboard/front/notification.svg#notification')); ?>"></use>
                </svg>
                <h6><?php echo e(__('taxido::front.notifications_not_found')); ?></h6>
            </div>
        <?php endif; ?>
    </ul>
    <?php if($notifications->count()): ?>
        <?php if($notifications->lastPage() > 1): ?>
            <div class="pagination-main">
                <ul class="pagination-box">
                    <?php echo $notifications->links(); ?>

                </ul>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        "use strict";
    
        setTimeout(markAllRead, 5000); 
    
        $('#mark-all-read').on('click', markAllRead);
    
        function markAllRead() {
            $.ajax({
                url: "<?php echo e(route('front.cab.notifications.markAsRead')); ?>",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                success: function(response) {
                    $('.notification-list li.unread').removeClass('unread');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('taxido::front.account.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/front/account/notification.blade.php ENDPATH**/ ?>