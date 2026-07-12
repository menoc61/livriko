<?php $__env->startSection('title', __('static.settings.app_settings')); ?>

<?php $__env->startSection('content'); ?>
    <div class="contentbox">
        <div class="inside">
            <!-- Content Box Title -->
            <div class="contentbox-title">
                <div class="contentbox-subtitle">
                    <h3><?php echo e(__('static.settings.app_settings')); ?></h3>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="vertical-tabs">
                    <div class="row g-xl-5 g-4">
                        <!-- Navigation Tabs -->
                        <div class="col-xxl-4 col-xl-5 col-12">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-tabContent" data-bs-toggle="pill"
                                    data-bs-target="#general_settings" type="button" role="tab"
                                    aria-controls="App_Settings" aria-selected="true">
                                    <i class="ri-settings-5-line"></i><?php echo e(__('taxido::static.settings.general')); ?>

                                </a>
                                <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#Ads_Setting" type="button" role="tab"
                                    aria-controls="v-pills-profile" aria-selected="false">
                                    <i class="ri-toggle-line"></i><?php echo e(__('taxido::static.settings.activation')); ?>

                                </a>
                                <a class="nav-link" id="v-pills-commission-tab" data-bs-toggle="pill"
                                    data-bs-target="#Commission_Setting" type="button" role="tab"
                                    aria-controls="v-pills-commission" aria-selected="false">
                                    <i class="ri-pie-chart-2-line"></i><?php echo e(__('taxido::static.settings.driver_commission')); ?>

                                </a>
                                <a class="nav-link" id="v-pills-ride-setting-tab" data-bs-toggle="pill"
                                    data-bs-target="#Ride_Setting" type="button" role="tab"
                                    aria-controls="v-pills-ride-setting" aria-selected="false">
                                        <i class="ri-car-line"></i> <?php echo e(__('taxido::static.settings.ride_setting')); ?>

                                </a>
                                <a class="nav-link" id="v-pills-commission-tab" data-bs-toggle="pill"
                                    data-bs-target="#Wallet_Setting" type="button" role="tab"
                                    aria-controls="v-pills-commission" aria-selected="false">
                                    <i class="ri-wallet-2-line"></i><?php echo e(__('taxido::static.settings.wallet')); ?>

                                </a>
                                <a class="nav-link" id="v-pills-referral-tab" data-bs-toggle="pill"
                                    data-bs-target="#Referral_Setting" type="button" role="tab"
                                    aria-controls="v-pills-referral" aria-selected="false">
                                    <i class="ri-user-add-line"></i><?php echo e(__('taxido::static.settings.referral_settings')); ?>

                                </a>
                                <a class="nav-link" id="v-pills-location-tab" data-bs-toggle="pill"
                                    data-bs-target="#Location_Setting" type="button" role="tab"
                                    aria-controls="v-pills-location" aria-selected="false">
                                    <i class="ri-map-pin-2-line"></i><?php echo e(__('taxido::static.settings.location_settings')); ?>

                                </a>

                                <a class="nav-link" id="v-pills-ads-network-tab" data-bs-toggle="pill"
                                    data-bs-target="#Ads_Network_Setting" type="button" role="tab"
                                    aria-controls="v-pills-ads-network" aria-selected="false">
                                        <i class="ri-advertisement-line"></i><?php echo e(__('taxido::static.settings.ads_network')); ?>

                                </a>

                                <a class="nav-link" id="v-pills-app-config-tab" data-bs-toggle="pill"
                                    data-bs-target="#App_Configuration_Setting" type="button" role="tab"
                                    aria-controls="v-pills-app-config" aria-selected="false">
                                    <i class="ri-apps-2-line"></i> <?php echo e(__('taxido::static.settings.app_configuration')); ?>

                                </a>
                            </div>
                        </div>

                        <!-- Form Content -->
                        <div class="col-xxl-8 col-xl-7 col-12 tab-b-left">
                            <form method="POST" class="needs-validation user-add" id="taxidosettingsForm"
                                action="<?php echo e(route('admin.taxido-setting.update', @$id)); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                <div class="tab-content w-100" id="v-pills-tabContent">
                                    
                                    <div class="tab-pane fade show active" id="general_settings" role="tabpanel" aria-labelledby="v-pills-tabContent">
                                        <div class="form-group row">
                                            <label class="col-xxl-3 col-md-4" for="footer_branding_hashtag">
                                                <?php echo e(__('taxido::static.settings.footer_hashtag')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                data-bs-title="<?php echo e(__('taxido::static.settings.footer_hashtag_help')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="text" name="general[footer_branding_hashtag]"
                                                    id="general[footer_branding_hashtag]"
                                                    value="<?php echo e(isset($taxidosettings['general']['footer_branding_hashtag']) ? $taxidosettings['general']['footer_branding_hashtag'] : old('footer_branding_hashtag')); ?>"
                                                    placeholder="<?php echo e(__('taxido::static.settings.enter_hashtag')); ?>">
                                                <?php $__errorArgs = ['general[footer_branding_hashtag]'];
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
                                            <label class="col-xxl-3 col-md-4" for="footer_branding_attribution">
                                                <?php echo e(__('taxido::static.settings.footer_attribution')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                data-bs-title="<?php echo e(__('taxido::static.settings.footer_attribution_help')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="text" name="general[footer_branding_attribution]"
                                                    id="general[footer_branding_attribution]"
                                                    value="<?php echo e(isset($taxidosettings['general']['footer_branding_attribution']) ? $taxidosettings['general']['footer_branding_attribution'] : old('footer_branding_attribution')); ?>"
                                                    placeholder="<?php echo e(__('taxido::static.settings.enter_attribution')); ?>">
                                                <?php $__errorArgs = ['general[footer_branding_attribution]'];
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
                                            <label class="col-md-2" for="logo">
                                                <?php echo e(__('Ambulance Image')); ?>

                                            </label>
                                            <div class="col-md-10">
                                                <div class="form-group d-flex gap-3 align-items-start media-relative">
                                                    <div class="media-upload-image">
                                                        <input type="file" class="form-control fileInput"
                                                            name="general[ambulance_image]" data-preview-id="ambulanceImagePreview">
                                                        <i class="ri-add-line"></i>
                                                    </div>
                                                    <?php $__errorArgs = ['general[ambulance_image]'];
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
                                                    <?php if(isset($taxidosettings['general']['ambulance_image']) && !empty($taxidosettings['general']['ambulance_image'])): ?>
                                                        <img src="<?php echo e(asset(@$taxidosettings['general']['ambulance_image'])); ?>" id="ambulanceImagePreview" alt="Current Logo" class="media-img" id="imagePreview">
                                                    <?php else: ?>
                                                        <img src="" alt="Image Preview" class="media-img" id="ambulanceImagePreview" style="display: none;">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2" for="logo">
                                                <?php echo e(__('Ambulance Map Icon')); ?>

                                            </label>
                                            <div class="col-md-10">
                                                <div class="form-group d-flex gap-3 align-items-start media-relative">
                                                    <div class="media-upload-image">
                                                        <input type="file" class="form-control fileInput"
                                                            name="general[ambulance_map_icon]" data-preview-id="ambulanceMapIconPreview">
                                                        <i class="ri-add-line"></i>
                                                    </div>
                                                    <?php $__errorArgs = ['general[ambulance_map_icon]'];
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
                                                    <?php if(isset($taxidosettings['general']['ambulance_map_icon']) && !empty($taxidosettings['general']['ambulance_map_icon'])): ?>
                                                        <img src="<?php echo e(asset(@$taxidosettings['general']['ambulance_map_icon'])); ?>" id="ambulanceMapIconPreview" alt="Current Logo" class="media-img" id="imagePreview">
                                                    <?php else: ?>
                                                        <img src="" alt="Image Preview" class="media-img" id="ambulanceMapIconPreview" style="display: none;">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="added-button">
                                            <button type="button" id="add-greeting" class="btn btn-primary mt-0"><?php echo e(__('taxido::static.settings.add_greeting')); ?></button>
                                        </div>
                                    </div>

                                    
                                    <div class="tab-pane fade" id="Ads_Setting" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[coupon_enable]"><?php echo e(__('static.settings.coupon_enable')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('static.settings.coupon_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['coupon_enable'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[coupon_enable]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[coupon_enable]" value="1"
                                                                <?php echo e($taxidosettings['activation']['coupon_enable'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[coupon_enable]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[coupon_enable]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[referral_enable]"><?php echo e(__('taxido::static.settings.referral_enable')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.enable_referral')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['referral_enable'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[referral_enable]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[referral_enable]" value="1"
                                                                <?php echo e($taxidosettings['activation']['referral_enable'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[referral_enable]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[referral_enable]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[rider_wallet]"><?php echo e(__('taxido::static.settings.rider_wallet')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.rider_wallets')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['rider_wallet'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[rider_wallet]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[rider_wallet]" value="1"
                                                                <?php echo e($taxidosettings['activation']['rider_wallet'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[rider_wallet]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[rider_wallet]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[sos_enable]"><?php echo e(__('taxido::static.settings.sos_enable')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.sos_enable')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['sos_enable'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[sos_enable]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[sos_enable]" value="1"
                                                                <?php echo e($taxidosettings['activation']['sos_enable'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[sos_enable]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[sos_enable]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>


                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[sos_enable]"><?php echo e(__('taxido::static.settings.allow_negative_balance')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.allow_negative_balance')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['allow_negative_balance'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[allow_negative_balance]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[allow_negative_balance]" value="1"
                                                                <?php echo e($taxidosettings['activation']['allow_negative_balance'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[allow_negative_balance]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[allow_negative_balance]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>


                                        
                                        <div class="form-group row">
                                            <label class="col-md-5" for="activation[driver_verification]"><?php echo e(__('taxido::static.settings.driver_verification')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo e(__('taxido::static.settings.driver_verifications_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['driver_verification'])): ?>
                                                            <input class="form-control" type="hidden" name="activation[driver_verification]" value="0">
                                                            <input class="form-check-input" type="checkbox" name="activation[driver_verification]" value="1" <?php echo e($taxidosettings['activation']['driver_verification'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden" name="activation[driver_verification]" value="0">
                                                            <input class="form-check-input" type="checkbox" name="activation[driver_verification]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5" for="activation[fleet_verification]"><?php echo e(__('taxido::static.settings.fleet_verification')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo e(__('taxido::static.settings.fleet_verification_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['fleet_verification'])): ?>
                                                            <input class="form-control" type="hidden" name="activation[fleet_verification]" value="0">
                                                            <input class="form-check-input" type="checkbox" name="activation[fleet_verification]" value="1" <?php echo e($taxidosettings['activation']['fleet_verification'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden" name="activation[fleet_verification]" value="0">
                                                            <input class="form-check-input" type="checkbox" name="activation[fleet_verification]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5" for="activation[fleet_vehicle_verification]"><?php echo e(__('taxido::static.settings.fleet_vehicle_verification')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo e(__('taxido::static.settings.fleet_vehicle_verification_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['fleet_vehicle_verification'])): ?>
                                                            <input class="form-control" type="hidden" name="activation[fleet_vehicle_verification]" value="0">
                                                            <input class="form-check-input" type="checkbox" name="activation[fleet_vehicle_verification]" value="1" <?php echo e($taxidosettings['activation']['fleet_vehicle_verification'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden" name="activation[fleet_vehicle_verification]" value="0">
                                                            <input class="form-check-input" type="checkbox" name="activation[fleet_vehicle_verification]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5" for="activation[full_address_location]"><?php echo e(__('taxido::static.settings.full_address_location')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo e(__('taxido::static.settings.full_address_location_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['full_address_location'])): ?>
                                                            <input class="form-control" type="hidden" name="activation[full_address_location]" value="0">
                                                            <input class="form-check-input" type="checkbox" name="activation[full_address_location]" value="1" <?php echo e($taxidosettings['activation']['full_address_location'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden" name="activation[full_address_location]" value="0">
                                                            <input class="form-check-input" type="checkbox" name="activation[full_address_location]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[online_payments]"><?php echo e(__('taxido::static.settings.online_payment')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.online_payments')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['online_payments'])): ?>
                                                            <input class="form-control" type="hidden" name="activation[online_payments]" value="0">
                                                            <input class="form-check-input" type="checkbox" name="activation[online_payments]" value="1"
                                                                <?php echo e($taxidosettings['activation']['online_payments'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden" name="activation[online_payments]" value="0">
                                                            <input class="form-check-input" type="checkbox" name="activation[online_payments]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[driver_subscription]"><?php echo e(__('taxido::static.settings.driver_subscription')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.driver_subscription')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['driver_subscription'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[driver_subscription]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[driver_subscription]" value="1"
                                                                <?php echo e($taxidosettings['activation']['driver_subscription'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[driver_subscription]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[driver_subscription]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[cash_payments]"><?php echo e(__('taxido::static.settings.cash_payments')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.cash_payments')); ?>">
                                                </i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['cash_payments'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[cash_payments]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[cash_payments]" value="1"
                                                                <?php echo e($taxidosettings['activation']['cash_payments'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden" name="activation[cash_payments]" value="0">
                                                            <input class="form-check-input" type="checkbox" name="activation[cash_payments]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[driver_tips]"><?php echo e(__('taxido::static.settings.driver_tips')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.tips')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['driver_tips'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[driver_tips]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[driver_tips]" value="1"
                                                                <?php echo e($taxidosettings['activation']['driver_tips'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[driver_tips]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[driver_tips]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[ride_otp]"><?php echo e(__('taxido::static.settings.ride_otp')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.otp_ride')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['ride_otp'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[ride_otp]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[ride_otp]" value="1"
                                                                <?php echo e($taxidosettings['activation']['ride_otp'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[ride_otp]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[ride_otp]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[parcel_otp]"><?php echo e(__('taxido::static.settings.parcel_otp')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.otp_parcel')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['parcel_otp'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[parcel_otp]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[parcel_otp]" value="1"
                                                                <?php echo e($taxidosettings['activation']['parcel_otp'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[parcel_otp]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[parcel_otp]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[bidding]"><?php echo e(__('taxido::static.settings.bidding')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.bid_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['bidding'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[bidding]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[bidding]" value="1"
                                                                <?php echo e($taxidosettings['activation']['bidding'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[bidding]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[bidding]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[force_update]"><?php echo e(__('taxido::static.settings.force_update')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.force_update_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['force_update'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[force_update]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[force_update]" value="1"
                                                                <?php echo e($taxidosettings['activation']['force_update'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[force_update]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[force_update]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[airport_price_enable]"><?php echo e(__('taxido::static.settings.airport_price')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.airport_price_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['airport_price_enable'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[airport_price_enable]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[airport_price_enable]" value="1"
                                                                <?php echo e($taxidosettings['activation']['airport_price_enable'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[airport_price_enable]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[airport_price_enable]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[surge_price_enable]"><?php echo e(__('taxido::static.settings.surge_price')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.surge_price_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['surge_price_enable'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[surge_price_enable]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[surge_price_enable]" value="1"
                                                                <?php echo e($taxidosettings['activation']['surge_price_enable'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[surge_price_enable]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[surge_price_enable]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[peak_zone_enable]"><?php echo e(__('taxido::static.settings.peak_zone')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.surge_price_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['peak_zone_enable'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[peak_zone_enable]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[peak_zone_enable]" value="1"
                                                                <?php echo e($taxidosettings['activation']['peak_zone_enable'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[peak_zone_enable]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[peak_zone_enable]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[driver_incentive_enable]"><?php echo e(__('taxido::static.settings.driver_incentive_enable')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.driver_incentive_enable_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['driver_incentive_enable'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[driver_incentive_enable]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[driver_incentive_enable]" value="1"
                                                                <?php echo e($taxidosettings['activation']['driver_incentive_enable'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[driver_incentive_enable]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[driver_incentive_enable]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[additional_minute_charge]"><?php echo e(__('taxido::static.settings.additional_minute_charge')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.additional_minute_charge_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['additional_minute_charge'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[additional_minute_charge]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[additional_minute_charge]" value="1"
                                                                <?php echo e($taxidosettings['activation']['additional_minute_charge'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[additional_minute_charge]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[additional_minute_charge]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[additional_distance_charge]"><?php echo e(__('taxido::static.settings.additional_distance_charge')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.additional_distance_charge_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['additional_distance_charge'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[additional_distance_charge]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[additional_distance_charge]" value="1"
                                                                <?php echo e($taxidosettings['activation']['additional_distance_charge'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[additional_distance_charge]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[additional_distance_charge]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row">
                                            <label class="col-md-5"
                                                for="activation[additional_weight_charge]"><?php echo e(__('taxido::static.settings.additional_weight_charge')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.additional_weight_charge_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-7">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['activation']['additional_weight_charge'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[additional_weight_charge]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[additional_weight_charge]" value="1"
                                                                <?php echo e($taxidosettings['activation']['additional_weight_charge'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="activation[additional_weight_charge]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="activation[additional_weight_charge]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="tab-pane fade" id="Commission_Setting" role="tabpanel"
                                        aria-labelledby="v-pills-commission" tabindex="0">
                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="min_withdraw_amount"><?php echo e(__('taxido::static.settings.min_withdraw_amount')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.min_withdraw_text')); ?>"></i>
                                            </label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="number"
                                                    name="driver_commission[min_withdraw_amount]"
                                                    id="driver_commission[min_withdraw_amount]"
                                                    value="<?php echo e(isset($taxidosettings['driver_commission']['min_withdraw_amount']) ? $taxidosettings['driver_commission']['min_withdraw_amount'] : old('min_withdraw_amount')); ?>"
                                                    placeholder="<?php echo e(__('taxido::static.settings.enter_min_withdraw_amount')); ?>">
                                                <?php $__errorArgs = ['driver_commission[min_withdraw_amount]'];
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
                                            <label class="col-md-2" for="fleet_commission_type">
                                                <?php echo e(__('taxido::static.settings.fleet_commission_type')); ?><span>*</span>
                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.fleet_commission_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-10 select-label-error">
                                                <select class="select-2 form-control" id="fleet_commission_type"
                                                    name="driver_commission[fleet_commission_type]"
                                                    data-placeholder="<?php echo e(__('taxido::static.settings.select_fleet_commission_type')); ?>">
                                                    <option class="select-placeholder" value=""></option>
                                                    <?php $__currentLoopData = ['fixed' => 'Fixed', 'percentage' => 'Percentage']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option class="option" value="<?php echo e($key); ?>"
                                                            <?php if(old('fleet_commission_type', $taxidosettings['driver_commission']['fleet_commission_type'] ?? '') == $key): ?> selected <?php endif; ?>>
                                                            <?php echo e($option); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['fleet_commission_type'];
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

                                        <div class="form-group row amount-input" id="fleet_commission_rate" style="display: none;">
                                            <label class="col-md-2" for="fleet_commission_rate">
                                                <?php echo e(__('taxido::static.settings.fleet_commission_rate')); ?><span>*</span>
                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.fleet_commission_rate_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-10 select-label-error amount">
                                                <div class="input-group">
                                                    <span class="input-group-text" id="fleetCurrencyIcon" style="display: none"><?php echo e(getDefaultCurrency()?->symbol); ?></span>
                                                    <input class="form-control" type="number"
                                                        name="driver_commission[fleet_commission_rate]"
                                                        value="<?php echo e($taxidosettings['driver_commission']['fleet_commission_rate'] ?? old('fleet_commission_rate')); ?>"
                                                        placeholder="<?php echo e(__('taxido::static.settings.enter_fleet_commission_rate')); ?>"
                                                        required>
                                                    <span class="input-group-text" id="fleetPercentageIcon" style="display: none;"><i class="ri-percent-line"></i></span>
                                                </div>
                                                <?php $__errorArgs = ['fleet_commission_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback d-block" role="alert">
                                                        <strong><?php echo e($message); ?></strong>
                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row amount-input">
                                            <label class="col-md-2"
                                                for="ambulance_base_fair_charge"><?php echo e(__('taxido::static.settings.ambulance_base_fair_charge')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.ambulance_base_fair_charge')); ?>"></i>
                                            </label>
                                            <div class="col-md-10 select-label-error amount">
                                                <div class="input-group">
                                                    <input class="form-control" type="number"
                                                        name="driver_commission[ambulance_base_fair_charge]"
                                                        id="driver_commission[ambulance_base_fair_charge]"
                                                        value="<?php echo e(isset($taxidosettings['driver_commission']['ambulance_base_fair_charge']) ? $taxidosettings['driver_commission']['ambulance_base_fair_charge'] : old('ambulance_base_fair_charge')); ?>"
                                                        placeholder="<?php echo e(__('taxido::static.settings.enter_ambulance_base_fair_charge')); ?>">
                                                </div>
                                                <?php $__errorArgs = ['driver_commission[ambulance_base_fair_charge]'];
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

                                        <div class="form-group row amount-input">
                                            <label class="col-md-2"
                                                for="ambulance_per_km_charge"><?php echo e(__('taxido::static.settings.ambulance_per_km_charge')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.ambulance_per_km_charge_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-10 select-label-error amount">
                                                <div class="input-group">
                                                    <input class="form-control" type="number"
                                                        name="driver_commission[ambulance_per_km_charge]"
                                                        id="driver_commission[ambulance_per_km_charge]"
                                                        value="<?php echo e(isset($taxidosettings['driver_commission']['ambulance_per_km_charge']) ? $taxidosettings['driver_commission']['ambulance_per_km_charge'] : old('ambulance_per_km_charge')); ?>"
                                                        placeholder="<?php echo e(__('taxido::static.settings.enter_ambulance_per_km_charge')); ?>">
                                                </div>
                                                <?php $__errorArgs = ['driver_commission[ambulance_per_km_charge]'];
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

                                        <div class="form-group row amount-input">
                                            <label class="col-md-2"
                                                for="ambulance_per_minute_charge"><?php echo e(__('taxido::static.settings.ambulance_per_minute_charge')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.ambulance_per_minute_charge_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-10 select-label-error amount">
                                                <div class="input-group">

                                                    <input class="form-control" type="number"
                                                        name="driver_commission[ambulance_per_minute_charge]"
                                                        id="driver_commission[ambulance_per_minute_charge]"
                                                        value="<?php echo e(isset($taxidosettings['driver_commission']['ambulance_per_minute_charge']) ? $taxidosettings['driver_commission']['ambulance_per_minute_charge'] : old('ambulance_per_minute_charge')); ?>"
                                                        placeholder="<?php echo e(__('taxido::static.settings.ambulance_per_minute_charge')); ?>">
                                                </div>
                                                <?php $__errorArgs = ['driver_commission[ambulance_per_minute_charge]'];
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
                                            <label class="col-md-2" for="ambulance_commission_type">
                                                <?php echo e(__('taxido::static.settings.ambulance_commission_type')); ?><span>*</span>
                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.ambulance_commission_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-10 select-label-error">
                                                <select class="select-2 form-control" id="ambulance_commission_type"
                                                    name="driver_commission[ambulance_commission_type]"
                                                    data-placeholder="<?php echo e(__('taxido::static.settings.select_ambulance_commission_type')); ?>">
                                                    <option class="select-placeholder" value=""></option>
                                                    <?php $__currentLoopData = ['fixed' => 'Fixed', 'percentage' => 'Percentage']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option class="option" value="<?php echo e($key); ?>"
                                                            <?php if(old('ambulance_commission_type', $taxidosettings['driver_commission']['ambulance_commission_type'] ?? '') == $key): ?> selected <?php endif; ?>>
                                                            <?php echo e($option); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['ambulance_commission_type'];
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

                                        <div class="form-group row amount-input" id="ambulance_commission_rate" style="display: none;">
                                            <label class="col-md-2" for="ambulance_commission_rate">
                                                <?php echo e(__('taxido::static.settings.ambulance_commission_rate')); ?><span>*</span>
                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.ambulance_commission_rate_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-10 select-label-error amount">
                                                <div class="input-group">
                                                    <span class="input-group-text" id="ambulanceCurrencyIcon" style="display: none"><?php echo e(getDefaultCurrency()?->symbol); ?></span>
                                                    <input class="form-control" type="number"
                                                        name="driver_commission[ambulance_commission_rate]"
                                                        value="<?php echo e($taxidosettings['driver_commission']['ambulance_commission_rate'] ?? old('ambulance_commission_rate')); ?>"
                                                        placeholder="<?php echo e(__('taxido::static.settings.enter_ambulance_commission_rate')); ?>"
                                                        required>
                                                    <span class="input-group-text" id="ambulancePercentageIcon" style="display: none;"><i class="ri-percent-line"></i></span>
                                                </div>
                                                <?php $__errorArgs = ['ambulance_commission_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback d-block" role="alert">
                                                        <strong><?php echo e($message); ?></strong>
                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="driver_commission[status]"><?php echo e(__('taxido::static.settings.status')); ?></label>
                                            <div class="col-md-10">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($taxidosettings['driver_commission']['status'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="driver_commission[status]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="driver_commission[status]" value="1"
                                                                <?php echo e($taxidosettings['driver_commission']['status'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="driver_commission[status]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="driver_commission[status]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="tab-pane fade" id="Ride_Setting" role="tabpanel" aria-labelledby="v-pills-ride-setting-tab" tabindex="0">
                                        <div class="form-group row">
                                            <label class="col-xxl-3 col-md-4" for="ride_request_time_driver">
                                                <?php echo e(__('taxido::static.settings.ride_request_time_driver')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="<?php echo e(__('taxido::static.settings.driver_ride_request_accept_time_span')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="number" name="ride[ride_request_time_driver]" id="ride_request_time_driver"
                                                       value="<?php echo e(isset($taxidosettings['ride']['ride_request_time_driver']) ? $taxidosettings['ride']['ride_request_time_driver'] : old('ride_request_time_driver')); ?>"
                                                       placeholder="<?php echo e(__('taxido::static.settings.enter_ride_request_time_driver')); ?>">
                                                <?php $__errorArgs = ['ride[ride_request_time_driver]'];
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
                                            <label class="col-xxl-3 col-md-4" for="rental_ambulance_request_time">
                                                <?php echo e(__('taxido::static.settings.rental_ambulance_request_time')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="<?php echo e(__('taxido::static.settings.rental_ambulance_request_time_span')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="number" name="ride[rental_ambulance_request_time]" id="rental_ambulance_request_time"
                                                       value="<?php echo e(isset($taxidosettings['ride']['rental_ambulance_request_time']) ? $taxidosettings['ride']['rental_ambulance_request_time'] : old('rental_ambulance_request_time')); ?>"
                                                       placeholder="<?php echo e(__('taxido::static.settings.enter_rental_ambulance_request_time')); ?>">
                                                <?php $__errorArgs = ['ride[rental_ambulance_request_time]'];
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
                                            <label class="col-xxl-3 col-md-4" for="increase_amount_range">
                                                <?php echo e(__('taxido::static.settings.increase_amount_range')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="<?php echo e(__('taxido::static.settings.increase_amount_range_span')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="number" name="ride[increase_amount_range]" id="increase_amount_range"
                                                       value="<?php echo e(isset($taxidosettings['ride']['increase_amount_range']) ? $taxidosettings['ride']['increase_amount_range'] : old('increase_amount_range')); ?>"
                                                       placeholder="<?php echo e(__('taxido::static.settings.increase_amount_range')); ?>">
                                                <?php $__errorArgs = ['ride[increase_amount_range]'];
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
                                            <label class="col-xxl-3 col-md-4" for="find_driver_time_limit">
                                                <?php echo e(__('taxido::static.settings.find_driver_time_limit')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="<?php echo e(__('taxido::static.settings.find_driver_time_limit_span')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="number" name="ride[find_driver_time_limit]" id="find_driver_time_limit"
                                                       value="<?php echo e(isset($taxidosettings['ride']['find_driver_time_limit']) ? $taxidosettings['ride']['find_driver_time_limit'] : old('find_driver_time_limit')); ?>"
                                                       placeholder="<?php echo e(__('taxido::static.settings.enter_find_driver_time_limit')); ?>">
                                                <?php $__errorArgs = ['ride[find_driver_time_limit]'];
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
                                            <label class="col-xxl-3 col-md-4" for="schedule_ride_request_lead_time">
                                                <?php echo e(__('taxido::static.settings.schedule_ride_request_lead_time')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="<?php echo e(__('taxido::static.settings.schedule_ride_request_lead_time_span')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="number" name="ride[schedule_ride_request_lead_time]" id="schedule_ride_request_lead_time"
                                                       value="<?php echo e(isset($taxidosettings['ride']['schedule_ride_request_lead_time']) ? $taxidosettings['ride']['schedule_ride_request_lead_time'] : old('find_driver_time_limit')); ?>"
                                                       placeholder="<?php echo e(__('taxido::static.settings.enter_schedule_ride_request_lead_time')); ?>">
                                                <?php $__errorArgs = ['ride[schedule_ride_request_lead_time]'];
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
                                            <label class="col-xxl-3 col-md-4" for="driver_max_online_hours">
                                                <?php echo e(__('taxido::static.settings.driver_max_online_hours')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="<?php echo e(__('taxido::static.settings.driver_max_online_hours_span')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="number" name="ride[driver_max_online_hours]" id="driver_max_online_hours"
                                                       value="<?php echo e(isset($taxidosettings['ride']['driver_max_online_hours']) ? $taxidosettings['ride']['driver_max_online_hours'] : old('driver_max_online_hours')); ?>"
                                                       placeholder="<?php echo e(__('taxido::static.settings.enter_driver_max_online_hours')); ?>">
                                                <?php $__errorArgs = ['ride[driver_max_online_hours]'];
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
                                            <label class="col-xxl-3 col-md-4" for="min_intracity_radius">
                                                <?php echo e(__('taxido::static.settings.min_intracity_radius')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="<?php echo e(__('taxido::static.settings.min_intracity_radius_span')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="number" name="ride[min_intracity_radius]" id="min_intracity_radius"
                                                       value="<?php echo e(isset($taxidosettings['ride']['min_intracity_radius']) ? $taxidosettings['ride']['min_intracity_radius'] : old('min_intracity_radius')); ?>"
                                                       placeholder="<?php echo e(__('taxido::static.settings.enter_min_intracity_radius')); ?>">
                                                <?php $__errorArgs = ['ride[min_intracity_radius]'];
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
                                            <label class="col-xxl-3 col-md-4" for="max_bidding_fare_driver">
                                                <?php echo e(__('taxido::static.settings.max_bidding_fare_driver')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="<?php echo e(__('taxido::static.settings.max_bidding_fare_driver_span')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="number" name="ride[max_bidding_fare_driver]" id="max_bidding_fare_driver"
                                                       value="<?php echo e(isset($taxidosettings['ride']['max_bidding_fare_driver']) ? $taxidosettings['ride']['max_bidding_fare_driver'] : old('max_bidding_fare_driver')); ?>"
                                                       placeholder="<?php echo e(__('taxido::static.settings.enter_max_bidding_fare_driver')); ?>">
                                                <?php $__errorArgs = ['ride[max_bidding_fare_driver]'];
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
                                            <label class="col-xxl-3 col-md-4" for="parcel_weight_limit">
                                                <?php echo e(__('taxido::static.settings.parcel_weight_limit')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="<?php echo e(__('taxido::static.settings.parcel_weight_limit_span')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="number" name="ride[parcel_weight_limit]" id="parcel_weight_limit"
                                                       value="<?php echo e(isset($taxidosettings['ride']['parcel_weight_limit']) ? $taxidosettings['ride']['parcel_weight_limit'] : old('parcel_weight_limit')); ?>"
                                                       placeholder="<?php echo e(__('taxido::static.settings.enter_parcel_weight_limit')); ?>">
                                                <?php $__errorArgs = ['ride[parcel_weight_limit]'];
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
                                            <label class="col-xxl-3 col-md-4" for="schedule_min_hour_limit">
                                                <?php echo e(__('taxido::static.settings.schedule_min_hour_limit')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="<?php echo e(__('taxido::static.settings.schedule_min_hour_limit_help')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="number" name="ride[schedule_min_hour_limit]" id="schedule_min_hour_limit"
                                                       value="<?php echo e(isset($taxidosettings['ride']['schedule_min_hour_limit']) ? $taxidosettings['ride']['schedule_min_hour_limit'] : old('parcel_weight_limit')); ?>"
                                                       placeholder="<?php echo e(__('taxido::static.settings.enter_schedule_min_hour_limit')); ?>">
                                                <?php $__errorArgs = ['ride[schedule_min_hour_limit]'];
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
                                            <label class="col-xxl-3 col-md-4" for="weight_unit">
                                                <?php echo e(__('taxido::static.settings.weight_unit')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="<?php echo e(__('taxido::static.settings.weight_unit_span')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <select class="form-control form-select" name="ride[weight_unit]" id="weight_unit"
                                                        data-placeholder="<?php echo e(__('taxido::static.settings.select_weight_unit')); ?>">
                                                    <option value="kg" <?php if(isset($taxidosettings['ride']['weight_unit']) && $taxidosettings['ride']['weight_unit'] == 'kg'): echo 'selected'; endif; ?>>Kilogram (kg)</option>
                                                    <option value="pound" <?php if(isset($taxidosettings['ride']['weight_unit']) && $taxidosettings['ride']['weight_unit'] == 'pound'): echo 'selected'; endif; ?>>Pound (lb)</option>
                                                </select>
                                                <?php $__errorArgs = ['ride[weight_unit]'];
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
                                            <label class="col-xxl-3 col-md-4" for="distance_unit">
                                                <?php echo e(__('taxido::static.settings.distance_unit')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="<?php echo e(__('taxido::static.settings.distance_unit_span')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <select class="form-control form-select" name="ride[distance_unit]" id="distance_unit"
                                                        data-placeholder="<?php echo e(__('taxido::static.settings.select_distance_unit')); ?>">
                                                    <option value="km" <?php if(isset($taxidosettings['ride']['distance_unit']) && $taxidosettings['ride']['distance_unit'] == 'km'): echo 'selected'; endif; ?>>Kilometers (km)</option>
                                                    <option value="mile" <?php if(isset($taxidosettings['ride']['distance_unit']) && $taxidosettings['ride']['distance_unit'] == 'mile'): echo 'selected'; endif; ?>>Miles (mile)</option>
                                                </select>
                                                <?php $__errorArgs = ['ride[distance_unit]'];
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


                                        <!-- Country Code Field -->
                                        <div class="form-group row">
                                            <label class="col-xxl-3 col-md-4" for="country_code">
                                                <?php echo e(__('taxido::static.settings.country_code')); ?> <span class="text-danger">*</span>
                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top"
                                                   data-bs-custom-class="custom-tooltip"
                                                   data-bs-title="<?php echo e(__('taxido::static.settings.select_country_code_span')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <select class="select-2 form-control select-country-code" name="ride[country_code]" id="country_code"
                                                        data-placeholder="<?php echo e(__('taxido::static.settings.select_country_code')); ?>" required>
                                                    <?php $__currentLoopData = getCountryCodes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option class="option"
                                                                value="<?php echo e($option->calling_code); ?>"
                                                                data-image="<?php echo e(asset('images/flags/' . $option->flag)); ?>"
                                                                <?php echo e((isset($taxidosettings['ride']['country_code']) && $taxidosettings['ride']['country_code'] == $option->calling_code) ? 'selected' : ''); ?>>
                                                            <?php echo e($option->calling_code); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['ride[country_code]'];
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
                                            <label class="col-xxl-3 col-md-4" for="maximum_seat">
                                                <?php echo e(__('taxido::static.settings.maximum_seat')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                data-bs-title="<?php echo e(__('taxido::static.settings.maximum_seat_span')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="number" min="1" name="ride[maximum_seat]" id="maximum_seat"
                                                    value="<?php echo e(isset($taxidosettings['ride']['maximum_seat']) ? $taxidosettings['ride']['maximum_seat'] : old('maximum_seat')); ?>"
                                                    placeholder="<?php echo e(__('taxido::static.settings.enter_maximum_seat')); ?>">
                                                <?php $__errorArgs = ['ride[maximum_seat]'];
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

                                    
                                    <div class="tab-pane fade" id="Wallet_Setting" role="tabpanel"
                                        aria-labelledby="v-pills-wallet" tabindex="0">
                                        <div class="form-group row">
                                            <label class="col-xxl-3 col-md-4"
                                                for="wallet_denominations"><?php echo e(__('taxido::static.settings.wallet_denominations')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.wallet_denominations_help')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="text"
                                                    name="wallet[wallet_denominations]" id="wallet[wallet_denominations]"
                                                    value="<?php echo e(isset($taxidosettings['wallet']['wallet_denominations']) ? $taxidosettings['wallet']['wallet_denominations'] : old('wallet_denominations')); ?>"
                                                    placeholder="<?php echo e(__('taxido::static.settings.enter_wallet_denominations')); ?>">
                                                <?php $__errorArgs = ['wallet[wallet_denominations]'];
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
                                            <label class="col-xxl-3 col-md-4"
                                                for="tip_denominations"><?php echo e(__('taxido::static.settings.tip_denominations')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.tip_denominations_help')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="text"
                                                    name="wallet[tip_denominations]" id="wallet[tip_denominations]"
                                                    value="<?php echo e(isset($taxidosettings['wallet']['tip_denominations']) ? $taxidosettings['wallet']['tip_denominations'] : old('tip_denominations')); ?>"
                                                    placeholder="<?php echo e(__('taxido::static.settings.enter_tip_denominations')); ?>">
                                                <?php $__errorArgs = ['wallet[tip_denominations]'];
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
                                            <label class="col-xxl-3 col-md-4"
                                                for="driver_min_wallet_balance"><?php echo e(__('taxido::static.settings.driver_min_wallet_balance')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.driver_min_wallet_balance_help')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="text"
                                                    name="wallet[driver_min_wallet_balance]" id="wallet[driver_min_wallet_balance]"
                                                    value="<?php echo e(isset($taxidosettings['wallet']['driver_min_wallet_balance']) ? $taxidosettings['wallet']['driver_min_wallet_balance'] : old('driver_min_wallet_balance')); ?>"
                                                    placeholder="<?php echo e(__('taxido::static.settings.enter_driver_min_wallet_balance')); ?>">
                                                <?php $__errorArgs = ['wallet[driver_min_wallet_balance]'];
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

                                    
                                    <div class="tab-pane fade" id="Referral_Setting" role="tabpanel"
                                        aria-labelledby="v-pills-referral" tabindex="0">

                                        
                                        <div class="form-group row">
                                            <label class="col-xxl-3 col-md-4"
                                                for="minimum_ride_amount"><?php echo e(__('taxido::static.settings.minimum_ride_amount')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.minimum_ride_amount_help')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="number" step="0.01" min="0"
                                                    name="referral[minimum_ride_amount]" id="referral[minimum_ride_amount]"
                                                    value="<?php echo e(isset($taxidosettings['referral']['minimum_ride_amount']) ? $taxidosettings['referral']['minimum_ride_amount'] : 250); ?>"
                                                    placeholder="<?php echo e(__('taxido::static.settings.enter_minimum_ride_amount')); ?>">
                                                <?php $__errorArgs = ['referral[minimum_ride_amount]'];
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
                                            <label class="col-xxl-3 col-md-4"
                                                for="referrer_bonus_percentage"><?php echo e(__('taxido::static.settings.referrer_bonus_percentage')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.referrer_bonus_percentage_help')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <div class="input-group">
                                                    <input class="form-control" type="number" step="0.01" min="0" max="100"
                                                        name="referral[referrer_bonus_percentage]" id="referral[referrer_bonus_percentage]"
                                                        value="<?php echo e(isset($taxidosettings['referral']['referrer_bonus_percentage']) ? $taxidosettings['referral']['referrer_bonus_percentage'] : 10); ?>"
                                                        placeholder="<?php echo e(__('taxido::static.settings.enter_referrer_bonus_percentage')); ?>">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <?php $__errorArgs = ['referral[referrer_bonus_percentage]'];
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
                                            <label class="col-xxl-3 col-md-4"
                                                for="referred_bonus_percentage"><?php echo e(__('taxido::static.settings.referred_bonus_percentage')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.referred_bonus_percentage_help')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <div class="input-group">
                                                    <input class="form-control" type="number" step="0.01" min="0" max="100"
                                                        name="referral[referred_bonus_percentage]" id="referral[referred_bonus_percentage]"
                                                        value="<?php echo e(isset($taxidosettings['referral']['referred_bonus_percentage']) ? $taxidosettings['referral']['referred_bonus_percentage'] : 5); ?>"
                                                        placeholder="<?php echo e(__('taxido::static.settings.enter_referred_bonus_percentage')); ?>">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                                <?php $__errorArgs = ['referral[referred_bonus_percentage]'];
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
                                    

                                    <div class="tab-pane fade" id="Location_Setting" role="tabpanel"
                                        aria-labelledby="v-pills-location" tabindex="0">
                                        <div class="form-group row">
                                            <label class="col-md-2" for="google_map_api_key"><?php echo e(__('taxido::static.settings.google_map_api_key')); ?></label>
                                            <div class="col-md-10">
                                                <div class="input-group test-form-group">
                                                    <input class="form-control" type="password"
                                                        id="google_map_api_key" name="location[google_map_api_key]"
                                                        value="<?php echo e(encryptKey($taxidosettings['location']['google_map_api_key'] ?? old('google_map_api_key'))); ?>"
                                                        placeholder="<?php echo e(__('taxido::static.settings.enter_google_map_api_key')); ?>">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary test-map-btn" type="button" data-input-id="google_map_api_key">
                                                            <?php echo e(__('taxido::static.settings.test_map')); ?>

                                                        </button>
                                                    </div>
                                                </div>
                                                <span class="text-gray mt-1 d-block">
                                                    * Need help generating a Google Maps API key? Follow the steps in the
                                                    <a href="https://developers.google.com/maps/documentation/javascript/get-api-key"
                                                    target="_blank" class="text-primary">Google Maps API Documentation</a>.
                                                    After entering your API key above, click "Test Map" to preview it in a modal and verify it's working correctly.
                                                </span>
                                                <?php $__errorArgs = ['location[google_map_api_key]'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-feedback d-block" role="alert"><strong><?php echo e($message); ?></strong></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>


                                    <div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg test-modal" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="mapModalLabel"><?php echo e(__('taxido::static.settings.map_preview')); ?></h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="map-container">
                                                        <div class="d-flex justify-content-center align-items-center h-100">
                                                            <div class="spinner-border text-primary" role="status">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="map-error" class="alert alert-danger d-none">
                                                        Failed to load Google Maps. Please check your API key.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="form-group row">
                                            <label for="map_provider"
                                                class="col-xxl-3 col-md-4"><?php echo e(__('taxido::static.settings.select_map_type')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="<?php echo e(__('taxido::static.settings.map')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8 error-div select-dropdown">
                                                <select class="select-2 form-control select-map"
                                                    id="location[map_provider]" name="location[map_provider]" data-placeholder="<?php echo e(__('taxido::static.settings.select_map')); ?>">
                                                    <option class="select-placeholder" value=""></option>
                                                    <?php $__currentLoopData = ['google_map' => 'Google Map', 'osm' => 'OpenStreetMap (OSM)']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option class="option" value="<?php echo e($key); ?>"
                                                            <?php if(($taxidosettings['location']['map_provider'] ?? old('location.map_provider')) == $key): ?> selected <?php endif; ?>>
                                                            <?php echo e($option); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['location.map_provider'];
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
                                            <label class="col-xxl-3 col-md-4"
                                                for="amount"><?php echo e(__('taxido::static.settings.radius_meter')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.radius')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="number" name="location[radius_meter]"
                                                    id="location[radius_meter]" min="1"
                                                    value="<?php echo e(isset($taxidosettings['location']['radius_meter']) ? $taxidosettings['location']['radius_meter'] : old('radius_meter')); ?>"
                                                    placeholder="<?php echo e(__('taxido::static.settings.enter_radius_meter')); ?>">
                                                <?php $__errorArgs = ['location[radius_meter]'];
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
                                            <label class="col-xxl-3 col-md-4"
                                                for="amount"><?php echo e(__('taxido::static.settings.radius_per_second')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.radius_second')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="number"
                                                    name="location[radius_per_second]" id="location[radius_per_second]"
                                                    min="1"
                                                    value="<?php echo e(isset($taxidosettings['location']['radius_per_second']) ? $taxidosettings['location']['radius_per_second'] : old('radius_per_second')); ?>"
                                                    placeholder="<?php echo e(__('taxido::static.settings.enter_radius_per_second')); ?>">
                                                <?php $__errorArgs = ['location[radius_per_second]'];
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



                                    
                        <div class="tab-pane fade" id="Ads_Network_Setting" role="tabpanel"
                        aria-labelledby="v-pills-ads-network-tab" tabindex="0">
                        <div class="form-group row">
                            <label class="col-md-5"
                                for="ads[native_enable]"><?php echo e(__('taxido::static.settings.native_ads_enable')); ?>

                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                data-bs-title="<?php echo e(__('taxido::static.settings.native_ads_enable_help')); ?>"></i>
                            </label>
                            <div class="col-md-7">
                                <div class="editor-space">
                                    <label class="switch">
                                        <?php if(isset($taxidosettings['ads']['native_enable'])): ?>
                                            <input class="form-control" type="hidden"
                                                name="ads[native_enable]" value="0">
                                            <input class="form-check-input" type="checkbox"
                                                name="ads[native_enable]" value="1"
                                                <?php echo e($taxidosettings['ads']['native_enable'] ? 'checked' : ''); ?>>
                                        <?php else: ?>
                                            <input class="form-control" type="hidden"
                                                name="ads[native_enable]" value="0">
                                            <input class="form-check-input" type="checkbox"
                                                name="ads[native_enable]" value="1">
                                        <?php endif; ?>
                                        <span class="switch-state"></span>
                                    </label>
                                </div>
                            </div>
    </div>
    <div class="form-group row">
        <label class="col-xxl-3 col-md-4"
               for="ads[android_google_ads_id]"><?php echo e(__('taxido::static.settings.android_google_ads_id')); ?>

            <i class="ri-error-warning-line" data-bs-toggle="tooltip"
               data-bs-placement="top" data-bs-custom-class="custom-tooltip"
               data-bs-title="<?php echo e(__('taxido::static.settings.android_google_ads_id_help')); ?>"></i>
        </label>
        <div class="col-xxl-9 col-md-8">
            <input class="form-control" type="text"
                   name="ads[android_google_ads_id]"
                   id="ads[android_google_ads_id]"
                   value="<?php echo e($taxidosettings['ads']['android_google_ads_id'] ?? old('ads.android_google_ads_id')); ?>"
                   placeholder="<?php echo e(__('taxido::static.settings.android_google_ads_id_placeholder')); ?>">
            <?php $__errorArgs = ['ads.android_google_ads_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback d-block" role="alert"><strong><?php echo e($message); ?></strong></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xxl-3 col-md-4"
               for="ads[ios_google_ads_id]"><?php echo e(__('taxido::static.settings.ios_google_ads_id')); ?>

            <i class="ri-error-warning-line" data-bs-toggle="tooltip"
               data-bs-placement="top" data-bs-custom-class="custom-tooltip"
               data-bs-title="<?php echo e(__('taxido::static.settings.ios_google_ads_id_help')); ?>"></i>
        </label>
        <div class="col-xxl-9 col-md-8">
            <input class="form-control" type="text"
                   name="ads[ios_google_ads_id]"
                   id="ads[ios_google_ads_id]"
                   value="<?php echo e($taxidosettings['ads']['ios_google_ads_id'] ?? old('ads.ios_google_ads_id')); ?>"
                   placeholder="<?php echo e(__('taxido::static.settings.ios_google_ads_id_placeholder')); ?>">
            <?php $__errorArgs = ['ads.ios_google_ads_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback d-block" role="alert"><strong><?php echo e($message); ?></strong></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xxl-3 col-md-4"
               for="ads[native_android_unit_id]"><?php echo e(__('taxido::static.settings.native_ads_android_unit_id')); ?>

            <i class="ri-error-warning-line" data-bs-toggle="tooltip"
               data-bs-placement="top" data-bs-custom-class="custom-tooltip"
               data-bs-title="<?php echo e(__('taxido::static.settings.native_ads_android_unit_id_help')); ?>"></i>
        </label>
        <div class="col-xxl-9 col-md-8">
            <input class="form-control" type="text"
                   name="ads[native_android_unit_id]"
                   id="ads[native_android_unit_id]"
                   value="<?php echo e($taxidosettings['ads']['native_android_unit_id'] ?? old('ads.native_android_unit_id')); ?>"
                   placeholder="<?php echo e(__('taxido::static.settings.native_ads_android_unit_id_placeholder')); ?>">
            <?php $__errorArgs = ['ads.native_android_unit_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback d-block" role="alert"><strong><?php echo e($message); ?></strong></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-xxl-3 col-md-4"
               for="ads[native_ios_unit_id]"><?php echo e(__('taxido::static.settings.native_ads_ios_unit_id')); ?>

            <i class="ri-error-warning-line" data-bs-toggle="tooltip"
               data-bs-placement="top" data-bs-custom-class="custom-tooltip"
               data-bs-title="<?php echo e(__('taxido::static.settings.native_ads_ios_unit_id_help')); ?>"></i>
        </label>
        <div class="col-xxl-9 col-md-8">
            <input class="form-control" type="text"
                   name="ads[native_ios_unit_id]"
                   id="ads[native_ios_unit_id]"
                   value="<?php echo e($taxidosettings['ads']['native_ios_unit_id'] ?? old('ads.native_ios_unit_id')); ?>"
                   placeholder="<?php echo e(__('taxido::static.settings.native_ads_ios_unit_id_placeholder')); ?>">
            <?php $__errorArgs = ['ads.native_ios_unit_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback d-block" role="alert"><strong><?php echo e($message); ?></strong></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>
</div>

                                    
                                    <div class="tab-pane fade" id="App_Configuration_Setting" role="tabpanel"
                                        aria-labelledby="v-pills-app-config-tab" tabindex="0">
                                        <div class="form-group row">
                                            <label class="col-md-2" for="splash_screen_id"><?php echo e(__('taxido::static.settings.splash_screen')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="*The splash screen is shown only when it is loaded in the app. It may display the default splash screen once or twice."></i>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <?php if (isset($component)) { $__componentOriginal22d447e3f5aafc93b8447b54b36ee789 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image','data' => ['name' => 'setting[splash_screen_id]','data' => isset($taxidosettings['setting']['splash_screen'])
                                                        ? $taxidosettings['setting']['splash_screen']
                                                        : old('setting.splash_screen_id'),'text' => false,'multiple' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('setting[splash_screen_id]'),'data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($taxidosettings['setting']['splash_screen'])
                                                        ? $taxidosettings['setting']['splash_screen']
                                                        : old('setting.splash_screen_id')),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'multiple' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $attributes = $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $component = $__componentOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
                                                    <?php $__errorArgs = ['splash_screen_id'];
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
                                            <label class="col-md-2" for="splash_driver_screen_id"><?php echo e(__('taxido::static.settings.splash_driver_screen')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="*The splash screen is shown only when it is loaded in the app. It may display the default splash screen once or twice."></i>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <?php if (isset($component)) { $__componentOriginal22d447e3f5aafc93b8447b54b36ee789 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image','data' => ['name' => 'setting[splash_driver_screen_id]','data' => isset($taxidosettings['setting']['driver_splash_screen'])
                                                        ? $taxidosettings['setting']['driver_splash_screen']
                                                        : old('setting.splash_driver_screen_id'),'text' => false,'multiple' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('setting[splash_driver_screen_id]'),'data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($taxidosettings['setting']['driver_splash_screen'])
                                                        ? $taxidosettings['setting']['driver_splash_screen']
                                                        : old('setting.splash_driver_screen_id')),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false),'multiple' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $attributes = $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $component = $__componentOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
                                                    <?php $__errorArgs = ['splash_driver_screen_id'];
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
                                            <label class="col-xxl-3 col-md-4"
                                                for="app_version"><?php echo e(__('taxido::static.settings.app_version')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.user_app_span')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="text" name="setting[app_version]"
                                                    id="setting[app_version]"
                                                    value="<?php echo e(isset($taxidosettings['setting']['app_version']) ? $taxidosettings['setting']['app_version'] : old('app_version')); ?>"
                                                    placeholder="<?php echo e(__('taxido::static.settings.enter_version')); ?>">
                                                <?php $__errorArgs = ['setting[app_version]'];
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
                                            <label class="col-xxl-3 col-md-4"
                                                for="driver_app_version"><?php echo e(__('taxido::static.settings.driver_app_version')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.driver_app_span')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="text" name="setting[driver_app_version]"
                                                    id="setting[driver_app_version]"
                                                    value="<?php echo e(isset($taxidosettings['setting']['driver_app_version']) ? $taxidosettings['setting']['driver_app_version'] : old('driver_app_version')); ?>"
                                                    placeholder="<?php echo e(__('taxido::static.settings.enter_version')); ?>">
                                                <?php $__errorArgs = ['setting[driver_app_version]'];
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
                                            <label class="col-xxl-3 col-md-4"
                                                for="rider_privacy_policy"><?php echo e(__('taxido::static.settings.rider_privacy_policy')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.enter_privacy_policy_url')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="text" name="setting[rider_privacy_policy]"
                                                    id="setting[rider_privacy_policy]"
                                                    value="<?php echo e(isset($taxidosettings['setting']['rider_privacy_policy']) ? $taxidosettings['setting']['rider_privacy_policy'] : old('rider_privacy_policy')); ?>"
                                                    placeholder="<?php echo e(__('taxido::static.settings.enter_privacy_policy_url')); ?>">
                                                <?php $__errorArgs = ['setting[rider_privacy_policy]'];
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
                                            <label class="col-xxl-3 col-md-4"
                                                for="driver_privacy_policy"><?php echo e(__('taxido::static.settings.driver_privacy_policy')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('taxido::static.settings.enter_privacy_policy_url')); ?>"></i>
                                            </label>
                                            <div class="col-xxl-9 col-md-8">
                                                <input class="form-control" type="text" name="setting[driver_privacy_policy]"
                                                    id="setting[driver_privacy_policy]"
                                                    value="<?php echo e(isset($taxidosettings['setting']['driver_privacy_policy']) ? $taxidosettings['setting']['driver_privacy_policy'] : old('driver_privacy_policy')); ?>"
                                                    placeholder="<?php echo e(__('taxido::static.settings.enter_privacy_policy_url')); ?>">
                                                <?php $__errorArgs = ['setting[driver_privacy_policy]'];
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

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary spinner-btn"><i class="ri-save-line text-white lh-1"></i><?php echo e(__('static.save')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {

                 $('.fileInput').on('change', function(event) {
                const input = this;
                const previewId = $(this).data('preview-id');
                const $preview = $('#' + previewId);

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $preview.attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $preview.attr('src', '').hide();
                }
            });


                const MAX_Greetings = 5;
                let map = null;
                let googleMapsScript = null;
                $('[data-bs-toggle="tooltip"]').tooltip();
                $('.test-map-btn').on('click', function () {
                    const inputId = $(this).data('input-id');
                    const apiKey = $('#' + inputId).val();
                    const $btn = $(this);

                    if (!apiKey) {
                        toastr.error('Please enter a Google Maps API key first.');
                        return;
                    }

                    $btn.html('<i class="fa fa-spinner fa-spin"></i> Testing..').prop('disabled', true);
                    loadGoogleMap(apiKey, $btn);
                });

                function loadGoogleMap(apiKey, $btn) {
                    if (map) {
                        google.maps.event.clearInstanceListeners(map);
                        map = null;
                    }

                    if (googleMapsScript) {
                        googleMapsScript.remove();
                    }

                    googleMapsScript = document.createElement('script');
                    googleMapsScript.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}&callback=initMap`;
                    googleMapsScript.async = true;
                    googleMapsScript.defer = true;
                    googleMapsScript.onerror = function () {
                        $('#map-container').html('');
                        $('#map-error').removeClass('d-none');
                        $btn.html('<?php echo e(__("taxido::static.settings.test_map")); ?>').prop('disabled', false);
                    };
                    document.head.appendChild(googleMapsScript);

                    $('#mapModal').modal('show');
                }

                window.initMap = function () {
                    try {
                        map = new google.maps.Map(document.getElementById('map-container'), {
                            center: { lat: 20.5937, lng: 78.9629 },
                            zoom: 4
                        });
                        $('.test-map-btn').html('<?php echo e(__("taxido::static.settings.test_map")); ?>').prop('disabled', false);
                    } catch (e) {
                        $('#map-container').html('');
                        $('#map-error').removeClass('d-none');
                        $('.test-map-btn').html('<?php echo e(__("taxido::static.settings.test_map")); ?>').prop('disabled', false);
                        toastr.error('Failed to initialize Google Maps. Please check your API key.');
                    }
                };

                $('#mapModal').on('hidden.bs.modal', function () {
                    if (map) {
                        google.maps.event.clearInstanceListeners(map);
                        map = null;
                    }
                });

                function toggleRemoveButtons() {
                    if ($('#greeting-group .form-group').length === 1) {
                        $('#greeting-group .remove-greeting').hide();
                    } else {
                        $('#greeting-group .remove-greeting').show();
                    }
                }

                $('#add-greeting').on('click', function () {
                    const greetingCount = $('#greeting-group .form-group').length;
                    if (greetingCount >= MAX_Greetings) {
                        toastr.warning('You can add up to 5 greetings only.');
                        return;
                    }
                    var newgreetingField = $('#greeting-group .form-group:first').clone();
                    newgreetingField.find('input').val('');
                    $('#greeting-group').append(newgreetingField);
                    toggleRemoveButtons();
                });

                $(document).on('click', '.remove-greeting', function () {
                    $(this).closest('.form-group').remove();
                    toggleRemoveButtons();
                });

                toggleRemoveButtons();
                function toggleCommissionRate(type, currencyIconId, percentageIconId, rateContainerId) {
                    if (type === 'fixed') {
                        $(`#${currencyIconId}`).show();
                        $(`#${percentageIconId}`).hide();
                    } else if (type === 'percentage') {
                        $(`#${currencyIconId}`).hide();
                        $(`#${percentageIconId}`).show();
                    }
                    $(`#${rateContainerId}`).show();
                }

                function setupCommissionSelector(typeSelectorId, currencyIconId, percentageIconId, rateContainerId) {
                    const initialType = $(`#${typeSelectorId}`).val();
                    if (initialType) {
                        toggleCommissionRate(initialType, currencyIconId, percentageIconId, rateContainerId);
                    }

                    $(`#${typeSelectorId}`).on('change', function () {
                        const selectedType = $(this).val();
                        if (selectedType) {
                            toggleCommissionRate(selectedType, currencyIconId, percentageIconId, rateContainerId);
                        } else {
                            $(`#${rateContainerId}`).hide();
                        }
                    });
                }

                setupCommissionSelector('ambulance_commission_type', 'ambulanceCurrencyIcon', 'ambulancePercentageIcon', 'ambulance_commission_rate');
                setupCommissionSelector('fleet_commission_type', 'fleetCurrencyIcon', 'fleetPercentageIcon', 'fleet_commission_rate');
            });
        })(jQuery);
    </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/admin/taxido-setting/index.blade.php ENDPATH**/ ?>