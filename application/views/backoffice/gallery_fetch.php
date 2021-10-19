<table class="tb_list" width="100%">
    <tr>
        <th width='50'>ลำดับ</th>
        <th width='80'>อนุมัติ</th>
        <th width='320'>ภาพปก</th>
        <th width=''>รายละเอียด</th>
        <th width='60'>รูปภาพ</th>
        <th width='50' align="center">แก้ไข</th>
        <th width='50' align="center">ลบ</th>
    </tr>
    <?php
    if ($Re['total_Re_g'] > 0){
    $number=$Re['page_start']-1;
    foreach ($Re['Re_g'] as $row_Re_g){
    ?>
    <tr class="table-light">
        <td valign="top" align="center"><?php echo ($number+=1); ?></td>
        <td valign="top" align="center">
            <?php if($row_Re_g->gal_approve=="Y"){ ?>
                <i class="fas fa-check-circle text-success fa-2x"></i>
            <?php }else{ ?>
                <?php if($_SESSION[''.ANW_SS.'us_approve']=='Y'){?>
                <button class="btn btn-sm btn-primary btn_approve" data-id="<?php echo $row_Re_g->gal_id;?>" data-name="<?php echo $row_Re_g->gal_name;?>">อนุมัติ</button>
                <?php } else{ ?>
                    <button class="btn btn-sm btn-light" disabled>อนุมัติ</button>
                <?php } ?>
            <?php } ?>
        </td>
        <td valign="top"><div class="img_4_3"><div><img class="img-fluid" src="<?php echo base_url('public/images/gallery/'.$row_Re_g->gal_photo); ?>"></div></div></td>
        <td valign="top">
            <b><?php echo $row_Re_g->dp_name; ?></b><br>
            <?php echo $this->B_Function_m->datethai_time($row_Re_g->gal_date); ?><br>
            <?php echo "<br>Issue: ".$row_Re_g->gal_id.'<br> '.$row_Re_g->gal_name; ?>
        </td>
        <td valign="top" align="center">
            <?php echo number_format($row_Re_g->sum_galp);?>
        </td>
        <td valign="top" align="center">
            <a class="btn btn-sm btn-warning" href="<?php echo base_url('backoffice/แกลเลอรี่ภาพ/'.$depart_name.'/edit/'.$row_Re_g->gal_id.''); ?>" ><i class="fas fa-pencil-alt"></i></a>
        </td>
        <td valign="top" align="center">
            <button class="btn btn-sm btn-danger btn_dele" data-id="<?php echo $row_Re_g->gal_id; ?>" data-name="<?php echo $row_Re_g->gal_name; ?>"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>
    <?php } }else{ ?>
    <tr><td colspan="7"><div class="alert alert-danger mb-0" role="alert"><i class="fas fa-exclamation-triangle"></i> ไม่มีรายการแกลเลอรี่ภาพในขณะนี้</div></td></tr>
    <?php } ?>
</table>

<div class="row p-0 mt-2 mx-0 mb-2">
    <div class="col-12 col-md-6 col-lg-6 p-0">
        <?php if($Re['total_Re_g'] > 0){ ?>
            จำนวน <?php echo $Re['page_start']." - ".$Re['page_end']." จากทั้งหมด ".$Re['total_Re_g'];?> รายการ
        <?php } ?>
    </div>
    <div class="col-12 col-md-6 col-lg-6 p-0">
        <ul class="pagination"><?php echo $pagelinks ?></div>
    </div>
</div>