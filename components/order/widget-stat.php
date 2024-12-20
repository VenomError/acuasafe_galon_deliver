<?php

use App\Models\Order;

$order = new Order();

?>
<div class="row">
    <div class="col-12">
        <div class="card widget-inline">
            <div class="card-body p-0">
                <div class="row g-0">

                    <div class="col-12">
                        <div class="card rounded-0 shadow-none m-0 border-bottom border-light">
                            <div class="card-body text-center text-muted">
                                <h3><span class="text-muted"><?= $order->getCount() ?></span></h3>
                                <p class=" font-15 mb-0">Total Order</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card rounded-0 shadow-none m-0 border-end border-light">
                            <div class="card-body text-center text-warning">
                                <h3><span class="text-warning"><?= $order->getCount('new') ?></span></h3>
                                <p class=" font-15 mb-0">New Order</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card rounded-0 shadow-none m-0 border-end border-light">
                            <div class="card-body text-center text-info">
                                <h3><span class="text-info"><?= $order->getCount('otw') ?></span></h3>
                                <p class=" font-15 mb-0">OTW Order</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card rounded-0 shadow-none m-0 border-end border-light">
                            <div class="card-body text-center text-success">
                                <h3><span class="text-success"><?= $order->getCount('completed') ?></span></h3>
                                <p class=" font-15 mb-0">Completed Order</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card rounded-0 shadow-none m-0 border-end border-light">
                            <div class="card-body text-center text-danger">
                                <h3><span class="text-danger"><?= $order->getCount('cancel') ?></span></h3>
                                <p class=" font-15 mb-0">Canceled Order</p>
                            </div>
                        </div>
                    </div>

                </div> <!-- end row -->
            </div>
        </div> <!-- end card-box-->
    </div> <!-- end col-->
</div>