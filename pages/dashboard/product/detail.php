<?php
set_layout("dashboard");
set_title('Create Product');
if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
    redirect('/dashboard/product/list_product');
}

$id = $_GET['product_id'];

?>

<?= component('product/detail', [
    'id' => $id
]) ?>