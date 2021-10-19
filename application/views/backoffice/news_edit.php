<?php foreach ($Re['Re_n'] as $row_Re_n);?>
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
                <i class="fas fa-caret-right"></i> แก้ไขข้อมูล
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12"><i class="fas fa-newspaper"></i> แก้ไขข้อมูล<?php echo $type; ?></div>
                        </div>
                    </div>

                    <div class="box_con_detail">
                        <form id="form_edit" name="form_edit">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <?php if(!empty($row_Re_n->news_photo)){?>
                                        <button type="button" class="btn_fm btn_red btn_photo_dele" id="photo" data-id="<?php echo $row_Re_n->news_id;?>"><i class="fas fa-times"></i> ลบ</button><br>
                                        <img class="img-fluid" src="<?php echo base_url('public/images/news/'.$row_Re_n->news_photo);?>">
                                    <?php }else{?>
                                        <button type="button" class="btn_fm btn_red" disabled><i class="fas fa-times"></i> ลบ</button><br>
                                        <img class="img-fluid w-100" src="<?php echo base_url('public/images/nophoto.png');?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label> แสดง</label>
                                    <select name="news_status" id="news_status" class="form-control form-control-sm">
                                            <option value="">เลือก</option>
                                            <option value="Y" <?php if($row_Re_n->news_status == 'Y'){echo "selected";} ?>>แสดง</option>
                                            <option value="N" <?php if($row_Re_n->news_status == 'N'){echo "selected";} ?>>ไม่แสดง</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>ประเภทข่าวสาร</label>
                                    <input type="text" id="newstype_name" name="newstype_name" class="form-control form-control-sm" value="<?php echo $row_Re_n->newstype_name; ?>" readonly>
                                    <input type="hidden" id="newstype_id" name="newstype_id" value="<?php echo $row_Re_n->newstype_id; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>หน่วยงาน</label>
                                    <select name="dp_id" id="dp_id" class="form-control form-control-sm">
                                            <option value="">เลือกหน่วยงาน</option>
                                            <?php foreach ($ReDepart['Re_dp'] as $row_Re_dp){ ?>
                                            <option value="<?php echo $row_Re_dp->dp_id; ?>" <?php if($row_Re_dp->dp_id == $row_Re_n->dp_id){echo "selected";} ?>><?php echo $row_Re_dp->dp_name; ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-auto">
                                    <label>วันที่โพส</label><br>
                                    <input type="text" id="news_date_post" name="news_date_post" class="form-control form-control-sm dTH" value="<?php echo $this->B_Function_m->dateTha($row_Re_n->news_date); ?>">
                                </div>
                                <div class="form-group col-auto">
                                    <label>เวลาที่โพส</label><br>
                                    <input type="time" id="news_time" name="news_time" class="form-control form-control-sm" value="<?php echo $this->B_Function_m->dateTime($row_Re_n->news_date); ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="">หัวข้อข่าวสาร</label>
                                    <input type="text" id="news_name" name="news_name" class="form-control form-control-sm" value="<?php if(!empty($row_Re_n->news_name)){echo $row_Re_n->news_name;} ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-image"></i> เปลี่ยนภาพข่าวสาร </label>
                                    <input type="file" name="news_photo" id="news_photo" class="form-control form-control-sm"> 
                                    <input type="hidden" name="h_news_photo" id="h_news_photo" value="<?php echo $row_Re_n->news_photo; ?>"> 
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
                            <div class="form-row">
                                <?php foreach ($Re['Re_nf'] as $row_Re_nf){?>
                                    <div class="form-group col-4">
                                        <button type="button" class="btn_fm btn_red btn_file_dele" data-id="<?php echo $row_Re_nf->newsf_id;?>"><i class="fas fa-times"></i> ลบ</button>
                                        <i class="fas fa-paperclip"></i> <a target="_blank" href="<?php echo base_url('public/files/news/'.$row_Re_nf->newsf_name); ?>"><?php echo $row_Re_nf->newsf_name; ?></a>
                                    </div>
                                    <div class="form-group col-8">
                                        <?php echo $row_Re_nf->newsf_detail; ?>
                                    </div>
                                <?php } ?>
                            </div>


                            <div class="form-row"><div class="col-12"><i class="fab fa-youtube"></i> แนบ Youtube</div></div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <input type="text" name="nl_link[]" class="form-control form-control-sm" placeholder="วางลิงค์ Youtube">
                                    </div>
                                    <div class="form-group col-4">
                                        <button type="button" class="btn btn-sm btn-success" id="btn_add_youtube"><i class="fas fa-plus"></i></button> (กด + เพิ่ม Youtube)
                                    </div>
                                </div>
                                <div id="addYoutube"></div>
                            <div class="form-row">
                                <?php foreach ($Re['Re_nl'] as $row_Re_nl){?>
                                    <div class="form-group col-6">
                                        <?php
                                        $url = $row_Re_nl->nl_link;
                                        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches);
                                        $id = $matches[1];
                                        ?>
                                        <button type="button" class="btn_fm btn_red btn_youtube_dele" data-id="<?php echo $row_Re_nl->nl_id;?>"><i class="fas fa-times"></i> ลบ</button><br>
                                   
                                        <object>
                                            <param name="movie" value="https://www.youtube.com/v/<?php echo $id; ?>?version=3" />
                                            <param name="allowFullScreen" value="true" />
                                            <param name="allowScriptAccess" value="always" />
                                            <embed src="https://www.youtube.com/v/<?php echo $id; ?>?version=3" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always"> </embed>
                                        </object>
                                        
                                    </div>
                                <?php } ?>
                            </div>
                       
                            <div class="form-row">
                                <div class="form-group col-md-9">
                                    <label for="">รายะเอียดเนื้อหา</label>
                                    <textarea id="news_detail" name="news_detail" class="form-control form-control-sm"><?php if(!empty($row_Re_n->news_detail)){echo $row_Re_n->news_detail;}else{echo "";} ?></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success" id="btn_new_edit"><i class="fas fa-save"></i> บันทึกแก้ไขข้อมูล</button> 
                            <input type="hidden" id="news_id" name="news_id" value="<?php echo $row_Re_n->news_id;?>">
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
                $.datepicker.regional.th, 
                { 
                    dateFormat: "dd/mm/yy",
                    changeMonth:true,
                    changeYear:true,
                    yearRange:"-100:+10",
                }
            )
        );
    });

    $(document).ready(function(){
        $(document).on('click', '#btn_new_edit', function() {
            $.validator.addMethod('filesize', function(value, element, param) {
                return this.optional(element) || (element.files[0].size <= param) 
            });
            $('#form_edit').validate({
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
                    var formData = new FormData($('#form_edit')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_News/news_edit_save"); ?>',
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

        $(document).on('click', '.btn_photo_dele', function() {
            var news_id=$(this).attr('data-id');
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
                                url: '<?php echo base_url("B_News/news_dele_photo"); ?>',
                                method: "POST",
                                dataType: "json",
                                beforeSend: function() {$('#loader').show();},
                                complete: function() {$('#loader').hide();},
                                data: { news_id:news_id},
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

        $(document).on('click', '.btn_file_dele', function() {
            var newsf_id=$(this).attr('data-id');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรูปภาพ',
                content: 'ต้องการลบ ไฟล์เอกสาร หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function(){
                            $.ajax({
                                url: '<?php echo base_url("B_News/news_dele_file"); ?>',
                                method: "POST",
                                dataType: "json",
                                beforeSend: function() {$('#loader').show();},
                                complete: function() {$('#loader').hide();},
                                data: { newsf_id:newsf_id},
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

        $(document).on('click', '.btn_youtube_dele', function() {
            var nl_id=$(this).attr('data-id');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรูปภาพ',
                content: 'ต้องการลบ Youtube หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function(){
                            $.ajax({
                                url: '<?php echo base_url("B_News/news_dele_youtube"); ?>',
                                method: "POST",
                                dataType: "json",
                                beforeSend: function() {$('#loader').show();},
                                complete: function() {$('#loader').hide();},
                                data: { nl_id:nl_id},
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