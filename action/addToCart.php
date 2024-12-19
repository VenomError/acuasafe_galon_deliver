<?php
session_start();
require_once __DIR__ . "/../vendor/autoload.php";

try {
    $data = [
        'id' => post()->product_id,
        'name' => post()->name,
        'image' => post()->image,
        'price' => number_format(post()->price, 2),
        'quantity' => post()->quantity ?? 1,
        'amount' => post()->price * post()->quantity
    ];
    $_SESSION['cart'][post()->product_id] = $data;

    print_r(json_encode($_SESSION['cart']));

    set_session('success', 'Item added to cart successfully');
    return redirect_back();
} catch (\Throwable $th) {
    set_session('error', 'failed to add cart Error : ' . $th->getMessage());
    return  redirect_back();
}
