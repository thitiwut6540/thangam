<?php
foreach ($Re_n['Re_ed'] as $row_Re_ed);
?>

<div id="header"><?php $this->load->view('backoffice/_header');?></div>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/content_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('Backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <a href="<?php echo base_url('Backoffice/'.$topic.'');?>" ><?php echo $topic; ?></a> <i class="fas fa-caret-right"></i> 
                แก้ไข<?php echo $topic; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                    <div class="row">
                            <div class="col-8">เพิ่ม<?php echo $topic; ?></div>
                            <div class="col-4 text-right"><a class="btn btn_blue" href="<?php echo base_url('Backoffice/ข่าวสาร/'.$topic.'')?>"><i class="fas fa-list"></i> รายการ</a></div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <div id="modal_success" class="alert_success" style="display:none"></div>
                        <div id="modal_error" class="alert_error" style="display:none"></div>
                        <form id="form_edit" name="form_edit">
                            <div id="ajax_view_photo">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <?php if(!empty($row_Re_ed->con_photo)){?>
                                            <button type="button" class="btn_fm btn_red btn_photo_dele" id="photo" name="<?php echo $row_Re_ed->con_id;?>"><i class="fas fa-times"></i> ลบ</button><br>
                                            <img class="img-fluid w-100" src="<?php echo base_url('public/images/content/'.$row_Re_ed->con_photo);?>">
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
                                    <label for="">หน่วยงาน</label>
                                    <select name="dp_id" id="dp_id" class="form-control form-control-sm">
                                            <option value="">เลือกหน่วยงาน</option>
                                            <?php foreach ($Re_m['ReD'] as $row_Re_dp){ ?>
                                            <option value="<?php echo $row_Re_dp->dp_id; ?>" <?php if($row_Re_dp->dp_name == $topic){echo 'selected';} ?>><?php echo $row_Re_dp->dp_name; ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">หัวข้อ ข้อมูล</label>
                                    <select name="con_type_id" id="con_type_id" class="form-control form-control-sm">
                                            <option value="">เลือกหัวข้อข้อมูล</option>
                                            <?php foreach ($Re_ct['Re_ct'] as $row_Re_ct){ ?>
                                            <option value="<?php echo $row_Re_ct->con_type_id; ?>" <?php if($row_Re_ct->con_type_id == $row_Re_ed->con_type_id){echo 'selected';} ?>><?php echo $row_Re_ct->con_type_name; ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-9">
                                    <label for="">ข้อมูลเรือง</label>
                                    <input type="text" id="con_name" name="con_name" class="form-control form-control-sm" value="<?php echo $row_Re_ed->con_name; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-9">
									<label for="ban_photo">ภาพหน่วยงาน </label>
                                    <input type="file" name="con_photo" id="con_photo" class="form-control form-control-sm"> 
                                    <input type="hidden" name="con_h_photo" id="con_h_photo" class="form-control form-control-sm" value="<?php echo $row_Re_ed->con_photo; ?>"> 
								</div>
							</div>
                            <div class="form-row">
                                <div class="form-group col-md-9">
                                    <label for="">ไฟล์เอกสาร</label><br>
                                    <input type="file" name="conf_name[]" id="conf_name[]" />
                                    <input type="button" name="button1" id="button1" value="+" onclick="JavaScript:fncCreateElement1();" />
                                    (กด + เพื่อเพิ่มรูปภาพ)<br/>
                                    <div id="mySpan1"></div>
                                </div>
                            </div>
                            <div id="ajax_view_file">
                                <div class="form-row">
                                    <?php foreach ($Re_n['Re_f'] as $row_Re_f){?>
                                    <div class="form-group col-md-3">
                                        <?php if(!empty($row_Re_f->con_f_name)){?>
                                            <button type="button" class="btn_fm btn_red btn_file_dele" id="file" name="<?php echo $row_Re_f->con_f_id;?>"><i class="fas fa-times"></i> ลบ</button><br>
                                            <i class="fas fa-file m-2 p-2 border rounded bg-dark text-white"></i> <?php echo $row_Re_f->con_f_name; ?>
                                        <?php }else{?>
                                            <button type="button" class="btn_fm btn_red btn_file_dele" id="file" name="<?php echo $row_Re_f->con_f_id;?>"><i class="fas fa-times"></i> ลบ</button><br>
                                            <i class="fas fa-file m-2 p-2 border rounded bg-dark text-white"></i> <?php echo $row_Re_f->con_f_name; ?>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-9">
                                    <label for="">youtube url</label>
                                    <input type="text" id="con_l_link" name="con_l_link" class="form-control form-control-sm" value="<?php echo $row_Re_ed->con_l_link; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="">รายะเอียดเนื้อหา</label>
                                    <textarea id="con_detail" name="con_detail" class="form-control form-control-sm" style="width:900px;"><?php if(!empty($row_Re_ed->con_detail)){echo $row_Re_ed->con_detail;}else{echo "";} ?></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm" id="btn_edit"><i class="fas fa-save"></i> บันทึก</button>
                            <input type="hidden" id="topic" name="topic" value="<?php echo $topic; ?>">
                            <input type="hidden" id="con_id" name="con_id" value="<?php echo $row_Re_ed->con_id;?>">
                            <input type="hidden" id="action" name="action" value="con-edit">
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
<script src="<?php echo base_url('public/js/b_content.js');?>"></script>
<script>

    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#con_detail', {
            langType : 'en',
            minHight:'300px',
            //items: ['source', 'fullscreen'],
            items: ['source', '|', 'undo', 'redo', '|','cut', 'copy', 'paste','plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 
                'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript','superscript', 
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold','italic', 'underline', 'strikethrough', 
                'lineheight', 'removeformat', '|', 'image', 'multiimage', 'insertfile', 'table', 'hr',  'pagebreak', 'link', 'unlink','|', 'fullscreen', '/',],
        });
    });

    function fncCreateElement1(){
        var mySpan1 = document.getElementById('mySpan1');
        var myElement = document.createElement('input');
        var myElement2 = document.createElement('br');
        myElement.setAttribute('type',"file");
        myElement.setAttribute('name',"conf_name[]");
        mySpan1.appendChild(myElement);
        mySpan1.appendChild(myElement2);
    }

</script>