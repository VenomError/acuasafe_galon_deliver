<?php
session_start();
require_once __DIR__ . "/vendor/autoload.php";
date_default_timezone_set('Asia/Makassar');
$layout = 'home';
$title = 'home page';
function set_layout($name = 'home',)
{
    global $layout;
    $layout = $name;
}
function set_title($page_title = 'home page')
{
    global $title;
    $title = $page_title;
}

$content = page(get_url());

$layoutFile = __DIR__ . "/layouts/{$layout}.php";

if (file_exists($layoutFile)) {
    include $layoutFile;
} else {
    echo "Layout Tidak Ditemukan di {$layoutFile}";
}


unset_session('error');
unset_session('info');
unset_session('warning');
unset_session('success');
