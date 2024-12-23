<?php
$orders = new \App\Models\Order();
$id = driver()->id;
?>

<div class="h-100" id="leftside-menu-container" data-simplebar>
    <!-- Leftbar User -->
    <div class="leftbar-user">
        <a href="pages-profile.html">
            <img src="/assets/hyper/images/users/avatar-1.jpg" alt="user-image" height="42" class="rounded-circle shadow-sm">
            <span class="leftbar-user-name mt-2">Dominic Keller</span>
        </a>
    </div>

    <!--- Sidemenu -->
    <ul class="side-nav">
        <li class="side-nav-title">Dashboard</li>
        <li class="side-nav-item">
            <a href="/driver" class="side-nav-link">
                <i class="uil uil-list-ul"></i> <!-- Ikon List Order -->
                <span> Order <span class="badge bg-danger">

                        <?= $orders->getByDriverAndConfirmWhereStatus($id, 'new')->num_rows ?>
                    </span> </span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="/driver/order/otw" class="side-nav-link">
                <i class="uil uil-truck"></i> <!-- Ikon Pesanan Selesai -->
                <span> Otw Order
                    <span class="badge bg-info">
                        <?= $orders->getByDriverAndConfirmWhereStatus($id, 'otw')->num_rows ?>
                    </span>
                </span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="/driver/order/completed" class="side-nav-link">
                <i class="uil uil-check-circle"></i> <!-- Ikon Pesanan Selesai -->
                <span> Completed Order </span>
            </a>
        </li>
        <li class="side-nav-title">Setting</li>
        <li class="side-nav-item">
            <a href="/dashboard/setting/metadata" class="side-nav-link">
                <i class=" ri-file-settings-line"></i> <!-- Ikon Pengaturan -->
                <span> Metadata </span>
            </a>
        </li>
    </ul>
    <!--- End Sidemenu -->

    <div class="clearfix"></div>
</div>