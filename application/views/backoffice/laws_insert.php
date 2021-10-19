<div id="header"><?php $this->load->view('backoffice/_header');?></div>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/laws_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('Backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <a href="<?php echo base_url('Backoffice/'.$topic.'');?>" ><?php echo $topic; ?></a> <i class="fas fa-caret-right"></i> 
                เพิ่ม<?php echo $topic; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                    <div class="row">
                            <div class="col-8">เพิ่ม<?php echo $topic; ?></div>
                            <div class="col-4 text-right"><a class="btn btn_blue" href="<?php echo base_url('Backoffice/กฎหมายและระเบียบ/'.$topic.'')?>"><i class="fas fa-list"></i> รายการ</a></div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <div id="modal_success" class="alert_success" style="display:none"></div>
                        <div id="modal_error" class="alert_error" style="display:none"></div>
                        <form id="form_insert" name="form_insert">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">ประเภทกฎหมายและระเบียบ</label>
                                    <select name="lt_id" id="lt_id" class="form-control form-control-sm">
                                            <option value="">เลือกหน่วยงาน</option>
                                            <?php foreach ($Re['Re_type'] as $row_Re_type){ ?>
                                            <option value="<?php echo $row_Re_type->lt_id; ?>" <?php if($row_Re_type->lt_name == $topic){echo 'selected';} ?>><?php echo $row_Re_type->lt_name; ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-9">
                                    <label for="">หัวข้อกฎหมายและระเบียบ</label>
                                    <input type="text" id="l_list" name="l_list" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-9">
                                    <label for="">ไฟล์เอกสาร</label><br>
                                    <input type="file" name="lawsf_name[]" id="lawsf_name[]" />
                                    <input type="button" name="button1" id="button1" value="+" onclick="JavaScript:fncCreateElement1();" />
                                    (กด + เพื่อเพิ่มรูปภาพ)<br/>
                                    <div id="mySpan1"></div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm" id="btn_laws_insert"><i class="fas fa-save"></i> บันทึก</button>
                            <input type="hidden" id="topic" name="topic" value="<?php echo $topic; ?>">
                            <input type="hidden" id="action" name="action" value="laws-insert">
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
<script src="<?php echo base_url('public/js/b_laws.js');?>"></script>
<script>

    function fncCreateElement1(){
        var mySpan1 = document.getElementById('mySpan1');
        var myElement = document.createElement('input');
        var myElement2 = document.createElement('br');
        myElement.setAttribute('type',"file");
        myElement.setAttribute('name',"lawsf_name[]");
        mySpan1.appendChild(myElement);
        mySpan1.appendChild(myElement2);
    }

</script>