<div class="box_con_detail">
    <table class="tb_list" width="100%">
        <tr>
            <th width="50">ลำดับ</th>
            <th width="150">ภาพสถานที่</th>
            <th width="250">ประเภท</th>
            <th width="">สถานที่สำคัญ</th>
            <th width="50">แก้ไข</th>
            <th width="50">ลบ</th>
        </tr>
        <?php 
        if ($Re['total_ReL'] > 0){
            $number=$Re['page_start']-1;
            foreach ($Re['ReL'] as $row_ReL){
        ?>
        <tr>
            <td class="text-center"><?php echo ($number+=1); ?></td>
            <td>
                <div class="img_4_3">
                    <div><img class="w-100" src="<?php echo base_url('public/images/landmark/'.$row_ReL->land_photo);?>"></div>
                </div>
            </td>
            <td valign="top" align="center"><?php echo $row_ReL->land_t_name; ?></td>
            <td valign="top">
                <b><?php echo $row_ReL->land_name; ?></b>
                <?php if(!empty($row_ReL->land_add)){echo "<br>".$row_ReL->land_add;} ?>
            </td>
            <td valign="top" class="text-center">
                <a type="button" class="btn btn-sm btn-warning btn_edit" href="<?php echo base_url('backoffice/สถานที่สำคัญ/edit/'.$row_ReL->land_id.'');?>"><i class="fas fa-pencil-alt"></i></a>
            </td>
            <td valign="top" class="text-center">
                <button class="btn btn-sm btn-danger btn_dele" data-id="<?php echo $row_ReL->land_id;?>" data-name="<?php echo $row_ReL->land_name;?>"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
        <?php }}else{ ?>
            <tr><td colspan="5"><div class="alert_table"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการในขณะนี้</div></td></tr>
        <?php } ?>
    </table>           
</div>
<div class="box_con_footer">
    <div class="f_paging">
        <div class="f_left">
            <?php if($Re['total_ReL']>0){ ?>
                จำนวน <?php echo $Re['page_start']." - ".$Re['page_end']." จากทั้งหมด ".$Re['total_ReL'];?> รายการ
            <?php } ?>
        </div>
        <div class="f_right"><ul class="pagination"><?php echo $pagelinks ?></ul></div>
    </div>
</div>