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
            <div class="row">
                <div class="col-12">
                    <div id="mapDirection" style="height: 500px;"></div>
                </div>
            </div>
        </div>
    </form>

</section>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<?php

use App\Models\Metadata;

$metadata = new Metadata();
$latitudeFrom = (float) $metadata->get('office_latitude');
$longitudeFrom = (float) $metadata->get('office_longitude');

?>

<style>
    /* Mengubah warna latar belakang dan teks popup */
    .leaflet-popup-content-wrapper {
        background-color: #4A90E2;
        /* Warna latar belakang popup */
        color: #fff;
        /* Warna teks popup */
        border-radius: 8px;
        /* Membuat sudut popup lebih membulat */
    }

    /* Mengubah warna panah (arrow) popup */
    .leaflet-popup-tip {
        background-color: #4A90E2;
        /* Warna panah popup */
    }

    /* Mengubah warna tautan di dalam popup jika ada */
    .leaflet-popup-content a {
        color: #FFD700;
        /* Warna tautan popup */
    }
</style>

<script>
    const map = L.map('mapDirection').setView([<?= $latitudeFrom ?>, <?= $longitudeFrom ?>], 13);
    const acuasfeMarker = L.marker([<?= $latitudeFrom ?>, <?= $longitudeFrom ?>]).addTo(map)
        .bindPopup('<center><b>ACUASFE</b></center><span><br>Lokasi office acusafe</span>').openPopup();
    // Menambahkan Tile Layer dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Elemen untuk input dan tombol
    const latitude = document.getElementById('latitude');
    const longitude = document.getElementById('longitude');
    const distance = document.getElementById('distance');
    const submitBtn = document.getElementById('submitButton');
    const failedGetLocation = document.getElementById("failedGetLocation");

    let marker; // Menyimpan marker global
    let routingControl; // Menyimpan kontrol routing global

    // Fungsi untuk memeriksa apakah field latitude dan longitude terisi
    function checkFields() {
        if (latitude.value !== "" && longitude.value !== "") {
            submitBtn.setAttribute('type', 'submit');
            submitBtn.disabled = false;
        } else {
            toastr.warning('Dapatkan lokasi Anda terlebih dahulu');
            submitBtn.setAttribute('type', 'button');
            submitBtn.disabled = true;
        }
    }

    // Fungsi untuk mendapatkan lokasi pengguna
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            failedGetLocation.innerHTML = "Geolocation tidak didukung oleh browser ini.";
        }
    }

    // Fungsi untuk menangani posisi pengguna
    function showPosition(position) {
        const userLat = position.coords.latitude;
        const userLng = position.coords.longitude;

        latitude.value = userLat;
        longitude.value = userLng;
        checkFields();

        // Jika marker belum ada, buat marker baru, jika sudah ada, perbarui posisinya
        if (!marker) {
            const marker = L.marker([userLat, userLng], {
                    draggable: true
                }).addTo(map)
                .bindPopup('Lokasi Anda', {
                    autoPan: false
                })
                .openPopup();
            // Update latitude dan longitude saat marker dipindah
            marker.on('dragend', function(e) {
                const latLng = e.target.getLatLng();
                latitude.value = latLng.lat;
                longitude.value = latLng.lng;
                checkFields();
                updateRoute(latLng.lat, latLng.lng);
            });
        } else {
            marker.setLatLng([userLat, userLng]); // Perbarui posisi marker
        }

        // Update rute setiap kali posisi marker berubah
        updateRoute(userLat, userLng);

        // Hitung jarak dengan fetch API
        fetch('/action/getDistance.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    latitude: userLat,
                    longitude: userLng
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

    // Fungsi untuk menangani error geolokasi
    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                failedGetLocation.innerHTML = "Pengguna menolak permintaan geolokasi.";
                break;
            case error.POSITION_UNAVAILABLE:
                failedGetLocation.innerHTML = "Informasi lokasi tidak tersedia.";
                break;
            case error.TIMEOUT:
                failedGetLocation.innerHTML = "Permintaan lokasi timeout.";
                break;
            case error.UNKNOWN_ERROR:
                failedGetLocation.innerHTML = "Terjadi kesalahan yang tidak diketahui.";
                break;
        }
    }

    // Fungsi untuk memperbarui rute ketika marker dipindahkan
    function updateRoute(lat, lng) {
        // Hapus rute lama
        if (routingControl) {
            map.removeControl(routingControl);
        }

        // Tambahkan rute baru
        routingControl = L.Routing.control({
            waypoints: [
                L.latLng(<?= $latitudeFrom ?>, <?= $longitudeFrom ?>), // Titik awal
                L.latLng(lat, lng) // Lokasi baru dari marker yang dipindah
            ],
            routeWhileDragging: true
        }).addTo(map);
    }
</script>