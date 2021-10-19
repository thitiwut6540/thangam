<?php foreach ($Re_ed['ReOPR'] as $row_Re_opr); ?>

<div id="header"><?php $this->load->view('backoffice/_header');?></div>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/operations_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('Backoffice/dashboard');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                ผลการดำเนินงาน
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">แก้ไขผลการดำเนินงาน</div>
                    <div class="box_con_detail">
                        <div id="modal_success" class="alert_success" style="display:none"></div>
                        <div id="modal_error" class="alert_error" style="display:none"></div>
                        <div class="row">
                            <div class="col-12">
                                <form id="form_edit" name="form_edit">
                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-6">
                                            <label for="dp_id">หน่วยงาน</label>
                                            <select id="dp_id" name="dp_id" class="form-control form-control-sm">
                                                <option value="">เลือก</option>
                                                <?php foreach ($Re_m['ReD'] as $row_ReD2){ ?>
                                                    <option value="<?php echo $row_ReD2->dp_id;?>" <?php if($row_ReD2->dp_name == $topic){echo "selected";} ?>><?php echo $row_ReD2->dp_name;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-9">
                                            <label for="opr_name">หัวเรื่อง</label>
                                            <input type="text" id="opr_name" name="opr_name" class="form-control form-control-sm" value="<?php echo $row_Re_opr->opr_name; ?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-9">
                                            <label for="">ไฟล์เอกสาร</label><br>
                                            <input type="file" name="opr_f_file[]" id="opr_f_file[]" />
                                            <input type="button" name="button1" id="button1" value="+" onclick="JavaScript:fncCreateElement1();" />
                                            (กด + เพื่อเพิ่มรูปภาพ)<br/>
                                            <div id="mySpan1"></div>
                                        </div>
                                    </div>
                                    <div id="ajax_view_file">
                                        <div class="form-row">
                                            <?php foreach ($Re_ed['ReOPRF'] as $row_Re_oprf){?>
                                            <div class="form-group col-md-3">
                                                <?php if(!empty($row_Re_oprf->opr_f_file)){?>
                                                    <button type="button" class="btn_fm btn_red btn_file_dele" id="file" name="<?php echo $row_Re_oprf->opr_f_id;?>"><i class="fas fa-times"></i> ลบ</button><br>
                                                    <i class="fas fa-file m-2 p-2 border rounded bg-dark text-white"></i> <?php echo $row_Re_oprf->opr_f_file; ?>
                                                <?php }else{?>
                                                    <button type="button" class="btn_fm btn_red btn_file_dele" id="file" name="<?php echo $row_Re_oprf->opr_f_id;?>"><i class="fas fa-times"></i> ลบ</button><br>
                                                    <i class="fas fa-file m-2 p-2 border rounded bg-dark text-white"></i> <?php echo $row_Re_oprf->opr_f_file; ?>
                                                <?php } ?>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm" id="btn_edit"><i class="fas fa-save"></i> เพิ่มผลการดำเนินงาน</button>
                                    <input type="hidden" id="topic" name="topic" value="<?php echo $topic; ?>">
                                    <input type="hidden" id="opr_id" name="opr_id" value="<?php echo $row_Re_opr->opr_id;?>">
                                    <input type="hidden" id="action" name="action" value="opr-edit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('public/js/b_operations.js');?>"></script>
<script>

function fncCreateElement1(){
    var mySpan1 = document.getElementById('mySpan1');
    var myElement = document.createElement('input');
    var myElement2 = document.createElement('br');
    myElement.setAttribute('type',"file");
    myElement.setAttribute('name',"opr_f_file[]");
    mySpan1.appendChild(myElement);
    mySpan1.appendChild(myElement2);
}
     
</script>