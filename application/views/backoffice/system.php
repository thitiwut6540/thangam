<div id="header"><?php $this->load->view('backoffice/_header');?></div>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/system_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('Backoffice/dashboard');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                ตั้งค่าระบบ
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">ตั้งค่าระบบ</div>
                    <div class="box_con_detail">
                        <i class="fas fa-info-circle"></i> เลือกทำรายการ ตั้งค่าระบบจากเมนู
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>