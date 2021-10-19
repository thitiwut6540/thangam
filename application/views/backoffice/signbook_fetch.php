<table class="tb_list" width="100%">
    <tr>
        <th width="50">ลำดับ</th>
        <th width="50">ดู</th>
        <th width="130">วันที่สร้าง</th>
        <th width="">รายการสมุดลงนาม</th>
        <th width="80">จำนวน</th>
        <th width="50">แก้ไข</th>
        <th width="50">ลบ</th>
    </tr>
    <?php
    if ($Re['total_Re_sb'] > 0){
    $number=0;
    foreach ($Re['Re_sb'] as $row_Re_sb){
    ?>
    <tr>
        <td valign="top" align="center"><?php echo ($number+=1); ?></td>
        <td valign="top" align="center">
            <a class="btn btn-sm btn-primary" href="<?php echo base_url('backoffice/สมุดลงนาม/รายละเอียด/'.$row_Re_sb->sb_id.'');?>"><i class="fas fa-search"></i></a>
        </td>
        <td valign="top" align="center">
            <?php echo $this->B_Function_m->datethai($row_Re_sb->sb_date); ?>
        </td>
        <td valign="top">
            <?php echo $row_Re_sb->sb_name; ?>
        </td>
        <td valign="top" align="center">
            <?php echo number_format($row_Re_sb->sum_sbl); ?>
        </td>
        <td valign="top" align="center">
            <a class="btn btn-sm btn-warning btn_edit" href="<?php echo base_url('backoffice/สมุดลงนาม/edit/'.$row_Re_sb->sb_id.'');?>"><i class="fas fa-pencil-alt"></i></a>
        </td>
        <td valign="top" align="center">
            <button class="btn btn-sm btn-danger btn_dele" data-id="<?php echo $row_Re_sb->sb_id;?>" data-name="<?php echo $row_Re_sb->sb_name; ?>"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>
    <?php } }else{ ?>
    <tr><td colspan="8"><div class="alert alert-danger mb-0" role="alert"><i class="fas fa-exclamation-triangle"></i> ไม่มีรายการในขณะนี้</div></td></tr>
    <?php } ?>
</table>

<?php if($Re['total_Re_sb'] > 0){ ?>
<div class="row p-0 mt-2 mx-0 mb-2">
    <div class="col-12 col-md-6 col-lg-6 p-0">
        <?php if($Re['total_Re_sb']>0){ ?>
            จำนวน <?php echo $Re['page_start']." - ".$Re['page_end']." จากทั้งหมด ".$Re['total_Re_sb'];?> รายการ
        <?php } ?>
    </div>
    <div class="col-12 col-md-6 col-lg-6 p-0">
        <ul class="pagination"><?php echo $pagelinks ?></div>
    </div>
</div>
<?php } ?>