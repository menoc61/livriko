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
                <form method="POST" action="<?php echo e(route('admin.category.destroy', 1)); ?>" id="deleteForm">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="button" class="btn btn-primary m-0"
                        data-bs-dismiss="modal"><?php echo e(__('static.cancel')); ?></button>
                    <button type="submit" class="btn btn-secondary delete-btn m-0"><?php echo e(__('static.delete')); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/components/modal/confirm.blade.php ENDPATH**/ ?>