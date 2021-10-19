<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/history_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> ทําเนียบ
                <i class="fas fa-caret-right"></i> <?php echo $h_type_name; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-8"><i class="fas fa-user-clock"></i> <?php echo $h_type_name; ?></div>
                            <div class="col-4 text-right"><a class="btn btn-sm btn-success" href="<?php echo base_url('backoffice/ทําเนียบ/'.$h_type_name.'/insert');?>"><i class="fas fa-plus"></i> เพิ่มทําเนียบ<?php echo $h_type_name;?></a></div>
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
<script>
    $(document).ready(function() {
        ajaxList();
        function ajaxList(){
            var h_type = '<?php echo $h_type;?>';
            var h_type_name = '<?php echo $h_type_name;?>';
            $.ajax({
                url: '<?php echo base_url("B_History/history_list"); ?>',
                method: "POST",
                data:{
                    h_type:h_type,
                    h_type_name:h_type_name,
                },
                beforeSend: function() {$('#loader').show();},
                complete: function() {$('#loader').hide();},
                success: function(data) {
                    $("#ajax_view").html(data);
                }
            });
        }

        $(document).on('click', '.btn_dele', function() {
            var h_id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรายการ',
                content: 'ต้องการลบรายชื่อ '+name+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: '<?php echo base_url("B_History/history_delete"); ?>',
                                method: "POST",
                                dataType: "json",
                                data: { h_id: h_id},
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
            var h_id = $(this).attr('data-id');
            var list = $(this).attr('data-no');
            var type = $(this).attr('data-type');
            $.ajax({
                url: '<?php echo base_url("B_History/history_no"); ?>',
                method: "POST",
                dataType: "json",
                data: { h_id: h_id, list: list,type: type, status: 'down'},
                success: function(data) {
                    if (data.action == 'Y') {
                        ajaxList()
                    }
                }
            });
        });

        $(document).on('click', '.btn_up', function() {
            var h_id = $(this).attr('data-id');
            var list = $(this).attr('data-no');
            var type = $(this).attr('data-type');
            $.ajax({
                url: '<?php echo base_url("B_History/history_no"); ?>',
                method: "POST",
                dataType: "json",
                data: { h_id: h_id, list: list, type: type, status: 'up'},
                success: function(data) {
                    if (data.action == 'Y') {
                        ajaxList()
                    }
                }
            });
        });
    });
</script>