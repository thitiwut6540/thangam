<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/news_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> ข่าวสาร
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/ข่าวสาร/'.$type.'');?>" ><?php echo $type;?></a>
                <i class="fas fa-caret-right"></i> เพิ่มข่าวสาร
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                    <div class="row">
                            <div class="col-12"><i class="fas fa-newspaper"></i> เพิ่ม<?php echo $type; ?></div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <?php if(!empty($type_id) AND $type_id>0){ ?>
                            <form id="form_insert" name="form_insert">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label> แสดง</label>
                                        <select name="news_status" id="news_status" class="form-control form-control-sm">
                                                <option value="">เลือก</option>
                                                <option value="Y">แสดง</option>
                                                <option value="N">ไม่แสดง</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>ประเภทข่าวสาร</label>
                                        <input type="text" id="newstype_name" name="newstype_name" class="form-control form-control-sm" value="<?php echo $type;?>" readonly>
                                        <input type="hidden" id="newstype_id" name="newstype_id" value="<?php echo $type_id;?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>หน่วยงาน</label>
                                        <select name="dp_id" id="dp_id" class="form-control form-control-sm">
                                                <option value="">เลือกหน่วยงาน</option>
                                                <?php foreach ($ReDepart['Re_dp'] as $row_Re_dp){ ?>
                                                <option value="<?php echo $row_Re_dp->dp_id; ?>"><?php echo $row_Re_dp->dp_name; ?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-auto">
                                        <label>วันที่โพส</label><br>
                                        <input type="text" id="news_date_post" name="news_date_post" class="form-control form-control-sm dTH" value="<?php echo $this->B_Function_m->dateTha(date("Y-m-d")); ?>">
                                    </div>
                                    <div class="form-group col-auto">
                                        <label>เวลาที่โพส</label><br>
                                        <input type="time" id="news_time" name="news_time" class="form-control form-control-sm" value="<?php echo date('H:i'); ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-9">
                                        <label>หัวข้อข่าวสาร</label>
                                        <input type="text" id="news_name" name="news_name" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label><i class="fas fa-image"></i> ภาพข่าวสาร </label>
                                        <input type="file" name="news_photo" id="news_photo" class="form-control form-control-sm"> 
                                    </div>
                                </div>
                            

                                <div class="form-row"><div class="col-12"><i class="fas fa-paperclip"></i> แนบไฟล์เอกสาร (PDF เท่านั้น)</div></div>
                                <div class="form-row">
                                    <div class="form-group col-4">
                                        <input type="file" name="newsf_name[]" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group col-4">
                                        <input type="text" name="newsf_detail[]" class="form-control form-control-sm" placeholder="ชื่อเรียกเอกสาร">
                                    </div>
                                    <div class="form-group col-4">
                                        <button type="button" class="btn btn-sm btn-success" id="btn_add_file"><i class="fas fa-plus"></i></button>
                                    (กด + เพิ่มไฟล์เอกสาร)
                                    </div>
                                </div>
                                <div id="addFile"></div>

                                <div class="form-row"><div class="col-12"><i class="fab fa-youtube"></i> แนบ Youtube</div></div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <input type="text" name="nl_link[]" class="form-control form-control-sm" placeholder="วางลิงค์ Youtube">
                                    </div>
                                    <div class="form-group col-4">
                                        <button type="button" class="btn btn-sm btn-success" id="btn_add_youtube"><i class="fas fa-plus"></i></button>
                                        (กด + เพิ่ม Youtube)
                                    </div>
                                </div>
                                <div id="addYoutube"></div>

                                <div class="form-row">
                                    <div class="form-group col-md-9">
                                        <label>รายะเอียดเนื้อหา</label>
                                        <textarea id="news_detail" name="news_detail" class="form-control form-control-sm"><?php if(!empty($row_Re_if->if_detail)){echo $row_Re_if->if_detail;}else{echo "";} ?></textarea>
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-sm btn-success" id="btn_new_insert"><i class="fas fa-save"></i> บันทึกเพิ่ม<?php echo $type;?></button>
                            </form>
                        <?php }else{ ?>
                            <div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> ไม่สามารถระบุประเภทข่าวสารได้</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#news_detail', {
            langType : 'en',
            minHeight:'300px',
            newlineTag:'br',
            items: ['source', '|', 'undo', 'redo', '|','cut', 'copy', 'paste','plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 
                'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript','superscript', 
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold','italic', 'underline', 'strikethrough', 
                'lineheight', 'removeformat', '|', 'image', 'multiimage', 'insertfile', 'table', 'hr',  'pagebreak', 'link', 'unlink','|', 'fullscreen', '/',],
        });
    });

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

    $(document).ready(function(){
        $(document).on('click', '#btn_new_insert', function() {
            $.validator.addMethod('filesize', function(value, element, param) {
                return this.optional(element) || (element.files[0].size <= param) 
            });
            $('#form_insert').validate({
                rules: {
                    news_status: { required: true },
                    dp_id: { required: true },
                    newstype_id: { required: true },
                    newstype_name: { required: true },
                    news_name: { required: true },
                    news_date_post: { required: true },
                    news_time: { required: true },
                    news_photo: { extension: "jpg|jpeg|png" },
                    'newsf_name[]':{ 
                        extension: "pdf", 
                        filesize: 10000000 // 10mb
                    },
                },
                messages: {
                    'newsf_name[]':{
                        extension: "ประเภทไฟล์รับเฉพาะ PDF เท่านั้น",
                        filesize: "ไฟล์ขนาดไม่เกิน 10 MB.",
                    }
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_insert')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_News/news_insert_save"); ?>',
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
                                                location.href = '<?php echo base_url("backoffice/ข่าวสาร/".$type);?>';
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

        $(document).on('click', '#btn_add_file', function() {
            $.ajax({
                url: '<?php echo base_url("B_News/news_add_file"); ?>',
                type: 'POST',
                dataType: "json",
                success: function(data) {
                    if(data.action=='Y'){
                        $("#addFile").after(data.output);
                    }
                }
            });
        });
        $(document).on('click', '.btn_dele_file', function() {
            var id=$(this).attr('data-id');
            $('#'+id+'').remove();
        });

        $(document).on('click', '#btn_add_youtube', function() {
            $.ajax({
                url: '<?php echo base_url("B_News/news_add_youtube"); ?>',
                type: 'POST',
                dataType: "json",
                success: function(data) {
                    if(data.action=='Y'){
                        $("#addYoutube").after(data.output);
                    }
                }
            });
        });
        $(document).on('click', '.btn_dele_youtube', function() {
            var id=$(this).attr('data-id');
            $('#'+id+'').remove();
        });
    });
</script>