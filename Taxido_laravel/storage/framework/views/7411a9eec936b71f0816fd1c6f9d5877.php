<div class="contentbox">
    <div class="inside">
        <div class="contentbox-title">
            <h3><?php echo e(isset($cat->name) ? __('ticket::static.categories.edit_category') : __('ticket::static.categories.add_category')); ?>

                (<?php echo e(app()->getLocale()); ?>)
            </h3>
        </div>
        <?php if(isset($cat)): ?>
            <div class="form-group row">
                <label class="col-md-2" for="name"><?php echo e(__('ticket::static.language.languages')); ?></label>
                <div class="col-md-10">
                    <ul class="language-list">
                        <?php $__empty_1 = true; $__currentLoopData = getLanguages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li>
                                <a href="<?php echo e(route('admin.ticket.category.edit', ['category' => $cat->id, 'locale' => $lang->locale])); ?>"
                                    class="language-switcher <?php echo e(request('locale') === $lang->locale ? 'active' : ''); ?>"
                                    target="_blank"><img
                                        src="<?php echo e(@$lang?->flag ?? asset('admin/images/No-image-found.jpg')); ?>"
                                        alt=""> <?php echo e(@$lang?->name); ?> (<?php echo e(@$lang?->locale); ?>)<i
                                        class="ri-arrow-right-up-line"></i></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li>
                                <a href="<?php echo e(route('admin.ticket.category.edit', ['category' => $cat->id, 'locale' => Session::get('locale', 'en')])); ?>"
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
            <label class="col-md-2" for="name"><?php echo e(__('ticket::static.categories.name')); ?> <span> *</span> </label>
            <div class="col-md-10">
                <div class="position-relative">
                    <input class="form-control" type="text" name="name" id="name"
                        value="<?php echo e(isset($cat->name) ? $cat->getTranslation('name', request('locale', app()->getLocale())) : old('name')); ?>"
                        placeholder="<?php echo e(__('ticket::static.categories.enter_name')); ?>(<?php echo e(request('locale', app()->getLocale())); ?>)"
                        required><i class="ri-file-copy-line copy-icon" data-target="#name"></i>
                </div>
                <?php $__errorArgs = ['name'];
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
            <label class="col-md-2" for="slug"><?php echo e(__('ticket::static.categories.slug')); ?> <span> *</span></label>
            <div class="col-md-10 input-group mobile-input-group">
                <span class="input-group-text"> <?php echo e(url('category')); ?>/</span>
                <input class="form-control" type="text" id="slug" name="slug"
                    placeholder="<?php echo e(__('ticket::static.categories.enter_slug')); ?>"
                    value="<?php echo e(isset($cat->slug) ? $cat->slug : old('slug')); ?>" disabled>
                <div id="slug-loader" class="spinner-border" role="status" style="display: none;">
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-2" for="description"><?php echo e(__('ticket::static.categories.description')); ?></label>
            <div class="col-md-10">
                <div class="position-relative">
                    <textarea class="form-control" rows="4" name="description" cols="80" id="description"
                        placeholder="<?php echo e(__('ticket::static.categories.enter_description')); ?>(<?php echo e(request('locale', app()->getLocale())); ?>)"><?php echo e(isset($cat->description) ? $cat->getTranslation('description', request('locale', app()->getLocale())) : old('description')); ?></textarea><i class="ri-file-copy-line copy-icon" data-target="#description"></i>
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
        </div>
        <div class="form-group row">
            <label class="col-md-2" for="parent_id"><?php echo e(__('ticket::static.categories.parent')); ?></label>
            <div class="col-md-10 select-label-error">
                <select class="form-select select-2" name="parent_id"
                    data-placeholder="<?php echo e(__('ticket::static.categories.select_parent')); ?>">
                    <option class="option" value="" selected></option>
                    <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option class="option" <?php if($key == @$cat?->id): ?> disabled <?php endif; ?>
                            <?php if(old('parent_id', @$cat->parent_id) == $key): echo 'selected'; endif; ?> value="<?php echo e($key); ?>"><?php echo e($category); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['parent_id'];
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
            <label class="col-md-2" class="col-12"
                for="category_image_id"><?php echo e(__('ticket::static.categories.image')); ?></label>
            <div class="col-md-10">
                <div class="form-group">
                    <?php if (isset($component)) { $__componentOriginal22d447e3f5aafc93b8447b54b36ee789 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image','data' => ['name' => 'category_image_id','data' => isset($cat->category_image) ? $cat?->category_image : old('category_image_id'),'text' => '','multiple' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('category_image_id'),'data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($cat->category_image) ? $cat?->category_image : old('category_image_id')),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(''),'multiple' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $attributes = $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $component = $__componentOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
                    <?php $__errorArgs = ['category_image_id'];
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

        <div class="form-group row">
            <label class="col-md-2" for="meta_title"><?php echo e(__('ticket::static.categories.meta_title')); ?> </label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="meta_title"
                    placeholder="<?php echo e(__('ticket::static.categories.enter_meta_title')); ?>"
                    value="<?php echo e(isset($cat->meta_title) ? $cat->meta_title : old('meta_title')); ?>">
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
            <label class="col-md-2" for="meta_description"><?php echo e(__('ticket::static.categories.meta_description')); ?>

            </label>
            <div class="col-md-10">
                <textarea class="form-control" rows="4" name="meta_description"
                    placeholder="<?php echo e(__('ticket::static.categories.enter_meta_description')); ?>" cols="80"><?php echo e(isset($cat->meta_description) ? $cat->meta_description : old('meta_description')); ?></textarea>
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
            <label class="col-md-2"
                for="category_meta_image_id"><?php echo e(__('ticket::static.categories.meta_image')); ?></label>
            <div class="col-md-10">
                <div class="form-group">
                    <?php if (isset($component)) { $__componentOriginal22d447e3f5aafc93b8447b54b36ee789 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image','data' => ['name' => 'category_meta_image_id','data' => isset($cat->category_meta_image)
                        ? $cat?->category_meta_image
                        : old('category_meta_image_id'),'text' => ' ','multiple' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('category_meta_image_id'),'data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($cat->category_meta_image)
                        ? $cat?->category_meta_image
                        : old('category_meta_image_id')),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(' '),'multiple' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $attributes = $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $component = $__componentOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
                    <?php $__errorArgs = ['category_meta_image_id'];
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
        <div class="form-group row">
            <label class="col-md-2" for=""><?php echo e(__('ticket::static.categories.status')); ?></label>
            <div class="col-md-10">
                <div class="editor-space">
                    <label class="switch">
                        <input class="form-control" type="hidden" name="status" value="0">
                        <input class="form-check-input" type="checkbox" name="status" id=""
                            value="1" <?php if(@$cat?->status ?? true): echo 'checked'; endif; ?>>
                        <span class="switch-state"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="submit-btn">
            <button type="submit" name="save" class="btn btn-solid spinner-btn">
                <i class="ri-save-line text-white lh-1"></i> <?php echo e(__('static.save')); ?>

            </button>
            <button type="submit" name="save_and_exit" class="btn btn-solid spinner-btn">
                <i
                    class="ri-expand-left-line text-white lh-1"></i><?php echo e(__('static.save_and_exit')); ?>

            </button>
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
                $('#categoryForm').validate({
                    rules: {
                        "name": "required",
                        "slug": "required",
                    }
                });

                const fetchSlug = debounce(function() {
                    var nameField = $(this);
                    var slugField = $('#slug');
                    var loader = $('#slug-loader');
                    var saveButton = $('button[type="submit"]');

                    saveButton.prop('disabled', true);

                    loader.show();
                    slugField.prop('disabled', true);

                    var url = "<?php echo e(route('admin.ticket.category.slug')); ?>";
                    $.ajax({
                        url: url + "?name=" + encodeURIComponent(nameField.val()),
                        type: 'GET',
                        success: function(data) {
                            slugField.val(data.slug);
                        },
                        complete: function() {
                            loader.hide();
                            slugField.prop('disabled', false);
                            saveButton.prop('disabled', false);
                        },
                        error: function() {
                            loader.hide();
                            slugField.prop('disabled', false);
                            saveButton.prop('disabled', false);
                        }
                    });
                }, 500);

                $('#name').on('input', fetchSlug);
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Ticket/resources/views/admin/category/fields.blade.php ENDPATH**/ ?>