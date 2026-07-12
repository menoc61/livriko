<?php $__env->startSection('title', __('static.media.media')); ?>
<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/vendors/dropzone.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="contentbox">
    <div class="inside">
        <div class="contentbox-title">
            <div class="contentbox-subtitle">
                <h3><?php echo e(__('static.media.media_library')); ?></h3>
                <a href="javascript:void(0)" class="btn btn-outline addNewMedia"><i class="ri-add-line"></i>
                    <?php echo e(__('static.media.add_new')); ?></a>
            </div>
        </div>
        <div class="media-dropzone p-0">
            <form action="<?php echo e(route('admin.media.store')); ?>" method="POST" class="digits files form-container dropzone"
                id="media-dropzone">
                <?php echo csrf_field(); ?>
                <div class="upload-files-container">
                    <div class="dz-message needsclick">
                        <span class="upload-icon"><i class="ri-upload-2-line"></i></span>
                        <h3><?php echo e(__('static.media.drop_files_to_upload')); ?></h3>
                        <div class="flex-center gap-2">
                            <button type="button" class="browse-files"><?php echo e(__('static.media.select_files')); ?></button>
                        </div>
                    </div>
                </div>
                <i class="ri-close-line media-close"></i>
            </form>
        </div>
        <div class="media-main">
            <div class="table-top-panel bg-grey-part mode-select">
                <div class="top-part">
                    <div class="top-part-left m-0">
                        <div class="media-grid-view">
                            <a href="<?php echo e(url()->current() . '?mode=list'); ?>"
                                class="view-list <?php if(!request()->filled('mode') || (request()->filled('mode') && request()->mode == 'list')): ?> current <?php endif; ?>">
                                <i class="ri-table-view"></i>
                            </a>
                            <a href="<?php echo e(url()->current() . '?mode=grid'); ?>"
                                class="view-grid <?php if(request()->filled('mode') && request()->mode == 'grid'): ?> current <?php endif; ?>">
                                <i class="ri-layout-grid-line"></i>
                            </a>
                        </div>
                        <form class="search-form d-flex align-items-center gap-2 m-0">
                            <div>
                                <input type="hidden" name="mode" value="<?php echo e(request()->mode); ?>">
                                <input type="hidden" name="s" value="<?php echo e(request()->s); ?>">
                                <select class="form-select" name="type">
                                    <option value="" <?php echo e(request()->type == '' ? 'selected' : ''); ?>>
                                        <?php echo e(__('static.media.all_media')); ?>

                                    </option>
                                    <option value="image" <?php echo e(request()->type == 'image' ? 'selected' : ''); ?>>
                                        <?php echo e(__('static.media.images')); ?>

                                    </option>
                                    <option value="audio" <?php echo e(request()->type == 'audio' ? 'selected' : ''); ?>>
                                        <?php echo e(__('static.media.audio')); ?>

                                    </option>
                                    <option value="video" <?php echo e(request()->type == 'video' ? 'selected' : ''); ?>>
                                        <?php echo e(__('static.media.video')); ?>

                                    </option>
                                    <option value="text" <?php echo e(request()->type == 'text' ? 'selected' : ''); ?>>
                                        <?php echo e(__('static.media.documents')); ?>

                                    </option>
                                </select>
                            </div>
                            <button type="submit"
                                class="btn btn-outline applyAction"><?php echo e(__('static.media.apply')); ?></button>
                        </form>
                        <?php if(request()->filled('mode') && request()->mode == 'grid'): ?>
                        <?php endif; ?>
                        <?php if(request()->filled('mode') && request()->mode == 'grid' && $files->isNotEmpty()): ?>
                        <button type="submit" class="btn btn-outline applyAction"
                            id="Bulk_select"><?php echo e(__('Bulk select')); ?></button>
                        <?php endif; ?>
                        <a href="javascript:void(0)" id="multiDeleteBtn" class="btn btn-solid d-none"
                            data-url="<?php echo e(route('admin.media.deleteAll')); ?>">
                            <?php echo e(__('static.media.delete_permanently')); ?><span id="count-selected-items">(0)</span>
                        </a>
                        <a href="javascript:void(0)" id="CancelButton" class="btn btn-outline d-none">
                            <?php echo e(__('static.cancel')); ?>

                        </a>
                        <a href="javascript:void(0)" id="deleteAllButton" class="btn btn-outline d-none">
                            <?php echo e(__('static.deleteAll')); ?>

                        </a>
                    </div>
                    <div class="top-part-right mb-0">
                        <form class="search-form d-flex align-items-center gap-2 m-0">
                            <input type="hidden" name="mode" value="<?php echo e(request()->mode); ?>">
                            <input type="hidden" name="type" value="<?php echo e(request()->type); ?>">
                            <input type="text" id="search-image" name="s" value="<?php echo e(request()->s); ?>"
                                class="form-control search-input">
                            <button type="submit" class="btn btn-outline search-input search-image"><?php echo e(__('static.media.search')); ?></button>
                            <button type="button" class="btn btn-primary" id="clear" style="display: none"><?php echo e(__('static.clear')); ?></button>
                            <i class="ri-search-line" icon-name="search-normal-2"></i>
                        </form>
                    </div>
                </div>
            </div>
            <?php if(request()->filled('mode') && request()->mode == 'grid'): ?>
            <div class="media-wrapper custom-scrollbar">
                <div
                    class="row row-cols-xxl-6 row-cols-xl-5 row-cols-lg-4 row-cols-sm-3 row-cols-2 g-sm-3 g-2 media-card">
                    <?php $__empty_1 = true; $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="media card">
                        <input type="checkbox" class="form-check-input" name="attachment"
                            id="attachment-list-<?php echo e($key); ?>" value="<?php echo e($file?->id); ?>" disabled>
                        <button type="button" class="btn media-modal-btn" data-bs-toggle="modal"
                            data-bs-target="#mediaModal<?php echo e($file?->id); ?>">
                        </button>
                        <label for="attachment-list-<?php echo e($key); ?>" class="opacity">
                            <div class="media-image ratio ratio-1x1">
                                <img src="<?php echo e(substr($file?->mime_type, 0, 5) == 'image'
                                                ? getImageUrl($file->original_url)
                                                : asset($file?->mime_type !== null ? getMediaMimeTypePathByType($file?->mime_type) : 'images/file-icon/default.png')); ?>"
                                    alt="avatar" class="view-img" loading="lazy" decoding="async">
                            </div>
                            <?php if(substr($file->mime_type, 0, 5) != 'image'): ?>
                            <div class="filename">
                                <div><?php echo e($file?->file_name); ?></div>
                            </div>
                            <?php endif; ?>
                        </label>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="no-data-detail">
                        <img class="h-auto" src="<?php echo e(asset('images/no-data.png')); ?>" loading="lazy" alt="no-data">
                        <div class="data-not-found">
                            <span><?php echo e(__('static.media.media_not_found')); ?></span>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="pagination-container mt-4">
                <?php echo e($files?->appends(['mode' => 'grid'])?->links()); ?>

            </div>
            <?php else: ?>
            <div class="media-table mt-4">
                <?php if (isset($component)) { $__componentOriginal163c8ba6efb795223894d5ffef5034f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal163c8ba6efb795223894d5ffef5034f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table.index','data' => ['columns' => $tableConfig['columns'],'data' => $tableConfig['data'],'actions' => $tableConfig['actions'],'total' => $tableConfig['total'],'bulkactions' => $tableConfig['bulkactions'],'search' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableConfig['columns']),'data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableConfig['data']),'actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableConfig['actions']),'total' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableConfig['total']),'bulkactions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tableConfig['bulkactions']),'search' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $attributes = $__attributesOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $component = $__componentOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__componentOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal -->
<?php if(request()->filled('mode') && request()->mode == 'grid'): ?>
<?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade media-modal-box" id="mediaModal<?php echo e($file?->id); ?>" tabindex="-1"
    aria-labelledby="mediaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mediaModalLabel"><?php echo e(__('static.attachment_details')); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="media-attachment-detail row g-3">
                    <div class="col-lg-6">
                        <div class="left-image-box">
                            <?php
                            $mimeTypePrefix = substr($file->mime_type, 0, 5);
                            ?>
                            <?php if($mimeTypePrefix == 'image'): ?>
                            <img src="<?php echo e(getImageUrl($file->original_url)); ?>" loading="lazy" alt="avatar"
                                class="view-img" decoding="async">
                            <?php elseif($mimeTypePrefix == 'audio'): ?>
                            <audio controls class="view-audio" autoplay>
                                <source src="<?php echo e($file->original_url); ?>" type="<?php echo e($file->mime_type); ?>">
                                <?php echo e(__('static.media.audio_not_supported')); ?>

                            </audio>
                            <?php elseif($mimeTypePrefix == 'video'): ?>
                            <video controls class="view-video" autoplay muted>
                                <source src="<?php echo e($file->original_url); ?>" type="<?php echo e($file->mime_type); ?>">
                                <?php echo e(__('static.media.video_not_supported')); ?>

                            </video>
                            <?php else: ?>
                            <img src="<?php echo e(asset($file?->mime_type !== null ? getMediaMimeTypePathByType($file?->mime_type) : 'images/file-icon/default.png')); ?>"
                                alt="default" class="view-img" loading="lazy">
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <table class="product-page-width">
                            <tbody>
                                <tr>
                                    <td><span><?php echo e(__('static.media.uploaded_by')); ?> :</span></td>
                                    <td>
                                        <p><a href="#!"></a><?php echo e($file?->created_by?->name); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span><?php echo e(__('static.media.uploaded_to')); ?> :</span></td>
                                    <td class="txt-success">
                                        <p><a href="#!"></a><?php echo e($file?->name); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span><?php echo e(__('static.media.file_name')); ?> :</span></td>
                                    <td>
                                        <p><?php echo e($file?->file_name); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span><?php echo e(__('static.media.file_type')); ?> :</span></td>
                                    <td>
                                        <p><?php echo e($file?->mime_type); ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span><?php echo e(__('static.media.file_size')); ?> :</span></td>
                                    <td>
                                        <p><?php echo e(convertFileSize($file?->size)); ?></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="attachment-info">
                            <div class="settings">
                                <form action="<?php echo e(route('admin.media.update', $file->id)); ?>" method="post" class="m-0">
                                    <?php echo method_field('PUT'); ?>
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group row g-lg-4 g-3">
                                        
                                    <div class="col-sm-6">
                                        <label for="title"><?php echo e(__('static.media.title')); ?></label>
                                        <div class="position-relative">
                                            <input class="form-control" type="title" name="title"
                                                value="<?php echo e($file?->name); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="file_url"><?php echo e(__('static.media.file_url')); ?>:</label>
                                        <div class="position-relative file-url">
                                            <input class="form-control" type="text" name="file_url"
                                                value="<?php echo e($file?->original_url); ?>" id="copyUrl-<?php echo e($key); ?>" readonly>
                                            <button type="button" class="btn copy-btn copyUrl">copy</button>
                                        </div>
                                    </div>
                            </div>

                            <!-- Move the submit button inside the form -->
                            <div class="submit-btn">
                                <button type="submit" name="save" class="btn btn-solid spinner-btn">
                                    <?php echo e(__('static.save')); ?>

                                </button>
                            </div>
                            </form>
                        </div>

                        <ul class="info-action">
                            <li class="download">
                                <a href="<?php echo e($file?->original_url); ?>"
                                    download><?php echo e(__('static.media.download_file')); ?></a>
                            </li>
                            <li class="delete">
                                <a
                                    href="<?php echo e(route('admin.media.forceDelete', $file->id)); ?>"><?php echo e(__('static.media.delete_permanently')); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<!-- Dropzone js -->
<script></script>
<script>
    (function($) {
        // Cache frequently accessed elements
        var $mediaDropzone = $('.media-dropzone');
        var $countSelectedItems = $('#count-selected-items');
        var $multiDeleteBtn = $('#multiDeleteBtn');
        var $csrfToken = $('meta[name="csrf-token"]').attr('content');
        var $BulkSelect = $('#Bulk_select');
        var $CancelButton = $('#CancelButton');
        var $deleteAllButton = $('#deleteAllButton');
        var $copyUrl = $('.copyUrl');
        // Toggle media dropzone visibility
        $('.addNewMedia, .media-close').on('click', function() {
            $mediaDropzone.toggleClass('show');
        });

        DropzoneComponents.init();

        // Init dropzone instance
        Dropzone.autoDiscover = false
        const myDropzone = new Dropzone('#media-dropzone', {
            autoProcessQueue: true,
            parallelUploads: 1, // Process one file at a time to avoid overwhelming the server
            init: function() {
                this.on("addedfile", function(file) {
                    // Optionally, you can add a message or visual feedback here
                    console.log("File added: " + file.name);
                });
                this.on("success", function(file) {
                    // Reload the page when all files are uploaded
                    if (this.getQueuedFiles().length === 0 && this.getUploadingFiles().length === 0) {
                        window.location.reload();
                    }
                });
            }
        })

        function getQueryParam(param) {
            var urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        var mode = getQueryParam('mode');

        if (mode && mode === 'grid') {
            $BulkSelect.show();
        } else {
            $BulkSelect.hide();
        }

        myDropzone.on("success", function(file) {
            if (myDropzone.getQueuedFiles().length === 0 && myDropzone.getUploadingFiles().length === 0) {
                window.location.reload();
            }
        });


        /** Delete Media **/
        // Track selected items and update UI
        var selectedItems = [];
        $('input[name="attachment"]').on('change', function() {

            var itemId = $(this).val();
            if ($(this).is(':checked')) {
                selectedItems.push(itemId);
            } else {
                selectedItems = selectedItems.filter(item => item !== itemId);
            }

            if (selectedItems.length > 0) {
                $countSelectedItems.text('(' + selectedItems.length + ')');
                $multiDeleteBtn.removeClass('d-none');
            } else {
                $multiDeleteBtn.addClass('d-none');
            }
        });


        $deleteAllButton.on('click', function(e) {
            selectedItems = [];

            $('.form-check-input').each(function() {
                $(this).prop('checked', true);
                var itemId = $(this).val();
                if (!selectedItems.includes(itemId)) {
                    selectedItems.push(itemId);
                }
            });

            if (selectedItems.length > 0) {
                $countSelectedItems.text('(' + selectedItems.length + ')');
                $multiDeleteBtn.removeClass('d-none');
            } else {
                $multiDeleteBtn.addClass('d-none');
            }
        });

        $multiDeleteBtn.on('click', function(e) {
            e.preventDefault();

            var url = $(this).data('url');
            if (selectedItems.length > 0) {

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        ids: selectedItems,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $csrfToken
                    },
                    success: function(data) {

                        window.location.reload();
                    },
                });
            }
        });

        $BulkSelect.on('click', function(e) {
            selectedItems = [];
            $(".form-check-input").prop("disabled", false);
            $(".media-modal-btn").prop("disabled", true);

            $('.opacity').addClass('opacity-65');
            $('#CancelButton').removeClass('d-none');
            $('#deleteAllButton').removeClass('d-none');

            $('.ri-table-view, .ri-layout-grid-line, .form-select, .applyAction').addClass('d-none');
        })

        $CancelButton.on('click', function(e) {

            $('.form-check-input:checked').each(function() {
                var checkboxId = $(this).attr('id');
                $('#' + checkboxId).prop('checked', false);
            });

            $multiDeleteBtn.addClass('d-none');
            $('#CancelButton').addClass('d-none');
            $('#deleteAllButton').addClass('d-none');
            $('.opacity').removeClass('opacity-65');
            $('.ri-table-view, .ri-layout-grid-line, .form-select, .applyAction').removeClass('d-none');

            $(".form-check-input").prop("disabled", true);
            $(".media-modal-btn").prop("disabled", false);
        })

        $copyUrl.on('click', function(e) {
            const id = $(this).siblings('input').attr('id');
            const $input = $('#' + id);
            $input.select();
            document.execCommand('copy');
        })

        // Clear the input field when the user navigates back in the browser
        $(window).on('popstate', function() {
            if (!getUrlParameter('s')) {
                $('.search-input').val('');
            }
        });

        $('#clear').click(function() {
            $('.search-input').val('');
            window.location.href = window.location.pathname;
        });

        if ($('.search-input').val().trim() !== '') {
            $('#clear').show();
        }

    })(jQuery);
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/media/index.blade.php ENDPATH**/ ?>