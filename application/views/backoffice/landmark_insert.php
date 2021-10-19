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
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/สถานที่สำคัญ');?>">สถานที่สำคัญ</a>
                <i class="fas fa-caret-right"></i> เพิ่มสถานที่สำคัญ
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header"><i class="fas fa-map-marker-alt"></i> เพิ่มสถานที่สำคัญ</div>
                    <div class="box_con_detail">
                        <div class="row">
                            <div class="col-12">
                                <form id="form_insert" name="form_insert">
                                    <div class="form-row">
                                        <div class="form-group col-6 col-md-4">
                                            <label for="land_t_id">ประเภทสถานที่สำคัญ</label>
                                            <select id="land_t_id" name="land_t_id" class="form-control form-control-sm">
                                                <option value="">เลือก</option>
                                                <?php foreach ($Re['ReLT'] as $row_ReLT){ ?>
                                                    <option value="<?php echo $row_ReLT->land_t_id;?>"><?php echo $row_ReLT->land_t_name;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-6 col-md-6">
                                            <label for="land_name">ชื่อสถานที่</label>
                                            <input type="text" id="land_name" name="land_name" class="form-control form-control-sm">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-6 col-md-9">
                                            <label for="land_add">สถานที่ตั้ง</label>
                                            <textarea class="form-control" id="land_add" name="land_add" rows="3"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-6 col-md-9">
                                            <label for="land_detail">รายละเอียด</label>
                                            <textarea class="form-control" id="land_detail" name="land_detail"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-6">
                                            <label for="land_photo">รูปภาพ <span class="text-danger">(รูปภาพแนวนอนเท่านั้น)</span></label>
                                            <input type="file" class="form-control form-control-sm" id="land_photo" name="land_photo">
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-sm" id="btn_insert"><i class="fas fa-save"></i> เพิ่มสถานที่สำคัญ</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#land_detail', {
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
        $(document).on('click', '#btn_insert', function() {
            $('#form_insert').validate({
                rules: {
                    land_t_id: { required: true },
                    land_name: { required: true },
                    land_add: { required: true },
                    land_photo: { required: true, extension: "jpg|jpeg|png"},
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_insert')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Landmark/land_insert_save"); ?>',
                        method: 'POST',
                        dataType: "json",
                        async: true,
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
                                                location.href = '<?php echo base_url("backoffice/สถานที่สำคัญ");?>';
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
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                },
            });
        });
    })
</script>