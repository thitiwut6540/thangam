<?php foreach ($Re['Re_c'] as $row_Re_c);?>
<div class="row">
    <div class="col-12">
        <div class="box_con">
            <div class="box_con_header">
                <div class="row">
                    <div class="col-8"><i class="fas fa-envelope text-danger fa-lg"></i> เรื่องที่แจ้ง ร้องเรียนร้องทุกข์</div>
                    <div class="col-4 text-right"></div>
                </div>
            </div>
            <div class="box_con_detail">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th width="150">หัวข้อ</th>
                                    <th width="">รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>สถานะ</td>
                                    <td>
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
                                </tr>
                                <tr>
                                    <td>เลขที่ร้องเรียน</td>
                                    <td><?php echo $row_Re_c->c_no;?></td>
                                </tr>
                                <tr>
                                    <td>วันที่แจ้ง</td>
                                    <td><?php echo $this->B_Function_m->datethai_time($row_Re_c->c_date);?></td>
                                </tr>
                                <tr>
                                    <td>ผู้แจ้งร้องเรียน</td>
                                    <td><?php echo $row_Re_c->c_cus_name;?></td>
                                </tr>
                                <tr>
                                    <td>ประเภทเรื่อง</td>
                                    <td><?php echo $row_Re_c->ct_name;?></td>
                                </tr>
                                <tr>
                                    <td>เรื่องที่แจ้ง</td>
                                    <td><?php echo $row_Re_c->c_title;?></td>
                                </tr>
                                <tr>
                                    <td>รายละเอียด</td>
                                    <td><?php echo $row_Re_c->c_detail;?></td>
                                </tr>
                                <tr>
                                    <td>ภาพประกอบ</td>
                                    <td>
                                        <?php if(!empty($row_Re_c->c_photo1)){ ?>
                                            <div class="row mb-3">
                                                <div class="col-12"><img class="img-fluid" src="<?php echo base_url('public/images/complain/'.$row_Re_c->c_photo1.''); ?>"></div>
                                            </div>
                                        <?php } ?> 
                                        <?php if(!empty($row_Re_c->c_photo2)){ ?>
                                            <div class="row mb-3">
                                                <div class="col-12"><img class="img-fluid" src="<?php echo base_url('public/images/complain/'.$row_Re_c->c_photo2.''); ?>"></div>
                                            </div>
                                        <?php } ?> 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <?php 
            if($Re['total_Re_ca'] > 0){ 
            foreach ($Re['Re_ca'] as $row_Re_ca){ 
        ?>

            <?php if($row_Re_ca->ca_status == 'รับเรื่อง'){  ?>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="box_con">
                            <div class="box_con_header">
                                <div class="row">
                                    <div class="col-8">
                                        <i class="fas fa-plus-circle text-warning fa-lg"></i> บันทึกรับเรื่องร้องเรียน
                                    </div>
                                    <div class="col-4 text-right">
                                        <?php if($row_Re_c->c_status=='รับเรื่อง'){ ?>
                                            <button type="button" class="btn btn-sm btn-warning btn_edit_action" data-id="<?php echo $row_Re_ca->ca_id;?>"><i class="fas fa-pencil-alt"></i> แก้ไข</button>
                                            <button type="button" class="btn btn-sm btn-danger btn_dele_action" data-id="<?php echo $row_Re_ca->c_id;?>" data-aid="<?php echo $row_Re_ca->ca_id;?>" data-status="<?php echo $row_Re_ca->c_status;?>"><i class="fas fa-trash-alt fa-fw"></i> ลบ</button>
                                        <?php } ?>  
                                    </div>
                                </div>
                            </div>
                            <div class="box_con_detail">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th width="150">หัวข้อ</th>
                                                    <th width="">รายละเอียด</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>วันที่รับเรื่อง</td>
                                                    <td><?php echo $this->B_Function_m->datethai_time($row_Re_ca->ca_date);?></td>
                                                </tr>
                                                <tr>
                                                    <td>ผู้รับร้องเรียน</td>
                                                    <td><?php echo $row_Re_ca->ca_receive;?></td>
                                                </tr>
                                                <tr class="text-danger">
                                                    <td>หมายเหตุ<br>(บันทึกภายใน)</td>
                                                    <td><?php echo $row_Re_ca->ca_comment;?></td>
                                                </tr>
                                                <tr>
                                                    <td>รายละเอียดดำเนินการ<br>(แสดงภายนอก)</td>
                                                    <td><?php echo $row_Re_ca->ca_public;?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if($row_Re_ca->ca_status == 'ดำเนินการ'){  ?>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="box_con">
                            <div class="box_con_header">
                                <div class="row">
                                    <div class="col-8"><i class="fas fa-clock text-primary fa-lg"></i> ดำเนินการ</div>
                                    <div class="col-4 text-right">
                                        <?php if($row_Re_c->c_status=='ดำเนินการ'){ ?>
                                            <button type="button" class="btn btn-sm btn-warning btn_edit_action" data-id="<?php echo $row_Re_ca->ca_id;?>"><i class="fas fa-pencil-alt"></i> แก้ไข</button>
                                            <button type="button" class="btn btn-sm btn-danger btn_dele_action" data-id="<?php echo $row_Re_ca->c_id;?>" data-aid="<?php echo $row_Re_ca->ca_id;?>" data-status="<?php echo $row_Re_ca->c_status;?>"><i class="fas fa-trash-alt fa-fw"></i> ลบ</button>
                                        <?php } ?>  
                                    </div>
                                </div>
                            </div>
                            <div class="box_con_detail">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th width="150">หัวข้อ</th>
                                                    <th width="">รายละเอียด</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>วันที่ดำเนินการ</td>
                                                    <td><?php echo $this->B_Function_m->datethai_time($row_Re_ca->ca_date);?></td>
                                                </tr>
                                                <tr>
                                                    <td>หน่วยงานรับผิดชอบ</td>
                                                    <td><?php echo $row_Re_ca->dp_name;?></td>
                                                </tr>
                                                <tr>
                                                    <td>ผู้บันทึกดำเนินการ</td>
                                                    <td><?php echo $row_Re_ca->ca_receive;?></td>
                                                </tr>
                                                <tr class="text-danger">
                                                    <td>หมายเหตุ<br>(บันทึกภายใน)</td>
                                                    <td><?php echo $row_Re_ca->ca_comment;?></td>
                                                </tr>
                                                <tr>
                                                    <td>รายละเอียดดำเนินการ<br>(แสดงภายนอก)</td>
                                                    <td><?php echo $row_Re_ca->ca_public;?></td>
                                                </tr>
                                                <?php if(!empty($row_Re_ca->ca_photo1) OR !empty($row_Re_ca->ca_photo2)){ ?>
                                                <tr>
                                                    <td>ภาพประกอบ</td>
                                                    <td>
                                                        <?php if(!empty($row_Re_ca->ca_photo1)){ ?>
                                                            <div class="row mb-3">
                                                                <div class="col-12"><img class="img-fluid" src="<?php echo base_url('public/images/complain/'.$row_Re_ca->ca_photo1.''); ?>"></div>
                                                            </div>
                                                        <?php } ?> 
                                                        <?php if(!empty($row_Re_ca->ca_photo2)){ ?>
                                                            <div class="row mb-3">
                                                                <div class="col-12"><img class="img-fluid" src="<?php echo base_url('public/images/complain/'.$row_Re_ca->ca_photo2.''); ?>"></div>
                                                            </div>
                                                        <?php } ?> 
                                                    </td>
                                                </tr>
                                                <?php } ?> 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if($row_Re_ca->ca_status == 'เสร็จสิ้น'){  ?>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="box_con">
                            <div class="box_con_header bg-success">
                                <div class="row">
                                    <div class="col-8"><i class="fas fa-check-circle"></i> ดำเนินการเสร็จสิ้น</div>
                                    <div class="col-4 text-right">
                                        <?php if($row_Re_c->c_status=='เสร็จสิ้น'){ ?>
                                            <button type="button" class="btn btn-sm btn-warning btn_edit_action" data-id="<?php echo $row_Re_ca->ca_id;?>"><i class="fas fa-pencil-alt"></i> แก้ไข</button>
                                            <button type="button" class="btn btn-sm btn-danger btn_dele_action" data-id="<?php echo $row_Re_ca->c_id;?>" data-aid="<?php echo $row_Re_ca->ca_id;?>" data-status="<?php echo $row_Re_ca->c_status;?>"><i class="fas fa-trash-alt fa-fw"></i> ลบ</button>
                                        <?php } ?>  
                                    </div>
                                </div>
                            </div>
                            <div class="box_con_detail">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th width="150">หัวข้อ</th>
                                                    <th width="">รายละเอียด</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>วันที่เสร็จสิ้น</td>
                                                    <td><?php echo $this->B_Function_m->datethai_time($row_Re_ca->ca_date);?></td>
                                                </tr>
                                                <tr>
                                                    <td>หน่วยงานรับผิดชอบ</td>
                                                    <td><?php echo $row_Re_ca->dp_name;?></td>
                                                </tr>
                                                <tr>
                                                    <td>ผู้รับดำเนินการ</td>
                                                    <td><?php echo $row_Re_ca->ca_receive;?></td>
                                                </tr>
                                                <tr>
                                                    <td>หมายเหตุ<br>(บันทึกภายใน)</td>
                                                    <td><?php echo $row_Re_ca->ca_comment;?></td>
                                                </tr>
                                                <tr>
                                                    <td>รายละเอียดดำเนินการ<br>(แสดงภายนอก)</td>
                                                    <td><?php echo $row_Re_ca->ca_public;?></td>
                                                </tr>
                                                <?php if(!empty($row_Re_ca->ca_photo1) AND !empty($row_Re_ca->ca_photo2)){ ?>
                                                <tr>
                                                    <td>ภาพประกอบ</td>
                                                    <td>
                                                        <?php if(!empty($row_Re_ca->ca_photo1)){ ?>
                                                            <div class="row mb-3">
                                                                <div class="col-12"><img class="img-fluid" src="<?php echo base_url('public/images/complain/'.$row_Re_ca->ca_photo1.''); ?>"></div>
                                                            </div>
                                                        <?php } ?> 
                                                        <?php if(!empty($row_Re_ca->ca_photo2)){ ?>
                                                            <div class="row mb-3">
                                                                <div class="col-12"><img class="img-fluid" src="<?php echo base_url('public/images/complain/'.$row_Re_ca->ca_photo2.''); ?>"></div>
                                                            </div>
                                                        <?php } ?> 
                                                    </td>
                                                </tr>
                                                <?php } ?> 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            <?php } ?>
            
        <?php }} ?>
    </div>
</div>