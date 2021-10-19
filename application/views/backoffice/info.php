<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/info_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> ข้อมูลเทศบาล
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header"><i class="fas fa-address-card"></i> ข้อมูลเทศบาล</div>
                    <div class="box_con_detail">
                        <i class="fas fa-info-circle"></i> เลือกทำรายการ ข้อมูลเทศบาลจากเมนู
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>