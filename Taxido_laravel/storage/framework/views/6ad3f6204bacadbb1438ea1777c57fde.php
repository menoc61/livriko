<?php $__currentLoopData = $childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li>
    <div class="form-check">
        <input type="checkbox" id="categories-<?php echo e($child->id); ?>" data-id="<?php echo e($child->id); ?>" data-parent="<?php echo e($child->parent_id); ?>" name="categories[]" class="form-check-input" value="<?php echo e($child->id); ?>" <?php if(isset($blog) ?
        $blog->categories->pluck('id')->contains($child->id): false): echo 'checked'; endif; ?>>
        <label for="categories-<?php echo e($child->id); ?>"><?php echo e($child->name); ?></label>
    </div>
    <?php if(!$child?->childs?->isEmpty()): ?>
        <ul>
            <?php echo $__env->make('components.category', ['childs' => $child?->childs], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </ul>
    <?php endif; ?>
</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/components/category.blade.php ENDPATH**/ ?>