<?php foreach ($Re['Re_sb'] as $row_Re_sb);?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/signbook_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
        <div id="navi" class="col-12">
            <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/สมุดลงนาม');?>" >สมุดลงนาม</a>
                <i class="fas fa-caret-right"></i> แก้ไชสมุดลงนาม
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12">
                                <i class="fas fa-book"></i> แก้ไขสมุดลงนาม
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <form id="form_edit" name="form_edit">
                            <div id="ajax_view_photo">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <?php if(!empty($row_Re_sb->sb_photo)){?>
                                            <button type="button" class="btn_fm btn_red btn_photo_dele" data-id="<?php echo $row_Re_sb->sb_id;?>" data-name="<?php echo $row_Re_sb->sb_name;?>"><i class="fas fa-times"></i> ลบ</button><br>
                                            <img class="img-fluid w-100" src="<?php echo base_url('public/images/signbook/'.$row_Re_sb->sb_photo);?>">
                                        <?php }else{?>
                                            <button type="button" class="btn_fm btn_red" disabled><i class="fas fa-times"></i> ลบ</button><br>
                                            <img class="img-fluid w-100" src="<?php echo base_url('public/images/nophoto.png');?>">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>ชื่อสมุดลงนาม</label>
                                    <input type="text" id="sb_name" name="sb_name" class="form-control form-control-sm" value="<?php echo $row_Re_sb->sb_name;?>">
                                </div>
                                <div class="form-group col-md-10">
                                    <label>เนื้อหาสมุดลงนาม</label>
                                    <textarea id="sb_title" name="sb_title" class="form-control form-control-sm"><?php echo $row_Re_sb->sb_title;?></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>ช่องลงนาม</label>
                                    <input type="text" id="sb_form_name" name="sb_form_name" class="form-control form-control-sm" value="<?php echo $row_Re_sb->sb_form_name;?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>ช่องใสข้อความ</label>
                                    <input type="text" id="sb_form_title" name="sb_form_title" class="form-control form-control-sm" value="<?php echo $row_Re_sb->sb_form_title;?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>รูปภาพ</label>
                                    <input type="file" name="sb_photo" id="sb_photo" class="form-control form-control-sm"> 
                                    <input type="hidden" id="h_sb_photo" name="h_sb_photo" value="<?php echo $row_Re_sb->sb_photo;?>">
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-success btn-sm" id="btn_edit"><i class="fas fa-save"></i> แก้ไขสมุดลงนาม</button>
                            <input type="hidden" id="sb_id" name="sb_id" value="<?php echo $row_Re_sb->sb_id; ?>">
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
        editor = K.create('#sb_title', {
            langType : 'en',
            minHeight:'300px',
            newlineTag:'br',
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
                    sb_name: { required: true },
                    sb_photo: { extension: "jpg|jpeg|png" },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_edit')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Signbook/signbook_edit_save"); ?>',
                        type: 'POST',
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
                                                location.href = '<?php echo base_url("backoffice/สมุดลงนาม/");?>';
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
            var sb_id=$(this).attr('data-id');
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
                                url: '<?php echo base_url("B_Signbook/signbook_delete_photo"); ?>',
                                method: "POST",
                                dataType: "json",
                                beforeSend: function() {$('#loader').show();},
                                complete: function() {$('#loader').hide();},
                                data: { sb_id:sb_id},
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