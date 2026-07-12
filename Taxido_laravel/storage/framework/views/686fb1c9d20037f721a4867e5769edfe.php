<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e(session('dir', getDefaultDirection())); ?>">
<head>
    <?php echo $__env->make('admin.layouts.partials.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('admin.layouts.partials.css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Main css-->
    <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e(config('app.title')); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/scss/admin.scss']); ?>
    <?php echo $__env->yieldPushContent('css'); ?>
    <?php echo $__env->make('inc.style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</head>

<body class="theme <?php echo e(session('dir', getDefaultDirection())); ?> <?php echo e(session('theme', '')); ?>">
    <div class="page-wrapper">
        <?php if ($__env->exists('admin.layouts.partials.header')) echo $__env->make('admin.layouts.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="page-body-wrapper">
            <?php if ($__env->exists('admin.layouts.partials.sidebar')) echo $__env->make('admin.layouts.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <div class="page-body">
                    <div class="container-fluid px-0">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
            <?php if ($__env->exists('admin.layouts.partials.footer')) echo $__env->make('admin.layouts.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>
    <?php if ($__env->exists('inc.files')) echo $__env->make('inc.files', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('admin.layouts.partials.script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/script.js']); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php if ($__env->exists('inc.alerts')) echo $__env->make('inc.alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>

</html>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/layouts/master.blade.php ENDPATH**/ ?>