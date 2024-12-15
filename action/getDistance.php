<?php

use App\Models\Metadata;

session_start();
require_once __DIR__ . "/../vendor/autoload.php";

$metadata = new Metadata();
// get depot lat and long
$latitudeTo = $metadata->get('office_latitude');
$longitudeTo = $metadata->get('office_longitude');

// Ambil data dari request
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['latitude']) && isset($input['longitude'])) {
    $latitudeFrom = (float)$input['latitude'];
    $longitudeFrom = (float)$input['longitude'];

    // Buat instance Haversine dan hitung jarak
    $haversine = new \App\Haversine($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo);
    $distance = $haversine->get_distance();

    echo json_encode(['distance' => $distance]);
} else {
    echo json_encode(['error' => 'Invalid input']);
}
