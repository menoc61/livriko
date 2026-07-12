<?php $__env->startSection('title', __('taxido::static.service_categories.edit')); ?>
<?php $__env->startSection('content'); ?>
<div class="serviceCategory-main">
    <form id="serviceCategoryForm" action="<?php echo e(route('admin.service-category.update', $serviceCategory->id)); ?>" method="POST" enctype="multipart/form-data">
        <div class="row g-xl-4 g-3">
            <?php echo method_field('PUT'); ?>
            <?php echo csrf_field(); ?>
            <input type="hidden" name="req_service" value="<?php echo e(request()->service); ?>" />
            <?php echo $__env->make('taxido::admin.service-category.fields', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/admin/service-category/edit.blade.php ENDPATH**/ ?>