<?php use \App\Enums\Locale; ?>
<?php use \App\Enums\AppLocale; ?>
<div class="row">
    <div class="col-xl-10 col-xxl-8 mx-auto">
        <div class="contentbox">
            <div class="inside">
                <div class="contentbox-title">
                    <h3><?php echo e(isset($language) ? __('static.languages.edit') : __('static.languages.add')); ?></h3>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-2" for="name"><?php echo e(__('static.languages.name')); ?><span> *</span></label>
                    <div class="col-md-10">
                        <div class="input-group mb-3 phone-detail language-input align-items-unset">
                            <div class="col-sm-3 select-label-error flex-direction-unset">
                                <select id="select-country-flag"
                                    class="form-control form-select form-select-transparent" name="flag"
                                    data-placeholder="<?php echo e(__('static.languages.select_flag')); ?>" required>
                                    <option></option>
                                    <?php $__currentLoopData = getCountryFlags(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($option->flag); ?>"
                                            image="<?php echo e(asset('images/flags/' . $option->flag)); ?>"
                                            <?php if(@$language?->flag == asset('images/flags/' . $option->flag)): echo 'selected'; endif; ?>>
                                            <?php echo e($option->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="name"
                                    value="<?php echo e(isset($language->name) ? $language->name : old('name')); ?>"
                                    placeholder="<?php echo e(__('static.languages.enter_name')); ?>" required>
                            </div>
                            <?php $__errorArgs = ['name'];
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

                <div class="form-group row">
                    <label class="col-md-2" for="locale"><?php echo e(__('static.languages.locale')); ?><span> *</span></label>
                    <div class="col-md-10 select-label-error select-dropdown">
                        <select class="select-2 form-control" name="locale"
                            data-placeholder="<?php echo e(__('static.languages.select_locale')); ?>" required>
                            <option></option>
                            <?php $__currentLoopData = Locale::cases(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option class="option" value="<?php echo e($locale->value); ?>" <?php if(old('locale', @$language->locale) == $locale->value): echo 'selected'; endif; ?>>
                                    <?php echo e($locale->label()); ?>

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

                <div class="form-group row">
                    <label class="col-md-2" for="app_locale"><?php echo e(__('static.languages.app_locale')); ?><span>
                            *</span></label>
                    <div class="col-md-10 select-label-error select-dropdown">
                        <select class="select-2 form-control" name="app_locale"
                            data-placeholder="<?php echo e(__('static.languages.select_app_locale')); ?>" required>
                            <option></option>
                            <?php $__currentLoopData = AppLocale::cases(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appLocale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option class="option" value="<?php echo e($appLocale->value); ?>" <?php if(old('app_locale', @$language->app_locale) == $appLocale->value): echo 'selected'; endif; ?>>
                                    <?php echo e($appLocale->label()); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['app_locale'];
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
                    <label class="col-md-2" for="role"><?php echo e(__('static.languages.is_rtl')); ?></label>
                    <div class="col-md-10">
                        <div class="editor-space">
                            <label class="switch">
                                <input class="form-control" type="hidden" name="is_rtl" value="0">
                                <input class="form-check-input" type="checkbox" name="is_rtl" id=""
                                    value="1" <?php if(@$language?->is_rtl): echo 'checked'; endif; ?>>
                                <span class="switch-state"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2" for="role"><?php echo e(__('static.status')); ?></label>
                    <div class="col-md-10">
                        <div class="editor-space">
                            <label class="switch">
                                <input class="form-control" type="hidden" name="status" value="0">
                                <input class="form-check-input" type="checkbox" name="status" id=""
                                    value="1" <?php if(@$language?->status): echo 'checked'; endif; ?>>
                                <span class="switch-state"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <div class="submit-btn">
                            <button type="submit" name="save" class="btn btn-primary spinner-btn">
                                <i class="ri-save-line text-white lh-1"></i> <?php echo e(__('static.save')); ?>

                            </button>
                            <button type="submit" name="save_and_exit" class="btn btn-primary spinner-btn">
                                <i
                                    class="ri-expand-left-line text-white lh-1"></i><?php echo e(__('static.save_and_exit')); ?>

                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        (function($) {
            "use strict";

            $.validator.addMethod("notOnlyNumeric", function(value, element) {
                return this.optional(element) || !/^\d+$/.test(value);
            }, "This field cannot contain only numbers.");
            
            $(document).ready(function() {
                $("#languageForm").validate({
                    ignore: [],
                    rules: {
                        "name": { required: true, notOnlyNumeric: true },
                        "locale": "required",
                        "app_locale": "required",
                    }
                });
            });

            const optionFormat = (item) => {
                if (!item.id) {
                    return item.text;
                }

                var span = document.createElement('span');
                var html = '';

                html += '<div class="selected-item">';
                html += '<img src="' + item.element.getAttribute('image') + '" class="h-24 w-24" alt="' + item
                    .text + '"/>';
                html += '<span>' + "  " + item.text + '</span>';
                html += '</div>';
                span.innerHTML = html;
                return $(span);
            }

            $('#select-country-flag').select2({
                placeholder: "Select an option",
                templateSelection: optionFormat,
                templateResult: optionFormat
            });

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/language/fields.blade.php ENDPATH**/ ?>