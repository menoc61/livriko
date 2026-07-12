<?php use \App\Models\Currency; ?>
<?php use \App\Enums\PaymentMethod; ?>
<?php
    $settings = getTaxidoSettings();
    $currencies = Currency::where('status', true)?->get(['id', 'code']);
?>
<div class="col-12">
    <div class="row g-xl-4 g-3">
        <div class="col-xl-12">
            <div class="left-part">
                <div class="contentbox">
                    <div class="inside">
                        <div class="contentbox-title">
                            <h3>
                                <?php echo e(isset($zone) ? __('taxido::static.zones.edit') : __('taxido::static.zones.add')); ?>

                                (<?php echo e(request('locale', app()->getLocale())); ?>)
                            </h3>
                        </div>
                        <?php if(isset($zone)): ?>
                            <div class="form-group row">
                                <label class="col-md-2" for="name"><?php echo e(__('taxido::static.language.languages')); ?></label>
                                <div class="col-md-10">
                                    <ul class="language-list">
                                        <?php $__empty_1 = true; $__currentLoopData = getLanguages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <li>
                                                <a href="<?php echo e(route('admin.zone.edit', ['zone' => $zone->id, 'locale' => $lang->locale])); ?>"
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
                                                <a href="<?php echo e(route('admin.zone.edit', ['zone' => $zone->id, 'locale' => Session::get('locale', 'en')])); ?>"
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
                            <label class="col-md-2" for="name"><?php echo e(__('taxido::static.zones.name')); ?><span>*</span></label>
                            <div class="col-md-10">
                                    <input class="form-control" type="text" id="name" name="name"
                                        placeholder="<?php echo e(__('taxido::static.zones.enter_name')); ?> (<?php echo e(request('locale', app()->getLocale())); ?>)"
                                        value="<?php echo e(isset($zone->name) ? $zone->getTranslation('name', request('locale', app()->getLocale())) : old('name')); ?>">
                                    <i class="ri-file-copy-line copy-icon" data-target="#name"></i>
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

                        <!-- Place Point, Search & Map -->
                        <div class="form-group row">
                            <label class="col-md-2"
                                for="place_points"><?php echo e(__('taxido::static.zones.place_points')); ?><span>
                                    *</span></label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="place_points" name="place_points"
                                    placeholder="<?php echo e(__('taxido::static.zones.select_place_points')); ?>"
                                    value="<?php echo e(isset($zone->locations) ? json_encode($zone->locations, true) : old('place_points')); ?>"
                                    readonly>
                                <?php $__errorArgs = ['place_points'];
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
                                for="search-box"><?php echo e(__('taxido::static.zones.search_location')); ?></label>
                            <div class="col-md-10">
                                <input id="search-box" class="form-control" type="text"
                                    placeholder="<?php echo e(__('taxido::static.zones.search_locations')); ?>">
                                <ul id="suggestions-list" class="map-location-list custom-scrollbar"></ul>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2" for="map"><?php echo e(__('taxido::static.zones.map')); ?></label>
                            <div class="col-md-10">
                                <div class="map-warper dark-support rounded overflow-hidden">
                                    <div class="map-container" id="map-container"></div>
                                </div>
                                <div id="coords"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2" for="type"><?php echo e(__('taxido::static.zones.weight_unit')); ?><span>
                                    *</span></label>
                            <div class="col-md-10 select-label-error">
                                <select class="select-2 form-control" id="type" name="weight_unit"
                                    data-placeholder="<?php echo e(__('taxido::static.zones.select_weight_unit')); ?>">
                                    <option class="select-placeholder" value=""></option>
                                    <?php $__currentLoopData = ['kilogram' => 'Kilogram', 'pound' => 'Pound']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option class="option" value="<?php echo e($key); ?>"
                                            <?php if(old('weight_unit', $zone->weight_unit ?? '') == $key): ?> selected <?php endif; ?>>
                                            <?php echo e($option); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['weight_unit'];
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
                            <label class="col-md-2" for="type"><?php echo e(__('taxido::static.zones.distance_type')); ?><span> *</span></label>
                            <div class="col-md-10 select-label-error">
                                <select class="select-2 form-control" id="type" name="distance_type"
                                    data-placeholder="<?php echo e(__('taxido::static.zones.select_distance_type')); ?>">
                                    <option class="select-placeholder" value=""></option>
                                    <?php $__currentLoopData = ['mile' => 'Mile', 'km' => 'Km']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option class="option" value="<?php echo e($key); ?>"
                                            <?php if(old('distance_type', $zone->distance_type ?? '') == $key): ?> selected <?php endif; ?>>
                                            <?php echo e($option); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['distance_type'];
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
                            <label class="col-md-2" for="type"><?php echo e(__('taxido::static.zones.currency')); ?><span>
                                    *</span></label>
                            <div class="col-md-10 select-label-error">
                                <span class="text-gray mt-1"><?php echo e(__('taxido::static.zones.add_currency_message')); ?>

                                    <a href="<?php echo e(@route('admin.currency.index')); ?>" class="text-primary">
                                        <b><?php echo e(__('taxido::static.here')); ?></b>
                                    </a>
                                </span>
                                <select class="select-2 form-control" id="currency_id" name="currency_id"
                                    data-placeholder="<?php echo e(__('taxido::static.zones.select_currency')); ?>">
                                    <option class="select-placeholder" value=""></option>
                                    <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($currency->id); ?>"
                                            <?php if(old('currency_id', $zone->currency_id ?? '') == $currency->id): ?> selected <?php endif; ?>><?php echo e($currency->code); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['currency_id'];
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
                            <label class="col-md-2" for="payment_method"><?php echo e(__('taxido::static.zones.payment_method')); ?> <span> *</span></label>
                            <div class="col-md-10 select-label-error">
                                <select class="form-control select-2 payment_method" name="payment_method[]"
                                    data-placeholder="<?php echo e(__('taxido::static.zones.select_payment_method')); ?>" multiple>
                                    <?php $__currentLoopData = PaymentMethod::ALL_PAYMENT_METHODS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($method); ?>"
                                            <?php if(isset($zone->payment_method) && in_array($method, $zone->payment_method)): ?>
                                                selected
                                            <?php elseif(old('payment_method') && in_array($method, old('payment_method'))): ?>
                                                selected
                                            <?php endif; ?>>
                                            <?php echo e(ucfirst(str_replace('_', ' ', $method))); ?>

                                        </option>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['payment_method'];
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
                                        <?php if(isset($zone)): ?>
                                            <input class="form-control" type="hidden" name="status"
                                                value="0">
                                            <input class="form-check-input" type="checkbox" name="status"
                                                id="" value="1" <?php echo e($zone->status ? 'checked' : ''); ?>>
                                        <?php else: ?>
                                            <input class="form-control" type="hidden" name="status"
                                                value="0">
                                            <input class="form-check-input" type="checkbox" name="status"
                                                id="" value="1" checked>
                                        <?php endif; ?>
                                        <span class="switch-state"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- total_rides_in_peak_zone -->
                        <div class="form-group row">
                            <label class="col-md-2" for="total_rides_in_peak_zone"><?php echo e(__('taxido::static.zones.total_rides_in_peak_zone')); ?><span>*</span></label>
                            <div class="col-md-10">
                                    <input class="form-control" type="number" min="1" id="total_rides_in_peak_zone" name="total_rides_in_peak_zone"
                                        placeholder="<?php echo e(__('taxido::static.zones.enter_total_rides_in_peak_zone')); ?>"
                                        value="<?php echo e(isset($zone->total_rides_in_peak_zone) ? $zone->total_rides_in_peak_zone : old('name')); ?>">
                                    <i class="ri-file-copy-line copy-icon" data-target="#total_rides_in_peak_zone"></i>
                                <?php $__errorArgs = ['total_rides_in_peak_zone'];
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

                        <!-- peak_zone_geographic_radius -->
                        <div class="form-group row">
                            <label class="col-md-2" for="peak_zone_geographic_radius"><?php echo e(__('taxido::static.zones.peak_zone_geographic_radius')); ?><span>*</span></label>
                            <div class="col-md-10">
                                    <input class="form-control" type="number" min="0.00" id="peak_zone_geographic_radius" name="peak_zone_geographic_radius"
                                        placeholder="<?php echo e(__('taxido::static.zones.enter_peak_zone_geographic_radius')); ?>"
                                        value="<?php echo e(isset($zone->peak_zone_geographic_radius) ? $zone->peak_zone_geographic_radius : old('peak_zone_geographic_radius')); ?>">
                                    <i class="ri-file-copy-line copy-icon" data-target="#peak_zone_geographic_radius"></i>
                                <?php $__errorArgs = ['peak_zone_geographic_radius'];
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

                        <!-- minutes_choosing_peak_zone -->
                        <div class="form-group row">
                            <label class="col-md-2" for="minutes_choosing_peak_zone"><?php echo e(__('taxido::static.zones.minutes_choosing_peak_zone')); ?><span>*</span></label>
                            <div class="col-md-10">
                                    <input class="form-control" type="number" min="1" id="minutes_choosing_peak_zone" name="minutes_choosing_peak_zone"
                                        placeholder="<?php echo e(__('taxido::static.zones.enter_minutes_choosing_peak_zone')); ?>"
                                        value="<?php echo e(isset($zone->minutes_choosing_peak_zone) ? $zone->minutes_choosing_peak_zone : old('minutes_choosing_peak_zone')); ?>">
                                    <i class="ri-file-copy-line copy-icon" data-target="#minutes_choosing_peak_zone"></i>
                                <?php $__errorArgs = ['minutes_choosing_peak_zone'];
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

                        <!-- minutes_peak_zone_active -->
                        <div class="form-group row">
                            <label class="col-md-2" for="minutes_peak_zone_active"><?php echo e(__('taxido::static.zones.minutes_peak_zone_active')); ?><span>*</span></label>
                            <div class="col-md-10">
                                    <input class="form-control" type="number" min="1" id="minutes_peak_zone_active" name="minutes_peak_zone_active"
                                        placeholder="<?php echo e(__('taxido::static.zones.enter_minutes_peak_zone_active')); ?> (<?php echo e(request('locale', app()->getLocale())); ?>)"
                                        value="<?php echo e(isset($zone->minutes_peak_zone_active) ? $zone->minutes_peak_zone_active : old('minutes_peak_zone_active')); ?>">
                                    <i class="ri-file-copy-line copy-icon" data-target="#minutes_peak_zone_active"></i>
                                <?php $__errorArgs = ['minutes_peak_zone_active'];
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

                        <!-- peak_price_increase_percentage -->
                        <div class="form-group row">
                            <label class="col-md-2" for="peak_price_increase_percentage"><?php echo e(__('taxido::static.zones.peak_price_increase_percentage')); ?><span>*</span></label>
                            <div class="col-md-10">
                                    <input class="form-control" type="text" id="peak_price_increase_percentage" name="peak_price_increase_percentage"
                                        placeholder="<?php echo e(__('taxido::static.zones.enter_peak_price_increase_percentage')); ?>"
                                        value="<?php echo e(isset($zone->peak_price_increase_percentage) ? $zone->peak_price_increase_percentage : old('peak_price_increase_percentage')); ?>">
                                    <i class="ri-file-copy-line copy-icon" data-target="#peak_price_increase_percentage"></i>
                                <?php $__errorArgs = ['peak_price_increase_percentage'];
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
                                    <button type="button" id="saveBtn" name="save" class="btn btn-primary spinner-btn">
                                        <i class="ri-save-line text-white lh-1"></i> <?php echo e(__('taxido::static.save')); ?>

                                    </button>
                                    <button type="button" id="saveExitBtn" name="save_and_exit" class="btn btn-primary spinner-btn">
                                        <i class="ri-expand-left-line text-white lh-1"></i><?php echo e(__('taxido::static.save_and_exit')); ?>

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

<?php if($settings['location']['map_provider'] == 'google_map'): ?>
    <?php if ($__env->exists('taxido::admin.zone.google')) echo $__env->make('taxido::admin.zone.google', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php elseif($settings['location']['map_provider'] == 'osm'): ?>
    <?php if ($__env->exists('taxido::admin.zone.osm')) echo $__env->make('taxido::admin.zone.osm', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        (function($) {
            "use strict";
            $('#zoneForm').validate({
                rules: {
                    "name": "required",
                    "currency_id": "required",
                    "amount": "required",
                    "weight_unit" : "required",
                    "distance_type": "required",
                    "place_points": "required",
                    "total_rides_in_peak_zone": "required",
                    "peak_zone_geographic_radius": "required",
                    "minutes_choosing_peak_zone" : "required",
                    "minutes_peak_zone_active": "required",
                    "peak_price_increase_percentage": "required",
                }
            });
        })(jQuery);
        $('#saveBtn,#saveExitBtn').click(function(e) {
            e.preventDefault();

            if ($("#zoneForm").valid()) {
                $("#zoneForm").submit();
            }
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/admin/zone/fields.blade.php ENDPATH**/ ?>