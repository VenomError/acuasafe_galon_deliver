<?php

use App\Models\Metadata;

set_title("contact");
$metadata = new Metadata();

?>
<?= component('sections/page_title', ['title' => 'Contact']) ?>

<section class="contact-style-two">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-4 col-sm-12 mb-4">
                <ul class="info-list clearfix">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <h5>Office Location</h5>
                        <p>
                            <?= $metadata->get('office_location') ?>
                        </p>
                    </li>

                </ul>
            </div>
            <div class="col-lg-4 col-sm-12 mb-4">
                <ul class="info-list clearfix">

                    <li>
                        <i class="fas fa-envelope-open"></i>
                        <h5>Email Drop Us</h5>
                        <p>
                            <a href="mailto:info@example.com">
                                <?= $metadata->get('office_email') ?>
                            </a>
                    </li>

                </ul>
            </div>
            <div class="col-lg-4 col-sm-12 mb-4">
                <ul class="info-list clearfix">

                    <li>
                        <i class="fas fa-phone"></i>
                        <h5>Call for Help</h5>
                        <p>
                            <a href="tel:11165458856">
                                <?= $metadata->get('office_phone') ?>
                            </a>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?= component('map') ?>
            </div>
        </div>

    </div>

</section>