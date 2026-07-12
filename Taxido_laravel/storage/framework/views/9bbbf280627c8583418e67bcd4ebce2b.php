<?php use \Modules\Taxido\Models\Zone; ?>
<?php use \Modules\Taxido\Models\FleetManager; ?>
<?php use \Modules\Taxido\Models\Service; ?>
<?php use \Modules\Taxido\Models\VehicleType; ?>
<?php use \Modules\Taxido\Models\ServiceCategory; ?>
<?php use \Modules\Taxido\Enums\ServicesEnum; ?>
<?php
    $vehicleTypes = VehicleType::where('status', true)?->get(['id', 'name']);
    $services = Service::whereNull('deleted_at')?->where('status', true)->pluck('name', 'id');
    $serviceCategories = ServiceCategory::whereNull('deleted_at')?->where('status', true)->get();
    $fleetManagers = FleetManager::whereNull('deleted_at')
        ->where('status', true)
        ->get(['id', 'name', 'email', 'profile_image_id']);

    // Check if find driver service is selected (for both add and edit)
    $findDriverServiceId = \Modules\Taxido\Models\Service::where('slug', 'find-driver')->first()->id ?? 0;
    $isFindDriverService = false;

    // For edit mode
    if (isset($driver) && isset($driver->service_id)) {
        $isFindDriverService = $driver->service_id == $findDriverServiceId;
    }
    // For add mode (check old input)
    if (old('service_id')) {
        $isFindDriverService = old('service_id') == $findDriverServiceId;
    }
?>
<div class="row">
    <div class="col-12">
        <div class="row g-xl-4 g-3">
            <div class="col-xl-10 col-xxl-8 mx-auto">
                <div class="contentbox">
                    <div class="inside">

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="contentbox-title">
                            <h3><?php echo e(isset($driver) ? __('taxido::static.drivers.edit') : __('taxido::static.drivers.add')); ?>

                            </h3>


                        </div>
                        <ul class="nav nav-tabs horizontal-tab custom-scroll" id="account" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile"
                                    type="button" role="tab" aria-controls="profile" aria-selected="true">
                                    <i class="ri-shield-user-line"></i>
                                    <?php echo e(__('taxido::static.drivers.general')); ?>

                                    <i class="ri-error-warning-line danger errorIcon"></i>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" type="button"
                                    role="tab" aria-controls="address" aria-selected="true">
                                    <i class="ri-rotate-lock-line"></i>
                                    <?php echo e(__('taxido::static.drivers.address')); ?>

                                    <i class="ri-error-warning-line danger errorIcon"></i>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="vehicle-tab" data-bs-toggle="tab" href="#vehicle" type="button"
                                    role="tab" aria-controls="vehicle" aria-selected="true">
                                    <i class="ri-shield-user-line"></i>
                                    <?php echo e(__('taxido::static.drivers.vehicle')); ?>

                                    <i class="ri-error-warning-line danger errorIcon"></i>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="payout-tab" data-bs-toggle="tab" href="#payout" type="button"
                                    role="tab" aria-controls="payout" aria-selected="true">
                                    <i class="ri-rotate-lock-line"></i>
                                    <?php echo e(__('taxido::static.drivers.payout_details')); ?>

                                    <i class="ri-error-warning-line danger errorIcon"></i>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="additionalInfo-tab" data-bs-toggle="tab" href="#additionalInfo"
                                    type="button" role="tab" aria-controls="additionalInfo" aria-selected="true">
                                    <i class="ri-rotate-lock-line"></i>
                                    <?php echo e(__('taxido::static.drivers.additional_info')); ?>

                                    <i class="ri-error-warning-line danger errorIcon"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="accountContent">
                            <div class="tab-pane fade  <?php echo e(session('active_tab') != null ? '' : 'show active'); ?>"
                                id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="form-group row">
                                    <label class="col-md-2"
                                        for="profile_image_id"><?php echo e(__('taxido::static.drivers.profile_image')); ?><span>*</span></label>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <?php if (isset($component)) { $__componentOriginal22d447e3f5aafc93b8447b54b36ee789 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image','data' => ['name' => 'profile_image_id','data' => isset($driver->profile_image)
                                                ? $driver?->profile_image
                                                : old('profile_image_id'),'text' => ' ','multiple' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('profile_image_id'),'data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($driver->profile_image)
                                                ? $driver?->profile_image
                                                : old('profile_image_id')),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(' '),'multiple' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $attributes = $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $component = $__componentOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
                                            <?php $__errorArgs = ['profile_image_id'];
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
                                    <label class="col-md-2" for="name"><?php echo e(__('taxido::static.drivers.full_name')); ?>

                                        <span> *</span> </label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" id="name" name="name"
                                            placeholder="<?php echo e(__('taxido::static.drivers.enter_full_name')); ?>"
                                            value="<?php echo e(isset($driver->name) ? $driver->name : old('name')); ?>">
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
                                    <label class="col-md-2" for="email"><?php echo e(__('taxido::static.drivers.email')); ?>

                                        <span>*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <?php if(isset($driver) && isDemoModeEnabled()): ?>
                                            <input class="form-control" value="<?php echo e(__('static.demo_mode')); ?>"
                                                type="text" readonly>
                                        <?php else: ?>
                                            <input class="form-control" type="email" name="email"
                                                placeholder="<?php echo e(__('taxido::static.drivers.enter_email')); ?>"
                                                value="<?php echo e(isset($driver->email) ? $driver->email : old('email')); ?>">
                                        <?php endif; ?>
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

                                <div class="form-group row">
                                    <label class="col-md-2"
                                        for="phone"><?php echo e(__('taxido::static.drivers.phone')); ?><span>*</span></label>
                                    <div class="col-md-10">
                                        <?php if(isset($driver) && isDemoModeEnabled()): ?>
                                            <input class="form-control" value="<?php echo e(__('static.demo_mode')); ?>"
                                                type="text" readonly>
                                        <?php else: ?>
                                            <div class="input-group mb-3 phone-detail">
                                                <div class="col-sm-1">
                                                    <select class="select-2 form-control" id="select-country-code"
                                                        name="country_code">
                                                        <?php $__currentLoopData = getCountryCodes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option class="option"
                                                                value="<?php echo e($option->calling_code); ?>"
                                                                data-image="<?php echo e(asset('images/flags/' . $option->flag)); ?>"
                                                                <?php if($option->calling_code == old('country_code', $driver->country_code ?? '1')): echo 'selected'; endif; ?>>
                                                                <?php echo e($option->calling_code); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-11">
                                                    <input class="form-control" type="number" name="phone"
                                                        value="<?php echo e(old('phone', $driver->phone ?? '')); ?>"
                                                        placeholder="<?php echo e(__('taxido::static.drivers.enter_phone')); ?>"
                                                        required>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php $__errorArgs = ['phone'];
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

                                <?php if(request()->routeIs('admin.driver.create')): ?>
                                    <div class="form-group row">
                                        <label class="col-md-2"
                                            for="password"><?php echo e(__('taxido::static.drivers.new_password')); ?><span>
                                                *</span></label>
                                        <div class="col-md-10">
                                            <div class="position-relative">
                                                <input class="form-control" type="password" id="password"
                                                    name="password"
                                                    placeholder="<?php echo e(__('taxido::static.drivers.enter_password')); ?>">
                                                <i class="ri-eye-line toggle-password"></i>
                                            </div>
                                            <?php $__errorArgs = ['password'];
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
                                            for="confirm_password"><?php echo e(__('taxido::static.drivers.confirm_password')); ?><span>
                                                *</span></label>
                                        <div class="col-md-10">
                                            <div class="position-relative">
                                                <input class="form-control" type="password" name="confirm_password"
                                                    placeholder="<?php echo e(__('taxido::static.drivers.enter_confirm_password')); ?>"
                                                    required>
                                                <i class="ri-eye-line toggle-password"></i>
                                            </div>
                                            <?php $__errorArgs = ['confirm_password'];
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
                                        <label class="col-md-2 mb-0"
                                            for="notify"><?php echo e(__('taxido::static.drivers.notification')); ?></label>
                                        <div class="col-md-10">
                                            <div class="form-check p-0 w-auto">
                                                <input type="checkbox" name="notify" id="notify" value="1"
                                                    class="form-check-input me-2">
                                                <label
                                                    for="notify"><?php echo e(__('taxido::static.drivers.sentence')); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="footer">
                                    <button type="button"
                                        class="nextBtn btn btn-primary"><?php echo e(__('static.next')); ?></button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                <div class="form-group row">
                                    <label for="address[address]"
                                        class="col-md-2"><?php echo e(__('taxido::static.drivers.address')); ?><span>
                                            *</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control ui-widget autocomplete-google"
                                            id="address-input" name="address[address]"
                                            placeholder="<?php echo e(__('taxido::static.drivers.enter_address')); ?>"
                                            value="<?php echo e(old('address.address', @$driver->address->address)); ?>">
                                        <?php $__errorArgs = ['address.address'];
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
                                    <label for="address[street_address]"
                                        class="col-md-2"><?php echo e(__('taxido::static.drivers.street_address')); ?></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control ui-widget" id="street_address_1"
                                            name="address[street_address]"
                                            placeholder="<?php echo e(__('taxido::static.drivers.enter_street_address')); ?>"
                                            value="<?php echo e(@$driver->address ? $driver->address?->street_address : old('address.street_address')); ?>">
                                    </div>
                                    <?php $__errorArgs = ['address.street_address'];
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
                                        for="address[area_locality]"><?php echo e(__('taxido::static.drivers.area_locality')); ?>

                                    </label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="address[area_locality]"
                                            placeholder="<?php echo e(__('taxido::static.drivers.enter_area_locality')); ?>"
                                            value="<?php echo e(@$driver?->address ? $driver?->address?->area_locality : old('address.area_locality')); ?>"
                                            id="area_locality">
                                        <?php $__errorArgs = ['address.area_locality'];
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
                                    <label for="address[country_id]"
                                        class="col-md-2"><?php echo e(__('taxido::static.drivers.country')); ?><span>
                                            *</span></label>
                                    <div class="col-md-10 select-label-error">
                                        <select class="select-2 form-control select-country" id="country_id"
                                            name="address[country_id]"
                                            data-placeholder="<?php echo e(__('taxido::static.drivers.select_country')); ?>">
                                            <option class="option" value="" selected></option>
                                            <?php $__currentLoopData = getCountries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($key); ?>" <?php if(old('address.country_id', @$driver?->address?->country_id) == $key): echo 'selected'; endif; ?>>
                                                    <?php echo e($option); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['address.country_id'];
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
                                        for="address[state]"><?php echo e(__('taxido::static.drivers.state')); ?>

                                        <span>*</span></label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="address[state]"
                                            placeholder="<?php echo e(__('taxido::static.drivers.enter_state')); ?>"
                                            value="<?php echo e(@$driver?->address ? $driver?->address?->state : old('address.state')); ?>">
                                        <?php $__errorArgs = ['address.state'];
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
                                        for="address[city]"><?php echo e(__('taxido::static.drivers.city')); ?>

                                        <span> *</span></label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="address[city]"
                                            placeholder="<?php echo e(__('taxido::static.drivers.enter_city')); ?>"
                                            value="<?php echo e(@$driver?->address ? $driver?->address?->city : old('address.city')); ?>"
                                            id="city">
                                        <?php $__errorArgs = ['address.city'];
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
                                        for="address[postal_code]"><?php echo e(__('taxido::static.drivers.postal_code')); ?>

                                        <span>
                                            *</span></label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="address[postal_code]"
                                            placeholder="<?php echo e(__('taxido::static.drivers.enter_postal_code')); ?>"
                                            value="<?php echo e(@$driver?->address ? $driver?->address?->postal_code : old('address.postal_code')); ?>"
                                            id="postal_code">
                                        <?php $__errorArgs = ['address.postal_code'];
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

                                <div class="footer">
                                    <button type="button"
                                        class="previousBtn bg-light-primary btn cancel"><?php echo e(__('static.previous')); ?></button>
                                    <button type="button"
                                        class="nextBtn btn btn-primary"><?php echo e(__('static.next')); ?></button>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="vehicle" role="tabpanel" aria-labelledby="vehicle-tab">
                                <div class="form-group row">
                                    <label class="col-md-2"
                                        for="fleet_manager_id"><?php echo e(__('taxido::static.drivers.fleet_manager')); ?></label>
                                    <div class="col-md-10 select-label-error">
                                        <select class="form-select select-2" id="fleet_manager_id"
                                            name="fleet_manager_id"
                                            data-placeholder="<?php echo e(__('taxido::static.drivers.select_fleet_manager')); ?>">
                                            <option class="option" value=""></option>
                                            <?php $__currentLoopData = $fleetManagers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($manager->id); ?>" data-name="<?php echo e($manager->name); ?>"
                                                    data-email="<?php echo e($manager->email); ?>"
                                                    <?php if(isset($driver)): ?> <?php if(old('fleet_manager_id', $driver->fleet_manager_id) == $manager->id): echo 'selected'; endif; ?>
                                                    <?php else: ?> <?php if(old('fleet_manager_id') == $manager->id): echo 'selected'; endif; ?> <?php endif; ?>>
                                                    <?php echo e($manager->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['fleet_manager_id'];
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
                                        for="service"><?php echo e(__('taxido::static.service_categories.service')); ?>

                                        <span>*</span></label>
                                    <div class="col-md-10 select-label-error">
                                        <select class="form-select select-2" id="service_id" name="service_id"
                                            data-placeholder="<?php echo e(__('taxido::static.service_categories.select_service')); ?>">
                                            <option class="option" value="" selected></option>
                                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($index); ?>"
                                                    <?php if(isset($driver)): ?> <?php if(old('service_id', $driver->service_id) == $index): echo 'selected'; endif; ?> <?php else: ?> <?php if(old('service_id') == $index): echo 'selected'; endif; ?> <?php endif; ?>>
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

                                <div class="form-group row" id="service_category_container">
                                    <label class="col-md-2"
                                        for="serviceCategories"><?php echo e(__('taxido::static.vehicle_types.service_categories')); ?><span>
                                            *</span></label>
                                    <div class="col-md-10 select-label-error">
                                        <select class="form-control select-2" id="service_category_id"
                                            name="service_category_id"
                                            data-placeholder="<?php echo e(__('taxido::static.vehicle_types.select_service_categories')); ?>">
                                            <option value=""></option>
                                            <?php if(isset($driver) && $driver->service_category_id): ?>
                                                <?php $__currentLoopData = $serviceCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($serviceCategory->id); ?>"
                                                        <?php if($driver->service_category_id == $serviceCategory->id || old('service_category_id') == $serviceCategory->id): ?> selected <?php endif; ?>>
                                                        <?php echo e($serviceCategory->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php $__errorArgs = ['service_category_id'];
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

                                <!-- Vehicle Fields Container - Hidden for find driver service (both add and edit) -->
                                <div id="vehicle_fields_container"
                                    <?php if($isFindDriverService): ?> style="display: none;" <?php endif; ?>>

                                    <!-- Vehicle Type - Always visible -->
                                    <div class="form-group row" id="vehicle_type_field">
                                        <label class="col-md-2"
                                            for="vehicle_info[vehicle_type_id]"><?php echo e(__('taxido::static.drivers.vehicle')); ?><span>*</span></label>
                                        <div class="col-md-10 select-label-error">
                                            <select class="form-control select-2 vehicle" id="vehicle_type_id"
                                                name="vehicle_info[vehicle_type_id]"
                                                data-placeholder="<?php echo e(__('taxido::static.drivers.select_vehicle')); ?>">
                                                <option value=""></option>
                                                <?php $__currentLoopData = $vehicleTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($vehicle->id); ?>"
                                                        <?php if(old('vehicle_info.vehicle_type_id', @$driver?->vehicle_info?->vehicle_type_id) == $vehicle->id): ?> selected <?php endif; ?>>
                                                        <?php echo e($vehicle->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['vehicle_info.vehicle_type_id'];
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

                                    <!-- Model - Hide for Find Driver -->
                                    <div class="form-group row vehicle_detail_field" id="vehicle_model_field">
                                        <label class="col-md-2"
                                            for="vehicle_info[model]"><?php echo e(__('taxido::static.drivers.model')); ?>

                                            <span> *</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" name="vehicle_info[model]"
                                                placeholder="<?php echo e(__('taxido::static.drivers.enter_model')); ?>"
                                                value="<?php echo e(@$driver?->vehicle_info ? $driver?->vehicle_info?->model : old('vehicle_info.model')); ?>">
                                            <?php $__errorArgs = ['vehicle_info.model'];
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

                                    <!-- Plate Number - Hide for Find Driver -->
                                    <div class="form-group row vehicle_detail_field" id="vehicle_plate_field">
                                        <label class="col-md-2"
                                            for="vehicle_info[plate_number]"><?php echo e(__('taxido::static.drivers.plate_number')); ?>

                                            <span>*</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text"
                                                name="vehicle_info[plate_number]"
                                                placeholder="<?php echo e(__('taxido::static.drivers.enter_plate_number')); ?>"
                                                value="<?php echo e(@$driver?->vehicle_info ? $driver?->vehicle_info?->plate_number : old('vehicle_info.plate_number')); ?>">
                                            <?php $__errorArgs = ['vehicle_info.plate_number'];
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

                                    <!-- Seat - Hide for Find Driver -->
                                    <div class="form-group row vehicle_detail_field" id="vehicle_seat_field">
                                        <label class="col-md-2"
                                            for="vehicle_info[seat]"><?php echo e(__('taxido::static.drivers.seat')); ?>

                                            <span> *</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="number" min="1"
                                                max="<?php echo e(maximumSeat()); ?>" name="vehicle_info[seat]"
                                                placeholder="<?php echo e(__('taxido::static.drivers.enter_seat')); ?>"
                                                value="<?php echo e(@$driver?->vehicle_info ? $driver?->vehicle_info?->seat : old('vehicle_info.seat')); ?>">
                                            <?php $__errorArgs = ['vehicle_info.seat'];
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

                                    <!-- Color - Hide for Find Driver -->
                                    <div class="form-group row vehicle_detail_field" id="vehicle_color_field">
                                        <label for="vehicle_info[color]" class="col-md-2">
                                            <?php echo e(__('taxido::static.drivers.color')); ?><span>*</span>
                                        </label>
                                        <div class="col-md-10 select-label-error">
                                            <select class="select-2 form-control" id="vehicle_info[color]"
                                                name="vehicle_info[color]"
                                                data-placeholder="<?php echo e(__('taxido::static.drivers.enter_color')); ?>">
                                                <?php $__currentLoopData = ['White', 'Black', 'Red', 'Silver', 'Blue', 'Brown', 'Green', 'Yellow']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option class="option" value="<?php echo e($option); ?>"
                                                        <?php if($option == old('vehicle_info.color', $driver?->vehicle_info?->color ?? '')): echo 'selected'; endif; ?>>
                                                        <?php echo e($option); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['vehicle_info.color'];
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

                                <!-- Find Driver Container - Show for find driver service only -->
                                <div id="find_driver_container"
                                    <?php if(!$isFindDriverService): ?> style="display:none" <?php endif; ?>>
                                    <!-- Experience Field -->
                                    <div class="form-group row">
                                        <label class="col-md-2" for="experience">
                                            <?php echo e(__('taxido::static.drivers.experience')); ?><span>*</span>
                                        </label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="number" min="0" max="100"
                                                name="experience" id="experience"
                                                placeholder="<?php echo e(__('taxido::static.drivers.experience_desc')); ?>"
                                                value="<?php echo e(old('experience', @$driver?->experience)); ?>">
                                            <?php $__errorArgs = ['experience'];
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

                                    <!-- Price Per Type - Multiple Select Dropdown -->
                                    <div class="form-group row">
                                        <label class="col-md-2" for="price_per_type">
                                            <?php echo e(__('taxido::static.drivers.price_per_type')); ?><span>*</span>
                                        </label>
                                        <div class="col-md-10 select-label-error">
                                            <select class="form-control select-2" id="price_per_type"
                                                name="price_per_type[]" multiple="multiple"
                                                data-placeholder="<?php echo e(__('taxido::static.drivers.select_price_types')); ?>">
                                                <option value="per_km_charge"
                                                    <?php echo e(in_array('per_km_charge', old('price_per_type', @$driver?->price_per_type ?? [])) ? 'selected' : ''); ?>>
                                                    <?php echo e(__('taxido::static.drivers.per_km_charge')); ?>

                                                </option>
                                                <option value="per_hour_charge"
                                                    <?php echo e(in_array('per_hour_charge', old('price_per_type', @$driver?->price_per_type ?? [])) ? 'selected' : ''); ?>>
                                                    <?php echo e(__('taxido::static.drivers.per_hour_charge')); ?>

                                                </option>
                                                <option value="per_day_charge"
                                                    <?php echo e(in_array('per_day_charge', old('price_per_type', @$driver?->price_per_type ?? [])) ? 'selected' : ''); ?>>
                                                    <?php echo e(__('taxido::static.drivers.per_day_charge')); ?>

                                                </option>
                                            </select>
                                            <?php $__errorArgs = ['price_per_type'];
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
                                            <?php $__errorArgs = ['price_per_type.*'];
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

                                    <!-- Gear Type - Single Select Dropdown -->
                                    <div class="form-group row">
                                        <label class="col-md-2" for="gear_type">
                                            <?php echo e(__('taxido::static.drivers.gear_type')); ?><span>*</span>
                                        </label>
                                        <div class="col-md-10 select-label-error">
                                            <select class="form-control select-2" id="gear_type" name="gear_type"
                                                data-placeholder="<?php echo e(__('taxido::static.drivers.select_gear_type')); ?>">
                                                <option value=""></option>
                                                <option value="automatic"
                                                    <?php echo e(old('gear_type', @$driver?->gear_type) == 'automatic' ? 'selected' : ''); ?>>
                                                    <?php echo e(__('taxido::static.drivers.automatic')); ?>

                                                </option>
                                                <option value="manual"
                                                    <?php echo e(old('gear_type', @$driver?->gear_type) == 'manual' ? 'selected' : ''); ?>>
                                                    <?php echo e(__('taxido::static.drivers.manual')); ?>

                                                </option>
                                            </select>
                                            <?php $__errorArgs = ['gear_type'];
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

                                    <!-- Per KM Charge -->
                                    <div class="form-group row">
                                        <label class="col-md-2" for="per_km_charge">
                                            <?php echo e(__('taxido::static.drivers.per_km_charge')); ?><span>*</span>
                                        </label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="number" step="0.01" min="0"
                                                name="per_km_charge" id="per_km_charge"
                                                placeholder="<?php echo e(__('taxido::static.drivers.enter_per_km_charge')); ?>"
                                                value="<?php echo e(old('per_km_charge', @$driver?->per_km_charge)); ?>">
                                            <?php $__errorArgs = ['per_km_charge'];
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

                                    <!-- Per Hour Charge -->
                                    <div class="form-group row">
                                        <label class="col-md-2" for="per_hour_charge">
                                            <?php echo e(__('taxido::static.drivers.per_hour_charge')); ?><span>*</span>
                                        </label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="number" step="0.01" min="0"
                                                name="per_hour_charge" id="per_hour_charge"
                                                placeholder="<?php echo e(__('taxido::static.drivers.enter_per_hour_charge')); ?>"
                                                value="<?php echo e(old('per_hour_charge', @$driver?->per_hour_charge)); ?>">
                                            <?php $__errorArgs = ['per_hour_charge'];
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

                                    <!-- Per Day Charge -->
                                    <div class="form-group row">
                                        <label class="col-md-2" for="per_day_charge">
                                            <?php echo e(__('taxido::static.drivers.per_day_charge')); ?><span>*</span>
                                        </label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="number" step="0.01" min="0"
                                                name="per_day_charge" id="per_day_charge"
                                                placeholder="<?php echo e(__('taxido::static.drivers.enter_per_day_charge')); ?>"
                                                value="<?php echo e(old('per_day_charge', @$driver?->per_day_charge)); ?>">
                                            <?php $__errorArgs = ['per_day_charge'];
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

                                <!-- Ambulance Fields -->
                                <div id="ambulance_fields_container" style="display:none">
                                    <div class="form-group row">
                                        <label class="col-md-2"
                                            for="vehicle_info[name]"><?php echo e(__('taxido::static.drivers.ambulance_name')); ?>

                                            <span> *</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" name="ambulance[name]"
                                                placeholder="<?php echo e(__('taxido::static.drivers.enter_ambulance_name')); ?>"
                                                value="<?php echo e(@$driver?->ambulance ? $driver?->ambulance?->name : old('vehicle_info.name')); ?>">
                                            <?php $__errorArgs = ['vehicle_info.name'];
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
                                            for="vehicle_info[description]"><?php echo e(__('taxido::static.drivers.ambulance_description')); ?>

                                            <span> *</span></label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" name="ambulance[description]"
                                                placeholder="<?php echo e(__('taxido::static.drivers.enter_ambulance_description')); ?>"
                                                value="<?php echo e(@$driver?->ambulance ? $driver?->ambulance?->description : old('vehicle_info.description')); ?>">
                                            <?php $__errorArgs = ['vehicle_info.description'];
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

                                <div class="footer mt-4">
                                    <button type="button"
                                        class="previousBtn bg-light-primary btn cancel"><?php echo e(__('static.previous')); ?></button>
                                    <button type="button"
                                        class="nextBtn btn btn-primary"><?php echo e(__('static.next')); ?></button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="payout" role="tabpanel" aria-labelledby="payout-tab">

                                <div class="form-group row">
                                    <label class="col-md-2"
                                        for="bank_account_no"><?php echo e(__('taxido::static.drivers.bank_account_no')); ?>

                                        <span>
                                            *</span></label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text"
                                            name="payment_account[bank_account_no]"
                                            placeholder="<?php echo e(__('taxido::static.drivers.enter_bank_account')); ?>"
                                            value="<?php echo e(@$driver?->payment_account ? $driver?->payment_account?->bank_account_no : old('payment_account.bank_account_no')); ?>">
                                        <?php $__errorArgs = ['payment_account.bank_account_no'];
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
                                        for="bank_name"><?php echo e(__('taxido::static.drivers.bank_name')); ?>

                                        <span> *</span></label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="payment_account[bank_name]"
                                            placeholder="<?php echo e(__('taxido::static.drivers.enter_bank_name')); ?>"
                                            value="<?php echo e(@$driver?->payment_account ? $driver?->payment_account?->bank_name : old('payment_account.bank_name')); ?>">
                                        <?php $__errorArgs = ['payment_account.bank_name'];
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
                                        for="bank_holder_name"><?php echo e(__('taxido::static.drivers.holder_name')); ?> <span>
                                            *</span></label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text"
                                            name="payment_account[bank_holder_name]"
                                            placeholder="<?php echo e(__('taxido::static.drivers.enter_holder_name')); ?>"
                                            value="<?php echo e(@$driver?->payment_account ? $driver?->payment_account?->bank_holder_name : old('payment_account.bank_holder_name')); ?>">
                                        <?php $__errorArgs = ['payment_account.bank_holder_name'];
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
                                    <label class="col-md-2" for="swift"><?php echo e(__('taxido::static.drivers.swift')); ?>

                                        <span>
                                            *</span></label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="payment_account[swift]"
                                            placeholder="<?php echo e(__('taxido::static.drivers.enter_swift_code')); ?>"
                                            value="<?php echo e(@$driver?->payment_account ? $driver?->payment_account?->swift : old('payment_account.swift')); ?>">
                                        <?php $__errorArgs = ['payment_account.swift'];
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
                                    <label class="col-md-2" for="routing_number">
                                        <?php echo e(__('taxido::static.drivers.routing_number')); ?>

                                        <span>*</span>
                                    </label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text"
                                            name="payment_account[routing_number]"
                                            placeholder="<?php echo e(__('taxido::static.drivers.enter_routing_number')); ?>"
                                            value="<?php echo e(@$driver?->payment_account?->routing_number ?? old('payment_account.routing_number')); ?>">
                                        <?php $__errorArgs = ['payment_account.routing_number'];
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
                                        for="paypal_email"><?php echo e(__('taxido::static.drivers.paypal_email')); ?>

                                        <span> *</span></label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text"
                                            name="payment_account[paypal_email]"
                                            placeholder="<?php echo e(__('taxido::static.drivers.enter_paypal_email')); ?>"
                                            value="<?php echo e($driver?->payment_account?->paypal_email ?? old('payment_account.enter_paypal_email')); ?>">
                                        <?php $__errorArgs = ['payment_account.paypal_email'];
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
                                    <label for="default" class="col-md-2">
                                        <?php echo e(__('taxido::static.drivers.default')); ?><span>*</span>
                                    </label>
                                    <div class="col-md-10 select-label-error">
                                        <select class="select-2 form-control" id="default" name="default"
                                            data-placeholder="<?php echo e(__('taxido::static.drivers.select_default')); ?>">
                                            <option class="option" value="" selected></option>
                                            <option value="bank" <?php if(old('default', @$driver?->payment_account?->default) == 'bank'): echo 'selected'; endif; ?>>
                                                <?php echo e(__('taxido::static.drivers.bank')); ?>

                                            </option>
                                            <option value="paypal" <?php if(old('default', @$driver?->payment_account?->default) == 'paypal'): echo 'selected'; endif; ?>>
                                                <?php echo e(__('taxido::static.drivers.paypal')); ?>

                                            </option>
                                        </select>
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

                                <div class="footer">
                                    <button type="button"
                                        class="previousBtn bg-light-primary btn cancel"><?php echo e(__('static.previous')); ?></button>
                                    <button class="nextBtn btn btn-primary"
                                        type="button"><?php echo e(__('static.next')); ?></button>
                                </div>
                            </div>
                            <div class="tab-pane fade <?php echo e(session('active_tab') == 'additionalInfo-tab' ? 'show active' : ''); ?>"
                                id="additionalInfo" role="tabpanel" aria-labelledby="additionalInfo-tab">

                                <div class="form-group row">
                                    <label class="col-md-2"
                                        for="location"><?php echo e(__('taxido::static.drivers.location')); ?></label>
                                    <div class="col-md-10 position-relative">
                                        <input type="hidden" name="location" id="location"
                                            value='<?php echo json_encode(isset($driver->location) ? $driver->location : [], 15, 512) ?>'>
                                        <input id="map-search" type="text"
                                            placeholder="<?php echo e(__('taxido::static.drivers.search_location')); ?>"
                                            class="form-control map-search-box">

                                        <div id="map" class="google-map-container"></div>
                                        <p id="location-error" class="invalid-feedback d-block" role="alert"></p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2"
                                        for="is_online"><?php echo e(__('taxido::static.drivers.is_online')); ?></label>
                                    <div class="col-md-10">
                                        <div class="switch-field form-control">
                                            <input value="1" type="radio" name="is_online"
                                                id="is_online_active" <?php if(@$driver?->is_online === 1): echo 'checked'; endif; ?> />
                                            <label for="is_online_active"><?php echo e(__('taxido::static.active')); ?></label>
                                            <input value="0" type="radio" name="is_online"
                                                id="is_online_inactive" <?php if(@$driver?->is_online === 0 || @$driver?->is_online === null): echo 'checked'; endif; ?> />
                                            <label
                                                for="is_online_inactive"><?php echo e(__('taxido::static.deactive')); ?></label>
                                        </div>
                                        <?php $__errorArgs = ['is_online'];
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
                                        for="is_verified"><?php echo e(__('taxido::static.drivers.is_verified')); ?></label>
                                    <div class="col-md-10">
                                        <div class="switch-field form-control">
                                            <input value="1" type="radio" name="is_verified"
                                                id="is_verified_active" <?php if(@$driver?->is_verified === 1): echo 'checked'; endif; ?> />
                                            <label for="is_verified_active"><?php echo e(__('taxido::static.active')); ?></label>
                                            <input value="0" type="radio" name="is_verified"
                                                id="is_verified_inactive" <?php if(@$driver?->is_verified === 0 || @$driver?->is_verified === null): echo 'checked'; endif; ?> />
                                            <label
                                                for="is_verified_inactive"><?php echo e(__('taxido::static.deactive')); ?></label>
                                        </div>
                                        <?php $__errorArgs = ['is_verified'];
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
                                        for="is_on_ride"><?php echo e(__('taxido::static.drivers.is_on_ride')); ?></label>
                                    <div class="col-md-10">
                                        <div class="switch-field form-control">
                                            <input value="1" type="radio" name="is_on_ride"
                                                id="is_on_ride_active" <?php if(@$driver?->is_on_ride === 1): echo 'checked'; endif; ?> />
                                            <label for="is_on_ride_active"><?php echo e(__('taxido::static.active')); ?></label>
                                            <input value="0" type="radio" name="is_on_ride"
                                                id="is_on_ride_inactive" <?php if(@$driver?->is_on_ride === 0 || @$driver?->is_on_ride === null): echo 'checked'; endif; ?> />
                                            <label
                                                for="is_on_ride_inactive"><?php echo e(__('taxido::static.deactive')); ?></label>
                                        </div>
                                        <?php $__errorArgs = ['is_on_ride'];
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
                                    <label class="col-md-2" for="status"><?php echo e(__('taxido::static.status')); ?>

                                    </label>
                                    <div class="col-md-10">
                                        <div class="switch-field form-control">
                                            <input value="1" type="radio" name="status" id="status_active"
                                                <?php if(@$driver?->status === 1): echo 'checked'; endif; ?> />
                                            <label for="status_active"><?php echo e(__('taxido::static.active')); ?></label>
                                            <input value="0" type="radio" name="status" id="status_deactive"
                                                <?php if(@$driver?->status === 0 || @$driver?->status === null): echo 'checked'; endif; ?> />
                                            <label for="status_deactive"><?php echo e(__('taxido::static.deactive')); ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="submit-btn">
                                            <button type="button"
                                                class="previousBtn bg-light-primary btn cancel"><?php echo e(__('static.previous')); ?></button>
                                            <button type="submit" name="save"
                                                class="btn btn-solid spinner-btn submitBtn">
                                                <i
                                                    class="ri-save-line text-white lh-1"></i><?php echo e(__('taxido::static.save')); ?>

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
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/firebase/firebase-app-compat.js')); ?>"></script>
    <script src="<?php echo e(asset('js/firebase/firebase-firestore-compat.js')); ?>"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(env('GOOGLE_MAP_API_KEY')); ?>&libraries=places"></script>
    <script>
        // Firebase configuration
        const firebaseConfig = {
            apiKey: "<?php echo e(env('FIREBASE_API_KEY')); ?>",
            authDomain: "<?php echo e(env('FIREBASE_AUTH_DOMAIN')); ?>",
            projectId: "<?php echo e(env('FIREBASE_PROJECT_ID')); ?>",
            storageBucket: "<?php echo e(env('FIREBASE_STORAGE_BUCKET')); ?>",
            messagingSenderId: "<?php echo e(env('FIREBASE_MESSAGING_SENDER_ID')); ?>",
            appId: "<?php echo e(env('FIREBASE_APP_ID')); ?>",
            measurementId: "<?php echo e(env('FIREBASE_MEASUREMENT_ID')); ?>"
        };

        firebase.initializeApp(firebaseConfig);
        const db = firebase.firestore();

        (function($) {
            "use strict";

            let map, marker;
            const defaultLocation = {
                lat: -1.3119705387570564,
                lng: 36.90288910995129
            };
            const ambulanceServiceId =
                <?php echo e(\Modules\Taxido\Models\Service::where('slug', 'ambulance')->first()->id ?? 0); ?>;
            const findDriverServiceId =
                <?php echo e(\Modules\Taxido\Models\Service::where('slug', 'find-driver')->first()->id ?? 0); ?>;

            const selectedVehicleId =
                "<?php echo e(old('vehicle_info.vehicle_type_id', @$driver?->vehicle_info?->vehicle_type_id)); ?>";

            // Check if find driver service is selected
            const isFindDriverService = <?php echo e($isFindDriverService ? 'true' : 'false'); ?>;

            let isAmbulanceSelected = false;
            let isFindDriverSelected = false;
            const driverId = "<?php echo e(@$driver?->id ?? '0'); ?>";

            function initGoogleFeatures() {
                if (typeof google !== 'undefined' && typeof google.maps !== 'undefined' && typeof google.maps.places !==
                    'undefined') {
                    initializeMap();
                    initializeAutocomplete();
                    listenToDriverLocation();
                    loadInitialOnlineStatus();
                } else {
                    setTimeout(initGoogleFeatures, 100);
                }
            }

            function loadInitialOnlineStatus() {
                if (driverId && driverId !== '0') {
                    db.collection("driverTrack").doc(driverId).get()
                        .then((doc) => {
                            if (doc.exists && doc.data().is_online !== undefined) {
                                const isOnline = doc.data().is_online === "1";
                                $(`#is_online_${isOnline ? 'active' : 'inactive'}`).prop('checked', true);
                            }
                        })
                        .catch(error => console.error("Error getting initial status:", error));
                }
            }

            function updateDriverOnlineStatus(isOnline) {
                if (driverId && driverId !== '0') {
                    db.collection("driverTrack").doc(driverId).set({
                            is_online: isOnline,
                            timestamp: firebase.firestore.FieldValue.serverTimestamp()
                        }, {
                            merge: true
                        })
                        .then(() => console.log("Driver online status updated to:", isOnline))
                        .catch(error => {
                            console.error("Error updating online status:", error);
                            alert("Failed to update online status. Please try again.");
                        });
                }
            }

            function initializeMap() {
                let locationInput = $('#location').val();
                let location = defaultLocation;

                if (locationInput) {
                    try {
                        let parsed = JSON.parse(locationInput);
                        if (Array.isArray(parsed) && parsed.length > 0) {
                            location = parsed[0];
                        } else if (parsed.lat && parsed.lng) {
                            location = parsed;
                        }
                    } catch (e) {
                        console.warn("Invalid location JSON:", e);
                    }
                }

                map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 12,
                    center: location
                });

                const input = document.getElementById("map-search");
                const searchBox = new google.maps.places.SearchBox(input);

                map.addListener("bounds_changed", () => searchBox.setBounds(map.getBounds()));

                searchBox.addListener("places_changed", () => {
                    const places = searchBox.getPlaces();
                    if (places.length === 0) return;

                    const place = places[0];
                    if (!place.geometry?.location) return;

                    updateMarker(place.geometry.location);
                    saveLocation(place.geometry.location);
                    updateFirebaseLocation(place.geometry.location);
                    map.setCenter(place.geometry.location);
                    map.setZoom(15);
                });

                if (location.lat && location.lng) {
                    updateMarker(location);
                }

                map.addListener('click', (event) => {
                    updateMarker(event.latLng);
                    saveLocation(event.latLng);
                    updateFirebaseLocation(event.latLng);
                });
            }

            function updateMarker(position) {
                if (marker) {
                    marker.setPosition(position);
                } else {
                    marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        draggable: true
                    });
                    marker.addListener('dragend', () => {
                        saveLocation(marker.getPosition());
                        updateFirebaseLocation(marker.getPosition());
                    });
                }
            }

            function saveLocation(latLng) {
                $('#location').val(JSON.stringify([{
                    lat: latLng.lat(),
                    lng: latLng.lng()
                }]));
            }

            function updateFirebaseLocation(latLng) {
                if (driverId && driverId !== '0') {
                    const isOnline = $('input[name="is_online"]:checked').val() || "1";
                    db.collection("driverTrack").doc(driverId).set({
                            lat: latLng.lat(),
                            lng: latLng.lng(),
                            is_online: isOnline,
                            timestamp: firebase.firestore.FieldValue.serverTimestamp()
                        }, {
                            merge: true
                        })
                        .catch(error => console.error("Error updating Firebase location:", error));
                }
            }

            function listenToDriverLocation() {
                if (driverId && driverId !== '0') {
                    db.collection("driverTrack").doc(driverId)
                        .onSnapshot((doc) => {
                            if (doc.exists) {
                                const data = doc.data();
                                if (data.lat && data.lng) {
                                    const position = new google.maps.LatLng(data.lat, data.lng);
                                    updateMarker(position);
                                    saveLocation(position);
                                    map.setCenter(position);
                                }
                                if (data.is_online !== undefined) {
                                    const isOnline = data.is_online === "1";
                                    $(`#is_online_${isOnline ? 'active' : 'inactive'}`).prop('checked', true);
                                }
                            }
                        }, (error) => {
                            console.error("Error listening to Firestore:", error);
                        });
                }
            }

            function initializeAutocomplete() {
                const input = document.getElementById('address-input');
                if (!input) {
                    console.error('Address input element not found');
                    return;
                }

                const autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.addListener('place_changed', () => {
                    const place = autocomplete.getPlace();
                    if (!place.address_components) return;

                    let country = '';

                    $('#street_address_1, #area_locality, #city, #postal_code, #state').val('');
                    $('#country_id').val('').trigger('change.select2');

                    place.address_components.forEach(component => {
                        const type = component.types[0];
                        const value = component.long_name;
                        switch (type) {
                            case 'street_number':
                            case 'sublocality_level_3':
                            case 'sublocality_level_2':
                            case 'route':
                                $('#street_address_1').val((i, val) => (val ? val + ', ' : '') + value);
                                break;
                            case 'locality':
                                $('#city').val(value);
                                break;
                            case 'country':
                                country = value;
                                break;
                            case 'postal_code':
                                $('#postal_code').val(value);
                                break;
                            case 'sublocality':
                            case 'sublocality_level_1':
                                $('#area_locality').val(value);
                                break;
                        }
                    });

                    if (country) {
                        $.ajax({
                            url: "<?php echo e(url('/api/get-country-id')); ?>",
                            type: 'GET',
                            data: {
                                name: country
                            },
                            success: (response) => {
                                if (response?.id) {
                                    $('#country_id').val(response.id).trigger('change.select2');
                                }
                            },
                            error: (xhr) => console.error("Error fetching country:", xhr.responseText)
                        });
                    }

                    if (place.geometry?.location) {
                        updateMarker(place.geometry.location);
                        saveLocation(place.geometry.location);
                        updateFirebaseLocation(place.geometry.location);
                        map.setCenter(place.geometry.location);
                        map.setZoom(15);
                    }
                });
            }

            function toggleAmbulanceFields(hide) {
                isAmbulanceSelected = hide;
                if (hide) {
                    $('#vehicle_fields_container').hide();
                    $('#ambulance_fields_container').show();
                    $('#find_driver_container, #service_category_container').hide();

                } else {
                    $('#vehicle_fields_container, #service_category_container').show();
                    $('#ambulance_fields_container').hide();
                    $('#find_driver_container').hide();
                }
            }


            function toggleFindDriverFields(hide) {
                isFindDriverSelected = hide;
                if (hide) {
                    // Show vehicle container
                    $('#vehicle_fields_container').show();

                    // Hide all detailed vehicle fields (model, plate, seat, color)
                    $('.vehicle_detail_field').hide();

                    // Hide ambulance and find driver containers
                    $('#ambulance_fields_container').hide();
                    $('#find_driver_container').show();

                    // Show service category container
                    $('#service_category_container').show();

                    // Make vehicle type required, others not required
                    // $('#vehicle_type_id').prop('required', true);
                    // $('[name="vehicle_info[model]"], [name="vehicle_info[plate_number]"], [name="vehicle_info[seat]"], [name="vehicle_info[color]"]')
                    //     .prop('required', false);

                } else {
                    // For normal services - show all vehicle details
                    $('#vehicle_fields_container').show();
                    $('.vehicle_detail_field').show();
                    $('#find_driver_container').hide();
                    $('#service_category_container').show();

                    // Make all vehicle fields required
                    // $('#vehicle_type_id, [name="vehicle_info[model]"], [name="vehicle_info[plate_number]"], [name="vehicle_info[seat]"], [name="vehicle_info[color]"]')
                    //     .prop('required', true);
                }
            }


            // Initial check on page load
            $(document).ready(function() {
                const initialServiceId = $('#service_id').val();

                if (Number(initialServiceId) === Number(findDriverServiceId)) {
                    $('#find_driver_container').show();
                    $('#vehicle_fields_container').hide();
                }

                // If find driver service is selected, remove required attributes from vehicle fields
                if (isFindDriverService) {
                    $('#vehicle_type_id, [name="vehicle_info[model]"], [name="vehicle_info[plate_number]"], [name="vehicle_info[seat]"], [name="vehicle_info[color]"]')
                        .prop('required', false);
                }
            });

            function loadServiceCategories(serviceId) {
                console.log(serviceId);
                $.ajax({
                    url: "<?php echo e(route('serviceCategory.index')); ?>?service_id=" + serviceId,
                    type: "GET",
                    success: (data) => {
                        console.log(data);
                        const $categorySelect = $('#service_category_id');
                        $categorySelect.empty().append('<option value=""></option>');
                        data.data.forEach(item => {
                            const option = new Option(item.name, item.id);
                            <?php if(isset($driver) && $driver?->service_categories): ?>
                                if (<?php echo e(json_encode($driver?->service_categories->pluck('id')->toArray())); ?>

                                    .includes(item.id)) {
                                    $(option).prop("selected", true);
                                }
                            <?php endif; ?>
                            $categorySelect.append(option);
                        });
                        $categorySelect.trigger('change');
                    },
                    error: (xhr) => console.error("Error loading categories:", xhr.responseText)
                });
            }

            function loadVehicles(serviceId, serviceCategoryId) {
                $.ajax({
                    url: "<?php echo e(route('vehicleType.index')); ?>?service_id=" + serviceId +
                        "&service_category_id=" + serviceCategoryId,
                    type: "GET",
                    success: (data) => {
                        const $vehicleSelect = $('#vehicle_type_id');
                        $vehicleSelect.empty().append('<option value=""></option>');
                        data.data.forEach(item => {
                            const option = new Option(item.name, item.id);
                            if (String(item.id) === String(selectedVehicleId)) {
                                $(option).prop("selected", true);
                            }
                            $vehicleSelect.append(option);
                        });
                    },
                    error: (xhr) => console.error("Error loading vehicles:", xhr.responseText)
                });
            }

            function isPasswordRequired() {
                return !<?php echo e(isset($driver) ? 'true' : 'false'); ?>;
            }

            $(document).ready(function() {
                initGoogleFeatures();
                $('.select-2').select2({
                    placeholder: function() {
                        return $(this).data('placeholder');
                    },
                    allowClear: true
                }).on('select2:select select2:unselect', function() {
                    $(this).valid();
                });

                $('input[name="is_online"]').change(function() {
                    const isOnline = $(this).val() === "1" ? "1" : "0";
                    updateDriverOnlineStatus(isOnline);
                });

                $('#service_id').on('change', function() {
                    const serviceId = $(this).val();
                    console.log("Selected service ID:", serviceId);
                    if (Number(serviceId) === Number(ambulanceServiceId)) {
                        toggleAmbulanceFields(true);
                    } else if (Number(serviceId) === Number(findDriverServiceId)) {
                        $('#service_category_id, #vehicle_type_id').empty().append(
                            '<option value=""></option>');
                        if (serviceId) {
                            loadServiceCategories(serviceId);
                        }
                        toggleFindDriverFields(true);
                    } else {
                        toggleAmbulanceFields(false);
                        toggleFindDriverFields(false);
                        $('#service_category_id, #vehicle_type_id').empty().append(
                            '<option value=""></option>');
                        if (serviceId) {
                            loadServiceCategories(serviceId);
                        }
                    }
                });

                $('#service_category_id').on('change', function() {
                    if (!isAmbulanceSelected) {
                        loadVehicles($('#service_id').val(), $(this).val());
                    }
                });

                if (Number($('#service_id').val()) === Number(ambulanceServiceId)) {
                    toggleAmbulanceFields(true);
                }

                $.validator.addMethod("notOnlyNumeric", function(value, element) {
                    return this.optional(element) || !/^\d+$/.test(value);
                }, "This field cannot contain only numbers.");

                $('#driverForm').validate({
                    ignore: [],
                    rules: {
                        "name": "required",
                        "email": {
                            required: true,
                            email: true
                        },
                        "price_per_type": {
                            required: function() {
                                // Only required for find driver service
                                return $('#service_id').val() == findDriverServiceId ? true : false;
                            }
                        },
                        "phone": {
                            required: true,
                            minlength: 6,
                            maxlength: 15
                        },
                        "password": {
                            required: isPasswordRequired
                        },
                        "confirm_password": {
                            required: isPasswordRequired,
                            equalTo: "#password"
                        },
                        "address[country_id]": "required",
                        "address[state]": {
                            required: true,
                            notOnlyNumeric: true
                        },
                        "address[city]": {
                            required: true,
                            notOnlyNumeric: true
                        },
                        "address[area]": "required",
                        "address[postal_code]": {
                            required: true,
                            maxlength: 12
                        },
                        "address[address]": "required",
                        "vehicle_info[vehicle_type_id]": {
                            required: function() {
                                // Not required for find driver service
                                if ($('#service_id').val() == findDriverServiceId) {
                                    return false;
                                }
                                return !isAmbulanceSelected;
                            }
                        },
                        "vehicle_info[model]": {
                            required: function() {
                                // Not required for find driver service
                                if ($('#service_id').val() == findDriverServiceId) {
                                    return false;
                                }
                                return !isAmbulanceSelected;
                            }
                        },
                        "vehicle_info[plate_number]": {
                            required: function() {
                                // Not required for find driver service
                                if ($('#service_id').val() == findDriverServiceId) {
                                    return false;
                                }
                                return !isAmbulanceSelected;
                            }
                        },
                        "vehicle_info[seat]": {
                            required: function() {
                                // Not required for find driver service
                                if ($('#service_id').val() == findDriverServiceId) {
                                    return false;
                                }
                                return !isAmbulanceSelected;
                            }
                        },
                        "vehicle_info[color]": {
                            required: function() {
                                // Not required for find driver service
                                if ($('#service_id').val() == findDriverServiceId) {
                                    return false;
                                }
                                return !isAmbulanceSelected;
                            },
                            notOnlyNumeric: true
                        },
                        // "experience": {
                        //     required: function() {
                        //         return $('#service_id').val() == findDriverServiceId ? true : false;
                        //     }
                        // },
                        "gear_type": {
                            required: function() {
                                return $('#service_id').val() == findDriverServiceId ? true : false;
                            }
                        },
                        "per_km_charge": {
                            required: function() {
                                return $('#service_id').val() == findDriverServiceId && $(
                                        '#price_per_type').val() && $('#price_per_type').val()
                                    .includes('per_km_charge');
                            },
                            number: true,
                            min: 0
                        },
                        "per_hour_charge": {
                            required: function() {
                                return $('#service_id').val() == findDriverServiceId && $(
                                        '#price_per_type').val() && $('#price_per_type').val()
                                    .includes('per_hour_charge');
                            },
                            number: true,
                            min: 0
                        },
                        "per_day_charge": {
                            required: function() {
                                return $('#service_id').val() == findDriverServiceId && $(
                                        '#price_per_type').val() && $('#price_per_type').val()
                                    .includes('per_day_charge');
                            },
                            number: true,
                            min: 0
                        },
                        // "vehicle_info[vehicle_type_id]" :{
                        //     required:false
                        // },
                        // "vehicle_info[model]" :{
                        //     required:false
                        // },
                        // "vehicle_info[plate_number]" :{
                        //     required:false
                        // },
                        // "vehicle_info[seat]" :{         
                        //     required:false
                        // },
                        // "vehicle_info[color]" :{
                        //     required:false,
                        // },
                        // "experience": {
                        //     required: false,
                        // },
                        // "gear_type": {
                        //     required: false,
                        // },
                        // "per_km_charge": {
                        //     required: false,
                        // },
                        // "per_hour_charge": {
                        //     required: false,
                        // },
                        // "per_day_charge": {
                        //     required: false,
                        // },
                        "payment_account[bank_account_no]": "required",
                        "payment_account[bank_name]": "required",
                        "payment_account[bank_holder_name]": {
                            required: true,
                            notOnlyNumeric: true
                        },
                        "payment_account[swift]": "required",
                        "payment_account[routing_number]": "required",
                        "ambulance[name]": {
                            required: () => isAmbulanceSelected
                        },
                        "ambulance[description]": {
                            required: () => isAmbulanceSelected
                        }
                    },
                    messages: {
                        "confirm_password": {
                            equalTo: "Passwords must match",
                        },
                        "address[state]": {
                            notOnlyNumeric: "State name cannot contain only numbers."
                        },
                        "address[city]": {
                            notOnlyNumeric: "City name cannot contain only numbers."
                        },
                        "vehicle_info[color]": {
                            notOnlyNumeric: "Color cannot contain only numbers."
                        },
                        "payment_account[bank_holder_name]": {
                            notOnlyNumeric: "Account holder name cannot contain only numbers."
                        },
                        "experience": {
                            required: "Please select experience level."
                        },
                        "driver_charge": {
                            required: "Please enter driver charge.",
                            number: "Driver charge must be a valid number.",
                            min: "Driver charge cannot be negative."
                        },
                        "per_km_charge": {
                            required: function() {
                                return $('#price_per_type').val() && $('#price_per_type').val()
                                    .includes('per_km_charge');
                            },
                            number: true,
                            min: 0
                        },
                        "per_hour_charge": {
                            required: function() {
                                return $('#price_per_type').val() && $('#price_per_type').val()
                                    .includes('per_hour_charge');
                            },
                            number: true,
                            min: 0
                        },
                        "per_day_charge": {
                            required: function() {
                                return $('#price_per_type').val() && $('#price_per_type').val()
                                    .includes('per_day_charge');
                            },
                            number: true,
                            min: 0
                        },
                    }
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/admin/driver/fields.blade.php ENDPATH**/ ?>