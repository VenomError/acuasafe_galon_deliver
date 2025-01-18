<?php

use App\Models\Metadata;
$metadata = new Metadata();
$radius = 6000;
$zoom = 15;
$icon = '/assets/user_marker.png';
$major_icon = '/assets/depot_marker.png';
$latitude = $metadata->get('office_latitude');
$longitude = $metadata->get('office_longitude');

// -------------
$markers = json_encode($markers);

?>

<div id="mapMany" style="height: 500px;"></div>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script>

    const zoom = <?= $zoom ?>;
    const major_latitude = <?= $latitude ?>;
    const major_longitude = <?= $longitude ?>;

    // Initialize the map
    const map = L.map('mapMany').setView([major_latitude, major_longitude], zoom);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // Add markers to the map
    const markers = <?= $markers ?>;
    const markerIcon = L.icon({
        iconUrl: '<?= $icon ?>',
        iconSize: [38, 40],
    });
    markers.forEach(marker => {
        L.marker([marker.lat, marker.lng], {
            icon: markerIcon
        }).addTo(map);
    });

    const markerRecycle = L.icon({
        iconUrl: ' <?= $major_icon ?>',
        iconSize: [38, 40],
    });

    L.marker([major_latitude, major_longitude], {
        icon: markerRecycle
    }).addTo(map);
    L.circle([major_latitude, major_longitude], {
        radius: <?= $radius ?>
    }).addTo(map);
</script>