<?php $__env->startSection('title', __('static.languages.edit')); ?>
<?php $__env->startSection('content'); ?>
<div class="language-main">
    <form id="languageForm" action="<?php echo e(route('admin.language.update', $language?->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo method_field('PUT'); ?>
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('admin.language.fields', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/language/edit.blade.php ENDPATH**/ ?>