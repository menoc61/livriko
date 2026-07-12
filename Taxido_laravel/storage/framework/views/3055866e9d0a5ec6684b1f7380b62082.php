<?php $__env->startSection('title', __('taxido::static.push_notification.send')); ?>
<?php $__env->startSection('content'); ?>
    <div class="contentbox">
        <div class="inside">
            <div class="contentbox-title">
                <div class="contentbox-subtitle">
                    <h3><?php echo e(__('taxido::static.push_notification.send')); ?></h3>
                </div>
            </div>
            <div class="push-notification">
                <div class="row g-sm-4 g-3">
                    <div class="col-xxl-7 col-xl-8">
                        <form action="<?php echo e(route('admin.send-notification')); ?>" id="sendNotificationForm" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="form-group row">
                                <label class="col-md-2" for="send_to"><?php echo e(__('taxido::static.push_notification.send_to')); ?><span> *</span></label>
                                <div class="col-md-10 error-div select-label-error">
                                    <select class="select-2 form-control" id="send_to" name="send_to"
                                        data-placeholder="<?php echo e(__('taxido::static.push_notification.select_notification_send_to')); ?>">
                                        <option class="select-placeholder" value=""></option>
                                        <?php $__currentLoopData = ['all_riders' => 'All Riders', 'all_drivers' => 'All Drivers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option class="option" value="<?php echo e($key); ?>"
                                                <?php if(old('type', $pushNotification->type ?? '') == $key): ?> selected <?php endif; ?>><?php echo e($option); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['send_to'];
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
                                <label class="col-md-2"
                                    for="image_id"><?php echo e(__('taxido::static.push_notification.image')); ?></label>
                                <div class="col-md-10">
                                    <?php if (isset($component)) { $__componentOriginal22d447e3f5aafc93b8447b54b36ee789 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.image','data' => ['name' => 'image_id','data' => isset($pushNotification->image)
                                        ? $pushNotification->image
                                        : old('image_id'),'text' => __('taxido::static.push_notification.recommended'),'multiple' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('image_id'),'data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($pushNotification->image)
                                        ? $pushNotification->image
                                        : old('image_id')),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('taxido::static.push_notification.recommended')),'multiple' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $attributes = $__attributesOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__attributesOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789)): ?>
<?php $component = $__componentOriginal22d447e3f5aafc93b8447b54b36ee789; ?>
<?php unset($__componentOriginal22d447e3f5aafc93b8447b54b36ee789); ?>
<?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2"
                                    for="title"><?php echo e(__('taxido::static.push_notification.title')); ?><span> *</span></label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="title" name="title"
                                        value="<?php echo e(old('title')); ?>"
                                        placeholder="<?php echo e(__('taxido::static.push_notification.enter_title')); ?>" required>
                                    <?php $__errorArgs = ['title'];
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
                                <label class="col-md-2"
                                    for="message"><?php echo e(__('taxido::static.push_notification.message')); ?></label>
                                <div class="col-md-10">
                                    <textarea class="form-control" placeholder="<?php echo e(__('taxido::static.push_notification.enter_message')); ?>" rows="4"
                                        id="message" name="message" cols="50"><?php echo e(old('message')); ?></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2" for="url"><?php echo e(__('taxido::static.push_notification.url')); ?>

                                </label>
                                <div class="col-md-10">
                                    <input class="form-control" id="url" type="text"
                                        placeholder="<?php echo e(__('taxido::static.push_notification.enter_url')); ?>" name="url"
                                        value="<?php echo e(old('url')); ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2"
                                    for="status"><?php echo e(__('taxido::static.push_notification.schedule')); ?>

                                </label>
                                <div class="col-md-10">
                                    <div class="editor-space">
                                        <label class="switch">
                                            <input class="form-control" type="hidden" name="schedule" value="0">
                                            <input class="form-check-input" type="checkbox" name="schedule"
                                                id="toggleCheckbox" value="1" <?php if(@$pushNotification?->schedule ?? true): echo 'checked'; endif; ?>>
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

                            <div id="contentDiv"class="form-group row" style="display: none;">
                                <label class="col-md-2"
                                    for="status"><?php echo e(__('taxido::static.push_notification.scheduleat')); ?>

                                </label>
                                <div class="col-md-10">
                                    <input type="datetime-local"
                                        class="form-control <?php $__errorArgs = ['schedule_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="scheduleat"
                                        id="datetimeInput"
                                        placeholder="<?php echo e(__('taxido::static.rides.select_start_date_and_time')); ?>"
                                        value="<?php echo e(old('schedule_time', @$pushNotification?->schedule_time)); ?>">
                                </div>
                                
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="submit-btn">
                                        <button type="submit" name="save" class="btn btn-solid spinner-btn">
                                            <?php echo e(__('taxido::static.push_notification.send')); ?>

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xxl-5 col-xl-4 text-center">
                        <div class="notification-mobile-box">
                            <div class="notify-main">
                                <img src="<?php echo e(asset('/images/notify.png')); ?>" class="notify-img">
                                <div class="notify-content">
                                    <h2 class="current-time" id="current-time"></h2>
                                    <div class="notify-data">
                                        <div class="message mt-0">
                                            <img id="notify-image" src="<?php echo e(asset('images/favicon.svg')); ?>" alt="user">
                                            <h5><?php echo e(config('app.name')); ?></h5>
                                        </div>

                                        <div class="notify-footer">
                                            <h5 id="notify-title"><?php echo e(__('taxido::static.push_notification.title')); ?></h5>
                                            <p id="notify-message">
                                                <?php echo e(__('taxido::static.push_notification.message_body')); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/flatpickr/time.js')); ?>"></script>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        (function($) {
            "use strict";

            $('#sendNotificationForm').validate({
                ignore: [],
                rules: {
                    "send_to": "required",
                    "title": "required",
                }
            });

            $('#title').on('change', function() {
                $('#notify-title').text($(this).val());
            });

            $('#message').on('change', function() {
                $('#notify-message').text($(this).val());
            });

            $('#image').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#notify-image').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });

        })(jQuery)
    </script>
    <script>
        $(document).ready(function() {
            // Initialize flatpickr with full logic
            const fp = flatpickr("#datetimeInput", {
                enableTime: true,
                dateFormat: "Y-m-d h:i:s",
                minDate: "today",
                time_24hr: false,
                enableSeconds: true,

                onChange: function(selectedDates, dateStr, instance) {

                    const selectedDate = selectedDates[0];
                    const now = new Date();

                    // Default: allow all times
                    instance.set('minTime', "00:00");

                    if (!selectedDate) return;

                    // If selected date is today, restrict time to now or later
                    if (selectedDate.toDateString() === now.toDateString()) {
                        const hours = now.getHours();
                        const minutes = now.getMinutes();
                        const minTime =
                            `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}`;

                        instance.set('minTime', minTime);
                    } else {
                        // Future date selected — full time range allowed
                        instance.set('minTime', "00:00");
                    }


                }

            });

            // Checkbox toggle logic
            $('#toggleCheckbox').on('change', function() {
                const datetimeInput = document.getElementById('datetimeInput');
                if ($(this).prop('checked')) {
                    $('#contentDiv').show();
                    datetimeInput.disabled = false;
                } else {
                    console.log('checkbox is not checked');
                    $('#contentDiv').hide();
                    datetimeInput.disabled = true;
                }
            });

            // Trigger change event initially
            $('#toggleCheckbox').trigger('change');
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/admin/push-notification/create.blade.php ENDPATH**/ ?>