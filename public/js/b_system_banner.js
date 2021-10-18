$(document).ready(function() {

    $(document).on('click', '#btn_insert', function() {
        $('#form_insert').validate({
            rules: {
                ban_status: { required: true },
                ban_photo: { required: true },
            },
            errorPlacement: function(error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            submitHandler: function(form) {
                var formData = new FormData($('#form_insert')[0]);
                $.ajax({
                    url: base_url + "B_Banner/insert",
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
                ban_status: { required: true },
            },
            errorPlacement: function(error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            submitHandler: function(form) {
                var formData = new FormData($('#form_edit')[0]);
                $.ajax({
                    url: base_url + "B_Banner/edit",
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
        var ban_id = $(this).attr('data-id');
        var ban_photo = $(this).val();

        $.confirm({
            icon: 'fas fa-trash-alt',
            title: 'ลบรายการ',
            content: 'ต้องการลบภาพสไลด์โชว์นี้หรือไม่',
            type: 'red',
            typeAnimated: true,
            boxWidth: '420px',
            useBootstrap: false,
            buttons: {
                ลบ: {
                    btnClass: 'btn-red',
                    action: function() {
                        $.ajax({
                            url: base_url + "B_Banner/delete",
                            method: "POST",
                            dataType: "json",
                            data: { ban_id: ban_id, ban_photo: ban_photo, action: "delete" },
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
        var ban_id = $(this).attr('data-id');
        var ban_status = $(this).val();
        $.ajax({
            url: base_url + "B_Banner/status",
            method: "POST",
            dataType: "json",
            data: { ban_id: ban_id, ban_status: ban_status, },
            success: function(data) {
                if (data.action == 'Y') {
                    location.reload();
                }
            }
        });
    });

    $(document).on('click', '.btn_down', function() {
        var ban_id = $(this).attr('id');
        var list = $(this).attr('name');
        $.ajax({
            url: base_url + "B_Banner/no",
            method: "POST",
            dataType: "json",
            data: { ban_id: ban_id, list: list, status: 'down' },
            success: function(data) {
                if (data.action == 'Y') {
                    location.reload();
                }
            }
        });
    });

    $(document).on('click', '.btn_up', function() {
        var ban_id = $(this).attr('id');
        var list = $(this).attr('name');
        $.ajax({
            url: base_url + "B_Banner/no",
            method: "POST",
            dataType: "json",
            data: { ban_id: ban_id, list: list, status: 'up' },
            success: function(data) {
                if (data.action == 'Y') {
                    location.reload();
                }
            }
        });
    });

})