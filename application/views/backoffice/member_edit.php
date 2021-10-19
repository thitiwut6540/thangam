<?php foreach ($Re['Re_m'] as $row_Re_m);?>
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
                <i class="fas fa-caret-right"></i> แก้ไขข้อมูลบุคลากร
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
                                    <i class="fas fa-users"></i> <?php echo "แก้ไขข้อมูลบุคลากร".$depart_name; ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <form id="form_edit" name="form_edit">
                            <div id="ajax_view_photo">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <?php if(!empty($row_Re_m->mem_photo)){?>
                                            <button type="button" class="btn_fm btn_red btn_photo_dele" data-id="<?php echo $row_Re_m->mem_id;?>" data-name="<?php echo $row_Re_m->mem_name;?>"><i class="fas fa-times"></i> ลบ</button><br>
                                            <img class="img-fluid w-100" src="<?php echo base_url('public/images/member/'.$row_Re_m->mem_photo);?>">
                                        <?php }else{?>
                                            <button type="button" class="btn_fm btn_red" disabled><i class="fas fa-times"></i> ลบ</button><br>
                                            <img class="img-fluid w-100" src="<?php echo base_url('public/images/member/nopeople.png');?>">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <?php if($type_id == '3'){ ?>
                                    <div class="form-group col-md-3">
                                        <label>หน่วยงาน</label>
                                        <input type="text" id="dp_name" name="dp_name" class="form-control form-control-sm" value="<?php echo $row_Re_m->dp_name;?>" readonly>
                                        <input type="hidden" id="dp_id" name="dp_id" value="<?php echo $row_Re_m->dp_id;?>" readonly>
                                    </div>
                                <?php } else { echo '<input type="hidden" name="dp_id" id="dp_id" value="" readonly>'; } ?>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="">กลุ่มแสดงรายการ</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mem_group" id="mem_lv_1" value="1" <?php if($row_Re_m->mem_group == 1){echo "checked";}?>>
                                        <label class="form-check-label" for="mem_group_no1">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mem_group" id="mem_lv_2" value="2" <?php if($row_Re_m->mem_group == 2){echo "checked";}?>>
                                        <label class="form-check-label" for="mem_group_no2">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mem_group" id="mem_lv_3" value="3" <?php if($row_Re_m->mem_group == 3){echo "checked";}?>>
                                        <label class="form-check-label" for="mem_group_no3">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mem_group" id="mem_lv_4" value="4" <?php if($row_Re_m->mem_group == 4){echo "checked";}?>>
                                        <label class="form-check-label" for="mem_group_no4">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mem_group" id="mem_lv_5" value="5" <?php if($row_Re_m->mem_group == 5){echo "checked";}?>>
                                        <label class="form-check-label" for="mem_group_no5">5</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mem_group" id="mem_lv_6" value="6" <?php if($row_Re_m->mem_group == 6){echo "checked";}?>>
                                        <label class="form-check-label" for="mem_group_no6">6</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mem_group" id="mem_lv_7" value="7" <?php if($row_Re_m->mem_group == 7){echo "checked";}?>>
                                        <label class="form-check-label" for="mem_group_no7">7</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="mem_group" id="mem_lv_8" value="8" <?php if($row_Re_m->mem_group == 8){echo "checked";}?>>
                                        <label class="form-check-label" for="mem_group_no8">8</label>
                                    </div>
                                    <br><span>ระดับใช้ในการจัดกลุ่มสมาชิก ระดับ 1 สุดสุด</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="">ชื่อ - นามสกุล</label>
                                    <input type="text" id="mem_name" name="mem_name" class="form-control form-control-sm" value="<?php echo $row_Re_m->mem_name;?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>ตำแหน่งงาน</label>
                                    <input type="text" id="mem_position" name="mem_position" class="form-control form-control-sm" 
                                    value="<?php if(!empty($row_Re_m->position_id)){echo $row_Re_m->position_name;}else{ echo $row_Re_m->mem_position;}?>">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>นายกเทศมนตรี</label>
                                    <select name="mem_president" id="mem_president" class="form-control form-control-sm">
                                        <option value="N" <?php if($row_Re_m->position_name!="Y"){echo "selected=\"selected\"";}?>>ไม่</option>
                                        <option value="Y" <?php if($row_Re_m->position_name=="Y"){echo "selected=\"selected\"";}?>>เป็นนายกฯ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="">โทรศัพท์ที่ทำงาน</label>
                                    <input type="text" id="mem_tel" name="mem_tel" class="form-control form-control-sm" value="<?php echo $row_Re_m->mem_tel;?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">โทรศัพท์มือถือ</label>
                                    <input type="text" id="mem_mobile" name="mem_mobile" class="form-control form-control-sm" value="<?php echo $row_Re_m->mem_mobile;?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">อีเมลล์</label>
                                    <input type="email" id="mem_email" name="mem_email" class="form-control form-control-sm" value="<?php echo $row_Re_m->mem_email;?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>เปลี่ยนรูปภาพ</label>
                                    <input type="file" name="mem_photo" id="mem_photo" class="form-control form-control-sm"> 
                                    <input type="hidden" name="h_mem_photo" id="h_mem_photo" value="<?php echo $row_Re_m->mem_photo;?>"> 
                                </div>
                            </div>
                            <hr>
                            <div class="border p-3 mb-3">
                                <span class="text-danger">* กรอกชื่อผู้ใช้เพื่อใช้งานระบบ e-office</span>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="">แก้ไขชื่อเข้าสู่ระบบ e-office</label>
                                        <input type="text" id="mem_user" name="mem_user" class="form-control form-control-sm" value="<?php echo $row_Re_m->mem_user; ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">แก้ไขรหัสผ่าน</label>
                                        <input type="password" id="mem_pass" name="mem_pass" class="form-control form-control-sm">
                                        <input type="hidden" id="h_mem_pass" name="h_mem_pass" value="<?php echo $row_Re_m->mem_pass; ?>">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm" id="btn_edit"><i class="fas fa-save"></i> บันทึก</button>
                            <input type="hidden" id="memtype_id" name="memtype_id" value="<?php echo $type_id; ?>">
                            <input type="hidden" id="mem_id" name="mem_id" value="<?php echo $row_Re_m->mem_id; ?>">
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
            var type = '<?php echo $type_name."/".$depart_name; ?>';
        }else{
            var type = '<?php echo $type_name; ?>';
        }
        $(document).on('click', '#btn_edit', function() {
            $('#form_edit').validate({
                rules: {
                    mem_group: { required: true },
                    mem_name: { required: true },
                    mem_position: { required: true },
                    mem_email: { email: true },
                    mem_photo: { extension: "jpg|jpeg|png" },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_edit')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Member/member_edit_save"); ?>',
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

        $(document).on('click', '.btn_photo_dele', function() {
            var mem_id=$(this).attr('data-id');
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
                                url: '<?php echo base_url("B_Member/member_delete_photo"); ?>',
                                method: "POST",
                                dataType: "json",
                                beforeSend: function() {$('#loader').show();},
                                complete: function() {$('#loader').hide();},
                                data: { mem_id:mem_id},
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