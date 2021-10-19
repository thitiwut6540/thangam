<?php 
foreach ($Re['Re_rl'] as $row_Re_rl); 
?>

<div id="header"><?php $this->load->view('backoffice/_header');?></div>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/project_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
        <div id="navi" class="col-12">
                <a href="<?php echo base_url('Backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <a href="<?php echo base_url('Backoffice/'.$topic.'');?>" >โครงการ</a> <i class="fas fa-caret-right"></i> 
                แก้ไข<?php echo $topic; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 p-0 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-8">แก้ไข<?php echo $topic; ?></div>
                            <div class="col-4 text-right"><a class="btn btn_blue" href="<?php echo base_url('Backoffice/'.$topic.'')?>"><i class="fas fa-list"></i> รายการ</a></div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <div id="modal_success" class="alert_success" style="display:none"></div>
                        <div id="modal_error" class="alert_error" style="display:none"></div>
                        <form id="form_edit" name="form_edit">
                            <div id="ajax_view_photo">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <?php if(!empty($row_Re_rl->dp_photo)){?>
                                            <button type="button" class="btn_fm btn_red btn_photo_dele" id="photo" name="<?php echo $row_Re_rl->dp_id;?>"><i class="fas fa-times"></i> ลบ</button><br>
                                            <img class="img-fluid w-100" src="<?php echo base_url('public/images/department/'.$row_Re_rl->dp_photo);?>">
                                        <?php }else{?>
                                            <button type="button" class="btn_fm btn_red" disabled><i class="fas fa-times"></i> ลบ</button><br>
                                            <img class="img-fluid w-100" src="<?php echo base_url('public/images/nophoto.png');?>">
                                        <?php } ?>
                                        <br>ตัวอย่างภาพหน่วยงาน
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">หัวข้อ</label>
                                    <input type="text" id="if_header" name="if_header" class="form-control form-control-sm" value="<?php if(!empty($row_Re_rl->dptype_id)){echo $topic;}else{echo $topic;} ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">ชื่อ</label>
                                    <input type="text" id="dp_name" name="dp_name" class="form-control form-control-sm" value="<?php if(!empty($row_Re_rl->dp_name)){echo $row_Re_rl->dp_name;} ?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="">สถานที่ตั้ง</label>
                                    <input type="text" id="dp_add" name="dp_add" class="form-control form-control-sm" value="<?php if(!empty($row_Re_rl->dp_add)){echo $row_Re_rl->dp_add;} ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">เบอร์โทรศัพท์</label>
                                    <input type="text" id="dp_tel" name="dp_tel" class="form-control form-control-sm" value="<?php if(!empty($row_Re_rl->dp_tel)){echo $row_Re_rl->dp_tel;} ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">เบอร์โทรสาร</label>
                                    <input type="text" id="dp_fax" name="dp_fax" class="form-control form-control-sm" value="<?php if(!empty($row_Re_rl->dp_fax)){echo $row_Re_rl->dp_fax;} ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
									<label for="ban_photo">ภาพหน่วยงาน </label>
                                    <input type="file" name="dp_photo" id="dp_photo" class="form-control form-control-sm"> 
                                    <input type="hidden" id="dp_h_photo" name="dp_h_photo" value="<?php echo $row_Re_rl->dp_photo; ?>">
								</div>
							</div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="">รายะเอียดเนื้อหา</label>
                                    <textarea id="dp_detail" name="dp_detail" class="form-control form-control-sm"><?php if(!empty($row_Re_rl->dp_detail)){echo $row_Re_rl->dp_detail;} ?></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm" id="btn_edit"><i class="fas fa-save"></i> บันทึก</button>
                            <input type="hidden" id="dp_topic" name="dp_topic" value="<?php echo $topic; ?>">
                            <input type="hidden" id="dp_id" name="dp_id" value="<?php echo $row_Re_rl->dp_id; ?>">
                            <input type="hidden" id="dptype_id" name="dptype_id" value="<?php echo $row_Re_rl->dptype_id; ?>">
                            <input type="hidden" id="action" name="action" value="project-edit">
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
<script src="<?php echo base_url('public/js/b_project.js');?>"></script>
<script>

    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#dp_detail', {
            langType : 'en',
            minHight:'300px',
            //items: ['source', 'fullscreen'],
            items: ['source', '|', 'undo', 'redo', '|','cut', 'copy', 'paste','plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 
                'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript','superscript', 
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold','italic', 'underline', 'strikethrough', 
                'lineheight', 'removeformat', '|', 'image', 'multiimage', 'insertfile', 'table', 'hr',  'pagebreak', 'link', 'unlink','|', 'fullscreen', '/',],
        });
    });

</script>