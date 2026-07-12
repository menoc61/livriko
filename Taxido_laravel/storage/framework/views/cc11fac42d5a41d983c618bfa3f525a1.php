<?php if(count($bulkactions)): ?>
    <?php
        $filter = request()->filled('filter') ? request()->filter : 'all';
    ?>
    <div class="bottom-part mt-2">
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <div class="d-flex align-items-cente gap-2">
                <select class="form-select" name="paginate">
                    <option value="5" <?php echo e(request()?->paginate == '5' ? 'selected' : ''); ?>>5</option>
                    <option value="10" <?php echo e(request()?->paginate == '10' ? 'selected' : ''); ?>>10</option>
                    <option value="15" <?php echo e(request()?->paginate == '15' || !request()->paginate ? 'selected' : ''); ?>>
                        15</option>
                    <option value="20" <?php echo e(request()?->paginate == '20' ? 'selected' : ''); ?>>20</option>
                </select>
            </div>
            <div class="d-flex align-items-cente gap-2">
                <?php
                    $permissions = array_column($bulkactions, 'permission');
                ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any($permissions)): ?>
                    <select class="form-select" name="action" >
                        <option value=""><?php echo e(__('static.bulk_actions')); ?></option>
                        <?php $__currentLoopData = $bulkactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($action['permission'])): ?>
                                <?php if(empty($action['whenFilter']) || (!empty($action['whenFilter']) && in_array($filter, $action['whenFilter']))): ?>
                                    <option value="<?php echo e($action['action']); ?>"><?php echo e($action['title']); ?></option>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                <?php endif; ?>
                <button type="submit" class="btn btn-outline" id="applyBtn"><?php echo e(__('static.media.apply')); ?></button>
            </div>
        </div>
        <div class="total-data mt-2">
            <span><?php echo e($data->total() ?? 0); ?> <?php echo e(__('static.items')); ?></span>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/components/table/table-action.blade.php ENDPATH**/ ?>