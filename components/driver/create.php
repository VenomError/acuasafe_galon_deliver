<form id="createDriver">
    <div class="mb-3">
        <label for="name" class="form-label"> Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter  Name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label"> Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter  Email" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label"> Phone</label>
        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter  Phone" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group input-group-merge">
            <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password" required value="password">
            <div class="input-group-text" data-password="false">
                <span class="password-eye"></span>
            </div>
        </div>
        <small>input password untuk login driver default <span class="text-danger">(password)</span></small>
    </div>

    <!-- submit -->
    <button type="submit" class="btn btn-primary">Create Driver</button>
    <button type="reset" class="btn btn-danger">Batal</button>
</form>
<script>
    $(document).ready(function() {
        $('#createDriver').submit(function(event) {
            event.preventDefault();

            // Create a FormData object from the form
            const formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "/action/driver/createDriver.php",
                data: formData,
                dataType: "json",
                contentType: false, // Important for file uploads
                processData: false, // Important for file uploads
                success: function(res) {
                    if (res.status == 'success') {
                        toastr.success(res.message);
                        $('#createDriver').trigger('reset');
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