<?php foreach ($Re['Re_wt'] as $row_Re_wt);?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/webboard_menu.php');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
    <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/webboard');?>" >Webboard</a>
                <i class="fas fa-caret-right"></i> แก้ไขหัวข้อใหม่
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12">
                                <i class="fas fa-comment fa-flip-horizontal"></i> Webboard
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <form id="form_edit" name="form_edit">
                            
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="wb_t_date">วันที่โพส</label><br>
                                    <input type="text" id="wb_t_date" name="wb_t_date" class="form-control form-control-sm dTH" value="<?php echo $this->B_Function_m->dateTha($row_Re_wt->wb_t_date); ?>">
                                </div>
                                <div class="form-group col-md-auto">
                                    <label for="wb_t_time">เวลาที่โพส</label><br>
                                    <input type="time" id="wb_t_time" name="wb_t_time" class="form-control form-control-sm" value="<?php echo $this->B_Function_m->dateTime($row_Re_wt->wb_t_date); ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>ผู้สร้างหัวข้อ</label>
                                    <input type="text" class="form-control form-control-sm" id="wb_t_user_save" name="wb_t_user_save" value="<?php echo $_SESSION[''.ANW_SS.'us_name']; ?>" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>ผู้แก้ไขหัวข้อ</label>
                                    <input type="text" class="form-control form-control-sm" id="wb_t_user_save" name="wb_t_user_save" value="<?php echo $_SESSION[''.ANW_SS.'us_name']; ?>" readonly>
                                </div>
                                <div class="form-row pl-1 mt-2">
                                    <div class="form-group col-md-auto">
                                        <div class="row">
                                            <div class="col">คอมเมนต์หัวข้อ</div>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="wb_cm_01" name="wb_t_comment" class="custom-control-input" value="Y" <?php if($row_Re_wt->wb_t_comment=="Y"){echo "checked";}?>>
                                            <label class="custom-control-label" for="wb_cm_01">มี</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="wb_cm_02" name="wb_t_comment" class="custom-control-input" value="N" <?php if($row_Re_wt->wb_t_comment=="N"){echo "checked";}?>>
                                            <label class="custom-control-label" for="wb_cm_02">ไม่มี</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>หัวข้อเรื่อง</label>
                                    <input type="text" id="wb_t_title" name="wb_t_title" class="form-control form-control-sm" value="<?php echo $row_Re_wt->wb_t_title;?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>คำนำอธิบายหัวข้อ</label>
                                    <textarea id="wb_t_detail" name="wb_t_detail"><?php echo $row_Re_wt->wb_t_detail;?></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>ข้อความที่ต้องการโพสต์</label>
                                    <textarea id="wb_t_note" name="wb_t_note"><?php echo $row_Re_wt->wb_t_note;?></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>รูปภาพ Icon หัวข้อ</label>
                                    <input type="file" name="wb_t_photo" id="wb_t_photo" class="form-control form-control-sm"><br>
                                    <span class="text-danger">* รูปภาพแสดงในหน้าแสดงรายการ</span>
                                    <input type="hidden" name="h_wb_t_photo" id="h_wb_t_photo" value="<?php echo $row_Re_wt->wb_t_photo;?>">
                                </div>
                            </div>
                            <?php if(!empty($row_Re_wt->wb_t_photo)){?>
                                <div class="form-row mt-3">
                                    <div class="form-group col-md-4">
                                        <?php if(!empty($row_Re_wt->wb_t_photo)){?>
                                            <button type="button" class="btn_fm btn_red btn_wb_photo_dele" data-id="<?php echo $row_Re_wt->wb_t_id;?>" data-name="<?php echo $row_Re_wt->wb_t_photo;?>"><i class="fas fa-times"></i> ลบ</button><br>
                                            <img class="img-fluid w-100" src="<?php echo base_url('public/images/webboard/'.$row_Re_wt->wb_t_photo);?>">
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row"><div class="col-12"><hr></div></div>
                            <div class="w-100 text-right">
                                <input type="hidden" name="wb_t_id" id="wb_t_id" value="<?php echo $row_Re_wt->wb_t_id;?>">
                                <button type="submit" class="btn btn-success btn-sm" id="btn_edit"><i class="fas fa-save"></i> บันทึกแก้ไขหัวข้อ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $(".dTH").datepicker(
            $.extend({}, 
                $.datepicker.regional.th, 
                { 
                    dateFormat: "dd/mm/yy",
                    changeMonth:true,
                    changeYear:true,
                    yearRange:"-100:+10",
                }
            )
        );
    });
    ClassicEditor
    .create( document.querySelector( '#wb_t_detail' ), {
        removePlugins: [ 'Heading', 'Link', 'MediaEmbed', "ImageUpload"],
    } )

    ClassicEditor
    .create( document.querySelector( '#wb_t_note' ), {
        removePlugins: [ 'Heading', 'Link', 'MediaEmbed', "ImageUpload"],
    } )

    $(document).ready(function() {
        $(document).on('click', '#btn_edit', function() {
            $('#form_edit').validate({
                rules: {
                    wb_t_title: { required: true },
                    wb_t_date: { required: true },
                    wb_t_time: { required: true },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_edit')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Webboard/webboard_topic_edit_save"); ?>',
                        type: 'POST',
                        dataType: "json",
                        data: formData,
                        beforeSend: function() { $('#loader').show(); },
                        complete: function() { $('#loader').hide(); },
                        success: function(data) {
                            if (data.action == 'Y') {
                                $.alert({
                                    icon: 'fas fa-check',
                                    title: 'สำเร็จ',
                                    content: data.output,
                                    type: 'green',
                                    typeAnimated: true,
                                    boxWidth: '420px',
                                    useBootstrap: false,
                                    onDestroy: function() {
                                        location.reload();
                                    }
                                });
                            } else {
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

        $(document).on('click', '.btn_wb_photo_dele', function() {
            var wb_t_id=$(this).attr('data-id');
            var photo=$(this).attr('data-name');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรูปภาพ',
                content: 'ต้องการลบ รูปภาพ Icon หัวข้อ หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function(){
                            $.ajax({
                                url: '<?php echo base_url("B_Webboard/webboard_topic_delete_photo"); ?>',
                                method: "POST",
                                dataType: "json",
                                beforeSend: function() {$('#loader').show();},
                                complete: function() {$('#loader').hide();},
                                data: { wb_t_id:wb_t_id,photo:photo,},
                                success: function(data) {
                                    if (data.action == 'Y') {
                                        location.reload();
                                    } else {
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