<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use App\Models\Order;


try {

    $order = new Order();
    if (empty($_POST['id']) || empty($_POST['status'])) {
        throw new Exception("Order ID or Driver Not Found");
    }

    $order->updateStatus($_POST['id'], $_POST['status']);

    echo json_encode([
        'status' => 'success',
        'message' => 'assign  order driver success'
    ]);
} catch (\Throwable $th) {
    echo json_encode([
        'status' => 'error',
        'message' => $th->getMessage()
    ]);
}
