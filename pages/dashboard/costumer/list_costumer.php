<?php
set_layout("dashboard");
set_title('List Costumer');

?>


<div class="row">
    <div class="col-12">
        <?= component('costumer/table-list-costumer') ?>
    </div> <!-- end col -->
</div>