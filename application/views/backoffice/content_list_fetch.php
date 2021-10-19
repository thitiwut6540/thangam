<table class="tb_list" width="100%">
    <tr>
        <th>ลำดับ</th>
        <th>ประเภท</th>
        <th>เรื่อง</th>
        <th>แสดง</th>
        <th align="center">แก้ไข</th>
        <th align="center">ลบ</th>
    </tr>
    <?php
    if ($Re['total_Re_c'] > 0){
    $number=0;
    foreach ($Re['Re_c'] as $row_Re_c){
    ?>
    <tr class="table-light">
        <td align="center"><?php echo ($number+=1); ?></td>
        <td><?php echo $row_Re_c->con_type_name; ?></td>
        <td><?php echo $row_Re_c->con_name; ?></td>
        <td align="center">
            <?php if($row_Re_c->con_show=='Show'){ ?>
                <button class="btn_sm btn_green btn_status" id="<?php echo $row_Re_c->con_id;?>" value="Idle"><i class="fas fa-check"></i></button>
            <?php }else{ ?>
                <button class="btn_sm btn_status" id="<?php echo $row_Re_c->con_id;?>" value="Show"><i class="fas fa-check"></i></button>
            <?php } ?>
        </td>
        <td align="center">
            <button type="button" class="btn_sm btn_yellow btn_edit" id="<?php echo $row_Re_c->con_id; ?>"><i class="fas fa-pencil-alt"></i></button>
        </td>
        <td align="center">
            <button class="btn_sm btn_red btn_dele" id="<?php echo $row_Re_c->con_id; ?>" value="<?php echo $row_Re_c->con_name; ?>"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>
    <?php } }else{ ?>
    <tr><td colspan="6"><div class="alert_table"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการเนื้อหาในขณะนี้</div></td></tr>
    <?php } ?>
</table>

<div class="row p-0 mt-2 mx-0 mb-2">
    <div class="col-12 col-md-6 col-lg-6 p-0">
        <?php if($Re['total_Re_c']>0){ ?>
            จำนวน <?php echo $Re['page_start']." - ".$Re['page_end']." จากทั้งหมด ".$Re['total_Re_c'];?> รายการ
        <?php }else{ ?>
            จำนวน 0 รายการ
        <?php } ?>
    </div>
    <div class="col-12 col-md-6 col-lg-6 p-0">
        <ul class="pagination"><?php echo $pagelinks ?></div>
    </div>
</div>