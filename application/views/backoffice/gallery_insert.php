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
                <i class="fas fa-caret-right"></i> เพิ่มแกลเลอรี่ภาพ
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                    <div class="row">
                            <div class="col-12"><i class="fas fa-images"></i> เพิ่มแกลเลอรี่ภาพ</div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                            <form id="form_insert" name="form_insert">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>หน่วยงาน</label>
                                        <select name="dp_id" id="dp_id" class="form-control form-control-sm">
                                                <option value="">เลือกหน่วยงาน</option>
                                                <?php foreach ($ReD['Re_dp'] as $row_Re_dp){ ?>
                                                <option value="<?php echo $row_Re_dp->dp_id;?>" data-name="<?php echo $row_Re_dp->dp_name;?>"><?php echo $row_Re_dp->dptype_name." / ".$row_Re_dp->dp_name;?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>แกลลอรี่</label>
                                        <input type="text" id="gal_name" name="gal_name" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label >ภาพปก</label>
                                        <input type="file" name="gal_photo" id="gal_photo" class="form-control form-control-sm"> 
                                    </div>
							    </div>
                                <div class="form-row">
                                    <div class="form-group col-md-9">
                                        <label>รายะเอียดเนื้อหา</label>
                                        <textarea id="gal_detail" name="gal_detail" class="form-control form-control-sm"><?php if(!empty($row_Re_if->if_detail)){echo $row_Re_if->if_detail;}else{echo "";} ?></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>รูปภาพประกอบ</label><br>
                                        <input type="file" name="gal_p_photo[]" id="gal_p_photo[]" />
                                        <input type="button" value="+" onclick="JavaScript:fncCreateElement1();" />
                                        (กด + เพื่อเพิ่มรูปภาพ)<br/>
                                        <div id="mySpan1"></div>
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-sm btn-success" id="btn_insert"><i class="fas fa-save"></i> บันทึกเพิ่มแกลเลอรี่</button>
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
        $(document).on('click', '#btn_insert', function() {
            var $this = $('#dp_id');
            var $selectedOption = $this.find('option:selected');
            var dp_name = $selectedOption.data('name');

            $('#form_insert').validate({
                rules: {
                    gal_name: { required: true },
                    dp_id: { required: true },
                    gal_photo: { required: true,extension: "jpg|jpeg|png" },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_insert')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Gallery/gallery_insert_save"); ?>',
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