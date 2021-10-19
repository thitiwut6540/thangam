<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/ita_menu.php');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> ITA
                <i class="fas fa-caret-right"></i> รายการประเมินประจำปี
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12">
                                <i class="far fa-calendar-minus"></i> รายการประเมินประจำปี
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <table class="tb_list" width="100%">
                            <tr>
                                <th width="50">ลำดับ</th>
                                <th class="text-left">ปี พ.ศ.</th>
                                <th width="160">รายการ</th>
                                <th width="100">แสดง/ไม่</th>
                                <th width="50">ลบ</th>
                            </tr>
                            <?php 
                            if ($Re['total_Re_y'] > 0){
                                $number=0;
                                foreach ($Re['Re_y'] as $row_Re_y){
                            ?>
                            <tr class="table-light">
                                <td class="text-center"><?php echo ($number+=1); ?></td>
                                <td><?php echo $row_Re_y->y_name;?></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary p-2 btn_detail" href="<?php echo base_url('backoffice/ita/รายการประเมินประจำปี/'.$row_Re_y->y_name.'');?>"><i class="fas fa-plus"></i> บันทึกลิ้งรายการ</a>
                                </td>
                                <td class="text-center">
                                    <?php if($row_Re_y->y_status=='Y'){ ?>
                                        <button type="button" class="btn btn-sm btn-success p-2 btn_status w-100" value="N" data-id="<?php echo $row_Re_y->y_id;?>">แสดง</button>
                                    <?php } else { ?>
                                        <button type="button" class="btn btn-sm btn-danger p-2 btn_status w-100" value="Y" data-id="<?php echo $row_Re_y->y_id;?>">ไม่แสดง</button>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-danger p-2 btn_dele" data-id="<?php echo $row_Re_y->y_id;?>"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <?php }}else{ ?>
                                <tr><td colspan="5"><div class="alert_table"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการในขณะนี้</div></td></tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $(document).on('click', '.btn_dele', function() {
            var y_id = $(this).attr('data-id');
            var y_name = $(this).attr('data-name');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรายการ',
                content: 'ต้องการลบรายการประเมินประจำปี '+y_name+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: base_url + "B_Ita/ita_year_delete",
                                method: "POST",
                                dataType: "json",
                                data: {y_id: y_id},
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
                                        })
                                    } else {
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
                                },
                            });
                        }
                    },
                    ยกเลิก: {},
                }
            });
        }); 

        $(document).on('click', '.btn_status', function() {
            var y_id = $(this).attr('data-id');
            var y_status = $(this).val();

            $.confirm({
                icon: 'fas fa-eye',
                title: 'เปลี่ยนสถานะ',
                content: 'ต้องการเปลี่ยนสถานะการแสดง รายการประเมินประจำปี หรือไม่',
                type: 'blue',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    เปลี่ยนสถานะ: {
                        btnClass: 'btn-blue',
                        action: function() {
                            $.ajax({
                                url: base_url + "B_Ita/ita_year_status",
                                method: "POST",
                                dataType: "json",
                                data: {y_id:y_id,y_status:y_status},
                                success: function(data) {
                                    if (data.action == 'Y') {
                                        location.reload();
                                    } else {
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
                                },
                            });
                        }
                    },
                    ยกเลิก: {},
                }
            });

            
        }); 
    });
</script>