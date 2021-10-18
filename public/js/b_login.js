$(document).ready(function() {
    $("#login_error").html('');
    $("#login_error").hide();
    $('#form_login').validate({
        rules: {
            username: { required: true },
            password: { required: true }
        },
        errorPlacement: function(error, element) {
            var name = $(element).attr("name");
            error.appendTo($("#" + name + "_validate"));
        },
        submitHandler: function(form) {
            $.ajax({
                url: base_url + "Backoffice/login",
                method: "POST",
                data: {
                    username: $("#username").val(),
                    password: $("#password").val()
                },
                beforeSend: function() { $('#loader').show(); },
                complete: function() { $('#loader').hide(); },
                success: function(data) {
                    console.log(data);
                    if (data == 'Y') {
                        $("#login_error").html('');
                        $("#login_error").hide();
                        window.location.replace(base_url + "Backoffice/dashboard");
                    } else if (data == 'N') {
                        $("#login_error").html('<i class="fas fa-exclamation-triangle"></i> ไม่สามารถเข้าสู่ระบบได้');
                        $("#login_error").show();
                    }
                }
            });
        }
    });
})