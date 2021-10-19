<table class="tb_list" width="100%">
    <tr>
        <th width="50">No.</th>
        <th width="50">แสดง</th>
        <th width="60">อนุมัติ</th>
        <th width="200">ประเภท</th>
        <th width="">เรื่อง</th>
        <th width="50" align="center">แก้ไข</th>
        <th width="50" align="center">ลบ</th>
    </tr>
    <?php
    if ($Re['total_Re_s'] > 0){
    $number=$Re['page_start']-1;
    foreach ($Re['Re_s'] as $row_Re_s){
    ?>
        <tr class="table-light">
            <td valign="top" align="center"><?php echo ($number+=1); ?></td>
            <td valign="top" align="center">
                <?php if($row_Re_s->stt_status=="Y"){ ?>
                    <i class="fas fa-check-circle text-success fa-2x"></i>
                <?php }else{ ?>
                    <i class="fas fa-times-circle text-danger fa-2x"></i></i>
                <?php } ?>
            </td>
            <td valign="top" align="center">
                <?php if($row_Re_s->stt_approve=="Y"){ ?>
                    <?php if($_SESSION[''.ANW_SS.'us_approve']=='Y'){?>
                        <i class="fas fa-check-circle text-success fa-2x btn_approve" data-id="<?php echo $row_Re_s->stt_id;?>" data-status="N"></i>
                    <?php } else{ ?>
                        <i class="fas fa-check-circle text-success fa-2x"></i>
                    <?php } ?>
                <?php }else{ ?>
                    <?php if($_SESSION[''.ANW_SS.'us_approve']=='Y'){?>
                        <button class="btn btn-sm btn-primary btn_approve" data-id="<?php echo $row_Re_s->stt_id;?>" data-name="<?php echo $row_Re_s->stt_name;?>" data-status="Y">อนุมัติ</button>
                    <?php } else{ ?>
                        <button class="btn btn-sm btn-light" disabled>อนุมัติ</button>
                    <?php } ?>
                <?php } ?>
            </td>
            <td valign="top">
                <?php echo $row_Re_s->stt_t_name; ?>
            </td>
            <td valign="top">
                <?php echo "Issue : ".$row_Re_s->stt_id."<br>".$this->B_Function_m->datethai_time($row_Re_s->stt_date); ?><br>
                <?php echo $row_Re_s->stt_name; ?>
            </td>
            <td valign="top" align="center">
                <a class="btn btn-sm btn-warning" href="<?php echo base_url('backoffice/กฎหมายและระเบียบ/'.$type.'/edit/'.$row_Re_s->stt_id.'');?>" data-id="<?php echo $row_Re_s->stt_id; ?>"><i class="fas fa-pencil-alt"></i></ฟ>
            </td>
            <td valign="top" align="center">
                <button class="btn btn-sm btn-danger btn_dele" data-id="<?php echo $row_Re_s->stt_id; ?>" data-name="<?php echo $row_Re_s->stt_name; ?>"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
    <?php } }else{ ?>
        <tr><td colspan="7"><div class="alert alert-danger mb-0" role="alert"><i class="fas fa-exclamation-triangle"></i> ไม่มีรายการในขณะนี้</div></td></tr>
    <?php } ?>
</table>

<div class="row p-0 mt-2 mx-0 mb-2">
    <div class="col-12 col-md-6 col-lg-6 p-0">
        <?php if($Re['total_Re_s']>0){ ?>
            จำนวน <?php echo $Re['page_start']." - ".$Re['page_end']." จากทั้งหมด ".$Re['total_Re_s'];?> รายการ
        <?php } ?>
    </div>
    <div class="col-12 col-md-6 col-lg-6 p-0">
        <ul class="pagination"><?php echo $pagelinks ?></div>
    </div>
</div>