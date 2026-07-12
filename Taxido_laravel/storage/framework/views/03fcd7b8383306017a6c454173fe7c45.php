<?php $__env->startSection('title', __('taxido::front.login')); ?>
<?php $__env->startSection('content'); ?>
    <section class="authentication-section section-b-space">
        <div class="container">
        <?php
            $cabSettings = getSettings();
        ?>
            <div class="auth-form-box">
                <div class="row align-items-center">
                    <div class="col-xl-7 col-lg-6 d-lg-block d-none">
                        <img src="<?php echo e(asset('images/authentication-img.png')); ?>" class="img-fluid auth-image">
                    </div>

                    <div class="col-xl-5 col-lg-6">
                        <div class="auth-right-box">
                        <h3><?php echo e(__('taxido::front.welcome_to', ['app_name' => env('APP_NAME')])); ?></h3>
                            <h6><?php echo e(__('taxido::front.account_information')); ?></h6>
                            <form method="POST" id="loginForm">
                                <?php echo csrf_field(); ?>
                                <div class="form-box">
                                    <div class="number-mail-box">
                                        <div class="country-code-section" style="display: block;">
                                            <select class="select-2 form-control" id="select-country-code" name="country_code">
                                                <?php $__currentLoopData = getCountryCodes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option class="option" value="<?php echo e($option->calling_code); ?>"
                                                        data-image="<?php echo e(asset('images/flags/' . $option->flag)); ?>"
                                                        <?php if($option->calling_code == old('country_code', rideCountryCode() ?? 1)): echo 'selected'; endif; ?>>
                                                        <?php echo e($option->calling_code); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <input type="text" class="form-control" name="email_or_phone" id="email_or_phone"
                                            placeholder="<?php echo e(__('taxido::front.enter_phone_email')); ?>" value="<?php echo e(old('email_or_phone')); ?>">
                                        <?php $__errorArgs = ['email_or_phone'];
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
                                <button type="button" class="btn gradient-bg-color otp-btn" id="get-otp-btn"><?php echo e(__('taxido::front.get_otp')); ?></button>
                            </form>

                            <div class="or-box">
                                <span><?php echo e(__('taxido::front.login_with')); ?></span>
                            </div>
                            <?php if(isset($cabSettings['activation']['default_credentials'])): ?>
                                <?php if((int) $cabSettings['activation']['default_credentials']): ?>
                                <div class="demo-credential">
                                    <button class="btn btn-outline default-credentials guest-btn" data-email="rider@example.com">
                                        <span>
                                            <i class="ri-user-3-fill"></i>
                                        </span>
                                        <?php echo e(__('taxido::front.demo_user')); ?></button>
                                </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <h6 class="new-account"><?php echo e(__('taxido::front.don’t_have_account')); ?>

                                <a href="<?php echo e(route('front.cab.register.index')); ?>"><?php echo e(__('taxido::front.sign_up')); ?></a>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                let isNumb = false;

                // Detect if email or phone number is entered
                $('#email_or_phone').on('input', function() {
                    const value = $(this).val();
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Email format
                    const alphaRegex = /[a-zA-Z]/; // Any alphabetic character

                    if (emailRegex.test(value) || alphaRegex.test(value)) {
                        $('.country-code-section').hide();
                        $('.col-sm-9').addClass('col-sm-12-full');
                        isNumb = false;
                    } else {
                        $('.country-code-section').show();
                        $('.col-sm-9').removeClass('col-sm-12-full');
                        isNumb = true;
                    }

                    // Update validation rules dynamically
                    $('#email_or_phone').rules('remove', 'minlength maxlength');
                    if (isNumb) {
                        $('#email_or_phone').rules('add', {
                            minlength: 6,
                            maxlength: 15
                        });
                    }
                });

                $('#loginForm').validate({
                    rules: {
                        email_or_phone: {
                            required: true
                        }
                    },
                    messages: {
                        email_or_phone: {
                            required: "Please enter your email or phone number.",
                            minlength: "Phone number must be at least 6 digits.",
                            maxlength: "Phone number cannot exceed 15 digits."
                        }
                    }
                });

                $('#get-otp-btn').click(function() {
                    if (!$('#loginForm').valid()) return;

                    const emailOrPhone = $('#email_or_phone').val();
                    const countryCode = $('#select-country-code').val();
                    const isEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailOrPhone);

                    $.ajax({
                        url: "<?php echo e(route('front.cab.login_with_credential')); ?>",
                        method: 'POST',
                        data: {
                            email_or_phone: emailOrPhone,
                            country_code: isEmail ? null : countryCode,
                            _token: '<?php echo e(csrf_token()); ?>'
                        },
                        beforeSend: function() {
                            $('#get-otp-btn').prop('disabled', true).html('<?php echo e(__('taxido::front.get_otp')); ?> <span class="spinner-border spinner-border-sm ms-2 spinner_loader"></span>');
                        },
                        complete: function() {
                            $('#get-otp-btn').prop('disabled', false).text('<?php echo e(__('taxido::front.get_otp')); ?>');
                        },
                        success: function(response) {
                            if (response.success) {
                                window.location.href = "<?php echo e(route('front.cab.verify_otp')); ?>";
                            } else {
                                toastr.error(response.message || "<?php echo e(__('taxido::front.failed_resent_otp')); ?>");
                            }
                        },
                        error: function(xhr) {
                            let message = "<?php echo e(__('taxido::front.failed_resent_otp')); ?>";
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                message = xhr.responseJSON.message;
                            } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                                message = Object.values(xhr.responseJSON.errors).join('\n');
                            }
                            toastr.error(message);
                        }
                    });
                });

                $(".default-credentials").click(function() {
                    $("#email_or_phone").val("");
                    var email = $(this).data("email");
                    $("#email_or_phone").val(email);
                    $('.country-code-section').hide();
                    $('.col-sm-9').addClass('col-sm-12-full');
                });
            });
        })(jQuery);
    </script>
    <script>
        $(document).ready(function () {
                $('#select-country-code').select2({
                    templateResult: function (data) {
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
                    templateSelection: function (data) {
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
                    escapeMarkup: function (m) { return m; }
                });
            });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('front.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/front/auth/login.blade.php ENDPATH**/ ?>