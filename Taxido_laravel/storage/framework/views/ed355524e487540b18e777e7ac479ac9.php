<div class="row g-sm-4 g-3">
    <?php if(isset($formfields)): ?>
        <?php $__currentLoopData = $formfields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xl-4 col-sm-6">
                <div class="form-field-box">
                    <div class="form-title">
                        <h4><?php echo e($field->label); ?></h4>
                    </div>
                    <ul class="form-content-list">
                        <li><span><?php echo e(__('ticket::static.formfield.type')); ?></span> : <?php echo e($field->type); ?></li>
                        <li><span><?php echo e(__('ticket::static.formfield.mandatory')); ?></span> : <?php if($field->is_required): ?>
                                Yes
                            <?php else: ?>
                                No
                            <?php endif; ?>
                        </li>
                        <li><span><?php echo e(__('ticket::static.formfield.placeholder')); ?></span> : <?php echo e($field->placeholder); ?></li>
                    </ul>
                    <div class="from-btn-group">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket.formfield.edit')): ?>
                            <button class="btn edit-btn" id="update-form-modal" data-id="<?php echo e($field->id); ?>">Edit</button>
                            <?php if(!$field->system_reserve): ?>
                                <button class="btn delete-btn" id="delete-form-field"
                                    data-id="<?php echo e($field->id); ?>">Delete</button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<div class="modal fade delete-form delete-modal" id="delete-form-feild-modal" tabindex="-1" role="dialog"
    aria-labelledby="confirmationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="get" id="delete-form">
                <?php echo csrf_field(); ?>
                <div class="modal-body confirmation-data delete-data">
                    <div class="main-img">
                        <div class="delete-icon">
                            <i class="ri-delete-bin-line"></i>
                        </div>
                    </div>

                    <div class="text-center">
                        <h4 class="modal-title"> <?php echo e(__('ticket::static.delete_message')); ?></h4>
                        <p><?php echo e(__('ticket::static.delete_note')); ?></p>
                    </div>
                    <div class="button-box d-flex">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal"><?php echo e(__('ticket::static.cancel')); ?></button>
                        <button type="submit" class="btn btn-primary delete"
                            data-delete-id=""><?php echo e(__('ticket::static.delete')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>
    <script>
        (function($) {
            "use strict";

            $(document).ready(function() {
                $('#FormField').validate();

                var myModal = new bootstrap.Modal(document.getElementById("confirmation"), {});

                var deleteModal = new bootstrap.Modal(document.getElementById("delete-form-feild-modal"), {});

                // Reset modal state
                function resetConfirmationModal() {
                    $(this).find('form')[0].reset();
                    $(this).find('.cloned').remove();
                    $('.type-options').hide();
                    $('#type').val('').trigger('change');
                    $('.select_type').hide(); // Hide select type
                    $('.placeholder-input').show(); // Show placeholder input
                    $('#FormField').attr('action',
                    '<?php echo e(route('admin.formfield.store')); ?>'); // Reset form action to 'store'
                    $('input[name="_method"]').val('POST'); // Reset method to POST
                    $('.modal-title').text('<?php echo e(__('ticket::static.formfield.add')); ?>'); // Reset modal title
                }

                $('#confirmation').on('hidden.bs.modal', resetConfirmationModal);

                $(document).on('click', '#update-form-modal', function(e) {
                    e.preventDefault();
                    myModal.show();
                    $('#FormField').hide();
                    $('.loader-formfield').show();
                    fetchUpdateData($(this).attr('data-id'))
                });

                $(document).on('click', '#delete-form-field', function(e) {
                    e.preventDefault();
                    deleteModal.show();
                    var id = $(this).attr('data-id');
                    var action = 'formfield/destroy/' + id;
                    $('#delete-form').attr('action', action);
                });

                function fetchUpdateData(id) {
                    var url = "<?php echo e(url('admin/formfield')); ?>/" + id + "/edit";
                    var updateUrl = '<?php echo e(route('admin.formfield.update', ':id')); ?>';
                    updateUrl = updateUrl.replace(':id', id);
                    $('#FormField').attr('action', updateUrl);
                    $('input[name="_method"]').val('PUT');
                    $('.modal-title').text('<?php echo e(__('ticket::static.formfield.edit')); ?>');
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(data) {
                            $('input[name="label"]').val(data.label);
                            $('input[name="name"]').val(data.name);
                            $('input[name="placeholder"]').val(data.placeholder);
                            $('#type').val(data.type).trigger('change');
                            if (data.type == 'select' || data.type == 'checkbox' || data.type ==
                                'radio') {
                                $('.type-options').show();
                                $('.select_type').hide();
                                $('.placeholder-input').hide();

                                if (data.type == 'select') {
                                    $('.select_type').show();
                                }
                                $('input[type="radio"][name="select_type"]').each(function() {
                                    if ($(this).val() == data.select_type) {
                                        $(this).prop('checked', true);
                                    }
                                });
                                if (data.options.length > 0) {
                                    const $firstOption = $('.options');
                                    const $optionCloneContainer = $('.option-clone');
                                    const $deleteRow = $('.delete-row');

                                    // Populate and show the first option
                                    const firstOption = data.options[0];
                                    $firstOption.find('input.option-value-input').val(firstOption
                                        .option_value);
                                    $firstOption.find('input.option-name-input').val(firstOption
                                        .option_name);
                                    $firstOption.show();

                                    // Clear and append additional options to the clone container
                                    $optionCloneContainer.empty();
                                    data.options.slice(1).forEach(option => {
                                        const $clonedOption = $firstOption.clone().addClass(
                                            'cloned');
                                        $clonedOption.find('input.option-value-input').val(
                                            option.option_value);
                                        $clonedOption.find('input.option-name-input').val(
                                            option.option_name);
                                        $optionCloneContainer.append($clonedOption);
                                    });

                                    // Show or hide delete row based on number of options
                                    $deleteRow.toggle(data.options.length > 1);
                                } else {
                                    $('.options').hide(); // Hide if no options
                                }
                            }
                            if (data.is_required) {
                                $('input[name="is_required"]').prop('checked', true);
                            }
                            if (data.status) {
                                $('input[name="status"]').prop('checked', true);
                            }
                        },
                        complete: function() {
                            $('#FormField').show();
                            $('.loader-formfield').hide();
                        }
                    });
                }
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Ticket/resources/views/admin/formfield/inputfield.blade.php ENDPATH**/ ?>