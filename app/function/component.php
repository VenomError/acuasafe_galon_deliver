<?php

if (!function_exists('component')) {
    function component($name, $data = [])
    {
        $dir = __DIR__ . "/../../components";
        $file = "{$dir}/{$name}.php";

        if (file_exists($file)) {
            extract($data);
            ob_start();
            include $file;
            return ob_get_clean();
        } else {
            return "Komponen Tidak Ditemukan di {$file}";
        }
    }
}

function asset($name)
{
    return __DIR__ . "/../../assets/{$name}";
}
