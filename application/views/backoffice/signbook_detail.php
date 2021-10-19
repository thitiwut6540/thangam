<?php foreach ($Re['Re_sb'] as $row_Re_sb);?>
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
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/สมุดลงนาม');?>" >สมุดลงนาม</a>
                <i class="fas fa-caret-right"></i> รายชื่อผู้ลงนาน
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12">
                                <i class="fas fa-book"></i> รายชื่อผู้ลงนาน
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <div class="row">
                            <div class="col-12">
                                <h4><?php echo $row_Re_sb->sb_name;?></h4>
                                <div class="small text-secondary"><i class="far fa-calendar-alt"></i> <?php echo $this->B_Function_m->datethai_time($row_Re_sb->sb_date); ?></div>
                            </div>
                            <?php if(!empty($row_Re_sb->sb_photo)){;?>
                                <div class="col-12 mt-3 text-center">
                                    <img class="img-fluit mb-lg-4 border" src="<?php echo base_url('public/images/signbook/'.$row_Re_sb->sb_photo.''); ?>">
                                </div>
                            <?php } ?>
                            <?php if(!empty($row_Re_sb->sb_title)){;?>
                                <div class="col-12">
                                    <hr>
                                    <?php echo $row_Re_sb->sb_title;?>
                                </div>
                            <?php } ?>

                            <div class="col-12">
                                <form id="form_SH" name="form_SH">
                                    <input type="hidden" id="SH_sb_id" name="SH_sb_id" value="<?php echo $row_Re_sb->sb_id;?>">
                                </form>
                                 <div id="ajax_view"></div>
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
        ajaxList(page_url = false);
        function ajaxList(page_url = false){
            var baseurl = '<?php echo base_url("B_Signbook/signbook_sign_list"); ?>';
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
            var sbl_id=$(this).attr('data-id');
            var name=$(this).attr('data-name');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรูปภาพ',
                content: 'ยืนยันข้อความคุณ '+name+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function(){
                            $.ajax({
                                url: '<?php echo base_url("B_Signbook/signbook_sign_delete"); ?>',
                                method: "POST",
                                dataType: "json",
                                beforeSend: function() {$('#loader').show();},
                                complete: function() {$('#loader').hide();},
                                data: { sbl_id:sbl_id},
                                success: function(data) {
                                    if(data.action=='Y'){
                                        ajaxList();
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