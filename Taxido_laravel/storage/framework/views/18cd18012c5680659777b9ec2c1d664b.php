<?php $__env->startSection('title', __('static.pages.add')); ?>
<?php $__env->startSection('content'); ?>
<div class="page-main">
    <form id="pageForm" action="<?php echo e(route('admin.page.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('admin.page.fields', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/page/create.blade.php ENDPATH**/ ?>