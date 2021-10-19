<?php foreach ($Re['Re_usl'] as $row_Re_usl);?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/system_accesstype_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/สิทธิการใช้งาน');?>">สิทธิการใช้งาน </a>
                <i class="fas fa-caret-right"></i> แก้ไข
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header"><i class="fas fa-user-shield"></i> แก้ไขการกำหนดสิทธิการใช้งาน</div>
                    <div class="box_con_detail">
						<div class="col-12 p-4">
							<form name="form_edit" id="form_edit">
								<div class="form-row">
									<div class="form-group col-md-6 col-lg-4 col-xl-3">
										<label>ระดับผู้ใช้งาน</label>
										<input type="text"  class="form-control form-control-sm" id="usl_name" name="usl_name" value="<?php echo $row_Re_usl->usl_name; ?>">
										<input type="hidden" name="usl_id" id="usl_id" value="<?php echo $row_Re_usl->usl_id; ?>">
									</div>
								</div>
								<hr>
								<div class="row">
									<fieldset id="fieldset" style="width:580px;">
										<div class="col-12 mb-4">
											<input type="checkbox" id="btn_all_chec" value="ALL"/>&nbsp;&nbsp;เลือกทั้งหมด
										</div>
										<?php 
										foreach ($Re['Re_usa'] as $row_Re_usa){
											if($row_Re_usl->usa_num!=""){
												$a=array($row_Re_usl->usa_num);
												$b=implode(",",$a);
												$ReIN= $this->B_Accesstype_m->getACC_IN($b);
												$chk = "";
												$sum=0;
												foreach ($ReIN['Re_in'] as $row_Re_in){
													if($row_Re_usa->usa_num==$row_Re_in->usa_num){
														$chk_rule=1;
														$sum += $chk_rule;
													}else{
														$chk_rule="0";
														$sum += $chk_rule;
													}
												}
												$total = $sum;
												$sum="";
												if($total>=1){$chk = "checked";}else{$chk = "";}
											}
										?>
											<div class="col-12">
												<input type="checkbox" class="usa_num" name="usa_num[]" value="<?php echo $row_Re_usa->usa_num;?>" <?php echo $chk;?> />&nbsp;&nbsp;<?php echo $row_Re_usa->usa_name;?>
											</div>
										<?php } ?>
									</fieldset>
								</div>
								<hr>
								<p>
									<button type="submit" class="btn btn-success" id="btn_submit" name="btn_submit" >
									<i class="fas fa-save"></i> บันทึกข้อมูลแก่ไข</button>
								</p>
							</form>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function() {

		$("#btn_all_chec").click(function () {
			$(".usa_num").prop('checked', $(this).prop('checked'));
		});

		$(document).on('click', '#btn_submit', function() {
		
			$('#form_edit').validate({
				rules: {
					usl_name: { required: true },
					usl_id: { required: true },
				},
				submitHandler: function(form) {
					$.ajax({
						url: '<?php echo base_url("B_Accesstype/accesstype_edit_save");?>',
						type: 'POST',
						dataType: 'json',
						data: $('#form_edit').serialize(),
						success: function(data) {
							if(data.action=='Y'){
								$.alert({
									icon: 'fas fa-check',
									title: 'สำเร็จ',
									content: data.output,
									type: 'green',
									typeAnimated: true,
									boxWidth: '420px',
									useBootstrap: false,
									onDestroy: function() {
										location.reload();
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
										if(data.action == 'N'){
											$('#usl_name').focus();
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