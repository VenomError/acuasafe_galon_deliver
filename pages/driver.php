<?php
set_layout("driver");
set_title('Dashboard Driver');
driver_only();
$orders = new \App\Models\Order();
$id = driver()->id;
$data = $orders->getByDriverAndConfirm($id, 'new')->fetch_all(MYSQLI_ASSOC);
?>

<div class="row">
    <div class="col-12">
        <div class="card widget-inline">
            <div class="card-body p-0">
                <div class="row g-0">

                    <div class="col-12">
                        <div class="card rounded-0 shadow-none m-0 border-bottom border-light">
                            <div class="card-body text-center text-muted">
                                <h3><span class="text-muted"><?= $orders->getByDriverAndConfirmWhereStatus($id)->num_rows  ?></span></h3>
                                <p class=" font-15 mb-0">Total Order</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card rounded-0 shadow-none m-0 border-end border-light">
                            <div class="card-body text-center text-warning">
                                <h3><span class="text-warning"><?= $orders->getByDriverAndConfirmWhereStatus($id, 'new')->num_rows ?></span></h3>
                                <p class=" font-15 mb-0">New Order</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card rounded-0 shadow-none m-0 border-end border-light">
                            <div class="card-body text-center text-info">
                                <h3><span class="text-info"><?= $orders->getByDriverAndConfirmWhereStatus($id, 'otw')->num_rows ?></span></h3>
                                <p class=" font-15 mb-0">OTW Order</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card rounded-0 shadow-none m-0 border-end border-light">
                            <div class="card-body text-center text-success">
                                <h3><span class="text-success"><?= $orders->getByDriverAndConfirmWhereStatus($id, 'completed')->num_rows ?></span></h3>
                                <p class=" font-15 mb-0">Completed Order</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card rounded-0 shadow-none m-0 border-end border-light">
                            <div class="card-body text-center text-danger">
                                <h3><span class="text-danger"><?= $orders->getByDriverAndConfirmWhereStatus($id, 'cancel')->num_rows ?></span></h3>
                                <p class=" font-15 mb-0">Canceled Order</p>
                            </div>
                        </div>
                    </div>

                </div> <!-- end row -->
            </div>
        </div> <!-- end card-box-->
    </div> <!-- end col-->
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h4>NEW ORDER</h4>
                </div>
            </div>
            <div class="card-body">

                <?= component('order/table-list-order-driver', [
                    'data' => $data,
                ]) ?>
            </div>
        </div>

    </div>
</div>