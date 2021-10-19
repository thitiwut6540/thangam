<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/landmark_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> ประเภทสถานที่สำคัญ
                <i class="fas fa-caret-right"></i> รายการประเภทสถานที่สำคัญ
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-8"><i class="fas fa-map-marker-alt"></i> รายการประเภทสถานที่สำคัญ</div>
                            <div class="col-4 text-right">
                                <button class="btn btn-sm btn-success" id="btn_type_insert"><i class="fas fa-plus"></i> เพิ่มประเภท</button>
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <div id="ajax_view"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal_box" style="display:none;"><form id="modal_box_form" name="modal_box_form"></form></div>
<script>
    $(document).ready(function() {
        ajaxList();
        function ajaxList(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url("B_Landmark/type_list"); ?>',
                beforeSend: function() {$('#loader').show();},
                complete: function() {$('#loader').hide();},
                success: function(data) {
                    $("#ajax_view").html(data);
                }
            });
        }

        $(document).on('click', '.btn_type_dele', function() {
            var land_t_id  = $(this).attr('data-id');
            var name  = $(this).attr('data-name');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรายการ',
                content: 'ต้องการลบ '+name+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: '<?php echo base_url("B_Landmark/type_delete"); ?>',
                                method: "POST",
                                dataType: "json",
                                data: {land_t_id : land_t_id },
                                success: function(data) {
                                    if (data.action == 'Y') {
                                        ajaxList()
                                    }
                                }
                            });
                        }
                    },
                    ยกเลิก: {},
                }
            });
        });

        $(document).on('click', '.btn_down', function() {
            var land_t_id  = $(this).attr('data-id');
            var list = $(this).attr('data-no');
            $.ajax({
                url: '<?php echo base_url("B_Landmark/type_no"); ?>',
                method: "POST",
                dataType: "json",
                data: { land_t_id : land_t_id , list: list, status: 'down'},
                success: function(data) {
                    if (data.action == 'Y') {
                        ajaxList()
                    }
                }
            });
        });

        $(document).on('click', '.btn_up', function() {
            var land_t_id  = $(this).attr('data-id');
            var list = $(this).attr('data-no');
            $.ajax({
                url: '<?php echo base_url("B_Landmark/type_no"); ?>',
                method: "POST",
                dataType: "json",
                data: { land_t_id : land_t_id , list: list, status: 'up'},
                success: function(data) {
                    if (data.action == 'Y') {
                        ajaxList()
                    }
                }
            });
        });


        $(document).on('click', '#btn_type_insert', function() {
            $('#modal_box').html('<form id="modal_box_form" name="modal_box_form"></form>');
            $.ajax({
                url: '<?php echo base_url("B_Landmark/type_insert_form"); ?>',
                method: "POST",
                success: function (data) {
                    $('#modal_box_form').html(data);
                    $('#modal_box').dialog({
                        draggable: true,
                        closeOnEscape: true,
                        title: "เพิ่มประเภทสถานที่สำคัญ",
                        modal: true,
                        width: 600,
                        height: 250,
                        buttons: [
                            {
                                text: "บันทึก",
                                id: "btn-1",
                                click: function(){ 
                                    $.ajax({
                                        url: '<?php echo base_url("B_Landmark/type_insert_save"); ?>',
                                        type: 'POST',
                                        dataType: "json",
                                        data: {land_t_name:$('#land_t_name').val()},
                                        beforeSend: function() { $('#loader').show(); },
                                        complete: function() { $('#loader').hide(); },
                                        success: function(data) {
                                            if(data.action=='Y'){
                                                $('#modal_box').dialog("close");
                                                $.alert({
                                                    icon: 'fas fa-check',
                                                    title: 'สำเร็จ',
                                                    content: data.output,
                                                    type: 'green',
                                                    typeAnimated: true,
                                                    boxWidth: '420px',
                                                    useBootstrap: false,
                                                    onDestroy: function() {
                                                        ajaxList();
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
                                                });
                                            }
                                        },
                                    });
                                }
                            }, 
                            {
                                text: "ปิด",
                                id: "btn-2",
                                click: function(){            
                                    $('#modal_box').dialog("close");
                                }
                            }  
                        ]
                    });
                }
            });
        });

        $(document).on('click', '.btn_type_edit', function() {
            $('#modal_box').html('<form id="modal_box_form" name="modal_box_form"></form>');
            var land_t_id = $(this).attr('data-id');
            $.ajax({
                url: '<?php echo base_url("B_Landmark/type_edit_form"); ?>',
                method: "POST",
                data: {land_t_id: land_t_id},
                success: function (data) {
                    $('#modal_box_form').html(data);
                    $('#modal_box').dialog({
                        draggable: true,
                        closeOnEscape: true,
                        title: "แก้ไขประเภทสถานที่สำคัญ",
                        modal: true,
                        width: 600,
                        height: 250,
                        buttons: [
                            {
                                text: "บันทึก",
                                id: "btn-1",
                                click: function(){ 
                                    $.ajax({
                                        url: '<?php echo base_url("B_Landmark/type_edit_save"); ?>',
                                        type: 'POST',
                                        dataType: "json",
                                        data: {land_t_id:$('#land_t_id').val(),land_t_name:$('#land_t_name').val()},
                                        beforeSend: function() { $('#loader').show(); },
                                        complete: function() { $('#loader').hide(); },
                                        success: function(data) {
                                            if(data.action=='Y'){
                                                $('#modal_box').dialog("close");
                                                $.alert({
                                                    icon: 'fas fa-check',
                                                    title: 'สำเร็จ',
                                                    content: data.output,
                                                    type: 'green',
                                                    typeAnimated: true,
                                                    boxWidth: '420px',
                                                    useBootstrap: false,
                                                    onDestroy: function() {
                                                        ajaxList();
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
                                                });
                                            }
                                        },
                                    });
                                }
                            }, 
                            {
                                text: "ปิด",
                                id: "btn-2",
                                click: function(){            
                                    $('#modal_box').dialog("close");
                                }
                            }  
                        ]
                    });
                }
            });
        });

    })
</script>