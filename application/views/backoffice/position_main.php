<style>
    .tb_box{min-width: 910px;}
    .tb_box th:nth-child(1), td:nth-child(1) { width: 50px; }
    .tb_box th:nth-child(2), td:nth-child(2) { width: 100px; }
    .tb_box th:nth-child(3), td:nth-child(3) { width: 150px; }
    .tb_box th:nth-child(4), td:nth-child(4) { width: 150px; }
    .tb_box th:nth-child(5), td:nth-child(5) {  }
    .tb_box th:nth-child(6), td:nth-child(6) { width: 100px; }
    .tb_box th:nth-child(7), td:nth-child(7) { width: 50px; }
    .tb_box th:nth-child(8), td:nth-child(8) { width: 50px; }
</style>

<div id="header"><?php $this->load->view('backoffice/_header');?></div>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/position_menu');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('Backoffice/dashboard');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <?php echo $topic; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-8"><?php echo $topic; ?></div>
                            <div class="col-4 text-right">
                                <a class="btn btn_green" id="btn_insert" href="<?php echo base_url('Backoffice/ตำแหน่ง/'.$topic.'/เพิ่ม'); ?>"><i class="fas fa-plus"></i> เพิ่ม</a>
                                <input type="hidden" id="topic" name="topic" value="<?php echo $topic; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <div id="modal_success" class="alert_success" style="display:none"></div>
                        <div id="modal_error" class="alert_error" style="display:none"></div>
                        <div class="table-responsive">
                            <div id="ajax_view" class="tb_box">
                                <table class="tb_list" width="100%">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ตำแหน่ง</th>
                                        <th>ประเภท</th>
                                        <th>หน่วยงาน</th>
                                        <th>ตำแหน่ง</th>
                                        <th>ลำดับ</th>
                                        <th>แก้ไข</th>
                                        <th>ลบ</th>
                                    </tr>
                                    <?php
                                    if ($Re['total_Re_pst'] > 0){
                                    $number=0;
                                    foreach ($Re['Re_m'] as $row_Re_m);
                                    foreach ($Re['Re_pst'] as $row_Re_pst){
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo ($number+=1); ?></td>
                                        <td>
                                            <div align="center">
                                                <?php 
                                                $list=$row_Re_pst->position_no;
                                                $id=$row_Re_pst->position_id;
                                                if($Re['total_Re_pst']>=2){
                                                if($list==1){?>
                                                    <div align="center">
                                                        <i class="btn_down" id="<?php echo $id; ?>" name="<?php echo $list; ?>">
                                                        <i class="fas fa-chevron-circle-down text-danger fa-lg"></i></i>
                                                    </div>
                                                <?php 
                                                } if($list!=1 and $list!=$row_Re_m->ps_max){
                                                ?>
                                                    <div align="center">
                                                        <i class="btn_down" id="<?php echo $id; ?>" name="<?php echo $list; ?>">
                                                        <i class="fas fa-chevron-circle-down text-danger fa-lg"></i></i>
                                                        
                                                        <i class="btn_up" id="<?php echo $id; ?>" name="<?php echo $list; ?>">
                                                        <i class="fas fa-chevron-circle-up text-success fa-lg"></i></i>
                                                    </div>
                                                <?php 
                                                } if($list==$row_Re_m->ps_max AND $list>0){ 
                                                ?>
                                                    <div align="center">
                                                        <i class="btn_up" id="<?php echo $id; ?>" name="<?php echo $list; ?>">
                                                        <i class="fas fa-chevron-circle-up text-success fa-lg"></i></i>
                                                    </div>
                                                <?php } } ?>
                                            </div>
                                        </td>
                                        <td align="center"><?php if(!empty($row_Re_pst->memtype_name)){echo $row_Re_pst->memtype_name;} else {echo "";} ?></td>
                                        <td><?php if(!empty($row_Re_pst->dp_name)){echo $row_Re_pst->dp_name;} else {echo "";} ?></td>
                                        <td><?php if(!empty($row_Re_pst->position_name)){echo $row_Re_pst->position_name;} else {echo "";} ?></td>
                                        <td></td>
                                        <td align="center">
                                            <button type="button" class="btn_sm btn_yellow btn_edit" id="<?php echo $row_Re_pst->position_id;?>"><i class="fas fa-pencil-alt"></i></button>
                                        </td>
                                        <td align="center">
                                            <button class="btn_sm btn_red btn_dele" id="<?php echo $row_Re_pst->position_id;?>" value="<?php echo $row_Re_pst->position_name;?>"><i class="fas fa-trash-alt"></i></button>
                                            <input type="hidden" id="memtype_id" name="memtype_id" value="<?php echo $row_Re_pst->memtype_id;?>">
                                        </td>
                                    </tr>
                                    <?php } }else{ ?>
                                    <tr><td colspan="7"><div class="alert_table"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการ <?php echo $topic; ?> ในขณะนี้</div></td></tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- loader -->
<div id="loader" style="display:none;"><img src="<?php echo base_url('public/images/icon/150x150.gif');?>"><br>กำลังดำเนินการกรุณารอ</div>

<!-- JS -->
<script src="<?php echo base_url('public/js/b_position.js');?>"></script>