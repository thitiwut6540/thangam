<style>
    .tb_box{min-width: 910px;}
    .tb_box th:nth-child(1), td:nth-child(1) { width: 50px; }
    .tb_box th:nth-child(2), td:nth-child(2) { }
    .tb_box th:nth-child(3), td:nth-child(3) { width: 50px; }
    .tb_box th:nth-child(4), td:nth-child(4) { width: 50px; }
</style>

<div id="header"><?php $this->load->view('backoffice/_header');?></div>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/laws_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('Backoffice/dashboard');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <?php echo $topic; ?>
                <input type="hidden" id="topic" name="topic" value="<?php echo $topic; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-8"><?php echo $topic; ?></div>
                            <div class="col-4 text-right">
                                <a class="btn btn_green" id="btn_type_insert" name="btn_type_insert"><i class="fas fa-plus"></i> เพิ่ม</a>
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <div id="modal_success" class="alert_success" style="display:none"></div>
                        <div id="modal_error" class="alert_error" style="display:none"></div>
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

<!-- loader -->
<div id="loader" style="display:none;"><img src="<?php echo base_url('public/images/icon/150x150.gif');?>"><br>กำลังดำเนินการกรุณารอ</div>
<div id="modal_box" style="display:none;"><form id="modal_box_form" name="modal_box_form"></form></div>
<!-- JS -->
<script src="<?php echo base_url('public/js/b_laws.js');?>"></script>

<script>
    $(document).ready(function() {
        ajaxLawsType(page_url = false);

        $(document).on('click', ".pagination li a", function(event) {
            var page_url = $(this).attr('href');
            ajaxLawsType(page_url);
            event.preventDefault();
        });

        function ajaxLawsType(page_url = false){
            var baseurl = base_url+"B_Laws/list_type";
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
    });
</script>
