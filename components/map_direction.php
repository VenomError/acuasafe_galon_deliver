<?php

use App\Models\Metadata;

$metadata = new Metadata();
$latitudeFrom = (float) $metadata->get('office_latitude');
$longitudeFrom = (float) $metadata->get('office_longitude');
$latitudeTo = (float) $latitudeTo;
$longitudeTo = (float) $longitudeTo;
$userIcon = '/assets/user_marker.png';
$depotIcon = '/assets/depot_marker.png';
?>
<div id="mapDirection" style="height: 500px;"></div>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script>
    const map = L.map('mapDirection').setView([<?= $latitudeFrom ?>, <?= $longitudeFrom ?>], 13);

    // Menambahkan Tile Layer dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
    const userIconUrl = "<?= $userIcon ?>";
    const depotIconUrl = "<?= $depotIcon ?>";
    const userIcon = L.icon({
        iconUrl: userIconUrl,
        iconSize: [38, 40],
        iconAnchor: [22, 45],
    });
    const depotIcon = L.icon({
        iconUrl: depotIconUrl,
        iconSize: [40, 40],
        iconAnchor: [22, 45],
    });
    // Menambahkan Routing
    L.Routing.control({
        waypoints: [
            L.latLng(<?= $latitudeFrom ?>, <?= $longitudeFrom ?>), // Titik awal
            L.latLng(<?= $latitudeTo ?>, <?= $longitudeTo ?>) // Titik tujuan
        ],
        routeWhileDragging: true,
        createMarker: function (i, waypoint, n) {
            if (i === 1) {
                return L.marker(waypoint.latLng, { icon: userIcon }); // Custom icon for the destination
            } else {
                return L.marker(waypoint.latLng, { icon: depotIcon }); // Custom icon for the destination
            }
        }
    }).addTo(map);

</script>