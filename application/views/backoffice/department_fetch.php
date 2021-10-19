<table class="tb_list" width="100%">
    <tr>
        <th>ลำดับ</th>
        <th>เรียง</th>
        <th>ชื่อ<?php echo $topic; ?></th>
        <th>สถานที่ตั้ง</th>
        <th align="center">แก้ไข</th>
        <th align="center">ลบ</th>
    </tr>
    <?php
    if ($Re['total_Re_dp'] > 0){
    $number=0;
    foreach ($Re['Re_m'] as $row_Re_m);
    foreach ($Re['Re_dp'] as $row_Re_dp){
    ?>
    <tr>
        <td align="center"><?php echo $row_Re_dp->dp_no; ?></td>
        <td>
            <div align="center">
                <?php 
                $list=$row_Re_dp->dp_no;
                $id=$row_Re_dp->dp_id;
                if($Re['total_Re_dp']>=2){
                if($list==1){?>
                    <div align="center">
                        <i class="btn_down" data-id="<?php echo $id; ?>" data-no="<?php echo $list; ?>">
                        <i class="fas fa-chevron-circle-down text-danger fa-lg"></i></i>
                    </div>
                <?php 
                } if($list!=1 and $list!=$row_Re_m->dp_max){
                ?>
                    <div align="center">
                        <i class="btn_down" data-id="<?php echo $id; ?>" data-no="<?php echo $list; ?>">
                        <i class="fas fa-chevron-circle-down text-danger fa-lg"></i></i>
                        
                        <i class="btn_up" data-id="<?php echo $id; ?>" data-no="<?php echo $list; ?>">
                        <i class="fas fa-chevron-circle-up text-success fa-lg"></i></i>
                    </div>
                <?php 
                } if($list==$row_Re_m->dp_max AND $list>0){ 
                ?>
                    <div align="center">
                        <i class="btn_up" data-id="<?php echo $id; ?>" data-no="<?php echo $list; ?>">
                        <i class="fas fa-chevron-circle-up text-success fa-lg"></i></i>
                    </div>
                <?php } } ?>
            </div>
        </td>
        <td><?php echo $row_Re_dp->dp_name; ?></td>
        <td><?php echo $row_Re_dp->dp_add; ?></td>
        <td align="center">
            <a class="btn btn-sm btn-warning" href="<?php echo base_url('backoffice/'.$topic.'/edit/'.$row_Re_dp->dp_id.''); ?>"><i class="fas fa-pencil-alt"></i></a>
        </td>
        <td align="center">
            <button class="btn btn-sm btn-danger btn_delete" data-id="<?php echo $row_Re_dp->dp_id; ?>" data-name="<?php echo $row_Re_dp->dp_name; ?>"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>
    <?php } }else{ ?>
    <tr><td colspan="6"><div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการ <?php echo $topic; ?> ในขณะนี้</div></td></tr>
    <?php } ?>
</table>