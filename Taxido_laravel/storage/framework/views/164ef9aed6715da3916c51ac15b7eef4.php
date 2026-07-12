<?php $__env->startSection('title', __('static.taxes.edit')); ?>
<?php $__env->startSection('content'); ?>
<div class="tax-main">
    <form id="taxForm" action="<?php echo e(route('admin.tax.update', $tax->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <?php echo $__env->make('admin.tax.fields', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/tax/edit.blade.php ENDPATH**/ ?>