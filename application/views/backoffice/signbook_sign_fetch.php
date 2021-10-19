<table class="tb_list" width="100%">
    <tr>
        <th width="50">ลำดับ</th>
        <th width="150">วันที่</th>
        <th width="200">ผู้ลงนาม</th>
        <th width="">ข้อความ</th>
        <th width="50">ลบ</th>
    </tr>
    <?php
    if ($Re['total_Re_sbl'] > 0){
    $number=0;
    foreach ($Re['Re_sbl'] as $row_Re_sbl){
    ?>
    <tr>
        <td valign="top" align="center"><?php echo ($number+=1); ?></td>
        <td valign="top" align="center">
            <?php echo $this->B_Function_m->datethai_sm_time($row_Re_sbl->sbl_date); ?>
        </td>
        <td valign="top">
            <?php echo $row_Re_sbl->sbl_name; ?>
        </td>
        <td valign="top">
            <?php echo $row_Re_sbl->sbl_detail; ?>
        </td>
        <td valign="top" align="center">
            <button class="btn btn-sm btn-danger btn_dele" data-id="<?php echo $row_Re_sbl->sbl_id;?>" data-name="<?php echo $row_Re_sbl->sbl_name; ?>"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>
    <?php } }else{ ?>
    <tr><td colspan="5"><div class="alert alert-danger mb-0" role="alert"><i class="fas fa-exclamation-triangle"></i> ไม่มีรายการในขณะนี้</div></td></tr>
    <?php } ?>
</table>

<?php if($Re['total_Re_sbl'] > 0){ ?>
<div class="row p-0 mt-2 mx-0 mb-2">
    <div class="col-12 col-md-6 col-lg-6 p-0">
        <?php if($Re['total_Re_sbl']>0){ ?>
            ลำดับที่ <?php echo $Re['page_start']." - ".$Re['page_end']." จากทั้งหมด ".$Re['total_Re_sbl'];?> รายการ
        <?php } ?>
    </div>
    <div class="col-12 col-md-6 col-lg-6 p-0">
        <ul class="pagination"><?php echo $pagelinks ?></div>
    </div>
</div>
<?php } ?>