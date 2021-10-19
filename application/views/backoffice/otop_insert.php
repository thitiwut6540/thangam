<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/otop_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/สินค้าโอทอป');?>">สินค้าโอทอป</a>
                <i class="fas fa-caret-right"></i> เพิ่มสินค้าโอทอป
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12"><i class="fas fa-lemon"></i> เพิ่มสินค้าโอทอป</div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <div id="modal_success" class="alert_success" style="display:none"></div>
                        <div id="modal_error" class="alert_error" style="display:none"></div>
                            <form id="form_insert" name="form_insert">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="">สถานะ</label>
                                        <select name="otop_status" id="otop_status" class="form-control form-control-sm">
                                            <option value="">เลือกสถานะ</option>
                                            <option value="Y">แสดง</option>
                                            <option value="N">ไม่แสดง</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="">ชื่อสินค้า</label>
                                        <input type="text" id="otop_name" name="otop_name" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">ราคา</label>
                                        <input type="text" id="otop_price" name="otop_price" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="">รายะเอียดเนื้อหา</label>
                                        <textarea id="otop_detail" name="otop_detail" class="form-control form-control-sm" style="width:900px;"></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">ภาพปก</label>
                                        <input type="file" name="otop_photo" id="otop_photo" class="form-control form-control-sm"> 
                                    </div>
							    </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="">รูปภาพประกอบ</label><br>
                                        <input type="file" name="otop_p_photo[]" id="otop_p_photo[]" />
                                        <input type="button" name="button1" id="button1" value="+" onclick="JavaScript:fncCreateElement1();" />
                                        (กด + เพื่อเพิ่มรูปภาพ)<br/>
                                        <div id="mySpan1"></div>
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-sm btn-success" id="btn_insert"><i class="fas fa-save"></i> บันทึก</button>
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
        editor = K.create('#otop_detail', {
            langType : 'en',
            minHeight:'300px',
            newlineTag:'br',
            items: ['source', '|', 'undo', 'redo', '|','cut', 'copy', 'paste','plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 
                'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript','superscript', 
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold','italic', 'underline', 'strikethrough', 
                'lineheight', 'removeformat', '|', 'image', 'multiimage', 'insertfile', 'table', 'hr',  'pagebreak', 'link', 'unlink','|', 'fullscreen', '/',],
        });
    });

    function fncCreateElement1(){
        var mySpan1 = document.getElementById('mySpan1');
        var myElement = document.createElement('input');
        var myElement2 = document.createElement('br');
        myElement.setAttribute('type',"file");
        myElement.setAttribute('name',"otop_p_photo[]");
        mySpan1.appendChild(myElement);
        mySpan1.appendChild(myElement2);
    }

    $(document).ready(function(){
        $(document).on('click', '#btn_insert', function() {
            $('#form_insert').validate({
                rules: {
                    otop_name: { required: true },
                    otop_detail: { required: true },
                    otop_status: { required: true },
                    otop_photo: { required: true, extension: "jpg|jpeg|png" },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_insert')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Otop/otop_insert_save"); ?>',
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
                                            action: function(){
                                                location.href = '<?php echo base_url("backoffice/สินค้าโอทอป");?>';
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
