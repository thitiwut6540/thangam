
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
                                <a class="btn"><i class="fas fa-list-ul"></i> แกลลอรี่ทั้งหมด</a>
                            </div>
                        </div>
                    </div>
                    <?php for($x = 1; $x <= 5; $x++) {?>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-4 mb-5">
                        <div class="card h-100 border">
                            <div class="gal_photo"><img src="<?php echo base_url('public/images/background/00'.$x.'.jpg'); ?>"></div>
                            <div class="card-body p-4">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>
                                <a class="text-decoration-none stretched-link" href="<?php echo base_url('Gallery'); ?>"><h5 class="card-title mb-3">Blog post title</h5></a>
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

        <footer><?php $this->load->view('_footer');?></footer>
    </div>
</div>



