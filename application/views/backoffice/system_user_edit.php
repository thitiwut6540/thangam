<?php 
foreach ($Re['Re_u'] as $row_Re_u); ?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/system_user_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <a href="<?php echo base_url('backoffice/ผู้ใช้งานระบบ');?>" >ผู้ใช้งานระบบ</a> <i class="fas fa-caret-right"></i> 
                แก้ไขผู้ใช้งานระบบ
            </div>
        </div>
        <div class="row">

            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12"><i class="fas fa-user"></i> แก้ไขผู้ใช้งานระบบ</div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <form name="form_edit" id="form_edit">
                            <div class="form-row">
                                <div class="form-group col-md-6 col-lg-4 col-xl-3">
                                    <label for="us_status">สถานะ</label>
                                    <select class="form-control form-control-sm" name="us_status" id="us_status" autofocus>
                                        <option value="">เลือก</option>
                                        <option value="1" <?php if($row_Re_u->us_status=="1"){ echo "selected=\"selected\""; } ?>>ใช้งาน</option>
                                        <option value="0" <?php if($row_Re_u->us_status=="0"){ echo "selected=\"selected\""; } ?>>ยกเลิก</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-lg-4 col-xl-3">
                                    <label>การอนุมัติ</label>
                                    <select class="form-control form-control-sm" name="us_approve" id="us_approve">
                                        <option value="">เลือก</option>
                                        <option value="Y" <?php if($row_Re_u->us_approve=="Y"){ echo "selected=\"selected\""; } ?>>ผู้อนุมัติ</option>
                                        <option value="N" <?php if($row_Re_u->us_approve=="N"){ echo "selected=\"selected\""; } ?>>ปกติ</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-lg-4 col-xl-3">
                                    <label for="usl_id">หน่วยงาน</label>
                                    <select class="form-control form-control-sm" name="dp_id" id="dp_id">
                                        <option value="">เลือก</option>
                                        <?php foreach ($Re_dp as $row_Re_dp){?>
                                        <option value="<?php echo $row_Re_dp->dp_id;?>" <?php if($row_Re_u->dp_id==$row_Re_dp->dp_id){ echo 'selected'; } ?>><?php echo $row_Re_dp->dp_name;?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6 col-lg-4 col-xl-3">
                                    <label for="usl_id">ระดับสิทธิการใช้งาน</label>
                                    <select class="form-control form-control-sm" name="usl_id" id="usl_id">
                                        <option value="">เลือก</option>
                                        <?php foreach ($Re_ac as $row_Re_ac){?>
                                        <option value="<?php echo $row_Re_ac->usl_id;?>" <?php if($row_Re_u->usl_id==$row_Re_ac->usl_id){ echo "selected=\"selected\""; } ?>><?php echo $row_Re_ac->usl_name;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-lg-4 col-xl-3">
                                    <label for="us_name">ชื่อ-นามสกุล</label>
                                    <input class="form-control form-control-sm" type="text" id="us_name" name="us_name" value="<?php echo $row_Re_u->us_name;?>">
                                </div>

                                <div class="form-group col-md-6 col-lg-4 col-xl-3">
                                    <label for="us_user">USERNAME</label>
                                    <input class="form-control form-control-sm" type="text" id="us_user" name="us_user" value="<?php echo $row_Re_u->us_user;?>">
                                    <input type="hidden" id="h_us_user" name="h_us_user" value="<?php echo $row_Re_u->us_user;?>">
                                </div>

                                <div class="form-group col-md-6 col-lg-4 col-xl-3">
                                    <label for="us_pass">PASSWORD</label>
                                    <input class="form-control form-control-sm" type="text" id="us_pass" name="us_pass" aria-describedby="us_pass_Help">
                                    <input type="hidden" id="h_us_pass" name="h_us_pass" value="<?php echo $row_Re_u->us_pass;?>">
                                    <small id="us_pass_Help" class="form-text text-muted">ใสเฉพาะกรณีที่ต้องการเปลี่ยน Password เท่านั้น</small>
                                </div>
                            </div>
                            <hr>
                            <p>
                                <a class="btn btn-danger" href="<?php echo base_url('Backoffice/ผู้ใช้งานระบบ/edit/').$row_Re_u->us_id;?>"><i class="fas fa-redo-alt"></i> ยกเลิก</a>
                                <button type="submit" class="btn btn-success" id="btn_edit_submit" name="btn_edit_submit" >
                                <i class="fas fa-save"></i> บันทึกแก้ไข</button>
                                <input type="hidden" name="us_id" id="us_id" value="<?php echo $row_Re_u->us_id;?>">
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', '#btn_edit_submit', function() {
            $('#form_edit').validate({
                rules: {
                    us_status: { required: true },
                    us_action: { required: true },
                    us_approve: { required: true },
                    usl_id: { required: true },
                    dp_id: { required: true },
                    us_name: { required: true },
                    us_user: { required: true },
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: '<?php echo base_url("B_User/user_edit_save");?>',
                        type: 'POST',
                        dataType: "json",
                        data: $('#form_edit').serialize(),
                        beforeSend: function() {$('#loader').show();},
                        complete: function() {$('#loader').hide();},
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
                                                window.location.href = '<?php echo base_url("backoffice/ผู้ใช้งานระบบ");?>';
                                            }
                                        },
                                        ปิด: {},
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
                                            $('#us_user').focus();
                                        }else {
                                            $('#us_status').focus();
                                        }
                                    }
                                });
                            }
                        }
                    });
                },
            });
        });
    })
</script>