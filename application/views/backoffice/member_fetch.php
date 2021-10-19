<?php 
$Re = '';
for ($x = 1; $x <= 8; $x++) { 

     $Re = $this->B_Member_m->getGroup($x, $type_id, $depart_id);
     foreach ($Re['Re_mimx'] as $row_Re_mimx);
     
?>
        <div class="row m-0">
            <div class="col-12 pl-0"><b>กลุ่มลำดับขั้นที่ <?php echo $x; ?> จากทั้งหมด 8 กลุ่ม</b></div>
        </div>
        <table class="tb_list" width="100%">
            <tr>
                <th width="50">ลำดับ</th>
                <th width="60">เรียง</th>
                <th width="110">รูปภาพ</th>
                <th width="">ชื่อ-นามสกุล</th>
                <th width="220">ตำแหน่ง</th>
                <th width="200">การติดต่อ</th>
                <th width="50">แก้ไข</th>
                <th width="50">ลบ</th>
            </tr>
            <?php
            if ($Re['total_Re_m'] > 0){
            $number=0;
            foreach ($Re['Re_m'] as $row_Re_m){
                $editUrl='';
            ?>
            <tr class="table-light">
                <td valign="top" align="center"><?php echo $row_Re_m->mem_no; ?></td>
                <td valign="top">
                    <div class="text-center pt-1">
                        <?php
                        $list=$row_Re_m->mem_no;
                        $id=$row_Re_m->mem_id;
                        $mem_max = $row_Re_mimx->mem_max;

                        if($Re['total_Re_m']>=2){

                            if($list==1){
                            ?>
                                <div align="center">
                                    <i class="btn_down" data-id="<?php echo $id;?>" data-no="<?php echo $list;?>" data-type="<?php echo $row_Re_m->memtype_id; ?>" data-depart="<?php echo $row_Re_m->dp_id; ?>" data-group="<?php echo $x; ?>">
                                    <i class="fas fa-chevron-circle-down text-danger fa-lg"></i></i>
                                </div>
                            <?php } else if(($list!=1 and $list!=$mem_max) OR $list != $Re['total_Re_m']){ ?>
                                <div align="center">
                                    <i class="btn_down" data-id="<?php echo $id;?>" data-no="<?php echo $list;?>" data-type="<?php echo $row_Re_m->memtype_id; ?>" data-depart="<?php echo $row_Re_m->dp_id; ?>" data-group="<?php echo $x; ?>">
                                    <i class="fas fa-chevron-circle-down text-danger fa-lg"></i></i>
                                    
                                    <i class="btn_up" data-id="<?php echo $id;?>" data-no="<?php echo $list;?>" data-type="<?php echo $row_Re_m->memtype_id; ?>" data-depart="<?php echo $row_Re_m->dp_id; ?>" data-group="<?php echo $x; ?>">
                                    <i class="fas fa-chevron-circle-up text-success fa-lg"></i></i>
                                </div>
                            <?php } else if(($list==$mem_max AND $list>0) AND $list == $Re['total_Re_m']){ ?>
                                <div align="center">
                                    <i class="btn_up" data-id="<?php echo $id;?>" data-no="<?php echo $list;?>" data-type="<?php echo $row_Re_m->memtype_id; ?>" data-depart="<?php echo $row_Re_m->dp_id; ?>" data-group="<?php echo $x; ?>">
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
                    <?php if(!empty($row_Re_m->mem_photo)){ ?>
                        <img class="img-fluid" src="<?php echo base_url('public/images/member/'.$row_Re_m->mem_photo); ?>">
                    <?php } else { ?>
                        <img class="img-fluid" src="<?php echo base_url('public/images/member/nopeople.png'); ?>">
                    <?php } ?>
                </td>
                <td valign="top">
                    <?php echo $row_Re_m->mem_name; ?>
                    <?php if($row_Re_m->mem_president=='Y'){echo '<br>(นายกเทศมนตรี)';} ?>
                </td>
                <td valign="top">
                    <?php echo $row_Re_m->mem_position; ?><br>
                    <?php if(!empty($row_Re_m->dp_name)){echo $row_Re_m->dp_name;}else{echo '-';} ?><br>
                </td>
                <td valign="top">
                    สำนักงาน : <?php if(!empty($row_Re_m->mem_tel)){echo $row_Re_m->mem_tel;}else{echo '-';} ?><br>
                    โทรศัพท์ : <?php if(!empty($row_Re_m->mem_mobile)){echo $row_Re_m->mem_mobile;}else{echo '-';} ?><br>
                    อีเมลล์ : <?php if(!empty($row_Re_m->mem_email)){echo $row_Re_m->mem_email;}else{echo '-';} ?><br>
                </td>
                <td valign="top" align="center">
                    <?php if($type_id=='3'){$editUrl='backoffice/บุคลากร/'.$type_name.'/'.$depart_name.'/edit/'.$row_Re_m->mem_id.'';}else{$editUrl='backoffice/บุคลากร/'.$type_name.'/edit/'.$row_Re_m->mem_id.'';} ?>

                    <a class="btn btn-sm btn-warning btn_edit" href="<?php echo base_url($editUrl);?>"><i class="fas fa-pencil-alt"></i></a>

                </td>
                <td valign="top" align="center">
                    <button class="btn btn-sm btn-danger btn_dele" data-id="<?php echo $row_Re_m->mem_id;?>" data-name="<?php echo $row_Re_m->mem_name; ?>"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            <?php } }else{ ?>
            <tr><td colspan="8"><div class="alert alert-danger mb-0" role="alert"><i class="fas fa-exclamation-triangle"></i> ไม่มีรายการในขณะนี้</div></td></tr>
            <?php } ?>
        </table>
        <br><br><br>
<?php } ?>