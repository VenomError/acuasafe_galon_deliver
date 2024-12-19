<?php

use App\Models\Order;
use App\Models\OrderItem;

session_start();
require_once __DIR__ . "/../vendor/autoload.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {
        $order = new Order();

        $order->payment_method = post()->payment_method;
        $order->latitude = post()->latitude;
        $order->longitude = post()->longitude;
        $order->distance = post()->distance;
        $order->address = post()->address;
        $order->address_detail = post()->address_detail;
        $order->costumer_id = auth()->id ?? throw new Exception("failed to get costumer ");;

        $total_amount = 0;
        // get amount
        $products = session('cart');
        foreach ($products as $item) {
            $total_amount += toFloat($item['price']) * $item['quantity'];
        }
        $order->total_amount = $total_amount;

        $order_id = $order->create();

        // create order detail
        foreach ($products as $item) {
            $order_item = new OrderItem();

            $order_item->amount = toFloat($item['price']) * $item['quantity'];
            $order_item->quantity = $item['quantity'];
            $order_item->order_id = $order_id;
            $order_item->product_id = $item['id'];

            $order_item->create();
        }

        unset_session('cart');

        set_session('success', 'created order success');
        return redirect("/payment?order_id=$order_id");
    } catch (\Throwable $th) {
        set_session('error', 'Failed to create order' . $th->getMessage());
        return redirect_back();
    }
}
