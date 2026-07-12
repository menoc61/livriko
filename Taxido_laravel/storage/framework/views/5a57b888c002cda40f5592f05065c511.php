<?php $__env->startSection('title', __('static.appearance.customizations')); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/vendors/codemirror/codemirror.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/vendors/codemirror/monokai.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="contentbox">
        <div class="inside">
            <div class="contentbox-title">
                <div class="contentbox-subtitle">
                    <h3><?php echo e(__('static.appearance.customizations')); ?></h3>
                </div>
            </div>

            <form method="POST" id="appearanceCustomizationsForm" action="<?php echo e(route('admin.customization.store')); ?>">
                <?php echo csrf_field(); ?>
                <div>
                    <ul class="nav nav-tabs horizontal-tab custom-scroll" id="account" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="tab-html-tab" data-bs-toggle="tab" href="#tab-html"
                                role="tab" aria-controls="tab-html" aria-selected="false">
                                <?php echo e(__('static.appearance.custom_html')); ?>

                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="tab-css-tab" data-bs-toggle="tab" href="#tab-css" role="tab"
                                aria-controls="tab-css" aria-selected="false">
                                <?php echo e(__('static.appearance.custom_css')); ?>

                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="tab-js-tab" data-bs-toggle="tab" href="#tab-js" role="tab"
                                aria-controls="tab-js" aria-selected="true">
                                <?php echo e(__('static.appearance.custom_js')); ?>

                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" id="accountContent">
                        <div class="tab-pane fade show active" id="tab-html">
                            <div class="form-group row">
                                <label class="col-12" for="custom-html-header"><?php echo e(__('static.appearance.header')); ?></label>
                                <div class="col-12">
                                    <textarea class="form-control code-editor" id="custom-html-header" name="custom_html[header]" rows="10"
                                        value = "<?php echo e(@$customization['html']['header']); ?>}}" placeholder="<?php echo e(__('Enter your custom HTML here...')); ?>"><?php echo e(old('custom_html.header', $customization['html']['header'] ?? '')); ?></textarea>
                                    <?php $__errorArgs = ['custom_html.header'];
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
                            <div class="form-group row">
                                <label class="col-12" for="custom-html-body"><?php echo e(__('static.appearance.body')); ?></label>
                                <div class="col-12">
                                    <textarea class="form-control code-editor" id="custom-html-body" name="custom_html[body]" rows="10"
                                        value = "<?php echo e(@$customization['html']['body']); ?>" placeholder="<?php echo e(__('Enter your custom HTML here...')); ?>"><?php echo e(old('custom_html.body', $customization['html']['body'] ?? '')); ?></textarea>
                                    <?php $__errorArgs = ['custom_html.body'];
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
                            <div class="form-group row">
                                <label class="col-12" for="custom-html-footer"><?php echo e(__('static.appearance.footer')); ?></label>
                                <div class="col-12">
                                    <textarea class="form-control code-editor" id="custom-html-footer" name="custom_html[footer]" rows="10"
                                        value = "<?php echo e(@$customization['html']['footer']); ?>" placeholder="<?php echo e(__('Enter your custom HTML here...')); ?>"><?php echo e(old('custom_html.footer', $customization['html']['footer'] ?? '')); ?></textarea>
                                    <?php $__errorArgs = ['custom_html.footer'];
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
                        </div>

                        <div class="tab-pane fade custom-css-tab" id="tab-css">
                            <div class="form-group row">
                                <label class="col-12" for="custom-css"><?php echo e(__('static.appearance.css')); ?></label>
                                <div class="col-12">
                                    <textarea class="form-control code-editor" id="custom-css" name="custom_css" rows="20"
                                        placeholder="<?php echo e(__('Enter your custom CSS here...')); ?>"><?php echo e(old('custom_css', $customization['css'] ?? '')); ?></textarea>
                                    <?php $__errorArgs = ['custom_css'];
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
                        </div>

                        <div class="tab-pane fade" id="tab-js">
                            <div class="form-group row">
                                <label class="col-12" for="custom-js-header"><?php echo e(__('static.appearance.header')); ?></label>
                                <div class="col-12">
                                    <textarea class="form-control code-editor" id="custom-js-header" name="custom_js[header]" rows="10"
                                        placeholder="<?php echo e(__('Enter your custom JavaScript here...')); ?>"><?php echo e(old('custom_js.header', $customization['js']['header'] ?? '')); ?></textarea>
                                    <?php $__errorArgs = ['custom_js.header'];
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

                            <div class="form-group row">
                                <label class="col-12" for="custom-js-body"><?php echo e(__('static.appearance.body')); ?></label>
                                <div class="col-12">
                                    <textarea class="form-control code-editor" id="custom-js-body" name="custom_js[body]" rows="10"
                                        placeholder="<?php echo e(__('Enter your custom JavaScript here...')); ?>"><?php echo e(old('custom_js.body', $customization['js']['body'] ?? '')); ?></textarea>
                                    <?php $__errorArgs = ['custom_js.body'];
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

                            <div class="form-group row">
                                <label class="col-12" for="custom-js-footer"><?php echo e(__('static.appearance.footer')); ?></label>
                                <div class="col-12">
                                    <textarea class="form-control code-editor" id="custom-js-footer" name="custom_js[footer]" rows="10"
                                        placeholder="<?php echo e(__('Enter your custom JavaScript here...')); ?>"><?php echo e(old('custom_js.footer', $customization['js']['footer'] ?? '')); ?></textarea>
                                    <?php $__errorArgs = ['custom_js.footer'];
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
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-solid spinner-btn ms-auto"><i class="ri-save-line text-white lh-1"></i><?php echo e(__('Save')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/codemirror/codemirror.js')); ?>"></script>
    <script src="<?php echo e(asset('js/codemirror/javascript.js')); ?>"></script>
    <script src="<?php echo e(asset('js/codemirror/css.js')); ?>"></script>
    <script src="<?php echo e(asset('js/codemirror/xml.js')); ?>"></script>

    <script>
        var editors = {};

        function initializeEditors() {
            ['custom-html-header', 'custom-html-body', 'custom-html-footer', 'custom-css', 'custom-js-header',
                'custom-js-body', 'custom-js-footer'
            ].forEach(function(field) {
                if (!editors[field]) {
                    var element = document.getElementById(field);
                    if (element) {
                        editors[field] = CodeMirror.fromTextArea(element, {
                            mode: field.includes('css') ? 'css' : (field.includes('js') ? 'javascript' :
                                'htmlmixed'),
                            lineNumbers: true,
                            theme: "monokai",
                            lineWrapping: true
                        });
                    }
                }
            });
        }

        function resizeEditor() {
            for (var editor in editors) {
                if (editors.hasOwnProperty(editor)) {
                    editors[editor].refresh();
                }
            }
        }

        $(".nav-link").on("click", function() {
            setTimeout(resizeEditor, 200);
        });

        $(document).ready(function() {
            initializeEditors();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/appearance/customization.blade.php ENDPATH**/ ?>