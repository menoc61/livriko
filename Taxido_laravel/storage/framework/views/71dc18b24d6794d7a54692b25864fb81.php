<?php
$settings = getSettings();

function hexToRgb($hex) {
    $hex = str_replace("#", "", $hex);
    if (strlen($hex) == 3) {
        $r = hexdec(str_repeat(substr($hex, 0, 1), 2));
        $g = hexdec(str_repeat(substr($hex, 1, 1), 2));
        $b = hexdec(str_repeat(substr($hex, 2, 1), 2));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    return "$r, $g, $b";
}

$primaryColorRgb = hexToRgb($settings['appearance']['primary_color'] ?? '#199675');
$secondaryColorRgb = hexToRgb($settings['appearance']['secondary_color'] ?? '#115444');
?>

<style>
    :root {
        --primary-color: <?php echo e($primaryColorRgb); ?>;
        --secondary-color: <?php echo e($secondaryColorRgb); ?>;
        --font-family: <?php echo e($settings['appearance']['front_font_family'] ?? 'DM Sans'); ?>;
    }
</style>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/front/layouts/style.blade.php ENDPATH**/ ?>