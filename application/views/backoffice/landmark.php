<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/landmark_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> สถานที่สำคัญ
                <i class="fas fa-caret-right"></i> รายการสถานที่สำคัญ
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-8"><i class="fas fa-map-marker-alt"></i> รายการสถานที่สำคัญ</div>
                            <div class="col-4 text-right">
                                <a class="btn btn-sm btn-success" href="<?php echo base_url('backoffice/สถานที่สำคัญ/insert')?>"><i class="fas fa-plus"></i> เพิ่มสถานที่สำคัญ</a>
                            </div>
                        </div>
                    </div>
                    <div id="ajax_view"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        ajaxLandlist(page_url = false);

        $(document).on('click', ".pagination li a", function(event) {
            var page_url = $(this).attr('href');
            ajaxLandlist(page_url);
            event.preventDefault();
        });

        function ajaxLandlist(page_url = false){
            var baseurl = '<?php echo base_url("B_Landmark/land_list"); ?>';
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

        $(document).on('click', '.btn_dele', function() {
            var land_id = $(this).attr('data-id');
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
                                url: '<?php echo base_url("B_Landmark/land_delete"); ?>',
                                method: "POST",
                                dataType: "json",
                                data: { land_id: land_id},
                                success: function(data) {
                                    if (data.action == 'Y') {
                                        ajaxLandlist()
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