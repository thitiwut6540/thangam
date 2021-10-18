$(document).ready(function() {

    if ($('#ns_type_g').is(':checked')) { $('#box_ns_detail').hide(); }

    $('#ns_type_g').change(function() {
        $('#box_ns_detail').hide();
    });

    $('#ns_type_o').change(function() {
        $('#box_ns_detail').show();
    });

    function ajaxs(page_url = false) {
        var baseurl = base_url + "B_News/sub_list";
        var nt_id = "<?php echo $nt_id; ?>"
        if (page_url == false) { var page_url = baseurl; }
        $.ajax({
            type: "POST",
            url: page_url,
            data: {
                nt_id: nt_id,
            },
            beforeSend: function() { $('#loader').show(); },
            complete: function() { $('#loader').hide(); },
            success: function(data) {
                $("#ajax_sub").html(data);
            }
        });
    }

    // news-type
    $(document).on('click', '#btn_sub_insert', function() {
        $('#form_insert').validate({
            rules: {
                ns_type: { required: true },
                ns_status: { required: true },
                ns_name: { required: true },
            },
            errorPlacement: function(error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            submitHandler: function(form) {
                var formData = new FormData($('#form_insert')[0]);
                $.ajax({
                    url: base_url + "B_News/sub_insert",
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

    $(document).on('click', '#btn_sub_edit', function() {
        $('#form_edit').validate({
            rules: {
                ns_type: { required: true },
                ns_status: { required: true },
                ns_name: { required: true },
            },
            errorPlacement: function(error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            submitHandler: function(form) {
                var formData = new FormData($('#form_edit')[0]);
                $.ajax({
                    url: base_url + "B_News/sub_edit",
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

    $(document).on('click', '#btn_sub_dele', function() {
        var ns_id = $(this).attr('data-id');
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
                            url: base_url + "B_News/sub_dele",
                            method: "POST",
                            dataType: "json",
                            data: { ns_id: ns_id, action: "delete" },
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

    $(document).on('click', '.btn_sub_down', function() {
        var ns_id = $(this).attr('id');
        var nt_id = $(this).attr('data-nt');
        var list = $(this).attr('name');
        $.ajax({
            url: base_url + "B_News/sub_no",
            method: "POST",
            dataType: "json",
            data: { ns_id: ns_id, nt_id: nt_id, list: list, status: 'down' },
            success: function(data) {
                if (data.action == 'Y') {
                    location.reload();
                }
            }
        });
    });

    $(document).on('click', '.btn_sub_up', function() {
        var ns_id = $(this).attr('id');
        var nt_id = $(this).attr('data-nt');
        var list = $(this).attr('name');
        $.ajax({
            url: base_url + "B_News/sub_no",
            method: "POST",
            dataType: "json",
            data: { ns_id: ns_id, nt_id: nt_id, list: list, status: 'up' },
            success: function(data) {
                if (data.action == 'Y') {
                    location.reload();
                }
            }
        });
    });


    $(document).on('click', '#btn_news_insert', function() {
        $('#form_insert').validate({
            rules: {
                n_name: { required: true },
                ns_id: { required: true },
            },
            errorPlacement: function(error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            submitHandler: function(form) {
                var formData = new FormData($('#form_insert')[0]);
                $.ajax({
                    url: base_url + "B_News/news_insert",
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

    $(document).on('click', '#btn_news_edit', function() {
        $('#form_edit').validate({
            rules: {
                n_name: { required: true },
                ns_id: { required: true },
            },
            errorPlacement: function(error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            submitHandler: function(form) {
                var formData = new FormData($('#form_edit')[0]);
                $.ajax({
                    url: base_url + "B_News/news_edit",
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

    $(document).on('click', '#btn_news_dele', function() {
        var n_id = $(this).attr('data-id');
        var n_photo = $(this).attr('data-img');
        var n_name = $(this).attr('data-name');
        $.confirm({
            icon: 'fas fa-trash-alt',
            title: 'ลบรายการ',
            content: 'ต้องการรายการข้อมูล ' + n_name + ' หรือไม่',
            type: 'red',
            typeAnimated: true,
            boxWidth: '420px',
            useBootstrap: false,
            buttons: {
                ลบ: {
                    btnClass: 'btn-red',
                    action: function() {
                        $.ajax({
                            url: base_url + "B_News/news_dele",
                            method: "POST",
                            dataType: "json",
                            data: { n_id: n_id, n_photo: n_photo, n_name: n_name, action: "delete" },
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