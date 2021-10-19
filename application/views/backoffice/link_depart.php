<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/link_depart_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">backoffice</span></a>
                <i class="fas fa-caret-right"></i> ปุ่มลิงค์หน่วยงาน
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-8"><i class="fas fa-link"></i> ปุ่มลิงค์หน่วยงาน</div>
                            <div class="col-4 text-right"><a class=" btn-sm btn-success" href="<?php echo base_url('backoffice/ปุ่มลิงค์หน่วยงาน/insert');?>"><i class="fas fa-plus"></i> เพิ่ม</a></div>
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
        linkdepartList();
        function linkdepartList(){
            $.ajax({
                url: '<?php echo base_url("B_Link_depart/linkdepart_list"); ?>',
                method: "POST",
                beforeSend: function() {$('#loader').show();},
                complete: function() {$('#loader').hide();},
                success: function(data) {
                    $("#ajax_view").html(data);
                }
            });
        }

        $(document).on('click', '.btn_dele', function() {
            var l_id = $(this).attr('data-id');
            var l_name = $(this).attr('data-name');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรายการ',
                content: 'ต้องการลบปุ่ม '+l_name+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: '<?php echo base_url("B_Link_depart/linkdepart_delete"); ?>',
                                method: "POST",
                                dataType: "json",
                                data: { l_id: l_id},
                                success: function(data) {
                                    if (data.action == 'Y') {
                                        linkdepartList()
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
            var l_id = $(this).attr('data-id');
            var l_status = $(this).val();
            $.ajax({
                url: '<?php echo base_url("B_Link_depart/linkdepart_status"); ?>',
                method: "POST",
                dataType: "json",
                data: { l_id: l_id, l_status: l_status,},
                success: function(data) {
                    if (data.action == 'Y') {
                        linkdepartList()
                    }
                }
            });
        });

        $(document).on('click', '.btn_down', function() {
            var l_id = $(this).attr('data-id');
            var list = $(this).attr('data-no');
            $.ajax({
                url: '<?php echo base_url("B_Link_depart/linkdepart_no"); ?>',
                method: "POST",
                dataType: "json",
                data: { l_id: l_id, list: list, status: 'down'},
                success: function(data) {
                    if (data.action == 'Y') {
                        linkdepartList()
                    }
                }
            });
        });

        $(document).on('click', '.btn_up', function() {
            var l_id = $(this).attr('data-id');
            var list = $(this).attr('data-no');
            $.ajax({
                url: '<?php echo base_url("B_Link_depart/linkdepart_no"); ?>',
                method: "POST",
                dataType: "json",
                data: { l_id: l_id, list: list, status: 'up'},
                success: function(data) {
                    if (data.action == 'Y') {
                        linkdepartList()
                    }
                }
            });
        });
    })
</script>