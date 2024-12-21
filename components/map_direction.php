<?php

use App\Models\Metadata;

$metadata = new Metadata();
$latitudeFrom = (float) $metadata->get('office_latitude');
$longitudeFrom = (float) $metadata->get('office_longitude');
$latitudeTo = (float) $latitudeTo;
$longitudeTo = (float) $longitudeTo;

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

    // Menambahkan Routing
    L.Routing.control({
        waypoints: [
            L.latLng(<?= $latitudeFrom ?>, <?= $longitudeFrom ?>), // Titik awal
            L.latLng(<?= $latitudeTo ?>, <?= $longitudeTo ?>) // Titik tujuan
        ],
        routeWhileDragging: true
    }).addTo(map);
</script>