<?php

use App\Models\Order;

set_layout("driver");
set_title('Completed Order');
$orders = new Order();
$id = driver()->id;
$order = $orders->getByDriverAndConfirmWhereStatus($id, 'completed')->fetch_all(MYSQLI_ASSOC);;
?>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?= component('order/table-list-order-driver', [
                    'data' => $order
                ]) ?>
            </div>
        </div>
    </div> <!-- end col -->
</div>