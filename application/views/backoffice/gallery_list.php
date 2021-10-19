<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/gallery_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> แกลเลอรี่ภาพ
                <i class="fas fa-caret-right"></i> <?php echo $depart_name; ?>
            </div>
        </div>
        <div class="row px-3 mb-1">
            <div class="col-12 p-2 bg_main rounded">
                <form id="form_serch" name="form_serch" class="form-inline p-0 m-0">
                    <div class="form-group mx-sm-3">
                        <input type="text" class="form-control" name="SH_dp_name" id="SH_dp_name" value="<?php echo $depart_name;?>" placeholder="ชื่อแกลเลอรี่ภาพ" readonly>
                        <input type="hidden" name="SH_dp_id" id="SH_dp_id" value="<?php echo $depart_id;?>" > 
                    </div>
                    <div class="form-group mx-sm-3">
                        <input type="text" class="form-control" id="SH_name" placeholder="ชื่อแกลเลอรี่ภาพ">
                    </div>
                    <button type="button" class="btn btn-sm btn-primary mx-1"><i class="fas fa-search"></i> ค้นหา</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-8"><i class="fas fa-images"></i> <?php echo $depart_name; ?></div>
                            <div class="col-4 text-right">
                                <a class="btn btn-sm btn-success" href="<?php echo base_url('backoffice/แกลเลอรี่ภาพ/'.$depart_name.'/insert')?>"><i class="fas fa-plus"></i> เพิ่มแกลเลอรี่ภาพ</a>
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <div class="table-responsive">
                            <div id="ajax_view"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        ajaxGallist(page_url = false);

        $(document).on('click', ".pagination li a", function(event) {
            var page_url = $(this).attr('href');
            ajaxGallist(page_url);
            event.preventDefault();
        });

        function ajaxGallist(page_url = false){
            var id = $('#SH_dp_id').val();
            var depart = $('#SH_dp_name').val();
            var name = $('#SH_name').val();
            var baseurl=  '<?php echo base_url("B_Gallery/gallery_list"); ?>';
            if(page_url == false) {var page_url = baseurl;}
            $.ajax({
                type: "POST",
                url: page_url,
                data: {id:id,depart:depart,name:name},
                beforeSend: function() {$('#loader').show();},
                complete: function() {$('#loader').hide();},
                success: function(data) {
                    $("#ajax_view").html(data);
                }
            });
        }

        $(document).on('click', '.btn_approve', function() {
            var gal_id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            $.confirm({
                icon: 'fas fa-info-circle',
                title: 'อนุมัติ',
                content: 'คุณค้องการอนุมัติแสดงรายการ '+name+' หรือไม่',
                type: 'blue',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    อนุมัติ: {
                        btnClass: 'btn-blue',
                        action: function() {
                            $.ajax({
                                url: '<?php echo base_url("B_Gallery/gallery_approve"); ?>',
                                method: "POST",
                                dataType: "json",
                                data: { gal_id: gal_id},
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
                                                ajaxGallist();
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

        $(document).on('click', '.btn_dele', function() {
            var gal_id = $(this).attr('data-id');
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
                                url: '<?php echo base_url("B_Gallery/gallery_delete"); ?>',
                                method: "POST",
                                dataType: "json",
                                data: { gal_id: gal_id},
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
                                                ajaxGallist();
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