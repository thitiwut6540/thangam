<table class="tb_list" width="100%">
    <tr>
        <th>ลำดับ</th>
        <th>หน่วยงาน</th>
        <th>หัวข้อ ข้อมูล</th>
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
        <td><?php echo $row_Re_c->dp_name; ?></td>
        <td><?php echo $row_Re_c->con_type_name; ?></td>
        <td align="center">
            <button type="button" class="btn_sm btn_yellow btn_type_edit" id="<?php echo $row_Re_c->con_type_id; ?>"><i class="fas fa-pencil-alt"></i></button>
        </td>
        <td align="center">
            <button class="btn_sm btn_red btn_type_dele" id="<?php echo $row_Re_c->con_type_id; ?>" value="<?php echo $row_Re_c->con_type_name; ?>"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>
    <?php } }else{ ?>
    <tr><td colspan="5"><div class="alert_table"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการผู้ใช้งานในขณะนี้</div></td></tr>
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