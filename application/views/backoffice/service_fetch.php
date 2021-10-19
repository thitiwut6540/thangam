<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table class="tb_list" width="100%">
                <tr>
                    <th width="50">ลำดับ</th>
                    <th width="80">เลขที่</th>
                    <th width="100">สถานะ</th>
                    <th width="120">วันที่ส่งเรื่อง</th>
                    <th width="">เรื่องขอรับบริการออนไลน์</th>
                    <th width="110">ดู/ดำเนินการ</th>
                    <th width="50">ลบ</th>
                </tr>
                <?php
                if ($Re['total_Re_s'] > 0){
                $number=$Re['page_start']-1;
                foreach ($Re['Re_s'] as $row_Re_s){
                ?>
                <tr>
                    <td valign="top" align="center"><?php echo ($number+=1); ?></td>
                    <td valign="top" align="center"><?php echo $row_Re_s->s_no; ?></td>
                    <td valign="top">
                        <?php if ($row_Re_s->s_status == 'ขอรับบริการ'){ ?>
                            <div class="alert alert-danger p-2 text-center m-0" role="alert"><?php echo $row_Re_s->s_status; ?></div>
                        <?php } else if($row_Re_s->s_status == 'รับเรื่อง'){ ?>
                            <div class="alert alert-warning p-2 text-center m-0" role="alert"><?php echo $row_Re_s->s_status; ?></div>
                        <?php } ?>
                    </td>
                    
                    <td valign="top" align="center"><?php echo $this->B_Function_m->datethai_sm_time($row_Re_s->s_date); ?></td>
                    <td valign="top">
                        ผู้ขอรับบริการ  <?php echo $row_Re_s->s_cus_name; ?>
                        <?php echo "<br>ประเภท : ".$row_Re_s->st_name; ?>
                        <?php echo "<br>เรื่อง : ".$row_Re_s->s_title; ?>
                    </td>
                    <td valign="top" align="center">
                        <a class="btn btn-sm btn-success p-2" href="<?php echo base_url('backoffice/ร้องเรียนร้องทุกข์/'.$status.'/รายละเอียด/').$row_Re_s->s_no; ?>"><i class="fas fa-search"></i> ดู/บันทึก</a>
                    </td>
                    <td valign="top" align="center">
                        <button class="btn btn-sm btn-danger btn_dele p-2" data-no="<?php echo $row_Re_s->s_no; ?>"><i class="fas fa-trash-alt fa-fw"></i></button>
                    </td>
                </tr>
                <?php }} else { ?>
                    <tr><td colspan="8"><div class="alert alert-danger mb-0" role="alert"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการขอรับบริการออนไลน์ในขณะนี้</div></td></tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12 col-md-6">
        <?php if($Re['total_Re_s']>0){ ?>
        แสดง <?php echo $Re['page_start']." - ".$Re['page_end']." จากทั้งหมด ".$Re['total_Re_s'];?> รายการ
        <?php } ?>
    </div>
    <div class="col-12 col-md-6"><ul class="pagination"><?php echo $pagelinks ?></ul></div>
</div>