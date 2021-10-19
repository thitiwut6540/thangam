<style>
    .tb_box{min-width: 910px;}
    .tb_box th:nth-child(1), td:nth-child(1) { width: 50px; }
    .tb_box th:nth-child(2), td:nth-child(2) { width: 400px }
    .tb_box th:nth-child(3), td:nth-child(3) { }
    .tb_box th:nth-child(4), td:nth-child(4) { width: 50px; }
    .tb_box th:nth-child(5), td:nth-child(5) { width: 50px; }
</style>

<table class="tb_list" width="100%">
    <tr>
        <th>ลำดับ</th>
        <th>ชื่อหน่วยงานภายใน อบต.</th>
        <th>สถานที่ตั้ง</th>
        <th align="center">แก้ไข</th>
        <th align="center">ลบ</th>
    </tr>
    <?php
    if ($Re['total_Re_rl'] > 0){
    $number=0;
    foreach ($Re['Re_rl'] as $row_Re_rl){
    ?>
    <tr class="table-light">
        <td align="center"><?php echo ($number+=1); ?></td>
        <td><?php echo $row_Re_rl->dp_name; ?></td>
        <td><?php echo $row_Re_rl->dp_add; ?></td>
        <td align="center">
            <button type="button" class="btn_sm btn_yellow btn_edit" id="<?php echo $row_Re_rl->dp_id; ?>" ><i class="fas fa-pencil-alt"></i></button>
        </td>
        <td align="center">
            <button class="btn_sm btn_red btn_dele" id="<?php echo $row_Re_rl->dp_id; ?>" value="<?php echo $row_Re_rl->dp_photo; ?>"><i class="fas fa-trash-alt"></i></button>
            <input type="hidden" id="dptype" name="dptype" value="<?php echo $row_Re_rl->dptype_id; ?>">
        </td>
    </tr>
    <?php } }else{ ?>
    <tr><td colspan="5"><div class="alert_table"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการผู้ใช้งานในขณะนี้</div></td></tr>
    <?php } ?>
</table>

<!-- JS -->
<script src="<?php echo base_url('public/js/b_project.js');?>"></script>