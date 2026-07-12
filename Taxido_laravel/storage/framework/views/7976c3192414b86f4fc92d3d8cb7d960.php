<?php use \Modules\Ticket\Models\Department; ?>
<?php use \Modules\Ticket\Models\Priority; ?>
<?php
    $settings = tx_getSettings();
    $coreSettings = getSettings();
    $departments = Department::where('status', true)->get();
    $priorities = Priority::where('status', true)->get();
?>
<div class="row">
    <div class="col-xl-11 col-xxl-10 mx-auto">
        <div class="contentbox">
            <div class="inside">
                <div class="contentbox-title">
                    <h3><?php echo e(isset($ticket) ? __('ticket::static.ticket.edit') : __('ticket::static.ticket.add')); ?></h3>
                </div>

                <?php if(!isset($ticket)): ?>
                    <div class="row g-sm-4 g-3">
                        <div class="col-sm-6">
                            <div class="form-box">
                                <label for=""><?php echo e(__('ticket::static.ticket.name')); ?><span>
                                        *</span></label>
                                <input class="form-control" type="text" name="name"
                                    placeholder="<?php echo e(__('ticket::static.ticket.enter_name')); ?>" required>
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

                        <div class="col-sm-6">
                            <div class="form-box">
                                <label for=""><?php echo e(__('ticket::static.ticket.email')); ?><span>
                                        *</span></label>
                                <input class="form-control" type="email" name="email"
                                    placeholder="<?php echo e(__('ticket::static.ticket.enter_email')); ?>" required>
                                <?php $__errorArgs = ['email'];
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

                        <div class="col-sm-6">
                            <div class="form-box">
                                <label for=""><?php echo e(__('ticket::static.ticket.subject')); ?><span>
                                        *</span></label>
                                <input class="form-control" type="text" name="subject"
                                    placeholder="<?php echo e(__('ticket::static.ticket.enter_subject')); ?>" required>
                                <?php $__errorArgs = ['subject'];
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

                        <div class="col-sm-6">
                            <div class="form-box">
                                <label for=""><?php echo e(__('ticket::static.ticket.description')); ?><span>
                                        *</span></label>
                                <textarea class="form-control content" name="description"
                                    placeholder="<?php echo e(__('ticket::static.ticket.enter_description')); ?>" required></textarea>
                                <?php $__errorArgs = ['description'];
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

                <?php $__currentLoopData = $formFeilds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formFeild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($formFeild->type == 'text'): ?>
                        <div class="col-sm-6">
                            <div class="form-box">
                                <label class="col-md-2" for=""><?php echo e($formFeild->label); ?> <?php if($formFeild->is_required): ?>
                                        <span> *</span>
                                    <?php endif; ?>
                                </label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text"
                                        name="<?php echo e('other_' . $formFeild->name); ?>"
                                        placeholder="<?php echo e($formFeild->placeholder); ?>"
                                        <?php if($formFeild->is_required): ?> required <?php endif; ?>>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if($formFeild->type == 'email'): ?>
                    <div class="col-sm-6">
                        <div class="form-box">
                            <label class="col-md-2" for=""><?php echo e($formFeild->label); ?><?php if($formFeild->is_required): ?>
                                    <span> *</span>
                                <?php endif; ?>
                            </label>
                            <div class="col-md-10">
                                <input class="form-control" type="email" name="<?php echo e('other_' . $formFeild->name); ?>"
                                    placeholder="<?php echo e($formFeild->placeholder); ?>"
                                    <?php if($formFeild->is_required): ?> required <?php endif; ?>>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($formFeild->type == 'date'): ?>
                    <div class="col-sm-6">
                        <div class="form-box">
                            <label class="col-md-2" for=""><?php echo e($formFeild->label); ?><?php if($formFeild->is_required): ?>
                                    <span> *</span>
                                <?php endif; ?>
                            </label>
                            <div class="col-md-10">
                                <input class="form-control" type="date" name="<?php echo e('other_' . $formFeild->name); ?>"
                                    placeholder="<?php echo e($formFeild->placeholder); ?>"
                                    <?php if($formFeild->is_required): ?> required <?php endif; ?>>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($formFeild->type == 'number'): ?>
                    <div class="col-sm-6">
                        <div class="form-box">
                            <label class="col-md-2" for=""><?php echo e($formFeild->label); ?><?php if($formFeild->is_required): ?>
                                    <span> *</span>
                                <?php endif; ?>
                            </label>
                            <div class="col-md-10">
                                <input class="form-control" type="number" min="1"
                                    name="<?php echo e('other_' . $formFeild->name); ?>"
                                    placeholder="<?php echo e($formFeild->placeholder); ?>"
                                    <?php if($formFeild->is_required): ?> required <?php endif; ?>>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($formFeild->type == 'textarea'): ?>
                    <div class="col-sm-6">
                        <div class="form-box">
                            <label class="col-md-2" for=""><?php echo e($formFeild->label); ?><?php if($formFeild->is_required): ?>
                                    <span> *</span>
                                <?php endif; ?>
                            </label>
                            <div class="col-md-10">
                                <textarea class="form-control content" name="<?php echo e('other_' . $formFeild->name); ?>"
                                    placeholder="<?php echo e($formFeild->placeholder); ?>" <?php if($formFeild->is_required): ?> required <?php endif; ?>></textarea>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($formFeild->type == 'select'): ?>
                    <div class="col-sm-6">
                        <div class="form-box">
                            <label class="col-md-2" for=""><?php echo e($formFeild->label); ?><?php if($formFeild->is_required): ?>
                                    <span> *</span>
                                <?php endif; ?>
                            </label>
                            <div class="col-md-10 select-label-error">
                                <select class="select-2 form-control" name="<?php if($formFeild->select_type == 'multiple_select'): ?> <?php echo e('other_' . $formFeild->name . '[]'); ?> <?php else: ?> <?php echo e('other_' . $formFeild->name); ?> <?php endif; ?>" data-placeholder="<?php echo e($formFeild->placeholder); ?>"
                                    <?php if($formFeild->select_type == 'multiple_select'): ?> multiple <?php endif; ?>
                                    <?php if($formFeild->is_required): ?> required <?php endif; ?>>
                                    <?php $__currentLoopData = $formFeild->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($option['option_value']); ?>" class="option">
                                            <?php echo e($option['option_name']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($formFeild->type == 'checkbox'): ?>
                    <div class="col-sm-6">
                        <div class="form-box">
                            <label class="col-md-2" for=""><?php echo e($formFeild->label); ?><?php if($formFeild->is_required): ?>
                                    <span> *</span>
                                <?php endif; ?>
                            </label>
                            <div class="col-md-10">
                                <?php $__currentLoopData = $formFeild->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group m-checkbox-inline mb-0 d-flex">
                                        <input type="checkbox" name="<?php echo e('other_' . $option['option_value']); ?>">
                                        <?php echo e($option['option_name']); ?>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($formFeild->type == 'radio'): ?>
                    <div class="col-sm-6">
                        <div class="form-box">
                            <label class="col-md-2" for=""><?php echo e($formFeild->label); ?><?php if($formFeild->is_required): ?>
                                    <span> *</span>
                                <?php endif; ?>
                            </label>
                            <div class="col-md-10">
                                <?php $__currentLoopData = $formFeild->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group m-checkbox-inline mb-0 d-flex">
                                        <input type="radio" name="<?php echo e('other_' . $option['option_value']); ?>"
                                            id=""><?php echo e($option['option_name']); ?>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php if(isset($departments)): ?>
                    <div class="col-sm-6">
                        <div class="form-box">
                            <label for=""><?php echo e(__('ticket::static.ticket.department')); ?><span>
                                    *</span></label>
                            <select class="form-control form-select" id="department-list-id" name="department_id"
                                data-placeholder="<?php echo e(__('ticket::static.ticket.select_department')); ?>">
                                <option disabled selected value="0"><?php echo e(__('ticket::static.ticket.select_department')); ?></option>
                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $media = $department->getFirstMedia('image');
                                        $imageUrl = $media ? $media->getUrl() : '';
                                    ?>
                                    <option value="<?php echo e($department->id); ?>"
                                        <?php if($imageUrl): ?> data-image="<?php echo e($imageUrl); ?>" <?php endif; ?>
                                        class="option" <?php if(old('department_id', $ticket?->department_id ?? '') == $department->id): ?> selected <?php endif; ?>>
                                        <?php echo e($department->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['department_id'];
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
                <?php endif; ?>
                <?php if(isset($priorities)): ?>
                    <div class="col-sm-6">
                        <div class="form-box">
                            <label for=""><?php echo e(__('ticket::static.ticket.priority')); ?><span>
                                    *</span></label>
                            <div class="select-label-error">
                                <select class="select-2 form-control form-select" id="" name="priority_id"
                                    data-placeholder="<?php echo e(__('ticket::static.ticket.select_priority')); ?>">
                                    <option value="0" selected disabled><?php echo e(__('ticket::static.ticket.select_priority')); ?></option>
                                    <?php $__currentLoopData = $priorities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priority): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($priority->id); ?>" class="option"
                                            <?php if(old('priority_id', $ticket?->priority_id ?? '') == $priority->id): ?> selected <?php endif; ?>><?php echo e($priority->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['priority_id'];
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
                <?php endif; ?>
                <?php if(!isset($ticket)): ?>
                    <div class="col-sm-6">
                        <div class="form-box">
                            <label for=""><?php echo e(__('ticket::static.ticket.attachment')); ?></label>
                            <input type="file" class="form-control" name="image[]" id="image-upload"
                                data-max="<?php echo e($settings['storage_configuration']['max_file_upload']); ?>"
                                data-types="<?php echo e(implode(',', $settings['storage_configuration']['supported_file_types'])); ?>"
                                data-size="<?php echo e($settings['storage_configuration']['max_file_upload_size']); ?>" multiple>
                            <span class="invalid-feedback d-block" role="alert">
                                <strong class="image-upload-error"></strong>
                            </span>
                            <?php $__errorArgs = ['image'];
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
                <?php endif; ?>
                <?php if($settings['activation']['ticket_recaptcha_enable'] && $coreSettings['google_reCaptcha']['status']): ?>
                    <div class="col-sm-6">
                        <div class="form-box">
                            <div class="col-md-10">
                                <div class="g-recaptcha" data-sitekey="<?php echo e(env('GOOGLE_RECAPTCHA_KEY')); ?>"></div>
                                <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-12">
                    <div class="submit-btn">
                        <button type="submit" name="save" class="btn btn-solid spinner-btn">
                            <?php echo e(__('ticket::static.save')); ?>

                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(env('GOOGLE_RECAPTCHA_KEY')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/select2.full.min.js')); ?>"></script>
    <script>
        (function($) {
            "use strict";

            $('#ticketForm').validate({
                ignore: [],
                rules: {
                    description: {
                        required: function(element) {
                            var editorContent = tinymce.get(element.id).getContent({
                                format: 'text'
                            });
                            if (editorContent.trim().length <= 0) {
                                return true;
                            }
                        }
                    },
                },
            });

            $('#image-upload').on('change', function() {

                var files = $(this)[0];
                var maxSize = $(this).data('size');
                var maxFiles = $(this).data('max');
                var allowedTypes = $(this).data('types').split(',').map(function(type) {
                    return type.trim().toLowerCase();
                }); // Allowed file extensions
                var fileCount = files.files.length;

                if (files.files.length > maxFiles) {

                    $('.invalid-feedback').show();
                    $('.image-upload-error').text('You can only upload up to ' + maxFiles + ' files.');
                    $(this).val('');

                } else {
                    for (var i = 0; i < fileCount; i++) {
                        var file = files.files[i];
                        var fileExtension = file.name.split('.').pop().toLowerCase();
                        var fileSize = file.size;

                        if (!allowedTypes.includes(fileExtension)) {
                            $('.invalid-feedback').show();
                            $('.image-upload-error').text('File "' + file.name +
                                '" has an invalid extension. Allowed extensions are: ' + allowedTypes.join(
                                    ', ') + '.');

                        }

                        if (fileSize > maxSize) {
                            $('.invalid-feedback').show();
                            $('.image-upload-error').text('File "' + file.name +
                                '" exceeds the maximum size of ' + (maxSize / 1024 / 1024).toFixed(2) +
                                ' MB.');

                        }
                    }
                }


            });


            // $('#department-list-id').select2({
            //     placeholder: "Select Departments",
            //     templateResult: function(data) {
            //         var $result = $('<span><img src="' + $(data.element).data('image') +
            //             '" class="rounded-circle h-30 w-30" />  ' + data.text.trim() + '</span>');
            //         return $result;
            //     }
            // });

            function addValidationRules() {
                var rules = {};
                var messages = {};

                $('#ticketForm').find(':input').each(function() {
                    var $input = $(this);
                    var name = $input.attr('name');
                    var type = $input.attr('type');
                    var isRequired = $input.prop('required');

                    if (type === 'email') {
                        rules[name] = {
                            required: function(e) {
                                if (isRequired) {
                                    return true;
                                } else {
                                    return false;
                                }
                            },
                            email: true
                        };
                        messages[name] = {
                            required: "Email is required",
                            email: "Please enter a valid email address"
                        };
                    }

                    if (type === 'text') {
                        rules[name] = {
                            required: function(e) {
                                if (isRequired) {
                                    return true;
                                } else {
                                    return false;
                                }
                            },
                        };
                        messages[name] = {
                            required: "This field is required",
                        };
                    }

                    if (type === 'number') {
                        rules[name] = {
                            required: function(e) {
                                if (isRequired) {
                                    return true;
                                } else {
                                    return false;
                                }
                            },
                            number: true
                        };
                        messages[name] = {
                            required: "This field is required",
                        };
                    }

                    if ($input.is('textarea')) {
                        rules[name] = {
                            required: function(e) {
                                if (isRequired) {
                                    return true;
                                }
                            }
                        };
                        messages[name] = {
                            required: "This field is required"
                        };
                    }

                    if ($input.is('select')) {
                        if ($input.prop('multiple')) {
                            rules[name] = {
                                required: true,
                                minlength: 1
                            };
                            messages[name] = "Please select at least one option";
                        } else {
                            rules[name] = "required";
                            messages[name] = "This field is required";
                        }
                    }

                    if ($input.is(':checkbox')) {
                        rules[name] = "required";
                        messages[name] = "This field is required";
                    }

                    if ($input.is(':radio')) {
                        rules[name] = {
                            required: function(e) {
                                if (isRequired) {
                                    return true;
                                } else {
                                    return false;
                                }
                            },
                        };
                        messages[name] = "This field is required";
                    }
                });

                $('#ticketForm').validate().settings.rules = rules;
                $('#ticketForm').validate().settings.messages = messages;
            }

            addValidationRules();

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Ticket/resources/views/frontend/ticket/fields.blade.php ENDPATH**/ ?>