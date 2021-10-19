<?php foreach ($Re['Re_wt'] as $row_Re_wt); ?>
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
                <i class="fas fa-caret-right"></i> Topic 
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12">
                                <i class="fas fa-comment fa-flip-horizontal"></i> Webboard
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <div class="row">
                            <?php if ($Re['total_Re_wt'] > 0){?>
                                <div class="col-12 p-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table" width="100%">
                                                <tr>
                                                    <td valign="top" width="100" align="center">ID<div><?php echo $row_Re_wt->wb_t_id; ?></div></td>
                                                    <td valign="top" width="120">
                                                        <div class="row">
                                                            <div class="col-12 img_1_1">
                                                                <div>
                                                                <?php if(!empty($row_Re_wt->wb_t_photo)){ ?>
                                                                    <img class="img-fluid" src="<?php echo base_url('public/images/webboard/'.$row_Re_wt->wb_t_photo.''); ?>">
                                                                <?php } else { ?>
                                                                    <img class="img-fluid" src="<?php echo base_url('public/images/nophoto.png'); ?>">
                                                                <?php } ?>
                                                                <div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td valign="top">
                                                        ชื่อหัวข้อ<br>
                                                        <?php echo $this->B_Function_m->datethai_time($row_Re_wt->wb_t_date); ?>
                                                        <div><?php echo $row_Re_wt->wb_t_title; ?></div>
                                                    </td>
                                                    <td valign="top" width="120" align="center">
                                                        หัวข้อย่อย<br>
                                                        <?php $Re_sub = $this->B_Webboard_m->getSubTotal($row_Re_wt->wb_t_id)?> 
                                                        <h5><?php echo $Re_sub['total_Re_sb']; ?></h5>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr>
                                        </div>
                                    </div>
                                    
                                    <?php if ($Re['total_Re_ws'] > 0){ ?>
                                        <div class="row">
                                            <div class="col-12 mb-4">
                                                <table class="table table-bordered mb-0" width="100%">
                                                    <thead>
                                                        <tr class="table-secondary">
                                                            <th colspan="4"><i class="fas fa-list"></i> รายการหัวข้อย่อย</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td width="60" align="center">ลำดับ</td>
                                                            <td align="left">หัวข้อย่อย</td>
                                                            <td width="80" align="center">โพสต์</td>
                                                            <td width="110" align="center">เข้า</td>
                                                        </tr>
                                                        <?php $no1=0;foreach ($Re['Re_ws'] as $row_Re_ws){?> 
                                                            <tr>
                                                                <td align="center"><?php echo ($no1+=1); ?></td>
                                                                <td align="left"><?php echo $row_Re_ws->wb_s_title; ?></td>
                                                                <td align="center"><?php echo number_format($row_Re_ws->wb_p_count);?></td>
                                                                <td align="center">
                                                                    <a class="btn btn-sm btn-success" href="<?php echo base_url('backoffice/webboard/topic/'.$row_Re_ws->wb_t_id.'/subtopics/'.$row_Re_ws->wb_s_id.''); ?>"><i class="fas fa-sign-in-alt"></i> เข้าดู</a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php if($row_Re_wt->wb_t_comment == 'Y'){ ?>
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
                                    <?php } ?>

                                    <?php if($row_Re_wt->wb_t_comment == 'Y'){ ?>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="border mt-4 p-4 bg-light">
                                                    <div class="row">
                                                        <div class="col-12"><b><i class="far fa-comment"></i> แสดงความคิดเห็น หัวข้อหลัก</b></div>
                                                    </div>
                                                    <form id="form_topic_comment" name="form_topic_comment">
                                                        <div class="form-row mt-4">
                                                            <div class="form-group col-md-7">
                                                                <label>ชื่อผู้โพสต์</label>
                                                                <input type="text" id="wb_p_admin" name="wb_p_admin" class="form-control form-control-sm" value="<?php echo $_SESSION[''.ANW_SS.'us_name']; ?>" readonly>
                                                                <input type="hidden" id="wb_p_sent" name="wb_p_sent">
                                                                <input type="hidden" id="wb_p_type" name="wb_p_type" value="T">
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
                                                            <input type="hidden" id="wb_t_id" name="wb_t_id" value="<?php echo $row_Re_wt->wb_t_id; ?>">
                                                            <input type="hidden" id="wb_s_id" name="wb_s_id">
                                                            <input type="hidden" id="wb_p_date" name="wb_p_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
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

        var wp_t_id = '<?php echo $row_Re_wt->wb_t_id; ?>';
        comment_topic_list(wp_t_id);

        function comment_topic_list(id){
            $.ajax({
                url: '<?php echo base_url("B_Webboard/comment_topic_list"); ?>',
                method: "POST",
	            data: {wb_t_id: id},
                beforeSend: function() {$('#loader').show();},
                complete: function() {$('#loader').hide();},
                success: function(data) {
                    $('#ajax_comment').html(data);
                }
            });
        }
        
        $(document).on('click', '#btn_topic_post', function() {
            var wb_t_id = $('#wb_t_id').val();

            $('#form_topic_comment').validate({
                rules: {
                    wb_p_sent:{ required: true },
                    wb_p_comment:{ required: true },
                },
                errorPlacement: function(error,element) {return true;},
                submitHandler: function(form) {
                    var formData = new FormData($('#form_topic_comment')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Webboard/comment_topic_save"); ?>',
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
                                        comment_topic_list(wp_t_id);
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
                                url: "<?php echo base_url("B_Webboard/comment_topic_delete"); ?>",
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
                                                comment_topic_list(wp_t_id);
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
            var wb_p_id = $(this).attr('data-id');
            $('#modal_box').html('<form id="modal_box_form" name="modal_box_form"></form>');
            $.ajax({
                url: "<?php echo base_url("B_Webboard/comment_topic_edit"); ?>",
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
                                        url: '<?php echo base_url("B_Webboard/comment_topic_edit_save"); ?>',
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
                                                        comment_topic_list(wp_t_id);
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
                                    comment_topic_list(wp_t_id);
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
                                url: '<?php echo base_url("B_Webboard/comment_topic_delete_photo"); ?>',
                                method: "POST",
                                dataType: "json",
                                beforeSend: function() {$('#loader').show();},
                                complete: function() {$('#loader').hide();},
                                data: { wb_p_id:wb_p_id,photo:photo,},
                                success: function(data) {
                                    if (data.action == 'Y') {
                                        $.ajax({
                                            url: "<?php echo base_url("B_Webboard/comment_topic_edit"); ?>",
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