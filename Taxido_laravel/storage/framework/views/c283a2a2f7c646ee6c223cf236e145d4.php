<?php use \Nwidart\Modules\Facades\Module; ?>

<?php $__env->startPush('css'); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('modules/taxido/css/vendors/leaflet/leaflet.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('modules/taxido/css/vendors/leaflet/leaflet.draw.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
  <script src="<?php echo e(asset('modules/taxido/js/leaflet.min.js')); ?>" defer></script>
  <script src="<?php echo e(asset('modules/taxido/js/leaflet.draw.js')); ?>" defer></script>

  <script>
    (function($) {
      "use strict";
      let map;
      let markers = [];
      const locations = <?php echo json_encode($locations, 15, 512) ?>;
      const driverId = <?php echo e($driver?->id ?? null); ?>;
      const defaultImage = '<?php echo e(asset('images/user.png')); ?>';
      let vehicleTypesFilter = [];
      let zoneFilter = '';

      function initMap() {
        map = L.map('map_canvas').setView([21.20764938296402, 72.77381805168456], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        addMarkers(locations);

        const driver = locations.find(d => d.id === driverId);
        if (driver && driver.lat && driver.lng) {
          map.panTo([driver.lat, driver.lng]);
        }
      }

      function addMarkers(locations, filteredVehicleTypes = [], filterZone = '') {
        markers.forEach(marker => {
          map.removeLayer(marker);
        });
        markers = [];

        locations.forEach(location => {
          if (filteredVehicleTypes.length > 0 && !filteredVehicleTypes.includes(location.vehicle_type)) {
            return;
          }

          if (filterZone && location.zone_id !== filterZone) {
            return;
          }

          if (location.lat && location.lng) {
            let marker = L.marker([location.lat, location.lng], {
              icon: L.icon({
                iconUrl: location.vehicle_image || defaultImage,
                iconSize: [35, 60]
              })
            }).addTo(map);

            markers.push(marker);
          }
        });
      }

      $(document).ready(function() {
        initMap();
      });
    })(jQuery);
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/Modules/Taxido/resources/views/admin/driver/osm.blade.php ENDPATH**/ ?>