<style>
    .tb_box{min-width: 910px;}
    .tb_box th:nth-child(1), td:nth-child(1) { width: 50px; }
    .tb_box th:nth-child(2), td:nth-child(2) { width: 60px }
    .tb_box th:nth-child(3), td:nth-child(3) { width: 400px }
    .tb_box th:nth-child(5), td:nth-child(5) { width: 50px; }
    .tb_box th:nth-child(6), td:nth-child(6) { width: 50px; }
</style>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/department_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">backoffice</span></a>
                <i class="fas fa-caret-right"></i> <?php echo $topic; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-8"><i class="fas fa-sitemap"></i> <?php echo $topic; ?></div>
                            <div class="col-4 text-right">
                                <a class="btn btn-sm btn-success" href="<?php echo base_url('backoffice/'.$topic.'/insert')?>"><i class="fas fa-plus"></i> เพิ่ม<?php echo $topic; ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <div class="table-responsive">
                            <div id="ajax_view" class="tb_box"></div>
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
                url: '<?php echo base_url("B_Department/department_list"); ?>',
                method: "POST",
                data: { 
                    id:'<?php echo $type;?>',
                    name:'<?php echo $topic;?>'
                },
                beforeSend: function() {$('#loader').show();},
                complete: function() {$('#loader').hide();},
                success: function(data) {
                    $("#ajax_view").html(data);
                }
            });
        }

        $(document).on('click', '.btn_down', function() {
            var dp_id = $(this).attr('data-id');
            var list = $(this).attr('data-no');
            $.ajax({
                url: '<?php echo base_url("B_Department/department_no"); ?>',
                method: "POST",
                dataType: "json",
                data: { dp_id: dp_id, list: list, status: 'down'},
                success: function(data) {
                    if (data.action == 'Y') {
                        ajaxList()
                    }
                }
            });
        });

        $(document).on('click', '.btn_up', function() {
            var dp_id = $(this).attr('data-id');
            var list = $(this).attr('data-no');
            $.ajax({
                url: '<?php echo base_url("B_Department/department_no"); ?>',
                method: "POST",
                dataType: "json",
                data: { dp_id: dp_id, list: list, status: 'up'},
                success: function(data) {
                    if (data.action == 'Y') {
                        ajaxList()
                    }
                }
            });
        });

        $(document).on('click', '.btn_delete', function() {
            var dp_id = $(this).attr('data-id');
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
                                url: '<?php echo base_url("B_Department/department_delete"); ?>',
                                method: "POST",
                                dataType: "json",
                                data: {dp_id: dp_id},
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
                                }
                            });
                        }
                    },
                    ยกเลิก: {},
                }
            });
        });

    })
</script>