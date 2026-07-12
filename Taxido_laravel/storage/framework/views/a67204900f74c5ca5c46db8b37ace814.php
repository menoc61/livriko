<?php use \App\Models\Tag; ?>
<?php use \App\Models\Category; ?>
<?php
    $tags = Tag::where('status', true)->get(['id', 'name']);
    $categories = Category::where('status', true)
        ->whereNull('parent_id')
        ->with([
            'childs' => function ($query) {
                $query->where('status', true);
            },
        ])
        ->get();
?>
<div class="col-xl-9">
    <div class="left-part">
        <div class="contentbox ">
            <div class="inside">
                <div class="contentbox-title flip">
                    <h3><?php echo e(isset($blog) ? __('static.blogs.edit_blog') : __('static.blogs.add_blog')); ?>

                        (<?php echo e(app()->getLocale()); ?>)
                    </h3>
                </div>
                <?php if(isset($blog)): ?>
                    <div class="form-group row">
                        <label class="col-md-2" for="name"><?php echo e(__('static.language.languages')); ?></label>
                        <div class="col-md-10">
                            <ul class="language-list">
                                <?php $__empty_1 = true; $__currentLoopData = getLanguages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li>
                                        <a href="<?php echo e(route('admin.blog.edit', ['blog' => $blog->id, 'locale' => $lang->locale])); ?>"
                                            class="language-switcher <?php echo e(request('locale') === $lang->locale ? 'active' : ''); ?>"
                                            target="_blank">
                                            <img src="<?php echo e(@$lang?->flag ?? asset('admin/images/No-image-found.jpg')); ?>"
                                                alt="">
                                            <?php echo e(@$lang?->name); ?> (<?php echo e(@$lang?->locale); ?>)
                                            <i class="ri-arrow-right-up-line"></i>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <li>
                                        <a href="<?php echo e(route('admin.blog.edit', ['blog' => $blog->id, 'locale' => Session::get('locale', 'en')])); ?>"
                                            class="language-switcher active" target="blank">
                                            <img src="<?php echo e(asset('admin/images/flags/LR.png')); ?>" alt="">
                                            English
                                            <i class="ri-arrow-right-up-line"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
                <input type="hidden" name="locale" value="<?php echo e(request('locale')); ?>">
                <div class="slide">
                    <div class="form-group row">
                        <label class="col-md-2" for="title"><?php echo e(__('static.blogs.title')); ?> <span> *</span></label>
                        <div class="col-md-10">
                            <div class="position-relative">
                                <input class="form-control" type="text" name="title" id="title"
                                    value="<?php echo e(isset($blog->title) ? $blog->getTranslation('title', request('locale', app()->getLocale())) : old('title')); ?>"
                                    placeholder="<?php echo e(__('static.blogs.enter_title')); ?> (<?php echo e(request('locale', app()->getLocale())); ?>)"
                                    required>
                                <i class="ri-file-copy-line copy-icon" data-target="#title"></i>
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
                        <label class="col-md-2" for="slug"><?php echo e(__('static.blogs.slug')); ?></label>
                        <div class="col-md-10 input-group mobile-input-group">
                            <span class="input-group-text"> <?php echo e(url('blog')); ?>/</span>
                            <input class="form-control" type="text" id="slug" name="slug"
                                placeholder="<?php echo e(__('static.blogs.enter_slug')); ?>"
                                value="<?php echo e(isset($blog->slug) ? $blog->slug : old('slug')); ?>" disabled>
                            <div id="slug-loader" class="spinner-border" role="status" style="display: none;">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row amount-input">
                        <label class="col-md-2" for="description"><?php echo e(__('static.blogs.description')); ?> </label>
                        <div class="col-md-10">
                            <div class="position-relative">
                                <textarea class="form-control" rows="4" name="description" id="description"
                                    placeholder="<?php echo e(__('static.blogs.enter_blog_description')); ?> (<?php echo e(request('locale', app()->getLocale())); ?>)"
                                    cols="80"><?php echo e(isset($blog->description) ? $blog->getTranslation('description', request('locale', app()->getLocale())) : old('description')); ?></textarea><i class="ri-file-copy-line copy-icon"
                                    data-target="#description"></i>
                            </div>
                        </div>
                        <?php $__errorArgs = ['description'];
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
                    <div class="form-group row amount-input">
                        <label class="col-md-2" for="content"><?php echo e(__('static.blogs.content')); ?><span> *</span> </label>
                        <div class="col-md-10 select-label-error">
                            <textarea class="form-control content" name="content"
                                placeholder="<?php echo e(__('static.blogs.enter_content')); ?>(<?php echo e(request('locale', app()->getLocale())); ?>)" required><?php echo e(isset($blog->content) ? $blog->getTranslation('content', request('locale', app()->getLocale())) : old('content')); ?>

                            </textarea>
                        </div>
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
                    <div class="form-group row">
                        <label class="col-md-2" for="blog_thumbnail_id"><?php echo e(__('static.blogs.thumbnail')); ?><span>
                                *</span></label>
                        <div class="col-md-10">
                            <div class="form-group">
                                <?php if (isset($component)) { $__componentOriginal22d447e3f5aafc93b8447b54b36ee789 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image','data' => ['name' => 'blog_thumbnail_id','data' => isset($blog->blog_thumbnail)
                                    ? $blog?->blog_thumbnail
                                    : old('blog_thumbnail_id'),'text' => ' ','multiple' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('blog_thumbnail_id'),'data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($blog->blog_thumbnail)
                                    ? $blog?->blog_thumbnail
                                    : old('blog_thumbnail_id')),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(' '),'multiple' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $attributes = $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $component = $__componentOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
                                <?php $__errorArgs = ['blog_thumbnail_id'];
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
        <div class="contentbox">
            <div class="inside">
                <div class="contentbox-title flip">
                    <h3><?php echo e(__('static.blogs.search_engine_optimization_(SEO)')); ?></h3>
                    <div class="header-action">
                    </div>
                </div>
                <div class="slide">
                    <div class="form-group row">
                        <label class="col-md-2" for="meta_title"><?php echo e(__('static.blogs.meta_title')); ?> </label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="meta_title"
                                placeholder="<?php echo e(__('static.blogs.enter_meta_title')); ?>"
                                value="<?php echo e(isset($blog->meta_title) ? $blog->meta_title : old('meta_title')); ?>">
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
                        <label class="col-md-2" for="meta_description"><?php echo e(__('static.blogs.meta_description')); ?>

                        </label>
                        <div class="col-md-10">
                            <textarea class="form-control" rows="4" name="meta_description"
                                placeholder="<?php echo e(__('static.blogs.enter_meta_description')); ?>" cols="80"><?php echo e(isset($blog->meta_description) ? $blog->meta_description : old('meta_description')); ?></textarea>
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
                        <label class="col-md-2" for="blog_meta_image_id"><?php echo e(__('static.blogs.meta_image')); ?></label>
                        <div class="col-md-10">
                            <div class="form-group">
                                <?php if (isset($component)) { $__componentOriginal22d447e3f5aafc93b8447b54b36ee789 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image','data' => ['name' => 'blog_meta_image_id','data' => isset($blog->blog_meta_image)
                                    ? $blog?->blog_meta_image
                                    : old('blog_meta_image_id'),'text' => ' ','multiple' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('blog_meta_image_id'),'data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($blog->blog_meta_image)
                                    ? $blog?->blog_meta_image
                                    : old('blog_meta_image_id')),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(' '),'multiple' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $attributes = $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $component = $__componentOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
                                <?php $__errorArgs = ['blog_meta_image_id'];
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
</div>
<div class="col-xl-3">
    <div class="p-sticky">
        <div class="contentbox">
            <div class="inside">
                <div class="contentbox-title ">
                    <h3><?php echo e(__('static.blogs.publish')); ?></h3>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="d-flex align-items-center gap-2 icon-position flex-wrap">
                                    <button type="submit" name="save" class="btn btn-primary">
                                        <i class="ri-save-line text-white lh-1"></i> <?php echo e(__('static.save')); ?>

                                    </button>
                                    <button type="submit" name="save_and_exit" class="btn btn-primary spinner-btn">
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
                <div class="contentbox-title flip">
                    <h3><?php echo e(__('static.blogs.additional_info')); ?></h3>
                </div>
                <div class="slide">
                    <div class="form-group row">
                        <label class="col-12" for="categories"><?php echo e(__('static.categories.categories')); ?><span>
                                *</span> </label>
                        <div class="col-12">
                            <ul class="categorychecklist custom-scrollbar category">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="category-list">
                                        <div class="form-check">
                                            <input type="checkbox" id="categories-<?php echo e($category->id); ?>"
                                                data-id="<?php echo e($category->id); ?>"
                                                data-parent="<?php echo e($category->parent_id); ?>" name="categories[]"
                                                class="form-check-input" value="<?php echo e($category->id); ?>"
                                                <?php if(isset($blog) ? $blog->categories->pluck('id')->contains($category->id) : false): echo 'checked'; endif; ?> required>
                                            <label for="categories-<?php echo e($category->id); ?>"><?php echo e($category->name); ?></label>
                                        </div>
                                        <?php if(!$category?->childs?->isEmpty()): ?>
                                            <ul>
                                                <?php echo $__env->make('components.category', [
                                                    'childs' => $category?->childs,
                                                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                            </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($categories->isEmpty()): ?>
                                    <div class="no-data mt-3">
                                        <img src="<?php echo e(url('/images/no-data.png')); ?>" alt="">
                                        <h6 class="mt-2"><?php echo e(__('static.categories.no_category_found')); ?></h6>
                                    </div>
                                <?php endif; ?>
                            </ul>
                            <span class="text-gray mt-1">
                                <?php echo e(__('static.blogs.no_categories_message')); ?>

                                <a href="<?php echo e(@route('admin.category.index')); ?>" class="text-primary">
                                    <b><?php echo e(__('static.here')); ?></b>
                                </a>
                            </span>
                            <?php $__errorArgs = ['categories'];
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
                        <label class="col-12" for="tags"><?php echo e(__('static.blogs.tags')); ?><span> *</span></label>
                        <div class="col-12 select-label-error">
                            <span class="text-gray mt-1">
                                <?php echo e(__('static.blogs.no_tags_message')); ?>

                                <a href="<?php echo e(@route('admin.tag.index')); ?>" class="text-primary">
                                    <b><?php echo e(__('static.here')); ?></b>
                                </a>
                            </span>
                            <select class="form-control select-2 tag" name="tags[]"
                                data-placeholder="<?php echo e(__('static.blogs.select_tags')); ?>" multiple>
                                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tag->id); ?>"
                                        <?php if(old('tags') && in_array($tag->id, old('tags'))): ?> selected
                                        <?php elseif(isset($blog) && in_array($tag->id, $blog->tags->pluck('id')->toArray())): ?>
                                            selected <?php endif; ?>>
                                        <?php echo e($tag->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['tags'];
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
        <div class="contentbox">
            <div class="inside">
                <div class="contentbox-title">
                    <h3><?php echo e(__('static.blogs.status')); ?></h3>
                </div>
                <div class="row g-3">
                    <div class="col-xl-12 col-md-4 col-sm-6">
                        <div class="form-group row">
                            <label class="col-12" for="is_featured"><?php echo e(__('static.blogs.featured')); ?> </label>
                            <div class="col-12">
                                <div class="switch-field form-control">
                                    <input value="1" type="radio" name="is_featured" id="feature_active"
                                        <?php if(boolval(@$blog?->is_featured ?? true) == true): echo 'checked'; endif; ?> />
                                    <label for="feature_active"><?php echo e(__('static.active')); ?></label>
                                    <input value="0" type="radio" name="is_featured" id="feature_deactive"
                                        <?php if(boolval(@$blog?->is_featured ?? true) == false): echo 'checked'; endif; ?> />
                                    <label for="feature_deactive"><?php echo e(__('static.deactive')); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-4 col-sm-6">
                        <div class="form-group row">
                            <label class="col-12" for="is_sticky"><?php echo e(__('static.blogs.sticky')); ?> </label>
                            <div class="col-12">
                                <div class="switch-field form-control">
                                    <input value="1" type="radio" name="is_sticky" id="sticky_active"
                                        <?php if(boolval(@$blog?->is_sticky ?? true) == true): echo 'checked'; endif; ?> />
                                    <label for="sticky_active"><?php echo e(__('static.active')); ?></label>
                                    <input value="0" type="radio" name="is_sticky" id="sticky_deactive"
                                        <?php if(boolval(@$blog?->is_sticky ?? true) == false): echo 'checked'; endif; ?> />
                                    <label for="sticky_deactive"><?php echo e(__('static.deactive')); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-4 col-sm-6">
                        <div class="form-group row">
                            <label class="col-12" for="status"><?php echo e(__('static.blogs.status')); ?> </label>
                            <div class="col-12">
                                <div class="switch-field form-control">
                                    <input value="1" type="radio" name="status" id="status_active"
                                        <?php if(boolval(@$blog?->status ?? true) == true): echo 'checked'; endif; ?> />
                                    <label for="status_active"><?php echo e(__('static.active')); ?></label>
                                    <input value="0" type="radio" name="status" id="status_deactive"
                                        <?php if(boolval(@$blog?->status ?? true) == false): echo 'checked'; endif; ?> />
                                    <label for="status_deactive"><?php echo e(__('static.deactive')); ?></label>
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
                console.log("called")

                $('#blogForm').validate({
                    ignore: [],
                    rules: {
                        "title": "required",
                        "slug": "required",
                        "content": "required",
                        "categories[]": "required",
                        "tags[]": "required",
                     
                    },
                    invalidHandler: function(event, validator) {

                        const errors = validator.errorList;
                        errors.forEach(error => {
                            console.log(
                                `Field: ${error.element.name}, Message: ${error.message}`
                            );
                        });
                    }
                });



                const fetchSlug = debounce(function() {
                    const title = $('#title').val();
                    const url = "<?php echo e(route('admin.blog.slug')); ?>";
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
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/blog/fields.blade.php ENDPATH**/ ?>