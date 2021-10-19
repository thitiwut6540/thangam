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
                <i class="fas fa-caret-right"></i> เพิ่มหัวข้อย่อยใหม่
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
                        <form id="form_insert" name="form_insert">
                            <div class="row p-3">
                                <div class="col-6 col-md-2">
                                    <div class="row">
                                        <div class="col-12 img_1_1">
                                            <div>
                                            <?php if(!empty($row_Re_wt->wb_t_photo)){ ?>
                                                <img class="img-fluid" src="<?php echo base_url('public/images/webboard/'.$row_Re_wt->wb_t_photo.''); ?>">
                                            <?php } else { ?>
                                                <img class="img-fluid" src="<?php echo base_url('public/images/nophoto.png'); ?>">
                                            <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-10">
                                    <div class="form-group ">
                                        <div class="form-group col-4">
                                            <label for="">Topic ID.</label>
                                            <input type="text" id="wb_t_id" name="wb_t_id" class="form-control form-control-sm" value="<?php echo $row_Re_wt->wb_t_id;?>" readonly>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="">หัวข้อหลัก</label>
                                            <input type="text" id="wb_t_title" name="wb_t_title" class="form-control form-control-sm" value="<?php echo $row_Re_wt->wb_t_title;?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="">หัวข้อย่อย</label>
                                    <input type="text" id="wb_s_title" name="wb_s_title" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="wb_t_date">วันที่สร้าง</label><br>
                                    <input type="text" id="wb_s_date" name="wb_s_date" class="form-control form-control-sm dTH" value="<?php echo $this->B_Function_m->dateTha(date("Y-m-d")); ?>">
                                </div>
                                <div class="form-group col-md-auto">
                                    <label for="wb_s_time">เวลาที่สร้าง</label><br>
                                    <input type="time" id="wb_s_time" name="wb_s_time" class="form-control form-control-sm" value="<?php echo date('H:i'); ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="wb_s_user_save">ผู้สร้างหัวข้อย่อย</label>
                                    <input type="text" id="wb_s_user_save" name="wb_s_user_save" class="form-control form-control-sm" value="<?php echo $_SESSION[''.ANW_SS.'us_name']; ?>" readonly>
                                </div>
                                <div class="form-row pl-1 mt-2">
                                    <div class="form-group col-md-auto">
                                        <div class="row">
                                            <div class="col">ปักหมุดไว้ด้านบน</div>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="wb_s_pin_01" name="wb_s_pin" class="custom-control-input" value="Y" >
                                            <label class="custom-control-label" for="wb_s_pin_01">ปักหมุด</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="wb_s_pin_02" name="wb_s_pin" class="custom-control-input" value="N" checked>
                                            <label class="custom-control-label" for="wb_s_pin_02">ไม่ปักหมุด</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="">รายละเอียดเนื้อหาในหัวข้อย่อย</label>
                                    <textarea id="wb_s_detail" name="wb_s_detail" class="form-control form-control-sm" style="width:100%" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="">รูปภาพเนื้อหาในหัวข้อย่อย</label><br>
                                    <input type="file" name="wb_s_photo" id="wb_s_photo" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row"><div class="col-12"><hr></div></div>
                            <div class="w-100 text-right"><button type="submit" class="btn btn-success btn-sm" id="btn_insert"><i class="fas fa-save"></i> บันทึกเพิ่มหัวข้อย่อย</button></div>
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
    .create( document.querySelector( '#wb_s_detail' ), {
        removePlugins: [ 'Heading', 'Link', 'MediaEmbed', "ImageUpload"],
    } )
    $(document).ready(function() {
        $(document).on('click', '#btn_insert', function() {
            $('#form_insert').validate({
                rules: {
                    wb_t_id: { required: true },
                    wb_t_title: { required: true },
                    wb_s_title: { required: true },
                    wb_s_date: { required: true },
                    wb_s_time: { required: true },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_insert')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Webboard/webboard_sub_new_save"); ?>',
                        type: 'POST',
                        dataType: "json",
                        data: formData,
                        beforeSend: function() { $('#loader').show(); },
                        complete: function() { $('#loader').hide(); },
                        success: function(data) {
                            if (data.action == 'Y') {
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
                                            btnClass: 'btn-green',
                                            action: function(){
                                                window.location.href = "<?php echo base_url("backoffice/webboard"); ?>";
                                            }
                                        },
                                        ปิด: {
                                            action: function(){
                                                $('#form_insert')[0].reset();
                                            }
                                        },
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
    });
</script>