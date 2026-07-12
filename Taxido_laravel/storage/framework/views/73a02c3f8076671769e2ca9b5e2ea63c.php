<?php $__env->startSection('title', __('static.system_tools.backup')); ?>

<?php $__env->startSection('content'); ?>
    <div class="contentbox">
        <div class="inside">
            <div class="contentbox-title">
                <div class="contentbox-subtitle">
                    <h3><?php echo e(__('static.system_tools.backup')); ?></h3>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('system-tool.create')): ?>
                        <button type="button" id="add-backup" class="btn btn-outline">
                            <i class="ri-add-line"></i> <?php echo e(__('static.system_tools.create_backup')); ?>

                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Add Backup Modal -->
            <div class="modal fade confirmation-modal" id="confirmation">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h5 class="modal-title m-0"><?php echo e(__('static.system_tools.create_backup')); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="<?php echo e(route('admin.backup.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('POST'); ?>
                            <div class="modal-body text-start backup-form">
                                <div class="floating-label form-group">
                                    <input type="text" id="title" class="form-control" name="title"
                                        placeholder=" ">
                                    <label><?php echo e(__('static.system_tools.title')); ?></label>
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
                                <div class="floating-label form-group">
                                    <textarea id="floating-name" class="form-control" rows="3" name="description" placeholder="" cols="80"></textarea>
                                    <label for="description"><?php echo e(__('static.system_tools.description')); ?></label>
                                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group">
                                    <label for="backup_type"><?php echo e(__('static.system_tools.backup_type')); ?></label>
                                    <div>
                                        <select class="form-control select-2" name="backup_type" id="backup_type">
                                            <option value="db"><?php echo e(__('static.system_tools.db')); ?></option>
                                            <option value="media"><?php echo e(__('static.system_tools.media')); ?></option>
                                            <option value="files"><?php echo e(__('static.system_tools.files')); ?></option>
                                            <option value="both"><?php echo e(__('static.system_tools.both')); ?></option>
                                        </select>
                                        <?php $__errorArgs = ['backup_type'];
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
                            </div>
                            <div class="modal-footer">
                                <div class="submit-btn">
                                    <button type="submit" name="save" class="btn btn-solid spinner-btn">
                                        <?php echo e(__('static.submit')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-main email-template-table template-table m-0">
                <div class="table-responsive custom-scrollbar m-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><?php echo e(__('static.notify_templates.title')); ?></th>
                                <th><?php echo e(__('static.notify_templates.description')); ?></th>
                                <th><?php echo e(__('static.created_at')); ?></th>
                                <th><?php echo e(__('static.notify_templates.action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $backups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $backup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($backup->title); ?></td>
                                    <td><?php echo e($backup->description); ?></td>
                                    <td><?php echo e($backup->created_at->format('Y-m-d h:i:s A')); ?></td>
                                    <td>                           
                                        <div class="icon-box d-inline-flex gap-2">
                                            <div class="d-flex gap-2">
                                                <?php if(!empty($backup->file_path['db'])): ?>
                                                    <div>
                                                        <a href="<?php echo e(route('admin.backup.downloadDbBackup', $backup->id)); ?>"
                                                            class="dark-icon-box" data-bs-toggle="tooltip" title="Database">
                                                            <i class="ri-download-2-line" alt="no-data"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(!empty($backup->file_path['files'])): ?>
                                                    <div>
                                                        <a href="<?php echo e(route('admin.backup.downloadFilesBackup', $backup->id)); ?>"
                                                            class="dark-icon-box" data-bs-toggle="tooltip" title="Files">
                                                            <i class="ri-file-download-line" alt="no-data"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(!empty($backup->file_path['media'])): ?>
                                                    <div>
                                                        <a href="<?php echo e(route('admin.backup.downoadUploadsBackup', $backup->id)); ?>"
                                                            class="dark-icon-box" data-bs-toggle="tooltip" title="Media">
                                                            <i class="ri-folder-download-line" alt="no-data"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="d-flex gap-2">
                                                <?php if(!empty($backup->file_path['db']) && !empty($backup->file_path['media'])): ?>
                                                    <div>
                                                        <a href="javascript:void(0)" class="dark-icon-box"
                                                            data-bs-toggle="tooltip" title="Restore"
                                                            onclick="showRestoreModal('<?php echo e(route('admin.backup.restoreBackup', $backup->id)); ?>')">
                                                            <i class="ri-arrow-turn-forward-line" alt="no-data"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(!empty($backup->file_path)): ?>
                                                    <div>
                                                        <a href="javascript:void(0)" class="dark-icon-box"
                                                            data-bs-toggle="tooltip" title="Delete Backup"
                                                            onclick="showDeleteModal('<?php echo e(route('admin.backup.deleteBackup', $backup->id)); ?>')">
                                                            <i class="ri-delete-bin-line" alt="no-data"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade delete-modal" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-start confirmation-data delete-data">
                    <div class="main-img">
                        <div class="delete-icon">
                            <img src="<?php echo e(asset('images/info-circle.svg')); ?>" />
                        </div>
                    </div>
                    <h4 class="modal-title"><?php echo e(__('static.system_tools.confirm_delete_backup')); ?></h4>
                    <p><?php echo e(__('static.system_tools.delete_backup_warning_message')); ?></p>
                    <div class="d-flex">
                        <input type="hidden" id="inputType" name="type" value="">
                        <button type="button" class="btn cancel btn-light me-2 w-100" data-bs-dismiss="modal">
                            <a href="" class="btn-close"></a><?php echo e(__('static.cancel')); ?>

                        </button>
                        <form id="deleteForm" class="w-100" action="" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-secondary delete spinner-btn delete-btn">
                                <i class="ri-delete-bin-5-line"></i><?php echo e(__('static.delete')); ?>

                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Restore Modal -->
    <div class="modal fade restore-modal" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-start confirmation-data restore-data">
                    <div class="main-img">
                        <div class="restore-icon">
                            <img src="<?php echo e(asset('images/info-circle.svg')); ?>" />
                        </div>
                    </div>
                    <h4 class="modal-title"><?php echo e(__('static.system_tools.confirm_restore_backup')); ?></h4>
                    <p><?php echo e(__('static.system_tools.restore_backup_warning_message')); ?></p>
                    <div class="d-flex">
                        <input type="hidden" id="inputType" name="type" value="">
                        <button type="button" class="btn cancel btn-light me-2 w-100" data-bs-dismiss="modal">
                            <a href="" class="btn-close"></a><?php echo e(__('static.cancel')); ?>

                        </button>
                        <form id="restoreForm" class="w-100" action="" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('GET'); ?>
                            <button type="submit" class="btn btn-secondary restore spinner-btn restore-btn">
                                <i class="ri-arrow-turn-forward-line"></i><?php echo e(__('static.submit')); ?>

                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        
        $(document).ready(function() {
            $('#add-backup').on('click', function() {
                var myModal = new bootstrap.Modal(document.getElementById("confirmation"), {});
                myModal.show();
            });
        });

        // Show Restore Modal
        function showRestoreModal(restoreUrl) {
            $('#restoreForm').attr('action', restoreUrl);
            $('#restoreModal').modal('show');
        }

        // Show Delete Modal
        function showDeleteModal(deleteUrl) {
            $('#deleteForm').attr('action', deleteUrl);
            $('#deleteModal').modal('show');
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/system-tool/backup.blade.php ENDPATH**/ ?>