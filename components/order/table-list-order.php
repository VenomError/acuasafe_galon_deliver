<?php

use App\Models\Order;
use App\Models\Driver;
use App\Models\Metadata;

$products = new Order();
$drivers = new Driver();
$metadata = new Metadata();
$data = $products->joinCostumer();

$latitudeFrom = $metadata->get('office_latitude');
$longitudeFrom = $metadata->get('office_longitude');
?>
<div class="card">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
            </div>
            <div class="col-sm-7 text-end">
                <a href="/dashboard/product/create_product" class="btn btn-primary mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add Product</a>
            </div><!-- end col-->
        </div>

        <div class="table-responsive">
            <table class="table table-centered  nowrap" id="products-datatable">
                <thead class="table-light">
                    <tr>
                        <th></th>
                        <th>Created At</th>
                        <th>Distance</th>
                        <th class="all">Total Amount</th>
                        <th>Costumer</th>
                        <th>Driver</th>
                        <th>Payment Method</th>
                        <th>Is Confirm</th>
                        <th style="width: 85px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $order) : ?>
                        <tr>

                            <td>
                                <span class="badge p-1 bg-<?= orderStatusColor($order['status']) ?>"><?= $order['status'] ?></span>
                            </td>
                            <td><?= dateFormat($order['created_at']) ?></td>
                            <td>
                                <span class="me-2">
                                    <?= $order['distance'] ?> KM
                                </span>
                                <?php
                                $directionMap = "https://www.google.com/maps/dir/?api=1&origin={$latitudeFrom},{$longitudeFrom}&destination={$order['latitude']},{$order['longitude']}";
                                ?>
                                <a href="<?= $directionMap ?>" class=" rounded-circle action-icon bg-info text-white"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Route Map" target="_blank"> <i class="mdi mdi-google-maps"></i></a>

                            </td>
                            <td><?= RPformat($order['total_amount']) ?></td>
                            <td>
                                <span class="text-primary"><?= $order['costumer_name'] ?></span>
                            </td>
                            <td>
                                <?php
                                if (is_null($order['driver_id'])) :
                                ?>
                                    <button class="btn btn-success btn-sm"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Assign Order to Driver">
                                        <i class="mdi mdi-truck-delivery me-2"></i> assign
                                    </button>
                                <?php
                                else :
                                    $getDriver = $drivers->find($order['driver_id']);
                                ?>
                                    <span class="text-primary"><?= $getDriver->name ?></span>
                                <?php
                                endif;
                                ?>
                            </td>
                            <td><?= $order['payment_method'] ?></td>

                            <td>
                                <span class="badge p-1 bg-<?= confirmColor($order['is_confirm']) ?>"><?= $order['is_confirm'] ? 'Confirmed' : 'Not Confirmed' ?></span>
                            </td>
                            <td class="table-action">
                                <a href="/dashboard/order/detail?order_id=<?= $order['id'] ?>" class="action-icon"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Detail"> <i class="mdi mdi-eye"></i></a>
                                <a href="/dashboard/order/edit?order_id=<?= $order['id'] ?>" class="action-icon"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit"> <i class="mdi mdi-square-edit-outline"></i></a>
                                <button class="btn action-icon" onclick="deleteOrder(<?= $order['id'] ?>)"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->

<script>
    function deleteProduct(id) {
        // Show a confirmation dialog
        if (confirm("Are you sure you want to delete this product? ")) {
            $.ajax({
                type: "POST",
                url: "/action/product/deleteProduct.php",
                data: {
                    id: id
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

        } else {
            toastr.info('Deleting Cancel');
        }
    }
</script>