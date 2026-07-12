<div class="row g-xl-4 g-3">
    <div class="col-xl-10 col-xxl-8 mx-auto">
        <div class="left-part">
            <div class="contentbox">
                <div class="inside">
                    <div class="contentbox-title">
                        <h3><?php echo e(isset($currency) ? __('static.currencies.edit_currency') : __('static.currencies.add_currency')); ?>

                        </h3>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="flag"><?php echo e(__('static.currencies.flag')); ?><span> *</span></label>
                        <div class="col-md-10 d-flex flex-column-reverse">
                            <select id="select-country-flag"
                                    class="form-control form-select form-select-transparent"
                                    name="flag"
                                    data-placeholder="Select Flag"
                                    required>
                                <option></option>
                                <?php $__currentLoopData = getCountryFlags(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($option?->flag); ?>"
                                            image="<?php echo e(asset('images/flags/' . $option->flag)); ?>"
                                            <?php if(isset($currency) && $currency->flag === $option?->flag): echo 'selected'; endif; ?>>
                                        <?php echo e($option?->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['flag'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="code"><?php echo e(__('static.currencies.code')); ?><span> *</span></label>
                        <div class="col-md-10 select-label-error">
                            <select class="select-2 form-control" id="code" name="code"
                                data-placeholder="<?php echo e(__('static.currencies.select_code')); ?>">
                                <option class="select-placeholder" value=""></option>
                                <?php $__currentLoopData = $code; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option class="option" value="<?php echo e($key); ?>"
                                        <?php if(old('code', isset($currency) ? $currency->code : '') == $key): ?> selected <?php endif; ?>><?php echo e($option); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="symbol"><?php echo e(__('static.currencies.symbol')); ?><span>
                                *</span></label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="symbol"
                                value="<?php echo e(isset($currency->symbol) ? $currency->symbol : old('symbol')); ?>"
                                placeholder="<?php echo e(__('static.currencies.enter_symbol')); ?>" readonly>
                            <?php $__errorArgs = ['symbol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="no_of_decimal"><?php echo e(__('static.currencies.decimal_number')); ?><span>
                                *</span></label>
                        <div class="col-md-10">
                            <input class='form-control' id="no_of_decimal" type="number" name="no_of_decimal"
                                value="<?php echo e(isset($currency->no_of_decimal) ? $currency->no_of_decimal : old('no_of_decimal')); ?>"
                                placeholder="<?php echo e(__('static.currencies.enter_number_of_decimal')); ?>">
                            <?php $__errorArgs = ['no_of_decimal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="exchange_rate"><?php echo e(__('static.currencies.exchange_rate')); ?><span>
                                *</span></label>
                        <div class="col-md-10">
                            <input class='form-control' type="number" name="exchange_rate" id="exchange_rate"
                                value="<?php echo e(isset($currency->exchange_rate) ? $currency->exchange_rate : old('exchange_rate')); ?>"
                                placeholder="<?php echo e(__('static.currencies.enter_exchange_rate')); ?>">
                            <?php $__errorArgs = ['exchange_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="role"><?php echo e(__('static.status')); ?></label>
                        <div class="col-md-10">
                            <div class="editor-space">
                                <label class="switch">
                                    <input class="form-control" type="hidden" name="status" value="0">
                                    <input class="form-check-input" type="checkbox" name="status" id=""
                                        value="1" <?php if(@$currency?->status ?? true): echo 'checked'; endif; ?>>
                                    <span class="switch-state"></span>
                                </label>
                            </div>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="submit-btn">
                                <button type="submit" name="save" class="btn btn-primary spinner-btn">
                                    <i class="ri-save-line text-white lh-1"></i> <?php echo e(__('static.save')); ?>

                                </button>
                                <button type="submit" name="save_and_exit" class="btn btn-primary spinner-btn">
                                    <i
                                        class="ri-expand-left-line text-white lh-1"></i><?php echo e(__('static.save_and_exit')); ?>

                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $("#currencyForm").validate({
                    ignore: [],
                    rules: {
                        "code": "required",
                        "symbol": "required",
                        "no_of_decimal": "required",
                        "exchange_rate": "required",
                    },
                });

                var currencySelect = $('select[name="code"]');
                var symbolInput = $('input[name="symbol"]');

                currencySelect.on('change', function() {
                    var selectedCode = currencySelect.val();
                    var url = "<?php echo e(route('admin.currency.symbol')); ?>";
                    if (selectedCode !== null) {
                        $.ajax({
                            url: url,
                            method: 'GET',
                            data: {
                                code: selectedCode
                            },
                            success: function(response) {
                                symbolInput.val(response.symbol);
                            },
                            error: function() {
                                toastr.error('Failed to fetch symbol.', 'Error');
                            }
                        });
                    } else {
                        symbolInput.val('');
                    }
                });

                const optionFormat = (item) => {
                    if (!item.id) {
                        return item.text;
                    }

                    var span = document.createElement('span');
                    var html = '<div class="selected-item">';
                    html += '<img src="' + item.element.getAttribute('image') + '" class="h-24 w-24" alt="' + item.text + '"/>';
                    html += '<span>' + "  " + item.text + '</span>';
                    html += '</div>';
                    span.innerHTML = html;
                    return $(span);
                }

                $('#select-country-flag').select2({
                    placeholder: "Select an option",
                    templateSelection: optionFormat,
                    templateResult: optionFormat
                });

            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/currency/fields.blade.php ENDPATH**/ ?>