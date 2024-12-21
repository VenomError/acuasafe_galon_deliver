<!-- Personal-Information -->
<div class="card">
    <div class="card-body">
        <h4 class="header-title mt-0 mb-3">Driver Information</h4>

        <hr>

        <div class="text-start">
            <p class="text-muted"><strong>Full Name :</strong> <span class="ms-2"><?= ucwords($driver->name ?? '') ?></span></p>

            <p class="text-muted"><strong>Phone :</strong><span class="ms-2"><?= $driver->phone ?? '' ?></span></p>

            <p class="text-muted"><strong>Email :</strong> <span class="ms-2"><?= $driver->phone ?? '' ?></span></p>


        </div>
    </div>
</div>
<!-- Personal-Information -->

<!-- Toll free number box-->
<div class="card text-white bg-info overflow-hidden">
    <div class="card-body">
        <div class="toll-free-box text-center">
            <h4 class="text-reset"> <i class="mdi mdi-deskphone"></i> Phone : <?= $driver->phone ?? '' ?></h4>
        </div>
    </div> <!-- end card-body-->
</div> <!-- end card-->
<!-- End Toll free number box-->