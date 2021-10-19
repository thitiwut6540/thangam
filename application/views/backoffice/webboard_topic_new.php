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
                <i class="fas fa-caret-right"></i> เพิ่มหัวข้อใหม่
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
                            
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="wb_t_date">วันที่สร้าง/label><br>
                                    <input type="text" id="wb_t_date" name="wb_t_date" class="form-control form-control-sm dTH" value="<?php echo $this->B_Function_m->dateTha(date("Y-m-d")); ?>">
                                </div>
                                <div class="form-group col-md-auto">
                                    <label for="wb_t_time">เวลาที่สร้าง</label><br>
                                    <input type="time" id="wb_t_time" name="wb_t_time" class="form-control form-control-sm" value="<?php echo date('H:i'); ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>ผู้สร้างหัวข้อ</label>
                                    <input type="text" class="form-control form-control-sm" id="wb_t_user_save" name="wb_t_user_save" value="<?php echo $_SESSION[''.ANW_SS.'us_name']; ?>" readonly>
                                </div>
                                <div class="form-row pl-1 mt-2">
                                    <div class="form-group col-md-auto">
                                        <div class="row">
                                            <div class="col">คอมเมนต์หัวข้อ</div>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="wb_cm_01" name="wb_t_comment" class="custom-control-input" value="Y" checked>
                                            <label class="custom-control-label" for="wb_cm_01">มี</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="wb_cm_02" name="wb_t_comment" class="custom-control-input" value="N">
                                            <label class="custom-control-label" for="wb_cm_02">ไม่มี</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>หัวข้อเรื่อง</label>
                                    <input type="text" id="wb_t_title" name="wb_t_title" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>คำนำอธิบายหัวข้อ</label>
                                    <textarea id="wb_t_detail" name="wb_t_detail"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>ข้อความที่ต้องการโพสต์</label>
                                    <textarea id="wb_t_note" name="wb_t_note"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>รูปภาพ Icon หัวข้อ</label>
                                    <input type="file" name="wb_t_photo" id="wb_t_photo" class="form-control form-control-sm"><br>
                                    <span class="text-danger">* รูปภาพแสดงในหน้าแสดงรายการ</span>
                                </div>
                            </div>
                            <div class="row"><div class="col-12"><hr></div></div>
                            <div class="w-100 text-right">
                                <button type="submit" class="btn btn-success btn-sm" id="btn_insert"><i class="fas fa-save"></i> บันทึกเพิ่มหัวข้อ</button>
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
        $(document).on('click', '#btn_insert', function() {
            $('#form_insert').validate({
                rules: {
                    wb_t_title: { required: true },
                    wb_t_date: { required: true },
                    wb_t_time: { required: true },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_insert')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Webboard/webboard_topic_new_save"); ?>',
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
                                        $('#form_insert')[0].reset();
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