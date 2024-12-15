<?php

namespace App;

class Haversine
{

    public $latitudeFrom;
    public $longitudeFrom;
    public $latitudeTo;
    public $longitudeTo;
    public $unit = 'km';

    /**
     * Menghitung jarak antara dua titik menggunakan formula Haversine
     *
     * @param float $latitudeFrom  Lintang titik awal
     * @param float $longitudeFrom Bujur titik awal
     * @param float $latitudeTo    Lintang titik tujuan
     * @param float $longitudeTo   Bujur titik tujuan
     * @param string $unit         Unit hasil ('km' untuk kilometer, 'mi' untuk mil)
     *
     * @return float Jarak antara dua titik
     */
    public function __construct(
        float $latitudeFrom,
        float $longitudeFrom,
        float $latitudeTo,
        float $longitudeTo,
        string $unit = 'km'
    ) {
        $this->latitudeFrom = $latitudeFrom;
        $this->longitudeFrom = $longitudeFrom;
        $this->latitudeTo = $latitudeTo;
        $this->longitudeTo = $longitudeTo;
        $this->unit = $unit;
    }

    public  function get_distance()
    {
        // Konversi derajat ke radian
        $degToRad = 0.0174532925;
        $lat1 = $this->latitudeFrom * $degToRad;
        $lon1 = $this->longitudeFrom * $degToRad;
        $lat2 = $this->latitudeTo * $degToRad;
        $lon2 = $this->longitudeTo * $degToRad;

        // Radius bumi dalam kilometer atau mil
        $R = ($this->unit === 'mi') ? 3958.8 : 6371.0;

        // Menghitung x dan y sesuai rumus
        $x = ($lon2 - $lon1) * cos(($lat1 + $lat2) / 2);
        $y = $lat2 - $lat1;

        // Menghitung jarak
        $distance = sqrt(($x * $x) + ($y * $y)) * $R;

        return number_format($distance, 2);
    }
}
