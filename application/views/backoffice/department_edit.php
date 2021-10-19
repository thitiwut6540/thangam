<?php foreach ($Re['Re_dp'] as $row_Re_dp);?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/department_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">backoffice</span></a>
                <a href="<?php echo base_url('backoffice/'.$topic.'');?>" ><?php echo $topic; ?></a> <i class="fas fa-caret-right"></i> 
                แก้ไข<?php echo $topic; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12"><i class="fas fa-sitemap"></i> แก้ไข<?php echo $topic; ?></div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <form id="form_edit" name="form_edit">
                            <div id="ajax_view_photo">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <?php if(!empty($row_Re_dp->dp_photo)){?>
                                            <button type="button" class="btn_fm btn_red btn_photo_dele" data-id="<?php echo $row_Re_dp->dp_id;?>" data-name="<?php echo $row_Re_dp->dp_name;?>"><i class="fas fa-times"></i> ลบ</button><br>
                                            <img class="img-fluid w-100" src="<?php echo base_url('public/images/department/'.$row_Re_dp->dp_photo);?>">
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
                                    <input type="text" id="if_header" name="if_header" class="form-control form-control-sm" value="<?php if(!empty($row_Re_dp->dptype_id)){echo $topic;}else{echo $topic;} ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">ชื่อ</label>
                                    <input type="text" id="dp_name" name="dp_name" class="form-control form-control-sm" value="<?php if(!empty($row_Re_dp->dp_name)){echo $row_Re_dp->dp_name;} ?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="">สถานที่ตั้ง</label>
                                    <input type="text" id="dp_add" name="dp_add" class="form-control form-control-sm" value="<?php if(!empty($row_Re_dp->dp_add)){echo $row_Re_dp->dp_add;} ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">เบอร์โทรศัพท์</label>
                                    <input type="text" id="dp_tel" name="dp_tel" class="form-control form-control-sm" value="<?php if(!empty($row_Re_dp->dp_tel)){echo $row_Re_dp->dp_tel;} ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">เบอร์โทรสาร</label>
                                    <input type="text" id="dp_fax" name="dp_fax" class="form-control form-control-sm" value="<?php if(!empty($row_Re_dp->dp_fax)){echo $row_Re_dp->dp_fax;} ?>">
                                </div>
                                <div class="form-group col-md-4">
									<label for="ban_photo">เปลี่ยนภาพหน่วยงาน </label>
                                    <input type="file" name="dp_photo" id="dp_photo" class="form-control form-control-sm"> 
                                    <input type="hidden" id="h_dp_photo" name="h_dp_photo" value="<?php echo $row_Re_dp->dp_photo; ?>">
								</div>
							</div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="">รายะเอียดเนื้อหา</label>
                                    <textarea id="dp_detail" name="dp_detail"><?php echo $row_Re_dp->dp_detail; ?></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm" id="btn_edit"><i class="fas fa-save"></i> บันทึกแก้ไข</button>
                            <input type="hidden" id="dp_id" name="dp_id" value="<?php echo $row_Re_dp->dp_id; ?>">
                            <input type="hidden" id="dptype_id" name="dptype_id" value="<?php echo $row_Re_dp->dptype_id; ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#dp_detail', {
            langType : 'en',
            minHeight:'200px',
            width : '900px',
            items: ['source', '|', 'undo', 'redo', '|','cut', 'copy', 'paste','plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 
                'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript','superscript', 
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold','italic', 'underline', 'strikethrough', 
                'lineheight', 'removeformat', '|', 'image', 'multiimage', 'insertfile', 'table', 'hr',  'pagebreak', 'link', 'unlink','|', 'fullscreen', '/',],
        });
    });

    $(document).ready(function() {
        $(document).on('click', '#btn_edit', function() {
            $('#form_edit').validate({
                rules: {
                    if_header: { required: true },
                    dp_name: { required: true },
                    dp_add: { required: true },
                    dp_tel: { required: true },
                    dp_fax: { required: true },
                    dp_photo: {extension: "jpg|jpeg|png" },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_edit')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Department/department_edit_save"); ?>',
                        method: 'POST',
                        dataType: "json",
                        data: formData,
                        beforeSend: function() { $('#loader').show(); },
                        complete: function() { $('#loader').hide(); },
                        success: function(data) {
                            if(data.action=='Y'){
                                $.confirm({
                                    icon: 'fas fa-check',
                                    title: 'สำเร็จ',
                                    content: data.output,
                                    type: 'green',
                                    typeAnimated: true,
                                    boxWidth: '420px',
                                    useBootstrap: false,
                                    buttons: {
                                        ไปหน้ารายการ: {
                                            action: function(){
                                                window.location.href = '<?php echo base_url("backoffice/".$topic."");?>';
                                            }
                                        },
                                        ปิด: {
                                            action: function(){
                                                location.reload();
                                            }
                                        },
                                    }
                                });
                            }else{
                                $.alert({
                                    icon: 'fas fa-exclamation-triangle',
                                    title: 'แจ้งเตือน',
                                    content: data.output,
                                    type: 'red',
                                    typeAnimated: true,
                                    boxWidth: '420px',
                                    useBootstrap: false,
                                });
                            }
                        },
                        async: true,
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                },
            });
        });

        $(document).on('click', '.btn_photo_dele', function() {
            var dp_id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรูปภาพ',
                content: 'ยืนยันต้องการลบรูปภาพ '+name+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function(){
                            $.ajax({
                                url: '<?php echo base_url("B_Department/department_delete_photo"); ?>',
                                method: "POST",
                                dataType: "json",
                                beforeSend: function() {$('#loader').show();},
                                complete: function() {$('#loader').hide();},
                                data: { dp_id:dp_id,},
                                success: function(data) {
                                    if(data.action=='Y'){
                                        location.reload();
                                    }else{
                                        $.alert({
                                            icon: 'fas fa-exclamation-triangle',
                                            title: 'แจ้งเตือน',
                                            content: data.output,
                                            type: 'red',
                                            typeAnimated: true,
                                            boxWidth: '420px',
                                            useBootstrap: false,
                                        });
                                    }
                                }
                            }); 
                        }
                    },
                    ยกเลิก: {},
                }
            });
        });

    });
</script>