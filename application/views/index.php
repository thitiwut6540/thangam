
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
                     <?php $this->load->view('_service');?>
                    </div>
                </div>
            </div>
        </div>

        <div id="section_chief" class="customize_chief">
            <?php
                $RePD=$this->M_Company_m->getMenuPresident();
                if($RePD['total_Re_mp']>0){
                foreach ($RePD['Re_mp'] as $menu_Re_mp);
            ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-5 my-auto">
                            <div class="chief_photo">
                                <img src="<?php echo base_url('public/images/member/'.$menu_Re_mp->mem_photo.''); ?>">
                            </div>
                        </div>
                        <div class="col-12 col-lg-7 my-auto ">
                            <div class="chief_introduce mt-5 mt-lg-0">
                                <div class="text-center">
                                    "ตำบลปลอดยาเสพติด เศรษฐกิจดี วิถีพอเพียง ชุมชนเข้มแข็ง สืบสานวัฒนธรรม <br> ก้าวล้ำเทคโนโลยี"
                                </div>
                                <div class="text-center">
                                    <?php echo $menu_Re_mp->mem_name; ?> / <?php echo "( ".$menu_Re_mp->mem_position." )"; ?><br>
                                    <small><?php if(!empty($menu_Re_mp->mem_mobile) AND $menu_Re_mp->mem_mobile != NULL){echo "โทรศัพท์ ".$menu_Re_mp->mem_mobile;}else{echo "";} ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
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
                            <div>แสดงรายการข่าวสารล่าสุด 8 กิจกรรม</div>
                            <div class="news_menu_scroll">
                                <!-- <a class="btn"><i class="fas fa-list-ul"></i> ข่าวประชาสัมพ้นธ์ทั้งหมด</a> -->
                                <div class="row d-flex justify-content-center">
                                    <?php foreach ($Re_ntm['Re_ntm'] as $row_Re_ntm){ ?>
                                        <div class="col-12 col-lg-auto"><a class="btn" href="<?php echo base_url('ข่าวสาร/'.$row_Re_ntm->newstype_name); ?>"><i class="fas fa-list-ul"></i> <?php echo $row_Re_ntm->newstype_name; ?></a></div>
                                    <?php } ?>
                                    <div class="col-12 col-lg-auto"><a class="btn" href="<?php echo base_url('ข่าวสาร/ข่าวสารทั้งหมด'); ?>"><i class="fas fa-list-ul"></i> ข่าวสารทั้งหมด</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($Re_ntm['Re_n'] as $row_Re_n){ ?>
                    <div class="col-lg-3 mb-5">
                        <a href="<?php echo base_url('ข่าวสาร/ข่าวประชาสัมพันธ์/ข่าวต่างๆ'); ?>">
                            <div class="news_box h-100">
                                <div class="news_text">
                                    <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>
                                    <div class="small">
                                        <div class="text-muted"><?php echo $row_Re_n->news_name; ?></div>
                                    </div>
                                    <div><?php echo $row_Re_n->news_detail; ?></div>
                                    <div class="d-flex align-items-center mt-3">
                                        <div class="me-3"><i class="fas fa-calendar-alt"></i></div>
                                        <div class="small">
                                            <div class="text-muted"><?php echo $row_Re_n->news_date; ?></div>
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



