<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/nestable-style.css')); ?>">
<?php $__env->stopPush(); ?>

<div class="contentbox">
    <div class="inside">
        <div class="contentbox-title">
            <h3 class="mb-0"><?php echo e(__('ticket::static.categories.categories')); ?></h3>
            <?php if(!Request::is('admin/ticket/category')): ?>
                <a href="<?php echo e(route('admin.ticket.category.index')); ?>"
                    class="btn btn-primary"><?php echo e(__('ticket::static.categories.add_category')); ?></a>
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
                                        <div class="dd-handle dd3-handle"><?php echo e(__('ticket::static.categories.drag')); ?></div>
                                        <div class="dd3-content"><?php echo e($category->name); ?>

                                                <button type="button" class="delete" data-bs-toggle="modal"
                                                        data-bs-target="#confirmation"
                                                        data-url="<?php echo e(route('admin.ticket.category.destroy', $category->id)); ?>">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                                <?php
                                                    $route =
                                                        route('admin.ticket.category.edit', [$category->id]) .
                                                        '?locale=' .
                                                        app()->getLocale();
                                                ?>
                                                <a href="<?php echo e($route); ?>"
                                                    class="edit"><i class="ri-edit-2-line"></i></a>
                                        </div>
                                        <?php if(!$category?->childs?->isEmpty()): ?>
                                            <?php echo $__env->make('ticket::admin.category.childs', [
                                                'childs' => $category->childs,
                                            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="no-data mt-3">
                                        <img src="<?php echo e(url('/images/no-data.png')); ?>" alt="">
                                        <h6 class="mt-2"><?php echo e(__('ticket::static.categories.no_category_found')); ?></h6>
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
<!-- confirmation modal modal -->
<div class="modal fade confirmation-modal" id="confirmation" tabindex="-1" role="dialog"
    aria-labelledby="confirmationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-start">
                <div class="main-img">
                    <i class="ri-delete-bin-line "></i>
                </div>
                <div class="text-center">
                    <div class="modal-title"><?php echo e(__('static.delete_message')); ?></div>
                    <p class="mb-0"><?php echo e(__('static.delete_note')); ?></p>
                </div>
            </div>
            <div class="modal-footer">
                <form method="POST" action="" id="deleteForm">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="button" class="btn btn-primary m-0 delete-category"
                        data-bs-dismiss="modal"><?php echo e(__('static.cancel')); ?></button>
                    <button type="submit" class="btn btn-secondary delete-btn m-0"><?php echo e(__('static.delete')); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/nestable/jquery.nestable.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            // Update category order in database
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
                    url: "<?php echo e(route('admin.ticket.category.update.orders')); ?>",
                    method: 'POST',
                    data: {
                        categories: mergedArray
                    },
                    success: function() {
                        //
                    }
                });
            }

            // Initialize nestable and set change event
            $('.dd').nestable({
                maxDepth: 12
            }).on('change', updateToDatabase);

            $(document).on('click', '.delete', function() {
                $('#deleteForm').attr('action', $(this).data('url'));
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Ticket/resources/views/admin/category/list.blade.php ENDPATH**/ ?>