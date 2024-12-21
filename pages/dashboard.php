<?php
set_layout("dashboard");
set_title('Dashboard Admin');
?>

<?= component('order/widget-stat') ?>
<div class="row d-flex h-100">
    <div class="col-lg-4 d-flex">
        <div class="card flex-grow-1">
            <div class="card-body">
                <div class="card-title">
                    <h4 class="header-title mb-4">Order Count</h4>
                </div>
                <?= component('chart/orderChart') ?>
            </div>
        </div>
    </div>
    <div class="col-lg-8 d-flex">
        <div class="card flex-grow-1">
            <div class="card-body">
                <div class="card-title">
                    <h4 class="header-title mb-4">Product Order Quantity</h4>
                </div>
                <?= component('chart/productChart') ?>
            </div>
        </div>
    </div>
</div>