<?php

use App\Models\Admin;

require_once __DIR__ . "/../../vendor/autoload.php";



try {

    $admin  = new Admin();

    if (empty($_POST['id'])) {
        throw new Exception("empty driver ID");
    }

    $admin->delete($_POST["id"]);

    echo json_encode([
        'status' => 'success',
        'message' => 'delete admin success'
    ]);
} catch (\Throwable $th) {
    echo json_encode([
        'status' => 'error',
        'message' => $th->getMessage()
    ]);
}
