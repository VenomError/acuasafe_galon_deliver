<?php
set_title('Payment Confirmation');
if (!auth_check()) {
    set_session('info', 'please login');
    redirect('/auth/login');
}

?>

<?= component('sections/page_title', ['title' => 'Payment Confirmation']) ?>
<?= component('product/payment') ?>
<!-- <div class="row">
    <div class="col-12">
        <?= component('map_direction', [
            'latitudeFrom' => '-5.1375500',
            'longitudeFrom' => '119.4866300',
            'latitudeTo' => '-5.1385211',
            'longitudeTo' => '119.4876823',
        ]) ?>
    </div>
</div> -->