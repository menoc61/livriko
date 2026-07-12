<?php
 $settings = getTaxidoSettings();
?>

<?php $__env->startSection('title', __('taxido::static.heatmaps.ride_request_heatmap')); ?>
<?php $__env->startSection('content'); ?>
    <div class="map-section">
        <div class="contentbox">
            <div class="inside">
                <div class="contentbox-title">
                    <div class="contentbox-subtitle">
                        <h3><?php echo e(__('taxido::static.heatmaps.heat_map')); ?></h3>
                    </div>

                </div>
                <div class="alert alert-info ms-0 w-100" role="alert">
                    <?php echo e(__('taxido::static.heatmaps.text')); ?>

                </div>
                <div class="map-box">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php if($settings['location']['map_provider'] == 'google_map'): ?>
    <?php if ($__env->exists('taxido::admin.heat-map.google')) echo $__env->make('taxido::admin.heat-map.google', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php elseif($settings['location']['map_provider'] == 'osm'): ?>
    <?php if ($__env->exists('taxido::admin.heat-map.osm')) echo $__env->make('taxido::admin.heat-map.osm', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/admin/heat-map/index.blade.php ENDPATH**/ ?>