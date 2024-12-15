<section class="checkout-section">
    <form action="/action/checkout.php" method="post" class="billing-form">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 left-column">
                    <div class="inner-box">
                        <div class="billing-info">
                            <h4 class="sub-title">Billing Details</h4>
                            <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label>Full Name</label>
                                    <div class="field-input">
                                        <input type="text" value="<?= auth()->name ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label>Email</label>
                                    <div class="field-input">
                                        <input type="text" value="<?= auth()->email ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label>Phone</label>
                                    <div class="field-input">
                                        <input type="text" value="<?= auth()->phone ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label>Address <small class="text-danger">*</small></label>
                                    <div class="field-input">
                                        <input type="text" name="address" required>
                                    </div>
                                    <small>berikan informasi alamat lengkap anda</small>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label>Address Detail <small class="text-danger">*</small></label>
                                    <div class="field-input">
                                        <input type="text" name="address_detail" required>
                                    </div>
                                    <small>berikan informasi detail alamat , seperti warna rumah , nomor rumah , dsb.</small>
                                </div>

                                <!-- geolocation -->
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <span class="text-danger" id="failedGetLocation"></span>
                                    <label>Jarak (Km)</label>
                                    <div class="field-input">
                                        <input type="text" readonly id="distance" required name="distance">
                                    </div>

                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                    <label>Latitude</label>
                                    <div class="field-input">
                                        <input type="text" readonly id="latitude" name="latitude" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                    <label>Latitude</label>
                                    <div class="field-input">
                                        <input type="text" readonly id="longitude" name="longitude">
                                    </div>
                                </div>
                                <small>jarak rumah anda dengan depot galon , klik tombol di bawah untuk mendapatkan informasi jarak dan lokasi</small>
                                <div>
                                    <button class="btn btn-info" type="button" onclick="getLocation()">Dapatkan Informasi Jarak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 right-column">
                    <div class="inner-box">
                        <div class="order-info">
                            <h4 class="sub-title">Your Order</h4>
                            <div class="order-product">
                                <ul class="order-list clearfix">
                                    <li class="title clearfix">
                                        <p>Product</p>
                                        <span>Total</span>
                                    </li>
                                    <?php foreach (session('cart') ?? [] as $cart) : ?>
                                        <li>
                                            <div class="single-box clearfix">
                                                <input type="hidden">
                                                <img src="assets/images/resource/shop/order-1.jpg" alt="">
                                                <h6><?= ucwords($cart['name']) ?> x <?= $cart['quantity'] ?></h6>
                                                <span>Rp <?= number_format(toFloat($cart['price']), 2) ?></span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                    <li class="order-total clearfix">
                                        <?php
                                        $total = 0;
                                        foreach (session('cart') ?? [] as $cart) {
                                            $total += $cart['quantity'] * toFloat($cart['price']);
                                        }
                                        ?>
                                        <h6>Order Total</h6>
                                        <span>Rp <?= number_format($total, 2) ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="payment-info">
                            <h4 class="sub-title">Metode Pembayaran</h4>
                            <div class="payment-inner">
                                <div class="option-block">
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control material-checkbox">
                                            <input type="radio" class="material-control-input" value="transfer" name="payment_method" checked>

                                            <span class="material-control-indicator"></span>
                                            <span class="description">Bank Transfer</span>
                                        </label>
                                    </div>
                                    <p>
                                        pembayaran via Transfer antar bank
                                    </p>
                                </div>
                                <div class="option-block">
                                    <div class="custom-controls-stacked">
                                        <label class="custom-control material-checkbox">
                                            <input type="radio" class="material-control-input" name="payment_method" value="cod">
                                            <span class="material-control-indicator"></span>
                                            <span class="description">COD</span>
                                        </label>
                                    </div>
                                    <p>
                                        COD (Cash on Delivery) , pembayaran saat barang telah tiba menggunakan cash
                                    </p>
                                </div>
                                <div class="btn-box">
                                    <button type="button" onclick="getLocation()" id="submitButton" class="theme-btn btn-one">Pesan Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</section>

<script>
    const x = document.getElementById("failedGetLocation");

    const submitBtn = document.getElementById('submitButton');

    function checkFields() {
        if (latitude.value !== "" && longitude.value !== "") {
            submitBtn.setAttribute('type', 'submit');
        } else {
            toastr.warning('dapatkan lokasi anda terlebih dahulu');
            submitBtn.setAttribute('type', 'button');
            submitBtn.disabled = true;
        }
    }

    const latitude = document.getElementById('latitude');
    const longitude = document.getElementById('longitude');
    const distance = document.getElementById('distance');

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }

    }

    function showPosition(position) {

        latitude.value = position.coords.latitude;
        longitude.value = position.coords.longitude;
        checkFields();
        fetch('/action/getDistance.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude
                })
            })
            .then(response => response.json())
            .then(data => {
                distance.value = data.distance;
            })
            .catch(error => {
                toastr.error(error, 'Error');
            });

    }
</script>