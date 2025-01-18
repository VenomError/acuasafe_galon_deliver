<?php

use App\Models\Driver;
use App\Models\Metadata;


$drivers = new Driver();
$metadata = new Metadata();

$latitudeFrom = $metadata->get('office_latitude');
$longitudeFrom = $metadata->get('office_longitude');
?>

<div class="table-responsive">
    <table class="table table-centered  nowrap" id="orders-datatable">
        <thead class="table-light">
            <tr>
                <th></th>
                <th>Distance (KM)</th>
                <th>Created At</th>
                <th class="all">Total Amount</th>
                <th>Costumer</th>
                <th>Payment Method</th>
                <th>Is Confirm</th>
                <th style="width: 85px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $order) : ?>
                <tr>

                    <td>
                        <div style="width: 100px;">
                            <select name="" id="" class="form-control text-center border border-<?= orderStatusColor($order['status']) ?> text-<?= orderStatusColor($order['status']) ?>"
                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Order Status"
                                data-id="<?= $order['id'] ?>"
                                onchange="updateOrderStatus(this)">
                                <?php if ($order['status'] == 'new') : ?>
                                    <option value="<?= $order['status']  ?>" class="text-<?= orderStatusColor($order['status']) ?>"><?= $order['status'] ?></option>
                                <?php endif; ?>
                                <option value="otw" <?= $order['status'] == 'otw' ? 'selected' : '' ?> class="text-info">otw</option>
                                <option value="completed" <?= $order['status'] == 'completed' ? 'selected' : '' ?> class="text-success">completed</option>
                                <option value="cancel" <?= $order['status'] == 'cancel' ? 'selected' : '' ?> class="text-danger">cancel</option>
                            </select>
                        </div>

                    </td>
                    <td>
                        <span class="me-2">
                            <?= $order['distance'] ?> 
                        </span>

                    </td>
                    <td><?= dateFormat($order['created_at'] , 'd M, Y ') ?></td>

                    <td><?= RPformat($order['total_amount']) ?></td>
                    <td>
                        <span class="text-primary"><?= $order['costumer_name']  ?></span>
                    </td>
                    <td><?= $order['payment_method'] ?></td>

                    <td>
                        <span class="badge p-1 bg-<?= confirmColor($order['is_confirm']) ?>"><?= $order['is_confirm'] ? 'Confirmed' : 'Not Confirmed' ?></span>
                    </td>
                    <td class="table-action">
                        <a href="/driver/order/detail?order_id=<?= $order['id'] ?>" class="action-icon btn btn-primary text-white"
                            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Detail"> <i class="mdi mdi-eye"></i></a>
                        <?php if ($order['status'] != 'completed') : ?>
                            <a target="_blank" href="<?= viewGoogleMap($order['latitude'], $order['longitude']) ?>" class="btn btn-sm btn-success"> <i class="mdi mdi-truck-delivery me-2"></i> Start Driving</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<script>
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