<?php foreach ($Re['Re_s'] as $row_Re_s);?>
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
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/ขอรับบริการออนไลน์');?>" >ขอรับบริการออนไลน์</a>
                <i class="fas fa-caret-right"></i> รายละเอียด
            </div>
        </div>

        <div class="box_con">
            <div class="box_con_header">
                <div class="row">
                    <div class="col-8"><i class="fas fa-envelope text-danger fa-lg"></i> เรื่องขอรับบริการออนไลน์</div>
                    <div class="col-4 text-right"></div>
                </div>
            </div>
            <div class="box_con_detail">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th width="150">หัวข้อ</th>
                                    <th width="">รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>สถานะ</td>
                                    <td>
                                        <?php if ($row_Re_s->s_status == 'ขอรับบริการ'){ ?>
                                            <div class="alert alert-danger p-2 text-center m-0" role="alert"><?php echo $row_Re_s->s_status; ?></div>
                                        <?php } else if($row_Re_s->s_status == 'รับเรื่อง'){ ?>
                                            <div class="alert alert-warning p-2 text-center m-0" role="alert"><?php echo $row_Re_s->s_status; ?></div>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>เลขที่ร้องเรียน</td>
                                    <td><?php echo $row_Re_s->s_no;?></td>
                                </tr>
                                <tr>
                                    <td>วันที่ส่งเรื่อง</td>
                                    <td><?php echo $this->B_Function_m->datethai_time($row_Re_s->s_date);?></td>
                                </tr>
                                <tr>
                                    <td>ผู้ขอรับบริการ</td>
                                    <td><?php echo $row_Re_s->s_cus_name;?></td>
                                </tr>
                                <tr>
                                    <td>ประเภทการบริการ</td>
                                    <td><?php echo $row_Re_s->st_name;?></td>
                                </tr>
                                <tr>
                                    <td>เรื่องที่ขอรับบริการ</td>
                                    <td><?php echo $row_Re_s->s_title;?></td>
                                </tr>
                                <tr>
                                    <td>รายละเอียด</td>
                                    <td><?php echo $row_Re_s->s_detail;?></td>
                                </tr>
                                <tr>
                                    <td>ไฟล์แนบ</td>
                                    <td>
                                        <?php if(!empty($row_Re_s->s_file)){ ?>
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <a href="<?php echo base_url('public/files/service/'.$row_Re_s->s_file.''); ?>" target="_blank"><?php echo $row_Re_s->s_file;?></a>
                                                </div>
                                            </div>
                                        <?php }else{echo "ไม่มีไฟล์แนบ";} ?> 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header bg-primary">
                        <div class="row">
                            <div class="col-8"><i class="fas fa-save fa-lg"></i> บันทึกการดำเนินการ</div>
                            <div class="col-4 text-right"></div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <form id="form_edit" name="form_edit">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="border jumbotron p-4">
                                        <div class="row mb-3">
                                            <div class="col-auto">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="cs_1" name="s_status" class="custom-control-input" value="ขอรับบริการ" <?php if($row_Re_s->s_status=="ขอรับบริการ"){ echo "checked=\"checked\""; } ?>>
                                                    <label class="custom-control-label pt-1" for="cs_1">ขอรับบริการ</label>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="cs_2" name="s_status" class="custom-control-input" value="รับเรื่อง" <?php if($row_Re_s->s_status=="รับเรื่อง"){ echo "checked=\"checked\""; } ?>>
                                                    <label class="custom-control-label pt-1" for="cs_2">รับเรื่อง</label>
                                                    
                                                </div>
                                            </div>
                                            <div id="s_status_validate"></div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-12 col-md-3">
                                                <label>ผู้บันทึก</label>
                                                <input type="text" class="form-control form-control-sm" id="s_sv_us_name" name="s_sv_us_name" value="<?php echo $_SESSION[''.ANW_SS.'us_name'];?>" readonly>
                                            </div>
                                            <div class="form-group col-6 col-md-2">
                                                <label>วันที่ดำเนินการ</label>
                                                <input type="text" class="form-control form-control-sm dTH" id="s_sv_date" name="s_sv_date" value="<?php echo $this->B_Function_m->dateTha(date("Y-m-d"));?>" readonly>
                                            </div>
                                            <div class="form-group col-6 col-md-2">
                                                <label>เวลา</label>
                                                <input type="time" class="form-control form-control-sm" id="s_sv_date_time" name="s_sv_date_time" value="<?php echo date("H:i");?>">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-12">
                                                บันทึกล่าสุดวันที่ : 
                                                <?php if(!empty($row_Re_s->s_sv_us_name)){?>
                                                    <?php echo $this->B_Function_m->datethai_time($row_Re_s->s_sv_date);?>
                                                    บันทึกโดย : <?php echo $row_Re_s->s_sv_us_name;?>
                                                <?php }else{echo " <span class='text-danger'>ยังไม่มีการบันทึก</span>";}?>
                                            </div>
                                            <div class="form-group col-12">
                                                <label>บันทึก</label>
                                                <textarea class="form-control form-control-sm" rows="10" id="s_sv_note" name="s_sv_note"><?php echo $row_Re_s->s_sv_note;?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 text-right">
                                                <input type="hidden" id="s_id" name="s_id" value="<?php echo $row_Re_s->s_id; ?>">
                                                <button type="submit" form="form_edit" class="btn btn-success" id="btn_edit"><i class="fas fa-save"></i> บันทึกการดำเนินการ</button>
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

    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#s_sv_note', {
            langType : 'en',
            minHeight:'300px',
            newlineTag:'br',
            items: ['source', '|', 'undo', 'redo', '|','cut', 'copy', 'paste','plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 
                'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript','superscript', 
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold','italic', 'underline', 'strikethrough', 
                'lineheight', 'removeformat', '|', 'image', 'multiimage', 'insertfile', 'table', 'hr',  'pagebreak', 'link', 'unlink','|', 'fullscreen', '/',],
        });
    });


    $(document).ready(function() {

        $(document).on('click', '#btn_edit', function() {
            $('#form_edit').validate({
                rules: {
                    s_status: { required: true },
                    s_sv_us_name: { required: true },
                    s_sv_note: { required: true },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_edit')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Service/service_save"); ?>',
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
                                                location.href = '<?php echo base_url("backoffice/ขอรับบริการออนไลน์/รับเรื่อง");?>';
                                            }
                                        },
                                        ปิด: {
                                            action: function(){
                                                location.reload();
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