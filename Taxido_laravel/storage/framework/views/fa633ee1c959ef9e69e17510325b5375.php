<div class="row g-xl-4 g-3">
    <div class="col-xl-9">
        <div class="left-part">
            <div class="contentbox">
                <div class="inside">
                    <div class="contentbox-title">
                        <h3><?php echo e(isset($page) ? __('static.pages.edit_page') : __('static.pages.add')); ?>

                            (<?php echo e(request('locale', app()->getLocale())); ?>)</h3>
                    </div>
                    <?php if(isset($page)): ?>
                        <div class="form-group row">
                            <label class="col-md-2" for="name"><?php echo e(__('static.language.languages')); ?></label>
                            <div class="col-md-10">
                                <ul class="language-list">
                                    <?php $__empty_1 = true; $__currentLoopData = getLanguages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <li>
                                            <a href="<?php echo e(route('admin.page.edit', ['page' => $page->id, 'locale' => $lang->locale])); ?>"
                                                class="language-switcher <?php echo e(request('locale') === $lang->locale ? 'active' : ''); ?>"
                                                target="_blank"><img
                                                    src="<?php echo e(@$lang?->flag ?? asset('admin/images/No-image-found.jpg')); ?>"
                                                    alt=""> <?php echo e(@$lang?->name); ?> (<?php echo e(@$lang?->locale); ?>)<i
                                                    class="ri-arrow-right-up-line"></i></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <li>
                                            <a href="<?php echo e(route('admin.page.edit', ['page' => $page->id, 'locale' => Session::get('locale', 'en')])); ?>"
                                                class="language-switcher active" target="blank"><img
                                                    src="<?php echo e(asset('admin/images/flags/LR.png')); ?>" alt="">English<i
                                                    class="ri-arrow-right-up-line"></i></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                    <input type="hidden" name="locale" value="<?php echo e(request('locale')); ?>">
                    <div class="form-group row">
                        <label class="col-md-2" for="title"><?php echo e(__('static.pages.title')); ?> <span> *</span></label>
                        <div class="col-md-10">
                            <div class="position-relative">
                                <input class="form-control" type="text" name="title" id="title"
                                    value="<?php echo e(isset($page->title) ? $page->getTranslation('title', request('locale', app()->getLocale())) : old('title')); ?>"
                                    placeholder="<?php echo e(__('static.pages.enter_title')); ?> (<?php echo e(request('locale', app()->getLocale())); ?>)"><i
                                    class="ri-file-copy-line copy-icon" data-target="#title"></i>
                            </div>
                            <?php $__errorArgs = ['title'];
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
                    <div class="form-group row slug-blog">
                        <label class="col-md-2" for="slug"><?php echo e(__('static.pages.slug')); ?></label>
                        <div class="col-md-10 input-group mobile-input-group">
                            <span class="input-group-text"> <?php echo e(url('page')); ?>/</span>
                            <input class="form-control" type="text" id="slug" name="slug"
                                placeholder="<?php echo e(__('static.pages.enter_slug')); ?>"
                                value="<?php echo e(isset($page->slug) ? $page->slug : old('slug')); ?>" disabled>
                            <div id="slug-loader" class="spinner-border" role="status" style="display: none;">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row amount-input">
                        <label class="col-md-2" for="content"><?php echo e(__('static.pages.content')); ?> <span> *</span></label>
                        <div class="col-md-10 select-label-error">
                            <textarea class="form-control content" name="content" id="content"
                                placeholder="<?php echo e(__('static.pages.enter_content')); ?>(<?php echo e(request('locale', app()->getLocale())); ?>)">
                                <?php echo e(isset($page->content) ? $page->getTranslation('content', request('locale', app()->getLocale())) : old('content')); ?>

                            </textarea>
                            <?php $__errorArgs = ['content'];
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
            </div>
            <div class="contentbox">
                <div class="inside">
                    <div class="contentbox-title">
                        <h3><?php echo e(__('static.pages.search_engine_optimization_(SEO)')); ?></h3>
                        <div class="header-action">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="meta_title"><?php echo e(__('static.pages.meta_title')); ?> </label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="meta_title"
                                value="<?php echo e(isset($page->meta_title) ? $page->meta_title : old('meta_title')); ?>"
                                placeholder="<?php echo e(__('static.pages.enter_meta_title')); ?>">
                            <?php $__errorArgs = ['meta_title'];
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
                            for="meta_description"><?php echo e(__('static.pages.meta_description')); ?></label>
                        <div class="col-md-10">
                            <textarea class="form-control" rows="4" name="meta_description"
                                placeholder="<?php echo e(__('static.pages.enter_meta_description')); ?>" cols="80"><?php echo e(isset($page->meta_description) ? $page->meta_description : old('meta_description')); ?></textarea>
                            <?php $__errorArgs = ['meta_description'];
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
                        <label class="col-md-2" for="page_meta_image_id"><?php echo e(__('static.pages.meta_image')); ?></label>
                        <div class="col-md-10">
                            <div class="form-group">
                                <?php if (isset($component)) { $__componentOriginal22d447e3f5aafc93b8447b54b36ee789 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image','data' => ['name' => 'page_meta_image_id','data' => isset($page->meta_image) ? $page?->meta_image : old('page_meta_image_id'),'text' => ' ','multiple' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('page_meta_image_id'),'data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($page->meta_image) ? $page?->meta_image : old('page_meta_image_id')),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(' '),'multiple' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $attributes = $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $component = $__componentOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
                                <?php $__errorArgs = ['page_meta_image_id'];
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
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3">
        <div class="p-sticky">
            <div class="contentbox">
                <div class="inside">
                    <div class="contentbox-title">
                        <h3><?php echo e(__('static.pages.publish')); ?></h3>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="d-flex align-items-center gap-2 icon-position">
                                        <button type="submit" name="save" class="btn btn-primary">
                                            <i class="ri-save-line text-white lh-1"></i> <?php echo e(__('static.save')); ?>

                                        </button>
                                        <button type="submit" name="save_and_exit"
                                            class="btn btn-primary spinner-btn">
                                            <i
                                                class="ri-expand-left-line text-white lh-1"></i><?php echo e(__('static.save_and_exit')); ?>

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contentbox">
                <div class="inside">
                    <div class="contentbox-title">
                        <h3><?php echo e(__('static.pages.additional_info')); ?></h3>
                    </div>
                    <div class="row g-3">
                        <div class="col-xl-12 col-md-4 col-sm-6">
                            <div class="form-group row">
                                <label class="col-12" for="status"><?php echo e(__('static.pages.status')); ?> </label>
                                <div class="col-12">
                                    <div class="switch-field form-control">
                                        <input type="radio" name="status" id="feature_active" checked
                                            value="1" <?php if(boolval(@$page?->status ?? true) == true): echo 'checked'; endif; ?> />
                                        <label for="feature_active"><?php echo e(__('static.active')); ?></label>
                                        <input type="radio" name="status" id="feature_deactive" value="0"
                                            <?php if(boolval(@$page?->status ?? true) == false): echo 'checked'; endif; ?> />
                                        <label for="feature_deactive"><?php echo e(__('static.deactive')); ?> </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->startPush('scripts'); ?>
    <script>
        (function($) {
            "use strict";

            function debounce(func, delay) {
                let timeout;
                return function(...args) {
                    const context = this;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), delay);
                };
            }

            $(document).ready(function() {
                $('#pageForm').validate({
                    rules: {
                        "title": "required",
                        "slug": "required",
                        "content": "required",
                    }
                });

                const fetchSlug = debounce(function() {
                    const title = $('#title').val();
                    const url = "<?php echo e(route('admin.page.slug')); ?>";
                    const saveButton = $('button[type="submit"]');

                    saveButton.prop('disabled', true);

                    $('#slug').prop('disabled', true);
                    $('#slug-loader').show();

                    $.ajax({
                        url: url + "?title=" + encodeURIComponent(title),
                        type: 'GET',
                        success: function(data) {
                            $('#slug').val(data.slug);
                        },
                        complete: function() {
                            $('#slug').prop('disabled', false);
                            $('#slug-loader').hide();
                            saveButton.prop('disabled', false);
                        },
                        error: function() {
                            $('#slug').prop('disabled', false);
                            $('#slug-loader').hide();
                            saveButton.prop('disabled', false);
                        }
                    });
                }, 500);

                $('#title').on('input', fetchSlug);
            });

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/page/fields.blade.php ENDPATH**/ ?>