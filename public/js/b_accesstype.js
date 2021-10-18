$(document).ready(function() {

    $(document).on('click', '.btn_edit', function() {
        var usl_id = $(this).attr('id');
        $('#modal_errer').html("");
        $('#modal_errer').hide();
        $.ajax({
            url: base_url+"B_Accesstype/accesstype_edit_form",
            method: "POST",
            dataType: "json",
            data: { action:'edit-form',usl_id:usl_id},
            success: function(data) {
                $('#form_modal').html(data.output);
                $('#modal_box').dialog({
                    draggable: true,
                    closeOnEscape: true,
                    title: "แก้ไขข้อมูลสาขา",
                    modal: true,
                    width: 650,
                    height: 500,
                    buttons: {
                        "บันทึกแก้ไข": function() {
                            $('#action').val("edit");
                            $('#form_modal').submit();
                        },
                        "ยกเลิก": function() {
                            $('#action').val("");
                            $(this).dialog("close");
                        }
                    }
                });
            }
        }); 

        $('#form_modal').validate({
            rules: {
                usl_name: { required: true },
                usl_id: { required: true },
            },
            errorPlacement: function(error, element) {
                var name = $(element).attr("name");
                error.appendTo($("#" + name + "_validate"));
            },
            submitHandler: function(form) {
                $('#modal_errer').html("");
                $.ajax({
                    url: base_url+"B_Accesstype/accesstype_edit",
                    type: 'POST',
	                data: $('#form_modal').serialize(),
                    success: function(data) {
                        if(data=='Y'){
                            $('#modal_errer').html("");
                            $('#modal_errer').hide();
                            $('#form_modal')[0].reset();
                            $('#modal_box').dialog("close");
                            $.ajax({
                                url: base_url+"B_Accesstype/accesstype_list",
                                method: "POST",
                                dataType: "json",
                                data: { action:'list'},
                                success: function(data) {
                                    $('#ajax_view').html(data.output);
                                }
                            }); 
                        }else if(data!='Y'){
                            $('#content').animate({ scrollTop: $('#modal_error').offset().top }, 'slow');
                            $('#modal_error').html(data);
                            $("#modal_error").show().delay(5000).hide(0);
                        }
                    }
                });
            },
        });
    });

})