<table class="tb_list" width="100%">
    <tr>
        <th width="50">No.</th>
        <th width="">รายการ LPA</th>
        <th width="50" align="center">ดู</th>
        <th width="50" align="center">ลบ</th>
    </tr>
    <?php
    if ($Re['total_Re_l'] > 0){
    $number=$Re['page_start']-1;
    foreach ($Re['Re_l'] as $row_Re_l){
    ?>
        <tr class="table-light">
            <td valign="top" align="center"><?php echo ($number+=1); ?></td>
            <td valign="top"><?php echo $row_Re_l->lpa_name; ?></td>
            <td valign="top" align="center">
                <a class="btn btn-sm btn-primary" href="<?php echo base_url('public/files/lpa/'.$row_Re_l->lpa_file.'');?>"><i class="fas fa-search"></i></a>
            </td>
            <td valign="top" align="center">
                <button class="btn btn-sm btn-danger btn_dele" data-id="<?php echo $row_Re_l->lpa_id; ?>" data-name="<?php echo $row_Re_l->lpa_name; ?>"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
    <?php } }else{ ?>
        <tr><td colspan="4"><div class="alert alert-danger mb-0" role="alert"><i class="fas fa-exclamation-triangle"></i> ไม่มีรายการในขณะนี้</div></td></tr>
    <?php } ?>
</table>

<div class="row p-0 mt-2 mx-0 mb-2">
    <div class="col-12 col-md-6 col-lg-6 p-0">
        <?php if($Re['total_Re_l']>0){ ?>
            จำนวน <?php echo $Re['page_start']." - ".$Re['page_end']." จากทั้งหมด ".$Re['total_Re_l'];?> รายการ
        <?php } ?>
    </div>
    <div class="col-12 col-md-6 col-lg-6 p-0">
        <ul class="pagination"><?php echo $pagelinks ?></div>
    </div>
</div>