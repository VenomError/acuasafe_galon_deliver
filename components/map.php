<?php

use App\Models\Metadata;

$metadata = new Metadata();

$latitude = (float) $metadata->get("office_latitude");
$longitude = (float) $metadata->get("office_longitude");

?>


<style>
    /* Mengubah warna latar belakang dan teks popup */
    .leaflet-popup-content-wrapper {
        background-color: #4A90E2;
        /* Warna latar belakang popup */
        color: #fff;
        /* Warna teks popup */
        border-radius: 8px;
        /* Membuat sudut popup lebih membulat */
    }

    /* Mengubah warna panah (arrow) popup */
    .leaflet-popup-tip {
        background-color: #4A90E2;
        /* Warna panah popup */
    }

    /* Mengubah warna tautan di dalam popup jika ada */
    .leaflet-popup-content a {
        color: #FFD700;
        /* Warna tautan popup */
    }
</style>
<div id="officeMap" style="height: 500px;"></div>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script>
    const map = L.map('officeMap').setView([<?= $latitude ?>, <?= $longitude ?>], 13);

    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    const marker = L.marker([<?= $latitude ?>, <?= $longitude ?>]).addTo(map)
        .bindPopup('<center><b>ACUASFE</b></center><span><br>Lokasi office acusafe</span>').openPopup();
</script>