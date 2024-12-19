<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use App\Models\Order;


try {

    $order = new Order();
    if (empty($_POST['id'])) {
        throw new Exception("Order ID not found");
    }

    $order->delete($_POST['id']);

    echo json_encode([
        'status' => 'success',
        'message' => 'delete order success'
    ]);
} catch (\Throwable $th) {
    echo json_encode([
        'status' => 'error',
        'message' => $th->getMessage()
    ]);
}
