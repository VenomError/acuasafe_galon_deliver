<?php

session_start();
require_once __DIR__ . "/../vendor/autoload.php";

use App\Models\Order;

$order = new Order();

try {
    $upload = uploadFile("resit", "resit");
    $order_id = post()->order_id;
    $order->uploadResit($order_id, $upload);
    set_session('success', 'uploading resit success');
    redirect('/');
} catch (\Throwable $th) {
    set_session('error', $th->getMessage());
    redirect_back();
}
