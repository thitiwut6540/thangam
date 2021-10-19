<div class="container-fluid">
	<div class="row h-100 bg_main_light">
		<div class="col-10 col-md-6 col-lg-6 col-xl-5 mx-auto my-auto bg_white shadow rounded">
			<div class="row login_bg">
				<div class="col-12 col-md-3 col-lg-5 p-4 my-auto text-center">
					<img class="img-fluid" src="<?php echo base_url('public/images/logo/logo_login.png');?>">
				</div>
				<div class="col-12 col-md-9 col-lg-7 p-0 bg-white">
					<form name="form_login" id="form_login">
						<div class="row m-0 p-2 py-5 p-lg-2 p-xl-2">
							<div class="col-12 text-center mb-4">
                                <div class="login_tx_title">
                                    <?php echo ANW_N1;?><br>
                                    <h1><?php echo ANW_N2;?></h1>
                                </div>
                            </div>
							<div class="col-12 mb-3">
								<label><i class="fas fa-user"></i> Username</label><br>
								<input type="text" class="form-control form-control-sm" name="username" id="username" class="" autofocus="autofocus">
							</div>
							<div class="col-12 mb-4">
								<label><i class="fas fa-lock"></i> Password</label><br>
								<input type="password" class="form-control form-control-sm" name="password" id="password" class="">
							</div>
							<div class="col-12">
								<input type="submit" id="submit" name="submit" class="btn btn-secondary w-100" value="เข้าสู่ระบบ">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
    $(document).ready(function() {
        $('#form_login').validate({
            rules: {
                username: { required: true },
                password: { required: true }
            },
            errorPlacement: function(error,element) {return true;},
            submitHandler: function(form) {
                $.ajax({
                    url: "<?php echo base_url('backoffice/login_check');?> ",
                    method: "POST",
					dataType: "json",
                    data: {
                        username: $("#username").val(),
                        password: $("#password").val()
                    },
                    beforeSend: function() {$('#loader').show();},
                    complete: function() {$('#loader').hide();},
                    success: function(data) {
                        if(data.action=='Y'){
							location.href = '<?php echo base_url("backoffice");?>';
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
									if(data.action == 'P'){
										$('#password').focus();
									}else {
										$('#username').focus();
									}
								}
							});
						}
                        
                    }
                });
            }
        });
    })
</script>