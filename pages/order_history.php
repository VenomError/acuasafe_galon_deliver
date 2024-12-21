<?php

set_title('Checkout');
if (!auth_check()) {
    set_session('info', 'please login');
    redirect('/auth/login');
}
?>

<?= component('sections/order_history') ?>
