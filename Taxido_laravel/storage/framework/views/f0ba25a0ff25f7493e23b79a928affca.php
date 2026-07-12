<?php $__env->startPush('css'); ?>
<!-- aos css -->
<link rel="preload" as="style" href="<?php echo e(asset('front/css/aos.css')); ?>"
    onload="this.onload=null;this.rel='stylesheet'">

<!-- wow animate css link -->
<link rel="stylesheet" href="<?php echo e(asset('front/css/vendors/wow.css')); ?>" media="print" onload="this.media='all'">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('front/css/vendors/wow-animate.css')); ?>" media="print"
    onload="this.media='all'">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('title', __('static.landing_pages.landing_page')); ?>
<?php $__env->startSection('content'); ?>
    <?php
        $classes = ['ride-box', 'user-box', 'driver-box', 'rating-box', 'ride-box'];
        $blogs = getBlogsByIds(@$content['blog']['blogs'] ?? []);
        $faqs = getFaqsByIds(@$content['faq']['faqs'] ?? []);
        $half = ceil(count($faqs) / 2);
        $testimonials = getTestimonialByIds(@$content['testimonial']['testimonials'] ?? []);
    ?>
    <?php if((int) $content['home']['status']): ?>
        <section class="home-section" id="home">
            <div class="container">
                <div class="home-contain">
                    <h1 class="wow fadeInUp" data-wow-delay="0.2s"><?php echo e(@$content['home']['title']); ?></h1>
                    <p class="wow fadeInUp " data-wow-delay="0.5s"><?php echo e(@$content['home']['description']); ?></p>
                    <div class="home-group">
                        <?php $__empty_1 = true; $__currentLoopData = $content['home']['button']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php if($button['type'] == 'gradient'): ?>
                            <a href="<?php echo e($button['url'] ?? '#'); ?>" target="_blank" class="btn gradient-bg-color wow fadeInUp" data-wow-delay="0.7s">
                                <?php echo e($button['text']); ?>

                            </a>
                            <?php else: ?>
                                <a href="<?php echo e($button['url'] ?? '#'); ?>" target="_blank" class="btn gradient-border-color wow fadeInUp" data-wow-delay="0.8s">
                                    <?php echo e($button['text']); ?>

                                </a>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="phone-image">
                    <?php if(file_exists_public(@$content['home']['right_phone_image'])): ?>
                        <div class="phone-1 wow fadeInUp" data-wow-delay="1.05s">
                            <img class="img-fluid mobile-phone" alt="home-phone" src="<?php echo e(asset(@$content['home']['right_phone_image'])); ?>" loading="lazy">
                        </div>
                    <?php endif; ?>
                    <?php if(file_exists_public(@$content['home']['left_phone_image'])): ?>
                        <div class="phone-2 wow fadeInUp" data-wow-delay="1.2s">
                            <img class="img-fluid mobile-phone" alt="home-phone" src="<?php echo e(asset(@$content['home']['left_phone_image'])); ?>" loading="lazy">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- Home Section End -->

    <!-- Experience section start -->
    <?php if($content['statistics']['status'] == 1): ?>
        <section class="experience-section overflow-hidden">
            <div class="container">
                <div class="title">
                    <h2 class="wow fadeInDown"><?php echo e(@$content['statistics']['title']); ?></h2>
                    <div class="d-inline-block">
                        <p class="wow fadeInDown" data-wow-delay="0.2s"><?php echo e(@$content['statistics']['description']); ?></p>
                    </div>
                </div>
                <div class="row experience-row g-sm-4 g-3">
                    <?php $__empty_1 = true; $__currentLoopData = $content['statistics']['counters'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $counter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-xl-3 col-sm-6 wow fadeIn" data-wow-delay="0.4s">
                            <div class="experience-box <?php echo e($classes[$index % count($classes)]); ?>">
                                <div class="experience-img">
                                    <?php if(file_exists_public(@$counter['icon'])): ?>
                                        <img src="<?php echo e(asset(@$counter['icon'])); ?>" class="img-fluid" loading="lazy"/>
                                    <?php endif; ?>
                                </div>
                                <div class="experience-content">
                                    <h4><?php echo e(@$counter['text']); ?></h4>
                                    <p><?php echo e(@$counter['description']); ?></p>
                                    <h3><span class="counter" data-target="<?php echo e(number_format(@$counter['count'], @$counter['count'] % 1 ? 1 : 0, '.', '')); ?>">0</span></h3>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- Experience section end -->

    <!-- Best choice section start -->
    <?php if($content['feature']['status'] == 1): ?>
        <section class=" best-choice-section description section-b-space overflow-hidden" id="why_cabbooking">
            <div class="container">
                <div class="title">
                    <h2 class="wow fadeInDown"><?php echo e(@$content['feature']['title']); ?></h2>
                    <div class="d-inline-block">
                        <p class="wow fadeInDown" data-wow-delay="0.2s"><?php echo e(@$content['feature']['description']); ?></p>
                    </div>
                </div>
                <div class="row g-md-4 g-3">
                    <?php $__empty_1 = true; $__currentLoopData = $content['feature']['images'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-delay="<?php echo e(0.55 + $index * 0.05); ?>s">
                            <div class="best-choice-box">
                                <?php if(file_exists_public(@$image['image'])): ?>
                                    <img class="img-fluid" alt="map-gif" src="<?php echo e(@asset($image['image'])); ?>" loading="lazy">
                                <?php endif; ?>
                                <div class="best-choice-content">
                                    <h4><?php echo e(@$image['title']); ?></h4>
                                    <p><?php echo e(@$image['description']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- Best choice section end -->

    <!-- Rides screen section start -->
    <?php if($content['ride']['status'] == 1): ?>
        <section class="ride-screen-section2 section-b-space" id="how_it_works">
            <div class="container">
                <div class="title">
                    <h2 class="text-white"><?php echo e(@$content['ride']['title']); ?></h2>
                    <div class="d-inline-block">
                        <p class="dark-layout"><?php echo e(@$content['ride']['description']); ?></p>
                    </div>
                </div>
                <div class="row justify-content-between gy-lg-0 gy-4">
                    <div class="col-xl-4 col-lg-5 mx-auto overflow-hidden position-relative">
                        <div class="mobile-screen-image">
                            <img class="img-fluid" alt="screen-mockup" src="<?php echo e(asset('front/images/screen.png')); ?>" loading="lazy">
                            <div class="swiper screen-image-slider">
                                <div class="swiper-wrapper">
                                    <?php $__empty_1 = true; $__currentLoopData = $content['ride']['step']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="swiper-slide">
                                            <?php if(file_exists_public($step['image'])): ?>
                                                <img class="img-fluid" alt="screen-img" src="<?php echo e(asset($step['image'])); ?>" loading="lazy">
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="screen-content-list">
                            <div class="swiper screen-content-slider">
                                <div class="swiper-wrapper">
                                    <?php $__empty_1 = true; $__currentLoopData = $content['ride']['step']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="swiper-slide">
                                            <div>
                                                <div class="screen-content-box">
                                                    <h4><?php echo e(str_pad($index + 1, 2, '0', STR_PAD_LEFT)); ?></h4>
                                                    <h3><?php echo e($step['title']); ?></h3>
                                                    <p><?php echo e($step['description']); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- Rides screen section end -->

    <!-- FAQ section start -->
    <?php if($content['faq']['status'] == 1): ?>
        <section class="faq-section"  id="faqs">
            <div class="container">
                <div class="title">
                    <h2 class="wow fadeInDown"><?php echo e($content['faq']['title']); ?></h2>
                    <div class="d-inline-block">
                        <p class="wow fadeInDown" data-wow-delay="0.2s"><?php echo e($content['faq']['sub_title']); ?></p>
                    </div>
                </div>
                <div class="row gy-lg-0 gy-3">
                    <div class="col-lg-6">
                        <div class="accordion faq-accordion">
                            <?php $__empty_1 = true; $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php if($index < $half): ?>
                                    <div class="accordion-item wow fadeInUp" data-wow-delay="<?php echo e(0.45 + $index * 0.05); ?>s">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button <?php echo e($index === 0 ? '' : 'collapsed'); ?>"
                                                data-bs-toggle="collapse" data-bs-target="#faq<?php echo e($index + 1); ?>">
                                                <?php echo e($faq['title']); ?>

                                            </button>
                                        </h2>
                                        <div id="faq<?php echo e($index + 1); ?>"
                                            class="accordion-collapse collapse <?php echo e($index === 0 ? 'show' : ''); ?>">
                                            <div class="accordion-body">
                                                <p><?php echo e($faq['description']); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="accordion faq-accordion">
                            <?php $__empty_1 = true; $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php if($index >= $half): ?>
                                    <div class="accordion-item wow fadeInUp"
                                        data-wow-delay="<?php echo e(0.45 + $index * 0.05); ?>s">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button  <?php echo e($index == $half ? '' : 'collapsed'); ?>"
                                                data-bs-toggle="collapse" data-bs-target="#faq<?php echo e($index + 1); ?>">
                                                <?php echo e($faq['title']); ?>

                                            </button>
                                        </h2>
                                        <div id="faq<?php echo e($index + 1); ?>"
                                            class="accordion-collapse collapse <?php echo e($index == $half ? 'show' : ''); ?>">
                                            <div class="accordion-body">
                                                <p><?php echo e($faq['description']); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="no-data-found">
                                    <img class="img-fluid" src="<?php echo e(asset('front/images/faq_not_found.svg')); ?>" loading="lazy">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- FAQ section end -->

    <!-- Blog section start -->
    <?php if($content['blog']['status'] == 1): ?>
        <section class="blog-section section-b-space" id="blogs">
            <div class="container">
                <div class="title">
                    <h2 class="wow fadeInDown"><?php echo e($content['blog']['title']); ?></h2>
                    <div class="d-inline-block">
                        <p class="wow fadeInDown" data-wow-delay="0.2s"><?php echo e($content['blog']['sub_title']); ?></p>
                        <a href="<?php echo e(route('web.blog.index')); ?>"><?php echo e(__('static.landing_pages.view_all')); ?> <i class="ri-arrow-right-s-line"></i></a>
                    </div>
                </div>

                <div class="swiper blog-swiper pagination-box">
                    <div class="swiper-wrapper">

                        <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="swiper-slide wow fadeInUp" data-wow-delay="0.35s">
                                <div class="blog-box">
                                    <div class="blog-image">

                                        <a href="<?php echo e(route('blog.slug', @$blog['slug'])); ?>"><img class="img-fluid"
                                                src="<?php echo e(asset($blog['blog_thumbnail']['original_url'] ?? '')); ?>"
                                                alt="<?php echo e(@$blog['slug']); ?>" loading="lazy"></a>
                                    </div>
                                    <div class="blog-content">
                                        <a href="<?php echo e(route('blog.slug', @$blog['slug'])); ?>">
                                            <h5><?php echo e($blog['title'] ?? ''); ?> </h5>
                                        </a>
                                        <p><?php echo e($blog['description'] ?? ''); ?></p>
                                        <div class="blog-bottom">
                                            <h6><i class="ri-calendar-line"></i>
                                                <?php echo e($blog['created_at'] ? \Carbon\Carbon::parse($blog['created_at'])->format('d M, Y') : ''); ?>

                                            </h6>
                                            <a href="<?php echo e(route('blog.slug', @$blog['slug'])); ?>"><?php echo e(__('static.landing_pages.know_more')); ?> <i
                                                    class="ri-arrow-right-s-line"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="no-data-found">
                                <img class="img-fluid" src="<?php echo e(asset('front/images/blog_not_found.svg')); ?>" loading="lazy">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="swiper-pagination wow fadeInUp" data-wow-delay="0.65s"></div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Blog section end -->

    <!-- Comment section start -->
    <?php if($content['testimonial']['status'] == 1): ?>
        <section class="comment-section section-b-space wow fadeIn" id="testimonials">
            <div class="container">
                <div class="title">
                    <h2 class="wow fadeInDown" data-wow-delay="0.2s"><?php echo e(@$content['testimonial']['title']); ?></h2>
                    <div class="d-inline-block">
                        <p class="wow fadeInDown" data-wow-delay="0.4s"><?php echo e(@$content['testimonial']['sub_title']); ?></p>
                    </div>
                </div>

                <div class="swiper comment-slider pagination-box">
                    <div class="swiper-wrapper wow fadeInUp" data-wow-delay="0.5s">
                        <?php $__empty_1 = true; $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="swiper-slide">
                                <div class="comment-box">
                                    <div class="top-comment">
                                        <img class="img-fluid" alt="<?php echo e($testimonial?->title); ?>"
                                            src="<?php echo e(asset($testimonial?->profile_image?->asset_url ?? '')); ?>" loading="lazy">

                                        <h5><?php echo e($testimonial?->title); ?></h5>
                                    </div>
                                    <p class="comment-contain"><?php echo e($testimonial?->description); ?></p>
                                    <div class="rating-box">
                                        <h6>
                                            <svg>
                                                <use xlink:href="<?php echo e(asset('front/images/star.svg#star')); ?>">
                                            </svg>
                                            (<?php echo e(number_format($testimonial?->rating, 1)); ?>)
                                        </h6>

                                        <svg class="quotes-icon">
                                            <use xlink:href="<?php echo e(asset('front/images/quotes-right.svg#quotes-right')); ?>">
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="no-data-found">
                                <img class="img-fluid" src="<?php echo e(asset('front/images/testimonial_not_found.svg')); ?>" loading="lazy">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<!-- WOW JS -->
<script src="<?php echo e(asset('front/js/wow.js')); ?>"></script>
<script>
    $(document).ready(function() {
        new WOW().init();

        $(window).on('load', function() {
            setTimeout(function() {
                $('#fullScreenLoader').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 3500);
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('front.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/front/home/index.blade.php ENDPATH**/ ?>