<?php


set_layout('dashboard');
set_title('Metadata Setting');


?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?= component('setting/metadata') ?>
            </div>
        </div>
    </div>
</div>

<div class="row ">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-body">
                <?= component('map') ?>
            </div>
        </div>
    </div>
</div>