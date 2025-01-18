<?php

use App\Models\Order;

set_layout("dashboard");
set_title('List Product');
$orders = new Order();
$allOrder = $orders->joinCostumer()
    ->fetch_all(MYSQLI_ASSOC);

?>


<?= component('order/widget-stat') ?>

<div class="row">
    <div class="col-12">
        <?= component('order/table-list-order', [
            'data' => $allOrder ]) ?>
    </div>
  
</div>