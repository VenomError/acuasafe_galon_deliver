<?php

use App\Models\Driver;
use App\Models\Costumer;

require_once __DIR__ . "/../../vendor/autoload.php";



try {

    $driver  = new Driver();

    $driver->name = post()->name;
    $driver->email = post()->email;
    $driver->phone = post()->phone;
    $driver->password = post()->password;

    $driver->create();

    echo json_encode([
        'status' => 'success',
        'message' => 'create driver success'
    ]);
} catch (\Throwable $th) {
    echo json_encode([
        'status' => 'error',
        'message' => $th->getMessage()
    ]);
}
