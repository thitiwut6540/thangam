<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/service_menu.php');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> ร้องเรียนร้องทุกข์
                <i class="fas fa-caret-right"></i> แจ้งร้องเรียน
            </div>
        </div>

        <div class="row px-3 mb-1">
            <div class="col-12 p-2 bg_main_light rounded">
                <form id="form_SH" name="form_SH" class="form-inline p-0 m-0">
                    <div class="form-group mx-sm-3">
                        <select class="custom-select" id="SH_type" name="SH_type">
                            <option value="">ทุกการบริการ</option>
                            <?php foreach ($ReST['Re_st'] as $row_Re_st){?>
                                <option value="<?php echo $row_Re_st->st_id;?>"><?php echo $row_Re_st->st_name;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group mx-sm-3">
                        <input type="text" class="form-control form-control-sm" id="SH_title" name="SH_title" placeholder="ชื่อเรื่อง">
                    </div>
                    <div class="form-group mx-sm-3">
                        <input type="text" class="form-control form-control-sm" id="SH_name" name="SH_name" placeholder="ชื่อผู้ขอรับบริการ">
                    </div>
                    <input type="text" id="SH_status" name="SH_status" value="<?php echo $status;?>">
                    <button type="button" id="btn_SH" class="btn btn-sm btn-primary mx-1"><i class="fas fa-search"></i> ค้นหา</button>
                </form>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12">
                                <?php if($status=='ขอรับบริการ'){;?>
                                <i class="fas fa-envelope text-danger fa-lg"></i>
                                <?php }else if($status=='รับเรื่อง'){;?>
                                <i class="fas fa-check-circle text-success fa-lg"></i>
                                <?php } ;?>
                                <?php echo $status;?>
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
        function ajaxList(page_url = false){
            var baseurl = '<?php echo base_url("B_Service/service_list"); ?>';
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
            var c_no = $(this).attr('data-no');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรายการ',
                content: 'ต้องการลบรายการหมายเลข '+c_no+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: base_url + "B_Service/service_delete",
                                type: 'POST',
                                dataType: "json",
                                data: {c_no: c_no},
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
                                                ajaxList();
                                            }
                                        })
                                    } else {
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
                                },
                            });
                        }
                    },
                    ยกเลิก: {},
                }
            });
        }); 
    });
</script>