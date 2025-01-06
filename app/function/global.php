<?php

if (!function_exists('page')) {
    function page($path)
    {
        if(empty($path))
        {
            $path = 'index';
        }
        $dir = __DIR__ . "/../../pages";
        $file = "{$dir}/{$path}.php";

        if (file_exists($file)) {
            ob_start();
            include $file;
            return ob_get_clean();
        } else {
            echo "File Tidak Ditemukan di {$file}";
            die();
        }
    }
}
if (!function_exists("get_url")) {

    function get_url()
    {
        $url = 'index'; // Default route

        // Gunakan REQUEST_URI jika PATH_INFO tidak tersedia
        if (isset($_SERVER['REQUEST_URI'])) {
            $parsed_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Hanya ambil path
            $url = $parsed_url ?: 'index';
        }

        $url = trim($url, "/");
        $url = preg_replace('/[^a-zA-Z0-9\/_-]/', '', $url); // Sanitasi URL

        return $url ?? 'index';
    }
}

function default_img_product($num = 4)
{
    return "assets/images/resource/shop/shop-$num.jpg";
}

function dateFormat($date, $format = 'd M, y h:ia')
{
    $date = date_create($date);

    return date_format($date, $format);
}


function RPformat($number)
{

    $formated = number_format($number, 2, ',', '.');

    return "Rp {$formated}";
}

function confirmColor(bool $isConfirm)
{
    if ($isConfirm == true) {
        return "success";
    } else {
        return 'danger';
    }
}

function orderStatusColor($status)
{
    switch ($status) {

        case 'new':
            return 'warning';
        case 'otw':
            return 'info';
        case 'cancel':
            return 'danger';
        case 'completed':
            return 'success';

        default:
            return 'primary';
    }
}

function viewGoogleMap($latitude, $longitude)
{
    $metadata = new \App\Models\Metadata();

    $latitudeFrom = $metadata->get('office_latitude');
    $longitudeFrom = $metadata->get('office_longitude');

    $directionMap = "https://www.google.com/maps/dir/?api=1&origin={$latitudeFrom},{$longitudeFrom}&destination={$latitude},{$longitude}";
    return $directionMap;
}
