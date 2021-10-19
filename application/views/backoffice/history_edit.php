<?php foreach ($Re['Re_h'] as $row_Re_h);?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/history_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
        <div id="navi" class="col-12">
            <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> ทําเนียบ
                <i class="fas fa-caret-right"></i> <?php echo $h_type_name; ?>
                <i class="fas fa-caret-right"></i> แก้ไชทําเนียบ<?php echo $h_type_name; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12">
                                <i class="fas fa-user-clock"></i> แก้ไขทําเนียบ<?php echo $h_type_name; ?>
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <form id="form_edit" name="form_edit">
                            <div id="ajax_view_photo">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <?php if(!empty($row_Re_h->h_photo)){?>
                                            <button type="button" class="btn_fm btn_red btn_photo_dele" data-id="<?php echo $row_Re_h->h_id;?>" data-name="<?php echo $row_Re_h->h_name;?>"><i class="fas fa-times"></i> ลบ</button><br>
                                            <img class="img-fluid w-100" src="<?php echo base_url('public/images/history/'.$row_Re_h->h_photo);?>">
                                        <?php }else{?>
                                            <button type="button" class="btn_fm btn_red" disabled><i class="fas fa-times"></i> ลบ</button><br>
                                            <img class="img-fluid w-100" src="<?php echo base_url('public/images/member/nopeople.png');?>">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="">ชื่อ - นามสกุล</label>
                                    <input type="text" id="h_name" name="h_name" class="form-control form-control-sm" value="<?php echo $row_Re_h->h_name;?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>ตำแหน่งงาน</label>
                                    <input type="text" id="h_position" name="h_position" class="form-control form-control-sm" 
                                    value="<?php echo $row_Re_h->h_position; ?>">
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="">วันที่เริ่มดำรงดำแหน่ง</label>
                                    <input type="text" id="h_start" name="h_start" class="dTH form-control form-control-sm" value="<?php echo $this->B_Function_m->dateTha($row_Re_h->h_start);?>" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">ดำรงดำแหน่งถึงวันที่</label>
                                    <input type="text" id="h_end" name="h_end" class="dTH form-control form-control-sm" value="<?php echo $this->B_Function_m->dateTha($row_Re_h->h_end);?>" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="">สมัยที่</label>
                                    <input type="text" id="h_term" name="h_term" class="form-control form-control-sm" value="<?php echo $row_Re_h->h_term;?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>เปลี่ยนรูปภาพ</label>
                                    <input type="file" name="h_photo" id="h_photo" class="form-control form-control-sm"> 
                                    <input type="hidden" name="h_h_photo" id="h_h_photo" value="<?php echo $row_Re_h->h_photo;?>"> 
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-success btn-sm" id="btn_edit"><i class="fas fa-save"></i> แก้ไขทําเนียบ<?php echo $h_type_name; ?></button>
                            <input type="hidden" id="h_type" name="h_type" value="<?php echo $row_Re_h->h_type; ?>">
                            <input type="hidden" id="h_id" name="h_id" value="<?php echo $row_Re_h->h_id; ?>">
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
                $.datepicker.regional.th, { 
                    dateFormat: "dd/mm/yy",
                    changeMonth:true,
                    changeYear:true,
                    yearRange:"-100:+10",
                }
            )
        );
    });
    $(document).ready(function() {
        var type = '<?php echo $h_type_name; ?>';
        $(document).on('click', '#btn_edit', function() {
            $('#form_edit').validate({
                rules: {
                    h_type: { required: true },
                    h_name: { required: true },
                    h_term: { digits: true },
                    h_position: { required: true },
                    h_photo: { extension: "jpg|jpeg|png" },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_edit')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_History/history_edit_save"); ?>',
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
                                                location.href = '<?php echo base_url("backoffice/ทําเนียบ/");?>'+type;
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
            var h_id=$(this).attr('data-id');
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
                                url: '<?php echo base_url("B_History/history_delete_photo"); ?>',
                                method: "POST",
                                dataType: "json",
                                beforeSend: function() {$('#loader').show();},
                                complete: function() {$('#loader').hide();},
                                data: { h_id:h_id},
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