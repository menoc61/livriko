<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php echo e(env('APP_NAME')); ?>">
<meta name="keywords" content="<?php echo e(env('APP_NAME')); ?>">
<meta name="author" content="<?php echo e(env('APP_NAME')); ?>">
<!-- CSRF Token -->
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<link rel="icon" href="<?php echo e(getSettings()['general']['favicon_image']?->original_url ?? asset('images/favicon.svg')); ?>"
    type="image/x-icon">
<link rel="shortcut icon" type="image/x-icon"
    href="<?php echo e(getSettings()['general']['favicon_image']?->original_url ?? asset('images/favicon.svg')); ?>">

<!-- Google font-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap">
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/layouts/partials/head.blade.php ENDPATH**/ ?>