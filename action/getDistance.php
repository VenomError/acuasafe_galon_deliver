<?php
session_start();
require_once __DIR__ . "/../vendor/autoload.php";

// get depot lat and long
$latitudeTo = -5.1676832;
$longitudeTo = 114.4524672;

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
