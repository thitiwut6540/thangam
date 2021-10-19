<style>
    .tb_box{min-width: 910px;}
    .tb_box th:nth-child(1), td:nth-child(1) { width: 50px; }
    .tb_box th:nth-child(2), td:nth-child(3) { width: 90px; }
    .tb_box th:nth-child(3), td:nth-child(3) { width: 50px; }
    .tb_box th:nth-child(5), td:nth-child(5) { width: 140px; }
    .tb_box th:nth-child(6), td:nth-child(6) { width: 140px; }
    .tb_box th:nth-child(7), td:nth-child(7) { width: 80px; }
    .tb_box th:nth-child(8), td:nth-child(8) { width: 50px; }
    .tb_box th:nth-child(9), td:nth-child(9) { width: 50px; }
</style>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar"><?php $this->load->view('backoffice/system_user_menu');?></div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('Backoffice/dashboard');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> ผู้ใช้งานระบบ
            </div>
        </div>
        <div class="row">
            <div class="col-12 m-0">
                <div class="box_con mb-5">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-8"><i class="fas fa-user"></i> ผู้ใช้งานระบบ</div>
                            <div class="col-4 text-right"><a class="btn btn-sm btn-success" id="btn_insert" href="<?php echo base_url('backoffice/ผู้ใช้งานระบบ/insert');?>"><i class="fas fa-plus"></i> เพิ่ม</a></div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <div class="table-responsive">
                            <div class="tb_box">
                                <table class="tb_list" width="100%">
                                    <tr>
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">ใช้งาน/ไม่</th>
                                        <th class="text-center">อนุมัติ</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>สิทธิการใช้งาน</th>
                                        <th>ใช้งานล่าสุด</th>
                                        <th class="text-center">สถิติ</th>
                                        <th class="text-center">แก้ไข</th>
                                        <th class="text-center">ลบ</th>
                                    </tr>
                                    <?php 
                                    if($Re['total_Re_u']>0){
                                        $number=0;
                                        foreach ($Re['Re_u'] as $row_Re_u){
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $number+=1; ?></td>
                                        <td class="text-center">
                                            <?php if($row_Re_u->us_status=="1"){ ?>
                                                <i class="fas fa-check fa-lg text-success"></i>
                                            <?php }else{ ?>
                                                <i class="fas fa-check fa-lg text-light"></i>
                                            <?php }?>
                                        </td>
                                        <td class="text-center">
                                            <?php if($row_Re_u->us_approve=="Y"){ ?>
                                                <i class="fas fa-check fa-lg text-success"></i>
                                            <?php }else{ ?>
                                                <i class="fas fa-check fa-lg text-light"></i>
                                            <?php }?>
                                        </td>
                                        <td><?php echo $row_Re_u->us_name; ?></td>
                                        <td class="text-center"><?php if(!empty($row_Re_u->usl_name)){echo $row_Re_u->usl_name;}else{echo "-";} ?></td>
                                        <td class="text-center"><?php if($row_Re_u->us_login_last>0){echo $this->B_Function_m->datethai_sm_time($row_Re_u->us_login_last);}else{echo "<font color='#FF0004'>ยังไม่เคยเข้าใช้งาน</font>";} ?></td>
                                        <td class="text-center"><?php if($row_Re_u->us_counter>0){echo $row_Re_u->us_counter;}else{echo " - ";} ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-warning" href="<?php echo base_url('backoffice/ผู้ใช้งานระบบ/edit/').$row_Re_u->us_id;?>"><i class="fas fa-pencil-alt"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" data-id="<?php echo $row_Re_u->us_id; ?>" class="btn btn-sm btn-danger btn_dele" data-name="<?php echo $row_Re_u->us_name; ?>"><i class="far fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    <?php } }else{ ?>
                                    <tr><td colspan="11"><div class="alert_table"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการผู้ใช้งานในขณะนี้</div></td></tr>
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
<script>
    $(document).ready(function() {
        $(document).on('click', '.btn_dele', function() {
            var us_id = $(this).attr('data-id');
            var us_name = $(this).attr('data-name');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรายการ',
                content: 'ต้องการลบผู้ใช้งานระบบ '+us_name+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function(){
                            $.ajax({
                                url: '<?php echo base_url("B_User/user_delete");?>',
                                method: "POST",
                                dataType: "json",
                                data: { us_id: us_id, us_name: us_name, action: "delete" },
                                success: function(data) {
                                    if (data.action == 'Y') {
                                        $.alert({
                                            icon: 'fas fa-check',
                                            title: 'สำเร็จ',
                                            content: data.output,
                                            type: 'green',
                                            typeAnimated: true,
                                            boxWidth: '420px',
                                            useBootstrap: false,
                                            onDestroy: function() {
                                                location.reload();
                                            }
                                        });
                                    }else{
                                        $.alert({
                                            icon: 'fas fa-exclamation-triangle',
                                            title: 'แจ้งเตือน',
                                            content: data.output,
                                            type: 'red',
                                            typeAnimated: true,
                                            boxWidth: '420px',
                                            useBootstrap: false,
                                        });
                                    }
                                }
                            });
                        }
                    },
                    ยกเลิก: {},
                }
            });
        });
    })
</script>