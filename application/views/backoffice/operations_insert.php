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
                    <div class="box_con_header">เพิ่มผลการดำเนินงาน</div>
                    <div class="box_con_detail">
                        <div id="modal_success" class="alert_success" style="display:none"></div>
                        <div id="modal_error" class="alert_error" style="display:none"></div>
                        <div class="row">
                            <div class="col-12">
                                <form id="form_insert" name="form_insert">
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
                                            <input type="text" id="opr_name" name="opr_name" class="form-control form-control-sm">
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
                                    <div id="file_view" ></div>
                                    <button type="submit" class="btn btn-primary btn-sm" id="btn_insert"><i class="fas fa-save"></i> เพิ่มผลการดำเนินงาน</button>
                                    <input type="hidden" id="topic" name="topic" value="<?php echo $topic; ?>">
                                    <input type="hidden" id="action" name="action" value="opr-insert">
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