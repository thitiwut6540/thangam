<?php foreach ($Re['Re_c'] as $row_Re_c);?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/corrupt_menu.php');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> ร้องเรียนทุจริตและประพฤติมิชอบ
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/ร้องเรียนทุจริตและประพฤติมิชอบ');?>" >แจ้งเรื่อง</a>
                <i class="fas fa-caret-right"></i> ดำเนินการ
            </div>
        </div>

        <?php $this->load->view('backoffice/corrupt_detail') ;?>
    </div>
</div>