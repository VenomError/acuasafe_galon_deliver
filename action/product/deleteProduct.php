<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use App\Models\Produk;

try {

    if (empty($_POST['id'])) {
        throw new Exception('ID not found');
    }
    $product = new Produk();

    $productWantDelete = $product->find($_POST['id']);
    if (file_exists(__DIR__ . '/../..' . $productWantDelete->image)) {
        unlink(__DIR__ . '/../..' . $productWantDelete->image);
    }


    $product->delete($_POST['id']);

    echo json_encode([
        'status' => 'success',
        'message' => 'delete product success'
    ]);
} catch (\Throwable $th) {
    echo json_encode([
        'status' => 'error',
        'message' => $th->getMessage()
    ]);
}
