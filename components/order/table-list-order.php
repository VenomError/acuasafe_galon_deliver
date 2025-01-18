<?php

use App\Models\Driver;
use App\Models\Metadata;


$drivers = new Driver();
$metadata = new Metadata();

$latitudeFrom = $metadata->get('office_latitude');
$longitudeFrom = $metadata->get('office_longitude');

$markers = [];
foreach ($data as $order) {
    $markers[] = [
        'lat' => $order[ 'latitude' ],
        'lng' => $order[ 'longitude' ],
    ];
}
?>
<div class="card">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-centered  nowrap" id="orders-datatable">
                <thead class="table-light">
                    <tr>
                        <th></th>
                        <th>Distance (KM)</th>
                        <th>Created At</th>
                        <th class="all">Total Amount</th>
                        <th>Costumer</th>
                        <th>Driver</th>
                        <th>Payment Method</th>
                        <th>Is Confirm</th>
                        <th>Address</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th style="width: 85px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $order): ?>
                        <tr>

                            <td>
                                <div style="width: 100px;">
                                    <select name="" id=""
                                        class="form-control text-center border border-<?= orderStatusColor($order[ 'status' ]) ?> text-<?= orderStatusColor($order[ 'status' ]) ?>"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Order Status"
                                        data-id="<?= $order[ 'id' ] ?>" onchange="updateOrderStatus(this)">
                                        <option value="new" <?= $order[ 'status' ] == 'new' ? 'selected' : '' ?>
                                            class="text-warning">new</option>
                                        <option value="otw" <?= $order[ 'status' ] == 'otw' ? 'selected' : '' ?>
                                            class="text-info">otw</option>
                                        <option value="completed" <?= $order[ 'status' ] == 'completed' ? 'selected' : '' ?>
                                            class="text-success">completed</option>
                                        <option value="cancel" <?= $order[ 'status' ] == 'cancel' ? 'selected' : '' ?>
                                            class="text-danger">cancel</option>
                                    </select>
                                </div>

                            </td>
                            <td>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="me-2">
                                        <?= $order[ 'distance' ] ?>
                                    </span>

                                    <a href="<?= viewGoogleMap($order[ 'latitude' ], $order[ 'longitude' ]) ?>"
                                        class="rounded-circle action-icon bg-info text-white" data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-title="View Route Map" target="_blank">
                                        <i class="mdi mdi-google-maps"></i>
                                    </a>
                                </div>
                            </td>
                            <td><?= dateFormat($order[ 'created_at' ]) ?></td>

                            <td><?= RPformat($order[ 'total_amount' ]) ?></td>
                            <td>
                                <span class="text-primary"><?= $order[ 'costumer_name' ] ?></span>
                            </td>
                            <td>
                                <?php
                                if (is_null($order[ 'driver_id' ])):
                                    ?>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Assign Order to Driver"
                                        onclick="assignToDriver(<?= $order[ 'id' ] ?> , <?= null ?>)">
                                        <i class="mdi mdi-truck-delivery me-2"></i> Not Assign
                                    </button>
                                    <?php
                                else:
                                    $getDriver = $drivers->find($order[ 'driver_id' ]);
                                    ?>
                                    <button class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Assign Order to Driver"
                                        onclick="assignToDriver(<?= $order[ 'id' ] ?> , <?= $getDriver->id ?> )">
                                        <i class="mdi mdi-truck-delivery me-2"></i> <?= $getDriver->name ?>
                                    </button>
                                    <?php
                                endif;
                                ?>
                            </td>
                            <td><?= $order[ 'payment_method' ] ?></td>

                            <td>
                                <span
                                    class="badge p-1 bg-<?= confirmColor($order[ 'is_confirm' ]) ?>"><?= $order[ 'is_confirm' ] ? 'Confirmed' : 'Not Confirmed' ?></span>
                            </td>
                            <td>
                                <span><?= $order[ 'address' ] ?></span>
                            </td>
                            <td>
                                <span><?= $order[ 'latitude' ] ?></span>
                            </td>
                            <td>
                                <span><?= $order[ 'longitude' ] ?></span>
                            </td>
                            <td class="table-action">
                                <a href="/dashboard/order/detail?order_id=<?= $order[ 'id' ] ?>" class="action-icon"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Detail"> <i
                                        class="mdi mdi-eye"></i></a>
                                <button class="btn action-icon" onclick="deleteOrder(<?= $order[ 'id' ] ?>)"
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

<div class="col-12">
    <?= component('map_many', [
        'markers' => $markers
    ]) ?>
</div>

<div class="modal fade" id="assignDriverModal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="assignDriverModalLabel">Assign Order to Driver</h4>
            </div>
            <div class="modal-body">
                <form id="assignDriverForm">
                    <div class="mb-3">
                        <label for="driver_id" class="form-label">Select Driver</label>
                        <?php
                        $optionDriver = $drivers->all();
                        ?>
                        <select name="driver_id" id="driver_id" class="form-control" required>
                            <option value="">Select Driver</option>
                            <?php foreach ($optionDriver as $driver): ?>
                                <option value="<?= $driver[ 'id' ] ?>"><?= ucwords($driver[ 'name' ]) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal"
                            aria-hidden="true">Assign</button>
                        <button type="reset" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                            aria-hidden="true">Cancel</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script>
    function deleteOrder(id) {
        // Show a confirmation dialog
        if (confirm("Are you sure you want to delete this product? ")) {
            $.ajax({
                type: "POST",
                url: "/action/order/deleteOrder.php",
                data: {
                    id: id
                },
                dataType: "json",
                success: function (res) {
                    if (res.status == 'success') {
                        toastr.success(res.message);
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error(res.message);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
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

    function assignToDriver(id, driver = null) {
        $('#assignDriverModal').modal('show');
        // Set the driver_id in the form if a driver is provided
        if (driver !== null && !isNaN(driver)) {
            $('#driver_id').val(driver);
        }

        $('#assignDriverForm').submit(function (e) {
            e.preventDefault();

            let driver_id = $('#driver_id').val();
            if (driver_id == null) {
                return toastr.error('please select driver');
            }

            $.ajax({
                type: "POST",
                url: "/action/order/assignDriver.php",
                data: {
                    id: id,
                    driver_id: driver_id
                },
                dataType: "json",
                success: function (res) {
                    if (res.status == 'success') {
                        toastr.success(res.message);
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error(res.message);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Display a generic error message if available
                    toastr.error(jqXHR.responseJSON ? jqXHR.responseJSON.message : 'An error occurred');

                    // Log detailed error information to the console for debugging
                    console.error('Error Status:', textStatus);
                    console.error('Error Thrown:', errorThrown);
                    console.error('Response Text:', jqXHR.responseText);
                }
            });

        });
    }

    function updateOrderStatus(selectElement) {
        const newStatus = selectElement.value;
        const id = selectElement.getAttribute('data-id');

        $.ajax({
            type: "POST",
            url: "/action/order/updateStatus.php",
            data: {
                id: id,
                status: newStatus
            },
            dataType: "json",
            success: function (res) {
                if (res.status == 'success') {
                    toastr.success(res.message);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error(res.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
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