<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo ANW_N1;?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('public/images/logo/favicon.ico');?>">
    <script type="text/javascript" src="<?php echo base_url('public/library/jquery-3.6.0.min.js');?>"></script>
    <link href="<?php echo base_url('public/library/bootstrap-4.3.1/dist/css/bootstrap.css');?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/library/fontawesome5011//web-fonts-with-css/css/fontawesome-all.css');?>">
    <script src="<?php echo base_url('public/library/bootstrap-4.3.1/dist/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/library/jquery-validation-1.19.3/dist/jquery.validate.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/library/jquery-validation-1.19.3/dist/localization/messages_th.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/library/jquery-validation-1.19.3/dist/additional-methods.min.js');?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('public/library/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css');?>">
    <script src="<?php echo base_url('public/library/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js');?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/library/jquery-ui-1.12.1/jquery-ui.css');?>" >
    <script type="text/javascript" src="<?php echo base_url('public/library/jquery-ui-1.12.1/jquery-ui.min.js');?>"></script>
    <script src="<?php echo base_url('public/library/datepicker/jquery-ui-datepicker-th.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/library/printThis/printThis.js');?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/library/kindeditor/themes/default/default.css');?>">
    <script src="<?php echo base_url('public/library/kindeditor/kindeditor-all.js');?>"></script>
    <script src="<?php echo base_url('public/library/CKEditor/ckeditor.js');?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/utilitie.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/backoffice.css');?>">
    <script>var base_url = "<?php echo base_url(); ?>";</script>
    <script>
    $(document).ready(function(){
        $('#group_menu').carousel({
            pause: true,
            interval: false
        })
        $("#menu-toggle").click(function(e) {
            $("#panel").toggleClass("toggled");
            $("#content").toggleClass("toggled");
        });

        $(document).on('click', '#btn_logout', function() {
            var us_name = $(this).attr('name');
            $.confirm({
                icon: 'fas fa-power-off',
                title: 'Logout',
                content: 'คุณ '+us_name+' ต้องการออกจากระบบหรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ออกจากระบบ: {
                        btnClass: 'btn-red',
                        action: function(){
                            window.location.replace(base_url+"B_Logout");
                        }
                    },
                    ยกเลิก: {},
                }
            });
        });

        $(document).on('click', '#btn_pass_edit', function() {
            $('#e_us_password').val('');
            $('#e_us_password_new').val('');
            $('#modal_password_edit').dialog({
                draggable: false,
                closeOnEscape: true,
                title: "แก้ไข Password",
                modal: true,
                width: 450,
                height: 350,
                buttons: {
                    "บันทึกแก้ไข": function() {
                        $("#form_password_edit").submit();
                    },
                    "ปิด": function() {
                        $(this).dialog("close");
                        $('#e_us_password').val('');
                        $('#e_us_password_new').val('');
                    }
                }
            });


            $('#form_password_edit').validate({
                rules: {
                    e_us_password: { required: true },
                    e_us_password_new: { required: true }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: "<?php echo base_url('B_Password');?> ",
                        method: "POST",
                        dataType: "json",
                        data: $('#form_password_edit').serialize(),
                        beforeSend: function() {$('#loader').show();},
                        complete: function() {$('#loader').hide();},
                        success: function(data) {
                            console.log(data);
                            if(data.action=='Y'){
                                $('#modal_password_edit').dialog("close");
                                $.alert({
                                    icon: 'fas fa-check',
                                    title: 'สำเร็จ',
                                    content: data.output,
                                    type: 'green',
                                    typeAnimated: true,
                                    boxWidth: '420px',
                                    useBootstrap: false,
                                    onDestroy: function() {
                                        location.href = '<?php echo base_url("B_Logout");?>';
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
                                        if(data.action == 'P'){
                                            $('#e_us_password_new').focus();
                                        }else {
                                            $('#e_us_password').focus();
                                        }
                                    }
                                });
                            }
                            
                        }
                    });
                }
            });
        });
    }); 
    </script>
</head>
<body>