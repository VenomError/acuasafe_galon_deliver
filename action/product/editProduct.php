<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use App\Models\Produk;

try {

    if (empty($_POST['name']) || empty($_POST['size']) || empty($_POST['description']) || empty($_POST['price'])) {
        throw new Exception('All fields are required.');
    }
    $product = new Produk();

    $product->name = $_POST['name'];
    $product->size = $_POST['size'];
    $product->description = $_POST['description'];
    $product->price = $_POST['price'];

    if (!empty($_FILES['image']['name'])) {
        $product->image = uploadFile('image', 'product');
        $productWantUpdate = $product->find($_POST['id']);
        if (file_exists(__DIR__ . '/../..' . $productWantUpdate->image)) {
            unlink(__DIR__ . '/../..' . $productWantUpdate->image);
        }
    } else {
        $product->image = $_POST['oldImage'];
    }

    $product->update($_POST['id']);

    echo json_encode([
        'status' => 'success',
        'message' => 'update product success'
    ]);
} catch (\Throwable $th) {
    echo json_encode([
        'status' => 'error',
        'message' => $th->getMessage()
    ]);
}
