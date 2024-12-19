<?php

use App\Models\OrderItem;
use App\Models\Produk;

$product = (new Produk())->find($id);
$productOrderCount = (new OrderItem())->getTotalQuantityByProduct($id);
$order_count = (new OrderItem())->getByProduct($id);
$order_count = count($order_count);
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-5">
                        <!-- Product image -->
                        <a href="javascript: void(0);" class="text-center d-block mb-4">
                            <img src="<?= $product->image ?? '' ?>" class="img-fluid" style="width: 280px;" alt="Product-img">
                        </a>
                    </div> <!-- end col -->
                    <div class="col-lg-7">
                        <form class="ps-lg-4">
                            <!-- Product title -->
                            <h3 class="mt-0"><?= ucwords($product->name) ?> <a href="javascript: void(0);" class="text-muted"><i class="mdi mdi-square-edit-outline ms-2"></i></a> </h3>
                            <p class="mb-1">Added Date: <?= dateFormat($product->created_at)  ?></p>

                            <!-- Product description -->
                            <div class="mt-4">
                                <h6 class="font-14">Price:</h6>
                                <h3> <?= RPformat($product->price) ?></h3>
                            </div>

                            <!-- Product description -->
                            <div class="mt-4">
                                <h6 class="font-14">Description:</h6>
                                <p>
                                    <?= nl2br(htmlspecialchars($product->description)) ?>
                                </p>
                            </div>

                            <!-- Product information -->
                            <div class="mt-4">
                                <div class="row">

                                    <div class="col-md-4">
                                        <h6 class="font-14">Total Order:</h6>
                                        <p class="text-sm lh-150"><?= $order_count ?? 0 ?></p>
                                    </div>

                                    <div class="col-md-4">
                                        <h6 class="font-14">Total Order Quantity:</h6>
                                        <p class="text-sm lh-150"><?= number_format($productOrderCount) ?></p>
                                    </div>

                                </div>
                            </div>

                        </form>
                    </div> <!-- end col -->
                </div> <!-- end row-->

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>