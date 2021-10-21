
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

        <?php if ($ReG['total_Re_g'] > 0){ ?>
            <div id="section_gal" class="customize_gal">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6 col-xl-4 mb-5">
                            <div class="gal_header">
                                <div>แกลเลอรี่กิจกรรม</div>
                                <div>Gallery</div>
                                <div>
                                    <a class="btn" href="<?php echo base_url('แกลลอรี่ทั้งหมด'); ?>"><i class="fas fa-list-ul"></i> แกลลอรี่ทั้งหมด</a>
                                </div>
                            </div>
                        </div>
                        <?php foreach ($ReG['Re_g'] as $row_Re_g){?>
                            <div class="col-12 col-md-6 col-lg-6 col-xl-4 mb-5">
                                <div class="card h-100 border">
                                    <div class="gal_photo">
                                        <?php if(!empty($row_Re_g->gal_photo) OR $row_Re_g->gal_photo != null){ ?>
                                            <img src="<?php echo base_url('public/images/gallery/'.$row_Re_g->gal_photo.''); ?>">
                                        <?php } else { ?>
                                            <img src="<?php echo base_url('public/images/nophoto.png'); ?>">
                                        <?php } ?>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="badge bg-primary bg-gradient rounded-pill mb-2"><?php echo $row_Re_g->dp_name;?></div>
                                        <a class="text-decoration-none stretched-link" href="<?php echo base_url('แกลลอรี่/'.$row_Re_g->dp_name.'/'.$row_Re_g->gal_id.''); ?>"><h5 class="card-title mb-3"><?php echo $row_Re_g->gal_name;?></h5></a>
                                        <!-- <p class="card-text mb-0">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                                    </div>
                                    <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                        <div class="d-flex align-items-end justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3"><i class="fas fa-calendar-alt"></i></div>
                                                <div class="small">
                                                    <div class="text-muted"><?php echo $this->M_Function_m->datethai_time($row_Re_g->gal_date);?></div>
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
        <?php } ?>

        <?php 
        if ($ReNT['total_Re_nt'] > 0){ 
            foreach ($ReNT['Re_nt'] as $row_Re_nt){
                $ReN = $this->M_Main_m->getNews($row_Re_nt->newstype_id);
                if($ReN['total_Re_n'] >0){
        ?>
            <div id="section_news" class="customize_news">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 text-center mb-4">
                            <div class="news_header">
                                <div><?php echo $row_Re_nt->newstype_name;?></div>
                                <div>แสดงรายการข่าวสารล่าสุด <?php echo $ReN['total_Re_n']; ?> กิจกรรม</div>
                                <div class="news_menu_scroll">
                                    <!-- <a class="btn"><i class="fas fa-list-ul"></i> ข่าวประชาสัมพ้นธ์ทั้งหมด</a> -->
                                    <div class="row d-flex justify-content-center">
                                        <!-- <?php foreach ($Re_ntm['Re_ntm'] as $row_Re_ntm){ ?>
                                            <div class="col-12 col-lg-auto"><a class="btn" href="<?php echo base_url('ข่าวสาร/'.$row_Re_ntm->newstype_name); ?>"><i class="fas fa-list-ul"></i> <?php echo $row_Re_ntm->newstype_name; ?></a></div>
                                        <?php } ?> -->
                                        <div class="col-12 col-lg-auto"><a class="btn" href="<?php echo base_url('ข่าวสาร/ข่าวสารทั้งหมด'); ?>"><i class="fas fa-list-ul"></i> <?php echo $row_Re_nt->newstype_name;?>ทั้งหมด</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php foreach ($ReN['Re_n'] as $row_Re_n){ ?>
                        <div class="col-lg-4 mb-5">
                            <a href="<?php echo base_url('ข่าวสาร/'.$row_Re_n->newstype_name.'/'.$row_Re_n->dp_name.'/รายละเอียด/'.$row_Re_n->news_id.''); ?>">
                                <div class="news_box h-100">
                                    <div class="news_text">
                                        <div class="badge bg-primary bg-gradient rounded-pill mb-2"><?php echo $row_Re_n->dp_name; ?></div>
                                        <div class=""><?php echo $row_Re_n->news_name; ?></div>
                                        <div class="d-flex align-items-center mt-3">
                                            <div class="me-3"><i class="fas fa-calendar-alt"></i></div>
                                            <div class="small">
                                                <div class="text-muted"><?php echo $this->M_Function_m->datethai_time($row_Re_n->news_date); ?></div>
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
        <?php }}} ?>

        <?php if($ReLD['total_Re_ld'] > 0){ ?>
            <div id="section_related" class="customize_related">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 mb-5 text-center">
                            <div class="related_header">
                                <div>หน่วยงานที่เกี่ยวข้อง</div>
                                <div>แสดงรายการข่าวสารล่าสุด <?php echo $ReLD['total_Re_ld']; ?> กิจกรรม</div>
                            </div>
                        </div>
                        <?php foreach ($ReLD['Re_ld'] as $row_Re_ld){ ?>
                            <div class="col-6 col-lg-3 mb-3 mb-lg-5">
                                <a href="<?php echo $row_Re_ld->l_url; ?>">
                                    <div class="related_photo"><img src="<?php echo base_url('public/images/link_depart/'.$row_Re_ld->l_photo.''); ?>"></div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <footer><?php $this->load->view('_footer');?></footer>
    </div>
</div>



