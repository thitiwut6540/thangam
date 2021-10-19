<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/webboard_menu.php');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> Webboard
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-9">
                                <i class="fas fa-comment fa-flip-horizontal"></i> Webboard
                            </div>
                            <div class="col-3 text-right">
                                <a class="btn btn-sm btn-success" href="<?php echo base_url('backoffice/webboard/เพิ่มหัวข้อใหม่');?>" ><i class="fas fa-plus"></i> เพิ่มหัวข้อใหม่</a>
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
        ajaxwb_topic(page_url = false);

        $(document).on('click', ".pagination li a", function(event) {
            var page_url = $(this).attr('href');
            ajaxwb_topic(page_url);
            event.preventDefault();
        });

        function ajaxwb_topic(page_url = false){
            var baseurl = '<?php echo base_url("B_Webboard/webboard_list"); ?>';
            if(page_url == false) {var page_url = baseurl;}
            $.ajax({
                type: "POST",
                url: page_url,
                beforeSend: function() {$('#loader').show();},
                complete: function() {$('#loader').hide();},
                success: function(data) {
                    $("#ajax_view").html(data);
                }
            });
        }

        function ajaxwb_sub(id,url1){
            $.ajax({
                url: '<?php echo base_url("B_Webboard/webboard_sub_list"); ?>',
                method: "POST",
                dataType: "json",
	            data: {wb_t_id: id,},
                beforeSend: function() {$('#loader').show();},
                complete: function() {$('#loader').hide();},
                success: function(data) {
                    if(data.action=='Y'){
                        $('#'+url1+'').html(data.output);
                    }
                }
            });
        }

        $(document).on('click', '.btn_topic_dele', function() {
            var wb_t_id = $(this).attr('data-id');
            var wb_t_title =  $(this).attr('data-name');

            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรายการ',
                content: 'ต้องการลบหัวข้อ '+wb_t_title+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: "<?php echo base_url("B_Webboard/webboard_topic_delete"); ?>",
                                method: "POST",
                                dataType: "json",
                                data: { wb_t_id: wb_t_id},
                                success: function(data) {
                                    if (data.action == 'Y') {
                                        $.alert({
                                            icon: 'fas fa-exclamation-triangle',
                                            title: 'สำเร็จ',
                                            content: data.output,
                                            type: 'green',
                                            typeAnimated: true,
                                            boxWidth: '420px',
                                            useBootstrap: false,
                                            onDestroy: function() {
                                                ajaxwb_topic();
                                            }
                                        });
                                    } else {
                                        $.alert({
                                            icon: 'fas fa-exclamation-triangle',
                                            title: 'สำเร็จ',
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

        $(document).on('click', '.btn_sub_dele', function() {
            var wb_s_id = $(this).attr('data-id');
            var wb_t_id = $(this).attr('data-topic');
            var wb_s_title =  $(this).attr('data-name');
            var url=$(this).attr('data-url');

            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรายการ',
                content: 'ต้องการลบหัวข้อย่อย '+wb_s_title+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: "<?php echo base_url("B_Webboard/webboard_sub_delete"); ?>",
                                method: "POST",
                                dataType: "json",
                                data: { wb_s_id: wb_s_id},
                                success: function(data) {
                                    if (data.action == 'Y') {
                                        $.alert({
                                            icon: 'fas fa-check',
                                            title: 'สำเร็จ',
                                            content: data.output,
                                            type: 'green',
                                            typeAnimated: true,
                                            boxWidth: '420px',
                                            useBootstrap: false,
                                            onDestroy: function() {
                                                ajaxwb_sub(wb_t_id,url);
                                            }
                                        });
                                    } else {
                                        $.alert({
                                            icon: 'fas fa-exclamation-triangle',
                                            title: 'สำเร็จ',
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