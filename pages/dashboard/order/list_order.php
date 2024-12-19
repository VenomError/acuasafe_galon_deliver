<?php
set_layout("dashboard");
set_title('List Product');

?>


<div class="row">
    <div class="col-12">
        <?= component('order/table-list-order') ?>
    </div> <!-- end col -->
</div>