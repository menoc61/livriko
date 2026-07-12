<?php
$currentUrl = url()->current();
?>
<?php if(isset($menus)): ?>
<?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if ($__env->exists('admin.menu.items', ['menu' => $menu])) echo $__env->make('admin.menu.items', ['menu' => $menu], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php if($menu->isParent()): ?>
        <?php if(!empty($menu->child)): ?>
            <?php $__currentLoopData = $menu->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if ($__env->exists('admin.menu.items', ['menu' => $child])) echo $__env->make('admin.menu.items', ['menu' => $child], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/menu/menu_items.blade.php ENDPATH**/ ?>