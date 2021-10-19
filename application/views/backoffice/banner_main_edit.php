<?php foreach ($Re['Re_b'] as $row_Re_b);?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/banner_main_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/สไลด์โชว์');?>" >สไลด์โชว์</a> 
                <i class="fas fa-caret-right"></i> แก้ไขสไลด์โชว์
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12"><i class="far fa-images"></i> แก้ไขสไลด์โชว์</div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <form id="form_edit" name="form_edit">
                            <div class="form-row">
								<div class="form-group col-md-8">
                                    <img class="img-fluid" src="<?php echo base_url('public/images/banner/'.$row_Re_b->ban_photo);?>"/>
                                </div>
                            </div>
							<div class="form-row">
								<div class="form-group col-md-3">
                                    <label for="ban_status">สถานะ</label>
                                    <select class="form-control form-control-sm" name="ban_status" id="ban_status">
                                        <option value="">เลือกสถานะ</option>
                                        <option value="1" <?php if($row_Re_b->ban_status=="1"){ echo "selected=\"selected\""; }?>>แสดง</option>
                                        <option value="0" <?php if($row_Re_b->ban_status=="0"){ echo "selected=\"selected\""; }?>>ไม่แสดง</option>
                                    </select>
                                </div>
                            </div>
							<div class="form-row">
								<div class="form-group col-12">
									<label for="admin_user">URL (ตัวอย่าง www.google.com)</label>
                                    <input type="text" id="ban_url" name="ban_url" class="form-control form-control-sm" value="<?php echo $row_Re_b->ban_url;?>">
								</div>
							</div>
                            <button type="submit" class="btn btn-primary btn-sm" id="btn_edit"><i class="fas fa-save"></i> บันทึกแก้ไข</button>
                            <input type="hidden" id="ban_id" name="ban_id" value="<?php echo $row_Re_b->ban_id;?>">
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
                    ban_status: { required: true },
                    ban_photo: { required: true ,extension: "jpg|jpeg|png"},
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_edit')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Banner_main/banner_edit_save"); ?>',
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
                                                location.href = '<?php echo base_url("backoffice/สไลด์โชว์");?>';
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