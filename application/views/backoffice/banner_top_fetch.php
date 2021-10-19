<table class="tb_list" width="100%">
    <tr>
        <th>ลำดับ</th>
        <th>เรียง</th>
        <th>รูปภาพประกาศ</th>
        <th>สถานะ</th>
        <th>แก้ไข</th>
        <th>ลบ</th>
    </tr>
    <?php 
    if ($Re['total_Re_b'] > 0){
    $number=0;
    foreach ($Re['Re_m'] as $row_Re_m);
    foreach ($Re['Re_b'] as $row_Re_b){
    ?>
    <tr class="table-light">
        <td><div align="center"><?php echo $row_Re_b->ban_no; ?></div></td>
        <td>
            <div align="center">
                <?php 
                $list=$row_Re_b->ban_no;
                $id=$row_Re_b->ban_id;
                if($Re['total_Re_b']>=2){
                if($list==1){?>
                    <div align="center">
                        <i class="btn_down" data-id="<?php echo $id; ?>" data-no="<?php echo $list; ?>">
                        <i class="fas fa-chevron-circle-down text-danger fa-lg"></i></i>
                    </div>
                <?php 
                } if($list!=1 and $list!=$row_Re_m->l_max){
                ?>
                    <div align="center">
                        <i class="btn_down" data-id="<?php echo $id; ?>" data-no="<?php echo $list; ?>">
                        <i class="fas fa-chevron-circle-down text-danger fa-lg"></i></i>
                        
                        <i class="btn_up" data-id="<?php echo $id; ?>" data-no="<?php echo $list; ?>">
                        <i class="fas fa-chevron-circle-up text-success fa-lg"></i></i>
                    </div>
                <?php 
                } if($list==$row_Re_m->l_max AND $list>0){ 
                ?>
                    <div align="center">
                        <i class="btn_up" data-id="<?php echo $id; ?>" data-no="<?php echo $list; ?>">
                        <i class="fas fa-chevron-circle-up text-success fa-lg"></i></i>
                    </div>
                <?php } } ?>
            </div>
        </td>
        <td>
            <div class="img_box">
                <img class="img-fluid" src="<?php echo base_url('public/images/banner_top/'.$row_Re_b->ban_photo);?>">
            </div>
            <?php echo "<br>".$row_Re_b->ban_name; ?>
            <?php if($row_Re_b->ban_url!=""){ 
                echo "<br>URL : <a href=\"".$row_Re_b->ban_url."\">".$row_Re_b->ban_url."</a>";
            }?>
        </td>
        <td align="center">
            <?php if($row_Re_b->ban_status=="1"){ ?>
                <button class="btn btn-sm btn-success btn_status" data-id="<?php echo $row_Re_b->ban_id; ?>" value="0"><i class="fas fa-check"></i></button>
            <?php }else{ ?>
                <button class="btn btn-sm btn-light btn_status" data-id="<?php echo $row_Re_b->ban_id; ?>" value="1"><i class="fas fa-check"></i></button>
            <?php } ?>
        </td>
        <td align="center">
            <a class="btn btn-sm btn-warning" href="<?php echo base_url('backoffice/ภาพประกาศ/edit/'.$row_Re_b->ban_id.''); ?>"><i class="fas fa-pencil-alt"></i></a>
        </td>
        <td align="center">
            <button class="btn btn-sm btn-danger btn_dele" data-id="<?php echo $row_Re_b->ban_id; ?>" data-name="<?php echo $row_Re_b->ban_name; ?>"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>
    <?php } }else{ ?>
    <tr><td colspan="6"><div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการในขณะนี้</div></td></tr>
    <?php } ?>
</table>