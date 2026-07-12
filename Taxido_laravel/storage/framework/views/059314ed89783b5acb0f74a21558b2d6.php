<?php use \App\Models\Language; ?>
<?php
    $locale = Session::get('front-locale', getDefaultLangLocale());
    $lang = Language::where('locale', Session::get('front-locale', getDefaultLangLocale()))?->whereNull('deleted_at')->first();
?>

<!DOCTYPE html>
<html lang="<?php echo e(Session::get('front-locale', getDefaultLangLocale())); ?>">

<head>
    <?php echo $__env->make('front.layouts.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('front.layouts.style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</head>

<body class="theme <?php echo e($lang->is_rtl ? 'rtl' : 'ltr'); ?> <?php echo e(session('front_theme', '')); ?>">
    <?php echo $__env->make('front.layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php if($settings['activation']['preloader_enabled'] ?? false): ?>
    <div class="loader-box" id="fullScreenLoader">
        <img class="img-fluid" alt="loader-image"
             src="<?php echo e($settings['appearance']['preloader_image']?->original_url ?? asset('front/images/preloader.gif')); ?>">
    </div>
    <?php endif; ?>

    <!-- Loader End -->

    <?php echo $__env->make('front.layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('front.layouts.script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php if ($__env->exists('inc.alerts')) echo $__env->make('inc.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/front/layouts/master.blade.php ENDPATH**/ ?>