<?php

use App\Models\Metadata;

$metadata = new Metadata();
?>
<footer class="main-footer">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url(assets/images/shape/shape-12.png);"></div>
        <div class="pattern-2" style="background-image: url(assets/images/shape/shape-13.png);"></div>
        <div class="pattern-3" style="background-image: url(assets/images/shape/shape-14.png);"></div>
    </div>
    <div class="auto-container">
        <div class="footer-top clearfix">
            <div class="line-shape" style="background-image: url(assets/images/shape/shape-11.png);"></div>
            <div class="text pull-left">
                <h2>Please <span>Call Us</span> to Take an Extraordinary Service</h2>
            </div>
            <div class="support-box pull-right">
                <a href="tel:7732253523"><i class="fas fa-phone"></i><?= $metadata->get('office_phone') ?></a>
            </div>
        </div>
        <div class="widget-section">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget logo-widget">
                        <figure class="footer-logo"><a href="index.html"><img src="assets/images/footer-logo.png" alt=""></a></figure>
                        <div class="text">
                            <p>Nostrud exertation ullamco labor nisi aliquip commodo duis.</p>
                        </div>
                        <div class="schedule-box">
                            <h6>Open Hours:</h6>
                            <ul class="list clearfix">
                                <li><?= $metadata->get('office_open_info') ?></li>
                                <li><?= $metadata->get('office_close_info') ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget contact-widget ml-70">
                        <div class="widget-title">
                            <h4>Address</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="info-list clearfix">
                                <li><i class="fal fa-map-marker-alt"></i><?= $metadata->get('office_location') ?></li>
                                <li><i class="fal fa-phone"></i>Call Us: <a href="tel:3336660001"><?= $metadata->get('office_phone') ?></a></li>
                                <li><i class="fal fa-envelope-open-text"></i><a href="mailto:info@example.com"><?= $metadata->get('office_email') ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget links-widget ml-70">
                        <div class="widget-title">
                            <h4>Usefull Link</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="links-list clearfix">
                                <li><a href="/">Home</a></li>
                                <li><a href="/contact">Contact</a></li>
                                <li><a href="/product">Product</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="bottom-inner">
                <div class="copyright">
                    <p><a href="/">Acuasafe</a> &copy; 2024 All Right Reserved</p>
                </div>
                <ul class="social-links clearfix">

                </ul>
                <ul class="footer-nav clearfix">

                </ul>
            </div>
        </div>
    </div>
</footer>