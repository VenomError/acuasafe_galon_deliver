<header class="main-header">
    <!-- header-lower -->
    <div class="header-lower">
        <div class="shape" style="background-image: url(assets/images/shape/shape-1.png);"></div>
        <div class="outer-box">
            <div class="logo-box">
                <figure class="logo"><a href="/"><img src="assets/images/logo.png" alt=""></a></figure>
            </div>
            <div class="menu-area clearfix">
                <!--Mobile Navigation Toggler-->
                <div class="mobile-nav-toggler">
                    <i class="icon-bar"></i>
                    <i class="icon-bar"></i>
                    <i class="icon-bar"></i>
                </div>
                <nav class="main-menu navbar-expand-md navbar-light">
                    <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                        <ul class="navigation clearfix">
                            <?= component('partials/header-left') ?>
                        </ul>
                    </div>
                </nav>
            </div>
            <ul class="nav-right">

                <?= component('partials/header-right') ?>

            </ul>
        </div>
    </div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="outer-box">
            <div class="logo-box">
                <figure class="logo"><a href="/"><img src="assets/images/logo.png" alt=""></a></figure>
            </div>
            <div class="menu-area clearfix">
                <nav class="main-menu clearfix">

                </nav>
            </div>
            <ul class="nav-right">
                <?= component('partials/header-right') ?>
            </ul>
        </div>
    </div>
</header>