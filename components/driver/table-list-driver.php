<?php

use App\Models\Driver;

$drivers = new Driver();
$data = $drivers->all();

?>
<div class="card">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-5">
            </div>
            <div class="col-sm-7 text-end">
                <a href="/dashboard/driver/create" class="btn btn-primary mb-2"><i class="mdi mdi-plus-circle me-2"></i> Add Driver</a>
            </div><!-- end col-->
        </div>

        <div class="table-responsive">
            <table class="table table-centered w-100 dt-responsive nowrap" id="drivers-datatable">
                <thead class="table-light">
                    <tr>
                        <th class="all">Costumer Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Registered At</th>
                        <th style="width: 85px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $driver) : ?>
                        <tr>
                            <td>
                                <?= $driver['name'] ?>
                            </td>

                            <td>
                                <?= $driver['email'] ?>
                            </td>
                            <td>
                                <?= $driver['phone'] ?>
                            </td>

                            <td>
                                <?= dateFormat($driver['created_at']) ?>
                            </td>

                            <td class="table-action">
                                <a href="/dashboard/product/detail?product_id=<?= $driver['id'] ?>" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                <button class="btn action-icon" onclick="deleteDriver(<?= $driver['id'] ?>)">
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
    function deleteDriver(id) {
        // Show a confirmation dialog
        if (confirm("Are you sure you want to delete this driver? ")) {
            $.ajax({
                type: "POST",
                url: "/action/driver/deleteDriver.php",
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