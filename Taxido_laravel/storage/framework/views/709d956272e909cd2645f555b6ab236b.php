<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php echo e($content['seo']['meta_description'] ?? ''); ?>">
<meta name="keywords" content="<?php echo e($content['seo']['meta_tags'] ?? ''); ?>">
<meta property="og:image" content="<?php echo e(asset($content['seo']['meta_image'] ?? '')); ?>">
<meta property="og:title" content="<?php echo e($content['seo']['og_title'] ?? ''); ?>">
<meta property="og:description" content="<?php echo e($content['seo']['og_description'] ?? ''); ?>">
<meta name="author" content="Taxido">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<link rel="icon" href="<?php echo e(getSettings()['general']['favicon_image']?->original_url ?? asset('images/favicon.svg')); ?>" type="image/x-icon">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo e(getSettings()['general']['favicon_image']?->original_url ?? asset('images/favicon.svg')); ?>">
<title><?php echo e(config('app.title')); ?> - <?php echo $__env->yieldContent('title'); ?></title>
<link rel="apple-touch-icon" href="<?php echo e(asset('front/images/logo/favicon.png')); ?>">
<meta name="theme-color" content="#7C57FF">
<link rel="canonical" href="<?php echo e(url()?->current()); ?>" />
<meta property="og:url" content="<?php echo e(url()?->current()); ?>" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="<?php echo e($content['seo']['og_title'] ?? ''); ?>">
<meta name="msapplication-TileImage" content="<?php echo e(asset($content['seo']['meta_image'] ?? '')); ?>">
<meta name="msapplication-TileColor" content="#FFFFFF">

<?php
    $frontFont = str_replace(' ', '+', $settings['appearance']['front_font_family'] ?? 'DM Sans');
?>

<!-- Font Link -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap">

<!-- bootstrap css -->
<link rel="preload" as="style" href="<?php echo e(asset('front/css/vendors/bootstrap.css')); ?>" onload="this.onload=null;this.rel='stylesheet'">



<!-- swiper css link -->
<link rel="stylesheet" href="<?php echo e(asset('front/css/vendors/swiper.css')); ?>" media="print" onload="this.media='all'">


<!-- remixicon css link -->
<link rel="stylesheet" href="<?php echo e(asset('front/css/vendors/remixicon.css')); ?>">

<!-- Select2 css-->
<link rel="stylesheet" href="<?php echo e(asset('css/vendors/select2.css')); ?>">

<!-- Toastr css -->
<link rel="stylesheet"  as="style" href="<?php echo e(asset('css/vendors/toastr.min.css')); ?>" media="print" onload="this.media='all'">

<?php if(!empty($content['analytics']['measurement_id']) && $content['analytics']['measurement_id'] != 'UA-XXXXXX-XX'): ?>
    <!-- Global site tag - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($content['analytics']['measurement_id']); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        let id = "<?php echo $content['analytics']['measurement_id']; ?>";

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', id);
    </script>
<?php endif; ?>

<!-- Conditional Facebook Pixel Script -->
<?php if(!empty($content['analytics']['pixel_id']) && $content['analytics']['pixel_id'] != 'XXXXXXXXXXXXX'): ?>
    <!-- Facebook Pixel -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', <?php echo $content['analytics']['pixel_id']; ?>);
        fbq('track', 'PageView');
    </script>
    <!-- Google tag (gtag.js) -->
<?php endif; ?>
<?php if(!empty($content['analytics']['tag_id']) && $content['analytics']['tag_id'] != 'XXXXXXXXXXXXX'): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=TAG_ID"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'TAG_ID');
    </script>
<?php endif; ?>
<?php echo app('Illuminate\Foundation\Vite')(['resources/scss/front-style.scss']); ?>
<?php echo $__env->yieldPushContent('css'); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/front/layouts/head.blade.php ENDPATH**/ ?>