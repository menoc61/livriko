<?php use \App\Facades\Menu; ?>

<?php $__env->startSection('title', __('static.menus.menus')); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/menu.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="contentbox">
        <div class="inside">
            <div class="contentbox-title">
                <h3><?php echo e(__('static.menus.menus')); ?></h3>
            </div>
            <div id="hwpwrap">
                <div class="custom-wp-admin wp-admin wp-core-ui js menu-max-depth-0 nav-menus-php auto-fold admin-bar">
                    <div id="wpwrap">
                        <div id="wpcontent">
                            <div id="wpbody">
                                <div id="wpbody-content">
                                    <div class="wrap">
                                        <div class="manage-menus">
                                            <form method="get" action="<?php echo e(url()->current()); ?>" class="manage-menus-form">
                                                <label for="menu" class="selected-menu"><?php echo e(__('static.menus.select_menu_you_want_to_edit:')); ?></label>
                                                <?php echo Menu::select('menu', $menuList); ?>

                                                <span class="submit-btn">
                                                    <input id="selectMenuBtn" type="submit" class="button-secondary" value="Choose" disabled>
                                                </span>
                                                <span class="add-new-menu-action"> <?php echo e(__('static.menus.or')); ?> <a href="<?php echo e(url()->current()); ?>?action=edit&menu=0"><?php echo e(__('static.menus.create_menu')); ?></a></span>
                                            </form>
                                        </div>
                                        <div id="nav-menus-frame">
                                            <?php if(request()->has('menu') && !empty(request()->input('menu') && isset($menuName))): ?>
                                                <div id="menu-settings-column" class="metabox-holder p-sticky">
                                                    <h5 class="detail-title mt-0 mb-3"><?php echo e(__('static.menus.add_menu_items')); ?></h5>
                                                    <div class="clear"></div>
                                                    <form id="nav-menu-meta" action="" class="nav-menu-meta"
                                                        method="post" enctype="multipart/form-data">
                                                        <div id="side-sortables" class="accordion-container">
                                                            <ul class="outer-border">
                                                                <?php $__currentLoopData = @$widgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if ($__env->exists(@$widget)) echo $__env->make(@$widget, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                        </div>
                                                    </form>
                                                </div>
                                            <?php endif; ?>
                                            <div id="menu-management-liquid">
                                                <h5 class="detail-title mt-0 mb-3"> <?php echo e(__('static.menus.menu_structure')); ?> </h5>
                                                <div id="menu-management">
                                                    <form id="update-nav-menu" method="post" enctype="multipart/form-data">
                                                        <div class="menu-edit">
                                                            <div id="nav-menu-header">
                                                                <div class="major-publishing-actions">
                                                                    <label class="menu-name-label howto open-label"
                                                                        for="menu-name"> <span><?php echo e(__('static.menus.menu_name')); ?></span>
                                                                        <input name="menu-name" id="menu-name"
                                                                            type="text"
                                                                            class="menu-name regular-text menu-item-textbox"
                                                                            title="<?php echo e(__('static.menus.menu_name')); ?>"
                                                                            value="<?php if(isset($menuName)): ?> <?php echo e($menuName->name); ?> <?php endif; ?>" />
                                                                        <input type="hidden" id="idmenu"
                                                                            value="<?php if(isset($menuName)): ?> <?php echo e($menuName->id); ?> <?php endif; ?>" />
                                                                        <span class="invalid-feedback d-block menuName_err"
                                                                            role="alert"></span>
                                                                    </label>
                                                                    <?php if(request()->has('action')): ?>
                                                                        <div class="publishing-action">
                                                                            <a onclick="createMenu()" name="save_menu" id="save_menu_header" class="btn btn-outline menu-save"><?php echo e(__('static.menus.create_menu')); ?></a>
                                                                            <span class="spinner" id="spincustomu2"></span>
                                                                        </div>
                                                                    <?php elseif(request()->has('menu') && isset($menuName)): ?>
                                                                        <div class="publishing-action">
                                                                            <a onclick="getMenus(this)" name="save_menu" id="save_menu_header" class="btn btn-outline menu-save"><?php echo e(__('static.menus.save_menu')); ?>

                                                                                <span class="spinner"></span></a>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <div class="publishing-action">
                                                                            <a onclick="createMenu()" name="save_menu"
                                                                                id="save_menu_header" class="btn btn-outline menu-save"><?php echo e(__('static.menus.create_menu')); ?></a>
                                                                            <span class="spinner" id="spincustomu2"></span>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div id="post-body">
                                                                <div id="post-body-content">
                                                                    <?php if(request()->has('menu') && isset($menuName)): ?>
                                                                        <div class="drag-instructions post-body-plain"
                                                                            style="">
                                                                            <p>
                                                                                <?php echo e(__('static.menus.each_item_you_prefer')); ?>

                                                                            </p>
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <h5 class="mt-2 mb-1"><?php echo e(__('static.menus.menu_creation')); ?>

                                                                        </h5>
                                                                        <div class="drag-instructions post-body-plain"
                                                                            style="">
                                                                            <p class="mt-0">
                                                                                <?php echo e(__('static.menus.please_enter_name')); ?>

                                                                            </p>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <ul class="menu ui-sortable" id="menu-to-edit">
                                                                    </ul>
                                                                    <div class="menu-settings">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="nav-menu-footer">
                                                                <div class="major-publishing-actions">
                                                                    <?php if(request()->has('action')): ?>
                                                                        <div class="publishing-action">
                                                                            <a onclick="createMenu()" name="save_menu" id="save_menu_header" class="btn btn-solid menu-save"><?php echo e(__('static.menus.create_menu')); ?></a>
                                                                        </div>
                                                                    <?php elseif(request()->has('menu') && isset($menuName)): ?>
                                                                        <span class="delete-action"> <a class="submitdelete deletion menu-delete" onclick="deletemenu()"
                                                                                href="javascript:void(9)"><?php echo e(__('Delete Menu')); ?></a>
                                                                        </span>
                                                                        <a onclick="getMenus(this)" name="save_menu" id="save_menu_header" class="btn btn-solid menu-save"><?php echo e(__('Save Menu')); ?>

                                                                            <span class="spinner"></span></a>
                                                                    <?php else: ?>
                                                                        <div class="publishing-action">
                                                                            <a onclick="createMenu()" name="save_menu" id="save_menu_header" class="btn btn-solid menu-save"><?php echo e(__('static.menus.create_menu')); ?></a>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        var menus = {
            "oneThemeLocationNoMenus": "",
            "moveUp": "Move up",
            "moveDown": "Mover down",
            "moveToTop": "Move top",
            "moveUnder": "Move under of %s",
            "moveOutFrom": "Out from under  %s",
            "under": "Under %s",
            "outFrom": "Out from %s",
            "menuFocus": "%1$s. Element menu %2$d of %3$d.",
            "subMenuFocus": "%1$s. Menu of subelement %2$d of %3$s."
        };
        var arraydata = [];
        var getMenuItemsURL = '<?php echo e(route('admin.menu.items')); ?>';
        var addCustomMenuURL = '<?php echo e(route('admin.addCustomMenu')); ?>';
        var updateItemURL = '<?php echo e(route('admin.updateItem')); ?>';
        var generateMenuControlURL = '<?php echo e(route('admin.generateMenuControl')); ?>';
        var deleteItemMenuURL = '<?php echo e(route('admin.deleteItemMenu')); ?>';
        var deleteMenuURL = '<?php echo e(route('admin.deleteMenu')); ?>';
        var createMenuURL = '<?php echo e(route('admin.createMenu')); ?>';
        var csrftoken = "<?php echo e(csrf_token()); ?>";
        var currentURL = "<?php echo e(url()->current()); ?>";
        var menuId = new URL(window.location.href).searchParams.get("menu");
        var depth = "<?php echo e($depth); ?>";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrftoken
            }
        });
    </script>
    <script type="text/javascript" src="<?php echo e(asset('js/menu/scripts.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/menu/scripts2.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/menu/menu.js')); ?>"></script>
    <script>
        // Function to update "Select All" checkbox state
        function updateSelectAll(section) {
            var menuItems = section.find('.menu-item-checkbox[name="label"]');
            var allChecked = menuItems.length > 0 && menuItems.length === menuItems.filter(':checked').length;
            section.find('.checkAll').prop('checked', allChecked);
            section.find('.checkAll').prop('disabled', menuItems.length === 0);
        }

        // Check/uncheck "All" checkbox based on individual checkboxes
        $('.accordion-section-content .menu-item-checkbox[name="label"]').change(function() {
            var section = $(this).closest('.accordion-section-content');
            updateSelectAll(section);
        });

        // Hide/Show select all button
        $('.nav-link').on('shown.bs.tab', function(event) {
            let activeTab = $(event.target).attr('aria-controls');
            var section = $(this).closest('.accordion-section-content');
            if (activeTab == 'view-all') {
                section.find('.form-check').addClass('d-none');
            } else {
                section.find('.form-check').removeClass('d-none');
            }
        })

        // Check/uncheck all checkboxes when the "All" checkbox is clicked
        $('.accordion-section-content .checkAll').change(function() {
            var section = $(this).closest('.accordion-section-content');
            var menuItems = section.find('.menu-item-checkbox[name="label"]');
            menuItems.prop('checked', this.checked);
        });

        // Initial setup on page load
        $('.accordion-section-content').each(function() {
            var section = $(this);
            updateSelectAll(section);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/menu/index.blade.php ENDPATH**/ ?>