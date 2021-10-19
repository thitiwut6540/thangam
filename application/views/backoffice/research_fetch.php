<table class="tb_list" width="100%">
    <tr>
        <th width="50">ลำดับ</th>
        <th width="140">วันที่ประเมิน</th>
        <th width="200">ชื่อ - นามสกุล</th>
        <th width="">ที่อยู่</th>
        <th width="50">ดู</th>
        <th width="50">ลบ</th>
    </tr>
    <?php
    if ($Re['total_Re_rm'] > 0){
    $number=$Re['page_start']-1;
    foreach ($Re['Re_rm'] as $row_Re_rm){
    ?>
    <tr class="table-light">
        <td valign="top" align="center"><?php echo ($number+=1); ?></td>
        <td valign="top" align="center"><?php echo $this->B_Function_m->datethai_sm_time($row_Re_rm->rs_date); ?></td>
        <td valign="top"><?php echo $row_Re_rm->rs_name; ?></td>
        <td valign="top"><?php echo $row_Re_rm->rs_add; ?></td>
        <td valign="top" align="center">
            <a class="btn btn-sm btn-primary p-2" href="<?php echo base_url('backoffice/ผลสำรวจความพึงพอใจ/รายการผู้กรอกแบบสำรวจ/').$row_Re_rm->rs_id; ?>"><i class="fas fa-search"></i></a>
        </td>
        <td valign="top" align="center">
            <button class="btn btn-sm btn-danger btn_dele p-2" data-id="<?php echo $row_Re_rm->rs_id; ?>" data-name="<?php echo $row_Re_rm->rs_name; ?>"><i class="fas fa-trash-alt fa-fw"></i></button>
        </td>
    </tr>
    <?php } }else{ ?>
    <tr><td colspan="6"><div class="alert alert-danger mb-0" role="alert"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการผู้ใช้งานในขณะนี้</div></td></tr>
    <?php } ?>
</table>

<div class="row p-0 mt-2 mx-0 mb-2">
    <div class="col-12 col-md-6 col-lg-6 p-0">
        <?php if($Re['total_Re_rm']>0){ ?>
            จำนวน <?php echo $Re['page_start']." - ".$Re['page_end']." จากทั้งหมด ".$Re['total_Re_rm'];?> รายการ
        <?php }else{ ?>
            จำนวน 0 รายการ
        <?php } ?>
    </div>
    <div class="col-12 col-md-6 col-lg-6 p-0">
        <ul class="pagination"><?php echo $pagelinks ?></div>
    </div>
</div>