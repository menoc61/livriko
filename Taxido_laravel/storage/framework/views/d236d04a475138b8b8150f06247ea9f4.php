<?php $__env->startSection('title', __('static.categories.categories')); ?>
<?php $__env->startSection('content'); ?>
    <div class="row category-main g-md-4 g-3">
        <div class="col-xxl-4 col-xl-5">
            <div class="p-sticky">
                <?php echo $__env->make('admin.category.list', ['categories' => $categories], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>
        <div class="col-xxl-8 col-xl-7">
            <div class="p-sticky">
                <form id="categoryForm" action="<?php echo e(route('admin.category.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo method_field('POST'); ?>
                    <?php echo csrf_field(); ?>
                    <?php echo $__env->make('admin.category.fields', ['parents' => $parent], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/category/index.blade.php ENDPATH**/ ?>