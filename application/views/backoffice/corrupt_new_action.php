<?php foreach ($Re['Re_c'] as $row_Re_c);?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/corrupt_menu.php');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> ร้องเรียนทุจริตและประพฤติมิชอบ
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/ร้องเรียนทุจริตและประพฤติมิชอบ');?>" >แจ้งเรื่อง</a>
                <i class="fas fa-caret-right"></i> ดำเนินการ
            </div>
        </div>

        <?php $this->load->view('backoffice/corrupt_detail') ;?>

        <div class="row mt-4">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header bg-primary">
                        <div class="row">
                            <div class="col-8 text"><i class="fas fa-save fa-lg"></i> บันทึกรับเรื่อง</div>
                            <div class="col-4 text-right"></div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <form id="form_insert" name="form_insert">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="border jumbotron p-4">
                                        <div class="row mb-3">
                                            <div class="col-auto">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="cs_1" name="c_status" class="custom-control-input" value="รับเรื่อง">
                                                    <label class="custom-control-label pt-1" for="cs_1">รับเรื่อง</label>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="cs_2" name="c_status" class="custom-control-input" value="ไม่รับแจ้ง">
                                                    <label class="custom-control-label pt-1" for="cs_2">ไม่รับแจ้ง</label>
                                                    
                                                </div>
                                            </div>
                                            <div id="c_status_validate"></div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-12 col-md-2">
                                                <label>เลขที่เรื่องร้องทุกข์</label>
                                                <input type="text" class="form-control form-control-sm" id="c_no" name="c_no" value="<?php echo $row_Re_c->c_no;?>" readonly>
                                            </div>
                                            <div class="form-group col-12 col-md-3">
                                                <label>ผู้รับเรื่องร้องทุกข์</label>
                                                <input type="text" class="form-control form-control-sm" id="ca_receive" name="ca_receive" value="<?php echo $_SESSION[''.ANW_SS.'us_name'];?>" readonly>
                                            </div>
                                            <div class="form-group col-12 col-md-3">
                                                <?php 
                                                $ReDP = $this->B_Corrupt_m->getDepart($_SESSION[''.ANW_SS.'dp_id']); 
                                                foreach ($ReDP['Re_dp'] as $row_Re_dp);
                                                ?>
                                                <label>หน่วยงาน</label>
                                                <input type="text" class="form-control form-control-sm" id="ca_dp_name" name="ca_dp_name" value="<?php echo $row_Re_dp->dp_name;?>" readonly>
                                                <input type="hidden" class="form-control form-control-sm" id="ca_dp_id" name="ca_dp_id" value="<?php echo $_SESSION[''.ANW_SS.'dp_id'] ;?>" readonly>
                                            </div>
                                            <div class="form-group col-6 col-md-2">
                                                <label>วันที่รับเรื่องร้องทุกข์</label>
                                                <input type="text" class="form-control form-control-sm dTH" id="ca_date" name="ca_date" value="<?php echo $this->B_Function_m->dateTha(date("Y-m-d"));?>" readonly>
                                            </div>
                                            <div class="form-group col-6 col-md-2">
                                                <label>เวลา</label>
                                                <input type="time" class="form-control form-control-sm" id="ca_date_time" name="ca_date_time" value="<?php echo date("H:i");?>">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-12 col-md-6">
                                                <label>หมายเหตุ ( บันทึกภายใน )</label>
                                                <textarea class="form-control form-control-sm" rows="5" id="ca_comment" name="ca_comment"></textarea>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <label>รายละเอียดดำเนินการ ( แสดงภายนอก )</label>
                                                <textarea class="form-control form-control-sm" rows="5" id="ca_public" name="ca_public"></textarea>
                                                <input type="hidden" id="c_id" name="c_id" value="<?php echo $row_Re_c->c_id; ?>">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 text-right">
                                                <button type="submit" form="form_insert" class="btn btn-success" id="btn_submit_insert"><i class="fas fa-save"></i> บันทึกรับเรื่อง</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $(".dTH").datepicker(
            $.extend({}, 
                $.datepicker.regional.th, { 
                    dateFormat: "dd/mm/yy",
                    changeMonth:true,
                    changeYear:true,
                    yearRange:"-100:+10",
                }
            )
        );
    });

    $(document).ready(function() {

        $(document).on('click', '#btn_submit_insert', function() {
            $('#form_insert').validate({
                rules: {
                    c_status: { required: true },
                    ca_receive: { required: true },
                    ca_dp_name: { required: true },
                    ca_date: { required: true },
                    ca_date_time: { required: true },
                    ca_comment: { required: true },
                    ca_public: { required: true },
                },
                errorPlacement: function(error, element) {
                    var name = $(element).attr("name");
                    if(name=='c_status'){
                        error.appendTo($("#" + name + "_validate"));
                    }else{
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_insert')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Corrupt/corrupt_new_action"); ?>',
                        type: 'POST',
                        dataType: "json",
                        data: formData,
                        beforeSend: function() { $('#loader').show(); },
                        complete: function() { $('#loader').hide(); },
                        success: function(data) {
                            if(data.action=='Y'){
                                $.confirm({
                                    icon: 'fas fa-check',
                                    title: 'สำเร็จ',
                                    content: data.output,
                                    type: 'green',
                                    typeAnimated: true,
                                    boxWidth: '420px',
                                    useBootstrap: false,
                                    buttons: {
                                        ไปหน้ารายการ: {
                                            text: 'ไปหน้ารายการ'+data.status,
                                            btnClass: 'btn-green',
                                            action: function(){
                                                location.href = '<?php echo base_url("backoffice/ร้องเรียนทุจริตและประพฤติมิชอบ/");?>'+data.status;
                                            }
                                        },
                                        ปิด: {
                                            action: function(){
                                                location.href = '<?php echo base_url("backoffice/ร้องเรียนทุจริตและประพฤติมิชอบ/แจ้งเรื่อง");?>';
                                            }
                                        },
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
                        },
                        async: true,
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                },
            });
        });
    });
</script>