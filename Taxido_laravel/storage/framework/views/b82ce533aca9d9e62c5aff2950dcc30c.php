<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e(session('dir', getDefaultDirection())); ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="pixelstrap">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="shortcut icon"
        href="<?php echo e(getSettings()['general']['favicon_image']?->original_url ?? asset('favicon.ico')); ?>"
        type="image/x-icon">
    <link rel="shortcut icon"
        href="<?php echo e(getSettings()['general']['favicon_image']?->original_url ?? asset('favicon.ico')); ?>"
        type="image/x-icon">
    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e(env('APP_NAME')); ?></title>

    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/vendors/font-awesome.css')); ?>">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/vendors/bootstrap.css')); ?>">
    <!-- Animated css-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/vendors/animate.css')); ?>">
    <!-- Remixicon css-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/vendors/remixicon.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/vendors/select2.css')); ?>">

    <!-- Main css-->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/scss/admin.scss']); ?>
    <?php echo $__env->make('inc.style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</head>

<body class="<?php echo e(session('dir', getDefaultDirection())); ?>">
    <div class="page-wrapper">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- latest jquery -->
    <script src="<?php echo e(asset('js/jquery-3.7.1.min.js')); ?>"></script>

    <!-- Bootstrap js -->
    <script src="<?php echo e(asset('js/bootstrap/bootstrap.min.js')); ?>" defer></script>

    <!-- JQuery Validation js -->
    <script src="<?php echo e(asset('js/jquery.validate.min.js')); ?>" defer></script>
    <script src="<?php echo e(asset('js/additional-methods.min.js')); ?>" defer></script>

    <!-- Select2 -->
    <script src="<?php echo e(asset('js/select2.full.min.js')); ?>" defer></script>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/script.js']); ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/auth/master.blade.php ENDPATH**/ ?>