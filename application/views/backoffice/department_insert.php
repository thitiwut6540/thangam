<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/department_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">backoffice</span></a>
                <a href="<?php echo base_url('backoffice/'.$topic.'');?>" ><?php echo $topic; ?></a> <i class="fas fa-caret-right"></i> 
                เพิ่ม<?php echo $topic; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12"><i class="fas fa-sitemap"></i> เพิ่ม<?php echo $topic; ?></div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <form id="form_insert" name="form_insert">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">หัวข้อ</label>
                                    <input type="text" id="if_header" name="if_header" class="form-control form-control-sm" value="<?php if(!empty($row_Re_rl->dptype_id)){echo $topic;}else{echo $topic;} ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">ชื่อ</label>
                                    <input type="text" id="dp_name" name="dp_name" class="form-control form-control-sm" >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="">สถานที่ตั้ง</label>
                                    <input type="text" id="dp_add" name="dp_add" class="form-control form-control-sm">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">เบอร์โทรศัพท์</label>
                                    <input type="text" id="dp_tel" name="dp_tel" class="form-control form-control-sm">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">เบอร์โทรสาร</label>
                                    <input type="text" id="dp_fax" name="dp_fax" class="form-control form-control-sm">
                                </div>
                                <div class="form-group col-md-4">
									<label for="ban_photo">ภาพหน่วยงาน </label>
                                    <input type="file" name="dp_photo" id="dp_photo" class="form-control form-control-sm"> 
								</div>
							</div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="">รายะเอียดเนื้อหา</label>
                                    <textarea id="dp_detail" name="dp_detail" class="form-control form-control-sm"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm" id="btn_insert"><i class="fas fa-save"></i> บันทึก</button>
                            <input type="hidden" id="dptype_id" name="dptype_id" value="<?php echo $type; ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#dp_detail', {
            langType : 'en',
            minHeight:'200px',
            items: ['source', '|', 'undo', 'redo', '|','cut', 'copy', 'paste','plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 
                'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript','superscript', 
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold','italic', 'underline', 'strikethrough', 
                'lineheight', 'removeformat', '|', 'image', 'multiimage', 'insertfile', 'table', 'hr',  'pagebreak', 'link', 'unlink','|', 'fullscreen', '/',],
        });
    });

    $(document).ready(function() {
        $(document).on('click', '#btn_insert', function() {
            $('#form_insert').validate({
                rules: {
                    if_header: { required: true },
                    dp_name: { required: true },
                    dp_add: { required: true },
                    dp_tel: { required: true },
                    dp_fax: { required: true },
                    dp_photo: {extension: "jpg|jpeg|png" },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_insert')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Department/department_insert_save"); ?>',
                        method: 'POST',
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
                                            action: function(){
                                                window.location.href = '<?php echo base_url("backoffice/".$topic."");?>';
                                            }
                                        },
                                        ปิด: {
                                            action: function(){
                                                $('#form_insert')[0].reset();
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