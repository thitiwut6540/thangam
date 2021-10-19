<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/lpa_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> แบบประเมินประสิทธิภาพขององค์กรปกครองส่วนท้องถิ่น (LPA)
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                        <div class="box_con_header">
                            <div class="row">
                                <div class="col-8"><i class="far fa-file-pdf"></i> LPA</div>
                                <div class="col-4 text-right"><button class="btn btn-sm btn-success" id="btn_new"><i class="fas fa-plus"></i> เพิ่มรายการใหม่</button></div>
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

        ajaxList(page_url = false)
        function ajaxList(page_url = false){
            var baseurl = '<?php echo base_url("B_Lpa/lpa_list"); ?>';
            if(page_url == false) {var page_url = baseurl;}
            $.ajax({
                method: "POST",
                url: page_url,
                data: $('#form_SH').serialize(),
                beforeSend: function() {$('#loader').show();},
                complete: function() {$('#loader').hide();},
                success: function(data) {
                    $("#ajax_view").html(data);
                }
            });
        }

        $(document).on('click', ".pagination li a", function(event) {
            var page_url = $(this).attr('href');
            ajaxList(page_url);
            event.preventDefault();
        });

        $(document).on('click', '#btn_new', function() {
            $('#modal_box').html('<form id="modal_box_form" name="modal_box_form"></form>');
            $.ajax({
                url: '<?php echo base_url("B_Lpa/lpa_insert_form"); ?>',
                method: "POST",
                success: function (data) {
                    $('#modal_box_form').html(data);
                    $('#modal_box').dialog({
                        draggable: true,
                        closeOnEscape: true,
                        title: "เพิ่มประเภทข่าวสาร",
                        modal: true,
                        width: 600,
                        height: 350,
                        buttons: [
                            {
                                text: "บันทึก",
                                id: "btn-1",
                                click: function(){ 
                                    var formData = new FormData($('#modal_box_form')[0]);
                                    $.ajax({
                                        url: '<?php echo base_url("B_Lpa/lpa_insert_save"); ?>',
                                        type: 'POST',
                                        dataType: "json",
                                        data: formData,
                                        beforeSend: function() { $('#loader').show(); },
                                        complete: function() { $('#loader').hide(); },
                                        success: function(data) {
                                            console.log(data);
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
                                        async: true,
                                        cache: false,
                                        contentType: false,
                                        processData: false
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

        $(document).on('click', '.btn_dele', function() {
            var lpa_id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
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
                                url: '<?php echo base_url("B_Lpa/lpa_delete"); ?>',
                                method: "POST",
                                dataType: "json",
                                data: { lpa_id: lpa_id},
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
                                }
                            });
                        }
                    },
                    ยกเลิก: {},
                }
            });
        });

    });
</script>