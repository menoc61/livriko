<div class="modal fade confirmation-modal" id="confirmation" tabindex="-1" role="dialog"
    aria-labelledby="confirmationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(__('ticket::static.formfield.form_field')); ?></h5> <button type="button"
                    class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body edit-field text-start">
                <div class="loader-formfield">
                    <div class="spinner-border" role="status">
                        
                    </div>
                </div>
                <form action="<?php echo e(route('admin.formfield.store')); ?>" method="POST" id="FormField">
                    <?php echo method_field('POST'); ?>
                    <?php echo csrf_field(); ?>
                    <?php echo $__env->make('ticket::admin.formfield.fields', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Ticket/resources/views/admin/formfield/modal.blade.php ENDPATH**/ ?>