<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/banner_top_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">backoffice</span></a>
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/ภาพประกาศ');?>" >ภาพประกาศ </a>
                <i class="fas fa-caret-right"></i> เพิ่มภาพประกาศ 
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12"><i class="fas fa-bullhorn"></i> เพิ่มภาพประกาศ </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <form id="form_insert" name="form_insert">
							<div class="form-row">
								<div class="form-group col-md-3">
                                    <label for="ban_status">สถานะ</label>
                                    <select class="form-control form-control-sm" name="ban_status" id="ban_status">
                                        <option value="">เลือกสถานะ</option>
                                        <option value="1">แสดง</option>
                                        <option value="0">ไม่แสดง</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
									<label for="ban_name">ชื่อภาพประกาศ  </label>
                                    <input type="text" name="ban_name" id="ban_name" class="form-control form-control-sm"> 
								</div>
							</div>
							<div class="form-row">
                                <div class="form-group col-md-6">
									<label for="ban_photo">ภาพประกาศ <span class="text-danger">ขนาดภาพกว้างไม่เกิน 1300 px.</span></label>
                                    <input type="file" name="ban_photo" id="ban_photo" class="form-control form-control-sm"> 
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
									<label for="admin_user">URL (ตัวอย่าง www.google.com)</label>
                                    <input type="text" id="ban_url" name="ban_url" class="form-control form-control-sm">
								</div>
							</div>
							<button type="submit" class="btn btn-primary btn-sm" id="btn_insert"><i class="fas fa-save"></i> บันทึก</button>
							<input type="hidden" id="action" name="action" value="l-depart-insert">
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', '#btn_insert', function() {
            $('#form_insert').validate({
                rules: {
                    ban_status: { required: true },
                    // ban_name: { required: true },
                    ban_photo: { required: true,extension: "jpg|jpeg|png" },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_insert')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Banner_top/banner_insert_save"); ?>',
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
                                                location.href = '<?php echo base_url("backoffice/ภาพประกาศ");?>';
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
    })
</script>