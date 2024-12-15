<?php
$latitudeFrom = (float) $latitudeFrom;
$longitudeFrom = (float) $longitudeFrom;
$latitudeTo = (float) $latitudeTo;
$longitudeTo = (float) $longitudeTo;

?>
<div id="mapDirection" style="height: 500px;"></div>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script>
    const map = L.map('mapDirection').setView([51.505, -0.09], 13);

    // Menambahkan Tile Layer dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Menambahkan Routing
    L.Routing.control({
        waypoints: [
            L.latLng(-5.1375500, 119.4866300), // Titik awal
            L.latLng(-5.1385211, 119.4876823) // Titik tujuan
        ],
        routeWhileDragging: true
    }).addTo(map);
</script>