
<div class="row">
    <div class="col px-0">
        <div id="header"><?php $this->load->view('_header');?></div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-lg-auto p-0">
        <div class="ct_leftside_box">
            <div class="ct_leftside_menu">
                <?php $this->load->view('_menu');?>
            </div>
        </div>
    </div>
    <div class="col px-0">
        <div id="section_menu_carousel">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 px-0">
                        <div id="crl_menu" class="carousel slide customize_menu_carousel" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#crl_menu" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#crl_menu" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row px-3">
                                        <?php 
                                        for($x = 1; $x <= 4; $x++) {
                                        ?>
                                        <div class="col-12 col-md-6 col-lg-4 col-xl-3  mb-3 mb-lg-0 text-center">
                                            <a class="btn" href="#">
                                                <div class="">
                                                    <div class="mb-2"><i class="fas fa-apple-alt fa-fw fa-3x"></i></div>
                                                    <h3 class="h4 mb-2">ร้องขอบริการต่างๆ</h3>
                                                    <p class="text-muted mb-0">Our themes are updated regularly to keep them bug free!</p>
                                                </div>
                                            </a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row px-3">
                                        <?php 
                                        for($x = 1; $x <= 4; $x++) {
                                        ?>
                                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-lg-0 text-center">
                                            <a class="btn" href="#">
                                                <div class="">
                                                    <div class="mb-2"><i class="fas fa-apple-alt fa-fw fa-3x"></i></div>
                                                    <h3 class="h4 mb-2">ร้องขอบริการต่างๆ</h3>
                                                    <p class="text-muted mb-0">Our themes are updated regularly to keep them bug free!</p>
                                                </div>
                                            </a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="section_chief" class="customize_chief">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-5 my-auto">
                        <div class="chief_photo">
                            <img src="<?php echo base_url('public/images/chief/dev-01.png'); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-lg-7 my-auto ">
                        <div class="chief_introduce mt-5 mt-lg-0">
                            <div>
                                "Working with Start Bootstrap templates has saved me tons of development time when building new projects! 
                                Starting with a Bootstrap template just makes things easier!"
                            </div>
                            <div class="text-center">
                                Thitiwut Boonrod / Bootstrap templates
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="section_gal" class="customize_gal">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-4 mb-5">
                        <div class="gal_header">
                            <div>แกลเลอรี่กิจกรรม</div>
                            <div>Gallery</div>
                            <div>
                                readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal 
                                distribution of letters, as opposed to using
                            </div>
                            <div>
                                <a class="btn" href="<?php echo base_url('แกลลอรี่ทั้งหมด'); ?>"><i class="fas fa-list-ul"></i> แกลลอรี่ทั้งหมด</a>
                            </div>
                        </div>
                    </div>
                    <?php for($x = 1; $x <= 5; $x++) {?>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-4 mb-5">
                        <div class="card h-100 border">
                            <div class="gal_photo"><img src="<?php echo base_url('public/images/background/00'.$x.'.jpg'); ?>"></div>
                            <div class="card-body p-4">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>
                                <a class="text-decoration-none stretched-link" href="<?php echo base_url('แกลลอรี่/01'); ?>"><h5 class="card-title mb-3">Blog post title</h5></a>
                                <p class="card-text mb-0">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                <div class="d-flex align-items-end justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3"><i class="fas fa-calendar-alt"></i></div>
                                        <div class="small">
                                            <div class="text-muted">March 12, 2021</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div id="section_news" class="customize_news">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 text-center mb-4">
                        <div class="news_header">
                            <div>ข่าวสาร</div>
                            <div>แสดงรายการข่าวสารล่าสุด 6 กิจกรรม</div>
                            <div class="news_menu_scroll">
                                <!-- <a class="btn"><i class="fas fa-list-ul"></i> ข่าวประชาสัมพ้นธ์ทั้งหมด</a> -->
                                <div class="row d-flex justify-content-center">
                                    <div class="col-12 col-lg-auto"><a class="btn" href="<?php echo base_url('ข่าวสาร/ข่าวประชาสัมพันธ์'); ?>"><i class="fas fa-list-ul"></i> ข่าวประชาสัมพันธ์</a></div>
                                    <div class="col-12 col-lg-auto"><a class="btn" href="<?php echo base_url('ข่าวสาร/ข่าวจัดซื้อจัดจ้าง'); ?>"><i class="fas fa-list-ul"></i> ข่าวจัดซื้อจัดจ้าง</a></div>
                                    <div class="col-12 col-lg-auto"><a class="btn" href="<?php echo base_url('ข่าวสาร/ประกาศรับสมัคร'); ?>"><i class="fas fa-list-ul"></i> ประกาศรับสมัคร</a></div>
                                    <div class="col-12 col-lg-auto"><a class="btn" href="<?php echo base_url('ข่าวสาร/คู่มือประชาชน'); ?>"><i class="fas fa-list-ul"></i> คู่มือประชาชน</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php for($x = 1; $x <= 6; $x++) {?>
                    <div class="col-lg-4 mb-5">
                        <a href="<?php echo base_url('ข่าวสาร/ข่าวประชาสัมพันธ์/ข่าวต่างๆ'); ?>">
                            <div class="news_box">
                                <!-- <div class="news_icon"><i class="far fa-newspaper fa-fw fa-3x"></i></div> -->
                                <div class="news_text">
                                    <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>
                                    <!-- <h5>ข่าวประชาสัมพ้นธ์</h5> -->
                                    <div class="small">
                                        <div class="text-muted">กองคลัง</div>
                                    </div>
                                    <span>
                                        See how your users experience your website in realtime or view trends to see any changes in performance over time.
                                    </span>
                                    <div class="d-flex align-items-center mt-3">
                                        <div class="me-3"><i class="fas fa-calendar-alt"></i></div>
                                        <div class="small">
                                            <div class="text-muted">March 12, 2021</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div id="section_related" class="customize_related">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 mb-5 text-center">
                        <div class="related_header">
                            <div>หน่วยงานที่เกี่ยวข้อง</div>
                            <div>แสดงรายการข่าวสารล่าสุด 3 กิจกรรม</div>
                        </div>
                    </div>
                    <?php for($x = 1; $x <= 7; $x++) {?>
                    <div class="col-6 col-lg-3 mb-3 mb-lg-5">
                        <div class="related_photo"><img src="<?php echo base_url('public/images/related/00'.$x.'.png'); ?>"></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <footer><?php $this->load->view('_footer');?></footer>
    </div>
</div>



