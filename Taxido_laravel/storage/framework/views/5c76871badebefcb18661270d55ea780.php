<!-- Header section start -->
<?php use \App\Models\Language; ?>
<?php use \App\Models\LandingPage; ?>
<?php
    $locale = Session::get('front-locale', getDefaultLangLocale());
    $landingPage = LandingPage::first()?->toArray($locale) ?? [];
    $content = $landingPage['content'] ?? [];
    $flag = Language::where('locale', Session::get('front-locale', getDefaultLangLocale()))->pluck('flag')->first();
    $menuLabel = [
        'home' => __('menu.home'),
        'why_cabbooking' => __('menu.why_cabbooking'),
        'how_it_works' => __('menu.how_it_works'),
        'faqs' => __('menu.faq'),
        'blogs' => __('menu.blog'),
        'testimonials' => __('menu.testimonial'),
        'raise_ticket' => __('menu.raise_ticket'),
    ];
?>
<?php if(@$content['header']['status'] == 1): ?>
    <header class="wow fadeIn">
        <div class="container">
            <div class="top-header">
                <div class="header-left">
                    <button class="navbar-toggler btn">
                        <i class="ri-menu-line"></i>
                    </button>
                    <a href="<?php echo e(route('home')); ?>" class="logo-box">
                        <?php if(file_exists_public(@$content['header']['logo'])): ?>
                            <img class="img-fluid" alt="Logo" src="<?php echo e(asset(@$content['header']['logo'])); ?>"
                                loading="lazy">
                        <?php endif; ?>
                    </a>
                </div>
                <div class="header-middle">
                    <div class="menu-title">
                        <h3>Menu</h3>
                        <a href="#!" class="close-menu"><i class="ri-close-line"></i></a>
                    </div>
                    <ul class="navbar-nav">
                            <?php $__empty_1 = true; $__currentLoopData = $content['header']['menus'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="nav-item">
                                 <?php if($menu === 'raise_ticket'): ?>
                                    <a class="nav-link" href="<?php echo e(route('ticket.form')); ?>"><?php echo e($menuLabel[$menu] ?? 'N/A'); ?></a>
                                 <?php else: ?>
                                    <?php if(Route::is('home')): ?>
                                        <a class="nav-link" href="#<?php echo e($menu); ?>"><?php echo e($menuLabel[$menu] ?? 'N/A'); ?></a>
                                    <?php else: ?>
                                        <a class="nav-link" href="<?php echo e(route('home')); ?>#<?php echo e($menu); ?>"><?php echo e($menuLabel[$menu] ?? 'N/A'); ?></a>
                                    <?php endif; ?>
                                 <?php endif; ?>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <?php endif; ?>
                        </ul>
                </div>
                <div class="header-right">
                    <div class="dropdown language-dropdown">
                        <?php
                            $currentLocale = Session::get('locale', app()->getLocale());
                            $currentLang = getLanguageByLocale($currentLocale);
                        ?>

                        <button class="btn language-btn" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-fluid" loading="lazy" alt="flag-image"
                                src="<?php echo e($currentLang?->flag ?? asset('images/flags/default.png')); ?>">
                            <span><?php echo e(strtoupper($currentLang?->locale ?? 'EN')); ?></span>
                        </button>

                        <ul class="dropdown-menu">
                            <?php $__empty_1 = true; $__currentLoopData = getLanguages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li>
                                    <a class="dropdown-item <?php if($lang->locale === $currentLocale): ?> active <?php endif; ?>"
                                        href="<?php echo e(route('lang', $lang->locale)); ?>" data-lng="<?php echo e($lang->locale); ?>">
                                        <img class="img-fluid" loading="lazy" alt="flag-image"
                                            src="<?php echo e($lang->flag ?? asset('images/flags/default.png')); ?>">
                                        <span>(<?php echo e(strtoupper($lang->locale)); ?>)</span>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('lang', 'en')); ?>" data-lng="en">
                                        <img class="img-fluid" src="<?php echo e(asset('images/flags/US.png')); ?>" loading="lazy">
                                        <span><?php echo e(__('static.english')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <button class="btn dark-light-mode" id="dark-mode" aria-label="Toggle dark mode"
                        aria-pressed="false">
                        <i class="ri-moon-line light-mode"></i>
                        <i class="ri-sun-line dark-mode"></i>
                    </button>
                    <a href="<?php echo e(auth()->check() ? route('front.cab.ride.create') : route('front.cab.login.index')); ?>"
                        class="btn gradient-bg-color ticket-btn">
                        <i class="ri-coupon-2-line d-sm-none"></i>
                        <span class="d-sm-block d-none"><?php echo e(@$content['header']['btn_text']); ?></span>
                    </a>
                </div>
            </div>
            <a href="#!" class="overlay" aria-label="Read more about this article"></a>
    </header>
<?php endif; ?>
<!-- Header section end -->
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/front/layouts/header.blade.php ENDPATH**/ ?>