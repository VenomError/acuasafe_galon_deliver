<?php

use App\Models\Costumer;

require_once __DIR__ . "/../../vendor/autoload.php";



try {

    $costumer  = new Costumer();

    if (empty($_POST['id'])) {
        throw new Exception("empty costumer ID");
    }

    $costumer->delete($_POST["id"]);

    echo json_encode([
        'status' => 'success',
        'message' => 'delete costumer success'
    ]);
} catch (\Throwable $th) {
    echo json_encode([
        'status' => 'error',
        'message' => $th->getMessage()
    ]);
}
