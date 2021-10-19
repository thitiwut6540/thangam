<div id="header"><?php $this->load->view('backoffice/_header');?></div>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/operations_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('Backoffice/dashboard');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                ผลการดำเนินงาน
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-8"><?php echo $topic; ?></div>
                            <div class="col-4 text-right">
                                <!-- <a class="btn btn_green" id="btn_insert" href="<?php echo base_url('Backoffice//เพิ่ม')?>"><i class="fas fa-plus"></i> เพิ่มผลการดำเนินงาน</a> -->
                                <a class="btn btn_green" id="btn_insert" href="<?php echo base_url('Backoffice/ผลการดำเนินงาน/'.$topic.'/เพิ่ม')?>"><i class="fas fa-plus"></i> เพิ่ม</a>
                            </div>
                        </div>
                    </div>
                    <div id="ajax_view">
                        <div class="box_con_detail">
                        
                        </div>
                    </div>

                    <div>
                        <form>
                            <input type="hidden" id="SH_dp_name" name="SH_dp_name" value="<?php echo $topic;?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="loader" style="display:none;"><img src="<?php echo base_url('public/images/icon/ajax-loader.gif');?>" ><br><br>กำลังบันทึกข้อมูลกรุณารอสักครู่</div>
<script src="<?php echo base_url('public/js/b_operations.js');?>"></script>
<script>
    $(document).ready(function() {
        ajaxoprlist(page_url = false);

        $(document).on('click', ".pagination li a", function(event) {
            var page_url = $(this).attr('href');
            ajaxoprlist(page_url);
            event.preventDefault();
        });

        function ajaxoprlist(page_url = false){
            var SH_dp_name = $("#SH_dp_name").val();
            var baseurl = base_url+"B_Operations/operations_list";
            if(page_url == false) {var page_url = baseurl;}
            $.ajax({
                type: "POST",
                url: page_url,
                data: {
                    SH_dp_name:SH_dp_name,
                },
                beforeSend: function() {$('#loader').show();},
                complete: function() {$('#loader').hide();},
                success: function(data) {
                    $("#ajax_view").html(data);
                }
            });
        }
    });
</script>