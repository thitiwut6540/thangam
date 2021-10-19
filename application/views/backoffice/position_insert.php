<?php 
foreach ($Re['Re_pst'] as $row_Re_pst);
?>

<div id="header"><?php $this->load->view('backoffice/_header');?></div>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/position_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('Backoffice/dashboard');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <?php echo $topic; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-8"><?php echo $topic; ?></div>
                            <div class="col-4 text-right"><a class="btn btn_blue" href="<?php echo base_url('Backoffice/ตำแหน่ง/'.$topic.'');?>"><i class="fas fa-list"></i> รายการ</a></div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <div id="modal_success" class="alert_success" style="display:none"></div>
                        <div id="modal_error" class="alert_error" style="display:none"></div>
                            <form id="form_insert" name="form_insert">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">ประเภทสมาชิก</label>
                                        <select name="memtype_id" id="memtype_id" class="form-control form-control-sm">
                                                <option value="">เลือกประเภทสมาชิก</option>
                                                <?php foreach ($Re['Re_mt'] as $row_Re_mt){ ?>
                                                <option value="<?php echo $row_Re_mt->memtype_id; ?>" <?php if($row_Re_mt->memtype_id == $memtype){echo "selected";}else{echo "";}?>><?php echo $row_Re_mt->memtype_name; ?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php if($topic !="คณะผู้บริหาร" AND $topic !="สมาชิกสภา" AND $topic !="ผู้นำท้องถิ่น"){ ?>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">หน่วยงาน</label>
                                        <select name="dp_id" id="dp_id" class="form-control form-control-sm">
                                                <option value="">เลือกหน่วยงาน</option>
                                                <?php foreach ($Re['Re_dt'] as $row_Re_dt){ ?>
                                                <option value="<?php echo $row_Re_dt->dp_id; ?>"><?php echo $row_Re_dt->dp_name; ?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php } else {echo '<input type="hidden" id="dp_id" name="dp_id" class="form-control form-control-sm" value="">';} ?>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="">ชื่อตำแหน่ง</label>
                                        <input type="text" id="pst_name" name="pst_name" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm" id="btn_insert"><i class="fas fa-save"></i> บันทึก</button>
                                <input type="hidden" id="memtype" name="memtype" value="<?php if(!empty($memtype)){echo $memtype;}else{echo NULL;} ?>">
                                <input type="hidden" id="topic" name="topic" value="<?php echo $topic; ?>">
                                <input type="hidden" id="action" name="action" value="position-insert">
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- loader -->
<div id="loader" style="display:none;"><img src="<?php echo base_url('public/images/icon/150x150.gif');?>"><br>กำลังดำเนินการกรุณารอ</div>

<!-- JS -->
<script src="<?php echo base_url('public/js/b_position.js');?>"></script>