<table class="tb_list" width="100%">
    <tr>
        <th width="50">ลำดับ</th>
        <th width="500">คำถาม</th>
        <th width="">ตำตอบ</th>
        <th width="50" align="center">แก้ไข</th>
        <th width="50" align="center">ลบ</th>
    </tr>
    <?php
    if ($Re['total_Re_q'] > 0){
    $number=$Re['page_start']-1;
    foreach ($Re['Re_q'] as $row_Re_q){
    ?>
        <tr class="table-light">
            <td valign="top" align="center"><?php echo ($number+=1); ?></td>
            <td valign="top"><?php echo $row_Re_q->qa_question; ?></td>
            <td valign="top"><?php echo $row_Re_q->qa_answer; ?></td>
            <td valign="top" align="center">
                <a class="btn btn-sm btn-warning" href="<?php echo base_url('backoffice/ถามและตอบ/edit/'.$row_Re_q->qa_id.'');?>" data-id="<?php echo $row_Re_q->qa_id; ?>"><i class="fas fa-pencil-alt"></i></ฟ>
            </td>
            <td valign="top" align="center">
                <button class="btn btn-sm btn-danger btn_dele" data-id="<?php echo $row_Re_q->qa_id; ?>" data-name="<?php echo $row_Re_q->qa_question; ?>"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
    <?php } }else{ ?>
        <tr><td colspan="5"><div class="alert alert-danger mb-0" role="alert"><i class="fas fa-exclamation-triangle"></i> ไม่มีรายการในขณะนี้</div></td></tr>
    <?php } ?>
</table>

<div class="row p-0 mt-2 mx-0 mb-2">
    <div class="col-12 col-md-6 col-lg-6 p-0">
        <?php if($Re['total_Re_q']>0){ ?>
            จำนวน <?php echo $Re['page_start']." - ".$Re['page_end']." จากทั้งหมด ".$Re['total_Re_q'];?> รายการ
        <?php } ?>
    </div>
    <div class="col-12 col-md-6 col-lg-6 p-0">
        <ul class="pagination"><?php echo $pagelinks ?></div>
    </div>
</div>