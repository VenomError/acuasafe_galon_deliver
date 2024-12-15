<?php

set_title('Checkout');
if (!auth_check()) {
    set_session('info', 'please login');
    redirect('/auth/login');
}

if (is_null(session('cart'))) {
    set_session('warning', 'tidak ada product dalam cart');
    return redirect('/cart');
}
?>

<?= component('sections/page_title', ['title' => 'Checkout']) ?>
<?= component('product/checkout') ?>
