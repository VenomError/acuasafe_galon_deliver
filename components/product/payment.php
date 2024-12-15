<?php

use App\Models\Order;
use App\Models\OrderItem;

if (is_null(request()->order_id)) {
    set_session('error', 'order not found');
    redirect("/cart");
}
$order_id = request()->order_id;
$order = (new Order())->find($order_id);
if (!$order) {
    set_session("error", "Failed to Get order");
    redirect("/cart");
}

$order_item = (new OrderItem())->getByOrder($order_id);

?>
<section class="checkout-section">
    <form action="/action/paymentConfirmation.php" method="post" class="billing-form" enctype="multipart/form-data">
        <input type="hidden" required name="order_id" value="<?= $order_id ?>">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 left-column">
                    <div class="inner-box">
                        <div class="billing-info">
                            <h4 class="sub-title">Billing Details </h4>
                            <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label>Full Name</label>
                                    <div class="field-input">
                                        <p>
                                            <?= auth()->name ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label>Email</label>
                                    <div class="field-input">
                                        <p><?= auth()->email ?></p>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label>Phone</label>
                                    <div class="field-input">
                                        <p>
                                            <?= auth()->phone ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label>Address <small class="text-danger">*</small></label>
                                    <div class="field-input">
                                        <p><?= $order->address  ?? '' ?></p>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label>Address Detail <small class="text-danger">*</small></label>
                                    <div class="field-input">
                                        <p><?= $order->address_detail ?? '' ?></p>
                                    </div>
                                </div>

                                <!-- geolocation -->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <span class="text-danger" id="failedGetLocation"></span>
                                        <label>Jarak (Km)</label>
                                        <div class="field-input">
                                            <p><?= $order->distance ?? '' ?> Km</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <span class="text-danger" id="failedGetLocation"></span>
                                        <label>Latitude</label>
                                        <div class="field-input">
                                            <p><?= $order->latitude ?? '' ?> </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <span class="text-danger" id="failedGetLocation"></span>
                                        <label>Longitude</label>
                                        <div class="field-input">
                                            <p><?= $order->longitude ?? '' ?> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 right-column">
                    <div class="inner-box">
                        <div class="payment-info">
                            <h4 class="sub-title">Metode Pembayaran</h4>
                            <div class="payment-inner">
                                <?php if ($order->payment_method == 'transfer') : ?>
                                    <div class="option-block">
                                        <div class="custom-controls-stacked">

                                            <span class="material-control-indicator"></span>
                                            <span class="description">Bank Transfer</span>

                                        </div>
                                        <p>
                                            silahkan melakukan pembayaran ke rekening di bawah !
                                            serta kirim bukti pembayarannya
                                        </p>

                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group mt-3">
                                        <label>Upload Bukti Pembayaran</label>
                                        <div class="field-input">
                                            <input type="file" required name="resit">
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="option-block">
                                        <div class="custom-controls-stacked">

                                            <span class="material-control-indicator"></span>
                                            <span class="description">COD</span>

                                        </div>
                                        <p>
                                            COD (Cash on Delivery) , pembayaran saat barang telah tiba menggunakan cash
                                        </p>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                    <div class="order-info mt-5">

                        <div class="order-product">
                            <ul class="order-list clearfix">
                                <li class="order-total clearfix">
                                    <h6>Order Total</h6>
                                    <span>Rp <?= number_format($order->total_amount, 2) ?></span>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="btn-box">
                                <?php if ($order->payment_method == 'transfer') : ?>
                                    <button type="submit" class="theme-btn btn-one">konfirmasi pembayaran</button>
                                <?php else : ?>
                                    <a href="/" class="theme-btn btn-one">konfirmasi pembayaran</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</section>