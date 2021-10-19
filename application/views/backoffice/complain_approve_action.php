<?php foreach ($Re['Re_c'] as $row_Re_c);?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/complain_menu.php');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> ร้องเรียนร้องทุกข์
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/ร้องเรียนร้องทุกข์');?>" >แจ้งเรื่อง</a>
                <i class="fas fa-caret-right"></i> ดำเนินการ
            </div>
        </div>

        <?php $this->load->view('backoffice/complain_detail') ;?>

        <div class="row mt-4">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header bg-primary">
                        <div class="row">
                            <div class="col-8"><i class="fas fa-save fa-lg"></i> บันทึกการดำเนินการ</div>
                            <div class="col-4 text-right"></div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <form id="form_insert" name="form_insert">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="border jumbotron p-4">

                                        <div class="form-row">
                                            <div class="form-group col-12 col-md-2">
                                                <label>เลขที่เรื่องร้องทุกข์</label>
                                                <input type="text" class="form-control form-control-sm" id="c_no" name="c_no" value="<?php echo $row_Re_c->c_no;?>" readonly>
                                                <input type="hidden" id="c_id" name="c_id" value="<?php echo $row_Re_c->c_id;?>" readonly>
                                            </div>
                                            <div class="form-group col-12 col-md-3">
                                                <label>ผู้บันทึกการดำเนินการ</label>
                                                <input type="text" class="form-control form-control-sm" id="ca_receive" name="ca_receive" value="<?php echo $_SESSION[''.ANW_SS.'us_name'];?>" readonly>
                                            </div>
                                            <div class="form-group col-12 col-md-3">
                                                <?php 
                                                $ReDP2 = $this->B_Complain_m->getDepart($_SESSION[''.ANW_SS.'dp_id']); 
                                                foreach ($ReDP2['Re_dp'] as $row_Re_dp2);
                                                ?>
                                                <label>หน่วยงาน</label>
                                                <input type="text" class="form-control form-control-sm" id="ca_dp_name" name="ca_dp_name" value="<?php echo $row_Re_dp2->dp_name;?>" readonly>
                                                <input type="hidden" class="form-control form-control-sm" id="ca_dp_id" name="ca_dp_id" value="<?php echo $_SESSION[''.ANW_SS.'dp_id'] ;?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-6 col-md-2">
                                                <label>บันทึกสถานะ</label>
                                                <input type="text" class="form-control form-control-sm" id="c_status" name="c_status" value="ดำเนินการ" readonly>
                                            </div>
                                            <div class="form-group col-md-auto">
                                                <label for="">หน่วยงานที่รับดำเนินการ</label>
                                                <select name="dp_id" id="dp_id" class="form-control form-control-sm">
                                                        <option value="">เลือกหน่วยงาน</option>
                                                        <?php foreach ($ReDP['Re_dp'] as $row_Re_dp){ ?>
                                                        <option value="<?php echo $row_Re_dp->dp_id;?>"><?php echo $row_Re_dp->dp_name;?></option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-6 col-md-2">
                                                <label>วันที่ดำเนินการ</label>
                                                <input type="text" class="form-control form-control-sm dTH" id="ca_date" name="ca_date" value="<?php echo $this->B_Function_m->dateTha(date("Y-m-d"));?>" readonly>
                                            </div>
                                            <div class="form-group col-6 col-md-2">
                                                <label>เวลา</label>
                                                <input type="time" class="form-control form-control-sm" id="ca_date_time" name="ca_date_time" value="<?php echo date("H:i");?>">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-12 col-md-6">
                                                <label>หมายเหตุ ( บันทึกภายใน )</label>
                                                <textarea class="form-control form-control-sm" rows="5" id="ca_comment" name="ca_comment"></textarea>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <label>รายละเอียดดำเนินการ ( แสดงภายนอก )</label>
                                                <textarea class="form-control form-control-sm" rows="5" id="ca_public" name="ca_public"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="ban_photo">ภาพประกอบ 1</label>
                                                <input type="file" name="ca_photo1" id="ca_photo1" class="form-control form-control-sm"> 
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="ban_photo">ภาพประกอบ 2</label>
                                                <input type="file" name="ca_photo2" id="ca_photo2" class="form-control form-control-sm"> 
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 text-right">
                                                <button type="submit" form="form_insert" class="btn btn-success" id="btn_submit_insert"><i class="fas fa-save"></i> บันทึกข้อมูลกำรดำเนินการ</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal_box" style="display:none;"><form id="modal_box_form" name="modal_box_form"></form></div>
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
        $(document).on('click', '.btn_edit_approve', function() {
            $('#modal_box').html('<form id="modal_box_form" name="modal_box_form"></form>');
            var id = $(this).attr('data-id');
            $.ajax({
                url: '<?php echo base_url("B_Complain/complain_approve_edit"); ?>',
                method: "POST",
                data: {id:id},
                success: function (data) {
                    $('#modal_box_form').html(data);
                    $('#modal_box').dialog({
                        draggable: true,
                        closeOnEscape: true,
                        title: "แก้ไขข้อมูลการบันทึก",
                        modal: true,
                        width: 1200,
                        height: 450,
                        buttons: [
                            {
                                text: "บันทึกการแก้ไขข้อมูล",
                                id: "btn-1",
                                click: function(){ 
                                    $.ajax({
                                        url: '<?php echo base_url("B_Complain/complain_approve_edit_save"); ?>',
                                        type: 'POST',
                                        dataType: "json",
                                        data: $('#modal_box_form').serialize(),
                                        beforeSend: function() { $('#loader').show(); },
                                        complete: function() { $('#loader').hide(); },
                                        success: function(data) {
                                            if(data.action=='Y'){
                                                $('#modal_box').dialog("close");
                                                $.alert({
                                                    icon: 'fas fa-check',
                                                    title: 'สำเร็จ',
                                                    content: data.output,
                                                    type: 'green',
                                                    typeAnimated: true,
                                                    boxWidth: '420px',
                                                    useBootstrap: false,
                                                    onDestroy: function() {
                                                        $('#modal_box').dialog("close");
                                                        location.reload();
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
                                    });
                                }
                            }, 
                            {
                                text: "ปิด",
                                id: "btn-2",
                                click: function(){            
                                    $('#modal_box').dialog("close");
                                }
                            }  
                        ]
                    });
                }
            });
        });

        $(document).on('click', '.btn_dele_action', function() {
            var c_status = $(this).attr('data-status');
            var c_id = $(this).attr('data-id');
            var ca_id = $(this).attr('data-aid');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบบันทึกรายการ',
                content: 'ต้องการลบบันทึกรายการ '+c_status+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function(){
                            $.ajax({
                                url: '<?php echo base_url("B_Complain/complain_action_delete"); ?>',
                                type: 'POST',
                                dataType: "json",
                                data: {c_id:c_id,ca_id:ca_id,c_status:c_status},
                                beforeSend: function() { $('#loader').show(); },
                                complete: function() { $('#loader').hide(); },
                                success: function(data) {
                                    if(data.action=='Y'){
                                        $.alert({
                                            icon: 'fas fa-check',
                                            title: 'สำเร็จ',
                                            content: data.output,
                                            type: 'green',
                                            typeAnimated: true,
                                            boxWidth: '420px',
                                            useBootstrap: false,
                                            onDestroy: function() {
                                                location.href = '<?php echo base_url("backoffice/ร้องเรียนร้องทุกข์/");?>'+data.status;

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
                            });
                        }
                    },
                    ยกเลิก: {},
                }
            });
        });

        $(document).on('click', '#btn_submit_insert', function() {
            $.validator.addMethod('filesize', function(value, element, param) {
                return this.optional(element) || (element.files[0].size <= param) 
            });
            $('#form_insert').validate({
                rules: {
                    c_status: { required: true },
                    ca_receive: { required: true },
                    ca_dp_name: { required: true },
                    dp_id: { required: true },
                    ca_date: { required: true },
                    ca_date_time: { required: true },
                    ca_comment: { required: true },
                    ca_public: { required: true },
                    ca_photo1: { extension: "jpg|jpeg|png", filesize: 5000000 },
                    ca_photo2: { extension: "jpg|jpeg|png", filesize: 5000000 },
                },
                messages: {
                    ca_photo1:{
                        extension: "ประเภทไฟล์รับเฉพาะ jpg และ png เท่านั้น",
                        filesize: "ไฟล์ขนาดไม่เกิน 10 MB.",
                    },
                    ca_photo2:{
                        extension: "ประเภทไฟล์รับเฉพาะ jpg และ png เท่านั้น",
                        filesize: "ไฟล์ขนาดไม่เกิน 5 MB.",
                    }
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_insert')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Complain/complain_approve_action"); ?>',
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
                                            text: 'ไปหน้ารายการ'+data.status,
                                            btnClass: 'btn-green',
                                            action: function(){
                                                location.href = '<?php echo base_url("backoffice/ร้องเรียนร้องทุกข์/");?>'+data.status;
                                            }
                                        },
                                        ปิด: {
                                            action: function(){
                                                location.href = '<?php echo base_url("backoffice/ร้องเรียนร้องทุกข์/รับเรื่อง");?>';
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
    });
</script>