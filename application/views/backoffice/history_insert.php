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
                <i class="fas fa-caret-right"></i> เพิ่มทําเนียบ<?php echo $h_type_name; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12">
                                <i class="fas fa-user-clock"></i> เพิ่มทําเนียบ<?php echo $h_type_name; ?>
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <form id="form_insert" name="form_insert">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>ชื่อ - นามสกุล</label>
                                    <input type="text" id="h_name" name="h_name" class="form-control form-control-sm">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>ตำแหน่งงาน</label>
                                    <input type="text" id="h_position" name="h_position" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>วันที่เริ่มดำรงดำแหน่ง</label>
                                    <input type="text" id="h_start" name="h_start" class="dTH form-control form-control-sm" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>ดำรงดำแหน่งถึงวันที่</label>
                                    <input type="text" id="h_end" name="h_end" class="dTH form-control form-control-sm" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>สมัยที่</label>
                                    <input type="text" id="h_term" name="h_term" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>รูปภาพ</label>
                                    <input type="file" name="h_photo" id="h_photo" class="form-control form-control-sm"> 
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-sm btn-success" id="btn_insert"><i class="fas fa-save"></i> เพิ่มทําเนียบ<?php echo $h_type_name; ?></button>
                            <input type="hidden" id="h_type" name="h_type" value="<?php echo $h_type; ?>">
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
        $(document).on('click', '#btn_insert', function() {
            $('#form_insert').validate({
                rules: {
                    h_type: { required: true },
                    h_name: { required: true },
                    h_position: { required: true },
                    h_term: { digits: true },
                    h_photo: { extension: "jpg|jpeg|png" },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_insert')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_History/history_insert_save"); ?>',
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
    });
</script>