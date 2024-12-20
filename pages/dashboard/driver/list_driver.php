<?php
set_layout("dashboard");
set_title('List Driver');

?>


<div class="row">
    <div class="col-12">
        <?= component('driver/table-list-driver') ?>
    </div> <!-- end col -->
</div>