<?php if(is_array($value)): ?>
<?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subKey => $subValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php echo $__env->make('admin.language.trans-fields', ['key' => "{$key}__{$subKey}", 'value' => $subValue], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<div class="form-group row">
  <label class="col-3 tooltip-width" for="locale" data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-custom-class="custom-tooltip"
        data-bs-title="<?php echo e(str_replace('__', '.', $key)); ?>"><?php echo e(str_replace('__', '.', $key)); ?></label>
  <div class="col-9">
    <input type="text" class="form-control" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
  </div>
</div>
<?php endif; ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/language/trans-fields.blade.php ENDPATH**/ ?>