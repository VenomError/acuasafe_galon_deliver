<?php
set_layout("dashboard");
set_title('Order Edit');

if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    redirect('/dashboard/order/list_order');
}

$id = $_GET['order_id'];



?>

<div class="row">

</div>