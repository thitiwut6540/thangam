<style>
    .tb_box{min-width: 910px;}
    .tb_box th:nth-child(1), td:nth-child(1) { width: 50px; }
    .tb_box th:nth-child(2), td:nth-child(2) { width: 200px; }
    .tb_box th:nth-child(3), td:nth-child(3) { width: calc(100% - 720px); }
    .tb_box th:nth-child(4), td:nth-child(4) { width: 50px; }
</style>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/system_accesstype_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> สิทธิการใช้งาน
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header"><i class="fas fa-user-shield"></i> สิทธิการใช้งาน</div>
                    <div class="box_con_detail">
                        <div class="table-responsive">
                            <div id="ajax_view" class="tb_box">
                                <table class="tb_list" width="100%">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ระดับผู้ใช้งาน</th>
                                        <th>สิทธิ์การใช้งาน</th>
                                        <th>แก้ไข</th>
                                    </tr>
                                    <?php 
                                    if($Re['total_Re_usl']>0){
                                    $number=0;
                                    foreach ($Re['Re_usl'] as $row_Re_usl){
                                    ?>
                                    <tr >
                                        <td class="text-center"><?php echo $number+=1; ?></td>
                                        <td><?php echo $row_Re_usl->usl_name; ?></td>
                                        <td><?php echo $row_Re_usl->usa_name; ?></td>
                                        <td class='text-center'>
                                            <a class="btn btn-sm btn-warning" href="<?php echo base_url('backoffice/สิทธิการใช้งาน/edit/'.$row_Re_usl->usl_id.'');?>"><i class="fas fa-pencil-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php } }else{ ?>
                                    <tr><td colspan="6"><div class="alert_table"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการ สิทธิ์ผู้ใช้งาน</div></td></tr>
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