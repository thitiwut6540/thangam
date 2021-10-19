<table class="table table-bordered" width="100%">
    <thead>
        <tr class="table-secondary">
            <th colspan="4"><i class="fas fa-comments"></i> ข้อความแสดงความคิดเห็น</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if ($Re['total_Re_ct'] > 0){
            $p_no=0;
            foreach ($Re['Re_ct'] as $row_Re_ct){
        ?> 
            <tr>
                <td width="60" align="center" class="<?php if(!empty($row_Re_ct->wb_p_admin)){echo 'text-danger';} ?>"><?php echo ($p_no+=1); ?></td>
                <td align="left">
                    <?php if(!empty($row_Re_ct->wb_p_admin)){echo "<div class='text-danger'>ผู้ดูแล / เจ้าหน้าที่</div>";} ?>
                    <?php if(!empty($row_Re_ct->wb_p_admin)){echo "<div>ผู้โพสต์ : <span class='text-danger'>".$row_Re_ct->wb_p_admin."</span> วันที่ ".$this->B_Function_m->dateThai_time($row_Re_ct->wb_p_date)."</div>";} ?>

                    <?php if(!empty($row_Re_ct->wb_p_sent)){echo "<div>ผู้โพสต์ : ".$row_Re_ct->wb_p_sent." วันที่ ".$this->B_Function_m->dateThai_time($row_Re_ct->wb_p_date)."</div>";} ?>

                    <?php echo $row_Re_ct->wb_p_comment; ?>

                    <?php if(!empty($row_Re_ct->wb_p_photo)){ ?>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div><img class="img-fluid" src="<?php echo base_url('public/images/webboard/'.$row_Re_ct->wb_p_photo.''); ?>"><div>
                            </div>
                        </div>
                    <?php } ?>
                </td>
                <td width="60" align="center">
                    <?php if(!empty($row_Re_ct->wb_p_admin)){ ?>
                        <button type="button" class="btn btn-sm btn-warning btn_edit_comment" data-id="<?php echo $row_Re_ct->wb_p_id; ?>" data-tid="<?php echo $row_Re_ct->wb_t_id; ?>" data-sid="<?php echo $row_Re_ct->wb_s_id; ?>"><i class="fas fa-pencil-alt"></i></button>
                    <?php } else { ?>
                        <button type="button" class="btn btn-sm" disabled><i class="fas fa-pencil-alt"></i></button>
                    <?php } ?>
                </td>
                <td width="60" align="center">
                    <button class="btn btn-sm btn-danger btn_dele_comment" data-id="<?php echo $row_Re_ct->wb_p_id;?>" data-tid="<?php echo $row_Re_ct->wb_t_id;?>" data-sid="<?php echo $row_Re_ct->wb_s_id; ?>"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
        <?php }} else { ?>
            <tr>
                <td colspan="5"><div class="alert alert-danger mb-0" role="alert"><i class="fas fa-exclamation-triangle"></i> ไม่มีรายการแสดงความคิดเห็น</div></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<div class="f_paging">
    <div class="f_left">
        <?php if($Re['total_Re_ct']>0){ ?>
            ลำดับที่ <?php echo $Re['page_start']." - ".$Re['page_end']." จากทั้งหมด ".$Re['total_Re_ct'];?> รายการ
        <?php } ?>
    </div>
    <div class="f_right"><ul class="pagination"><?php echo $pagelinks ?></ul></div>
</div>