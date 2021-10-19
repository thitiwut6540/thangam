<div class="box_con_detail">
    <table class="tb_list" width="100%">
        <tr>
            <th width="50">ลำดับ</th>
            <th width="50">แสดง</th>
            <th width="60">อนุมัติ</th>
            <th width="300">ภาพสินค้า</th>
            <th width="">รายการ</th>
            <th width="120">ราคา</th>
            <th width="50" align="center">แก้ไข</th>
            <th width="50" align="center">ลบ</th>
        </tr>
        <?php
        if ($Re['total_Re_ot'] > 0){
        $number=$Re['page_start']-1;
        foreach ($Re['Re_ot'] as $row_Re_ot){
        ?>
        <tr>
            <td valign="top" align="center"><?php echo ($number+=1); ?></td>
            <td valign="top" align="center">
                <?php if($row_Re_ot->otop_status=="Y"){ ?>
                    <i class="fas fa-check-circle text-success fa-2x"></i>
                <?php }else{ ?>
                    <i class="fas fa-times-circle text-danger fa-2x"></i></i>
                <?php } ?>
            </td>
            <td valign="top" align="center">
                <?php if($row_Re_ot->otop_approve=="Y"){ ?>
                    <?php if($_SESSION[''.ANW_SS.'us_approve']=='Y'){?>
                        <i class="fas fa-check-circle text-success fa-2x btn_approve" data-id="<?php echo $row_Re_ot->otop_id;?>" data-status="N"></i>
                    <?php } else{ ?>
                        <i class="fas fa-check-circle text-success fa-2x"></i>
                    <?php } ?>
                <?php }else{ ?>
                    <?php if($_SESSION[''.ANW_SS.'us_approve']=='Y'){?>
                        <button class="btn btn-sm btn-primary btn_approve" data-id="<?php echo $row_Re_ot->otop_id;?>" data-name="<?php echo $row_Re_ot->otop_name;?>" data-status="Y">อนุมัติ</button>
                    <?php } else{ ?>
                        <button class="btn btn-sm btn-light" disabled>อนุมัติ</button>
                    <?php } ?>
                <?php } ?>
            </td>
            <td valign="top" >
                <div class="img_4_3"><div><img class="w-100" src="<?php echo base_url('public/images/otop/'.$row_Re_ot->otop_photo.''); ?>"></div></div>
            </td>
            <td valign="top"><?php echo $row_Re_ot->otop_name; ?></td>
            <td valign="top" align="center"><?php echo $row_Re_ot->otop_price; ?></td>
            <td valign="top" align="center">
                <a class="btn btn-sm btn-warning" href="<?php echo base_url('backoffice/สินค้าโอทอป/edit/'.$row_Re_ot->otop_id.''); ?>"><i class="fas fa-pencil-alt"></i></a>
            </td>
            <td valign="top" align="center">
                <button class="btn btn-sm btn-danger btn_dele" data-id="<?php echo $row_Re_ot->otop_id; ?>" data-name="<?php echo $row_Re_ot->otop_name; ?>"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
        <?php }} else { ?>
            <tr><td colspan="9"><div class="alert_table"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการ เอกสารบริการประชาชน ในขณะนี้</div></td></tr>
        <?php } ?>
    </table>
</div>
<div class="box_con_footer">
    <div class="f_paging">
        <div class="f_left">
            <?php if($Re['total_Re_ot']>0){ ?>
                จำนวน <?php echo $Re['page_start']." - ".$Re['page_end']." จากทั้งหมด ".$Re['total_Re_ot'];?> รายการ
            <?php } ?>
        </div>
        <div class="f_right"><ul class="pagination"><?php echo $pagelinks ?></ul></div>
    </div>
</div>