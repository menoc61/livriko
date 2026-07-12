<?php use \Modules\Taxido\Models\Service; ?>
<?php
$services = Service::whereNull('deleted_at')?->where('status', true)->pluck('name','id');
?>

<div class="row g-xl-4 g-3">
    <div class="col-xl-10 col-xxl-8 mx-auto">
        <div class="left-part">
            <div class="contentbox">
                <div class="inside">
                    <div class="contentbox-title">
                        <h3><?php echo e(isset($serviceCategory) ? __('taxido::static.service_categories.edit') : __('taxido::static.service_categories.add')); ?>

                            (<?php echo e(request('locale', app()->getLocale())); ?>)</h3>
                    </div>
                    <?php if(isset($serviceCategory)): ?>
                    <div class="form-group row">
                        <label class="col-md-2" for="name"><?php echo e(__('taxido::static.language.languages')); ?></label>
                        <div class="col-md-10">
                            <ul class="language-list">
                                <?php $__empty_1 = true; $__currentLoopData = getLanguages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li>
                                    <a href="<?php echo e(route(getServiceCategoryEditRoute(), ['serviceCategory' => $serviceCategory->id, 'locale' => $lang->locale])); ?>"
                                        class="language-switcher <?php echo e(request('locale') === $lang->locale ? 'active' : ''); ?>"
                                        target="_blank"><img
                                            src="<?php echo e(@$lang?->flag ?? asset('admin/images/No-image-found.jpg')); ?>"
                                            alt=""> <?php echo e(@$lang?->name); ?> (<?php echo e(@$lang?->locale); ?>)<i
                                            class="ri-arrow-right-up-line"></i></a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li>
                                    <a href="<?php echo e(route(getServiceCategoryEditRoute(), ['serviceCategory' => $serviceCategory->id, 'locale' => Session::get('locale', 'en')])); ?>"
                                        class="language-switcher active" target="blank"><img
                                            src="<?php echo e(asset('admin/images/flags/LR.png')); ?>" alt="">English<i
                                            class="ri-arrow-right-up-line"></i></a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <?php endif; ?>
                    <input type="hidden" name="locale" value="<?php echo e(request('locale')); ?>">
                    <form id="serviceCategoryForm" method="POST"
                        action="<?php echo e(isset($serviceCategory) ? route('admin.service-category.update', $serviceCategory->id) : route('admin.service-category.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field(isset($serviceCategory) ? 'PUT' : 'POST'); ?>
                        <div class="form-group row">
                            <label class="col-md-2"
                                for="service_category_image_id"><?php echo e(__('taxido::static.service_categories.service_image')); ?></label>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <?php if (isset($component)) { $__componentOriginal22d447e3f5aafc93b8447b54b36ee789 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image','data' => ['text' => '','unallowedTypes' => ['svg'],'name' => 'service_category_image_id','data' => isset($serviceCategory->service_category_image)
                                        ? $serviceCategory?->service_category_image
                                        : old('service_category_image_id'),'multiple' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(''),'unallowed_types' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['svg']),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('service_category_image_id'),'data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($serviceCategory->service_category_image)
                                        ? $serviceCategory?->service_category_image
                                        : old('service_category_image_id')),'multiple' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $attributes = $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $component = $__componentOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
                                    <?php $__errorArgs = ['service_category_image'];
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
                            <label class="col-md-2"
                                for="name"><?php echo e(__('taxido::static.service_categories.name')); ?><span>
                                    *</span></label>
                            <div class="col-md-10">
                                <div class="position-relative">
                                    <input class="form-control" type="text" id="name" name="name"
                                        value="<?php echo e(isset($serviceCategory->name) ? $serviceCategory->getTranslation('name', request('locale', app()->getLocale())) : old('name')); ?>"
                                        placeholder="<?php echo e(__('taxido::static.service_categories.enter_name')); ?> (<?php echo e(request('locale', app()->getLocale())); ?>)"
                                        required><i class="ri-file-copy-line copy-icon" data-target="#name"></i>
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
                            <label class="col-md-2"
                                for="description"><?php echo e(__('taxido::static.service_categories.description')); ?> <span>
                                    *</span></label>
                            <div class="col-md-10">
                                <div class="position-relative">
                                    <textarea class="form-control"
                                        placeholder="<?php echo e(__('taxido::static.service_categories.enter_description')); ?> (<?php echo e(request('locale', app()->getLocale())); ?>)"
                                        rows="4" id="description" name="description" cols="50"><?php echo e(isset($serviceCategory->description) ? $serviceCategory->getTranslation('description', request('locale', app()->getLocale())) : old('description')); ?></textarea><i class="ri-file-copy-line copy-icon"
                                        data-target="#description"></i>
                                </div>
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

                        <div class="form-group row">
                            <label class="col-md-2"
                                for="zone"><?php echo e(__('taxido::static.service_categories.service')); ?> <span>
                                    *</span></label>
                            <div class="col-md-10 select-label-error">
                                <select class="form-select select-2" id="service_id" name="service_id" data-placeholder="<?php echo e(__('taxido::static.service_categories.select_service')); ?>" required>
                                    <option class="option" value="" selected></option>
                                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($index); ?>"
                                        <?php if(isset($serviceCategory)): ?> <?php if(old('service_id', @$serviceCategory?->service_id) == $index): echo 'selected'; endif; ?> <?php endif; ?>>
                                        <?php echo e($service); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['service_id'];
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
                            <label class="col-md-2" for="status"><?php echo e(__('taxido::static.status')); ?></label>
                            <div class="col-md-10">
                                <div class="editor-space">
                                    <label class="switch">
                                        <input class="form-control" type="hidden" name="status" value="0">
                                        <input class="form-check-input" type="checkbox" name="status" id=""
                                            value="1" <?php if(@$serviceCategory?->status ?? true): echo 'checked'; endif; ?>>
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
                                    <button type="submit" name="save" class="btn btn-primary spinner-btn">
                                        <i class="ri-save-line text-white lh-1"></i> <?php echo e(__('taxido::static.save')); ?>

                                    </button>
                                    <button type="submit" name="save_and_exit" class="btn btn-primary spinner-btn">
                                        <i
                                            class="ri-expand-left-line text-white lh-1"></i><?php echo e(__('taxido::static.save_and_exit')); ?>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
    (function($) {
        "use strict";

        $('#serviceCategoryForm').validate({
            ignore: [],
            rules: {
                "name": "required",
                "description": "required",
                "services[]": "required"
            }
        });
    })(jQuery);
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/admin/service-category/fields.blade.php ENDPATH**/ ?>