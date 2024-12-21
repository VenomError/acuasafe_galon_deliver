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
                <i class=" uil-graph-bar"></i>
                <span> Dashboard </span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="/dashboard/order/list_order" class="side-nav-link">
                <i class="  uil-streering"></i>
                <span> Order </span>
            </a>
        </li>

        <li class="side-nav-title"> Pesanan </li>
        <?php
        $order = new \App\Models\Order();
        ?>

        <li class="side-nav-item">
            <?php
            $orderCount = $order->joinCostumerWhereStatus('new')->num_rows;
            ?>
            <a href="/dashboard/order/new_order" class="side-nav-link">
                <i class="  uil-streering"></i>
                <span> New Order </span>
                <span class="badge bg-warning"><?= $orderCount ?></span>
            </a>
        </li>
        <li class="side-nav-item">
            <?php
            $orderCount = $order->joinCostumerWhereStatus('otw')->num_rows;
            ?>
            <a href="/dashboard/order/otw_order" class="side-nav-link">
                <i class="  uil-streering"></i>
                <span> Otw Order </span>
                <span class="badge bg-info"><?= $orderCount ?></span>
            </a>
        </li>
        <li class="side-nav-item">
            <?php
            $orderCount = $order->joinCostumerWhereStatus('cancel')->num_rows;
            ?>
            <a href="/dashboard/order/canceled_order" class="side-nav-link">
                <i class="  uil-streering"></i>
                <span> Canceled Order </span>
                <span class="badge bg-danger"><?= $orderCount ?></span>
            </a>
        </li>
        <li class="side-nav-item">
            <?php
            $orderCount = $order->joinCostumerWhereStatus('cancel')->num_rows;
            ?>
            <a href="/dashboard/order/completed_order" class="side-nav-link">
                <i class="  uil-streering"></i>
                <span> Completed Order </span>
            </a>
        </li>

        <li class="side-nav-title">Pengguna</li>

        <li class="side-nav-item">
            <a href="/dashboard/admin/list_admin" class="side-nav-link">
                <i class=" uil-users-alt"></i>
                <span> Admin </span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="/dashboard/driver/list_driver" class="side-nav-link">
                <i class="  uil-streering"></i>
                <span> Driver </span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="/dashboard/costumer/list_costumer" class="side-nav-link">
                <i class=" uil-users-alt"></i>
                <span> Costumer </span>
            </a>
        </li>

        <li class="side-nav-title"> Barang </li>

        <li class="side-nav-item">
            <a href="/dashboard/product/list_product" class="side-nav-link">
                <i class="  uil-streering"></i>
                <span> List Product </span>
            </a>
        </li>
        <li class="side-nav-item">
            <a href="/dashboard/product/create_product" class="side-nav-link">
                <i class="  uil-streering"></i>
                <span> Create Product </span>
            </a>
        </li>



    </ul>
    <!--- End Sidemenu -->

    <div class="clearfix"></div>
</div>