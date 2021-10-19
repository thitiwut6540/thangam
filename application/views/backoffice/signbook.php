<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/signbook_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> สมุดลงนาม
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-8"><i class="fas fa-book"></i> สมุดลงนาม</div>
                            <div class="col-4 text-right">
                                <a class="btn btn-sm btn-success" href="<?php echo base_url('backoffice/สมุดลงนาม/insert');?>"><i class="fas fa-plus"></i> เพิ่มสมุดลงนาม</a>
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
            $.ajax({
                url: '<?php echo base_url("B_Signbook/signbook_list"); ?>',
                method: "POST",
                beforeSend: function() {$('#loader').show();},
                complete: function() {$('#loader').hide();},
                success: function(data) {
                    $("#ajax_view").html(data);
                }
            });
        }

        $(document).on('click', '.btn_dele', function() {
            var sb_id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรายการ',
                content: 'ต้องการลบสมุดลงนาม '+name+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: '<?php echo base_url("B_Signbook/signbook_delete"); ?>',
                                method: "POST",
                                dataType: "json",
                                data: {sb_id: sb_id},
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
    });
</script>