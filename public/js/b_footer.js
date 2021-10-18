$(document).ready(function() {

    //Logout
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

    //password edit
    $(document).on('click', '#btn_pass_edit', function() {
        $('#modal_pass_error').html('');
        $('#modal_pass_success').html('');
        $('#modal_pass_error').hide();
        $('#modal_pass_success').hide();
        var id = $(this).attr('name');
        $('#us_password_id').val(id);
        $('#modal_password_edit').dialog({
            draggable: false,
            closeOnEscape: true,
            title: "แก้ไข Password",
            modal: true,
            width: 400,
            height: 300,
            buttons: {
                "บันทึกแก้ไข": function() {
                    var isValid = true;
                    $("#us_password").each(function () {
                        if ($(this).val() == "" && $(this).val().length < 1) {
                            $(this).addClass('error');
                            $(this).focus();
                            isValid = false;
                        } else {$(this).removeClass('error');}
                    });
                    $("#us_password_new").each(function () {
                        if ($(this).val() == "" && $(this).val().length < 1) {
                            $(this).addClass('error');
                            $(this).focus();
                            isValid = false;
                        } else {$(this).removeClass('error');}
                    });
                    if (isValid) {
                        $.ajax({
                            url: base_url+"B_Password/edit",
                            method: "POST",
                            dataType: "json",
                            data: { 
                                id: id, 
                                us_password: $('#us_password').val(), 
                                us_password_new: $('#us_password_new').val(), 
                            },
                            success: function(data) {
                                if (data.action == 'Y') {
                                    $('#modal_pass_error').html('');
                                    $('#modal_pass_error').hide();
                                    $('#modal_pass_success').html(data.output);
                                    $('#modal_pass_success').show();
                                    $('#us_password').val('');
                                    $('#us_password_new').val('');
                                }else if (data.action == 'N') {
                                    $('#modal_pass_error').html(data.output);
                                    $('#modal_pass_error').show();
                                    $('#modal_pass_success').html('');
                                    $('#modal_pass_success').hide();
                                }
                            }
                        });
                    }
                },
                "ปิด": function() {
                    $(this).dialog("close");
                }
            }
        });
    });

    //checkTimer login
//     function checkTimer() {       
//         var timeout= "<?php echo $_SESSION['SS_TS_login_TimeOut']; ?>";
//         if(timeout==''){timeout=0;}
//         var t;
//         window.onload = resetTimer;
//         window.onmousemove = resetTimer;
//         window.onmousedown = resetTimer;
//         window.onkeypress = resetTimer;
//         window.onclick = resetTimer;
//         window.onscroll = resetTimer;

//         function logout() {
//             $.ajax({
//                 url: "<?php echo base_url('Logout/timeout');?>",
//                 method: "POST",
//                 data: { action: "logout"},
//                 success: function(data) {
//                     if(data=="Y"){
//                         alert('ระบบ Logout อัตโนมัติ กรุณา Login เข้าสู่ระบบใหม่');
//                         document.location.href = "<?php echo base_url('Login');?>";
//                     }
//                 }
//             }); 
//         }
        
//         function resetTimer() {
//             clearTimeout(t);
//             t = setTimeout(logout, timeout);
//         }
//     }
//     checkTimer();
});