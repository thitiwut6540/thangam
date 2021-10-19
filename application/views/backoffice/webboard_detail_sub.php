<?php foreach ($Re['Re_ws'] as $row_Re_ws); ?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/webboard_menu.php');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/webboard');?>">Webboard</a>
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/webboard/topic/'.$row_Re_ws->wb_t_id.'');?>">Topic</a>
                <i class="fas fa-caret-right"></i> Subtopics 
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12">
                                <i class="fas fa-comment fa-flip-horizontal"></i> Webboard | Topic
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <div class="row">
                            <?php if ($Re['total_Re_ws'] > 0){?>
                                <div class="col-12 p-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <?php echo "".$this->B_Function_m->datethai_time($row_Re_ws->wb_t_date); ?>
                                            <h5><?php echo $row_Re_ws->wb_t_title; ?></h5>
                                            <hr>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            รายการหัวข้อย่อย<br>
                                            <?php echo "".$this->B_Function_m->datethai_time($row_Re_ws->wb_s_date); ?>
                                            <div><?php echo $row_Re_ws->wb_s_title; ?></div>
                                            <hr>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive mx-0" id="ajax_comment">
                                                <table class="table table-bordered" width="100%">
                                                    <thead>
                                                        <tr class="table-secondary">
                                                            <th colspan="3"><i class="fas fa-comments"></i> ข้อความแสดงความคิดเห็น หัวข้อหลัก</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="5"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="border mt-4 p-4 bg-light">
                                                <div class="row">
                                                    <div class="col-12"><b><i class="far fa-comment"></i> แสดงความคิดเห็น</b></div>
                                                </div>
                                                <form id="form_topic_comment" name="form_topic_comment">
                                                    <div class="form-row mt-4">
                                                        <div class="form-group col-md-7">
                                                            <label>ชื่อผู้โพสต์</label>
                                                            <input type="text" id="wb_p_admin" name="wb_p_admin" class="form-control form-control-sm" value="<?php echo $_SESSION[''.ANW_SS.'us_name']; ?>" readonly>
                                                            <input type="hidden" id="wb_p_sent" name="wb_p_sent">
                                                            <input type="hidden" id="wb_p_type" name="wb_p_type" value="S">
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-1">
                                                        <div class="form-group col-md-12">
                                                            <label for="wb_p_comment">ข้อความ</label>
                                                            <textarea id="wb_p_comment" name="wb_p_comment" class="textEdit form-control form-control-sm"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-1">
                                                        <div class="form-group col-md-6">
                                                            <label for="wb_p_file">อัพโหลดรูปภาพ</label>
                                                            <input type="file" class="form-control form-control-sm" id="wb_p_photo" name="wb_p_photo">
                                                        </div>
                                                    </div> 
                                                    <div class="row">
                                                        <div class="col-12 text-center">
                                                            <hr>
                                                            <button type="submit" class="btn btn-success text-white btn-sm" id="btn_topic_post"><i class="fas fa-save"></i> โพสต์ส่งข้อความ</button>
                                                        </div>
                                                        <input type="hidden" id="wb_t_id" name="wb_t_id" value="<?php echo $row_Re_ws->wb_t_id; ?>">
                                                        <input type="hidden" id="wb_s_id" name="wb_s_id" value="<?php echo $row_Re_ws->wb_s_id; ?>">
                                                        <input type="hidden" id="wb_p_date" name="wb_p_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal_box" style="display:none;"><form id="modal_box_form" name="modal_box_form"></form></div>
<script>
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('.textEdit', {
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

        var wb_t_id = '<?php echo $row_Re_ws->wb_t_id; ?>';
        var wb_s_id = '<?php echo $row_Re_ws->wb_s_id; ?>';

        comment_list();
        function comment_list(){
            $.ajax({
                url: '<?php echo base_url("B_Webboard/comment_sub_list"); ?>',
                method: "POST",
	            data: {wb_t_id: wb_t_id,wb_s_id: wb_s_id},
                beforeSend: function() {$('#loader').show();},
                complete: function() {$('#loader').hide();},
                success: function(data) {
                    $('#ajax_comment').html(data);
                }
            });
        }
        
        $(document).on('click', '#btn_topic_post', function() {
            var wb_t_id = $('#wb_t_id').val();
            var wb_s_id = $('#wb_s_id').val();
            $('#form_topic_comment').validate({
                rules: {
                    wb_p_sent:{ required: true },
                    wb_p_comment:{ required: true },
                },
                errorPlacement: function(error,element) {return true;},
                submitHandler: function(form) {
                    var formData = new FormData($('#form_topic_comment')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Webboard/comment_sub_save"); ?>',
                        type: 'POST',
                        async: true,
                        dataType: "json",
                        data: formData,
                        beforeSend: function() {$('#loader').show();},
                        complete: function() {$('#loader').hide();},
                        success: function(data) {
                            if (data.action == 'Y') {
                                $.alert({
                                    icon: 'fas fa-check',
                                    title: 'สำเร็จ',
                                    content: data.output,
                                    type: 'green',
                                    typeAnimated: true,
                                    boxWidth: '420px',
                                    useBootstrap: false,
                                    onDestroy: function() {
                                        comment_list();
                                    }
                                });
                            }else {
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

        $(document).on('click', '.btn_dele_comment', function() {
            var wb_p_id = $(this).attr('data-id');
            var wb_t_id = $(this).attr('data-tid');
            var wb_s_id = $(this).attr('data-sid');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรายการ',
                content: 'ต้องการลบโพสต์หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: "<?php echo base_url("B_Webboard/comment_sub_delete"); ?>",
                                method: "POST",
                                dataType: "json",
                                data:  {wb_p_id: wb_p_id},
                                success: function(data) {
                                    if (data.action == 'Y') {
                                        $.alert({
                                            icon: 'fas fa-check',
                                            title: 'สำเร็จ',
                                            content: data.output,
                                            type: 'green',
                                            typeAnimated: true,
                                            boxWidth: '420px',
                                            useBootstrap: false,
                                            onDestroy: function() {
                                                comment_list();
                                            }
                                        });
                                    } else {
                                        $.alert({
                                            icon: 'fas fa-exclamation-triangle',
                                            title: 'สำเร็จ',
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

        $(document).on('click', '.btn_edit_comment', function() {
            var wb_t_id = $(this).attr('data-tid');
            var wb_s_id = $(this).attr('data-sid');
            var wb_p_id = $(this).attr('data-id');
            $('#modal_box').html('<form id="modal_box_form" name="modal_box_form"></form>');
            $.ajax({
                url: "<?php echo base_url("B_Webboard/comment_sub_edit"); ?>",
                method: "POST",
                data: {wb_p_id:wb_p_id},
                success: function (data) {
                    $('#modal_box_form').html(data);
                    $('#modal_box').dialog({
                        draggable: true,
                        closeOnEscape: true,
                        title: "แก้ไชโพสต์",
                        modal: true,
                        width: 1000,
                        height: 550,
                        open : function(event, ui) {
							KindEditor.create('#wb_p_comment2', {
                                newlineTag:'br',
                            });
						},
                        buttons: [
                            {
                                text: "บันทึกแก้ไข",
                                id: "btn-1",
                                click: function(){ 
                                    $('#modal_box').dialog("close");
                                    KindEditor.remove('#wb_p_comment2');
                                    var formData2 = new FormData($('#modal_box_form')[0]);
                                    $.ajax({
                                        url: '<?php echo base_url("B_Webboard/comment_sub_edit_save"); ?>',
                                        method: "POST",
                                        dataType: "json",
                                        async: true,
                                        data: formData2,
                                        beforeSend: function() { $('#loader').show(); },
                                        complete: function() { $('#loader').hide(); },
                                        success: function(data) {
                                            if(data.action=='Y'){
                                                $('#modal_box').dialog("close");
                                                $.alert({
                                                    icon: 'fas fa-check',
                                                    title: 'สำเร็จ',
                                                    content: data.output,
                                                    type: 'green',
                                                    typeAnimated: true,
                                                    boxWidth: '420px',
                                                    useBootstrap: false,
                                                    onDestroy: function() {
                                                        comment_list(wb_t_id,wb_s_id);
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
                                }
                            }, 
                            {
                                text: "ปิด",
                                id: "btn-2",
                                click: function(){            
                                    $('#modal_box').dialog("close");
                                    comment_list(wb_t_id,wb_s_id);
                                }
                            }  
                        ]
                    });
                }
            });
        });

        $(document).on('click', '.btn_comment_photo_dele', function() {
            var wb_p_id=$(this).attr('data-id');
            var photo=$(this).attr('data-name');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรูปภาพ',
                content: 'ต้องการลบ รูปภาพโพสต์ หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function(){
                            $.ajax({
                                url: '<?php echo base_url("B_Webboard/comment_sub_delete_photo"); ?>',
                                method: "POST",
                                dataType: "json",
                                beforeSend: function() {$('#loader').show();},
                                complete: function() {$('#loader').hide();},
                                data: { wb_p_id:wb_p_id,photo:photo,},
                                success: function(data) {
                                    if (data.action == 'Y') {
                                        $.ajax({
                                            url: "<?php echo base_url("B_Webboard/comment_sub_edit"); ?>",
                                            method: "POST",
                                            data: {wb_p_id:wb_p_id},
                                            success: function (data) {
                                                $('#modal_box_form').html(data);
                                            }
                                        });
                                    } else {
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