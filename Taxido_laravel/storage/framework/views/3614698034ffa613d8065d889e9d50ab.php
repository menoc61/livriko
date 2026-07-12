<?php $__env->startSection('title', __('ticket::static.formfield.formfield')); ?>
<?php $__env->startSection('content'); ?>
    <div class="contentbox">
        <div class="inside">
            <div class="contentbox-title">
                <div class="contentbox-subtitle">
                    <h3><?php echo e(__('ticket::static.formfield.formfield')); ?></h3>
                    <div class="subtitle-button-group">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket.formfield.create')): ?>
                            <a href="" data-bs-toggle="modal" data-bs-target="#confirmation"
                                class="btn btn-outline"><i class="ri-add-line"></i><?php echo e(__('ticket::static.formfield.add_new')); ?></a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket.formfield.create')): ?>
                            <a href="<?php echo e(route('ticket.form')); ?>"
                                class="btn btn-outline"><?php echo e(__('ticket::static.formfield.ticket')); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="alert alert-info ms-0 w-100" role="alert">
                <?php echo e(__('ticket::static.formfield.description')); ?>

            </div>
            <?php if ($__env->exists('ticket::admin.formfield.inputfield', ['formfields' => $formfields])) echo $__env->make('ticket::admin.formfield.inputfield', ['formfields' => $formfields], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('ticket::admin.formfield.modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                $('#FormField').validate();
                $('.type-options').hide();
                $('.select_type').hide();
                $('.delete-row').hide();
                $('.loader-formfield').hide();

                $(document).on('change', '#type', function(e) {
                    e.preventDefault();

                    const type = $(this).val();
                    const validTypes = ['select', 'checkbox', 'radio'];

                    const $typeOptions = $('.type-options');
                    const $selectType = $('.select_type');
                    const $placeholderInput = $('.placeholder-input');

                    if (validTypes.includes(type)) {
                        $typeOptions.show();
                        $selectType.toggle(type === 'select');
                        $placeholderInput.toggle(type !== 'radio' && type !== 'checkbox');
                    } else {
                        $typeOptions.hide();
                        $selectType.hide();
                        $placeholderInput.show();
                    }
                });

                $(document).on('click', '#add_value', function(e) {
                    e.preventDefault();

                    var isValid = true;
                    $('.option_value:first, .option_name:first').find('input').each(function() {
                        if ($(this).val().trim() === '') {
                            $(this).addClass('is-invalid');
                            isValid = false;
                        } else {
                            $(this).removeClass('is-invalid');
                        }
                    });

                    if (!isValid) {
                        return;
                    }

                    var clonedOption = $('.options:first').clone().addClass('cloned');

                    clonedOption.find('input').val('');

                    $('.option-clone').append(clonedOption);
                    $('.delete-row').show();

                    $(document).on('click', '#delete-row', function(e) {
                        e.preventDefault();

                        if ($('.options').length > 1) {
                            $(this).closest('.options').remove();
                        } else {
                            $('.delete-row').hide();
                        }
                    });
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Ticket/resources/views/admin/formfield/index.blade.php ENDPATH**/ ?>