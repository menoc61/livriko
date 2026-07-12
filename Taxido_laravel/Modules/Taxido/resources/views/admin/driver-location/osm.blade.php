@use('Nwidart\Modules\Facades\Module')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('modules/taxido/css/vendors/leaflet/leaflet.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('modules/taxido/js/leaflet.min.js') }}" defer></script>

    <script>
        (function($) {
            "use strict";

            let map;
            let overlays = [];
            const defaultImage = '{{ asset('images/user.png') }}';
            const defaultVehicleImage = '{{ asset('images/Frame.png') }}';
            let vehicleTypesFilter = [];
            let zoneFilter = '';
            let previousPositions = {};
            let movingOverlays = {};
            let allDrivers = {};
            let vehicleTypes = @json($vehicleTypes ?? []);

            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            function initialize() {
                setupMap();
                
                // Initialize with data from backend
                if (window.initialDrivers) {
                    window.initialDrivers.forEach(driver => {
                        allDrivers[driver.id] = driver;
                    });
                    debouncedUpdateDriverList(allDrivers);
                }

                listenToDriverLocations();
                updateFilters();
            }

            function setupMap() {
                map = L.map('map_canvas').setView([21.20764938296402, 72.77381805168456], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
            }

            function VehicleOverlay(position, image, heading, driverId, vehicleType, zoneId, contentString) {
                this.position = position;
                this.image = image || defaultVehicleImage;
                this.heading = heading || 0;
                this.driverId = driverId;
                this.vehicleType = vehicleType ? String(vehicleType) : '';
                this.zoneId = zoneId ? String(zoneId) : '';
                this.contentString = contentString;

                const div = document.createElement('div');
                div.style.position = 'absolute';
                div.style.width = '25px';
                div.style.height = '50px';
                div.style.cursor = 'pointer';

                const img = document.createElement('img');
                img.src = this.image;
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.transform = `rotate(${this.heading}deg)`;

                div.appendChild(img);

                this.marker = L.marker(position, {
                    icon: L.divIcon({
                        html: div.outerHTML,
                        iconSize: [25, 50],
                        iconAnchor: [12.5, 25],
                        popupAnchor: [0, -25]
                    }),
                    driverId,
                    vehicleType: this.vehicleType,
                    zoneId: this.zoneId
                }).bindPopup(contentString);

                this.div = div;
                this.marker.addTo(map);
            }

            VehicleOverlay.prototype.updatePosition = function(newLatLng, newHeading) {
                this.position = newLatLng;
                this.heading = newHeading || this.heading;
                const newHtml = this.div.cloneNode(true);
                newHtml.firstChild.style.transform = `rotate(${this.heading}deg)`;
                this.marker.setLatLng(newLatLng);
                this.marker.setIcon(L.divIcon({
                    html: newHtml.outerHTML,
                    iconSize: [25, 50],
                    iconAnchor: [12.5, 25],
                    popupAnchor: [0, -25]
                }));
            };

            VehicleOverlay.prototype.setMap = function(map) {
                if (map) {
                    this.marker.addTo(map);
                } else {
                    map.removeLayer(this.marker);
                }
            };

            function computeHeading(from, to) {
                const fromLat = from.lat * Math.PI / 180;
                const fromLng = from.lng * Math.PI / 180;
                const toLat = to.lat * Math.PI / 180;
                const toLng = to.lng * Math.PI / 180;
                const dLng = toLng - fromLng;
                const y = Math.sin(dLng) * Math.cos(toLat);
                const x = Math.cos(fromLat) * Math.sin(toLat) - Math.sin(fromLat) * Math.cos(toLat) * Math.cos(dLng);
                const heading = Math.atan2(y, x) * 180 / Math.PI;
                return (heading + 360) % 360;
            }

            function smoothMoveOverlay(overlay, driverId, fromLatLng, toLatLng, duration = 2000) {
                if (movingOverlays[driverId]) return;
                movingOverlays[driverId] = true;

                const startTime = performance.now();
                const startLat = fromLatLng.lat;
                const startLng = fromLatLng.lng;
                const deltaLat = toLatLng.lat - startLat;
                const deltaLng = toLatLng.lng - startLng;
                const heading = computeHeading(fromLatLng, toLatLng);

                function animate(currentTime) {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const newLat = startLat + deltaLat * progress;
                    const newLng = startLng + deltaLng * progress;
                    const newLatLng = L.latLng(newLat, newLng);

                    overlay.updatePosition(newLatLng, heading);

                    if (progress < 1) {
                        requestAnimationFrame(animate);
                    } else {
                        movingOverlays[driverId] = false;
                    }
                }

                requestAnimationFrame(animate);
            }

            function createDriverElement(driver) {
                const driverId = driver.id;
                const isOnline = driver.is_online == 1;
                const isOnRide = driver.is_on_ride == 1;

                let statusClass = 'driver-deactive';
                let statusTitle = 'Offline';
                let driverStatus = 'offline';

                if (isOnline) {
                    if (isOnRide) {
                        statusClass = 'driver-not-assign';
                        statusTitle = 'On Ride';
                        driverStatus = 'on_ride';
                    } else {
                        statusClass = 'driver-active';
                        statusTitle = 'Online';
                        driverStatus = 'online';
                    }
                }

                const rating = driver.rating_count > 0 ? (driver.rating).toFixed(1) : 'Unrated';
                const profileImage = driver.profile_image_url || defaultImage;

                return `
                    <div class="accordion-item driver-item" id="driver-accordion-item-${driverId}"
                        data-driver-id="${driverId}"
                        data-vehicle-type="${driver.vehicle_type_id || ''}"
                        data-zone-id="${driver.zone_id || ''}"
                        data-status="${driverStatus}">
                        <h4 class="accordion-header">
                            <div class="position-relative">
                                <img src="${profileImage}" alt="" class="img">
                                <span class="driver_status_${driverId} ${statusClass}" title="${statusTitle}"></span>
                            </div>
                            <div>
                                <span class="name">${driver.driver_name || 'Unknown Driver'}</span>
                                <div class="rate-box">
                                    <i class="ri-star-fill"></i>
                                    ${rating}
                                </div>
                            </div>
                            <button type="button"
                                class="btn btn-solid btn-sm ms-auto view-location-btn"
                                data-driver-id="${driverId}">View Location</button>
                            <button class="accordion-button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapse${driverId}">
                                <i class="ri-arrow-down-s-line"></i>
                            </button>
                        </h4>
                        <div id="panelsStayOpen-collapse${driverId}" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                ${isOnRide ? createRideDetails(driver) : createNoRideDetails()}
                            </div>
                        </div>
                    </div>
                `;
            }

            function createRideDetails(driver) {
                return `
                    <ul class="details-list">
                        <li><span class="bg-light-primary">#${driver.ride_number || 'N/A'}</span></li>
                        <li><span class="vehicle-number">${driver.plate_number || 'N/A'}</span></li>
                        <li><span class="badge badge-progress">${driver.ride_status || 'In Progress'}</span></li>
                    </ul>
                    <ul class="location-driver-details">
                        <li>
                            <div class="driver-main-box">
                                <h5>Rider Details:</h5>
                                <div class="name-box">
                                    <img src="${driver.rider_image || defaultImage}" alt="" class="img">
                                    <div>
                                        <h5 class="name">${driver.rider_name || 'N/A'}</h5>
                                        <h6>${driver.rider_email || 'N/A'}</h6>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>Service <span>${driver.service_name || 'N/A'}</span></li>
                        <li>Service Category <span>${driver.service_category_name || 'N/A'}</span></li>
                        <li class="detail-item">
                            <h5>Vehicle Type</h5>
                            <div class="vehicle-box">
                                <img src="${driver.vehicle_image || defaultVehicleImage}" alt="">
                                <span>${driver.vehicle_name || 'N/A'}</span>
                            </div>
                        </li>
                        <li class="ride-main">
                            <h5>Payment Status:</h5>
                            <span class="badge badge-pending text-white">${driver.payment_status || 'Pending'}</span>
                        </li>
                        <li class="detail-item">
                            <h5>Payment Method</h5>
                            <span>
                                <img src="${driver.payment_logo || '{{ asset('images/payment/cod.png') }}'}" 
                                    class="img-fluid cash-img" alt="${driver.payment_method || 'COD'}">
                            </span>
                        </li>
                        <li>Distance <span>${driver.distance || '0'} ${driver.distance_unit || 'km'}</span></li>
                        <li class="detail-item">
                            <h5>Date Time</h5>
                            <span>${driver.ride_date_time || new Date().toLocaleString()}</span>
                        </li>
                    </ul>
                    <div class="button-details-box">
                        <a href="/admin/ride/${driver.ride_id}" class="btn">View More</a>
                    </div>
                `;
            }

            function createNoRideDetails() {
                return `<div class="no-ride-data"><p>No rides yet</p></div>`;
            }

            function updateDriverList(drivers) {
                const tabPanes = {
                    'all': document.querySelector('#all-pane .accordion'),
                    'onride': document.querySelector('#onride-pane .accordion'),
                    'online': document.querySelector('#online-pane .accordion'),
                    'offline': document.querySelector('#offline-pane .accordion')
                };

                Object.values(tabPanes).forEach(pane => {
                    if (pane) { pane.innerHTML = ''; }
                });

                let driverCounts = { 'all': 0, 'onride': 0, 'online': 0, 'offline': 0 };
                const addedDriverIds = new Set();

                Object.entries(drivers).forEach(([driverId, driver]) => {
                    if (driver.is_verified == 0) return;
                    if (addedDriverIds.has(driverId)) return;
                    addedDriverIds.add(driverId);

                    const isOnline = driver.is_online == 1;
                    const isOnRide = driver.is_on_ride == 1;

                    let showInTab = 'offline';
                    if (isOnline) {
                        showInTab = isOnRide ? 'onride' : 'online';
                    }

                    const driverElement = createDriverElement(driver);
                    if (tabPanes.all) {
                        tabPanes.all.insertAdjacentHTML('beforeend', driverElement);
                        driverCounts.all++;
                    }
                    if (tabPanes[showInTab]) {
                        tabPanes[showInTab].insertAdjacentHTML('beforeend', driverElement);
                        driverCounts[showInTab]++;
                    }
                });

                document.getElementById('all-count').textContent = `(${driverCounts.all})`;
                document.getElementById('onride-count').textContent = `(${driverCounts.onride})`;
                document.getElementById('online-count').textContent = `(${driverCounts.online})`;
                document.getElementById('offline-count').textContent = `(${driverCounts.offline})`;

                const hasDrivers = driverCounts.all > 0;
                document.getElementById('no-data-message').style.display = hasDrivers ? 'none' : 'block';
            }

            const debouncedUpdateDriverList = debounce(updateDriverList, 300);

            function addOverlays(drivers, filteredVehicleTypes = [], filterZone = '', activeTab = 'all') {
                overlays.forEach(overlay => overlay.setMap(null));
                overlays = [];

                Object.values(drivers).forEach(driver => {
                    if (driver.is_verified == 0) return;

                    const driverId = driver.id;
                    const vehicleType = driver.vehicle_type_id ? String(driver.vehicle_type_id) : '';
                    const zoneId = driver.zone_id ? String(driver.zone_id) : '';
                    const lat = parseFloat(driver.lat);
                    const lng = parseFloat(driver.lng);

                    if (isNaN(lat) || isNaN(lng) || lat === 0) return;

                    if (filteredVehicleTypes.length > 0 && !filteredVehicleTypes.includes(vehicleType)) return;
                    if (filterZone && zoneId !== filterZone) return;

                    const isOnline = driver.is_online == 1;
                    const isOnRide = driver.is_on_ride == 1;
                    let driverStatus = isOnline ? (isOnRide ? 'on_ride' : 'online') : 'offline';

                    let statusMatch = (activeTab === 'all') || 
                                     (activeTab === 'onride' && driverStatus === 'on_ride') ||
                                     (activeTab === 'online' && driverStatus === 'online') ||
                                     (activeTab === 'offline' && driverStatus === 'offline');

                    if (!statusMatch) return;

                    const contentString = `
                        <div class="driver-location-box">
                            <div class="vehicle-image">
                                <img src="${driver.profile_image_url || defaultImage}" class="img-fluid" />
                            </div>
                            <h5><span>${driver.driver_name || 'Unknown Driver'}</span></h5>
                            <ul class="location-list">
                                <li class="rate-box">Rating: <span><i class="ri-star-fill"></i> ${driver.rating_count > 0 ? (driver.rating).toFixed(1) : 'Unrated'}</span></li>
                                <li>Vehicle: <span>${driver.vehicle_name || 'N/A'}</span></li>
                                <li>Phone: <span>${driver.phone || 'N/A'}</span></li>
                                <li>Model: <span>${driver.model || 'N/A'}</span></li>
                                <li>Plate Number: <span>${driver.plate_number || 'N/A'}</span></li>
                            </ul>
                        </div>`;

                    const newLatLng = L.latLng(lat, lng);
                    let heading = 0;

                    if (previousPositions[driverId]) {
                        heading = computeHeading(previousPositions[driverId], newLatLng);
                    }

                    const overlay = new VehicleOverlay(newLatLng, driver.vehicle_map_icon_url || defaultVehicleImage, heading, driverId, vehicleType, zoneId, contentString);

                    if (previousPositions[driverId]) {
                        smoothMoveOverlay(overlay, driverId, previousPositions[driverId], newLatLng);
                    }

                    previousPositions[driverId] = newLatLng;
                    overlays.push(overlay);
                });
            }

            function listenToDriverLocations() {
                if (!window.Echo) {
                    console.error("Laravel Echo is not initialized!");
                    return;
                }

                window.Echo.channel('drivers-map')
                    .listen('.driver.location_updated', (data) => {
                        console.log("🚚 Real-time Driver Update (OSM):", data);
                        const driverId = data.id;
                        
                        // Merge update into local state
                        if (allDrivers[driverId]) {
                            allDrivers[driverId] = { ...allDrivers[driverId], ...data };
                        } else {
                            allDrivers[driverId] = data;
                        }

                        debouncedUpdateDriverList(allDrivers);
                        updateFilters();
                    });
            }

            function updateFilters() {
                vehicleTypesFilter = [];
                document.querySelectorAll('.vehicle-filter:checked').forEach((input) => {
                    vehicleTypesFilter.push(input.value.trim());
                });

                zoneFilter = document.querySelector('#zone_id')?.value?.trim() || '';
                const activeTab = document.querySelector('.nav-link.active')?.id?.replace('-tab', '') || 'all';

                const drivers = document.querySelectorAll('.driver-item');
                let foundDriver = false;

                drivers.forEach(driverItem => {
                    const driverVehicleType = driverItem.getAttribute('data-vehicle-type')?.trim() || '';
                    const driverZoneId = driverItem.getAttribute('data-zone-id')?.trim() || '';
                    const driverStatus = driverItem.getAttribute('data-status')?.trim();

                    let statusMatch = (activeTab === 'all') || 
                                     (activeTab === 'onride' && driverStatus === 'on_ride') ||
                                     (activeTab === 'online' && driverStatus === 'online') ||
                                     (activeTab === 'offline' && driverStatus === 'offline');

                    const vehicleTypeMatch = vehicleTypesFilter.length === 0 || vehicleTypesFilter.includes(driverVehicleType);
                    const zoneMatch = !zoneFilter || driverZoneId === zoneFilter;

                    if (statusMatch && vehicleTypeMatch && zoneMatch) {
                        driverItem.style.display = 'block';
                        foundDriver = true;
                    } else {
                        driverItem.style.display = 'none';
                    }
                });

                document.getElementById('no-data-message').style.display = foundDriver ? 'none' : 'block';
                addOverlays(allDrivers, vehicleTypesFilter, zoneFilter, activeTab);
            }

            document.addEventListener('DOMContentLoaded', () => {
                initialize();
                document.querySelector('#zone_id')?.addEventListener('change', updateFilters);
                document.querySelectorAll('.nav-link').forEach(tab => {
                    tab.addEventListener('shown.bs.tab', updateFilters);
                });
                document.querySelectorAll('.vehicle-filter').forEach(checkbox => {
                    checkbox.addEventListener('change', updateFilters);
                });

                document.addEventListener('click', function(e) {
                    if (e.target.classList.contains('view-location-btn')) {
                        const driverId = e.target.dataset.driverId;
                        const driver = allDrivers[driverId];
                        if (driver && driver.lat && driver.lng) {
                            const position = L.latLng(driver.lat, driver.lng);
                            map.setView(position, 15);
                            const overlay = overlays.find(o => o.driverId === driverId);
                            if (overlay) {
                                overlay.marker.openPopup();
                            }
                        }
                    }
                });

                updateFilters();
            });
        })(jQuery);
    </script>
@endpush
h