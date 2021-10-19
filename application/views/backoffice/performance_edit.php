<?php foreach ($Re['Re_pm'] as $row_Re_pm);?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/performance_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> ผลการดำเนินงาน
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/ผลการดำเนินงาน/'.$depart.'');?>" ><?php echo $depart;?></a>
                <i class="fas fa-caret-right"></i> แก้ไขข้อมูล
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12"><i class="fas fa-performancepaper"></i> แก้ไขข้อมูล<?php echo $depart; ?></div>
                        </div>
                    </div>

                    <div class="box_con_detail">
                        <form id="form_edit" name="form_edit">
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label> แสดง</label>
                                    <select name="pm_status" id="pm_status" class="form-control form-control-sm">
                                            <option value="">เลือก</option>
                                            <option value="Y" <?php if($row_Re_pm->pm_status == 'Y'){echo "selected";} ?>>แสดง</option>
                                            <option value="N" <?php if($row_Re_pm->pm_status == 'N'){echo "selected";} ?>>ไม่แสดง</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>หน่วยงาน</label>
                                    <input type="text" id="dp_name" name="dp_name" class="form-control form-control-sm" value="<?php echo $row_Re_pm->dp_name; ?>" readonly>
                                    <input type="hidden" id="dp_id" name="dp_id" value="<?php echo $row_Re_pm->dp_id; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-auto">
                                    <label>วันที่โพส</label><br>
                                    <input type="text" id="pm_date_post" name="pm_date_post" class="form-control form-control-sm dTH" value="<?php echo $this->B_Function_m->dateTha($row_Re_pm->pm_date); ?>">
                                </div>
                                <div class="form-group col-auto">
                                    <label>เวลาที่โพส</label><br>
                                    <input type="time" id="pm_time" name="pm_time" class="form-control form-control-sm" value="<?php echo $this->B_Function_m->dateTime($row_Re_pm->pm_date); ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="">หัวข้อผลการดำเนินงาน</label>
                                    <input type="text" id="pm_name" name="pm_name" class="form-control form-control-sm" value="<?php echo $row_Re_pm->pm_name; ?>">
                                </div>
                            </div>
                            <div class="form-row"><div class="col-12"><i class="fas fa-paperclip"></i> แนบไฟล์เอกสาร (PDF เท่านั้น)</div></div>
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <input type="file" name="pm_f_file[]" class="form-control form-control-sm">
                                </div>
                                <div class="form-group col-4">
                                    <input type="text" name="pm_f_name[]" class="form-control form-control-sm" placeholder="ชื่อเรียกเอกสาร">
                                </div>
                                <div class="form-group col-4">
                                    <button type="button" class="btn btn-sm btn-success" id="btn_add_file"><i class="fas fa-plus"></i></button>
                                    (กด + เพิ่มไฟล์เอกสาร)
                                </div>
                            </div>
                            <div id="addFile"></div>
                            <div class="form-row">
                                <?php foreach ($Re['Re_pmf'] as $row_Re_pmf){?>
                                    <div class="form-group col-4">
                                        <button type="button" class="btn_fm btn_red btn_file_dele" data-id="<?php echo $row_Re_pmf->pm_f_id;?>"><i class="fas fa-times"></i> ลบ</button>
                                        <i class="fas fa-paperclip"></i> <a target="_blank" href="<?php echo base_url('public/files/performance/'.$row_Re_pmf->pm_f_file); ?>"><?php echo $row_Re_pmf->pm_f_file; ?></a>
                                    </div>
                                    <div class="form-group col-8">
                                        <?php echo $row_Re_pmf->pm_f_name; ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-sm btn-success" id="btn_submit_edit"><i class="fas fa-save"></i> บันทึกแก้ไขข้อมูล</button> 
                            <input type="hidden" id="pm_id" name="pm_id" value="<?php echo $row_Re_pm->pm_id;?>">
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

    $(document).ready(function(){
        $(document).on('click', '#btn_submit_edit', function() {
            $.validator.addMethod('filesize', function(value, element, param) {
                return this.optional(element) || (element.files[0].size <= param) 
            });
            $('#form_edit').validate({
                rules: {
                    pm_status: { required: true },
                    dp_id: { required: true },
                    pm_name: { required: true },
                    pm_date_post: { required: true },
                    pm_time: { required: true },
                    'pm_f_file[]':{ 
                        extension: "pdf", 
                        filesize: 10000000 // 10mb
                    },
                },
                messages: {
                    'pm_f_file[]':{
                        extension: "ประเภทไฟล์รับเฉพาะ PDF เท่านั้น",
                        filesize: "ไฟล์ขนาดไม่เกิน 10 MB.",
                    }
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_edit')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Performance/performance_edit_save"); ?>',
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
                                                location.href = '<?php echo base_url("backoffice/ผลการดำเนินงาน/".$depart);?>';
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

        $(document).on('click', '#btn_add_file', function() {
            $.ajax({
                url: '<?php echo base_url("B_Performance/performance_add_file"); ?>',
                type: 'POST',
                dataType: "json",
                success: function(data) {
                    if(data.action=='Y'){
                        $("#addFile").after(data.output);
                    }
                }
            });
        });
        $(document).on('click', '.btn_dele_file', function() {
            var id=$(this).attr('data-id');
            $('#'+id+'').remove();
        });

        $(document).on('click', '.btn_file_dele', function() {
            var pm_f_id=$(this).attr('data-id');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรูปภาพ',
                content: 'ต้องการลบ ไฟล์เอกสาร หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function(){
                            $.ajax({
                                url: '<?php echo base_url("B_Performance/performance_dele_file"); ?>',
                                method: "POST",
                                dataType: "json",
                                beforeSend: function() {$('#loader').show();},
                                complete: function() {$('#loader').hide();},
                                data: { pm_f_id:pm_f_id},
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