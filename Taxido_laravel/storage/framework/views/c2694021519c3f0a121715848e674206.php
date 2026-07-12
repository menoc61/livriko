<?php
use App\Enums\RoleEnum;
use Modules\Taxido\Enums\RoleEnum as ModuleRole;
$settings = getSettings();
$roleCredentials = getRoleCredentials();
?>

<?php $__env->startSection('title', __('static.login')); ?>
<?php $__env->startSection('content'); ?>
<section class="auth-page">
    <?php if(env('APP_VERSION')): ?>
    <span class="ms-auto d-flex badge badge-version-primary"><?php echo e(__('static.version')); ?><?php echo e(env('APP_VERSION')); ?></span>
    <?php endif; ?>
    <div class="container">
        <div class="auth-main">
            <div class="auth-card">
                <div class="text-center">
                    <?php if(isset(getSettings()['general']['light_logo_image'])): ?>
                    <img class="login-img" src="<?php echo e(getSettings()['general']['light_logo_image']?->original_url); ?>" alt="logo" loading="lazy">
                    <?php else: ?>
                    <h2><?php echo e(config('app.name')); ?></h2>
                    <?php endif; ?>
                </div>
                <div class="welcome">
                    <h3><?php echo e(__('static.welcome', ['appName' => config('app.name')])); ?></h3>
                    <p><?php echo e(__('static.information')); ?></p>
                </div>
                <?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div>
                    <span class="invalid-feedback d-block" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </div>
                </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="main">
                    <form id="loginForm" action="<?php echo e(route('login')); ?>" method='POST'>
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <i class="ri-mail-line divider"></i>
                            <div class="position-relative">
                                <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo e(__('static.enter_email')); ?>" required>
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
                        <div class="form-group">
                            <i class="ri-lock-line divider"></i>
                            <div class="position-relative">
                                <input type="password" class="form-control input-icon" id="password" name="password"
                                    placeholder="<?php echo e(__('static.enter_password')); ?>" required>
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
                        <?php if(Route::has('password.request')): ?>
                        <div class="form-terms form-group">
                            <div class="d-flex align-items-center">
                                <div class="form-check p-0">
                                    <input type="checkbox" class="item-checkbox form-check-input me-2" id="remember">
                                    <label for="remember"><?php echo e(__('static.remember_me')); ?></label>
                                </div>
                            </div>
                            <a href="<?php echo e(route('password.request')); ?>" class="forgot-pass"><?php echo e(__('static.users.lost_your_password')); ?></a>
                        </div>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-solid justify-content-center w-100 spinner-btn mt-0">
                            <?php echo e(__('static.login')); ?>

                        </button>
                    </form>
                </div>
                <?php if(isset($settings['activation']['default_credentials'])): ?>
                <?php if((int) $settings['activation']['default_credentials']): ?>
                <div class="demo-credential">
                    <?php $__currentLoopData = $roleCredentials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button class="btn btn-solid default-credentials" data-email="<?php echo e($role['email']); ?>" data-password="<?php echo e($role['password'] ?? '123456789'); ?>">
                        <?php echo e(ucfirst($role['role'])); ?>

                    </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
                <?php endif; ?>
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
            $('#loginForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true
                    },
                }
            });

            $(".default-credentials").click(function() {
                $("#email").val("");
                $("#password").val("");
                var email = $(this).data("email");
                var password = $(this).data("password");
                $("#email").val(email);
                $("#password").val(password);
            });
        });
    })(jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('auth.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/auth/login.blade.php ENDPATH**/ ?>