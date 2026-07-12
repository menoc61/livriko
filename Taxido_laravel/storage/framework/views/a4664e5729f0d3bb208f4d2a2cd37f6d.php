<?php $__env->startSection('title', __('static.landing_pages.landing_page')); ?>
<?php use \App\Models\Blog; ?>
<?php use \App\Models\Page; ?>
<?php use \App\Models\Faq; ?>
<?php use \App\Models\Testimonial; ?>
<?php
    $blogs = Blog::where('status', true)->get(['id', 'title']);
    $pages = Page::where('status', true)->get(['id', 'title']);
    $faqs = Faq::get(['id', 'title', 'description']);
    $testimonials = Testimonial::get();
?>
<?php $__env->startSection('content'); ?>
    <div class="contentbox">
        <div class="inside">
            <div class="contentbox-title">
                <div class="contentbox-subtitle">
                    <h3><?php echo e(__('static.landing_pages.landing_page_title')); ?></h3>
                </div>
            </div>
            <div class="contentbox-body">
                <div class="vertical-tabs">
                    <div class="row g-xl-5 g-4">
                        <div class="col-xl-3 col-12">
                            <div class="nav flex-column nav-pills" id="v-pills-tab">
                                <a class="nav-link active" id="v-pills-tabContent" data-bs-toggle="pill"
                                    href="#Header_Section">
                                    <i class="ri-layout-top-2-line"></i><?php echo e(__('static.landing_pages.header')); ?>

                                </a>

                                <a class="nav-link" id="v-pills-home-tab" data-bs-toggle="pill" href="#Home_Section">
                                    <i class="ri-home-line"></i><?php echo e(__('static.landing_pages.home')); ?>

                                </a>

                                <a class="nav-link" id="v-pills-statistic-tab" data-bs-toggle="pill"
                                    href="#Statistics_Section">
                                    <i class="ri-line-chart-fill"></i><?php echo e(__('static.landing_pages.statistics')); ?>

                                </a>

                                <a class="nav-link" id="v-pills-feature-tab" data-bs-toggle="pill" href="#Feature_Section">
                                    <i class="ri-file-line"></i><?php echo e(__('static.landing_pages.feature')); ?>

                                </a>

                                <a class="nav-link" id="v-pills-ride-tab" data-bs-toggle="pill" href="#Ride_Section">
                                    <i class="ri-car-line"></i><?php echo e(__('static.landing_pages.ride')); ?>

                                </a>

                                <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" href="#Blog_Section">
                                    <i class="ri-blogger-line"></i><?php echo e(__('static.landing_pages.blog')); ?>

                                </a>
                                <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    href="#Testimonials_Section">
                                    <i class="ri-edit-box-line"></i><?php echo e(__('static.landing_pages.testimonial')); ?>

                                </a>
                                <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" href="#FAQ_Section">
                                    <i class="ri-question-answer-line"></i><?php echo e(__('static.landing_pages.faqs')); ?>

                                </a>
                                <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" href="#Footer_Section">
                                    <i class="ri-layout-bottom-2-line"></i><?php echo e(__('static.landing_pages.footer')); ?>

                                </a>
                                <a class="nav-link" id="v-pills-seo-tab" data-bs-toggle="pill" href="#SEO_Section">
                                    <i class="ri-seo-line"></i><?php echo e(__('static.landing_pages.seo')); ?>

                                </a>

                                <a class="nav-link" id="v-pills-analytics-tab" data-bs-toggle="pill"
                                    href="#Analytics_Section">
                                    <i class="ri-line-chart-line"></i><?php echo e(__('static.landing_pages.analytics')); ?>

                                </a>
                            </div>
                        </div>
                        <div class="col-xl-9 col-12 tab-b-left">
                            <form method="POST" class="needs-validation user-add" id="landing_pagesForm"
                                action="<?php echo e(isset($id) ? route('admin.landing-page.update', $id) : route('admin.landing-page.store')); ?>"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php if(isset($id)): ?>
                                    <?php echo method_field('PUT'); ?>
                                <?php else: ?>
                                    <?php echo method_field('POST'); ?>
                                <?php endif; ?>
                                <div class="tab-content w-100 choose-img" id="v-pills-tabContent">
                                    <div class="tab-pane active" id="Header_Section">
                                        <div class="form-group row">
                                            <label class="col-md-2" for="logo">
                                                <?php echo e(__('static.landing_pages.logo')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('static.landing_pages.logo_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="form-group d-flex gap-3 align-items-start media-relative">
                                                    <div class="media-upload-image">
                                                        <input type="file" class="form-control fileInput"
                                                            name="header[logo]" data-preview-id="headerLogoPreview">
                                                        <i class="ri-add-line"></i>
                                                    </div>
                                                    <?php $__errorArgs = ['header[logo]'];
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


                                                    <?php if(isset($content['header']['logo']) && !empty($content['header']['logo'])): ?>
                                                        <img src="<?php echo e(asset(@$content['header']['logo'])); ?>" id="headerLogoPreview" alt="Current Logo" class="media-img" id="imagePreview">
                                                    <?php else: ?>
                                                        <img src="" alt="Image Preview" class="media-img" id="headerLogoPreview" style="display: none;">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="btn_link"><?php echo e(__('static.landing_pages.menus')); ?></label>
                                            <div class="col-md-10">
                                                <select class="form-control select-2" id="sections"
                                                    name="header[menus][]"
                                                    data-placeholder="<?php echo e(__('static.landing_pages.select_menu')); ?>"
                                                    multiple>
                                                    <option class="select-placeholder" value=""></option>
                                                    <option value="home"
                                                        <?php if(in_array('home', @$content['header']['menus'] ?? [])): ?> selected <?php endif; ?>>
                                                        <?php echo e(__('menu.home')); ?>

                                                    </option>
                                                    <option value="why_cabbooking"
                                                        <?php if(in_array('why_cabbooking', @$content['header']['menus'] ?? [])): ?> selected <?php endif; ?>>
                                                        <?php echo e(__('menu.why_cabbooking')); ?>

                                                    </option>
                                                    <option value="how_it_works"
                                                        <?php if(in_array('how_it_works', @$content['header']['menus'] ?? [])): ?> selected <?php endif; ?>>
                                                        <?php echo e(__('menu.how_it_works')); ?>

                                                    </option>
                                                    <option value="faqs"
                                                        <?php if(in_array('faqs', @$content['header']['menus'] ?? [])): ?> selected <?php endif; ?>>
                                                        <?php echo e(__('menu.faq')); ?>

                                                    </option>
                                                    <option value="blogs"
                                                        <?php if(in_array('blogs', @$content['header']['menus'] ?? [])): ?> selected <?php endif; ?>>
                                                        <?php echo e(__('menu.blog')); ?>

                                                    </option>
                                                    <option value="testimonials"
                                                        <?php if(in_array('testimonials', @$content['header']['menus'] ?? [])): ?> selected <?php endif; ?>>
                                                        <?php echo e(__('menu.testimonial')); ?>

                                                    </option>
                                                    <option value="raise_ticket"
                                                        <?php if(in_array('raise_ticket', @$content['header']['menus'] ?? [])): ?> selected <?php endif; ?>>
                                                        <?php echo e(__('menu.raise_ticket')); ?>

                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="btn_text"><?php echo e(__('static.landing_pages.btn_text')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="header[btn_text]"
                                                    id=""
                                                    value="<?php echo e(@$content['header']['btn_text'] ?? old('btn_text')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_btn_text')); ?>">
                                                <?php $__errorArgs = ['header[btn_text]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2" for="menu[status]"><?php echo e(__('static.settings.status')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('static.landing_pages.note')); ?>"></i>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($content['header']['status'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="header[status]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="header[status]" value="1"
                                                                <?php echo e(@$content['header']['status'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="header[status]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="header[status]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="Home_Section">

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="btn_image"><?php echo e(__('static.landing_pages.left_phone_image')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('static.landing_pages.left_phone_image_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="form-group d-flex gap-3 align-items-start media-relative">
                                                    <div class="media-upload-image">
                                                        <input type="file" class="form-control fileInput" name="home[left_phone_image]" data-preview-id="leftPhonePreview">
                                                        <i class="ri-add-line"></i>
                                                    </div>
                                                    <?php $__errorArgs = ['home[left_phone_image]'];
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
                                                    <?php if(isset($content['home']['left_phone_image']) && !empty($content['home']['left_phone_image'])): ?>
                                                        <img src="<?php echo e(asset($content['home']['left_phone_image'])); ?>" id="leftPhonePreview" alt="image" class="media-img">
                                                    <?php else: ?>
                                                        <img src="" alt="Image Preview" class="media-img" id="leftPhonePreview"  style="display: none;">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="btn_image"><?php echo e(__('static.landing_pages.right_phone_image')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('static.landing_pages.right_phone_image_span')); ?>"></i>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="form-group d-flex gap-3 align-items-start media-relative">
                                                    <div class="media-upload-image">
                                                        <input type="file" class="form-control fileInput" name="home[right_phone_image]"  data-preview-id="rightPhonePreview">
                                                        <i class="ri-add-line"></i>
                                                    </div>
                                                    <?php $__errorArgs = ['home[right_phone_image]'];
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
                                                    <?php if(isset($content['home']['right_phone_image']) && !empty($content['home']['right_phone_image'])): ?>
                                                        <img src="<?php echo e(asset($content['home']['right_phone_image'])); ?>" alt="image" class="media-img" id="rightPhonePreview">
                                                    <?php else: ?>
                                                        <img src="" alt="Image Preview" class="media-img" id="rightPhonePreview"  style="display: none;">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="title"><?php echo e(__('static.landing_pages.title')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="home[title]"
                                                    id=""
                                                    value="<?php echo e(@$content['home']['title'] ?? old('title')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_title')); ?>">
                                                <?php $__errorArgs = ['home[title]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="description"><?php echo e(__('static.landing_pages.short_description')); ?></label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" id="home[description]" name="home[description]"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_description')); ?>" cols="30" rows="5"><?php echo e(old('description', @$content['home']['description'] ?? '')); ?></textarea>
                                            </div>
                                            <?php $__errorArgs = ['home[description]'];
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

                                        <div class="form-group row">
                                            <label class="col-md-2" for="home[status]"><?php echo e(__('static.settings.status')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                        data-bs-title="<?php echo e(__('static.landing_pages.home_note')); ?>"></i>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($content['home']['status'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="home[status]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="home[status]" value="1"
                                                                <?php echo e(@$content['home']['status'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="home[status]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="home[status]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="home-btn-container">
                                            <?php $__empty_1 = true; $__currentLoopData = $content['home']['button'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <div class="btn-group-row">
                                                    <div class="form-group row">
                                                        <label class="col-md-2"
                                                            for="btn_text"><?php echo e(__('static.landing_pages.btn_text')); ?></label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="text"
                                                                name="home[button][<?php echo e($index); ?>][text]"
                                                                value="<?php echo e(old("home.button.$index.text", $button['text'] ?? '')); ?>"
                                                                placeholder="<?php echo e(__('static.landing_pages.enter_btn_text')); ?>">
                                                            <?php $__errorArgs = ["home.button.$index.text"];
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
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-2"
                                                            for="btn_type"><?php echo e(__('static.landing_pages.btn_type')); ?></label>
                                                        <div class="col-md-10">
                                                            <select class="form-control select"
                                                                name="home[button][<?php echo e($index); ?>][type]"
                                                                data-placeholder="<?php echo e(__('static.landing_pages.btn_type')); ?>">
                                                                <option class="select-placeholder" value="" selected disabled>Select type
                                                                </option>
                                                                <option value="outline"
                                                                    <?php echo e(old("home.button.$index.type", $button['type'] ?? '') == 'outline' ? 'selected' : ''); ?>>
                                                                    <?php echo e(__('static.landing_pages.outline')); ?>

                                                                </option>
                                                                <option value="gradient"
                                                                    <?php echo e(old("home.button.$index.type", $button['type'] ?? '') == 'gradient' ? 'selected' : ''); ?>>
                                                                    <?php echo e(__('static.landing_pages.gradient')); ?>

                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-2"
                                                            for="btn_text"><?php echo e(__('static.landing_pages.btn_url')); ?></label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="text"
                                                                name="home[button][<?php echo e($index); ?>][url]"
                                                                value="<?php echo e(old("home.button.$index.url", $button['url'] ?? '')); ?>"
                                                                placeholder="<?php echo e(__('static.landing_pages.enter_btn_url')); ?>">
                                                            <?php $__errorArgs = ["home.button.$index.url"];
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
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="btn-remove">
                                                            <button type="button" class="btn btn-danger">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                
                                                <div class="btn-group-row">
                                                    <div class="form-group row">
                                                        <label class="col-md-2"
                                                            for="btn_text"><?php echo e(__('static.landing_pages.btn_text')); ?></label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="text"
                                                                name="home[button][0][text]"
                                                                placeholder="<?php echo e(__('static.landing_pages.enter_btn_text')); ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-2"
                                                            for="btn_type"><?php echo e(__('static.landing_pages.btn_type')); ?></label>
                                                        <div class="col-md-10">
                                                            <select class="form-control select"
                                                                name="home[button][0][type]"
                                                                data-placeholder="<?php echo e(__('static.landing_pages.btn_type')); ?>">
                                                                <option class="select-placeholder" value="">
                                                                </option>
                                                                <option value="outline">
                                                                    <?php echo e(__('static.landing_pages.outline')); ?>

                                                                </option>
                                                                <option value="gradient">
                                                                    <?php echo e(__('static.landing_pages.gradient')); ?></option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="btn-remove">
                                                            <button type="button" class="btn btn-danger"
                                                                style="display:none;">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" id="home-add-btn"
                                                class="btn btn-primary"><?php echo e(__('static.landing_pages.add_new')); ?></button>
                                        </div>

                                    </div>

                                    <div class="tab-pane" id="Statistics_Section">
                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="title"><?php echo e(__('static.landing_pages.title')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="statistics[title]"
                                                    id=""
                                                    value="<?php echo e(@$content['statistics']['title'] ?? old('title')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_title')); ?>">
                                                <?php $__errorArgs = ['statistics[title]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="description"><?php echo e(__('static.landing_pages.short_description')); ?></label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" id="statistics[description]" name="statistics[description]"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_description')); ?>" cols="30" rows="5"><?php echo e(old('description', @$content['statistics']['description'] ?? '')); ?></textarea>
                                            </div>
                                            <?php $__errorArgs = ['statistics[description]'];
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

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="statistics[status]"><?php echo e(__('static.settings.status')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                        data-bs-title="<?php echo e(__('static.landing_pages.statistics_note')); ?>"></i>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($content['statistics']['status'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="statistics[status]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="statistics[status]" value="1"
                                                                <?php echo e(@$content['statistics']['status'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="statistics[status]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="statistics[status]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="statistics-btn-container">
                                            <?php $__currentLoopData = $content['statistics']['counters'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $counter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="btn-group-row">
                                                    <div class="form-group row">
                                                        <label class="col-md-2"
                                                            for="title"><?php echo e(__('static.landing_pages.title')); ?></label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="text"
                                                                name="statistics[counters][<?php echo e($index); ?>][text]"
                                                                value="<?php echo e(old("statistics.counters.$index.text", $counter['text'] ?? '')); ?>"
                                                                placeholder="<?php echo e(__('static.landing_pages.enter_title')); ?>">
                                                            <?php $__errorArgs = ["statistics.counters.$index.text"];
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
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-2"
                                                            for="description"><?php echo e(__('static.landing_pages.short_description')); ?></label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" name="statistics[counters][<?php echo e($index); ?>][description]"
                                                                placeholder="<?php echo e(__('static.landing_pages.enter_description')); ?>" cols="30" rows="5"><?php echo e(old("statistics.counters.$index.description", $counter['description'] ?? '')); ?></textarea>
                                                            <?php $__errorArgs = ["statistics.counters.$index.description"];
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
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-2"
                                                            for="count"><?php echo e(__('static.landing_pages.count')); ?></label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="text"
                                                                name="statistics[counters][<?php echo e($index); ?>][count]"
                                                                value="<?php echo e(old("statistics.counters.$index.count", $counter['count'] ?? '')); ?>"
                                                                placeholder="<?php echo e(__('static.landing_pages.enter_count')); ?>">
                                                            <?php $__errorArgs = ["statistics.counters.$index.count"];
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
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-2"
                                                            for="btn_image"><?php echo e(__('static.landing_pages.icon')); ?>

                                                            <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="<?php echo e(__('static.landing_pages.icon_note')); ?>"></i>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <div
                                                                class="form-group d-flex gap-3 align-items-start media-relative">
                                                                <div class="media-upload-image">
                                                                    <input type="file" class="form-control fileInput"
                                                                        name="statistics[counters][<?php echo e($index); ?>][icon]" data-preview-id="statIconPreview-<?php echo e($index); ?>">
                                                                    <i class="ri-add-line"></i>
                                                                </div>

                                                                <?php if(!empty($counter['icon'])): ?>
                                                                    <img src="<?php echo e(asset($counter['icon'])); ?>" alt="Uploaded Icon" width="50" class="media-img uploaded-icon-preview" id="statIconPreview-<?php echo e($index); ?>">
                                                                <?php else: ?>
                                                                    <img src="" alt="Image Preview" class="media-img" id="statIconPreview-<?php echo e($index); ?>" style="display: none;">
                                                                <?php endif; ?>
                                                                <?php $__errorArgs = ["statistics.counters.$index.icon"];
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
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="btn-remove">
                                                            <button type="button"
                                                                class="btn btn-danger"><?php echo e(__('static.landing_pages.remove')); ?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" id="statistics-add-btn"
                                                class="btn btn-primary"><?php echo e(__('static.landing_pages.add_new')); ?></button>
                                        </div>

                                    </div>

                                    <div class="tab-pane" id="Feature_Section">


                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="title"><?php echo e(__('static.landing_pages.title')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="feature[title]"
                                                    id=""
                                                    value="<?php echo e(@$content['feature']['title'] ?? old('title')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_title')); ?>">
                                                <?php $__errorArgs = ['feature[title]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="description"><?php echo e(__('static.landing_pages.short_description')); ?></label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" id="feature[description]" name="feature[description]"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_description')); ?>" cols="30" rows="5"><?php echo e(old('description', @$content['feature']['description'] ?? '')); ?></textarea>
                                            </div>
                                            <?php $__errorArgs = ['feature[description]'];
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

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="feature[status]"><?php echo e(__('static.settings.status')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                        data-bs-title="<?php echo e(__('static.landing_pages.feature_note')); ?>"></i>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($content['feature']['status'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="feature[status]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="feature[status]" value="1"
                                                                <?php echo e(@$content['feature']['status'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="feature[status]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="feature[status]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="feature-btn-container">
                                            <?php $__currentLoopData = $content['feature']['images'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="btn-group-row">
                                                    <div class="form-group row">
                                                        <label class="col-md-2"
                                                            for="title"><?php echo e(__('static.landing_pages.title')); ?></label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="text"
                                                                name="feature[images][<?php echo e($index); ?>][title]"
                                                                value="<?php echo e(old("feature.images.$index.title", $image['title'] ?? '')); ?>"
                                                                placeholder="<?php echo e(__('static.landing_pages.enter_title')); ?>">
                                                            <?php $__errorArgs = ["feature.images.$index.title"];
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
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-2"
                                                            for="description"><?php echo e(__('static.landing_pages.short_description')); ?></label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" name="feature[images][<?php echo e($index); ?>][description]"
                                                                placeholder="<?php echo e(__('static.landing_pages.enter_description')); ?>" cols="30" rows="5"><?php echo e(old("feature.images.$index.description", $image['description'] ?? '')); ?></textarea>
                                                            <?php $__errorArgs = ["feature.images.$index.description"];
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
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-2"
                                                            for="btn_image"><?php echo e(__('static.landing_pages.image')); ?>

                                                            <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="<?php echo e(__('static.landing_pages.feature_image_note')); ?>"></i>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <div
                                                                class="form-group d-flex gap-3 align-items-start media-relative">
                                                                <div class="media-upload-image">
                                                                    <input type="file" class="form-control fileInput"
                                                                        name="feature[images][<?php echo e($index); ?>][image]" data-preview-id="featureIconPreview-<?php echo e($index); ?>">
                                                                    <i class="ri-add-line"></i>
                                                                </div>

                                                                <?php if(!empty($image['image'])): ?>
                                                                    <img src="<?php echo e(asset($image['image'])); ?>"
                                                                        alt="Uploaded Image" width="50"
                                                                        class="media-img uploaded-icon-preview" id="featureIconPreview-<?php echo e($index); ?>">
                                                                <?php else: ?>
                                                                    <img src="" alt="Image Preview" class="media-img" id="featureIconPreview-<?php echo e($index); ?>" style="display: none;">
                                                                <?php endif; ?>
                                                                <?php $__errorArgs = ["feature.images.$index.image"];
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
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="btn-remove">
                                                            <button type="button"
                                                                class="btn btn-danger"><?php echo e(__('static.landing_pages.remove')); ?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" id="feature-add-btn"
                                                class="btn btn-primary"><?php echo e(__('static.landing_pages.add_new')); ?>

                                            </button>
                                        </div>

                                    </div>

                                    <div class="tab-pane" id="Ride_Section">
                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="title"><?php echo e(__('static.landing_pages.title')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="ride[title]"
                                                    id=""
                                                    value="<?php echo e(@$content['ride']['title'] ?? old('title')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_title')); ?>">
                                                <?php $__errorArgs = ['ride[title]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="description"><?php echo e(__('static.landing_pages.short_description')); ?></label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" id="ride[description]" name="ride[description]"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_description')); ?>" cols="30" rows="5"><?php echo e(old('description', @$content['ride']['description'] ?? '')); ?></textarea>
                                            </div>
                                            <?php $__errorArgs = ['ride[description]'];
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

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="ride[status]"><?php echo e(__('static.settings.status')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                        data-bs-title="<?php echo e(__('static.landing_pages.ride_note')); ?>"></i>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($content['ride']['status'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="ride[status]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="ride[status]" value="1"
                                                                <?php echo e(@$content['ride']['status'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="ride[status]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="ride[status]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="ride-btn-container">
                                            <?php $__currentLoopData = $content['ride']['step'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="btn-group-row">
                                                    <div class="form-group row">
                                                        <label class="col-md-2"
                                                            for="title"><?php echo e(__('static.landing_pages.title')); ?></label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="text"
                                                                name="ride[step][<?php echo e($index); ?>][title]"
                                                                value="<?php echo e(old("ride.step.$index.title", $step['title'] ?? '')); ?>"
                                                                placeholder="<?php echo e(__('static.landing_pages.enter_title')); ?>">
                                                            <?php $__errorArgs = ["ride.step.$index.title"];
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
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-2"
                                                            for="description"><?php echo e(__('static.landing_pages.short_description')); ?></label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" name="ride[step][<?php echo e($index); ?>][description]"
                                                                placeholder="<?php echo e(__('static.landing_pages.enter_description')); ?>" cols="30" rows="5"><?php echo e(old("ride.step.$index.description", $step['description'] ?? '')); ?></textarea>
                                                            <?php $__errorArgs = ["ride.step.$index.description"];
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
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-2"
                                                            for="btn_image"><?php echo e(__('static.landing_pages.image')); ?>

                                                            <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="<?php echo e(__('static.landing_pages.ride_image_note')); ?>"></i>
                                                        </label>
                                                        <div class="col-md-10">
                                                            <div
                                                                class="form-group d-flex gap-3 align-items-start media-relative">
                                                                <div class="media-upload-image">
                                                                    <input type="file" class="form-control fileInput"
                                                                        name="ride[step][<?php echo e($index); ?>][image]" data-preview-id="rideStep-<?php echo e($index); ?>-Preview">
                                                                    <i class="ri-add-line"></i>
                                                                </div>

                                                                <?php if(!empty($step['image'])): ?>
                                                                    <img src="<?php echo e(asset($step['image'])); ?>"
                                                                        alt="Uploaded Image" width="50"
                                                                        class="media-img uploaded-icon-preview" id="rideStep-<?php echo e($index); ?>-Preview">
                                                                <?php else: ?>
                                                                    <img src="" alt="Image Preview" class="media-img" id="rideStep-<?php echo e($index); ?>-Preview" style="display: none;">
                                                                <?php endif; ?>
                                                                <?php $__errorArgs = ["ride.step.$index.image"];
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
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="btn-remove">
                                                            <button type="button"
                                                                class="btn btn-danger"><?php echo e(__('static.landing_pages.remove')); ?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" id="ride-add-btn"
                                                class="btn btn-primary"><?php echo e(__('static.landing_pages.add_new')); ?></button>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="Blog_Section">
                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="title"><?php echo e(__('static.landing_pages.title')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="blog[title]"
                                                    id=""
                                                    value="<?php echo e($content['blog']['title'] ?? old('title')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_title')); ?>">
                                                <?php $__errorArgs = ['blog[title]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="sub_title"><?php echo e(__('static.landing_pages.sub_title')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="blog[sub_title]"
                                                    id=""
                                                    value="<?php echo e($content['blog']['sub_title'] ?? old('sub_title')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_sub_title')); ?>">
                                                <?php $__errorArgs = ['blog[sub_title]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"><?php echo e(__('static.landing_pages.blogs')); ?></label>
                                            <div class="col-md-10">
                                                <select class="form-control select-2" id="" name="blog[blogs][]"
                                                    data-placeholder="<?php echo e(__('static.landing_pages.select_blogs')); ?>"
                                                    multiple>
                                                    <option class="select-placeholder"></option>
                                                    <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <option value="<?php echo e($blog->id); ?>"
                                                            <?php if(in_array($blog?->id, @$content['blog']['blogs'] ?? [])): ?> selected <?php endif; ?>>
                                                            <?php echo e($blog->title); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <option class="select-placeholder" value="[]"></option>
                                                    <?php endif; ?>
                                                </select>
                                                <span class="text-gray mt-1">
                                                    <?php echo e(__('static.landing_pages.no_blogs_message')); ?>

                                                    <a href="<?php echo e(@route('admin.blog.index')); ?>" class="text-primary">
                                                        <b><?php echo e(__('static.here')); ?></b>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="blog[status]"><?php echo e(__('static.settings.status')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('static.landing_pages.blog_note')); ?>"></i>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($content['blog']['status'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="blog[status]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="blog[status]" value="1"
                                                                <?php echo e($content['blog']['status'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="blog[status]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="blog[status]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="Testimonials_Section">
                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="title"><?php echo e(__('static.landing_pages.title')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="testimonial[title]"
                                                    value="<?php echo e($content['testimonial']['title'] ?? old('title')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_title')); ?>">
                                                <?php $__errorArgs = ['testimonial[title]'];
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
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="sub_title"><?php echo e(__('static.landing_pages.sub_title')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="testimonial[sub_title]"
                                                    id=""
                                                    value="<?php echo e($content['testimonial']['sub_title'] ?? old('sub_title')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_sub_title')); ?>">
                                                <?php $__errorArgs = ['testimonial[sub_title]'];
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
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2"><?php echo e(__('static.landing_pages.testimonials')); ?></label>
                                            <div class="col-md-10">
                                                <select class="form-control select-2" name="testimonial[testimonials][]"
                                                    data-placeholder="<?php echo e(__('static.landing_pages.select_testimonials')); ?>"
                                                    multiple>
                                                    <option class="select-placeholder"></option>
                                                    <?php $__empty_1 = true; $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <option value="<?php echo e($testimonial->id); ?>"
                                                            <?php if(in_array($testimonial->id, @$content['testimonial']['testimonials'] ?? [])): ?> selected <?php endif; ?>>
                                                            <?php echo e($testimonial->title); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <option class="select-placeholder" value="[]"></option>
                                                    <?php endif; ?>
                                                </select>
                                                <span class="text-gray mt-1">
                                                    <?php echo e(__('static.landing_pages.no_testimonials_message')); ?>

                                                    <a href="<?php echo e(@route('admin.testimonial.index')); ?>"
                                                        class="text-primary"><b><?php echo e(__('static.here')); ?></b></a>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="testimonial[status]"><?php echo e(__('static.settings.status')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('static.landing_pages.testimonial_note')); ?>"></i>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($content['testimonial']['status'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="testimonial[status]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="testimonial[status]" value="1"
                                                                <?php echo e($content['testimonial']['status'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="testimonial[status]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="testimonial[status]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="FAQ_Section">
                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="title"><?php echo e(__('static.landing_pages.title')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="faq[title]"
                                                    id=""
                                                    value="<?php echo e($content['faq']['title'] ?? old('title')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_title')); ?>">
                                                <?php $__errorArgs = ['faq[title]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="sub_title"><?php echo e(__('static.landing_pages.sub_title')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="faq[sub_title]"
                                                    id=""
                                                    value="<?php echo e($content['faq']['sub_title'] ?? old('sub_title')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_sub_title')); ?>">
                                                <?php $__errorArgs = ['faq[sub_title]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"><?php echo e(__('static.landing_pages.faqs')); ?></label>
                                            <div class="col-md-10">
                                                <select class="form-control select-2" id="" name="faq[faqs][]"
                                                    data-placeholder="<?php echo e(__('static.landing_pages.select_faqs')); ?>"
                                                    multiple>
                                                    <option class="select-placeholder"></option>
                                                    <?php $__empty_1 = true; $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <option value="<?php echo e($faq->id); ?>"
                                                            <?php if(in_array($faq?->id, @$content['faq']['faqs'] ?? [])): ?> selected <?php endif; ?>>
                                                            <?php echo e($faq->title); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <option class="select-placeholder" value="[]"></option>
                                                    <?php endif; ?>
                                                </select>
                                                <span class="text-gray mt-1">
                                                    <?php echo e(__('static.landing_pages.no_faqs_message')); ?>

                                                    <a href="<?php echo e(@route('admin.faq.index')); ?>" class="text-primary">
                                                        <b><?php echo e(__('static.here')); ?></b>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2" for="faq[status]"><?php echo e(__('static.settings.status')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('static.landing_pages.faq_note')); ?>"></i>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($content['faq']['status'])): ?>
                                                            <input class="form-control" type="hidden" name="faq[status]"
                                                                value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="faq[status]" value="1"
                                                                <?php echo e($content['faq']['status'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden" name="faq[status]"
                                                                value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="faq[status]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="Footer_Section">
                                        <div class="form-group row">
                                            <label class="col-md-2" for="image"><?php echo e(__('static.landing_pages.logo')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('static.landing_pages.footer_logo_note')); ?>"></i>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="form-group d-flex gap-3 align-items-start media-relative">
                                                    <div class="media-upload-image">
                                                        <input type="file" class="form-control fileInput"
                                                            name="footer[footer_logo]" data-preview-id="footerLogoPreview">
                                                        <i class="ri-add-line"></i>
                                                    </div>
                                                    <?php $__errorArgs = ['footer[footer_logo]'];
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

                                                    <?php if(isset($content['footer']['footer_logo']) && !empty($content['footer']['footer_logo'])): ?>
                                                        <!-- <div class="col-md-10"> -->
                                                        <img src="<?php echo e(asset($content['footer']['footer_logo'])); ?>"
                                                            alt="image" class="media-img" id="footerLogoPreview">
                                                        <!-- </div> -->
                                                    <?php else: ?>
                                                        <img src="" alt="Image Preview" class="media-img" id="footerLogoPreview" style="display: none;">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="image"><?php echo e(__('static.landing_pages.right_image')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('static.landing_pages.right_image_note')); ?>"></i>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="form-group d-flex gap-3 align-items-start media-relative">
                                                    <div class="media-upload-image">
                                                        <input type="file" class="form-control fileInput"
                                                            name="footer[right_image]" data-preview-id="footerRightLogoPreview">
                                                        <i class="ri-add-line"></i>
                                                    </div>
                                                    <?php $__errorArgs = ['footer[right_image]'];
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
                                                    <?php if(isset($content['footer']['right_image']) && !empty($content['footer']['right_image'])): ?>
                                                        <!-- <div class="col-md-10"> -->
                                                        <img src="<?php echo e(asset($content['footer']['right_image'])); ?>"
                                                            alt="image" class="media-img" id="footerRightLogoPreview">
                                                        <!-- </div> -->
                                                    <?php else: ?>
                                                        <img src="" alt="Image Preview" class="media-img" id="footerRightLogoPreview" style="display: none;">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="quote"><?php echo e(__('static.landing_pages.description')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="footer[description]"
                                                    id=""
                                                    value="<?php echo e($content['footer']['description'] ?? old('description')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_description')); ?>">

                                                <?php $__errorArgs = ['footer[description]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="quote"><?php echo e(__('static.landing_pages.label')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"
                                                    name="footer[newsletter][label]" id=""
                                                    value="<?php echo e($content['footer']['newsletter']['label'] ?? old('label')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_newsletter')); ?>">

                                                <?php $__errorArgs = ['footer[newsletter][label]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="quote"><?php echo e(__('static.landing_pages.button_text')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"
                                                    name="footer[newsletter][button_text]" id=""
                                                    value="<?php echo e($content['footer']['newsletter']['button_text'] ?? old('button_text')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_newsletter_btn_text')); ?>">

                                                <?php $__errorArgs = ['footer[newsletter][button_text]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="quote"><?php echo e(__('static.landing_pages.placeholder')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text"
                                                    name="footer[newsletter][placeholder]" id=""
                                                    value="<?php echo e($content['footer']['newsletter']['placeholder'] ?? old('placeholder')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.newsletter_placeholder')); ?>">

                                                <?php $__errorArgs = ['footer[newsletter][placeholder]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"><?php echo e(__('static.landing_pages.pages')); ?></label>
                                            <div class="col-md-10">
                                                <select class="form-control select-2" id="" name="footer[pages][]"
                                                    data-placeholder="<?php echo e(__('static.landing_pages.select_pages')); ?>"
                                                    multiple>
                                                    <option class="select-placeholder"></option>
                                                    <?php $__empty_1 = true; $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <option value="<?php echo e($page->id); ?>"
                                                            <?php if(in_array($page?->id, @$content['footer']['pages'] ?? [])): ?> selected <?php endif; ?>>
                                                            <?php echo e($page->title); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <option class="select-placeholder" value="[]"></option>
                                                    <?php endif; ?>
                                                </select>
                                                <span class="text-gray mt-1">
                                                    <?php echo e(__('static.landing_pages.no_pages_message')); ?>

                                                    <a href="<?php echo e(@route('admin.page.index')); ?>" class="text-primary">
                                                        <b><?php echo e(__('static.here')); ?></b>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="app_store_url"><?php echo e(__('static.landing_pages.app_store_url')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="footer[app_store_url]"
                                                    id=""
                                                    value="<?php echo e($content['footer']['app_store_url'] ?? old('app_store_url')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_app_store_url')); ?>">
                                                <?php $__errorArgs = ['footer[app_store_url]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="play_store_url"><?php echo e(__('static.landing_pages.play_store_url')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="footer[play_store_url]"
                                                    id=""
                                                    value="<?php echo e($content['footer']['play_store_url'] ?? old('play_store_url')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_play_store_url')); ?>">
                                                <?php $__errorArgs = ['footer[app_store_url]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2" for="quote"><?php echo e(__('static.landing_pages.copyright')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="footer[copyright]" id=""
                                                    value="<?php echo e($content['footer']['copyright'] ?? old('copyright')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_copyright')); ?>">
                                                <?php $__errorArgs = ['footer[copyright]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"><?php echo e(__('static.landing_pages.social_media')); ?></label>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label><?php echo e(__('static.landing_pages.facebook_url')); ?></label>
                                                        <input class="form-control" type="url" name="footer[social][facebook]"
                                                            value="<?php echo e($content['footer']['social']['facebook'] ?? old('footer.social.facebook')); ?>"
                                                            placeholder="<?php echo e(__('static.landing_pages.enter_facebook')); ?>">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label><?php echo e(__('static.landing_pages.google_url')); ?></label>
                                                        <input class="form-control" type="url" name="footer[social][google]"
                                                            value="<?php echo e($content['footer']['social']['google'] ?? old('footer.social.google')); ?>"
                                                            placeholder="<?php echo e(__('static.landing_pages.enter_google')); ?>">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label><?php echo e(__('static.landing_pages.instagram_url')); ?></label>
                                                        <input class="form-control" type="url" name="footer[social][instagram]"
                                                            value="<?php echo e($content['footer']['social']['instagram'] ?? old('footer.social.instagram')); ?>"
                                                            placeholder="<?php echo e(__('static.landing_pages.enter_instagram')); ?>">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label><?php echo e(__('static.landing_pages.twitter_url')); ?></label>
                                                        <input class="form-control" type="url" name="footer[social][twitter]"
                                                            value="<?php echo e($content['footer']['social']['twitter'] ?? old('footer.social.twitter')); ?>"
                                                            placeholder="<?php echo e(__('static.landing_pages.enter_twitter')); ?>">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label><?php echo e(__('static.landing_pages.whatsapp_url')); ?></label>
                                                        <input class="form-control" type="url" name="footer[social][whatsapp]"
                                                            value="<?php echo e($content['footer']['social']['whatsapp'] ?? old('footer.social.whatsapp')); ?>"
                                                            placeholder="<?php echo e(__('static.landing_pages.enter_whatsapp')); ?>">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label><?php echo e(__('static.landing_pages.linkedin_url')); ?></label>
                                                        <input class="form-control" type="url" name="footer[social][linkedin]"
                                                            value="<?php echo e($content['footer']['social']['linkedin'] ?? old(key: 'footer.social.linkedin')); ?>"
                                                            placeholder="<?php echo e(__('static.landing_pages.enter_linkedin')); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="footer[status]"><?php echo e(__('static.settings.status')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('static.landing_pages.footer_note')); ?>"></i>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="editor-space">
                                                    <label class="switch">
                                                        <?php if(isset($content['footer']['status'])): ?>
                                                            <input class="form-control" type="hidden"
                                                                name="footer[status]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="footer[status]" value="1"
                                                                <?php echo e($content['footer']['status'] ? 'checked' : ''); ?>>
                                                        <?php else: ?>
                                                            <input class="form-control" type="hidden"
                                                                name="footer[status]" value="0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="footer[status]" value="1">
                                                        <?php endif; ?>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="SEO_Section">
                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="image"><?php echo e(__('static.landing_pages.meta_image')); ?>

                                                <i class="ri-error-warning-line" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="<?php echo e(__('static.landing_pages.meta_image_note')); ?>"></i>
                                            </label>
                                            <div class="col-md-10">
                                                <div class="form-group d-flex gap-3 align-items-start media-relative">
                                                    <div class="media-upload-image">
                                                        <input type="file" class="form-control fileInput"
                                                            name="seo[meta_image]" data-preview-id="seoMetaImagePreview">
                                                        <i class="ri-add-line"></i>
                                                    </div>
                                                    <?php $__errorArgs = ['seo[meta_image]'];
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
                                                    <?php if(isset($content['seo']['meta_image']) && !empty($content['seo']['meta_image'])): ?>
                                                        <img src="<?php echo e(asset($content['seo']['meta_image'])); ?>"
                                                            alt="image" class="media-img" id="seoMetaImagePreview">
                                                    <?php else: ?>
                                                        <img src="" alt="Image Preview" class="media-img" id="seoMetaImagePreview" style="display: none;">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="quote"><?php echo e(__('static.landing_pages.meta_title')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="seo[meta_title]"
                                                    id=""
                                                    value="<?php echo e($content['seo']['meta_title'] ?? old('meta_title')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_meta_title')); ?>">
                                                <?php $__errorArgs = ['seo[meta_title]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="meta_description"><?php echo e(__('static.landing_pages.meta_description')); ?></label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" type="text" name="seo[meta_description]" id="" cols="30"
                                                    rows="5" placeholder="<?php echo e(__('static.landing_pages.enter_meta_description')); ?>"><?php echo e($content['seo']['meta_description'] ?? old('meta_description')); ?></textarea>
                                                <?php $__errorArgs = ['seo[meta_description]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="meta_tags"><?php echo e(__('static.landing_pages.meta_tags')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="seo[meta_tags]"
                                                    id=""
                                                    value="<?php echo e($content['seo']['meta_tags'] ?? old('meta_tags')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_meta_tags')); ?>">
                                                <?php $__errorArgs = ['seo[meta_tags]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="og_title"><?php echo e(__('static.landing_pages.og_title')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="seo[og_title]"
                                                    id=""
                                                    value="<?php echo e($content['seo']['og_title'] ?? old('og_title')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_og_title')); ?>">
                                                <?php $__errorArgs = ['seo[og_title]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="og_description"><?php echo e(__('static.landing_pages.og_description')); ?></label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" type="text" name="seo[og_description]" id="" value=""
                                                    cols="30" rows="5" placeholder="<?php echo e(__('static.landing_pages.enter_og_description')); ?>"><?php echo e($content['seo']['og_description'] ?? old('og_description')); ?></textarea>
                                                <?php $__errorArgs = ['seo[og_description]'];
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
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="Analytics_Section">
                                        <div class="analytics-section">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" href="#facebook-tabs"
                                                        data-bs-toggle="tab"><?php echo e(__('static.landing_pages.facebook_pixel')); ?></a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" href="#analytics-tabs"
                                                        data-bs-toggle="tab"><?php echo e(__('static.landing_pages.google_analytics')); ?></a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" href="#google-tabs"
                                                        data-bs-toggle="tab"><?php echo e(__('static.landing_pages.google_tag_id')); ?></a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" href="#tawk-tabs"
                                                        data-bs-toggle="tab"><?php echo e(__('static.landing_pages.chat_bot_id')); ?></a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="facebook-tabs">
                                                    <div class="form-group row">
                                                        <label class="col-md-2"
                                                            for="pixel_id"><?php echo e(__('static.landing_pages.pixel_id')); ?></label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="text"
                                                                name="analytics[pixel_id]" id=""
                                                                value="<?php echo e($content['analytics']['pixel_id'] ?? old('pixel_id')); ?>"
                                                                placeholder="<?php echo e(__('static.landing_pages.enter_pixel_id')); ?>">
                                                            <?php $__errorArgs = ['analytics[pixel_id]'];
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
                                                            <span class="text-gray mt-1">
                                                                <?php echo e(__('static.landing_pages.add_pixel_id')); ?>

                                                                <a href="https://en-gb.facebook.com/business/help/952192354843755?id=1205376682832142"
                                                                    target="_blank" class="text-primary">
                                                                    <b><?php echo e(__('static.here')); ?></b>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="analytics-tabs">
                                                    <div class="form-group row">
                                                        <!-- <label class="col-md-2"  for="analytics"><?php echo e(__('static.landing_pages.google_analytics')); ?></label> -->
                                                        <div class="form-group row">
                                                            <label class="col-md-2"
                                                                for="measurement_id"><?php echo e(__('static.landing_pages.measurement_id')); ?></label>
                                                            <div class="col-md-10">
                                                                <input class="form-control" type="text"
                                                                    name="analytics[measurement_id]" id=""
                                                                    value="<?php echo e($content['analytics']['measurement_id'] ?? old('measurement_id')); ?>"
                                                                    placeholder="<?php echo e(__('static.landing_pages.enter_measurement_id')); ?>">
                                                                <?php $__errorArgs = ['analytics[measurement_id]'];
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
                                                                <span class="text-gray mt-1">
                                                                    <?php echo e(__('static.landing_pages.add_measurement_id')); ?>

                                                                    <a href="https://support.google.com/analytics/answer/12270356?hl=en"
                                                                        target="_blank" class="text-primary">
                                                                        <b><?php echo e(__('static.here')); ?></b>
                                                                    </a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-2"
                                                                for="analytics[status]"><?php echo e(__('static.settings.status')); ?>

                                                                <i class="ri-error-warning-line"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="<?php echo e(__('static.landing_pages.note')); ?>"></i>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <div class="editor-space">
                                                                    <label class="switch">
                                                                        <?php if(isset($content['analytics']['pixel_status'])): ?>
                                                                            <input class="form-control" type="hidden"
                                                                                name="analytics[pixel_status]"
                                                                                value="0">
                                                                            <input class="form-check-input"
                                                                                type="checkbox"
                                                                                name="analytics[pixel_status]"
                                                                                value="1"
                                                                                <?php echo e($content['analytics']['pixel_status'] ? 'checked' : ''); ?>>
                                                                        <?php else: ?>
                                                                            <input class="form-control" type="hidden"
                                                                                name="analytics[pixel_status]"
                                                                                value="0">
                                                                            <input class="form-check-input"
                                                                                type="checkbox"
                                                                                name="analytics[pixel_status]"
                                                                                value="1">
                                                                        <?php endif; ?>
                                                                        <span class="switch-state"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="google-tabs">
                                                    <div class="form-group row">

                                                        <div class="form-group row">
                                                            <label class="col-md-2"
                                                                for="tag_id"><?php echo e(__('static.landing_pages.tag_id')); ?></label>
                                                            <div class="col-md-10">
                                                                <input class="form-control" type="text"
                                                                    name="analytics[tag_id]" id=""
                                                                    value="<?php echo e($content['analytics']['tag_id'] ?? old('tag_id')); ?>"
                                                                    placeholder="<?php echo e(__('static.landing_pages.enter_tag_id')); ?>">
                                                                <?php $__errorArgs = ['analytics[tag_id]'];
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
                                                                <span class="text-gray mt-1">
                                                                    <?php echo e(__('static.landing_pages.add_tag_id')); ?>

                                                                    <a href="https://support.google.com/analytics/answer/9539598?hl=en"
                                                                        target="_blank" class="text-primary">
                                                                        <b><?php echo e(__('static.here')); ?></b>
                                                                    </a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-2"
                                                                for="analytics[status]"><?php echo e(__('static.settings.status')); ?>

                                                                <i class="ri-error-warning-line"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="<?php echo e(__('static.landing_pages.note')); ?>"></i>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <div class="editor-space">
                                                                    <label class="switch">
                                                                        <?php if(isset($content['analytics']['tag_id_status'])): ?>
                                                                            <input class="form-control" type="hidden"
                                                                                name="analytics[tag_id_status]"
                                                                                value="0">
                                                                            <input class="form-check-input"
                                                                                type="checkbox"
                                                                                name="analytics[tag_id_status]"
                                                                                value="1"
                                                                                <?php echo e($content['analytics']['tag_id_status'] ? 'checked' : ''); ?>>
                                                                        <?php else: ?>
                                                                            <input class="form-control" type="hidden"
                                                                                name="analytics[tag_id_status]"
                                                                                value="0">
                                                                            <input class="form-check-input" type="checkbox" name="analytics[tag_id_status]" value="1">
                                                                        <?php endif; ?>
                                                                        <span class="switch-state"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="tawk-tabs">
                                                    <div class="form-group row">
                                                        <label class="col-md-2" for="tawk_to_property_id"><?php echo e(__('static.landing_pages.property_id')); ?></label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="password"
                                                                name="analytics[tawk_to_property_id]"
                                                                value="<?php echo e($content['analytics']['tawk_to_property_id'] ?? old('tawk_to_property_id')); ?>"
                                                                placeholder="<?php echo e(__('static.landing_pages.enter_property_id')); ?>">
                                                                <?php $__errorArgs = ['analytics[tawk_to_property_id]'];
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
                                                                <span class="text-gray mt-1">
                                                                    <?php echo e(__('static.landing_pages.property_id_note1')); ?>

                                                                    <a href="https://dashboard.tawk.to/login" target="_blank" class="text-primary"><?php echo e(__('static.landing_pages.property_id_note_link1')); ?></a>.
                                                                    <?php echo e(__('static.landing_pages.property_id_note2')); ?>

                                                                    <a href="https://help.tawk.to/" target="_blank" class="text-primary"><?php echo e(__('static.landing_pages.property_id_note_link2')); ?></a>.
                                                                </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="Cookies_Section">
                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="quote"><?php echo e(__('static.landing_pages.title')); ?></label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="cookie[title]"
                                                    id=""
                                                    value="<?php echo e($content['cookie']['title'] ?? old('title')); ?>"
                                                    placeholder="<?php echo e(__('static.landing_pages.enter_title')); ?>">
                                                <?php $__errorArgs = ['cookie[title]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="description"><?php echo e(__('static.landing_pages.description')); ?></label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" type="text" name="cookie[description]" id="" cols="30"
                                                    rows="3" placeholder="<?php echo e(__('static.landing_pages.enter_description')); ?>"><?php echo e($content['cookie']['description'] ?? old('description')); ?></textarea>
                                                <?php $__errorArgs = ['cookie[description]'];
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
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2"
                                                for="content"><?php echo e(__('static.landing_pages.content')); ?></label>
                                            <div class="col-md-10">
                                                <textarea class="form-control image-embed-content" type="text" name="cookie[content]" id=""
                                                    cols="30" rows="5" placeholder="<?php echo e(__('static.landing_pages.enter_content')); ?>"><?php echo e($content['cookie']['content'] ?? old('content')); ?></textarea>
                                                <?php $__errorArgs = ['cookie[content]'];
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
                                        </div>
                                    </div>

                                    <button type="submit"
                                        class="btn btn-primary spinner-btn"><i class="ri-save-line text-white lh-1"></i><?php echo e(__('static.save')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            'use strict';

            $('.fileInput').on('change', function(event) {
                const input = this;
                const previewId = $(this).data('preview-id');
                const $preview = $('#' + previewId);

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $preview.attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $preview.attr('src', '').hide();
                }
            });

            function addNewRow(containerSelector, inputMappings) {
                const container = $(containerSelector);
                const firstRow = container.find('.btn-group-row').first().clone();
                const currentIndex = container.find('.btn-group-row').length;

                inputMappings.forEach(mapping => {
                    firstRow.find(mapping.selector).each(function() {
                        const name = $(this).attr('name');
                        if (name) {
                            const updatedName = name.replace(/\[\d+\]/, `[${currentIndex}]`);
                            $(this).attr('name', updatedName);
                        }

                        if ($(this).is('input[type="file"]')) {
                            $(this).val('');
                        } else {
                            $(this).val('');
                        }

                        $(this).removeClass('is-invalid');
                        $(this).siblings('.invalid-feedback').remove();
                    });
                });

                firstRow.find('.uploaded-icon-preview').remove();

                firstRow.find('.btn-remove').show();
                container.append(firstRow);

            }


            function isCurrentRowFilled(containerSelector, inputMappings) {
                const lastRow = $(containerSelector).find('.btn-group-row').last();
                let isFilled = true;

                inputMappings.forEach(mapping => {
                    lastRow.find(mapping.selector).each(function() {
                        const value = $(this).val();
                        const hasPreview = $(this).closest('.btn-group-row').find(
                            '.uploaded-icon-preview').length > 0;

                        if (!value && !hasPreview) {
                            isFilled = false;

                            $(this).addClass('is-invalid');
                            if (!$(this).siblings('.invalid-feedback').length) {
                                $(this).after(
                                    '<span class="invalid-feedback d-block" role="alert">This field is required.</span>'
                                );
                            }
                        } else {
                            $(this).removeClass('is-invalid');
                            $(this).siblings('.invalid-feedback').remove();
                        }
                    });
                });

                return isFilled;
            }

            $('#home-add-btn').click(function() {
                const containerSelector = '#home-btn-container';
                const inputMappings = [{
                        selector: 'input[name^="home[button]"]'
                    },
                    {
                        selector: 'select[name^="home[button]"]'
                    }
                ];

                if (isCurrentRowFilled(containerSelector, inputMappings)) {
                    addNewRow(containerSelector, inputMappings);
                }
            });

            $('#statistics-add-btn').click(function() {
                const containerSelector = '#statistics-btn-container';
                const inputMappings = [{
                        selector: 'input[name^="statistics[counters]"]'
                    },
                    {
                        selector: 'textarea[name^="statistics[counters]"]'
                    },
                    {
                        selector: 'input[type="file"][name^="statistics[counters]"]'
                    }
                ];

                if (isCurrentRowFilled(containerSelector, inputMappings)) {
                    addNewRow(containerSelector, inputMappings);
                }
            });

            $('#feature-add-btn').click(function() {
                const containerSelector = '#feature-btn-container';
                const inputMappings = [{
                        selector: 'input[name^="feature[images]"]'
                    },
                    {
                        selector: 'textarea[name^="feature[images]"]'
                    },
                    {
                        selector: 'input[type="file"][name^="feature[images]"]'
                    }
                ];

                if (isCurrentRowFilled(containerSelector, inputMappings)) {
                    addNewRow(containerSelector, inputMappings);
                }
            });

            $('#ride-add-btn').click(function() {
                const containerSelector = '#ride-btn-container';
                const inputMappings = [{
                        selector: 'input[name^="ride[step]"]'
                    },
                    {
                        selector: 'textarea[name^="ride[step]"]'
                    },
                    {
                        selector: 'input[type="file"][name^="ride[step]"]'
                    }
                ];

                if (isCurrentRowFilled(containerSelector, inputMappings)) {
                    addNewRow(containerSelector, inputMappings);
                }
            });

            $(document).on('click', '.btn-remove', function() {
                const row = $(this).closest('.btn-group-row');
                const container = row.parent();
                if (container.find('.btn-group-row').length > 1) {
                    row.remove();
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/landing-page/index.blade.php ENDPATH**/ ?>