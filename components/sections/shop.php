<?php

use App\Models\Produk;

$products = (new Produk)->query("SELECT * FROM product")
    ->fetch_all(MYSQLI_ASSOC);

?>

<section class="shop-section centred">
    <div class="auto-container">
        <div class="sec-title">
            <h2>We Deliver Best Quality <br />Bottle Packs.</h2>
        </div>
        <div class="row clearfix">
            <?php foreach ($products as $product) : ?>
                <div class="col-lg-4 col-md-6 col-sm-12 shop-block">
                    <div class="shop-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500m">
                        <div class="inner-box">
                            <figure class="image-box"><img src="assets/images/resource/shop/shop-1.jpg" alt=""></figure>
                            <div class="lower-content">
                                <div class="shape" style="background-image: url(assets/images/shape/shape-7.png);"></div>
                                <span><?= $product['size'] ?></span>
                                <h4><a href="shop-details.html"><?= ucwords($product['name']) ?></a></h4>
                                <h6>Rp <?= number_format($product['price'], 2) ?></h6>
                                <p>
                                    <?= nl2br(htmlspecialchars($product['description'])) ?>
                                </p>
                                <div class="btn-box">
                                    <form action="/action/addToCart.php" method="post">
                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                        <input type="hidden" name="name" value="<?= $product['name'] ?>">
                                        <input type="hidden" name="image" value="<?= $product['image'] ?>">
                                        <input type="hidden" name="price" value="<?= $product['price'] ?>">
                                        <button type="submit" class="theme-btn btn-two">Add to cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>