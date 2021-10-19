<div class="box_con_detail">
    <table class="tb_list" width="100%">
        <tr>
            <th width="50">ลำดับ</th>
            <th width="140">วันที่โพสต์</th>
            <th width="250">หน่วยงาน</th>
            <th>รายการผลการดำเนินงาน</th>
            <th width="50">แก้ไข</th>
            <th width="50">ลบ</th>
        </tr>
        <?php 
        if ($Re['total_ReOPR'] > 0){
            $number=$Re['page_start']-1;
            foreach ($Re['ReOPR'] as $row_ReOPR){
        ?>
        <tr>
            <td align="center"><?php echo ($number+=1); ?></td>
            <td align="center"><?php echo $this->B_Function_m->datethai($row_ReOPR->opr_date); ?></td>
            <td align="center"><?php echo $row_ReOPR->dp_name; ?></td>
            <td><?php echo $row_ReOPR->opr_name; ?></td>
            
            <td valign="top" class="text-center">
                <button type="button" class="btn_sm btn_yellow btn_edit" id="<?php echo $row_ReOPR->opr_id;?>"><i class="fas fa-pencil-alt"></i></button>
            </td>
            <td valign="top" class="text-center">
                <button class="btn_sm btn_red btn_dele" id="<?php echo $row_ReOPR->opr_id;?>"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
        <?php }}else{ ?>
            <tr><td colspan="6"><div class="alert_table"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการในขณะนี้</div></td></tr>
        <?php } ?>
    </table>           
</div>
<div class="box_con_footer">
    <div class="f_paging">
        <div class="f_left">
            <?php if($Re['total_ReOPR']>0){ ?>
                จำนวน <?php echo $Re['page_start']." - ".$Re['page_end']." จากทั้งหมด ".$Re['total_ReOPR'];?> รายการ
            <?php }else{ ?>
                จำนวน 0 รายการ
            <?php } ?>
        </div>
        <div class="f_right"><ul class="pagination"><?php echo $pagelinks ?></ul></div>
    </div>
</div>