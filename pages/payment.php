<?php
set_title('Payment Confirmation');
if (!auth_check()) {
    set_session('info', 'please login');
    redirect('/auth/login');
}

?>

<?= component('sections/page_title', ['title' => 'Payment Confirmation']) ?>
<?= component('product/payment') ?>