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
