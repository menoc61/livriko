<?php $__env->startSection('title', __('taxido::static.drivers.edit')); ?>
<?php $__env->startSection('content'); ?>
    <div class="">
        <form id="driverForm" action="<?php echo e(route('admin.driver.update', $driver->id)); ?>" method="POST"
            enctype="multipart/form-data">
            
            <?php echo method_field('PUT'); ?>
            <?php echo csrf_field(); ?>
            <?php echo $__env->make('taxido::admin.driver.fields', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/admin/driver/edit.blade.php ENDPATH**/ ?>