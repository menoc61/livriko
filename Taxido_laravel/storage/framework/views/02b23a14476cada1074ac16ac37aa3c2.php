<?php use \Nwidart\Modules\Facades\Module; ?>

<?php $__env->startSection('title', __('static.plugins.plugins')); ?>
<?php $__env->startPush('css'); ?>
<!-- Dropzone css-->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/vendors/dropzone.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="contentbox">
    <div class="inside">
        <div class="contentbox-title">
            <div class="contentbox-subtitle">
                <h3><?php echo e(__('static.plugins.plugins')); ?></h3>
                <a href="javascript:void(0)" class="btn btn-outline addNewMedia"><?php echo e(__('static.plugins.upload_plugin')); ?></a>
            </div>
        </div>
        <div class="media-dropzone mt-4 p-0">
            <form action="<?php echo e(route('admin.plugin.store')); ?>" method="POST" class="digits files form-container dropzone" id="plugin-dropzone">
                <?php echo csrf_field(); ?>
                <div class="upload-files-container">
                    <div class="dz-message needsclick">
                        <span class="upload-icon"><i class="ri-upload-2-line"></i></span>
                        <h3><?php echo e(__('static.plugins.drop_zip_file')); ?></h3>
                        <button type="button" class="browse-files mb-2"><?php echo e(__('static.plugins.select_files')); ?></button>
                    </div>
                    <button type="button" class="upload-button" id="submit-files"><?php echo e(__('static.plugins.upload')); ?></button>
                </div>
                <i class="ri-close-line media-close"></i>
            </form>
        </div>
        <?php if (isset($component)) { $__componentOriginal163c8ba6efb795223894d5ffef5034f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal163c8ba6efb795223894d5ffef5034f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table.index','data' => ['columns' => $tableConfig['columns'],'data' => $tableConfig['data'],'filters' => $tableConfig['filters'],'actions' => $tableConfig['actions'],'total' => $tableConfig['total'],'bulkactions' => $tableConfig['bulkactions'],'search' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableConfig['columns']),'data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableConfig['data']),'filters' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableConfig['filters']),'actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableConfig['actions']),'total' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableConfig['total']),'bulkactions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableConfig['bulkactions']),'search' => true]); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $attributes = $__attributesOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $component = $__componentOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__componentOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/dropzone/dropzone.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/dropzone/dropzone-script.js')); ?>"></script>
    <script>
        (function($) {
            Dropzone.autoDiscover = false;
            var $pluginDropzone = $('.media-dropzone');
            var $countSelectedItems = $('#count-selected-items');
            var $csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Toggle media dropzone visibility
            $('.addNewMedia, .media-close').on('click', function() {
                $('.media-dropzone').toggleClass('show');
            });

            DropzoneComponents.init();

            // Init dropzone instance
            Dropzone.autoDiscover = false
            const myDropzone = new Dropzone('#plugin-dropzone', {
                autoProcessQueue: false
            })

            // Submit
            const $button = document.getElementById('submit-files')
            $button.addEventListener('click', function() {
                // Retrieve selected files
                const acceptedFiles = myDropzone.getAcceptedFiles()
                for (let i = 0; i < acceptedFiles.length; i++) {
                    setTimeout(function() {
                        myDropzone.processFile(acceptedFiles[i])
                    }, i * 2000)
                }
            })

            // Listen for success event
            myDropzone.on("success", function(file) {
                if (myDropzone.getQueuedFiles().length === 0 && myDropzone.getUploadingFiles().length === 0) {
                    window.location.reload();
                }
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/plugin/index.blade.php ENDPATH**/ ?>