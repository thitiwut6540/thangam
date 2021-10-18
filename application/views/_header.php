<nav class="customize_navbar navbar navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <div class="navbar_logo">
                <div class="logo"><img class="img-fluid" src="<?php echo base_url('public/images/logo/logo.png'); ?>"></div>
                <div class="txt_m my-auto">
                    <span>องค์การบริหารส่วนตำบลท่างาม</span><br>
                    <span>จังหวัดพิษณุโลก</span>
                </div>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#cv_menu" aria-controls="cv_menu">
            <i class="fas fa-th"></i> เมนูเพิ่มเติม
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="cv_menu" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
        </div>
    </div>
</nav>

<div id="carrousel_slideshow" class="carousel slide customize_carousel" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?php echo base_url('public/images/banner/test04.jpg'); ?>" >
        </div>
        <div class="carousel-item">
            <img src="<?php echo base_url('public/images/banner/test02.jpg'); ?>" >
        </div>
        <div class="carousel-item">
            <img src="<?php echo base_url('public/images/banner/test03.jpg'); ?>" >
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carrousel_slideshow" data-bs-slide="prev">
        <i class="fas fa-angle-left fa-fw fa-2x"></i>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carrousel_slideshow" data-bs-slide="next">
        <i class="fas fa-angle-right fa-fw fa-2x"></i>
    </button>
</div>


<div class="btn_scroll_top"><i class="fas fa-caret-up fa-fw"></i></div>