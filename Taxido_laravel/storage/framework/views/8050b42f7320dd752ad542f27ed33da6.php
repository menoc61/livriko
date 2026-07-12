<?php $__env->startSection('title', __('static.pages.pages')); ?>
<?php $__env->startSection('content'); ?>
    <div class="contentbox">
        <div class="inside">
            <div class="contentbox-title">
                <div class="contentbox-subtitle">
                    <h3><?php echo e(__('static.pages.pages')); ?></h3>
                    <div class="subtitle-button-group">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page.create')): ?>
                            <button class="add-spinner btn btn-outline" data-url="<?php echo e(route('admin.page.create')); ?>" wire:navigate>
                                <i class="ri-add-line"></i> <?php echo e(__('static.pages.add_new')); ?>

                            </button>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page.index')): ?>
                        <?php if($tableConfig['total'] > 0): ?>
                            <button class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#exportModal">
                                <i class="ri-download-line"></i> <?php echo e(__('static.export.export')); ?>

                            </button>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page.create')): ?>
                            <button class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#importModal"
                                id="importButton" data-model="page">
                                <i class="ri-upload-line"></i> <?php echo e(__('static.import.import')); ?>

                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="page-table">
                <livewire:admin.⚡table-component
                    :columns="$tableConfig['columns']"
                    :data="$tableConfig['data']"
                    :filters="$tableConfig['filters']"
                    :actions="$tableConfig['actions']"
                    :total="$tableConfig['total']"
                    :bulkactions="$tableConfig['bulkactions']"
                    :action-buttons="$tableConfig['actionButtons']"
                    :modal-action-buttons="$tableConfig['modalActionButtons']"
                    :search="true"
                    :show-checkbox="true" />
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/page/index.blade.php ENDPATH**/ ?>