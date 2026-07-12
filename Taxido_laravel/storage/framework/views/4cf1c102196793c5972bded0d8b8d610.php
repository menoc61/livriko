<?php $__env->startSection('title', __('static.languages.translate')); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="m-auto col-xl-10 col-xxl-8">
            <div class="contentbox">
                <div class="inside">
                    <div class="contentbox-title">
                        <div class="contentbox-subtitle">
                            <h3><?php echo e(__('static.languages.translate')); ?></h3>
                        </div>
                    </div>
                    <form class="" action="<?php echo e(route('admin.language.translate.update', ['id' => request()->id, 'file' => $file])); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('POST'); ?>
                        <div class="form-group row">
                            <label class="col-3" for="locale"><?php echo e(__('static.languages.select_translate_file')); ?></label>
                            <div class="col-9">
                                <select class="form-select select-2" name="file" id="file-select" onchange="updateURL()">
                                    data-placeholder="<?php echo e(__('Select Locale')); ?>">
                                    <option></option>
                                    <?php $__currentLoopData = $allFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fileName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($fileName); ?>"
                                            <?php if($fileName === @$file): ?> selected <?php endif; ?>>
                                            <?php echo e(ucfirst($fileName)); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['locale'];
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
                            </div>
                        </div>

                        <div class="form-group title-panel">
                            <div class="row">
                                <label class="col-3 mb-0">
                                    <?php echo e(__('static.key')); ?>

                                </label>
                                <label class="col-9 mb-0">
                                    <?php echo e(__('static.value')); ?>

                                </label>
                            </div>
                        </div>
                        <div class="table-responsive language-table custom-scroll">
                            <?php $__currentLoopData = $translations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.language.trans-fields', ['key' => $key, 'value' => $value], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="submit-btn">
                                        <button type="submit" name="save" class="btn btn-solid">
                                            <?php echo e(__('static.save')); ?>

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pagination">
                            <?php echo e($translations->links()); ?>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        "use strict";

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('file-select').addEventListener('change', updateURL);
        });

        function updateURL() {
            const file = document.getElementById('file-select').value;
            const url = `<?php echo e(route('admin.language.translate', ['id' => 'ID', 'file' => 'FILE'])); ?>`
                .replace('ID', `<?php echo e(request()?->id); ?>`)
                .replace('FILE', file);

            window.location.href = url;
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/language/translate.blade.php ENDPATH**/ ?>