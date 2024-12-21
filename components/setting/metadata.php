<?php

use App\Models\Metadata;

$metadatas = new Metadata();

?>

<form class="form-horizontal" id="formUpdateMetadata">
    <?php foreach ($metadatas->all() as $item): ?>
        <div class="row mb-3">
            <label for="input_<?= $item['key'] ?>" class="col-3 col-form-label">
                <?= ucwords(str_replace('_', ' ', $item['key'])) ?>
            </label>
            <div class="col-9">
                <input type="text" class="form-control" id="input_<?= $item['key'] ?>" name="<?= $item['key'] ?>" value="<?= $item['value'] ?>">
            </div>
        </div>
    <?php endforeach; ?>
    <div class="justify-content-end row">
        <div class="col-9">
            <button type="submit" class="btn btn-info">Update</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('#formUpdateMetadata').submit(function(event) {
            event.preventDefault();

            // Create a FormData object from the form
            const formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "/action/setting/updateMetadata.php",
                data: formData,
                dataType: "json",
                contentType: false, // Important for file uploads
                processData: false, // Important for file uploads
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
        });
    });
</script>