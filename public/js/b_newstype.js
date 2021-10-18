$(document).ready(function() {

    if ($('#nt_type_g').is(':checked')) { $('#box_nt_detail').hide(); }

    $('#nt_type_g').change(function() {
        $('#box_nt_detail').hide();
    });

    $('#nt_type_o').change(function() {
        $('#box_nt_detail').show();
    });

    $(document).on('click', '#btn_insert', function() {
        $('#form_insert').validate({
            rules: {
                nt_status: { required: true },
                nt_name: { required: true },
            },
            errorPlacement: function(error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            submitHandler: function(form) {
                var formData = new FormData($('#form_insert')[0]);
                $.ajax({
                    url: base_url + "B_Newstype/type_insert",
                    type: 'POST',
                    dataType: "json",
                    data: formData,
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
                    },
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false
                });
            },
        });
    });

    $(document).on('click', '#btn_edit', function() {
        $('#form_edit').validate({
            rules: {
                nt_status: { required: true },
                nt_name: { required: true },
            },
            errorPlacement: function(error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            submitHandler: function(form) {
                var formData = new FormData($('#form_edit')[0]);
                $.ajax({
                    url: base_url + "B_Newstype/type_edit",
                    type: 'POST',
                    dataType: "json",
                    data: formData,
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
                    },
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false
                });
            },
        });
    });

    $(document).on('click', '#btn_dele', function() {
        var nt_id = $(this).attr('data-id');
        var nt_name = $(this).attr('data-name');

        $.confirm({
            icon: 'fas fa-trash-alt',
            title: 'ลบรายการ',
            content: 'ต้องการลบหัวข้อข่าวสาร ' + nt_name + ' หรือไม่',
            type: 'red',
            typeAnimated: true,
            boxWidth: '420px',
            useBootstrap: false,
            buttons: {
                ลบ: {
                    btnClass: 'btn-red',
                    action: function() {
                        $.ajax({
                            url: base_url + "B_Newstype/delete",
                            method: "POST",
                            dataType: "json",
                            data: { nt_id: nt_id, nt_name: nt_name },
                            success: function(data) {
                                console.log(data);
                                if (data.action == 'Y') {
                                    location.reload();
                                }
                            }
                        });
                    }
                },
                ยกเลิก: {},
            }
        });
    });

    $(document).on('click', '#btn_status', function() {
        var nt_id = $(this).attr('data-id');
        var nt_status = $(this).attr('data-status');
        $.ajax({
            url: base_url + "B_Newstype/status",
            method: "POST",
            dataType: "json",
            data: { nt_id: nt_id, nt_status: nt_status, },
            success: function(data) {
                if (data.action == 'Y') {
                    location.reload();
                }
            }
        });
    });

    $(document).on('click', '.btn_down', function() {
        var nt_id = $(this).attr('id');
        var list = $(this).attr('name');
        $.ajax({
            url: base_url + "B_Newstype/no",
            method: "POST",
            dataType: "json",
            data: { nt_id: nt_id, list: list, status: 'down' },
            success: function(data) {
                if (data.action == 'Y') {
                    location.reload();
                }
            }
        });
    });

    $(document).on('click', '.btn_up', function() {
        var nt_id = $(this).attr('id');
        var list = $(this).attr('name');
        $.ajax({
            url: base_url + "B_Newstype/no",
            method: "POST",
            dataType: "json",
            data: { nt_id: nt_id, list: list, status: 'up' },
            success: function(data) {
                if (data.action == 'Y') {
                    location.reload();
                }
            }
        });
    });

})