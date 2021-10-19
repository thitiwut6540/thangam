<?php foreach ($Re['Re_q'] as $row_Re_q);?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/qa_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/ถามและตอบ');?>" >ถามและตอบ</a>
                <i class="fas fa-caret-right"></i> แก้ไขข้อมูล
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12"><i class="fas fa-question"></i> แก้ไขข้อมูลถามและตอบ</div>
                        </div>
                    </div>

                    <div class="box_con_detail">
                        <form id="form_edit" name="form_edit">
                            <div class="form-row">
                                <div class="form-group col-md-9">
                                    <label>คำถาม</label>
                                    <textarea id="qa_question" name="qa_question" class="form-control form-control-sm"><?php echo $row_Re_q->qa_question;?></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-9">
                                    <label>คำตอบ</label>
                                    <textarea id="qa_answer" name="qa_answer" class="form-control form-control-sm"><?php echo $row_Re_q->qa_answer;?></textarea>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-sm btn-success" id="btn_submit_edit"><i class="fas fa-save"></i> บันทึกแก้ไขข้อมูล</button> 
                            <input type="hidden" id="qa_id" name="qa_id" value="<?php echo $row_Re_q->qa_id;?>">
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
        editor = K.create('#qa_answer', {
            langType : 'en',
            minHeight:'100px',
            newlineTag:'br',
            items: ['source', '|', 'undo', 'redo', '|','cut', 'copy', 'paste','plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 
                'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript','superscript', 
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold','italic', 'underline', 'strikethrough', 
                'lineheight', 'removeformat', '|', 'image', 'multiimage', 'insertfile', 'table', 'hr',  'pagebreak', 'link', 'unlink','|', 'fullscreen', '/',],
        });
    });

    $(document).ready(function(){
        $(document).on('click', '#btn_submit_edit', function() {
            $('#form_edit').validate({
                rules: {
                    qa_question: { required: true },
                    qa_answer: { required: true },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#form_edit')[0]);
                    $.ajax({
                        url: '<?php echo base_url("B_Qa/qa_edit_save"); ?>',
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
                                                location.href = '<?php echo base_url("backoffice/ถามและตอบ");?>';
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
    });
</script>