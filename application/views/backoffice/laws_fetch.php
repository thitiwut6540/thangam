<?php 
if($action == 'Listtype'){
?>
    <table class="tb_list" width="100%">
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อประเภทกฎหมายและระเบียบ</th>
            <th align="center">แก้ไข</th>
            <th align="center">ลบ</th>
        </tr>
        <?php
        if ($Re['total_Re_chk'] > 0){
        $number=0;
        foreach ($Re['Re_lt'] as $row_Re_lt){
        ?>
        <tr>
            <td align="center"><?php echo ($number+=1); ?></td>
            <td><?php echo $row_Re_lt->lt_name; ?></td>
            <td align="center">
                <button type="button" class="btn_sm btn_yellow btn_type_edit" id="<?php echo $row_Re_lt->lt_id; ?>" value="<?php echo $row_Re_lt->lt_name; ?>"><i class="fas fa-pencil-alt"></i></button>
            </td>
            <td align="center">
                <button class="btn_sm btn_red btn_type_dele" id="<?php echo $row_Re_lt->lt_id; ?>" value="<?php echo $row_Re_lt->lt_name; ?>"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
        <?php }} else { ?>
            <tr><td colspan="9"><div class="alert_table"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการ กฎหมายและระเบียบ ในขณะนี้</div></td></tr>
        <?php } ?>
    </table>

    <div class="row p-0 mt-2 mx-0 mb-2">
        <div class="col-12 col-md-6 col-lg-6 p-0">
            <?php if($Re['total_Re_chk']>0){ ?>
                จำนวน <?php echo $Re['page_start']." - ".$Re['page_end']." จากทั้งหมด ".$Re['total_Re_chk'];?> รายการ
            <?php }else{ ?>
                จำนวน 0 รายการ
            <?php } ?>
        </div>
        <div class="col-12 col-md-6 col-lg-6 p-0">
            <ul class="pagination"><?php echo $pagelinks ?></div>
        </div>
    </div>

<?php } ?>

<?php 
if($action == 'List'){
?>
    <table class="tb_list" width="100%">
        <tr>
            <th>ลำดับ</th>
            <th>ประเภท</th>
            <th>กฎหมายและระเบียบ</th>
            <th align="center">แก้ไข</th>
            <th align="center">ลบ</th>
        </tr>
        <?php
        if ($Re['total_Re_chk'] > 0){
        $number=0;
        foreach ($Re['Re_l'] as $row_Re_l){
        ?>
        <tr>
            <td align="center"><?php echo ($number+=1); ?></td>
            <td align="center"><?php echo $row_Re_l->lt_name; ?></td>
            <td><?php echo $row_Re_l->l_list; ?></td>
            <td align="center">
                <button type="button" class="btn_sm btn_yellow btn_edit" id="<?php echo $row_Re_l->l_id; ?>" value="<?php echo $row_Re_l->l_list; ?>"><i class="fas fa-pencil-alt"></i></button>
            </td>
            <td align="center">
                <button class="btn_sm btn_red btn_dele" id="<?php echo $row_Re_l->l_id; ?>" value="<?php echo $row_Re_l->l_list; ?>"><i class="fas fa-trash-alt"></i></button>
                <input type="hidden" id="lt_id" name="lt_id" value="<?php echo $row_Re_l->lt_id; ?>">
                <input type="hidden" id="lt_name" name="lt_name" value="<?php echo $row_Re_l->lt_name; ?>">
            </td>
        </tr>
        <?php }} else { ?>
            <tr><td colspan="9"><div class="alert_table"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการ กฎหมายและระเบียบ ในขณะนี้</div></td></tr>
        <?php } ?>
    </table>

    <div class="row p-0 mt-2 mx-0 mb-2">
        <div class="col-12 col-md-6 col-lg-6 p-0">
            <?php if($Re['total_Re_chk']>0){ ?>
                จำนวน <?php echo $Re['page_start']." - ".$Re['page_end']." จากทั้งหมด ".$Re['total_Re_chk'];?> รายการ
            <?php }else{ ?>
                จำนวน 0 รายการ
            <?php } ?>
        </div>
        <div class="col-12 col-md-6 col-lg-6 p-0">
            <ul class="pagination"><?php echo $pagelinks ?></div>
        </div>
    </div>
<?php } ?>

