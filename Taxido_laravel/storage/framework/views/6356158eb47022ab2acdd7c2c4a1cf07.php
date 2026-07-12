<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/nestable-style.css')); ?>">
<?php $__env->stopPush(); ?>

<div class="contentbox">
    <div class="inside">
        <div class="contentbox-title">
            <h3 class="mb-0"><?php echo e(__('static.categories.categories')); ?></h3>
            <?php if(!Request::is('admin/category')): ?>
                <a href="<?php echo e(route('admin.category.index')); ?>"
                    class="btn btn-primary"><?php echo e(__('static.categories.add_category')); ?></a>
            <?php endif; ?>
        </div>
        <div class="categories-container">
            <div class="category-body">
                <div class="cf nestable-lists">
                    <div class="dd" id="nestable3">
                        <ol class="dd-list">
                            <?php if(isset($categories)): ?>
                                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li class="dd-item dd3-item <?php echo e(isset($cat) && $cat->id == $category->id ? 'active' : ''); ?>"
                                        data-id="<?php echo e($category->id); ?>">
                                        <div class="dd-handle dd3-handle">Drag</div>
                                        <div class="dd3-content"><?php echo e($category->name); ?>

                                            <button type="button" class="delete delete-category" data-bs-toggle="modal"
                                                data-bs-target="#confirmation"
                                                data-url="<?php echo e(route('admin.category.destroy', $category->id)); ?>">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                            <?php
                                                $route =
                                                    route('admin.category.edit', [$category->id]) .
                                                    '?locale=' .
                                                    app()->getLocale();
                                            ?>
                                            <a href="<?php echo e($route); ?>" class="edit"><i
                                                    class="ri-edit-2-line"></i></a>
                                            <?php if (isset($component)) { $__componentOriginale9f572557820c4cd5a6bbfd15f332f84 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale9f572557820c4cd5a6bbfd15f332f84 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal.confirm','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal.confirm'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale9f572557820c4cd5a6bbfd15f332f84)): ?>
<?php $attributes = $__attributesOriginale9f572557820c4cd5a6bbfd15f332f84; ?>
<?php unset($__attributesOriginale9f572557820c4cd5a6bbfd15f332f84); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale9f572557820c4cd5a6bbfd15f332f84)): ?>
<?php $component = $__componentOriginale9f572557820c4cd5a6bbfd15f332f84; ?>
<?php unset($__componentOriginale9f572557820c4cd5a6bbfd15f332f84); ?>
<?php endif; ?>
                                        </div>
                                        <?php if(!$category?->childs?->isEmpty()): ?>
                                            <?php echo $__env->make('admin.category.childs', [
                                                'childs' => $category->childs,
                                            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                    <div class="no-data mt-3">
                                        <img src="<?php echo e(url('/images/no-data.svg')); ?>" alt="">
                                        <h6 class="mt-2"><?php echo e(__('static.categories.no_category_found')); ?></h6>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/nestable/jquery.nestable.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            function updateToDatabase() {
                let idString = $('.dd').nestable('toArray', {
                    attribute: 'data-id'
                });
                let orderIndex = [];
                $('#nestable3 li').each(function(index) {
                    orderIndex.push({
                        id: $(this).attr('data-id'),
                        order: index
                    });
                });
                let mergedArray = Object.values(Object.groupBy([...orderIndex, ...idString], ({
                        id
                    }) => id))
                    .map(e => e.reduce((acc, cur) => ({
                        ...acc,
                        ...cur
                    })));

                $.ajax({
                    url: "<?php echo e(route('admin.category.update.orders')); ?>",
                    method: 'POST',
                    data: {
                        categories: mergedArray
                    },
                    success: function() {
                        //
                    }
                });
            }

            $('.dd').nestable({
                maxDepth: 12
            }).on('change', updateToDatabase);

            $(document).on('click', '.delete-category', function() {
                const url = $(this).data('url');
                $('#deleteForm').attr('action', url);
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/category/list.blade.php ENDPATH**/ ?>