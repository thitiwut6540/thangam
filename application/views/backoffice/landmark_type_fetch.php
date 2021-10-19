<table class="tb_list" width="100%">
    <tr>
        <th width="50">ลำดับ</th>
        <th width="80">การแสดง</th>
        <th>ชื่อประเภทสถานที่สำคัญ</th>
        <th width="50">แก้ไข</th>
        <th width="50">ลบ</th>
    </tr>
    <?php 
    if ($Re['total_Re_lt'] > 0){
        foreach ($Re['Re_m'] as $row_Re_m);
        foreach ($Re['Re_lt'] as $row_Re_lt){
    ?>
    <tr>
        <td class="text-center"><?php echo $row_Re_lt->land_t_no; ?></td>
        <td>
            <div align="center">
                <?php
                $list=$row_Re_lt->land_t_no;
                $id=$row_Re_lt->land_t_id;
                if($Re['total_Re_lt']>=2){
                if($list==1){
                ?>
                    <div align="center">
                        <i class="btn_down" data-id="<?php echo $id;?>" data-no="<?php echo $list;?>">
                        <i class="fas fa-chevron-circle-down text-danger fa-lg"></i></i>
                    </div>
                <?php } if($list!=1 and $list!=$row_Re_m->land_t_max){ ?>
                    <div align="center">
                        <i class="btn_down" data-id="<?php echo $id;?>" data-no="<?php echo $list;?>">
                        <i class="fas fa-chevron-circle-down text-danger fa-lg"></i></i>
                        
                        <i class="btn_up" data-id="<?php echo $id;?>" data-no="<?php echo $list;?>">
                        <i class="fas fa-chevron-circle-up text-success fa-lg"></i></i>
                    </div>
                <?php } if($list==$row_Re_m->land_t_max AND $list>0){ ?>
                    <div align="center">
                        <i class="btn_up" data-id="<?php echo $id;?>" data-no="<?php echo $list;?>">
                        <i class="fas fa-chevron-circle-up text-success fa-lg"></i></i>
                    </div>
                <?php } }else{ ?>
                    <div align="center"><i class="fas fa-chevron-circle-down text-muted fa-lg"></i></div>
                <?php } ?>
            </div>
        </td>
        <td><?php echo $row_Re_lt->land_t_name; ?></td>
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-warning btn_type_edit" data-id="<?php echo $row_Re_lt->land_t_id;?>"><i class="fas fa-pencil-alt"></i></button>
        </td>
        <td class="text-center">
            <button class="btn btn-sm btn_red btn_type_dele" data-id="<?php echo $row_Re_lt->land_t_id;?>" data-name="<?php echo $row_Re_lt->land_t_name;?>"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>
    <?php }}else{ ?>
        <tr><td colspan="5"><div class="alert_table"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการในขณะนี้</div></td></tr>
    <?php } ?>
</table>