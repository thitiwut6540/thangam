<table class="tb_list" width="100%">
    <tr>
        <th width="50">No.</th>
        <th>ประเภทเรื่องร้องเรียนร้องทุกข์</th>
        <th width="50" align="center">แก้ไข</th>
        <th width="50" align="center">ลบ</th>
    </tr>
    <?php
    if ($Re['total_Re_ct'] > 0){
    $number=0;
    foreach ($Re['Re_ct'] as $row_Re_ct){
    ?>
    <tr class="table-light">
        <td align="center"><?php echo ($number+=1); ?></td>
        <td><?php echo $row_Re_ct->ct_name; ?></td>
        <td align="center">
            <button type="button" class="btn btn-sm btn-warning btn_type_edit" data-id="<?php echo $row_Re_ct->ct_id; ?>"><i class="fas fa-pencil-alt"></i></button>
        </td>
        <td align="center">
            <button class="btn btn-sm btn-danger btn_type_dele" data-id="<?php echo $row_Re_ct->ct_id; ?>" data-name="<?php echo $row_Re_ct->ct_name; ?>"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>
    <?php } }else{ ?>
    <tr><td colspan="5"><div class="alert alert-danger mb-0" role="alert"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการในขณะนี้</div></td></tr>
    <?php } ?>
</table>