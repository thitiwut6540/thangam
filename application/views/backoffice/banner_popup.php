<style>
    .tb_box{min-width: 910px;}
    .tb_box th:nth-child(1), td:nth-child(1) { width: 50px; }
    .tb_box th:nth-child(2), td:nth-child(2) { width: 60px }
    .tb_box th:nth-child(4), td:nth-child(4) { width: 50px; }
    .tb_box th:nth-child(5), td:nth-child(5) { width: 50px; }
    .tb_box th:nth-child(6), td:nth-child(6) { width: 50px; }
</style>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/banner_popup_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">backoffice</span></a>
                <i class="fas fa-caret-right"></i> ภาพแสดงหน้าแรก (POPUP) 
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-8"><i class="fas fa-image"></i> ภาพแสดงหน้าแรก (POPUP) </div>
                            <div class="col-4 text-right"><a class=" btn-sm btn-success" href="<?php echo base_url('backoffice/ภาพแสดงหน้าแรก/insert');?>"><i class="fas fa-plus"></i> เพิ่ม</a></div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <div class="table-responsive">
                            <div id="ajax_view" class="tb_box">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        ajaxList();
        function ajaxList(){
            $.ajax({
                url: '<?php echo base_url("B_Banner_popup/banner_list"); ?>',
                method: "POST",
                beforeSend: function() {$('#loader').show();},
                complete: function() {$('#loader').hide();},
                success: function(data) {
                    $("#ajax_view").html(data);
                }
            });
        }

        $(document).on('click', '.btn_dele', function() {
            var ban_id = $(this).attr('data-id');
            var ban_name = $(this).attr('data-name');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรายการ',
                content: 'ต้องการลบปุ่ม '+ban_name+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: '<?php echo base_url("B_Banner_popup/banner_delete"); ?>',
                                method: "POST",
                                dataType: "json",
                                data: { ban_id: ban_id},
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

        $(document).on('click', '.btn_status', function() {
            var ban_id = $(this).attr('data-id');
            var ban_status = $(this).val();
            $.ajax({
                url: '<?php echo base_url("B_Banner_popup/banner_status"); ?>',
                method: "POST",
                dataType: "json",
                data: { ban_id: ban_id, ban_status: ban_status,},
                success: function(data) {
                    if (data.action == 'Y') {
                        ajaxList()
                    }
                }
            });
        });

        $(document).on('click', '.btn_down', function() {
            var ban_id = $(this).attr('data-id');
            var list = $(this).attr('data-no');
            $.ajax({
                url: '<?php echo base_url("B_Banner_popup/banner_no"); ?>',
                method: "POST",
                dataType: "json",
                data: { ban_id: ban_id, list: list, status: 'down'},
                success: function(data) {
                    if (data.action == 'Y') {
                        ajaxList()
                    }
                }
            });
        });

        $(document).on('click', '.btn_up', function() {
            var ban_id = $(this).attr('data-id');
            var list = $(this).attr('data-no');
            $.ajax({
                url: '<?php echo base_url("B_Banner_popup/banner_no"); ?>',
                method: "POST",
                dataType: "json",
                data: { ban_id: ban_id, list: list, status: 'up'},
                success: function(data) {
                    if (data.action == 'Y') {
                        ajaxList()
                    }
                }
            });
        });
    })
</script>