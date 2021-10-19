<?php 
foreach ($Re['Re_if'] as $row_Re_if); 
?>

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
            <textarea id="if_detail" name="if_detail" class="form-control form-control-sm"><?php if(!empty($row_Re_if->if_detail)){echo $row_Re_if->if_detail;}else{echo "";} ?></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-sm" id="btn_submit"><i class="fas fa-save"></i> บันทึก</button>
    <input type="hidden" id="if_id" name="if_id" value="<?php if(!empty($row_Re_if->if_id)){echo $row_Re_if->if_id;}else{echo "";} ?>">
    <input type="hidden" id="if_insert" name="if_insert" value="<?php echo $_SESSION["SS_TL_us_name"]; ?>">
    <input type="hidden" id="if_date" name="if_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
    <input type="hidden" id="if_status" name="if_status" value="N">
    <input type="hidden" id="action" name="action" value="info-submit">
</form>

<!-- JS -->
<script src="<?php echo base_url('public/js/b_info.js');?>"></script>
<script>

    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#if_detail', {
            langType : 'en',
            minHight:'300px',
            //items: ['source', 'fullscreen'],
            items: ['source', '|', 'undo', 'redo', '|','cut', 'copy', 'paste','plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 
                'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript','superscript', 
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold','italic', 'underline', 'strikethrough', 
                'lineheight', 'removeformat', '|', 'image', 'multiimage', 'insertfile', 'table', 'hr',  'pagebreak', 'link', 'unlink','|', 'fullscreen', '/',],
        });
    });

</script>