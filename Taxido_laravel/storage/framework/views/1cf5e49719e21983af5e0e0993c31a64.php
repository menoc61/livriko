
<div class="form-group row">
    <label class="col-md-2" for="name"><?php echo e(__('ticket::static.formfield.name')); ?><span>*</span></label>
    <div class="col-md-10">
        <input class="form-control" type="text" name="name" placeholder=" <?php echo e(__('ticket::static.formfield.enter_name')); ?>" value="" required>
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
<div class="form-group row">
    <label class="col-md-2" for="label"><?php echo e(__('ticket::static.formfield.label')); ?><span>*</span></label>
    <div class="col-md-10">
        <input class="form-control" type="text" name="label" id="label" placeholder=" <?php echo e(__('ticket::static.formfield.enter_label')); ?>" value="" required>
        <?php $__errorArgs = ['label'];
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
    <label class="col-md-2" for="type"><?php echo e(__('ticket::static.formfield.type')); ?><span> *</span></label>
    <div class="col-md-10 select-label-error">
        <select class="select-2 form-control" placeholder="" name="type" id="type">
            <option class="option" value=""><?php echo e(__('ticket::static.formfield.select_type')); ?></option>
            <?php $__empty_1 = true; $__currentLoopData = ['date' => 'Date', 'text' => 'Text', 'email' => 'Email', 'radio' => 'Radio', 'number' => 'Number', 'select' => 'Select', 'textarea' => 'Textarea', 'checkbox' => 'Checkbox']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <option class="option" value=<?php echo e($key); ?>><?php echo e($option); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <option value="" disabled></option>
            <?php endif; ?>
        </select>
            <?php $__errorArgs = ['type'];
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
<div class="form-group row placeholder-input">
    <label class="col-md-2" for="placeholder"><?php echo e(__('ticket::static.formfield.placeholder')); ?><span>*</span></label>
    <div class="col-md-10">
        <input class="form-control" type="text" name="placeholder" placeholder="<?php echo e(__('ticket::static.formfield.enter_placeholder')); ?>" value="" required>
        <?php $__errorArgs = ['placeholder'];
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
<div class="form-group row select_type">
    <label class="col-md-2" for="select_type"><?php echo e(__('ticket::static.formfield.select_type')); ?><span>*</span></label>
    <div class="col-md-10">
        <input type="radio" name="select_type" value="multiple_select"> <?php echo e(__('ticket::static.formfield.multiple_select')); ?>

        <input type="radio" name="select_type" value="single_select"><?php echo e(__('ticket::static.formfield.single_select')); ?>

        <?php $__errorArgs = ['select_type'];
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
<div class="type-options">
    <div class="options">
        <div class="form-group row option_value">
            <label class="col-md-2" for="option_value"><?php echo e(__('ticket::static.formfield.option_value')); ?><span>*</span></label>
            <div class="col-md-10">
                <input class="form-control option-value-input" type="text" name="option_value[]" placeholder="<?php echo e(__('ticket::static.formfield.enter_option_value')); ?>" value="" required>
                <?php $__errorArgs = ['option_value'];
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
        <div class="form-group row option_name">
            <label class="col-md-2" for="option_name"><?php echo e(__('ticket::static.formfield.option_name')); ?><span>*</span></label>
            <div class="col-md-10">
                <input class="form-control option-name-input" type="text" name="option_name[]" placeholder="<?php echo e(__('ticket::static.formfield.enter_option_name')); ?>" value="" required>
                <?php $__errorArgs = ['option_name'];
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
        <div class="form-group row delete-row">
            <label class="col-md-2" for="delete"></label>
            <div class="col-md-10">
                <button type="button" id="delete-row" class="btn btn-danger delete-button">
                    <i class="ri-delete-bin-line"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="option-clone mt-4 mb-3"></div>
    <div class="form-group row icon-position">
        <div class="col-md-2"></div>
        <div class="col-md-10">
          <button type="button" id="add_value" class="btn btn-primary ratio-button mb-4">
            <i class="ri-add-circle-line text-white lh-1"></i> <?php echo e(__('ticket::static.formfield.add_value')); ?>

          </button>
        </div>
    </div> 
</div>
<div class="form-group row">
    <label class="col-md-2" for="is_required"><?php echo e(__('ticket::static.formfield.is_required')); ?></label>
    <div class="col-md-10">
        <div class="editor-space">
            <label class="switch">
                <input class="form-control" type="hidden" name="is_required" value="0">
                <input class="form-check-input" type="checkbox" name="is_required" value="1">
                <span class="switch-state"></span>
            </label>
        </div>
        <?php $__errorArgs = ['is_required'];
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
    <label class="col-md-2" for="role"><?php echo e(__('ticket::static.formfield.status')); ?></label>
    <div class="col-md-10">
        <div class="editor-space">
            <label class="switch">
                <input class="form-control" type="hidden" name="status" value="0">
                <input class="form-check-input" type="checkbox" name="status" value="1">
                <span class="switch-state"></span>
            </label>
        </div>
        <?php $__errorArgs = ['status'];
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
    <div class="col-12">
        <div class="submit-btn">
            <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal"><?php echo e(__('ticket::static.cancel')); ?></button>
            <button type="submit" name="save" class="btn btn-solid spinner-btn">
                <i class="ri-save-line text-white lh-1"></i><?php echo e(__('ticket::static.save')); ?>

            </button>
        </div>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
    (function($) {
        "use strict";
        $('#FormField').validate({
            rules:{
                type:{
                    required:true
                },
            }
        });
    })(jQuery); 
</script>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Ticket/resources/views/admin/formfield/fields.blade.php ENDPATH**/ ?>