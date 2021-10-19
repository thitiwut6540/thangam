<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/member_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> บุคลากร
                <i class="fas fa-caret-right"></i> <?php echo $type_name; ?>
                <?php if($depart_id=='3'){ ?>
                <i class="fas fa-caret-right"></i> <?php echo $depart_name; ?>
                <?php } ?>
                <i class="fas fa-caret-right"></i> เพิ่มบุคลากร
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12">
                                <?php if($type_id!='3'){ ?>
                                    <i class="fas fa-users"></i> <?php echo $type_name; ?>
                                <?php }else{ ?>
                                    <i class="fas fa-users"></i> <?php echo "เพิ่มบุคลากร".$depart_name; ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <form id="form_insert" name="form_insert">
                            <div class="form-row">
                                <?php if($type_id == '3'){ ?>
                                    <div class="form-group col-md-3">
                                        <label>หน่วยงาน</label>
                                        <input type="text" id="dp_name" name="dp_name" class="form-control form-control-sm" value="<?php echo $depart_name;?>" readonly>
                                        <input type="hidden" id="dp_id" name="dp_id" value="<?php echo $depart_id;?>" readonly>
                                    </div>
                                <?php } else { echo '<input type="hidden" name="dp_id" id="dp_id" value="" readonly>'; } ?>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>กลุ่มแสดงรายการ</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mem_group" id="mem_lv_1" value="1">
                                        <label class="form-check-label">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mem_group" id="mem_lv_2" value="2">
                                        <label class="form-check-label">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mem_group" id="mem_lv_3" value="3">
                                        <label class="form-check-label">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mem_group" id="mem_lv_4" value="4">
                                        <label class="form-check-label">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mem_group" id="mem_lv_5" value="5">
                                        <label class="form-check-label">5</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mem_group" id="mem_lv_6" value="6">
                                        <label class="form-check-label">6</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mem_group" id="mem_lv_7" value="7">
                                        <label class="form-check-label">7</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mem_group" id="mem_lv_8" value="8">
                                        <label class="form-check-label">8</label>
                                    </div>
                                    <br><span class="text-danger">* ระดับใช้ในการจัดกลุ่มสมาชิก ระดับ 1 สุดสุด</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>ชื่อ - นามสกุล</label>
                                    <input type="text" id="mem_name" name="mem_name" class="form-control form-control-sm">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>ตำแหน่งงาน</label>
                                    <input type="text" id="mem_position" name="mem_position" class="form-control form-control-sm">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>นายกเทศมนตรี</label>
                                    <select name="mem_president" id="mem_president" class="form-control form-control-sm">
                                        <option value="N">ไม่</option>
                                        <option value="Y">เป็นนายกฯ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>โทรศัพท์</label>
                                    <input type="text" id="mem_tel" name="mem_tel" class="form-control form-control-sm">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>โทรศัพท์มือถือ</label>
                                    <input type="text" id="mem_mobile" name="mem_mobile" class="form-control form-control-sm">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>อีเมลล์</label>
                                    <input type="email" id="mem_email" name="mem_email" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>รูปภาพ</label>
                                    <input type="file" name="mem_photo" id="mem_photo" class="form-control form-control-sm"> 
                                </div>
                            </div>
                            <div class="border p-3 mb-3">
                                <span class="text-danger">* กรอกชื่อผู้ใช้เพื่อใช้งานระบบ e-office</span>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>ชื่อเข้าสู่ระบบ e-office</label>
                                        <input type="text" id="mem_user" name="mem_user" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>รหัสผ่าน</label>
                                        <input type="text" id="mem_pass" name="mem_pass" class="form-control form-control-sm" value="1234" readonly>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success" id="btn_insert"><i class="fas fa-save"></i> บันทึกเพิ่มบุคลากร</button>
                            <input type="hidden" id="memtype_id" name="memtype_id" value="<?php echo $type_id; ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var chkType = '<?php echo $type_id; ?>';
        if(chkType=='3'){
            var type = '<?php echo $type_name; ?>/'+'<?php echo $depart_name; ?>';
        }else{
            var type = '<?php echo $type_name; ?>';
        }
        $(document).on('click', '#btn_insert', function() {
            $('#form_insert').validate({
                rules: {
                    mem_group: { required: true },
                    mem_name: { required: true },
                    mem_position: { required: true },
                    mem_email: { email: true },
                    mem_photo: { extension: "jpg|jpeg|png" },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_insert')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Member/member_insert_save"); ?>',
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
                                                location.href = '<?php echo base_url("backoffice/บุคลากร/");?>'+type;
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
                                    onDestroy: function() {
                                        if(data.action == 'D'){
                                            $('#mem_user').focus();
                                        }
                                    }
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