<?php
$settings = getSettings();
$bgType = $settings['appearance']['sidebar_background_type'] ?? 'solid';
$solidColor = $settings['appearance']['sidebar_solid_color'] ?? '#199675';
$gradientColor1 = $settings['appearance']['sidebar_gradient_color_1'] ?? '#199675';
$gradientColor2 = $settings['appearance']['sidebar_gradient_color_2'] ?? '#212121';
?>

<style>
    :root {
        --primary-color: <?php echo e($settings['appearance']['primary_color']); ?>;
        --font-family: <?php echo e($settings['appearance']['font_family']); ?>;
        --sidebar-gradient-color-1: <?php echo e($gradientColor1); ?>;
        --sidebar-gradient-color-2: <?php echo e($gradientColor2); ?>;
        --sidebar-solid-color: <?php echo e($solidColor); ?>;
        --sidebar-background-color:
            <?php if($bgType === 'gradient'): ?>
                linear-gradient(178.98deg, var(--sidebar-gradient-color-1) -453.29%, var(--sidebar-gradient-color-2) 91.53%);
            <?php else: ?>
                var(--sidebar-solid-color);
            <?php endif; ?>
    }

    .sidebar {
        background: var(--sidebar-background-color);
    }
</style>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/inc/style.blade.php ENDPATH**/ ?>