<?php use \Modules\Taxido\Models\Zone; ?>
<?php
    $zones = Zone::where('status', true)?->get();
?>
<div class="row g-xl-4 g-3">
    <div class="col-xl-8">
        <div class="left-part">
            <div class="contentbox">
                <div class="inside">
                    <div class="contentbox-title">
                        <h3><?php echo e(isset($vehicleType) ? __('taxido::static.vehicle_types.edit') : __('taxido::static.vehicle_types.add')); ?>

                            (<?php echo e(request('locale', app()->getLocale())); ?>)
                        </h3>
                    </div>
                    <?php if(isset($vehicleType)): ?>
                        <div class="form-group row">
                            <label class="col-md-2" for="name"><?php echo e(__('taxido::static.language.languages')); ?></label>
                            <div class="col-md-10">
                                <ul class="language-list">
                                    <?php $__empty_1 = true; $__currentLoopData = getLanguages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <li>
                                            <a href="<?php echo e(route(getVehicleEditRoute(), ['vehicleType' => $vehicleType->id, 'locale' => $lang->locale])); ?>"
                                                class="language-switcher <?php echo e(request('locale') === $lang->locale ? 'active' : ''); ?>"
                                                target="_blank">
                                                <img src="<?php echo e(@$lang?->flag ?? asset('admin/images/No-image-found.jpg')); ?>"
                                                    alt="">
                                                <?php echo e(@$lang?->name); ?> (<?php echo e(@$lang?->locale); ?>)
                                                <i class="ri-arrow-right-up-line"></i>
                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <li>
                                            <a href="<?php echo e(route(getVehicleEditRoute(), ['vehicle_type' => $vehicleType->id, 'locale' => Session::get('locale', 'en')])); ?>"
                                                class="language-switcher active" target="blank">
                                                <img src="<?php echo e(asset('admin/images/flags/LR.png')); ?>" alt="">
                                                English
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
                        <label class="col-md-2"
                            for="vehicle_image_id"><?php echo e(__('taxido::static.vehicle_types.image')); ?><span>
                                *</span></label>
                        <div class="col-md-10">
                            <div class="form-group">
                                <?php if (isset($component)) { $__componentOriginal22d447e3f5aafc93b8447b54b36ee789 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image','data' => ['text' => __('static.svg_not_supported'),'unallowedTypes' => ['svg'],'name' => 'vehicle_image_id','data' => isset($vehicleType->vehicle_image)
                                    ? $vehicleType?->vehicle_image
                                    : old('vehicle_image_id'),'multiple' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('static.svg_not_supported')),'unallowed_types' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['svg']),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('vehicle_image_id'),'data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($vehicleType->vehicle_image)
                                    ? $vehicleType?->vehicle_image
                                    : old('vehicle_image_id')),'multiple' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $attributes = $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $component = $__componentOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
                                <?php $__errorArgs = ['vehicle_image_id'];
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
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="form-group row">
                                <label class="col-md-2"
                                    for="vehicle_image_id"><?php echo e(__('taxido::static.vehicle_types.map_icon')); ?><span>*</span></label>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <?php if (isset($component)) { $__componentOriginal22d447e3f5aafc93b8447b54b36ee789 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image','data' => ['text' => __('static.svg_only_supported'),'allowedTypes' => ['svg'],'name' => 'vehicle_map_icon_id','data' => isset($vehicleType->vehicle_map_icon)
                                            ? $vehicleType?->vehicle_map_icon
                                            : old('vehicle_map_icon_id'),'multiple' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('static.svg_only_supported')),'allowed_types' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['svg']),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('vehicle_map_icon_id'),'data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($vehicleType->vehicle_map_icon)
                                            ? $vehicleType?->vehicle_map_icon
                                            : old('vehicle_map_icon_id')),'multiple' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $attributes = $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $component = $__componentOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
                                        <?php $__errorArgs = ['vehicle_map_icon_id'];
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

                        <div class="col-12">
                            <div class="form-group row">
                                <label class="col-md-2" for="name"><?php echo e(__('taxido::static.vehicle_types.name')); ?>

                                    <span> *</span></label>
                                <div class="col-md-10">
                                    <div class="position-relative">
                                        <input class="form-control" type="text" id="name" name="name"
                                            value="<?php echo e(isset($vehicleType->name) ? $vehicleType->getTranslation('name', request('locale', app()->getLocale())) : old('name')); ?>"
                                            placeholder="<?php echo e(__('taxido::static.vehicle_types.enter_name')); ?> (<?php echo e(request('locale', app()->getLocale())); ?>)"><i
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
                        </div>


                        <div class="col-12">
                            <div class="form-group row amount-input">
                            <label class="col-md-2" for="description"><?php echo e(__('taxido::static.vehicle_types.description')); ?> </label>
                            <div class="col-md-10">
                                <div class="position-relative">
                                    <textarea class="form-control" rows="4" name="description" id="description"
                                        placeholder="<?php echo e(__('taxido::static.vehicle_types.enter_vehicle_description')); ?> (<?php echo e(request('locale', app()->getLocale())); ?>)"
                                        cols="80"><?php echo e(isset($vehicleType->description) ? $vehicleType->getTranslation('description', request('locale', app()->getLocale())) : old('description')); ?></textarea><i class="ri-file-copy-line copy-icon"
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
                        </div>

                        <div class="col-12">
                            <div class="form-group row">
                                <label class="col-md-2"
                                    for="max_seat"><?php echo e(__('taxido::static.vehicle_types.max_seat')); ?>

                                    <span>*</span></label>
                                <div class="col-md-10">
                                   <input class="form-control" type="number" min="1" name="max_seat"
                                    id="max_seat"
                                    placeholder="<?php echo e(__('taxido::static.vehicle_types.enter_max_seat')); ?>"
                                    value="<?php echo e(old('max_seat', $vehicleType->max_seat ?? '')); ?>"
                                    max="<?php echo e(maximumSeat()); ?>">
                                    <?php $__errorArgs = ['max_seat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback d-block"><strong><?php echo e($message); ?></strong></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="p-sticky">
            <div class="contentbox">
                <div class="inside">
                    <div class="contentbox-title">
                        <h3><?php echo e(__('taxido::static.vehicle_types.publish')); ?></h3>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="d-flex align-items-center gap-2 icon-position">
                                        <button type="submit" name="save" class="btn btn-primary">
                                            <i class="ri-save-line text-white lh-1"></i> <?php echo e(__('static.save')); ?>

                                        </button>
                                        <button type="submit" name="save_and_exit"
                                            class="btn btn-primary spinner-btn">
                                            <i class="ri-expand-left-line text-white lh-1"></i><?php echo e(__('static.save_and_exit')); ?>

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contentbox">
                <div class="inside">
                    <div class="contentbox-title">
                        <h3><?php echo e(__('static.additional_info')); ?></h3>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-12">
                            <div class="form-group row">
                                <label class="col-md-2" for="all_zones"><?php echo e(__('taxido::static.vehicle_types.all_zones')); ?></label>
                                <div class="col-md-10">
                                    <label class="switch">
                                        <input type="hidden" name="is_all_zones" value="0">
                                        <input class="form-check-input" type="checkbox" id="is_all_zones" name="is_all_zones" value="1"
                                            <?php if(old('is_all_zones', $vehicleType->is_all_zones ?? false)): echo 'checked'; endif; ?>>
                                        <span class="switch-state"></span>
                                    </label>
                                    <?php $__errorArgs = ['is_all_zones'];
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

                            <div class="form-group row" id="zones-field">
                                <label class="col-md-2" for="zones"><?php echo e(__('taxido::static.vehicle_types.zones')); ?><span>*</span></label>
                                <div class="col-md-10 select-label-error">
                                    <?php if($zones->isEmpty()): ?>
                                        <span class="text-gray mt-1">
                                            <?php echo e(__('taxido::static.vehicle_types.no_zones_message')); ?>

                                            <a href="<?php echo e(route('admin.zone.index')); ?>" class="text-primary">
                                                <b><?php echo e(__('taxido::static.here')); ?></b>
                                            </a>
                                        </span>
                                    <?php else: ?>
                                        <select class="form-control select-2 zone" name="zones[]" data-placeholder="<?php echo e(__('taxido::static.vehicle_types.select_zones')); ?>" multiple>
                                            <?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($zone->id); ?>"
                                                    <?php if(isset($vehicleType) && !$vehicleType->is_all_zones && $vehicleType->zones->contains($zone->id)): ?>
                                                        selected
                                                    <?php elseif(is_array(old('zones')) && in_array($zone->id, old('zones'))): ?>
                                                        selected
                                                    <?php endif; ?>>
                                                    <?php echo e($zone->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    <?php endif; ?>
                                    <?php $__errorArgs = ['zones'];
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

                            <input type="hidden" name="service" value="<?php echo e($service); ?>">

                            <div class="form-group row">
                                <label class="col-md-2" for="serviceCategories"><?php echo e(__('taxido::static.vehicle_types.service_categories')); ?><span>*</span></label>
                                <div class="col-md-10 select-label-error">
                                    <select class="form-control select-2" id="service_category_id" name="serviceCategories[]"
                                        data-placeholder="<?php echo e(__('taxido::static.vehicle_types.select_service_categories')); ?>" multiple>
                                        <?php $__currentLoopData = $serviceCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $serviceCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($serviceCategory->id); ?>"
                                                <?php if(@$vehicleType?->service_categories): ?>
                                                <?php if(in_array($serviceCategory->id, $vehicleType?->service_categories->pluck('id')->toArray())): ?> selected <?php endif; ?>
                                                <?php elseif(old('serviceCategories.' . $index) == $serviceCategory->id): ?> selected <?php endif; ?>>
                                                <?php echo e($serviceCategory->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['serviceCategories'];
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
                            <div class="col-xl-12 col-md-4 col-sm-6">
                                <div class="form-group row">
                                    <label class="col-12" for="status"><?php echo e(__('taxido::static.vehicle_types.status')); ?></label>
                                    <div class="col-12">
                                        <div class="switch-field form-control">
                                            <input value="1" type="radio" name="status" id="status_active"
                                                <?php if(boolval(@$vehicleType?->status ?? true) == true): echo 'checked'; endif; ?> />
                                            <label for="status_active"><?php echo e(__('static.active')); ?></label>
                                            <input value="0" type="radio" name="status" id="status_deactive"
                                                <?php if(boolval(@$vehicleType?->status ?? true) == false): echo 'checked'; endif; ?> />
                                            <label for="status_deactive"><?php echo e(__('static.deactive')); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {

            // Define global jQuery function
            window.selectCommissionTypeField = function(type) {
                if (type === 'fixed') {
                    $('#currencyIcon').show();
                    $('#percentageIcon').hide();
                } else if (type === 'percentage') {
                    $('#currencyIcon').hide();
                    $('#percentageIcon').show();
                }
                $('#commission_rate_field').show();
            };

            // Attach event listener for commission type change
            $('#commission_type').on('change', function() {
                const selectedType = $(this).val();
                if (selectedType) {
                    window.selectCommissionTypeField(selectedType);
                } else {
                    $('#commission_rate_field').hide();
                }
            });

            function toggleZonesField() {
                if ($('#is_all_zones').is(':checked')) {
                    $('#zones-field').hide();
                    $('.zone option').prop('selected', true);
                    $('.zone').trigger('change');
                    $('input[name="is_all_zones"][type="hidden"]').val('1'); // Set hidden input to 1 when checked
                } else {
                    $('#zones-field').show();
                    $('input[name="is_all_zones"][type="hidden"]').val('0'); // Set hidden input to 0 when unchecked
                }
            }

            $('#is_all_zones').on('change', toggleZonesField);

            toggleZonesField();

            $('#vehicleTypeForm').validate({
                ignore: [],
                rules: {
                    "name": "required",
                    "serviceCategories[]": "required",
                    "max_seat": {
                        required: true,
                        number: true,
                        min: 1,
                    },
                    "zones[]" : "required",
                    "status": "required",
                }
            });

        })
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/admin/vehicle-type/fields.blade.php ENDPATH**/ ?>