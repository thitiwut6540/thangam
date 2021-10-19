<?php foreach ($Re['Re_wp'] as $row_Re_wp); ?>
<div class="row m-0">
    <div class="col-12">
        <div class="form-row mt-4">
            <div class="form-group col-md-4">
                <?php 
                if(!empty($row_Re_wp->wb_p_admin)){$wb_p_sent_name=$row_Re_wp->wb_p_admin;}
                else if(!empty($row_Re_wp->wb_p_sent)){$wb_p_sent_name=$row_Re_wp->wb_p_sent;}
                ?>
                <label>ชื่อผู้โพสต์</label>
                <input type="text" class="form-control form-control-sm" value="<?php echo $wb_p_sent_name; ?>" readonly>
            </div>
            <div class="form-group col-md-4">
                <label>ชื่อผู้แก้ไขโพสต์</label>
                <input type="text" id="wb_p_admin" name="wb_p_admin" class="form-control form-control-sm" value="<?php echo $_SESSION[''.ANW_SS.'us_name']; ?>" readonly>
                <input type="hidden" id="wb_p_sent" name="wb_p_sent">
                <input type="hidden" id="wb_p_type" name="wb_p_type" value="S">
            </div>
        </div>
        <div class="form-row mt-1">
            <div class="form-group col-md-12">
                <label>ข้อความ (ขึ้นบรรทัดใหม่ให้บรรทัดติดกัน กด Shift+Enter)</label>
                <textarea id="wb_p_comment2" name="wb_p_comment2" class="form-control form-control-sm"><?php echo $row_Re_wp->wb_p_comment;?></textarea>
            </div>
        </div>
        <div class="form-row mt-1">
            <div class="form-group col-md-6">
                <label for="wb_p_file">อัพโหลดรูปภาพ</label>
                <input type="file" class="form-control form-control-sm" id="wb_p_photo" name="wb_p_photo">
                <input type="hidden" id="h_wb_p_photo" name="h_wb_p_photo" value="<?php echo $row_Re_wp->wb_p_photo;?>">
            </div>
        </div> 
        <?php if(!empty($row_Re_wp->wb_p_photo)){ ?>
            <div class="row">
                <div class="col-12 col-md-6">
                    <button type="button" class="btn_fm btn_red btn_comment_photo_dele" data-id="<?php echo $row_Re_wp->wb_p_id;?>" data-name="<?php echo $row_Re_wp->wb_p_photo;?>"><i class="fas fa-times"></i> ลบ</button><br>
                    <div><img class="img-fluid" src="<?php echo base_url('public/images/webboard/'.$row_Re_wp->wb_p_photo.''); ?>"><div>
                </div>
            </div>
        <?php } ?>
        <input type="hidden" id="wb_t_id" name="wb_t_id" value="<?php echo $row_Re_wp->wb_t_id; ?>">
        <input type="hidden" id="wb_s_id" name="wb_s_id" value="<?php echo $row_Re_wp->wb_s_id; ?>">
        <input type="hidden" id="wb_p_date" name="wb_p_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
        <input type="hidden" id="wb_p_id" name="wb_p_id" value="<?php echo $row_Re_wp->wb_p_id; ?>">
    </div>
</div>