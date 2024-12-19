<?php

use App\Models\Order;

set_layout("dashboard");
set_title('Canceled Order');
$orders = new Order();
$order = $orders->joinCostumerWhereStatus('cancel')->fetch_all(MYSQLI_ASSOC);;
?>


<div class="row">
    <div class="col-12">
        <?= component('order/table-list-order', [
            'data' => $order
        ]) ?>
    </div> <!-- end col -->
</div>