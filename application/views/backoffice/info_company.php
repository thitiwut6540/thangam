<?php foreach ($Re['Re_c'] as $row_Re_c); ?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/info_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> ข้อมูลเทศบาล
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header"><i class="fas fa-address-card"></i> ข้อมูลเทศบาล</div>
                    <div class="box_con_detail">
                        <form id="form_edit">
                            <table class="table table-sm table-bordered">
                                <tr>
                                    <td width="150" class="align-middle"><b>ชื่อองค์กร</b></td>
                                    <td><input type="text" class="form-control" id="c_name" name="c_name" value="<?php echo $row_Re_c->c_name;?>"></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">ที่อยู่</td>
                                    <td><input type="text" class="form-control" id="c_address" name="c_address" value="<?php echo $row_Re_c->c_address;?>"></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">เบอร์โทร 1.</td>
                                    <td><input type="text" class="form-control" id="c_tel1" name="c_tel1" value="<?php echo $row_Re_c->c_tel1;?>"></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">เบอร์โทร 2.</td>
                                    <td><input type="text" class="form-control" id="c_tel2" name="c_tel2	" value="<?php echo $row_Re_c->c_tel2	;?>"></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Fax</td>
                                    <td><input type="text" class="form-control" id="c_fax" name="c_fax" value="<?php echo $row_Re_c->c_fax;?>"></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Email</td>
                                    <td><input type="text" class="form-control" id="c_email" name="c_email" value="<?php echo $row_Re_c->c_email;?>"></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Website</td>
                                    <td><input type="text" class="form-control" id="c_web" name="c_web" value="<?php echo $row_Re_c->c_web;?>"></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Facebook</td>
                                    <td><input type="text" class="form-control" id="c_facebook" name="c_facebook" value="<?php echo $row_Re_c->c_facebook;?>"></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Line</td>
                                    <td><input type="text" class="form-control" id="c_line" name="c_line" value="<?php echo $row_Re_c->c_line;?>"></td>
                                </tr>
                            </table>
                            <button type="submit" class="btn btn-success" id="btn_edit"><i class="fas fa-save"></i> บันทึกแก้ไขข้อมูล</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', '#btn_edit', function() {
            $('#form_edit').validate({
                rules: {
                    c_name: { required: true },
                    c_address: { required: true },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_edit')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Info/info_company_save"); ?>',
                        type: 'POST',
                        dataType: "json",
                        data: formData,
                        beforeSend: function() { $('#loader').show(); },
                        complete: function() { $('#loader').hide(); },
                        success: function(data) {
                            if(data.action=='Y'){
                                $.alert({
                                    icon: 'fas fa-check',
                                    title: 'สำเร็จ',
                                    content: data.output,
                                    type: 'green',
                                    typeAnimated: true,
                                    boxWidth: '420px',
                                    useBootstrap: false,
                                    onDestroy: function() {
                                        location.reload();
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
    })
</script>