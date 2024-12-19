<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use App\Models\Produk;

try {

    $product = new Produk();

    $product->name = $_POST['name'];
    $product->size = $_POST['size'];
    $product->description = $_POST['description'];
    $product->price = $_POST['price'];
    $product->image = uploadFile('image', 'product');

    $product->create();

    echo json_encode([
        'status' => 'success',
        'message' => 'create product success'
    ]);
} catch (\Throwable $th) {
    echo json_encode([
        'status' => 'error',
        'message' => $th->getMessage()
    ]);
}
