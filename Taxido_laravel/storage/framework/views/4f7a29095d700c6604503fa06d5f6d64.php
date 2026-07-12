<?php use \App\Helpers\Helpers; ?>
<?php use \App\Enums\RoleEnum; ?>
<?php
    $filter = request()->filled('filter') ? request()->filter : 'all';
    $roleName = getCurrentRoleName();
    $isTrashed = isset($row['deleted_at']) && !empty($row['deleted_at']);
    $mimeImageMapping = [
        'application/pdf' => 'images/file-icon/pdf.png',
        'text/csv' => 'images/file-icon/csv.png',
        'application/msword' => 'images/file-icon/word.png',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'images/file-icon/word.png',
        'application/vnd.ms-excel' => 'images/file-icon/xls.png',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'images/file-icon/xls.png',
        'application/vnd.ms-powerpoint' => 'images/file-icon/folder.png',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'images/file-icon/folder.png',
        'text/plain' => 'images/file-icon/txt.png',
        'audio/mpeg' => 'images/file-icon/sound.png',
        'audio/wav' => 'images/file-icon/sound.png',
        'audio/ogg' => 'images/file-icon/sound.png',
        'video/mp4' => 'images/file-icon/video.png',
        'video/webm' => 'images/file-icon/video.png',
        'video/ogg' => 'images/file-icon/video.png',
        'application/zip' => 'images/file-icon/zip.png',
        'application/x-tar' => 'images/file-icon/zip.png',
        'application/gzip' => 'images/file-icon/zip.png',
    ];
?>
<td>
    <?php if(!empty($column['type'])): ?>
        <?php if(isset($column['field']) && $column['type'] == 'status'): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(@$action['permission'])): ?>
                <label class="switch switch-sm">
                    <input id="status-<?php echo e($row['id']); ?>"
                        <?php if(isset($column['route'])): ?> data-route="<?php echo e(route($column['route'], $row['id'])); ?>" <?php endif; ?>
                        class="form-check-input toggle-class" value="1" type="checkbox"
                        <?php if($row[$column['field']]): ?> checked <?php endif; ?> <?php if(request('filter') === 'trash' ||
                                !auth()->user()->can(@$column['permission'])): ?> disabled <?php endif; ?>>
                    <span class="switch-state"></span>
                </label>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies(@$action['permission'])): ?>
                <i class="ri-lock-line"></i>
            <?php endif; ?>
        <?php elseif(isset($column['field']) && $column['type'] == 'is_verified'): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(@$action['permission'])): ?>
                <label class="switch switch-sm">
                    <input id="is_verified-<?php echo e($row['id']); ?>"
                        <?php if(isset($column['route'])): ?> data-route="<?php echo e(route($column['route'], $row['id'])); ?>" <?php endif; ?>
                        class="form-check-input toggle-class <?php echo e($row[$column['field']]); ?>" value="1" type="checkbox"
                        <?php if($row[$column['field']]): ?> checked <?php endif; ?>>
                    <span class="switch-state"></span>
                </label>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies(@$action['permission'])): ?>
                <i class="ri-lock-line"></i>
            <?php endif; ?>
        <?php elseif(isset($column['field']) && $column['type'] == 'avatar'): ?>
            <?php if($row[$column['field']]): ?>
                <?php
                    $users = $row[$column['field']];
                    $totalUsers = count($users);
                    $maxVisible = 3;
                ?>
                <div class="avatar-group">
                    <?php if(is_array($users)): ?>
                        <?php if(count($users)): ?>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($index < $maxVisible): ?>
                                    <div class="avatar">
                                        <?php if($user->profile_image_id): ?>
                                            <img src="<?php echo e($user->profile_image?->original_url); ?>" alt="image" class="table-image">
                                        <?php else: ?>
                                            <div class="initial-letter"><?php echo e(substr($user->name, 0, 1)); ?></div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="">
                                <?php
                                    $remaining = $totalUsers - $maxVisible;
                                ?>
                                <?php if($remaining > 0): ?>
                                    +<?php echo e($remaining); ?>

                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                             <div>N/A</div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div>N/A</div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div>N/A</div>
            <?php endif; ?>
        <?php elseif(isset($column['field']) && $column['type'] == 'badge'): ?>
            <?php if(isset($column['colorClasses'])): ?>

                <?php if(isset($column['colorClasses'][$row[$column['field']]])): ?>
                    <div class="badge badge-<?php echo e($column['colorClasses'][$row[$column['field']]]); ?>">
                        <?php echo e($row[$column['field']]); ?>

                    </div>
                <?php endif; ?>
            <?php else: ?>
                <?php if(isset($column['badge_type'])): ?>
                    <?php if($column['badge_type'] == 'light'): ?>
                        <span class="bg-light-primary">
                            <?php echo e($row[$column['field']]); ?>

                        </span>
                    <?php else: ?>
                        <div class="badge badge-primary">
                            <?php echo e($row[$column['field']]); ?>

                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="badge badge-primary">
                        <?php echo e($row[$column['field']]); ?>

                    </div>
                <?php endif; ?>
            <?php endif; ?>
        <?php elseif((isset($actionButtons) || isset($modalActionButtons) || isset($viewActionBox)) && $column['type'] == 'action'): ?>
            <?php if(!empty($actionButtons) || !empty($modalActionButtons) || isset($viewActionBox)): ?>
                <div class="action-box">
                    <?php if(!$isTrashed): ?>
                        <?php if(is_array($actionButtons)): ?>
                            <?php $__currentLoopData = $actionButtons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actionButton): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($actionButton['permission'])): ?>
                                    <div class="icon-box">
                                        <a href="<?php echo e(isset($actionButton['route']) ? route($actionButton['route'], $row[$actionButton['field'] ?? 'id']) . (isset($actionButton['isTranslate']) && $actionButton['isTranslate'] ? '?locale=' . app()->getLocale() : '') : 'javascript:void(0)'); ?>"
                                            class="<?php echo e($actionButton['class'] ?? ''); ?>">
                                            <?php if(isset($actionButton['icon'])): ?>
                                                <i class="<?php echo e($actionButton['icon']); ?>" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" title="<?php echo e(@$actionButton['tooltip']); ?>"></i>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if(is_array($modalActionButtons)): ?>
                            <?php $__currentLoopData = $modalActionButtons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modalActionButton): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!$system_reserved): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($modalActionButton['permission'])): ?>
                                        
                                        <div class="modal-icon-box">
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-route="<?php echo e(route($modalActionButton['route'], $row['id'])); ?>"
                                                class="<?php echo e($modalActionButton['class'] ?? ''); ?>"
                                                data-bs-target="#<?php echo e($modalActionButton['modalId'] ?? ''); ?>"
                                                data-id="<?php echo e($row['id']); ?>">
                                                <?php if(isset($modalActionButton['icon'])): ?>
                                                    <i class="<?php echo e($modalActionButton['icon']); ?>"></i>
                                                <?php endif; ?>
                                            </a>
                                            <div class="modal fade text-center-modal delete-modal"
                                                id="<?php echo e($modalActionButton['modalId'] ?? ''); ?>" tabindex="-1"
                                                aria-labelledby="<?php echo e($modalActionButton['modalId'] ?? ''); ?>Label"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form method="<?php echo e($modalActionButton['modalMethod']); ?>"
                                                            action="<?php echo e(route($modalActionButton['route'], $row['id'])); ?>">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field($modalActionButton['modalMethod']); ?>
                                                            <div class="modal-body confirmation-data delete-data">
                                                                <?php if(isset($modalActionButton['icon'])): ?>
                                                                    <div class="main-img">
                                                                        <div class="delete-icon">
                                                                            <i class="<?php echo e($modalActionButton['icon']); ?>"></i>
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php if(isset($modalActionButton['modalTitle'])): ?>
                                                                    <h4 class="modal-title">
                                                                        <?php echo e($modalActionButton['modalTitle']); ?>

                                                                    </h4>
                                                                <?php endif; ?>
                                                                <?php if(isset($modalActionButton['modalDesc'])): ?>
                                                                    <p><?php echo e($modalActionButton['modalDesc']); ?></p>
                                                                <?php endif; ?>
                                                                <div class="button-box d-flex">
                                                                    <button type="button"
                                                                        class="btn cancel btn-light me-2 rejected"
                                                                        data-bs-dismiss="modal"><?php echo e(__('static.cancel')); ?></button>
                                                                    <?php if(isset($modalActionButton['modalBtnText'])): ?>
                                                                        <button class="btn btn-secondary delete delete-btn"
                                                                            type="submit"><?php echo e($modalActionButton['modalBtnText']); ?></button>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if($viewActionBox): ?>
                            <?php if ($__env->exists($viewActionBox['view'], [$viewActionBox['field'] => $row])) echo $__env->make($viewActionBox['view'], [$viewActionBox['field'] => $row], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <i class="ri-lock-line"></i>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php else: ?>
        <div <?php if(isset($column['action']) && $column['action']): ?> class="d-flex align-items-center gap-2" <?php endif; ?>>

            <?php if(isset($column['imageField']) && $row[$column['imageField']]): ?>
                <?php
                    $attachment = getMedia($row[$column['imageField']]);
                    $imageUrl = getImageUrl($attachment?->original_url);
                ?>
                <img class="table-image" src="<?php echo e($imageUrl); ?>" alt="image">
            <?php elseif(isset($column['imageUrl'])): ?>
                <img class="table-image" src="<?php echo e(getImageUrl($row[$column['imageUrl']])); ?>" alt="image">
            <?php elseif(isset($column['placeholderImage'])): ?>
                <img class="table-image" src="<?php echo e(getImageUrl(asset($column['placeholder']))); ?>" alt="placeholder">
            <?php elseif(isset($column['placeholderLetter'])): ?>
                <div class="initial-letter"><?php echo e(substr($row[$column['field']], 0, 1)); ?></div>
            <?php elseif(isset($column['mediaImage'])): ?>
                <?php
                    $file = getMedia($row[$column['mediaImage']]);
                ?>

                <img src="<?php echo e(substr($file?->mime_type, 0, 5) == 'image'
                    ? getImageUrl($file->original_url)
                    : asset($file?->mime_type !== null ? @$mimeImageMapping[$file?->mime_type] : 'images/nodata1.webp')); ?>"
                    alt="avatar" class="table-image" loading="lazy">
            <?php endif; ?>
            <?php if(isset($column['action']) && $column['action']): ?>
                <div class="user-detail">
                    <?php if(isset($column['route']) && $filter != 'trash'): ?>
                        <a href="<?php echo e(route($column['route'], $row['id'])); ?>"><?php echo e($row[$column['field']]); ?></a>
                    <?php else: ?>
                        <?php echo e($row[$column['field']]); ?>

                    <?php endif; ?>
                    <?php
                        $renderableActions = collect($actions)
                            ->filter(function ($action) use ($filter, $row) {
                                $passesFilter =
                                    empty($action['whenFilter']) ||
                                    (!empty($action['whenFilter']) && in_array($filter, $action['whenFilter']));
                                $passesStatus =
                                    !isset($action['whenStatus']) ||
                                    (isset($action['whenStatus']) && $action['whenStatus'] == $row['status']);
                                $hasPermission = auth()?->user()?->can($action['permission']);
                                return $passesFilter && $passesStatus && $hasPermission;
                            })
                            ?->isNotEmpty();
                    ?>


                    <?php if($renderableActions): ?>
                        <ul class="row-actions">
                            <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(empty($action['whenFilter']) || (!empty($action['whenFilter']) && in_array($filter, $action['whenFilter']))): ?>
                                    <?php if(!isset($action['whenStatus']) || (isset($action['whenStatus']) && $action['whenStatus'] == $row['status'])): ?>
                                        <li class="<?php echo e($action['class']); ?>">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($action['permission'])): ?>
                                                <?php if(isset($action['route'])): ?>
                                                    <?php if(isset($action['isTranslate'])): ?>
                                                        <?php
                                                            $route =
                                                                route($action['route'], $row['id']) .
                                                                '?locale=' .
                                                                app()->getLocale();
                                                        ?>
                                                        <a
                                                            href="<?php echo e($route); ?>"><span><?php echo e($action['title']); ?></span></a>
                                                    <?php else: ?>
                                                        <a
                                                            href="<?php echo e(route($action['route'], $row['id'])); ?>"><span><?php echo e($action['title']); ?></span></a>
                                                        
                                                    <?php endif; ?>
                                                <?php elseif(isset($action['action']) && isset($action['field'])): ?>
                                                    <?php if($action['action'] == 'download'): ?>
                                                        <a href="<?php echo e(getMedia($row[$action['field']])?->original_url); ?>"
                                                            download>
                                                            <span><?php echo e($action['title']); ?></span>
                                                        </a>
                                                    <?php elseif($action['action'] == 'copy'): ?>
                                                        <a href="<?php echo e(getMedia($row[$action['field']])?->original_url); ?>"
                                                            class="copy-link"
                                                            onclick="copyToClipboard(event, '<?php echo e(getMedia($row[$action['field']])?->original_url); ?>')">
                                                            <span><?php echo e($action['title']); ?></span>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php elseif(!isset($column['profile_image']) && !isset($column['email'])): ?>
                <?php echo e($row[$column['field']]); ?>

            <?php endif; ?>
            <?php if(isset($column['profile_image']) && isset($column['email'])): ?>
                <div class="d-flex align-items-center gap-2 user-name">
                    <?php if(getMedia($row[$column['profile_image']])?->original_url): ?>
                        <img class="table-image-detail"
                            src="<?php echo e(getMedia($row[$column['profile_image']])?->original_url); ?>" alt="image"
                            class="table-image">
                    <?php else: ?>
                        <div class="initial-letter"><?php echo e(substr($row[$column['field']], 0, 1)); ?></div>
                    <?php endif; ?>
                    <div class="user-details">
                        <div>
                            <?php if(isset($column['route'])): ?>
                                <?php if($row[$column['profile_id']]): ?>
                                    <?php
                                        $route = route($column['route'], $row[$column['profile_id']]);
                                    ?>
                                    <a href="<?php echo e($route); ?>" class="user-name"><?php echo e($row[$column['field']]); ?></a>
                                <?php else: ?>
                                    <h5 class="user-name"><?php echo e($row[$column['field']]); ?></h5>
                                <?php endif; ?>
                            <?php else: ?>
                                <h5 class="user-name"><?php echo e($row[$column['field']]); ?></h5>
                            <?php endif; ?>
                            <h6 class="user-email"><?php echo e($row[$column['email']]); ?></h6>
                        </div>
                        <i class="ri-file-copy-line" id="copy-icon-<?php echo e(str_replace(' ', '-', $row[$column['field']])); ?>"
                            data-email="<?php echo e($row[$column['email']]); ?>"></i>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</td>

<?php $__env->startPush('scripts'); ?>
    <script>
        function copyToClipboard(event, text) {
            event.preventDefault();

            const tempInput = document.createElement('textarea');
            tempInput.style.position = 'absolute';
            tempInput.style.left = '-9999px';
            tempInput.value = text;
            document.body.appendChild(tempInput);
            tempInput.select();
            tempInput.setSelectionRange(0, 99999);
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            toastr.success("<?php echo e(__('static.toastr.url_copied')); ?>");
        }
        var email =
            "<?php echo e(isset($column['email']) && isset($column['profile_image']) ? str_replace(' ', '-', $row[$column['field']]) : ''); ?>";
        var copyIcon = '#copy-icon-' + email;

        $(document).on('click', copyIcon, function() {
            const $icon = $(this);
            const email = $icon.data('email');
            const originalClass = $icon.attr('class');

            navigator.clipboard.writeText(email).then(() => {

                $icon.removeClass('ri-file-copy-line').addClass('ri-check-line');

                setTimeout(() => {
                    $icon.removeClass('ri-check-line').addClass('ri-file-copy-line');
                }, 700);
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        });

        $(document).ready(function() {
            $('a[data-bs-toggle="modal"]').on('click', function() {
                var route = $(this).data('route');
                var modalId = $(this).data('bs-target');
                $(modalId).find('form').attr('action', route);
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/components/table/table-body.blade.php ENDPATH**/ ?>