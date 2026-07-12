<?php $__env->startSection('title', __('taxido::static.vehicle_types.edit')); ?>
<?php $__env->startSection('content'); ?>
    <div class="banner-main">
        <form id="vehicleForm" action="<?php echo e(route('admin.vehicle-type.update', $vehicleType->id)); ?>" method="POST"
            enctype="multipart/form-data">
            <?php echo method_field('PUT'); ?>
            <?php echo csrf_field(); ?>
            <input type="hidden" name="req_service" value="<?php echo e(request()->service); ?>" />
            <?php echo $__env->make('taxido::admin.vehicle-type.fields', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </form>
        <?php echo $__env->make('taxido::admin.vehicle-type.zone-price', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/admin/vehicle-type/edit.blade.php ENDPATH**/ ?>