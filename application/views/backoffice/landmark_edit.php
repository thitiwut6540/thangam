<?php foreach ($ReE['Re_l'] as $row_Re_l); ?>
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
                สถานที่สำคัญ
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">แก้ไขสถานที่สำคัญ</div>
                    <div class="box_con_detail">
                        <div class="row">
                            <div class="col-12">
                                <form id="form_edit" name="form_edit">
                                    <div class="form-row">
                                        <div class="form-group col-6 col-md-4">
                                            <label for="land_t_id">ประเภทสถานที่สำคัญ</label>
                                            <select id="land_t_id" name="land_t_id" class="form-control form-control-sm">
                                                <option value="">เลือก</option>
                                                <?php foreach ($Re['ReLT'] as $row_ReLT){ ?>
                                                    <option value="<?php echo $row_ReLT->land_t_id;?>" <?php if($row_Re_l->land_t_id==$row_ReLT->land_t_id){ echo "selected=\"selected\""; }?>><?php echo $row_ReLT->land_t_name;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-6 col-md-6">
                                            <label for="land_name">ชื่อสถานที่</label>
                                            <input type="text" id="land_name" name="land_name" class="form-control form-control-sm" value="<?php echo $row_Re_l->land_name;?>">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-6 col-md-9">
                                            <label for="land_add">สถานที่ตั้ง</label>
                                            <textarea class="form-control" id="land_add" name="land_add" rows="3"><?php echo $row_Re_l->land_add;?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-6 col-md-9">
                                            <label for="land_detail">รายละเอียด</label>
                                            <textarea class="form-control" id="land_detail" name="land_detail"><?php echo $row_Re_l->land_detail;?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-6">
                                            <label for="land_photo">เปลียนรูปภาพ</label>
                                            <input type="file" class="form-control form-control-sm" id="land_photo" name="land_photo">
                                            <input type="hidden" id="h_land_photo" name="h_land_photo" value="<?php echo $row_Re_l->land_photo;?>">
                                            <input type="hidden" id="land_id" name="land_id" value="<?php echo $row_Re_l->land_id;?>">
                                        </div>
                                    </div>

                                    <?php if(!empty($row_Re_l->land_photo)){?>
                                        <hr><div class="form-row">
                                            <div class="form-group col-12 col-md-6">
                                                <img class="img-fluid" src="<?php echo base_url('public/images/landmark/'.$row_Re_l->land_photo);?>">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-sm" id="btn_edit"><i class="fas fa-save"></i> แก้ไขสถานที่สำคัญ</button>
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
        $(document).on('click', '#btn_edit', function() {
            $('#form_edit').validate({
                rules: {
                    land_t_id: { required: true },
                    land_name: { required: true },
                    land_add: { required: true },
                    land_photo: {extension: "jpg|jpeg|png"},
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_edit')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Landmark/land_edit_save"); ?>',
                        method: 'POST',
                        dataType: "json",
                        async: true,
                        data: formData,
                        beforeSend: function() { $('#loader').show(); },
                        complete: function() { $('#loader').hide(); },
                        success: function(data) {
                            console.log(data);
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
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                },
            });
        });
    })
</script>