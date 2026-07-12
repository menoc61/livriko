<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
'columns',
'data',
'filters',
'total',
'search',
'actions',
'bulkactions',
'viewActionBox' => [],
'actionButtons' => [],
'modalActionButtons' => [],
'showCheckbox' => true,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
'columns',
'data',
'filters',
'total',
'search',
'actions',
'bulkactions',
'viewActionBox' => [],
'actionButtons' => [],
'modalActionButtons' => [],
'showCheckbox' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="table-main">
        <form method="GET" class="table-form mb-0">
            <div class="table-top-panel">
                <?php if(isset($filters) || (isset($search) && $search)): ?>
                <div class="top-part mb-md-4 mb-0">
                    <?php if(isset($filters)): ?>
                    <ul class="top-part-left m-0">
                        <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $filterActive =
                        (request()->filled('filter') && request()->filter == $filter['slug']) ||
                        (!request()->filled('filter') && $loop->first);
                        ?>
                        <li class="<?php echo e($filter['slug']); ?>">
                            <a href="<?php echo e(url()->current() . '?filter=' . $filter['slug']); ?>"
                                <?php if($filterActive): ?> class="current" <?php endif; ?>>
                                <?php echo e($filter['title']); ?>

                                <span class="count">(<?php echo e(isset($filter['count']) ? $filter['count'] : 0); ?>)</span>
                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <?php endif; ?>
                    <?php if(isset($search) && $search): ?>
                    <?php echo $__env->make('components.table.table-search', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php echo $__env->make('components.table.table-action', ['total' => $total, 'bulkactions' => $bulkactions], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </form>
        <div class="table-responsive custom-scrollbar">
            <table class="table">
                <thead>
                    <tr>
                        <?php echo $__env->make('components.table.table-header', [
                        'columns' => $columns,
                        'showCheckbox' => $showCheckbox
                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </tr>
                </thead>
                <tbody>
                    <div class="progress-loader-wrapper" style="display:none;">
                        <div class="loader"></div>
                    </div>
                    <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <?php if($showCheckbox && !is_string($row)): ?>
                        <td class="check-column">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="ids[]"
                                    value="<?php echo e($row['id'] ?? null); ?>"
                                    data-system-reserved="<?php echo e(@$row['system_reserve'] ?? 0); ?>">
                            </div>
                        </td>
                        <?php endif; ?>

                        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('components.table.table-body', [
                        'system_reserved' => !is_string($row) ? $row['system_reserve'] ?? 0 : 0,
                        'column' => $column,
                        'row' => $row,
                        'actionButtons' => $actionButtons,
                        'modalActionButtons' => $modalActionButtons,
                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr class="no-items">
                        <td class="colspan" colspan="<?php echo e(count($columns) + ($showCheckbox ? 1 : 0)); ?>">
                            <?php echo e(__('No')); ?> <span><?php echo e(__('Data')); ?></span> <?php echo e(__('Found')); ?>

                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <?php echo $__env->make('components.table.table-header', [
                        'columns' => $columns,
                        'showCheckbox' => $showCheckbox
                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </tr>
                </tfoot>
            </table>
        </div>
        <?php if($data): ?>
        <?php echo e($data?->appends(['paginate' => request()?->paginate])->links()); ?>

        <?php endif; ?>

</div>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        $(document).on('click', '.permanentDeleteBtn', function() {
            $('#permanentDeleteForm').attr('action', $(this).data('url'));
        });

        // Only initialize if checkboxes exist
        if ($('.form-check-input[name="ids[]"]').length) {
            function updateCheckAll() {
                const totalCheckboxes = $('.form-check-input[name="ids[]"]').not(':disabled').length;
                const checkedCheckboxes = $('.form-check-input[name="ids[]"]:checked').not(':disabled').length;
                $('.checkAll').prop('checked', totalCheckboxes > 0 && totalCheckboxes === checkedCheckboxes);
            }

            $('.form-check-input[name="ids[]"]').change(updateCheckAll);

            $('.checkAll').change(function() {
                const isChecked = $(this).is(':checked');
                $('.form-check-input[name="ids[]"]').not(':disabled').prop('checked', isChecked);
                updateCheckAll();
            });

            $('.form-check-input[name="ids[]"]').each(function() {
                var isReserved = $(this).data('system-reserved');
                if (isReserved) {
                    $(this).prop('disabled', true);
                }
            });
        }

        $(document).on('change', '.toggle-class', function() {
            let checked = $(this).prop('checked') ? 1 : 0;
            let url = $(this).data('route');
            let clickedToggle = $(this);
            $('.progress-loader-wrapper').show();
            $.ajax({
                type: "PUT",
                url: url,
                data: {
                    status: checked,
                    _token: '<?php echo e(csrf_token()); ?>',
                },
                success: function(data) {
                    clickedToggle.prop('checked', checked);
                    $('.progress-loader-wrapper').hide();
                    location.reload();
                    toastr.success("<?php echo e(__('static.toastr.status')); ?>");
                },
                error: function(xhr, status, error) {
                    $('.progress-loader-wrapper').hide();
                    let message = xhr.responseJSON?.message ?? null;
                    if(message) {
                        toastr.error(message);
                    }else {
                        toastr.error(error);
                    }

                    clickedToggle.prop('checked', !checked);
                }
            });
        });
    });

    $(document).ready(function() {
    $('#applyBtn').on('click', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        if (!form.length) {
            toastr.error('No form found.');
            return;
        }

        var action = form.find('select[name="action"]').val();
        if (!action) {
            toastr.error('Please select a bulk action.');
            return;
        }
        var selectedIds = [];
        $('input[name="ids[]"]:checked').each(function() {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            toastr.error('Please select at least one item.');
            return;
        }

       var baseUrl = window.location.pathname;
        var params = new URLSearchParams();
        params.set('action', action);
        selectedIds.forEach(function(id) {
            params.append('ids[]', id);
        });
        var actionUrl = baseUrl + '?' + params.toString();
        window.location.href = actionUrl;
    });

    // Handle "Select All" checkbox
    $('.checkAll').on('change', function() {
        $('input[name="ids[]"]').prop('checked', $(this).prop('checked'));
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/components/table/index.blade.php ENDPATH**/ ?>