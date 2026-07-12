<?php $__env->startSection('title', __('static.systems.about')); ?>
<?php $__env->startSection('content'); ?>
    <div class="row g-xl-4 g-3">
        <div class="col-xl-9">
            <div class="left-part">
                <!-- PHP Configuration Section -->
                <div class="contentbox">
                    <div class="accordion system-accordion" id="phpConfig">
                        <div class="inside">
                            <div class="accordion-item">
                                <div class="accordion-header contentbox-title pb-0">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#phpConfigCollapse" aria-expanded="false"
                                        aria-controls="phpConfigCollapse">
                                        <h3><?php echo e(__('static.systems.php_config')); ?></h3>
                                    </button>
                                </div>
                                <div id="phpConfigCollapse" class="accordion-collapse collapse show"
                                    data-bs-parent="#phpConfig">
                                    <div class="accordion-body table-main table-about">
                                        <div class="table-responsive custom-scrollbar">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo e(__('static.systems.config_name')); ?></th>
                                                        <th><?php echo e(__('static.systems.current')); ?></th>
                                                        <th><?php echo e(__('static.systems.recommended')); ?></th>
                                                        <th><?php echo e(__('static.systems.status')); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $prerequisites['configurations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $config): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e(ucfirst(str_replace('_', ' ', $name))); ?></td>
                                                            <td><?php echo e($config['current']); ?></td>
                                                            <td><?php echo e($config['recommended']); ?></td>
                                                            <td>
                                                                <span
                                                                    class="<?php echo e(($config['status'] ?? 'N/A') === '✓' ? 'true' : 'false'); ?>"><?php echo e($config['status'] ?? 'N/A'); ?></span>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Extensions Section -->
                <div class="contentbox">
                    <div class="accordion system-accordion" id="extension">
                        <div class="inside">
                            <div class="accordion-item">
                                <div class="accordion-header contentbox-title pb-0">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#extensionCollapse" aria-expanded="false"
                                        aria-controls="extensionCollapse">
                                        <h3><?php echo e(__('static.systems.extensions')); ?></h3>
                                    </button>
                                </div>
                                <div id="extensionCollapse" class="accordion-collapse collapse show"
                                    data-bs-parent="#extension">
                                    <div class="accordion-body table-main table-about">
                                        <div class="table-responsive custom-scrollbar">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo e(__('static.systems.extension_name')); ?></th>
                                                        <th><?php echo e(__('static.systems.status')); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $prerequisites['extensions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $config): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e(ucfirst($name)); ?></td>
                                                            <td>
                                                                <span
                                                                    class="<?php echo e(($config['status'] ?? 'N/A') === '✓' ? 'true' : 'false'); ?>"><?php echo e($config['status'] ?? 'N/A'); ?></span>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3">
            <div class="p-sticky">
                <!-- Server Info Section -->
                <div class="contentbox">
                    <div class="accordion system-accordion" id="serverInfo">
                        <div class="inside">
                            <div class="accordion-item">
                                <div class="accordion-header contentbox-title pb-0">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#serverInfoCollapse" aria-expanded="false"
                                        aria-controls="serverInfoCollapse">
                                        <h3><?php echo e(__('static.systems.server_info')); ?></h3>
                                    </button>
                                </div>
                                <div id="serverInfoCollapse" class="accordion-collapse collapse show"
                                    data-bs-parent="#serverInfo">
                                    <div class="accordion-body table-main table-about">
                                        <div class="table-responsive custom-scrollbar">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo e(__('static.systems.name')); ?></th>
                                                        <th><?php echo e(__('static.systems.current')); ?></th>
                                                        <th><?php echo e(__('static.systems.recommended')); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $prerequisites['version']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $config): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e(ucfirst($name)); ?></td>
                                                            <td><?php echo e($config['current']); ?></td>
                                                            <td><?php echo e($config['recommended']); ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- File and Folder Permissions Section -->
                <div class="contentbox">
                    <div class="accordion system-accordion" id="fileFolderPermission">
                        <div class="inside">
                            <div class="accordion-item">
                                <div class="accordion-header contentbox-title pb-0">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#fileFolderPermissionCollapse" aria-expanded="false"
                                        aria-controls="fileFolderPermissionCollapse">
                                        <h3><?php echo e(__('static.systems.file_folder_permissions')); ?></h3>
                                    </button>
                                </div>
                                <div id="fileFolderPermissionCollapse" class="accordion-collapse collapse show"
                                    data-bs-parent="#fileFolderPermission">
                                    <div class="accordion-body table-main table-about">
                                        <div class="table-responsive custom-scrollbar">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo e(__('static.systems.file_folder')); ?></th>
                                                        <th><?php echo __('static.systems.status'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $prerequisites['file_permissions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $config): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($config['display_name']); ?></td>
                                                            <td>
                                                                <span
                                                                    class="<?php echo e(($config['status'] ?? 'N/A') === '✓' ? 'true' : 'false'); ?>"><?php echo e($config['status'] ?? 'N/A'); ?></span>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
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

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/about-system/index.blade.php ENDPATH**/ ?>