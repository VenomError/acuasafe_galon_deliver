<?php

use App\Models\Admin;


require_once __DIR__ . "/../../vendor/autoload.php";



try {

    $admin  = new Admin();

    $admin->name = post()->name;
    $admin->email = post()->email;
    $admin->password = post()->password;

    $admin->create();

    echo json_encode([
        'status' => 'success',
        'message' => 'create Admin success'
    ]);
} catch (\Throwable $th) {
    echo json_encode([
        'status' => 'error',
        'message' => $th->getMessage()
    ]);
}
