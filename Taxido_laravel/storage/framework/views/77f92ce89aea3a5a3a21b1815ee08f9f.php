<?php use \App\Models\Page; ?>
<?php use \App\Models\LandingPage; ?>
<?php
    $locale = Session::get('front-locale', getDefaultLangLocale());
    $landingPage = LandingPage::first()?->toArray($locale) ?? [];
    $content = $landingPage['content'] ?? [];
?>
<?php if(@$content['footer']['status'] == 1): ?>
    <footer class="footer-section">
        <div class="top-footer">
            <div class="container">
                <div class="row justify-content-between gy-sm-0 gy-4">
                    <div class="col-lg-4 col-md-8 col-sm-7">
                        <div class="logo-box">
                            <a href="#!" class="footer-logo wow fadeInUp">
                                <?php if(file_exists_public(@$content['footer']['footer_logo'])): ?>
                                <img class="img-fluid" alt="footer-logo" src="<?php echo e(asset(@$content['footer']['footer_logo'])); ?>">
                                <?php endif; ?>
                            </a>
                            <p class="wow fadeInUp" data-wow-delay="0.2s"><?php echo e($content['footer']['description']); ?></p>
                        </div>

                        <div class="footer-form wow fadeInUp" data-wow-delay="0.3s">
                            <form method="POST" action="<?php echo e(route('newsletter')); ?>">
                                <?php echo csrf_field(); ?>
                                <label for="email"
                                    class="form-label"><?php echo e($content['footer']['newsletter']['label']); ?></label>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="<?php echo e($content['footer']['newsletter']['placeholder']); ?>" required>
                                    <button type="submit" class="btn gradient-bg-color">
                                        <?php echo e($content['footer']['newsletter']['button_text']); ?>

                                    </button>
                                </div>
                            </form>
                        </div>

                        <ul class="store-list">
                            <li class="wow fadeInUp" data-wow-delay="0.5s">
                                <a href="<?php echo e($content['footer']['play_store_url']); ?>" target="_blank">
                                    <img class="img-fluid" alt="store-1" src="<?php echo e(asset('front/images/store/1.svg')); ?>">
                                </a>
                            </li>
                            <li class="wow fadeInUp" data-wow-delay="0.6s">
                                <a href="<?php echo e($content['footer']['app_store_url']); ?>" target="_blank">
                                    <img class="img-fluid" alt="store-2" src="<?php echo e(asset('front/images/store/2.svg')); ?>">
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-3 col-sm-4">
                        <?php if(isset($content['footer']['pages'])): ?>
                            <?php
                                $pages = Page::whereIn('id', $content['footer']['pages'] )?->paginate(5);
                            ?>
                            <div class="footer-content wow fadeInUp" data-wow-delay="0.8s">
                                <div class="footer-title">
                                    <h4>Pages</h4>
                                </div>
                                <ul class="content-list">
                                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('page.slug', $page->slug)); ?>"><?php echo e($page->title); ?></a>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-lg-5 position-relative d-none d-lg-block">
                        <div class="footer-image">
                            <?php if(file_exists_public(@$content['footer']['right_image'])): ?>
                            <img class="img-fluid wow fadeInUp" alt="footer-phone"
                                src="<?php echo e(asset(@$content['footer']['right_image'])); ?>" data-wow-delay="0.98s">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sub-footer">
            <div class="container">
                <div class="row gy-md-0 gy-3">
                    <div class="col-md-6">
                        <h6><?php echo e($content['footer']['copyright'] ?? '© Your Company'); ?> <?php echo e(date('Y')); ?></h6>
                    </div>
                    <div class="col-md-6">
                        <ul class="social-list">
                            <?php if(!empty($content['footer']['social']['facebook'])): ?>
                                <li>
                                    <a href="<?php echo e($content['footer']['social']['facebook']); ?>" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
                                        <i class="ri-facebook-line"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(!empty($content['footer']['social']['google'])): ?>
                                <li>
                                    <a href="<?php echo e($content['footer']['social']['google']); ?>" aria-label="Google" target="_blank" rel="noopener noreferrer">
                                        <i class="ri-google-line"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(!empty($content['footer']['social']['instagram'])): ?>
                                <li>
                                    <a href="<?php echo e($content['footer']['social']['instagram']); ?>" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
                                        <i class="ri-instagram-line"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(!empty($content['footer']['social']['twitter'])): ?>
                                <li>
                                    <a href="<?php echo e($content['footer']['social']['twitter']); ?>" aria-label="Twitter" target="_blank" rel="noopener noreferrer">
                                        <i class="ri-twitter-x-line"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(!empty($content['footer']['social']['whatsapp'])): ?>
                                <li>
                                    <a href="<?php echo e($content['footer']['social']['whatsapp']); ?>" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer">
                                        <i class="ri-whatsapp-line"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(!empty($content['footer']['social']['linkedin'])): ?>
                                <li>
                                    <a href="<?php echo e($content['footer']['social']['linkedin']); ?>" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">
                                        <i class="ri-linkedin-line"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<?php endif; ?>
<!-- Footer end -->
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/front/layouts/footer.blade.php ENDPATH**/ ?>