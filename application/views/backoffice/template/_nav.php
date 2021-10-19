<div class="box_navbar">
    <div class="row">
        <div class="col-6 col-lg-3 my-auto">
            <a href="<?php echo base_url(); ?>">
                <div class="logo_box">
                    <div class="logo">
                        <img class="img-fluid" src="<?php echo base_url('public/images/logo/logo.png');?>" />
                    </div>
                    <div class="title">
                        <div class="n1"><?php echo ANW_N1;?></div>
                        <div class="n2"><?php echo ANW_N2;?></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-9 d-flex justify-content-end">
            <div class="d-none d-lg-block my-auto">
                <i class="far fa-user fa-lg"></i> <?php echo $_SESSION[''.ANW_SS.'us_name']; ?> / <?php echo $_SESSION[''.ANW_SS.'usl_name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
                <i class="fas fa-user-edit"></i> <a href="javascript:void(0)" id="btn_pass_edit" name="<?php echo $_SESSION[''.ANW_SS.'us_id']; ?>">Password</a>&nbsp;
                <i class="far fa-times-circle fa-lg"></i> <a href="javascript:void(0)" id="btn_logout" name="<?php echo $_SESSION[''.ANW_SS.'us_name']; ?>" >Logout</a>
            </div>
            <div class="ml-3 my-auto">
                <a href="#menu-toggle" id="menu-toggle"><i class="fas fa-bars fa-lg"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="box_navbar_mb"></div>
