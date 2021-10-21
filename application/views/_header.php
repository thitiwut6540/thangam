<?php
    $Re_t_cp = $this->M_Company_m->getCP();
    foreach ($Re_t_cp['Re_cp'] as $row_Re_tcp);
    $Re_t_bm = $this->M_Banner_m->getBanMain();
?>

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
            <i class="fas fa-th"></i> บริการอื่นๆ
        </button>
        <div class="offcanvas offcanvas-top" tabindex="-1" id="cv_menu" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">บริการอื่นๆ</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row">
                <div class="col-6 col-md-4 col-lg-3 mb-3"><a href="<?php echo base_url('ITA'); ?>"><img class="w-100 rounded" src="<?php echo base_url('public/images/link_menu/ml-ita.png'); ?>"></a></div>
                <div class="col-6 col-md-4 col-lg-3 mb-3"><a href="<?php echo base_url('LPA'); ?>"><img class="w-100 rounded" src="<?php echo base_url('public/images/link_menu/ml-lpa.png'); ?>"></a></div>
                <div class="col-6 col-md-4 col-lg-3 mb-3"><a href="<?php echo base_url('สถานที่สำคัญ'); ?>"><img class="w-100 rounded" src="<?php echo base_url('public/images/link_menu/ml-location.png'); ?>"></a></div>
                <div class="col-6 col-md-4 col-lg-3 mb-3"><a href="<?php echo base_url('OTOP'); ?>"><img class="w-100 rounded" src="<?php echo base_url('public/images/link_menu/ml-otop.png'); ?>"></a></div>
                <div class="col-6 col-md-4 col-lg-3 mb-3"><a href="<?php echo base_url('คำถามที่พบบ่อย'); ?>"><img class="w-100 rounded" src="<?php echo base_url('public/images/link_menu/ml-q&a.png'); ?>"></a></div>
                <div class="col-6 col-md-4 col-lg-3 mb-3"><a href="<?php echo base_url('webboard'); ?>"><img class="w-100 rounded" src="<?php echo base_url('public/images/link_menu/ml-webboard.png'); ?>"></a></div>
                <div class="col-6 col-md-4 col-lg-3 mb-3"><a href="<?php echo base_url('Eoffice'); ?>"><img class="w-100 rounded" src="<?php echo base_url('public/images/link_menu/ml-eoffice.png'); ?>"></a></div>
                <div class="col-6 col-md-4 col-lg-3 mb-3"><a href="<?php echo base_url('สมุดลงนาม'); ?>"><img class="w-100 rounded" src="<?php echo base_url('public/images/link_menu/ml-sign.png'); ?>"></a></div>

                <?php 
                    $ReS1=$this->M_Company_m->getMenuLink();
                    if($ReS1['total_Re_l'] >0){
                    foreach ($ReS1['Re_l'] as $side_Re_l) {
                ?>
                    <div class="col-6 col-md-4 col-lg-3 mb-3"><a href="<?php echo $side_Re_l->l_url; ?>"><img class="w-100 rounded" src="<?php echo base_url('public/images/link_menu/'.$side_Re_l->l_photo.''); ?>"></a></div>

                <?php }}?>
            </div>
        </div>
        </div>
    </div>
</nav>

<div id="carrousel_slideshow" class="carousel slide customize_carousel" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php $b2=0;foreach($Re_t_bm['Re_bm'] as $row_ReBN){?>
            <div class="carousel-item <?php if($b2==0){ echo "active";}?>">
                <?php if(!empty($row_ReBN->ban_url)){ echo "<a href=\"".$row_ReBN->ban_url."\">";}?>
                    <img class="d-block w-100" src="<?php echo base_url('public/images/banner/').$row_ReBN->ban_photo;?>">
                <?php if(!empty($row_ReBN->ban_url)){ echo "</a>";} ?>
            </div>
        <?php $b2++;} ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carrousel_slideshow" data-bs-slide="prev">
        <i class="fas fa-angle-left fa-fw fa-2x"></i>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carrousel_slideshow" data-bs-slide="next">
        <i class="fas fa-angle-right fa-fw fa-2x"></i>
    </button>
</div>


<div class="btn_scroll_top"><i class="fas fa-caret-up fa-fw"></i></div>