<?php foreach ($Re['Re_c'] as $row_Re_c);?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/corrupt_menu.php');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> ร้องเรียนทุจริตและประพฤติมิชอบ
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/ร้องเรียนทุจริตและประพฤติมิชอบ');?>" >แจ้งเรื่อง</a>
                <i class="fas fa-caret-right"></i> ดำเนินการ
            </div>
        </div>

        <?php $this->load->view('backoffice/corrupt_detail') ;?>
    </div>
</div>
<div id="modal_box" style="display:none;"><form id="modal_box_form" name="modal_box_form"></form></div>
<script>

    $(document).ready(function() {
        $(document).on('click', '.btn_edit_action', function() {
            $('#modal_box').html('<form id="modal_box_form" name="modal_box_form"></form>');
            var id = $(this).attr('data-id');
            $.ajax({
                url: '<?php echo base_url("B_Corrupt/corrupt_success_edit"); ?>',
                method: "POST",
                data: {id:id},
                success: function (data) {
                    $('#modal_box_form').html(data);
                    $('#modal_box').dialog({
                        draggable: true,
                        closeOnEscape: true,
                        title: "แก้ไขข้อมูลการบันทึก",
                        modal: true,
                        width: 1200,
                        height: 450,
                        buttons: [
                            {
                                text: "บันทึกการแก้ไขข้อมูล",
                                id: "btn-1",
                                click: function(){ 
                                    var isValid = true;
                                    $("#modal_box_form #dp_id").each(function () {
                                        if ($(this).val() == "" && $(this).val().length < 1) {
                                            $(this).addClass('error');
                                            $(this).focus();
                                            isValid = false;
                                        } else {
                                            $(this).removeClass('error');
                                        }
                                    });
                                    if (isValid) {
                                        var formData = new FormData($('#modal_box_form')[0]);
                                        $.ajax({
                                            url: '<?php echo base_url("B_Corrupt/corrupt_success_edit_save"); ?>',
                                            type: 'POST',
                                            dataType: "json",
                                            data: formData,
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
                                                            $('#modal_box').dialog("close");
                                                            location.reload();
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
                                            async: true,
                                            cache: false,
                                            contentType: false,
                                            processData: false
                                        });
                                    }
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

        $(document).on('click', '.btn_photo_dele', function() {
            var ca_id=$(this).attr('data-id');
            var photo=$(this).attr('data-photo');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรูปภาพ',
                content: 'ต้องการลบรูปภาพที่ '+photo+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function(){
                            $.ajax({
                                url: '<?php echo base_url("B_Corrupt/corrupt_action_photo_delete"); ?>',
                                method: "POST",
                                dataType: "json",
                                beforeSend: function() {$('#loader').show();},
                                complete: function() {$('#loader').hide();},
                                data: {ca_id:ca_id,photo:photo},
                                success: function(data) {
                                    if(data.action=='Y'){
                                        $('#modal_box').dialog("close");
                                        location.reload();
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
                                }
                            }); 
                        }
                    },
                    ยกเลิก: {},
                }
            });
        });

        $(document).on('click', '.btn_dele_action', function() {
            var c_status = $(this).attr('data-status');
            var c_id = $(this).attr('data-id');
            var ca_id = $(this).attr('data-aid');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบบันทึกรายการ',
                content: 'ต้องการลบบันทึกรายการ '+c_status+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function(){
                            $.ajax({
                                url: '<?php echo base_url("B_Corrupt/corrupt_action_delete"); ?>',
                                type: 'POST',
                                dataType: "json",
                                data: {c_id:c_id,ca_id:ca_id,c_status:c_status},
                                beforeSend: function() { $('#loader').show(); },
                                complete: function() { $('#loader').hide(); },
                                success: function(data) {
                                    if(data.action=='Y'){
                                        $.alert({
                                            icon: 'fas fa-check',
                                            title: 'สำเร็จ',
                                            content: data.output,
                                            type: 'green',
                                            typeAnimated: true,
                                            boxWidth: '420px',
                                            useBootstrap: false,
                                            onDestroy: function() {
                                                location.href = '<?php echo base_url("backoffice/ร้องเรียนทุจริตและประพฤติมิชอบ/");?>'+data.status;

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
                    ยกเลิก: {},
                }
            });
        });
    });
</script>