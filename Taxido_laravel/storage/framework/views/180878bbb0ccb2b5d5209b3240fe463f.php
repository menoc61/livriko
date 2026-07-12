<?php
$order = isset(request()->order) && request()->order == 'asc' ? 'desc' : 'asc';
?>

<?php if($showCheckbox ?? true): ?>
<th class="check-column">
    <div class="form-check"><input type="checkbox" class="form-check-input checkAll"></div>
</th>
<?php endif; ?>

<?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<th <?php if(isset($column['sortable']) && $column['sortable']): ?> class="sorting-hover" <?php endif; ?>>
    <?php if($column['sortable']): ?>
        <?php
            $column['field'] = $column['sortField'] ?? $column['field'];
            $updatedQueryParams = array_merge(request()->query(), [
                'orderby' => $column['field'],
                'order' => $order,
            ]);
            $updatedUrl = url()->current() . '?' . http_build_query($updatedQueryParams);
        ?>
        <a href="<?php echo e($updatedUrl); ?>">
            <span><?php echo e($column['title']); ?></span>
            <span class="sorting-indicators">
                <?php if(isset(request()->order) && request()->order == 'asc'): ?>
                    <span class="sorting-indicator asc"></span>
                <?php elseif(isset(request()->order) && request()->order == 'desc'): ?>
                    <span class="sorting-indicator desc"></span>
                <?php else: ?>
                    <span class="sorting-indicator asc desc"></span>
                <?php endif; ?>
            </span>
        </a>
    <?php else: ?>
        <?php echo e($column['title']); ?>

    <?php endif; ?>
</th>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/components/table/table-header.blade.php ENDPATH**/ ?>