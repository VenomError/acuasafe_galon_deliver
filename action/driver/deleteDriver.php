<?php

use App\Models\Driver;
use App\Models\Costumer;

require_once __DIR__ . "/../../vendor/autoload.php";



try {

    $driver  = new Driver();

    if (empty($_POST['id'])) {
        throw new Exception("empty driver ID");
    }

    $driver->delete($_POST["id"]);

    echo json_encode([
        'status' => 'success',
        'message' => 'delete driver success'
    ]);
} catch (\Throwable $th) {
    echo json_encode([
        'status' => 'error',
        'message' => $th->getMessage()
    ]);
}
