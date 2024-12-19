<?php
set_layout("dashboard");
set_title('Edit Product');
if (!isset($_GET['product_id']) && empty($_GET['product_id'])) {
    redirect('/dashboard/product/list_product');
}

$id = $_GET['product_id'];

?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?= component('product/edit', [
                    'id' => $id
                ]) ?>
            </div>
        </div>
    </div>
</div>