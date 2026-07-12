<div class="contentbox">
    <div class="inside">
        <div class="contentbox-title">
            <h3><?php echo e(isset($tag) ? __('static.tags.edit_tag') : __('static.tags.add_tag')); ?>

                (<?php echo e(request('locale', app()->getLocale())); ?>)</h3>
            <?php if(!Request::is('admin/tag')): ?>
                <a href="<?php echo e(route('admin.tag.index')); ?>" class="btn btn-outline"><i class="ri-add-line"></i><?php echo e(__('static.tags.add_tag')); ?></a>
            <?php endif; ?>
        </div>
        <?php if(isset($tag)): ?>
            <div class="form-group row">
                <label class="col-12" for="name"><?php echo e(__('static.language.languages')); ?></label>
                <div class="col-12">
                    <ul class="language-list">
                        <?php $__empty_1 = true; $__currentLoopData = getLanguages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li>
                                <a href="<?php echo e(route('admin.tag.edit', ['tag' => $tag->id, 'locale' => $lang->locale])); ?>"
                                    class="language-switcher <?php echo e(request('locale') === $lang->locale ? 'active' : ''); ?>"
                                    target="_blank"><img
                                        src="<?php echo e(@$lang?->flag ?? asset('admin/images/No-image-found.jpg')); ?>"
                                        alt=""> <?php echo e(@$lang?->name); ?> (<?php echo e(@$lang?->locale); ?>)
                                    <i class="ri-arrow-right-up-line"></i>
                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li>
                                <a href="<?php echo e(route('admin.tag.edit', ['tag' => $tag->id, 'locale' => Session::get('locale', 'en')])); ?>"
                                    class="language-switcher active" target="blank"><img
                                        src="<?php echo e(asset('admin/images/flags/LR.png')); ?>" alt="">English
                                    <i class="ri-arrow-right-up-line"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
        <input type="hidden" name="locale" value="<?php echo e(request('locale')); ?>">
        <div class="form-group row">
            <label class="col-12" for="name"><?php echo e(__('static.tags.name')); ?> <span> *</span> </label>
            <div class="col-12">
                <div class="position-relative">
                    <input class="form-control" type="text" id="name" name="name"
                        value="<?php echo e(isset($tag->name) ? $tag->getTranslation('name', request('locale', app()->getLocale())) : old('name')); ?>"
                        placeholder="<?php echo e(__('static.tags.enter_name')); ?> (<?php echo e(request('locale', app()->getLocale())); ?>)"><i
                        class="ri-file-copy-line copy-icon" data-target="#name"></i>
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
        <div class="form-group row">
            <label class="col-12" for="description"><?php echo e(__('static.tags.description')); ?></label>
            <div class="col-12">
                <div class="position-relative">
                    <textarea class="form-control" rows="4" id="description" name="description" cols="80"
                        placeholder="<?php echo e(__('static.tags.description')); ?>(<?php echo e(request('locale', app()->getLocale())); ?>)"><?php echo e(isset($tag->description) ? $tag->getTranslation('description', request('locale', app()->getLocale())) : old('description')); ?></textarea><i class="ri-file-copy-line copy-icon" data-target="#description"></i>
                </div>
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
        <div class="form-group row">
            <label class="col-12" for="status"><?php echo e(__('static.tags.status')); ?></label>
            <div class="col-12">
                <div class="editor-space">
                    <label class="switch">
                        <input class="form-control" type="hidden" name="status" value="0">
                        <input class="form-check-input" type="checkbox" name="status" id="" value="1"
                            <?php if(@$tag?->status ?? true): echo 'checked'; endif; ?>>
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
                        <i class="ri-expand-left-line text-white lh-1"></i><?php echo e(__('static.save_and_exit')); ?>

                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>
    <script>
        (function($) {
            "use strict";
            $('#tagForm').validate({
                rules: {
                    "name": "required",
                }
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/tag/fields.blade.php ENDPATH**/ ?>