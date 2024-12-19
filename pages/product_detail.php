<?php

use App\Models\Produk;

if (is_null(request()->product_id)) {
    redirect('/product');
}
$product = (new Produk())->find(request()->product_id);
if (!$product) {
    redirect('/product');
}
?>

<section class="shop-details">
    <div class="auto-container">
        <div class="product-details-content">
            <div class="shape" style="background-image: url(assets/images/shape/shape-39.png);"></div>
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <center>

                        <div class="image-box">
                            <figure class="image"><img src="<?= $product->image ?? '' ?>" alt=""></figure>
                            <div class="preview-link"><a href="<?= $product->image ?? '' ?>" class="lightbox-image" data-fancybox="gallery"><i class="far fa-search-plus"></i></a></div>
                        </div>
                    </center>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="product-details">
                        <h3><?= ucwords($product->name) ?></h3>
                        <h5>Rp <?= number_format($product->price, 2) ?></h5>
                        <div class="text">
                            <p>
                                <?= nl2br($product->description) ?>
                            </p>
                            <div class="other-option mt-2">
                                <ul class="list">
                                    <b>
                                        <li>Size :</li>
                                        <li><?= $product->size ?></li>
                                    </b>
                                </ul>
                            </div>
                        </div>
                        <div class="addto-cart-box">
                            <ul class="clearfix">
                                <form action="/action/addToCart.php" method="post">
                                    <li class="item-quantity">
                                        <input class="quantity-spinner" type="text" value="1" name="quantity">
                                    </li>
                                    <input type="hidden" name="product_id" value="<?= $product->id ?>">
                                    <input type="hidden" name="name" value="<?= $product->name ?>">
                                    <input type="hidden" name="image" value="<?= $product->image ?>">
                                    <input type="hidden" name="price" value="<?= $product->price ?>">
                                    <li><button type="submit" class="theme-btn btn-one">Add To Cart</button></li>
                                </form>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>