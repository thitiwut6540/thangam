$(document).ready(function() {

    $(document).on('click', '#btn_dele', function() {
        var us_id = $(this).attr('data-id');
        var us_name = $(this).attr('data-user');

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
                            url: base_url + "B_User/user_delete",
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

    $(document).on('click', '#btn_insert', function() {
        $('#form_insert').validate({
            rules: {
                us_status: { required: true },
                us_name: { required: true },
                us_user: { required: true },
                us_pass: { required: true },
            },
            errorPlacement: function(error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            submitHandler: function(form) {
                $.ajax({
                    url: base_url + "B_User/user_insert",
                    type: 'POST',
                    dataType: "json",
                    data: $('#form_insert').serialize(),
                    beforeSend: function() { $('#loader').show(); },
                    complete: function() { $('#loader').hide(); },
                    success: function(data) {
                        if (data.action == 'Y') {
                            $.alert({
                                icon: 'fas fa-exclamation-triangle',
                                title: 'แจ้งเตือน',
                                content: data.output,
                                type: 'green',
                                typeAnimated: true,
                                boxWidth: '420px',
                                useBootstrap: false,
                                buttons: {
                                    ตกลง: {
                                        btnClass: 'btn-green',
                                        action: function() {
                                            location.reload();
                                        }
                                    },
                                    ยกเลิก: {},
                                }
                            });
                        } else {
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
                    }
                });
            },
        });
    });

    $(document).on('click', '#btn_edit', function() {
        $('#form_edit').validate({
            rules: {
                us_status: { required: true },
                us_name: { required: true },
                us_user: { required: true },
            },
            errorPlacement: function(error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            submitHandler: function(form) {
                $.ajax({
                    url: base_url + "B_User/user_edit",
                    type: 'POST',
                    dataType: "json",
                    data: $('#form_edit').serialize(),
                    beforeSend: function() { $('#loader').show(); },
                    complete: function() { $('#loader').hide(); },
                    success: function(data) {
                        if (data.action == 'Y') {
                            $.alert({
                                icon: 'fas fa-exclamation-triangle',
                                title: 'แจ้งเตือน',
                                content: data.output,
                                type: 'green',
                                typeAnimated: true,
                                boxWidth: '420px',
                                useBootstrap: false,
                                buttons: {
                                    ตกลง: {
                                        btnClass: 'btn-green',
                                        action: function() {
                                            location.reload();
                                        }
                                    },
                                    ยกเลิก: {},
                                }
                            });
                        } else {
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
                    }
                });
            },
        });
    });

    $(document).on('click', '#btn_status', function() {
        var us_id = $(this).attr('data-id');
        var us_status = $(this).attr('data-status');
        $.ajax({
            url: base_url + "B_User/status",
            method: "POST",
            dataType: "json",
            data: { us_id: us_id, us_status: us_status, },
            success: function(data) {
                if (data.action == 'Y') {
                    location.reload();
                }
            }
        });
    });

})