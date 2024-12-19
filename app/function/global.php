<?php

if (!function_exists('page')) {
    function page($path)
    {
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
        $url = 'index';

        if (isset($_SERVER['PATH_INFO'])) {
            $url = $_SERVER["PATH_INFO"];
        }

        $url = trim($url, "/");

        return $url;
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
