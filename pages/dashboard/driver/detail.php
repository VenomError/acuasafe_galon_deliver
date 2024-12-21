<?php

use App\Models\Driver;
use App\Models\Order;

set_layout("dashboard");
set_title('Driver Detail');
if (is_null(request()->driver_id)) {
    redirect('/dashboard/product/list_product');
}

$id = request()->driver_id;

$drivers = new Driver();
$driver = $drivers->find($id);

$orders = new Order();
$driverOrder = $orders->getByDriver($id);
?>

<div class="row">
    <div class="col-xl-4">

        <?= component('driver/detail', [
            'driver' => $driver
        ]) ?>
    </div>
    <div class="col-xl-8">

        <div class="row">
            <div class="col-12">
                <div class="card widget-inline">
                    <div class="card-body p-0">
                        <div class="row g-0">

                            <div class="col-12">
                                <div class="card rounded-0 shadow-none m-0 border-bottom border-light">
                                    <div class="card-body text-center text-muted">
                                        <h3><span class="text-muted"><?= $orders->getCountByDriver($id) ?></span></h3>
                                        <p class=" font-15 mb-0">Total Order</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card rounded-0 shadow-none m-0 border-end border-light">
                                    <div class="card-body text-center text-warning">
                                        <h3><span class="text-warning"><?= $orders->getCountByDriver($id, 'new') ?></span></h3>
                                        <p class=" font-15 mb-0">New Order</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card rounded-0 shadow-none m-0 border-end border-light">
                                    <div class="card-body text-center text-info">
                                        <h3><span class="text-info"><?= $orders->getCountByDriver($id, 'otw') ?></span></h3>
                                        <p class=" font-15 mb-0">OTW Order</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card rounded-0 shadow-none m-0 border-end border-light">
                                    <div class="card-body text-center text-success">
                                        <h3><span class="text-success"><?= $orders->getCountByDriver($id, 'completed') ?></span></h3>
                                        <p class=" font-15 mb-0">Completed Order</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card rounded-0 shadow-none m-0 border-end border-light">
                                    <div class="card-body text-center text-danger">
                                        <h3><span class="text-danger"><?= $orders->getCountByDriver($id, 'cancel') ?></span></h3>
                                        <p class=" font-15 mb-0">Canceled Order</p>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end row -->
                    </div>
                </div> <!-- end card-box-->
            </div> <!-- end col-->
        </div>
        <?= component('order/table-list-order', [
            'data' => $driverOrder
        ]) ?>
    </div>
</div>