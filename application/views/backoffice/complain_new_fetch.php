<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table class="tb_list" width="100%">
                <tr>
                    <th width="50">ลำดับ</th>
                    <th width="80">เลขที่</th>
                    <th width="100">สถานะ</th>
                    <th width="120">วันที่แจ้ง</th>
                    <th width="">เรื่องร้องเรียน</th>
                    <th width="110">ดู/ดำเนินการ</th>
                    <th width="50">ลบ</th>
                </tr>
                <?php
                if ($Re['total_Re_c'] > 0){
                $number=$Re['page_start']-1;
                foreach ($Re['Re_c'] as $row_Re_c){
                ?>
                <tr>
                    <td valign="top" align="center"><?php echo ($number+=1); ?></td>
                    <td valign="top" align="center"><?php echo $row_Re_c->c_no; ?></td>
                    <td valign="top">
                        <?php if ($row_Re_c->c_status == 'แจ้งเรื่อง'){ ?>
                            <div class="alert alert-danger p-2 text-center m-0" role="alert"><?php echo $row_Re_c->c_status; ?></div>
                        <?php } else if($row_Re_c->c_status == 'รับเรื่อง'){ ?>
                            <div class="alert alert-warning p-2 text-center m-0" role="alert"><?php echo $row_Re_c->c_status; ?></div>
                        <?php } else if ($row_Re_c->c_status == 'ดำเนินการ'){ ?>
                            <div class="alert alert-primary p-2 text-center m-0" role="alert"><?php echo $row_Re_c->c_status; ?></div>
                        <?php } else if ($row_Re_c->c_status == 'เสร็จสิ้น'){ ?>
                            <div class="alert alert-success p-2 text-center m-0" role="alert"><?php echo $row_Re_c->c_status; ?></div>
                        <?php } else if ($row_Re_c->c_status == 'ไม่รับเรื่อง'){ ?>
                            <div class="alert alert-secondary p-2 text-center m-0" role="alert"><?php echo $row_Re_c->c_status; ?></div>
                        <?php } ?>
                    </td>
                    
                    <td valign="top" align="center"><?php echo $this->B_Function_m->datethai_sm_time($row_Re_c->c_date); ?></td>
                    <td valign="top">
                        ผู้ร้องเรียน  <?php echo $row_Re_c->c_cus_name; ?>
                        <?php echo "<br>ประเภท : ".$row_Re_c->ct_name; ?>
                        <?php echo "<br>เรื่อง : ".$row_Re_c->c_title; ?>
                    </td>
                    <td valign="top" align="center">
                        <a class="btn btn-sm btn-success p-2" href="<?php echo base_url('backoffice/ร้องเรียนร้องทุกข์/'.$status.'/ดำเนินการ/').$row_Re_c->c_no; ?>"><i class="fas fa-search"></i> ดู/บันทึก</a>
                    </td>
                    <td valign="top" align="center">
                        <button class="btn btn-sm btn-danger btn_dele p-2" data-no="<?php echo $row_Re_c->c_no; ?>"><i class="fas fa-trash-alt fa-fw"></i></button>
                    </td>
                </tr>
                <?php }} else { ?>
                    <tr><td colspan="8"><div class="alert alert-danger mb-0" role="alert"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการ แจ้งร้องเรียนร้องทุกข์ ในขณะนี้</div></td></tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12 col-md-6">
        <?php if($Re['total_Re_c']>0){ ?>
        แสดง <?php echo $Re['page_start']." - ".$Re['page_end']." จากทั้งหมด ".$Re['total_Re_c'];?> รายการ
        <?php } ?>
    </div>
    <div class="col-12 col-md-6"><ul class="pagination"><?php echo $pagelinks ?></ul></div>
</div>