<?php foreach ($Re['Re_ot'] as $row_Re_ot);?>
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
                <i class="fas fa-caret-right"></i> แก้ไขสินค้าโอทอป
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12"><i class="fas fa-lemon"></i> แก้ไขสินค้าโอทอป</div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                            <form id="form_edit" name="form_edit">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <?php if(!empty($row_Re_ot->otop_photo)){?>
                                            <img class="img-fluid" src="<?php echo base_url('public/images/otop/'.$row_Re_ot->otop_photo);?>">
                                        <?php }else{?>
                                            <img class="img-fluid" src="<?php echo base_url('public/images/nophoto.png');?>">
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="">สถานะ</label>
                                        <select name="otop_status" id="otop_status" class="form-control form-control-sm">
                                            <option value="">เลือกสถานะ</option>
                                            <option value="Y" <?php if($row_Re_ot->otop_status=='Y'){echo "selected";}else{echo "";}?>>แสดง</option>
                                            <option value="N" <?php if($row_Re_ot->otop_status=='N'){echo "selected";}else{echo "";}?>>ไม่แสดง</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="">ชื่อสินค้า</label>
                                        <input type="text" id="otop_name" name="otop_name" class="form-control form-control-sm" value="<?php if(!empty($row_Re_ot->otop_name)){echo $row_Re_ot->otop_name;}?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">ราคา</label>
                                        <input type="text" id="otop_price" name="otop_price" class="form-control form-control-sm" value="<?php if(!empty($row_Re_ot->otop_price)){echo $row_Re_ot->otop_price;}?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="">รายะเอียดเนื้อหา</label>
                                        <textarea id="otop_detail" name="otop_detail" class="form-control form-control-sm" style="width:900px;"><?php if(!empty($row_Re_ot->otop_detail)){echo $row_Re_ot->otop_detail;}?></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">ภาพปก</label>
                                        <input type="file" name="otop_photo" id="otop_photo" class="form-control form-control-sm"> 
                                        <input type="hidden" name="h_otop_photo" id="h_otop_photo" value="<?php if(!empty($row_Re_ot->otop_photo)){echo $row_Re_ot->otop_photo;}?>"> 
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

                                <?php if($Re['total_Re_otp']>0){ ?>
                                <hr>
                                <div class="form-row">
                                    <?php foreach ($Re['Re_otp'] as $row_Re_otp){?>
                                        <div class="form-group col-md-3">
                                            <?php if(!empty($row_Re_otp->otop_p_photo)){?>
                                                <button type="button" class="btn_fm btn_red btn_otp_photo_dele" data-id="<?php echo $row_Re_otp->otop_p_id;?>"><i class="fas fa-times"></i> ลบ</button><br>
                                                <div><img class="img-fluid w-100" src="<?php echo base_url('public/images/otop/'.$row_Re_otp->otop_p_photo.'');?>"></div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                <hr>
                                <button type="submit" class="btn btn-sm btn-success" id="btn_edit"><i class="fas fa-save"></i> บันทึก</button>
                                <input type="hidden" id="otop_id" name="otop_id" value="<?php echo $row_Re_ot->otop_id; ?>">
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
        $(document).on('click', '#btn_edit', function() {
            $('#form_edit').validate({
                rules: {
                    otop_name: { required: true },
                    otop_detail: { required: true },
                    otop_status: { required: true },
                    otop_photo: { extension: "jpg|jpeg|png" },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_edit')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Otop/otop_edit_save"); ?>',
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

        $(document).on('click', '.btn_otp_photo_dele', function() {
            var otop_p_id=$(this).attr('data-id');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรูปภาพ',
                content: 'ต้องการลบรูปภาพหรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function(){
                            $.ajax({
                                url: '<?php echo base_url("B_Otop/dele_otp_photo"); ?>',
                                method: "POST",
                                dataType: "json",
                                beforeSend: function() {$('#loader').show();},
                                complete: function() {$('#loader').hide();},
                                data: { otop_p_id:otop_p_id},
                                success: function(data) {
                                    if(data.action=='Y'){
                                        location.reload();
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
                                }
                            }); 
                        }
                    },
                    ยกเลิก: {},
                }
            });
        });
    });

</script>
