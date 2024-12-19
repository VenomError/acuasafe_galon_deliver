<?php
set_layout("dashboard");
set_title('List Product');

?>


<div class="row">
    <div class="col-12">
        <?= component('product/table-list-product') ?>
    </div> <!-- end col -->
</div>