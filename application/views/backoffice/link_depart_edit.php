<?php foreach ($Re['Re_l'] as $row_Re_l);?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/link_depart_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">backoffice</span></a>
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/ปุ่มลิงค์หน่วยงาน');?>" >ปุ่มลิงค์หน่วยงาน</a>
                <i class="fas fa-caret-right"></i> แก้ไขปุ่มลิงค์หน่วยงาน
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12"><i class="fas fa-link"></i> แก้ไขปุ่มลิงค์หน่วยงาน</div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <form id="form_edit" name="form_edit">
                            <div class="form-row">
								<div class="form-group col-8">
                                    <img class="img-fluid" src="<?php echo base_url('public/images/link_depart/'.$row_Re_l->l_photo);?>"/>
                                </div>
                            </div>
							<div class="form-row">
								<div class="form-group col-md-3">
                                    <label for="l_status">สถานะ</label>
                                    <select class="form-control form-control-sm" name="l_status" id="l_status">
                                        <option value="">เลือกสถานะ</option>
                                        <option value="1" <?php if($row_Re_l->l_status=="1"){ echo "selected=\"selected\""; }?>>แสดง</option>
                                        <option value="0" <?php if($row_Re_l->l_status=="0"){ echo "selected=\"selected\""; }?>>ไม่แสดง</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
									<label for="l_name">ชื่อปุ่มลิงค์หน่วยงาน </label>
                                    <input type="text" name="l_name" id="l_name" class="form-control form-control-sm" value="<?php if(!empty($row_Re_l->l_name)){echo $row_Re_l->l_name;}else{echo "";} ?>"> 
								</div>
							</div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
									<label for="l_photo">เปลี่ยนภาพปุ่มลิงค์หน่วยงาน<span class="text-danger">ขนาดภาพกว้าง 320 x 140px.</span></label>
                                    <input type="file" name="l_photo" id="l_photo" class="form-control form-control-sm"> 
                                    <input type="hidden" name="h_l_photo" id="h_l_photo" value="<?php echo $row_Re_l->l_photo;?>"> 
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<label>URL (ตัวอย่าง www.google.com)</label>
                                    <input type="text" id="l_url" name="l_url" class="form-control form-control-sm" value="<?php if(!empty($row_Re_l->l_url)){echo $row_Re_l->l_url;}else{echo "";} ?>">
								</div>
							</div>
                            <button type="submit" class="btn btn-primary btn-sm" id="btn_edit"><i class="fas fa-save"></i> บันทึกแก้ไข</button>
                            <input type="hidden" id="l_id" name="l_id" class="form-control form-control-sm" value="<?php echo $row_Re_l->l_id;?>">
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', '#btn_edit', function() {

            $('#form_edit').validate({
                rules: {
                    l_status: { required: true },
                    l_name: { required: true },
                    l_photo: { extension: "jpg|jpeg|png"},
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_edit')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Link_depart/linkdepart_edit_save"); ?>',
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
                                                location.href = '<?php echo base_url("backoffice/ปุ่มลิงค์หน่วยงาน");?>';
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
    })
</script>