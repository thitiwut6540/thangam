$(document).ready(function() {

    $(document).on('click', '.btn_dele', function() {
        var us_id = $(this).attr('id');
        var us_name = $(this).val();

        $.confirm({
            icon: 'fas fa-trash-alt',
            title: 'ลบรายการ',
            content: 'ต้องการลบผู้ใช้งานระบบ ' + us_name + ' หรือไม่',
            type: 'red',
            typeAnimated: true,
            boxWidth: '420px',
            useBootstrap: false,
            buttons: {
                ลบ: {
                    btnClass: 'btn-red',
                    action: function() {
                        $.ajax({
                            url: base_url + "B_User/delete",
                            method: "POST",
                            dataType: "json",
                            data: { us_id: us_id, us_name: us_name, action: "delete" },
                            success: function(data) {
                                location.reload();
                            }
                        });
                    }
                },
                ยกเลิก: {},
            }
        });
    });

    $(document).on("change", "input[type='checkbox']", function() {
        var checkbox_val = (this.checked) ? 'Y' : 'N';
        $(this).siblings('input.checkbox_handler').val(checkbox_val);
    });

    $(document).on('change', '#usl_id', function() {
        var usl_id = $(this).val();
        $.ajax({
            url: base_url + "B_User/page_usa",
            method: "POST",
            data: { usl_id: usl_id, },
            success: function(data) {
                $('#ajax_view').html(data);
            }
        });
    });

    $(document).on('click', '#btn_insert_submit', function() {
        $('#modal_error').html("");
        $('#modal_error').hide();
        $('#modal_success').html("");
        $('#modal_success').hide();
        $('#form_insert').validate({
            rules: {
                us_status: { required: true },
                us_action: { required: true },
                usl_id: { required: true },
                us_name: { required: true },
                dp_id: { required: true },
                us_user: { required: true },
                us_pass: { required: true },
            },
            errorPlacement: function(error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            submitHandler: function(form) {
                $.ajax({
                    url: base_url + "B_User/insert_save",
                    type: 'POST',
                    dataType: "json",
                    data: $('#form_insert').serialize(),
                    beforeSend: function() { $('#loader').show(); },
                    complete: function() { $('#loader').hide(); },
                    success: function(data) {
                        if (data.action == 'Y') {
                            // console.log(data);
                            $('#content').animate({ scrollTop: $('#modal_success').offset().top }, 'slow');
                            $('#modal_success').html(data.output);
                            $("#modal_success").show().delay(5000).hide(0);
                            $('#modal_error').html("");
                            $('#modal_error').hide();
                            $('#form_insert')[0].reset();
                        } else if (data.action == 'D') {
                            $('#content').animate({ scrollTop: $('#modal_error').offset().top }, 'slow');
                            $('#modal_error').html(data.output);
                            $("#modal_error").show().delay(5000).hide(0);
                            $('#modal_success').html("");
                            $('#modal_success').hide();
                            $('#us_user').focus();
                        } else {
                            $('#content').animate({ scrollTop: $('#modal_error').offset().top }, 'slow');
                            $('#modal_error').html(data.output);
                            $("#modal_error").show().delay(5000).hide(0);
                            $('#modal_success').html("");
                            $('#modal_success').hide();
                            $('#us_status').focus();
                        }
                    }
                });
            },
        });
    });

    $(document).on('click', '#btn_edit_submit', function() {
        $('#modal_error').html("");
        $('#modal_error').hide();
        $('#modal_success').html("");
        $('#modal_success').hide();
        $('#form_edit').validate({
            rules: {
                us_status: { required: true },
                us_action: { required: true },
                usl_id: { required: true },
                dp_id: { required: true },
                us_name: { required: true },
                us_user: { required: true },
            },
            errorPlacement: function(error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            submitHandler: function(form) {
                $.ajax({
                    url: base_url + "B_User/edit_save",
                    type: 'POST',
                    dataType: "json",
                    data: $('#form_edit').serialize(),
                    beforeSend: function() { $('#loader').show(); },
                    complete: function() { $('#loader').hide(); },
                    success: function(data) {
                        //console.log(data);
                        if (data.action == 'Y') {
                            $('#content').animate({ scrollTop: $('#modal_success').offset().top }, 'slow');
                            $('#modal_success').html(data.output);
                            $("#modal_success").show().delay(5000).hide(0);
                            $('#modal_error').html("");
                            $('#modal_error').hide();
                            $('#us_status').focus();
                        } else if (data.action == 'D') {
                            $('#content').animate({ scrollTop: $('#modal_error').offset().top }, 'slow');
                            $('#modal_error').html(data.output);
                            $("#modal_error").show().delay(5000).hide(0);
                            $('#modal_success').html("");
                            $('#modal_success').hide();
                            $('#us_user').focus();
                        } else {
                            $('#content').animate({ scrollTop: $('#modal_error').offset().top }, 'slow');
                            $('#modal_error').html(data.output);
                            $("#modal_error").show().delay(5000).hide(0);
                            $('#modal_success').html("");
                            $('#modal_success').hide();
                            $('#us_status').focus();
                        }
                    }
                });
            },
        });
    });

})