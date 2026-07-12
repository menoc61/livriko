<?php $__env->startSection('title', __('taxido::front.dashboard')); ?>
<?php $__env->startSection('detailBox'); ?>
    <div class="dashboard-details-box">
        <div class="dashboard-title">
            <h3><?php echo e(__('taxido::front.dashboard')); ?></h3>
        </div>
        <div class="wallet-main-box">
            <div class="row g-xl-4 g-lg-3 g-md-4 g-3">
                <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                    <div class="wallet-box wallet-color-1">
                        <div class="wallet-number">
                            <h2><?php echo e(getDefaultCurrency()?->symbol); ?><?php echo e($rider?->wallet?->balance ?? 0); ?></h2>
                            <h5><?php echo e(__('taxido::front.my_wallet')); ?></h5>
                        </div>
                        <div class="icon-box">
                            <svg>
                                <use xlink:href="<?php echo e(asset('images/svg/wallet.svg#wallet')); ?>">
                                </use>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                    <div class="wallet-box wallet-color-2">
                        <div class="wallet-number">
                            <h2><?php echo e($rider->total_active_rides ?? 0); ?></h2>
                            <h5><?php echo e(__('taxido::front.total_active_rides')); ?></h5>
                        </div>
                        <div class="icon-box">
                            <svg>
                                <use xlink:href="<?php echo e(asset('images/svg/car.svg#car')); ?>">
                                </use>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                    <div class="wallet-box wallet-color-3">
                        <div class="wallet-number">
                            <h2><?php echo e($rider->total_complete_rides ?? 0); ?></h2>
                            <h5><?php echo e(__('taxido::front.total_completed_rides')); ?></h5>
                        </div>
                        <div class="icon-box">
                            <svg>
                                <use xlink:href="<?php echo e(asset('images/svg/car.svg#car')); ?>">
                                </use>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-sm-4 g-3">
            <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-6">
                <div class="row gy-xxl-5 g-xl-3 gy-lg-4 gy-3">
                    <div class="col-xxl-12 col-xl-6">
                        <div class="dashboard-sub-title">
                            <h3><?php echo e(__('taxido::front.personal_information')); ?></h3>
                        </div>

                        <ul class="profile-info-list">
                            <li><span><?php echo e(__('taxido::front.name')); ?>:</span><?php echo e($rider?->name ?? 'N/A'); ?></li>
                            <li><span><?php echo e(__('taxido::front.phone')); ?>:</span>
                                <?php echo e($rider?->country_code ? '+' . $rider?->country_code : ''); ?>

                                <?php echo e($rider?->phone ?? 'N/A'); ?></li>
                            <li><span><?php echo e(__('taxido::front.address')); ?>:</span> <?php echo e($rider?->address ?? 'N/A'); ?>

                            </li>
                            <li><span>Maximum Seats:</span> </li>
                            
                        </ul>
                    </div>

                    <div class="col-xxl-12 col-xl-6">
                        <div class="dashboard-sub-title">
                            <h3><?php echo e(__('taxido::front.login_details')); ?></h3>
                        </div>

                        <ul class="profile-info-list">
                            <li><span><?php echo e(__('taxido::front.email')); ?>:</span> <?php echo e($rider?->email); ?> <a
                                    data-bs-toggle="modal" href="#editProfileModal"><?php echo e(__('taxido::front.edit')); ?></a></li>
                            <li><span><?php echo e(__('taxido::front.password')); ?>:</span> ******* <a data-bs-toggle="modal"
                                    href="#changePasswordModal"><?php echo e(__('taxido::front.edit')); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-12 col-md-6 text-center">
                <svg class="dashboard-svg">
                    <use xlink:href="<?php echo e(asset('images/user-dashboard.svg#userDashboard')); ?>"></use>
                </svg>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal Start -->
    <div class="modal fade theme-modal" id="editProfileModal">
        <div class="modal-dialog modal-dialog-centered custom-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><?php echo e(__('taxido::front.edit_profile')); ?></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <form action="<?php echo e(route('front.cab.updateProfile')); ?>" method="POST" id="updateProfileForm">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-box form-icon">
                            <label for="name" class="form-label"><?php echo e(__('taxido::front.full_name')); ?></label>
                            <div class="position-relative">
                                <i class="ri-user-3-line"></i>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="<?php echo e($rider?->name ?? ''); ?>"
                                    placeholder="<?php echo e(__('taxido::front.enter_full_name')); ?>">
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
                        <div class="form-box form-icon">
                            <label for="mail" class="form-label"><?php echo e(__('taxido::front.email_address')); ?></label>
                            <div class="position-relative">
                                <i class="ri-mail-line"></i>
                                <input type="email" name="email" class="form-control" id="mail"
                                    value="<?php echo e($rider?->email ?? ''); ?>"
                                    placeholder="<?php echo e(__('taxido::front.enter_email')); ?>">
                            </div>
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
                        <div class="form-box">
                            <label for="phoneNumber" class="form-label"><?php echo e(__('taxido::front.phone_number')); ?></label>
                            <div class="number-mail-box">
                                <div class="country-code-section">
                                    <select class="select-2 form-control" id="select-country-code" name="country_code">
                                        <?php $__currentLoopData = getCountryCodes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option class="option" value="<?php echo e($option->calling_code); ?>"
                                                data-image="<?php echo e(asset('images/flags/' . $option->flag)); ?>"
                                                <?php if($option->calling_code == old('country_code', $rider?->country_code ?? '1')): echo 'selected'; endif; ?>>
                                                <?php echo e($option->calling_code); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                    <input type="number" name="phone" class="form-control" id="phoneNumber"
                                        value="<?php echo e(old('phone', $rider?->phone ?? '')); ?>"
                                        placeholder="<?php echo e(__('taxido::front.enter_phone_number')); ?>" required>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn cancel-btn"
                            data-bs-dismiss="modal"><?php echo e(__('taxido::front.cancel')); ?></button>
                        <button type="submit"
                            class="btn gradient-bg-color spinner-btn"><?php echo e(__('taxido::front.update')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Profile Modal End -->

    <!-- Change Password Modal -->
    <div class="modal fade theme-modal" id="changePasswordModal">
        <div class="modal-dialog modal-dialog-centered custom-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><?php echo e(__('taxido::front.change_password')); ?></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="ri-close-line"></i>
                    </button>
                </div>

                <form action="<?php echo e(route('front.cab.updatePassword')); ?>" method="POST" id="changePasswordForm">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('POST'); ?>
                    <div class="modal-body">
                        <div class="form-box form-icon">
                            <label for="current" class="form-label"><?php echo e(__('taxido::front.current_password')); ?></label>
                            <div class="position-relative">
                                <i class="ri-lock-password-line"></i>
                                <input type="password" name="current_password" class="form-control"
                                    id="current_password" placeholder="<?php echo e(__('taxido::front.enter_current_password')); ?>">
                                <i class="ri-eye-line toggle-password right-icon"></i>
                            </div>
                            <?php $__errorArgs = ['current_password'];
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
                        <div class="form-box form-icon">
                            <label for="new" class="form-label"><?php echo e(__('taxido::front.new_password')); ?></label>
                            <div class="position-relative">
                                <i class="ri-lock-password-line"></i>
                                <input type="password" name="new_password" class="form-control" id="new_password"
                                    placeholder="<?php echo e(__('taxido::front.enter_new_password')); ?>">
                                <i class="ri-eye-line toggle-password right-icon"></i>
                            </div>
                            <?php $__errorArgs = ['new_password'];
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
                        <div class="form-box form-icon">
                            <label for="confirm" class="form-label"><?php echo e(__('taxido::front.confirm_password')); ?></label>
                            <div class="position-relative">
                                <i class="ri-lock-password-line"></i>
                                <input type="password" name="confirm_password" class="form-control"
                                    id="confirm_password" placeholder="<?php echo e(__('taxido::front.enter_confirm_password')); ?>">
                                <i class="ri-eye-line toggle-password right-icon"></i>
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

                    <div class="modal-footer">
                        <button type="button" class="btn cancel-btn"
                            data-bs-dismiss="modal"><?php echo e(__('taxido::front.cancel')); ?></button>
                        <button type="submit"
                            class="btn gradient-bg-color spinner-btn"><?php echo e(__('taxido::front.update')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Change Password Modal End -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $("#changePasswordForm").validate({
                    ignore: [],
                    rules: {
                        "current_password": "required",
                        "new_password": {
                            required: true,
                            minlength: 8
                        },
                        "confirm_password": {
                            required: true,
                            equalTo: "#new_password"
                        },
                    },
                });

                $("#updateProfileForm").validate({
                    ignore: [],
                    rules: {
                        "name": "required",
                        "email": "required",
                        "phone": "required"
                    },
                });
            });
        })(jQuery);
    </script>
    <script>
        $(document).ready(function() {
            $('#select-country-code').select2({
                dropdownParent: $('#updateProfileForm').closest('.modal'),
                templateResult: function(data) {
                    if (!data.id) return data.text;

                    const imageUrl = $(data.element).data('image');
                    const $result = $(`
                            <span>
                                <img src="${imageUrl}" class="flag-img" onerror="this.onerror=null;this.src='<?php echo e(asset('front/images/placeholder/49x37.png')); ?>';" />
                                + ${data.text.trim()}
                            </span>
                        `);
                    return $result;
                },
                templateSelection: function(data) {
                    if (!data.id) return data.text;

                    const imageUrl = $(data.element).data('image');
                    const $result = $(`
                            <span>
                                <img src="${imageUrl}" class="flag-img" onerror="this.onerror=null;this.src='<?php echo e(asset('front/images/placeholder/49x37.png')); ?>';" />
                                + ${data.text.trim()}
                            </span>
                        `);
                    return $result;
                },
                escapeMarkup: function(m) {
                    return m;
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('taxido::front.account.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/front/account/dashboard.blade.php ENDPATH**/ ?>