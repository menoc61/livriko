<?php use \Modules\Ticket\Models\Priority; ?>
<?php use \Modules\Ticket\Models\Status; ?>
<?php use \Modules\Ticket\Models\Message; ?>
<?php
    $priorities = Priority::where('status', true)?->get(['id', 'name', 'color', 'slug']);
    $statuses = Status::where('status', true)?->get(['id', 'name']);
    $settings = tx_getSettings();
    $replies = Message::where('ticket_id', $ticket->id)->orderBy('id', 'desc')->get()->load('media');

?>

<?php $__env->startSection('title', __('ticket::static.ticket.ticket')); ?>
<?php $__env->startSection('content'); ?>
    <div class="row g-xl-4 g-3">
        <div class="col-xl-4">
            <div class="p-sticky">
                <?php if(auth()->user()->hasRole('admin')): ?>
                    <div class="contentbox">
                        <div class="inside">
                            <div class="contentbox-title">
                                <h3><?php echo e(__('ticket::static.assign_ticket.assign')); ?></h3>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 select-label-error">
                                    <select class="assign-select select-2 form-control"
                                        data-placeholder="<?php echo e(__('ticket::static.assign_ticket.executive')); ?>" multiple>
                                        <option class="select-placeholder" value=""></option>
                                        <option value="<?php echo e(auth()->user()->id); ?>"
                                            <?php if(isset($ticket?->assigned_tickets) &&
                                                    in_array(auth()->user()->id, $ticket?->assigned_tickets->pluck('id')->toArray())): ?> selected <?php endif; ?>></i> Me </option>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($user->id); ?>"
                                                <?php if(isset($ticket?->assigned_tickets) && in_array($user->id, $ticket?->assigned_tickets->pluck('id')->toArray())): ?> selected <?php endif; ?>><?php echo e($user['name']); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="submit-btn">
                                        <button type="submit" name="save" id="assign-user"
                                            class="btn btn-solid spinner-btn">
                                            <?php echo e(__('ticket::static.assign_ticket.assign_btn')); ?>

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="contentbox">
                    <div class="inside">
                        <div class="contentbox-title">
                            <h3><?php echo e(__('ticket::static.user_detail.title')); ?></h3>
                        </div>
                        <div class="customer-detail">
                            <div class="profile">
                                <?php if($ticket?->user?->profile_image): ?>
                                    <img src="<?php echo e($ticket?->user?->profile_image?->original_url); ?>" alt="">
                                <?php else: ?>
                                    <div class="initial-letter">
                                        <span><?php echo e(strtoupper($ticket?->user?->name[0])); ?></span>
                                    </div>
                                <?php endif; ?>
                                <div class="profile-name">
                                    <h4><?php echo e($ticket?->name ?? $ticket?->user?->name); ?></h4>
                                    <p><?php echo e($ticket?->email ?? $ticket?->user?->email); ?></p>
                                </div>
                            </div>
                            <ul class="detail-list">
                                <li class="detail-item">
                                    <h5><?php echo e(__('ticket::static.user_detail.name')); ?></h5>
                                    <span><?php echo e($ticket?->name ?? $ticket?->user?->name); ?></span>
                                </li>
                                <li class="detail-item">
                                    <h5><?php echo e(__('ticket::static.user_detail.email')); ?></h5>
                                    <span><?php echo e($ticket?->email ?? $ticket?->user?->email); ?></span>
                                </li>
                                <li class="detail-item">
                                    <h5><?php echo e(__('ticket::static.user_detail.phone')); ?></h5>
                                    <span>
                                        <?php if($ticket?->user?->phone): ?>
                                            + (<?php echo e($ticket?->user?->country_code); ?>) <?php echo e($ticket?->user?->phone); ?>

                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php if(getCurrentRoleName() == 'admin' || getCurrentRoleName() == 'executive'): ?>
                    <div class="contentbox">
                        <div class="inside">
                            <div class="contentbox-title">
                                <h3><?php echo e(__('ticket::static.ticket_notes.title')); ?></h3>
                            </div>
                            <div class="customer-detail">
                                <?php if($ticket?->note): ?>
                                    <div class="detail-card">
                                        <ul class="detail-list">
                                            <li class="detail-item">
                                                <span class="note-warning"><?php echo e($ticket?->note); ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                <?php else: ?>
                                    <div class="profile">
                                        <img src="<?php echo e(asset('/images/notes.png')); ?>" alt="" class="img"
                                            height="100px">
                                        <div class="profile-name">
                                            <h4><?php echo e(__('ticket::static.ticket_notes.no_notes_yet')); ?></h4>
                                            <p><?php echo e(__('ticket::static.ticket_notes.add_note')); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="left-part p-sticky">
                <div class="contentbox">
                    <div class="inside">
                        <div class="contentbox-title">
                            <div class="contentbox-subtitle">
                                <h3><?php echo e($ticket?->ticket_number . ' - ' . $ticket?->subject); ?></h3>
                            </div>

                            <div class="submit-btn action-btn">
                                <?php if(
                                    (isset($ticket?->assigned_tickets) &&
                                        in_array(auth()->user()->id, $ticket?->assigned_tickets->pluck('id')->toArray())) ||
                                        !isset($ticket?->assigned_tickets)): ?>
                                    <button type="submit" class="btn gray" id="ticket-reply">
                                        <i class="ri-reply-line"></i>
                                    </button>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ticket.ticket.destroy')): ?>
                                    <button type="submit" name="save" class="btn secondary" data-bs-toggle="modal"
                                        data-bs-target="#confirmation">
                                        <i class="ri-delete-bin-6-line"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="ticket-content">
                            <div class="row g-3">
                                <div class="col-12">
                                    <h6 class="created-time">
                                        <span
                                            class="name"><?php echo e('Created At : ' . $ticket?->created_at->format('Y-m-d h:i A')); ?></span>
                                        <span
                                            class="badge badge-<?php echo e($ticket?->priority->color); ?>"><?php echo e($ticket?->priority->name); ?></span>
                                    </h6>
                                </div>
                                <div class="col-12 m-0">
                                    <form id="replyForm" action="<?php echo e(route('admin.reply.store')); ?>" method="POST"
                                        enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('POST'); ?>
                                        <div id="ticket-reply-box" class="response-form" style="display: none">
                                            <input type="hidden" name="ticket_id" value="<?php echo e($ticket?->id); ?>">
                                            <input type="hidden" name="reply_id" value="<?php echo e(auth()->user()->id); ?>">
                                            <div class="form-group mb-3">
                                                <textarea class="form-control" name="message" id="message"
                                                    placeholder="<?php echo e(__('ticket::static.ticket.enter_description')); ?>"></textarea>
                                                <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong class="message-error"><?php echo e($message); ?></strong>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group mb-3 select-label-error">
                                                <select class="select-ticket-status select-2 form-control"
                                                    name="ticket_status" data-placeholder="<?php echo e(__('Select status')); ?>">
                                                    <option class="select-placeholder" value=""></option>
                                                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($status->id); ?>"
                                                            <?php if($ticket?->ticketStatus->id == $status->id): ?> selected <?php endif; ?>>
                                                            <?php echo e($status->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong class="message-error"><?php echo e($message); ?></strong>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="upload-file-container">
                                                <label for="image"><?php echo e(__('ticket::static.ticket.upload')); ?> <span
                                                        class="text-danger">(<?php echo e(__('ticket::static.ticket.upload_span')); ?>

                                                        <?php echo e($settings['storage_configuration']['max_file_upload']); ?>)</span></label>
                                                <div class="upload-file">
                                                    <input type="file" class="form-control" name="image[]"
                                                        id="image-upload"
                                                        data-max="<?php echo e($settings['storage_configuration']['max_file_upload']); ?>"
                                                        data-types="<?php echo e(implode(',', $settings['storage_configuration']['supported_file_types'])); ?>"
                                                        data-size="<?php echo e($settings['storage_configuration']['max_file_upload_size']); ?>"
                                                        multiple>
                                                    <button type="submit" class="btn btn-outline spinner-btn">
                                                        <i class="ri-reply-line"></i><?php echo e(__('Send')); ?>

                                                    </button>
                                                </div>
                                            </div>
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong class="image-upload-error"></strong>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12">
                                    <div class="ticket-contentbox">
                                        <ul class="reply-box">
                                            <?php $__currentLoopData = $replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <div class="profile-box">
                                                        <div class="profile-img">
                                                            <?php if($reply->created_by?->profile_image): ?>
                                                                <img src="<?php echo e($reply?->created_by?->profile_image?->original_url); ?>"
                                                                    alt="">
                                                            <?php else: ?>
                                                                <div class="initial-letter">
                                                                    <span><?php echo e(strtoupper($reply?->created_by?->name[0])); ?></span>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <h5><?php echo e($reply?->created_by?->name ?? $reply?->ticket?->email); ?>

                                                            <span>(<?php echo e($reply?->created_at->diffForHumans()); ?>)</span>
                                                        </h5>
                                                        <?php if($ticket?->ticketStatus->name !== 'Closed'): ?>
                                                            <div class="dropdown ticket-dropdown ms-auto">
                                                                <button type="button" class="btn dropdown-toggle"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="ri-more-2-fill"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item" href="#"
                                                                        id="ticket-reply"><?php echo e(__('ticket::static.ticket.reply')); ?></a>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="comment-div">
                                                        <div class="comment comment-box">
                                                            <div class="comment-text" id="comment-<?php echo e($reply?->id); ?>">
                                                                <?php echo $reply?->message; ?>

                                                            </div>
                                                            <a href="javascript:void(0);" class="read-more"
                                                                data-toggle="comment-<?php echo e($reply?->id); ?>"
                                                                style="display: none;">
                                                                <?php echo e(__('ticket::static.ticket.read_more')); ?>

                                                            </a>
                                                            <a href="javascript:void(0);" class="read-less"
                                                                data-toggle="comment-<?php echo e($reply?->id); ?>"
                                                                style="display: none;">
                                                                <?php echo e(__('ticket::static.ticket.read_less')); ?>

                                                            </a>
                                                            <?php
                                                                $images = $reply->getMedia('attachment');
                                                                $attachmentCounts = $images->count();
                                                            ?>
                                                            <?php if($attachmentCounts > 0): ?>
                                                                <div class="attachemnt-counts mt-2">
                                                                    <p><?php echo e($attachmentCounts); ?> Attachments</p>
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="attachment-box mt-2">
                                                                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php
                                                                        $sizeInKB = number_format(
                                                                            $image->size / 1024,
                                                                            2,
                                                                        );
                                                                        $sizeInMB = number_format(
                                                                            $image->size / (1024 * 1024),
                                                                            2,
                                                                        );
                                                                    ?>
                                                                    <div class="d-flex">
                                                                        <a href="<?php echo e(route('admin.ticket.file.download', ['mediaId' => $image->id])); ?>"
                                                                            class="btn btn-outline">
                                                                            <?php echo e($image->name); ?>

                                                                            <i class="ri-arrow-down-circle-line"></i>
                                                                        </a>
                                                                        <small class="text-gray"
                                                                            style="font-size: 0.9em;">Size:
                                                                            <?php echo e($sizeInKB); ?> KB (<?php echo e($sizeInMB); ?>

                                                                            MB)</small>
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contentbox">
                    <div class="inside">
                        <div class="contentbox-title">
                            <h3><?php echo e(__('ticket::static.ticket_information.title')); ?></h3>
                        </div>
                        <div class="detail-card">
                            <ul class="detail-list">
                                <li class="detail-item">
                                    <h5><?php echo e(__('ticket::static.ticket_information.ticket_id')); ?></h5>
                                    <span class="bg-light-primary">
                                        #<?php echo e($ticket?->ticket_number); ?>

                                    </span>
                                </li>
                                <li class="detail-item">
                                    <h5><?php echo e(__('ticket::static.ticket_information.ticket_department')); ?></h5>
                                    <span><?php echo e($ticket?->department->name); ?></span>
                                </li>
                                <li class="detail-item">
                                    <h5><?php echo e(__('ticket::static.ticket_information.ticket_priority')); ?></h5>
                                    <span
                                        class="badge badge-<?php echo e($ticket?->priority->color); ?>"><?php echo e($ticket?->priority->name); ?></span>
                                </li>
                                <li class="detail-item">
                                    <h5><?php echo e(__('ticket::static.ticket_information.ticket_open_date')); ?></h5>
                                    <span><?php echo e($ticket?->created_at->format('Y-m-d')); ?></span>
                                </li>
                                <li class="detail-item">
                                    <h5><?php echo e(__('ticket::static.ticket_information.ticket_status')); ?></h5>
                                    <span
                                        class="badge badge-<?php echo e($ticket?->ticketStatus->color); ?>"><?php echo e($ticket?->ticketStatus->name); ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade assign-modal" id="assign">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('ticket::static.assign_ticket.assign')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-start">
                    <form action="<?php echo e(route('admin.ticket.assign')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('POST'); ?>
                        <input type="hidden" name="user_id" id="user_id" value="">
                        <input type="hidden" name="ticket_id" value="<?php echo e($ticket?->id); ?>">
                        <div class="form-group row">
                            <label class="col-md-2"
                                for="message"><?php echo e(__('ticket::static.assign_ticket.message')); ?></label>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="3" name="note"
                                    placeholder="<?php echo e(__('ticket::static.assign_ticket.enter_message')); ?>"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2"
                                for="priority_id"><?php echo e(__('ticket::static.assign_ticket.priority')); ?></label>
                            <div class="col-md-10 select-label-error">
                                <select class="select-2 form-control" name="priority_id">
                                    <?php $__currentLoopData = $priorities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priority): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($priority->id); ?>"
                                            <?php if($ticket?->priority->id == $priority->id): ?> selected <?php endif; ?>><?php echo e($priority->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="submit-btn">
                                    <button type="submit" name="save" class="btn btn-solid spinner-btn">
                                        <?php echo e(__('ticket::static.assign_ticket.assign_btn')); ?>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-center-modal delete-modal" id="confirmation">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?php echo e(route('admin.ticket.destroy', $ticket?->id)); ?>" method="get" id="delete-form">
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
                                data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                            <button type="submit" class="btn btn-primary delete spinner-btn"
                                data-delete-id=""><?php echo e(__('Delete')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Rating Modal -->
    <div class="modal fade" id="ratingModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ratingModalLabel"><?php echo e(__('ticket::static.rating.rate_agents')); ?></h5>
                    <button type="button" class="close" data-bs-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="ratingForm" action="<?php echo e(route('admin.rating.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('POST'); ?>
                        <input type="hidden" name="ticket_id" value="<?php echo e($ticket?->id); ?>">
                        <div class="form-group row">
                            <label class="col-md-2" for="rating">Executives:</label>
                            <div class="col-md-10 select-label-error">
                                <select class="select-2 form-control" name="rating" id="rating"
                                    data-placeholder="Select Ratings">
                                    <option class="select-placeholder" value=""></option>
                                    <?php $__empty_1 = true; $__currentLoopData = [1 => '1 Star', 2 => '2 Star', 3 => '3 Star', 4 => '4 Star', 5 => '5 Star' ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <option value=<?php echo e($key); ?>><?php echo e($option); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <option value="" disabled></option>
                                    <?php endif; ?>
                                </select>
                                <?php $__errorArgs = ['rating'];
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
                                    <button type="submit" name="save" class="btn btn-solid spinner-btn">
                                        <?php echo e(__('ticket::static.submit')); ?>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        (function($) {
            "use strict";
            $('#ratingForm').validate({
                rules: {
                    "rating": {
                        required: true,
                        number: true,
                        range: [1, 5]
                    }

                },
                messages: {
                    "rating": {
                        required: "Please select a rating for agents.",
                        number: "Please select a valid rating.",
                        range: "Rating must be between 1 and 5."
                    }
                },
            });
            $(document).ready(function() {
                $(document).on('click', '#ticket-reply', function() {
                    $('#ticket-reply-box').show();
                });

                $(document).on('click', '#assign-user', function() {
                    const modal = new bootstrap.Modal(document.getElementById('assign'));
                    modal.show();
                    let selectedUsers = $('.assign-select').val();
                    $('#user_id').val(selectedUsers);
                });

                $(document).on('change', '#image-upload', function() {
                    var files = $(this)[0];


                    var maxSize = $(this).data('size');
                    console.log('max size is', maxSize);

                    var maxFiles = $(this).data('max');
                    console.log('max files is', maxFiles);

                    var allowedTypes = $(this).data('types').split(',').map(function(type) {
                        return type.trim().toLowerCase();
                    });

                    var fileCount = files.files.length;
                    console.log('file  count is', fileCount);

                    console.log(files.files.length > maxFiles);

                    if (files.files.length > maxFiles) {
                        $('.invalid-feedback').show();
                        $('.image-upload-error').text('You can only upload up to ' + maxFiles +
                            ' files.');
                        $(this).val('');
                    } else {
                        for (var i = 0; i < fileCount; i++) {
                            var file = files.files[i];
                            console.log('file in the array', file);

                            var fileExtension = file.name.split('.').pop().toLowerCase();
                            var fileSize = file.size;

                            if (!allowedTypes.includes(fileExtension)) {
                                $('.invalid-feedback').show();
                                $('.image-upload-error').text('File "' + file.name +
                                    '" has an invalid extension. Allowed extensions are: ' +
                                    allowedTypes.join(', ') + '.');
                            }

                            if (fileSize > maxSize) {
                                $('.invalid-feedback').show();
                                $('.image-upload-error').text('File "' + file.name +
                                    '" exceeds the maximum size of ' + (maxSize / 1024 / 1024)
                                    .toFixed(2) + ' MB.');
                            }
                        }
                    }

                });

                $(document).ready(function() {
                    function checkOverflow(element) {
                        return element.scrollHeight > element.clientHeight;
                    }

                    $('.comment').each(function() {
                        var $commentText = $(this).find('.comment-text');
                        var $readMore = $(this).find('.read-more');
                        var $readLess = $(this).find('.read-less');

                        if (checkOverflow($commentText[0])) {
                            $readMore.show();
                        }

                        $readMore.click(function() {
                            $commentText.addClass('expanded');
                            $readMore.hide();
                            $readLess.show();
                        });

                        $readLess.click(function() {
                            $commentText.removeClass('expanded');
                            $readMore.show();
                            $readLess.hide();
                        });
                    });
                });

                $(document).ready(function() {
                    var userRole = "<?php echo e(getCurrentRoleName()); ?>";

                    $('#replyForm').on('submit', function(event) {
                        event.preventDefault();

                        const form = $(this);
                        // let message = $(this).find('textarea[name="message"]').val().trim();
                        // if (message === '') {
                        //     event.preventDefault(); // Stop the form from submitting
                        //     alert('The message field is required!'); // Show an error message
                        // }

                        let message = form.find('textarea[name="message"]').val();
                        message = message.replace(/<\/?p>/g, "");
                        form.find('textarea[name="message"]').val(message);
                        const formData = new FormData(this);

                        const submitButton = form.find('button[type="submit"]');
                        submitButton.prop('disabled', true);
                        submitButton.html('<i class="ri-loader-line ri-spin"></i> Sending...');

                        $.ajax({
                            url: form.attr('action'),
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                checkTicketRatings(<?php echo e($ticket?->id); ?>);
                            },
                            error: function(xhr) {
                                console.log('An error occurred:', xhr.responseText);
                            }
                        });
                    });

                    function checkTicketRatings(ticketID) {
                        $.ajax({
                            url: '<?php echo e(url('admin/rating/ticket-status')); ?>/' + ticketID,
                            type: 'GET',
                            success: function(response) {
                                if (response == true) {
                                    if (userRole === 'user') {
                                        const modal = new bootstrap.Modal(document
                                            .getElementById('ratingModal'));
                                        modal.show();
                                    }
                                } else {
                                    location.reload();
                                }
                            }
                        });
                    }

                    function getRatings(ticketID) {

                        $.ajax({
                            url: '<?php echo e(url('admin/rating/ticket-status')); ?>/' + ticketID,
                            type: 'GET',
                            success: function(response) {
                                if (response == true) {
                                    if (userRole === 'user') {
                                        const modal = new bootstrap.Modal(document
                                            .getElementById('ratingModal'));
                                        modal.show();
                                    }
                                }
                            }
                        });
                    }

                    setTimeout(function() {
                        getRatings(<?php echo e($ticket?->id); ?>)
                    }, 200000);
                });
            });
        })(jQuery);



        (function($) {
            "use strict";
            $('#replyForm').validate({
                rules: {
                    "message": {
                        required: true,
                    }

                },
                messages: {
                    "message": {
                        required: "Description  is Required",
                    }
                },
            })
        })(jQuery);
        // // Add an event listener to the form on submission.
        // $('#replyForm').on('submit', function(event) {
        //     let message = $(this).find('textarea[name="message"]').val().trim(); // Use .trim() to remove whitespace

        //     // Check if the message is empty or only contains whitespace
        //     if (message === '') {
        //         event.preventDefault(); // Stop the form from submitting
        //         alert('The message field is required!'); // Show an error message

        //         // You could also add custom styling to an error message element
        //         // For example: $('#error-message').text('Please enter a message.').show();
        //     }
        // });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Ticket/resources/views/admin/ticket/reply.blade.php ENDPATH**/ ?>