$(document).ready(function() {

    // news-type
    $(document).on('click', '#btn_st_insert', function() {
        $('#form_insert').validate({
            rules: {
                st_status: { required: true },
                st_name: { required: true },
            },
            errorPlacement: function(error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            submitHandler: function(form) {
                var formData = new FormData($('#form_insert')[0]);
                $.ajax({
                    url: base_url + "B_Site/topic_insert",
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

    $(document).on('click', '#btn_st_edit', function() {
        $('#form_edit').validate({
            rules: {
                st_status: { required: true },
                st_name: { required: true },
            },
            errorPlacement: function(error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            submitHandler: function(form) {
                var formData = new FormData($('#form_edit')[0]);
                $.ajax({
                    url: base_url + "B_Site/topic_edit",
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

    $(document).on('click', '#btn_st_dele', function() {
        var st_id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $.confirm({
            icon: 'fas fa-trash-alt',
            title: 'ลบรายการ',
            content: 'ต้องการลบเมนูย่อย ' + name + ' หรือไม่',
            type: 'red',
            typeAnimated: true,
            boxWidth: '420px',
            useBootstrap: false,
            buttons: {
                ลบ: {
                    btnClass: 'btn-red',
                    action: function() {
                        $.ajax({
                            url: base_url + "B_Site/topic_dele",
                            method: "POST",
                            dataType: "json",
                            data: { st_id: st_id, action: "delete" },
                            success: function(data) {
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

    $(document).on('click', '.btn_st_down', function() {
        var st_id = $(this).attr('id');
        var list = $(this).attr('name');
        $.ajax({
            url: base_url + "B_Site/topic_no",
            method: "POST",
            dataType: "json",
            data: { st_id: st_id, list: list, status: 'down' },
            success: function(data) {
                if (data.action == 'Y') {
                    location.reload();
                }
            }
        });
    });

    $(document).on('click', '.btn_st_up', function() {
        var st_id = $(this).attr('id');
        var list = $(this).attr('name');
        $.ajax({
            url: base_url + "B_Site/topic_no",
            method: "POST",
            dataType: "json",
            data: { st_id: st_id, list: list, status: 'up' },
            success: function(data) {
                if (data.action == 'Y') {
                    location.reload();
                }
            }
        });
    });


    $(document).on('click', '#btn_s_insert', function() {
        $('#form_insert').validate({
            rules: {
                st_id: { required: true },
                s_name: { required: true },
            },
            errorPlacement: function(error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            submitHandler: function(form) {
                var formData = new FormData($('#form_insert')[0]);
                $.ajax({
                    url: base_url + "B_Site/site_insert",
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

    $(document).on('click', '#btn_s_edit', function() {
        $('#form_edit').validate({
            rules: {
                st_id: { required: true },
                s_name: { required: true },
            },
            errorPlacement: function(error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            submitHandler: function(form) {
                var formData = new FormData($('#form_edit')[0]);
                $.ajax({
                    url: base_url + "B_Site/site_edit",
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

    $(document).on('click', '#btn_s_dele', function() {
        var s_id = $(this).attr('data-id');
        var s_name = $(this).attr('data-name');
        $.confirm({
            icon: 'fas fa-trash-alt',
            title: 'ลบรายการ',
            content: 'ต้องการรายการข้อมูล ' + s_name + ' หรือไม่',
            type: 'red',
            typeAnimated: true,
            boxWidth: '420px',
            useBootstrap: false,
            buttons: {
                ลบ: {
                    btnClass: 'btn-red',
                    action: function() {
                        $.ajax({
                            url: base_url + "B_Site/site_dele",
                            method: "POST",
                            dataType: "json",
                            data: { s_id: s_id, s_name: s_name, action: "delete" },
                            success: function(data) {
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

})