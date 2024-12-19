<?php

use App\Models\Produk;

$products = new Produk();
$data = $products->all();

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
            <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                <thead class="table-light">
                    <tr>
                        <th class="all">Product</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Created At</th>
                        <th style="width: 85px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $product) : ?>
                        <tr>
                            <td>
                                <img src="<?= $product['image'] ?? '' ?>" alt="contact-img" title="product-img" class="rounded me-3" width="100" />
                                <p class="m-0 d-inline-block align-middle font-16">
                                    <a href="/dashboard/product/detail?product_id=<?= $product['id'] ?>" class="text-primary"><?= ucwords($product['name']) ?></a>
                                </p>
                            </td>
                            <td>
                                <?= $product['size'] ?>
                            </td>

                            <td>
                                <?= RPformat($product['price']) ?>
                            </td>

                            <td>
                                <?= dateFormat($product['created_at']) ?>
                            </td>

                            <td class="table-action">
                                <a href="/dashboard/product/detail?product_id=<?= $product['id'] ?>" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                <a href="/dashboard/product/edit?product_id=<?= $product['id'] ?>" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                <button class="btn action-icon" onclick="deleteProduct(<?= $product['id'] ?>)">
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