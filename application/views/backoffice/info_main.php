<?php foreach ($Re['Re_if'] as $row_Re_if); ?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/info_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row p-0 mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/ข้อมูลเทศบาล') ;?>">ข้อมูลเทศบาล</a>
                <i class="fas fa-caret-right"></i> <?php echo $topic; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header"><i class="fas fa-address-card"></i> <?php echo $topic; ?></div>
                    <div class="box_con_detail">
                        <div id="ajax_view">
                            <form id="form_insert" name="form_insert">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">หัวข้อ</label>
                                        <input type="text" id="if_header" name="if_header" class="form-control form-control-sm" value="<?php if(!empty($row_Re_if->if_header)){echo $row_Re_if->if_header;}else{echo $topic;} ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="">รายะเอียดเนื้อหา</label>
                                        <textarea id="if_detail" name="if_detail" class="<?php if($row_Re_if->if_header!='แผนที่'){echo 'detail';}?> form-control form-control-sm" <?php if($row_Re_if->if_header=='แผนที่'){echo 'rows="5"';}?>><?php echo $row_Re_if->if_detail; ?></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm" id="btn_submit"><i class="fas fa-save"></i> บันทึกแก้ไขข้อมูล</button>
                                <input type="hidden" id="if_id" name="if_id" value="<?php echo $row_Re_if->if_id; ?>">
                                <input type="hidden" id="if_insert" name="if_insert" value="<?php echo $_SESSION["".ANW_SS."us_name"]; ?>">
                                <input type="hidden" id="if_date" name="if_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
                  
                            </form>
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
        editor = K.create('.detail', {
            langType : 'en',
            minHeight:'500px',
            width:'780px',
            newlineTag:'br',
            items: ['source', '|', 'undo', 'redo', '|','cut', 'copy', 'paste','plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 
                'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript','superscript', 
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold','italic', 'underline', 'strikethrough', 
                'lineheight', 'removeformat', '|', 'image', 'multiimage', 'insertfile', 'table', 'hr',  'pagebreak', 'link', 'unlink','|', 'fullscreen', '/',],
        });
    });

    $(document).ready(function() {
        $(document).on('click', '#btn_submit', function() {
            $('#form_insert').validate({
                rules: {
                    if_header: { required: true },
                    if_detail: { required: true },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_insert')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Info/info_main_save"); ?>',
                        type: 'POST',
                        dataType: "json",
                        data: formData,
                        beforeSend: function() { $('#loader').show(); },
                        complete: function() { $('#loader').hide(); },
                        success: function(data) {
                            if(data.action=='Y'){
                                $.alert({
                                    icon: 'fas fa-check',
                                    title: 'สำเร็จ',
                                    content: data.output,
                                    type: 'green',
                                    typeAnimated: true,
                                    boxWidth: '420px',
                                    useBootstrap: false,
                                    onDestroy: function() {
                                        location.reload();
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
    })
</script>