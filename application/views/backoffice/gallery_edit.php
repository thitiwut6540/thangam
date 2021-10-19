<?php foreach ($Re['Re_g'] as $row_Re_g);?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/gallery_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> แกลเลอรี่ภาพ
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/แกลเลอรี่ภาพ/'.$depart_name.'');?>"><?php echo $depart_name; ?></a>
                <i class="fas fa-caret-right"></i> แก้ไขแกลเลอรี่ภาพ
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                    <div class="row">
                            <div class="col-12"><i class="fas fa-images"></i> แก้ไขข้อมูลแกลเลอรี่ภาพ</div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <form id="form_edit" name="form_edit">
                            <div id="ajax_view_photo_banner">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <?php if(!empty($row_Re_g->gal_photo)){?>
                                            <img class="img-fluid w-100" src="<?php echo base_url('public/images/gallery/'.$row_Re_g->gal_photo);?>">
                                        <?php }else{?>
                                            <img class="img-fluid w-100" src="<?php echo base_url('public/images/nophoto.png');?>">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">หน่วยงาน</label>
                                    <select name="dp_id" id="dp_id" class="form-control form-control-sm">
                                            <option value="">เลือกหน่วยงาน</option>
                                            <?php foreach ($ReD['Re_dp'] as $row_Re_dp){ ?>
                                            <option value="<?php echo $row_Re_dp->dp_id;?>" data-name="<?php echo $row_Re_dp->dp_name;?>" <?php if($row_Re_dp->dp_id == $row_Re_g->dp_id){echo "selected";} ?>><?php echo $row_Re_dp->dptype_name." / ".$row_Re_dp->dp_name;?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">แกลลอรี่</label>
                                    <input type="text" id="gal_name" name="gal_name" class="form-control form-control-sm" value="<?php if(!empty($row_Re_g->gal_name)){echo $row_Re_g->gal_name;} ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="ban_photo">เปลี่ยนภาพปก</label>
                                    <input type="file" name="gal_photo" id="gal_photo" class="form-control form-control-sm"> 
                                    <input type="hidden" name="h_gal_photo" id="h_gal_photo" class="form-control form-control-sm" value="<?php if(!empty($row_Re_g->gal_photo)){echo $row_Re_g->gal_photo;} ?>"> 
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="">รายะเอียดเนื้อหา</label>
                                    <textarea id="gal_detail" name="gal_detail" class="form-control form-control-sm" style="width:900px;"><?php if(!empty($row_Re_g->gal_detail)){echo $row_Re_g->gal_detail;} ?></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="">รูปภาพประกอบ</label><br>
                                    <input type="file" name="gal_p_photo[]" id="gal_p_photo[]" />
                                    <input type="button" name="button1" id="button1" value="+" onclick="JavaScript:fncCreateElement1();" />
                                    (กด + เพื่อเพิ่มรูปภาพ)<br/>
                                    <div id="mySpan1"></div>
                                </div>
                            </div>
                            <div id="ajax_view_photo_list">
                                <div class="form-row">
                                    <?php foreach ($Re['Re_gp'] as $row_Re_gp){?>
                                        <div class="form-group col-md-3">
                                            <?php if(!empty($row_Re_gp->galp_photo)){?>
                                                <button type="button" class="btn_fm btn_red btn_photo_dele_list" data-id="<?php echo $row_Re_gp->galp_id;?>"><i class="fas fa-times"></i> ลบ</button><br>
                                                <img class="img-fluid w-100" src="<?php echo base_url('public/images/gallery/'.$row_Re_gp->galp_photo.'');?>">
                                            <?php }else{?>
                                                <button type="button" class="btn_fm btn_red" disabled><i class="fas fa-times"></i> ลบ</button><br>
                                                <img class="img-fluid w-100" src="<?php echo base_url('public/images/nophoto.png');?>">
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-sm btn-success" id="btn_edit"><i class="fas fa-save"></i> บันทึกแก้ไขข้อมูล</button>
                            <input type="hidden" id="gal_id" name="gal_id" value="<?php echo $row_Re_g->gal_id; ?>">
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
        editor = K.create('#gal_detail', {
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
        myElement.setAttribute('name',"gal_p_photo[]");
        mySpan1.appendChild(myElement);
        mySpan1.appendChild(myElement2);
    }

    $(document).ready(function(){
        $(document).on('click', '#btn_edit', function() {
            var $this = $('#dp_id');
            var $selectedOption = $this.find('option:selected');
            var dp_name = $selectedOption.data('name');

            $('#form_edit').validate({
                rules: {
                    gal_name: { required: true },
                    dp_id: { required: true },
                    gal_photo: {extension: "jpg|jpeg|png" },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_edit')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Gallery/gallery_edit_save"); ?>',
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
                                                location.href = '<?php echo base_url("backoffice/แกลเลอรี่ภาพ/");?>'+dp_name;
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

        $(document).on('click', '.btn_photo_dele_list', function() {
            var galp_id=$(this).attr('data-id');
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
                                url: '<?php echo base_url("B_Gallery/gallery_dele_photo"); ?>',
                                method: "POST",
                                dataType: "json",
                                beforeSend: function() {$('#loader').show();},
                                complete: function() {$('#loader').hide();},
                                data: { galp_id:galp_id},
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