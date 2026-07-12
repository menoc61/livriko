<?php $__env->startSection('title', __('static.appearance.robots')); ?>
<?php $__env->startSection('content'); ?>
    <div class="tax-create">
        <form id="Form" action="<?php echo e(route('admin.robot.update')); ?>" method="POST" enctype="multipart/form-data">
            <div class="row g-xl-4 g-3">
                <?php echo method_field('POST'); ?>
                <?php echo csrf_field(); ?>
                <div class="row g-xl-4 g-3">
                    <div class="col-xl-10 col-xxl-8 mx-auto">
                        <div class="left-part">
                            <div class="contentbox">
                                <div class="inside">
                                    <div class="contentbox-title">
                                        <h3><?php echo e(__('static.appearance.edit_robot_file')); ?></h3>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2" for="content"><?php echo e(__('static.appearance.content')); ?><span>
                                                *</span></label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" type="text" name="content" id="" value="" cols="30" rows="10"
                                                placeholder="<?php echo e(__('static.appearance.edit_robots')); ?>"><?php echo e(@$content); ?></textarea>
                                            <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            <span class="text-gray mt-1">
                                                <?php echo e(__('static.appearance.view_robot_file')); ?>

                                                <a href="<?php echo e(url('/robots.txt')); ?>" class="text-primary">
                                                    <b><?php echo e(__('static.here')); ?></b>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="submit-btn">
                                                <button type="submit" name="save" class="btn btn-solid spinner-btn">
                                                    <i class="ri-save-line text-white lh-1"></i><?php echo e(__('static.save')); ?>

                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        (function($) {
            "use strict";
            $('#Form').validate({
                rules: {
                    "content": "required",
                },
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/appearance/robots.blade.php ENDPATH**/ ?>