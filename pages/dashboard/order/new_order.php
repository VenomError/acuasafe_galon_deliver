<?php

use App\Models\Order;

set_layout("dashboard");
set_title('New Product');
$orders = new Order();
$newOrder = $orders->joinCostumerWhereStatus('new')->fetch_all(MYSQLI_ASSOC);;
?>


<div class="row">
    <div class="col-12">
        <?= component('order/table-list-order', [
            'data' => $newOrder
        ]) ?>
    </div> <!-- end col -->
</div>