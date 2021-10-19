<table class="tb_list" width="100%">
    <tr>
        <th width="50">ลำดับ</th>
        <th width="60">เรียง</th>
        <th width="110">รูปภาพ</th>
        <th width="">ชื่อ-นามสกุล</th>
        <th width="400">ระยะเวลาดำรงตำแหน่ง</th>
        <th width="80">สมัยที่</th>
        <th width="50">แก้ไข</th>
        <th width="50">ลบ</th>
    </tr>
    <?php
    if ($Re['total_Re_h'] > 0){
    $number=0;
    foreach ($Re['Re_mimx'] as $row_Re_mimx);
    foreach ($Re['Re_h'] as $row_Re_h){
    ?>
    <tr>
        <td valign="top" align="center"><?php echo $row_Re_h->h_no; ?></td>
        <td valign="top">
            <div class="text-center pt-1">
                <?php
                $list=$row_Re_h->h_no;
                $id=$row_Re_h->h_id;
                $h_max = $row_Re_mimx->h_max;

                if($Re['total_Re_h']>=2){
                    if($list==1){
                    ?>
                        <div align="center">
                            <i class="btn_down" data-id="<?php echo $id;?>" data-no="<?php echo $list;?>" data-type="<?php echo $row_Re_h->h_type; ?>">
                            <i class="fas fa-chevron-circle-down text-danger fa-lg"></i></i>
                        </div>
                    <?php } else if(($list!=1 and $list!=$h_max) OR $list != $Re['total_Re_h']){ ?>
                        <div align="center">
                            <i class="btn_down" data-id="<?php echo $id;?>" data-no="<?php echo $list;?>" data-type="<?php echo $row_Re_h->h_type; ?>">
                            <i class="fas fa-chevron-circle-down text-danger fa-lg"></i></i>
                            
                            <i class="btn_up" data-id="<?php echo $id;?>" data-no="<?php echo $list;?>" data-type="<?php echo $row_Re_h->h_type; ?>">
                            <i class="fas fa-chevron-circle-up text-success fa-lg"></i></i>
                        </div>
                    <?php } else if(($list==$h_max AND $list>0) AND $list == $Re['total_Re_h']){ ?>
                        <div align="center">
                            <i class="btn_up" data-id="<?php echo $id;?>" data-no="<?php echo $list;?>" data-type="<?php echo $row_Re_h->h_type; ?>" >
                            <i class="fas fa-chevron-circle-up text-success fa-lg"></i></i>
                        </div>
                    <?php }  ?>
                    
                <?php } else {  ?>
                    <div align="center">
                        <i class="fas fa-minus-circle text-warning fa-lg"></i>
                    </div>
                <?php } ?>
            </div>
        </td>
        <td valign="top">
            <?php if(!empty($row_Re_h->h_photo)){ ?>
                <img class="img-fluid" src="<?php echo base_url('public/images/history/'.$row_Re_h->h_photo); ?>">
            <?php } else { ?>
                <img class="img-fluid" src="<?php echo base_url('public/images/member/nopeople.png'); ?>">
            <?php } ?>
        </td>
        <td valign="top">
            <?php echo $row_Re_h->h_name; ?>
            <?php if(!empty($row_Re_h->h_position)){echo "<br>ตำแหน่ง : ".$row_Re_h->h_position;} ?>
        </td>
        <td valign="top" align="center">
            <?php echo $this->B_Function_m->datethai($row_Re_h->h_start)." - ".$this->B_Function_m->datethai($row_Re_h->h_end); ?>
        </td>
        <td valign="top" align="center">
            <?php echo $row_Re_h->h_term; ?>
        </td>
        <td valign="top" align="center">
            <a class="btn btn-sm btn-warning btn_edit" href="<?php echo base_url('backoffice/ทําเนียบ/'.$h_type_name.'/edit/'.$row_Re_h->h_id.'');?>"><i class="fas fa-pencil-alt"></i></a>
        </td>
        <td valign="top" align="center">
            <button class="btn btn-sm btn-danger btn_dele" data-id="<?php echo $row_Re_h->h_id;?>" data-name="<?php echo $row_Re_h->h_name; ?>"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>
    <?php } }else{ ?>
    <tr><td colspan="8"><div class="alert alert-danger mb-0" role="alert"><i class="fas fa-exclamation-triangle"></i> ไม่มีรายการในขณะนี้</div></td></tr>
    <?php } ?>
</table>