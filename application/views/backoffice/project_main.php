<style>
    .tb_box{min-width: 910px;}
    .tb_box th:nth-child(1), td:nth-child(1) { width: 50px; }
    .tb_box th:nth-child(2), td:nth-child(2) { width: 400px }
    .tb_box th:nth-child(3), td:nth-child(3) { }
    .tb_box th:nth-child(4), td:nth-child(4) { width: 50px; }
    .tb_box th:nth-child(5), td:nth-child(5) { width: 50px; }
</style>

<div id="header"><?php $this->load->view('backoffice/_header');?></div>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/project_menu');?>
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
                                <a class="btn btn_green" id="btn_insert" href="<?php echo base_url('Backoffice/'.$topic.'/เพิ่ม')?>"><i class="fas fa-plus"></i> เพิ่ม</a>
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
                                        <th>ชื่อหน่วยงานภายใน อบต.</th>
                                        <th>สถานที่ตั้ง</th>
                                        <th align="center">แก้ไข</th>
                                        <th align="center">ลบ</th>
                                    </tr>
                                    <?php
                                    if ($Re['total_Re_rl'] > 0){
                                    $number=0;
                                    foreach ($Re['Re_rl'] as $row_Re_rl){
                                    ?>
                                    <tr class="table-light">
                                        <td align="center"><?php echo ($number+=1); ?></td>
                                        <td><?php echo $row_Re_rl->dp_name; ?></td>
                                        <td><?php echo $row_Re_rl->dp_add; ?></td>
                                        <td align="center">
                                            <button type="button" class="btn_sm btn_yellow btn_edit" id="<?php echo $row_Re_rl->dp_id; ?>"><i class="fas fa-pencil-alt"></i></button>
                                        </td>
                                        <td align="center">
                                            <button class="btn_sm btn_red btn_dele" id="<?php echo $row_Re_rl->dp_id; ?>" value="<?php echo $row_Re_rl->dp_photo; ?>"><i class="fas fa-trash-alt"></i></button>
                                            <input type="hidden" id="dptype" name="dptype" value="<?php echo $row_Re_rl->dptype_id; ?>">
                                            <input type="hidden" id="pA" name="pA" value="<?php echo $pA; ?>">
                                        </td>
                                    </tr>
                                    <?php } }else{ ?>
                                    <tr><td colspan="5"><div class="alert_table"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการผู้ใช้งานในขณะนี้</div></td></tr>
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
<script src="<?php echo base_url('public/js/b_project.js');?>"></script>