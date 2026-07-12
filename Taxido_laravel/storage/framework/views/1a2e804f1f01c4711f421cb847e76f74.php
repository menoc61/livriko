<?php $__env->startSection('title', __('static.testimonials.edit')); ?>
<?php $__env->startSection('content'); ?>
    <div class="">
        <form id="testimonialForm" action="<?php echo e(route('admin.testimonial.update', $testimonial->id)); ?>" method="POST" enctype="multipart/form-data">
            <div class="row g-xl-4 g-3">
                <?php echo method_field('PUT'); ?>
                <?php echo csrf_field(); ?>
                <?php echo $__env->make('admin.testimonial.fields', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/testimonial/edit.blade.php ENDPATH**/ ?>