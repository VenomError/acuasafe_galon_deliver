<?php

use App\Models\Metadata;

require_once __DIR__ . "/../../vendor/autoload.php";


try {
    $metadata = new Metadata();
    foreach ($_POST as $key => $value) {
        $metadata->set($key, $value);
    }
    echo json_encode([
        'status' => 'success',
        'message' => 'update metadata success'
    ]);
} catch (\Throwable $th) {
    echo json_encode([
        'status' => 'error',
        'message' => $th->getMessage()
    ]);
}
