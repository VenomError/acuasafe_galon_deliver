<?php

use App\Models\Order;
use App\Models\Driver;
use App\Models\OrderItem;

set_layout("dashboard");
set_title('Order Detail');

if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    redirect('/dashboard/order/list_order');
}

$id = $_GET['order_id'];

$order = new Order();
$order_item = new OrderItem();
$drivers = new Driver();

$order = $order->findAndJoinCostumer($id);
$order_item = $order_item->getByOrder($id);

?>


<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Items from Order ID : <?= $id ?></h4>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order_item as $item) : ?>
                                <tr>
                                    <td><?= $item['product_name'] ?></td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td><?= RPformat($item['product_price']) ?></td>
                                    <td><?= RPformat($item['amount']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->

            </div>
            <div class="card-body">
                <h4 class="header-title mb-3">Order Summary</h4>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Description</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Total :</th>
                                <th><?= RPformat($order->total_amount) ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php if (!$order->is_confirm) : ?>
                    <div class="text-end mt-5">
                        <button onclick="confirmOrder(<?= $order->id ?>)" type="button" class="btn btn-md btn-danger">Confirm This Order</button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card-title text-end">
                    <div>
                        <span class="fw-bold ">Open Map Direction</span>
                        <a href="<?= viewGoogleMap($order->latitude, $order->longitude) ?>" class=" rounded-circle action-icon bg-info text-white p-1 me-2"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Route Map" target="_blank"> <i class="mdi mdi-google-maps " style="font-size: 20px;"></i>
                        </a>
                    </div>
                </div>

                <?= component('map_direction', [
                    'latitudeTo' => $order->latitude,
                    'longitudeTo' => $order->longitude
                ]) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Costumer Information</h4>

                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td><span class="me-2"> : </span></td>
                                <td>
                                    <h5><?= $order->costumer_name ?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><span class="me-2"> : </span></td>
                                <td>
                                    <h5><?= $order->costumer_email ?></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td><span class="me-2"> : </span></td>
                                <td>
                                    <h5><?= $order->costumer_phone ?></h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Address Information</h4>

                    <div>
                        <h5>Address </h5>
                        <address class="mb-0 font-14 address-lg">
                            <?= $order->address ?>
                        </address>
                    </div>
                    <div>
                        <h5>Address Info </h5>
                        <address class="mb-0 font-14 address-lg">
                            <?= $order->address_detail ?>
                        </address>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Billing Information</h4>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <p class="mb-2 d-flex justify-content-between align-items-center">
                                <span class="fw-bold me-2">Payment Method:</span>
                                <span class="fw-bold"><?= strtoupper($order->payment_method) ?></span>
                            </p>
                        </li>
                        <li>
                            <p class="mb-2 d-flex justify-content-between align-items-center">
                                <span class="fw-bold me-2 ">Confirmation:</span>
                                <button
                                    class="btn btn-sm btn-<?= confirmColor($order->is_confirm) ?> mb-2"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Confirmation Status">
                                    <?= strtoupper($order->is_confirm ? 'CONFIRMED' : 'NOT CONFIRMED') ?>
                                </button>
                            </p>
                        </li>

                        <li>
                            <p class="mb-2 d-flex justify-content-between align-items-center">
                                <span class="fw-bold me-2">Resit:</span>
                                <?php if (!is_null($order->resit)) : ?>
                                    <a href="<?= htmlspecialchars($order->resit) ?>" class="btn btn-success btn-sm"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="View Resit" target="_blank">
                                        <i class="mdi mdi-eye me-2"></i>
                                        View Resit
                                    </a>
                                <?php else : ?>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Tidak ada Resit">
                                        <i class="mdi mdi-file-image-remove me-2"></i>
                                        Tidak ada Resit
                                    </button>
                                <?php endif; ?>
                            </p>

                        </li>
                    </ul>

                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Delivery Info</h4>
                    <div class="text-center">
                        <i class="mdi mdi-truck-fast h2 text-muted"></i>
                        <h5><b>Distance</b></h5>
                        <h5><b class="text-info"><?= $order->distance ?> KM</b>
                        </h5>

                        <h5><b>Delivery Status</b></h5>
                        <button
                            class="btn btn-sm btn-<?= orderStatusColor($order->status) ?> mb-2"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            data-bs-title="Order Status">
                            <?= strtoupper($order->status) ?>
                        </button>
                        <h5><b>Driver</b></h5>

                        <?php
                        if (is_null($order->driver_id)) :
                        ?>
                            <button class="btn btn-danger btn-sm"
                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Assign Order to Driver">
                                <i class="mdi mdi-truck-delivery me-2"></i> Not Assign
                            </button>
                        <?php
                        else :
                            $getDriver = $drivers->find($order->driver_id);
                        ?>
                            <span class="text-primary"><?= $getDriver->name ?></span>
                        <?php
                        endif;
                        ?>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function confirmOrder(id) {

        if (!confirm('konfirmasi order ini ?')) {
            toastr.info('canceled');
            return;
        }

        $.ajax({
            type: "POST",
            url: "/action/order/confirmOrder.php",
            data: {
                id: id,
            },
            dataType: "json",
            success: function(res) {
                if (res.status == 'success') {
                    toastr.success(res.message);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error(res.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Display a generic error message if available
                toastr.error(jqXHR.responseJSON ? jqXHR.responseJSON.message : 'An error occurred');

                // Log detailed error information to the console for debugging
                console.error('Error Status:', textStatus);
                console.error('Error Thrown:', errorThrown);
                console.error('Response Text:', jqXHR.responseText);
            }
        });

    }
</script>