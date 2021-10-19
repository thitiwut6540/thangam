<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/gallery_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> แกลเลอรี่ภาพ
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header"><i class="fas fa-images"></i> แกลเลอรี่ภาพ</div>
                    <div class="box_con_detail">
                        <div class="alert alert-primary" role="alert"><i class="fas fa-info-circle"></i> เลือกรายการหน่วยงานที่ต้องการจากเมนูทางด้านซ้าย</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>