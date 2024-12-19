<?php

use App\Models\Produk;

$product = (new Produk())->find($id);
?>

<form id="editProductForm" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $product->id ?>">
    <input type="hidden" name="oldImage" value="<?= $product->image ?>">
    <!-- Product Name -->
    <div class="mb-3">
        <label for="name" class="form-label">Product Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $product->name ?? '' ?>" placeholder="Enter Product Name" required>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <!-- Product Price -->
            <div class="mb-3">
                <label for="price" class="form-label">Product Price</label>
                <input type="number" min="0" class="form-control" id="price" name="price" value="<?= intval($product->price) ?? '' ?>" placeholder="Enter Product Price" required>
            </div>
        </div>
        <div class="col-lg-6">
            <!-- Product Size -->
            <div class="mb-3">
                <label for="size" class="form-label">Product Size Info</label>
                <input type="text" class="form-control" id="size" name="size" value="<?= $product->size ?? '' ?>" aria-describedby="sizeHelp" placeholder="Enter Size Info" required>
                <small id="sizeHelp" class="form-text text-muted">Informasi size seperti 2L , 150ml</small>
            </div>
        </div>
    </div>

    <!-- Product description -->
    <div class="mb-3">
        <label for="description" class="form-label">Product Description</label>
        <textarea name="description" id="description" class="form-control" cols="30" rows="5" required><?= $product->description ?? '' ?></textarea>
    </div>
    <!-- Product image -->
    <div class="mb-3">
        <label for="image" class="form-label">Product Image</label>
        <input type="file" class="form-control" id="image" name="image" aria-describedby="imageHelp">
        <small id="imageHelp" class="form-text text-muted">Kosongkan jika tidak ingin update gambar produk</small>

    </div>
    <!-- submit -->
    <button type="submit" class="btn btn-primary">Update Product</button>
    <button type="reset" class="btn btn-danger">Batal</button>
</form>
<script>
    $(document).ready(function() {
        $('#editProductForm').submit(function(event) {
            event.preventDefault();

            // Create a FormData object from the form
            const formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "/action/product/editProduct.php",
                data: formData,
                dataType: "json",
                contentType: false, // Important for file uploads
                processData: false, // Important for file uploads
                success: function(res) {
                    if (res.status == 'success') {
                        toastr.success(res.message);
                        setTimeout(function() {
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
        });
    });
</script>