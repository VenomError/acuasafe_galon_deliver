<li class="search-box-outer">
    <?php if (auth_check()): ?>
        <a href="/logout" class="btn btn-danger ">Logout</a>
    <?php else : ?>
        <a href="/auth/login" class="btn btn-primary ">Login</a>
        <a href="/auth/register" class="btn btn-primary ">Register</a>
    <?php endif  ?>
</li>
<li class="cart-box">
    <a href="/cart"><i class="fal fa-shopping-cart"></i><span><?= count(session('cart') ?? []) ?></span></a>
</li>