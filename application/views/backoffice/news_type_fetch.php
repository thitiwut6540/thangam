<table class="tb_list" width="100%">
    <tr>
        <th width="50">No.</th>
        <th>ชื่อประเภทข่าวสาร</th>
        <th width="50" align="center">แก้ไข</th>
        <th width="50" align="center">ลบ</th>
    </tr>
    <?php
    if ($Re['total_Re_nt'] > 0){
    $number=0;
    foreach ($Re['Re_nt'] as $row_Re_nt){
    ?>
    <tr class="table-light">
        <td align="center"><?php echo ($number+=1); ?></td>
        <td><?php echo $row_Re_nt->newstype_name; ?></td>
        <td align="center">
            <button type="button" class="btn btn-sm btn-warning btn_type_edit" data-id="<?php echo $row_Re_nt->newstype_id; ?>"><i class="fas fa-pencil-alt"></i></button>
        </td>
        <td align="center">
            <button class="btn btn-sm btn-danger btn_type_dele" data-id="<?php echo $row_Re_nt->newstype_id; ?>" data-name="<?php echo $row_Re_nt->newstype_name; ?>"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>
    <?php } }else{ ?>
    <tr><td colspan="5"><div class="alert alert-danger mb-0" role="alert"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการในขณะนี้</div></td></tr>
    <?php } ?>
</table>