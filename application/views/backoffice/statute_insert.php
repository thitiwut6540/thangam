<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/statute_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> กฎหมายและระเบียบ
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/กฎหมายและระเบียบ/'.$type.'');?>" ><?php echo $type;?></a>
                <i class="fas fa-caret-right"></i> เพิ่ม<?php echo $type;?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                    <div class="row">
                            <div class="col-12"><i class="fas fa-book"></i> เพิ่ม<?php echo $type; ?></div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <?php if(!empty($type_id) AND $type_id>0){ ?>
                            <form id="form_insert" name="form_insert">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label> แสดง</label>
                                        <select name="stt_status" id="stt_status" class="form-control form-control-sm">
                                                <option value="">เลือก</option>
                                                <option value="Y">แสดง</option>
                                                <option value="N">ไม่แสดง</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>ประเภทระเบียบ</label>
                                        <input type="text" id="stt_t_name" name="stt_t_name" class="form-control form-control-sm" value="<?php echo $type;?>" readonly>
                                        <input type="hidden" id="stt_t_id" name="stt_t_id" value="<?php echo $type_id;?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-auto">
                                        <label>วันที่โพส</label><br>
                                        <input type="text" id="stt_date_post" name="stt_date_post" class="form-control form-control-sm dTH" value="<?php echo $this->B_Function_m->dateTha(date("Y-m-d")); ?>">
                                    </div>
                                    <div class="form-group col-auto">
                                        <label>เวลาที่โพส</label><br>
                                        <input type="time" id="stt_time" name="stt_time" class="form-control form-control-sm" value="<?php echo date('H:i'); ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-9">
                                        <label>หัวข้อ <?php echo $type; ?></label>
                                        <textarea id="stt_name" name="stt_name" class="form-control form-control-sm"></textarea>
                                    </div>
                                </div>

                                <div class="form-row"><div class="col-12"><i class="fas fa-paperclip"></i> แนบไฟล์เอกสาร (PDF เท่านั้น)</div></div>
                                <div class="form-row">
                                    <div class="form-group col-4">
                                        <input type="file" name="stt_f_file[]" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group col-4">
                                        <input type="text" name="stt_f_name[]" class="form-control form-control-sm" placeholder="ชื่อเรียกเอกสาร">
                                    </div>
                                    <div class="form-group col-4">
                                        <button type="button" class="btn btn-sm btn-success" id="btn_add_file"><i class="fas fa-plus"></i></button>
                                    (กด + เพิ่มไฟล์เอกสาร)
                                    </div>
                                </div>
                                <div id="addFile">
                                <hr>
                                <button type="submit" class="btn btn-sm btn-success" id="btn_submit_insert"><i class="fas fa-save"></i> บันทึกเพิ่ม <?php echo $type;?></button>
                            </form>
                        <?php }else{ ?>
                            <div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> ไม่สามารถระบุประเภทระเบียบได้</div>
                        <?php } ?>
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

    $(document).ready(function(){
        $(document).on('click', '#btn_submit_insert', function() {
            $.validator.addMethod('filesize', function(value, element, param) {
                return this.optional(element) || (element.files[0].size <= param) 
            });
            $('#form_insert').validate({
                rules: {
                    stt_status: { required: true },
                    stt_t_id: { required: true },
                    stt_t_name: { required: true },
                    stt_name: { required: true },
                    stt_date_post: { required: true },
                    stt_time: { required: true },
                    'stt_f_file[]':{ 
                        extension: "pdf", 
                        filesize: 10000000 // 10mb
                    },
                },
                messages: {
                    'stt_f_file[]':{
                        extension: "ประเภทไฟล์รับเฉพาะ PDF เท่านั้น",
                        filesize: "ไฟล์ขนาดไม่เกิน 10 MB.",
                    }
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_insert')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Statute/statute_insert_save"); ?>',
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
                                                location.href = '<?php echo base_url("backoffice/กฎหมายและระเบียบ/".$type);?>';
                                            }
                                        },
                                        ปิด: {
                                            action: function(){
                                                $('#form_insert')[0].reset();
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
                url: '<?php echo base_url("B_Statute/statute_add_file"); ?>',
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
    });
</script>