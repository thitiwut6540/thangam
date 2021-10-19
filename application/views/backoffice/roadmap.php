<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/roadmap_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> แผนงาน
                <i class="fas fa-caret-right"></i> <?php echo $type;?>
            </div>
        </div>

        <div class="row px-3 mb-1">
            <div class="col-12 p-2 bg_main rounded">
                <form id="form_SH" name="form_SH" class="form-inline p-0 m-0">
                    <div class="form-group mx-sm-3">
                        <input type="text" class="form-control form-control-sm" name="SH_type_name" id="SH_type_name" value="<?php echo $type;?>" readonly>
                        <input type="hidden" name="SH_type_id" id="SH_type_id" value="<?php echo $type_id;?>" > 
                    </div>
                    <div class="form-group mx-sm-3">
                        <input type="text" class="form-control form-control-sm" id="SH_name" placeholder="ใส่หัวข้อเรื่องที่ค้นหา">
                    </div>
                    <button type="button" id="btn_SH" class="btn btn-sm btn-primary mx-1"><i class="fas fa-search"></i> ค้นหา</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-8"><i class="far fa-paper-plane"></i> <?php echo $type; ?></div>
                            <div class="col-4 text-right"><a class="btn btn-sm btn-success" href="<?php echo base_url('backoffice/แผนงาน/'.$type.'/insert');?>"><i class="fas fa-plus"></i> เพิ่ม<?php echo $type;?></a></div>
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
<script>
    $(document).ready(function() {
        ajaxList(page_url = false);
        function ajaxList(page_url = false){
            var baseurl = '<?php echo base_url("B_Roadmap/roadmap_list"); ?>';
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

        $(document).on('click', '.btn_dele', function() {
            var rm_id = $(this).attr('data-id');
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
                                url: '<?php echo base_url("B_Roadmap/roadmap_delete"); ?>',
                                method: "POST",
                                dataType: "json",
                                data: { rm_id: rm_id},
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

        $(document).on('click', '.btn_approve', function() {
            var rm_id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            var name = $(this).attr('data-name');
            $.confirm({
                icon: 'fas fa-info-circle',
                title: 'อนุมัติ',
                content: 'คุณต้องการเปลี่ยนสถานะอนุมัติหรือไม่',
                type: 'blue',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    เปลี่ยนสถานะ: {
                        btnClass: 'btn-blue',
                        action: function() {
                            $.ajax({
                                url: '<?php echo base_url("B_Roadmap/roadmap_approve"); ?>',
                                method: "POST",
                                dataType: "json",
                                data: { rm_id: rm_id, status:status},
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