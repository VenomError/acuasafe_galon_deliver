<li><a href="/">Home</a></li>
<li><a href="/contact">Kontak</a></li>
<li><a href="/product">Product</a></li>
<?php if (auth_check()) : ?>
    <li><a href="/order_history">Order History</a></li>
<?php endif; ?>