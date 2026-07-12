<ol class="dd-list">
    <?php $__currentLoopData = $childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="dd-item dd3-item" <?php echo e(isset($cat) && $cat->id == $child->id ? 'active' : ''); ?>

            <?php echo e(!$child->status ? 'disabled' : ''); ?> data-id="<?php echo e($child->id); ?>">
            <div class="dd-handle dd3-handle"><?php echo e(__('static.categories.drag')); ?></div>
            <div class="dd3-content">
                <?php echo e($child->name); ?>

                <button type="button" class="delete delete-category" data-bs-toggle="modal" data-bs-target="#confirmation"
                    data-url="<?php echo e(route('admin.category.destroy', $child->id)); ?>">
                    <i class="ri-delete-bin-line"></i>
                </button>
                <?php
                    $route =
                        route('admin.category.edit', [$child->id]) .
                        '?locale=' .
                        app()->getLocale();
                ?>
                <a href="<?php echo e($route); ?>" class="edit"><i
                        class="ri-edit-2-line"></i></a>
            </div>
        </li>
        <?php if(count($child->childs)): ?>
            <?php echo $__env->make('admin.category.childs', ['childs' => $child->childs], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/category/childs.blade.php ENDPATH**/ ?>