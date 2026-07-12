<?php $__env->startSection('title', __('ticket::static.ticket.add')); ?>
<?php $__env->startSection('content'); ?>

    
    <section class="ticket-create-section section-b-space">
        <div class="container">
            <form id="ticketForm" action="<?php echo e(route('ticket.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo method_field('POST'); ?>
                <?php echo csrf_field(); ?>
                <?php echo $__env->make('ticket::frontend.ticket.fields', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </form>
        </div>
    </section>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Ticket/resources/views/frontend/ticket/create.blade.php ENDPATH**/ ?>