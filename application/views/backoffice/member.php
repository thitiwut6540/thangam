<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/member_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> บุคลากร
                <i class="fas fa-caret-right"></i> <?php echo $type_name; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-8"><i class="fas fa-users"></i> <?php echo $type_name; ?></div>
                            <?php if($type_id!=3){ ?>
                            <div class="col-4 text-right"><a class="btn btn-sm btn-success" href="<?php echo base_url('backoffice/บุคลากร/'.$type_name.'/insert');?>"><i class="fas fa-plus"></i> เพิ่มบุคลากร</a></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                    <div class="box_con_detail">
                        <div id="ajax_view">
                            <div class="alert alert-primary" role="alert"><i class="fas fa-info-circle"></i> เลือกรายการหน่วยงานที่ต้องการจากเมนูทางด้านซ้าย</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var chkType = '<?php echo $type_id;?>';
        if(chkType != '3'){
            ajaxMember();
        }
        function ajaxMember(){
            var type_id = '<?php echo $type_id;?>';
            var type_name = '<?php echo $type_name;?>';
            var depart_id = '<?php echo $depart_id;?>';
            var depart_name = '<?php echo $depart_name;?>';
            $.ajax({
                url: '<?php echo base_url("B_Member/member_list"); ?>',
                method: "POST",
                data:{
                    type_id:type_id,
                    type_name:type_name,
                    depart_id:depart_id,
                    depart_name:depart_name,
                },
                beforeSend: function() {$('#loader').show();},
                complete: function() {$('#loader').hide();},
                success: function(data) {
                    $("#ajax_view").html(data);
                }
            });
        }

        $(document).on('click', '.btn_dele', function() {
            var mem_id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรายการ',
                content: 'ต้องการลบบุคลากร '+name+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: '<?php echo base_url("B_Member/member_delete"); ?>',
                                method: "POST",
                                dataType: "json",
                                data: { mem_id: mem_id},
                                success: function(data) {
                                    if (data.action == 'Y') {
                                        ajaxMember()
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
            var mem_id = $(this).attr('data-id');
            var list = $(this).attr('data-no');
            var type = $(this).attr('data-type');
            var depart = $(this).attr('data-depart');
            var group = $(this).attr('data-group');
            $.ajax({
                url: '<?php echo base_url("B_Member/member_no"); ?>',
                method: "POST",
                dataType: "json",
                data: { mem_id: mem_id, list: list,type: type, depart: depart, group: group, status: 'down'},
                success: function(data) {
                    if (data.action == 'Y') {
                        ajaxMember()
                    }
                }
            });
        });

        $(document).on('click', '.btn_up', function() {
            var mem_id = $(this).attr('data-id');
            var list = $(this).attr('data-no');
            var type = $(this).attr('data-type');
            var depart = $(this).attr('data-depart');
            var group = $(this).attr('data-group');
            $.ajax({
                url: '<?php echo base_url("B_Member/member_no"); ?>',
                method: "POST",
                dataType: "json",
                data: { mem_id: mem_id, list: list, type: type, depart: depart, group: group, status: 'up'},
                success: function(data) {
                    if (data.action == 'Y') {
                        ajaxMember()
                    }
                }
            });
        });
    });
</script>