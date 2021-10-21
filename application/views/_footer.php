<div id="section_googlemap" class="customize_googlemap">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15258.16685427111!2d100.3559299!3d17.0461351!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8b90316af1185f0a!2z4Lit4Lia4LiVLuC4l-C5iOC4suC4h-C4suC4oSDguK3guLPguYDguKDguK3guKfguLHguJTguYLguJrguKrguJbguYwg4LiI4Lix4LiH4Lir4Lin4Lix4LiU4Lie4Li04Lip4LiT4Li44LmC4Lil4LiB!5e0!3m2!1sen!2sth!4v1634800371280!5m2!1sen!2sth" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>
<div id="section_footer" class="customize_footer">
    <div class="container-fluid">
        <div class="row pb-2">
            <div class="col-12 col-lg-12 col-xl-4 mb-4 mb-lg-0 text-center">
                <img class="img-fluid" src="<?php echo base_url('public/images/logo/logo.png'); ?>">
                <div class="row d-flex justify-content-center mt-2">
                    <div class="col-10">
                        <h4>เทศบาลทดสอบ</h4>
                        เลขที่ 108 หมู่ที่ 5 ตำบลทดสอบ อำเภอทดสอบ จังหวัดทดสอบ 66666<br>
                    </div>
                </div>
                <div class="row mt-3 d-flex justify-content-center">
                    <div class="col-auto px-0"><a href="#" class="btn_fb"><i class="fab fa-facebook-square fa-fw fa-3x"></i></a></div>
                    <div class="col-auto px-0"><a href="#" class="btn_line"><i class="fab fa-line fa-fw fa-3x"></i></a></div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3 col-xl-2 footer_menu">
                <span>ข้อมูลเทศบาล</span>
                <ul>
                    <?php 
                        $ReFM1=$this->M_Menu_m->getMenuInfo();
                        foreach ($ReFM1['Re_if'] as $footer_Re_if) {
                    ?>
                        <li><a href="<?php echo base_url('ข้อมูลเทศบาล/'.$footer_Re_if->if_header); ?>"><?php echo $footer_Re_if->if_header; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-6 col-md-6 col-lg-3 col-xl-2 footer_menu">
                <span>แกลลอรี่</span>
                <ul>
                    <?php 
                        $ReFM2=$this->M_Menu_m->getMenuGallery();
                        foreach ($ReFM2['Re_dp'] as $footer_Re_dp) {
                    ?>
                        <li><a href="<?php echo base_url('แกลเลอรี่/'.$footer_Re_dp->dp_name.''); ?>"><?php echo $footer_Re_dp->dp_name; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-6 col-md-6 col-lg-3 col-xl-2 footer_menu">
                <span>ข่าวสาร</span>
                <ul>
                    <?php 
                        $ReFM3=$this->M_Menu_m->getMenuNews();
                        foreach ($ReFM3['Re_nt'] as $footer_Re_news) {
                    ?>
                        <li><a href="<?php echo base_url('ข่าวสาร/'.$footer_Re_news->newstype_name.''); ?>"><?php echo $footer_Re_news->newstype_name; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-6 col-md-6 col-lg-3 col-xl-2 footer_menu">
                <span>บุคลากร</span>
                <ul>
                    <?php 
                        $ReFM4=$this->M_Menu_m->getMenuDepart('1');
                        foreach ($ReFM4['Re_dp'] as $footer_Re_mem) {
                    ?>
                        <li><a href="<?php echo base_url('หน่วยงาน/'.$footer_Re_mem->dptype_name.'/'.$footer_Re_mem->dp_name.''); ?>"><?php echo $footer_Re_mem->dp_name; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="section_footer_end" class="customize_footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-6 footer_menu">
                <div class="row">
                    <div class="col-3 col-lg-auto"><a href="<?php echo base_url('ข้อมูลเทศบาล/การติดต่อ'); ?>">การติดต่อ</a></div>
                    <div class="col-3 col-lg-auto"><a href="<?php echo base_url('ข้อมูลเทศบาล/แผนที่'); ?>">แผนที่</a></div>
                    <div class="col-3 col-lg-auto"><a href="<?php echo base_url('Backoffice'); ?>">เจ้าหน้าที่</a></div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-4 mt-lg-0">
                <div class="row text-right">
                    <div class="col-12 d-flex justify-content-center justify-content-lg-end"> Copyright ANYWHERE, 2021. All rights reserved.</div>
                </div>
            </div>
        </div>
    </div>  
</div>