<?php
$order = new \App\Models\Order();
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
            <a href="/dashboard" class="side-nav-link">
                <i class="uil uil-dashboard"></i> <!-- Ikon Dashboard -->
                <span> Dashboard </span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="/dashboard/order/list_order" class="side-nav-link">
                <i class="uil uil-list-ul"></i> <!-- Ikon List Order -->
                <span> Order </span>
            </a>
        </li>

        <li class="side-nav-title">Pesanan</li>
        <li class="side-nav-item">
            <a href="/dashboard/order/new_order" class="side-nav-link">
                <i class=" ri-shopping-cart-line"></i> <!-- Ikon Pesanan Baru -->
                <span> New Order </span>
                <span class="badge bg-warning"><?= $order->joinCostumerWhereStatus('new')->num_rows ?></span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="/dashboard/order/otw_order" class="side-nav-link">
                <i class="uil uil-truck"></i> <!-- Ikon Pesanan OTW -->
                <span> Otw Order </span>
                <span class="badge bg-info"><?= $order->joinCostumerWhereStatus('otw')->num_rows ?></span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="/dashboard/order/canceled_order" class="side-nav-link">
                <i class="uil uil-times-circle"></i> <!-- Ikon Pesanan Dibatalkan -->
                <span> Canceled Order </span>
                <span class="badge bg-danger"><?= $order->joinCostumerWhereStatus('cancel')->num_rows ?></span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="/dashboard/order/completed_order" class="side-nav-link">
                <i class="uil uil-check-circle"></i> <!-- Ikon Pesanan Selesai -->
                <span> Completed Order </span>
            </a>
        </li>

        <li class="side-nav-title">Pengguna</li>
        <li class="side-nav-item">
            <a href="/dashboard/admin/list_admin" class="side-nav-link">
                <i class="uil uil-user-check"></i> <!-- Ikon Admin -->
                <span> Admin </span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="/dashboard/driver/list_driver" class="side-nav-link">
                <i class="uil uil-car"></i> <!-- Ikon Driver -->
                <span> Driver </span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="/dashboard/costumer/list_costumer" class="side-nav-link">
                <i class="uil uil-users-alt"></i> <!-- Ikon Customer -->
                <span> Customer </span>
            </a>
        </li>

        <li class="side-nav-title">Barang</li>
        <li class="side-nav-item">
            <a href="/dashboard/product/list_product" class="side-nav-link">
                <i class="uil uil-box"></i> <!-- Ikon Produk -->
                <span> List Product </span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="/dashboard/product/create_product" class="side-nav-link">
                <i class="uil uil-plus-circle"></i> <!-- Ikon Tambah Produk -->
                <span> Create Product </span>
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