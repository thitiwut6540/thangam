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
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('backoffice/ita/รายการประเมินประจำปี');?>" >รายการประเมินประจำปี</a>
                <i class="fas fa-caret-right"></i> พ.ศ. <?php echo $year;?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12">
                                <i class="far fa-calendar-minus"></i> รายการประเมินประจำปี พ.ศ. <?php echo $year;?>
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <?php if($Re['total_Re_g'] > 0){ ?>
                            <hr>
                            <div class="row p-4">
                                <?php foreach ($Re['Re_g'] as $row_Re_g){?>
                                    <div class="col-12 p-4 bg_main_light mb-5 rounded">
                                        <div class="row mb-1">
                                            <div class="col-12">
                                                <div class="form-row">
                                                    <div class="col-12">
                                                        <h5><?php echo $row_Re_g->g_no." ".$row_Re_g->g_name;?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <?php 
                                                $Re1=$this->B_Ita_m->getYearTopic($row_Re_g->g_id);
                                                if ($Re1['total_Re_t'] > 0){ 
                                                    foreach ($Re1['Re_t'] as $row_Re_t){
                                                ?>
                                                    <table class="tb_list mb-4" width="100%">
                                                        <tr>
                                                            <th colspan="2" class="text-left">
                                                                <i class="far fa-file-alt"></i> <?php echo $row_Re_t->t_name;?>
                                                            </th>
                                                        </tr>
                                                        <?php 
                                                        $Re2=$this->B_Ita_m->getYearSub($row_Re_t->t_id);
                                                        if ($Re2['total_Re_s'] > 0){ 
                                                            foreach ($Re2['Re_s'] as $row_Re_s){
                                                        ?>
                                                        <tr>
                                                            <td width="120" valign="top">
                                                                <button type="button" class="btn btn-sm btn-success btn_url_new w-100" data-yid="<?php echo $row_Re_s->y_id;?>" data-gid="<?php echo $row_Re_s->g_id;?>" data-tid="<?php echo $row_Re_s->t_id;?>" data-sid="<?php echo $row_Re_s->s_id;?>">เพิ่มลิ้งข้อมูล</button>
                                                            </td>
                                                            <td  width="">
                                                                <?php echo $row_Re_s->s_no." : ".$row_Re_s->s_name;?>
                                                                <?php 
                                                                $Re3=$this->B_Ita_m->getYearUrl($row_Re_s->s_id);
                                                                if ($Re3['total_Re_u'] > 0){ 
                                                                    foreach ($Re3['Re_u'] as $row_Re_u){
                                                                ?>
                                                                <div class="container">
                                                                    <div class="row my-2">
                                                                        <div class="col-pixel-width-100">
                                                                            <button type="button" class="btn btn-sm btn-danger btn_url_delete w-100" data-id="<?php echo $row_Re_u->u_id;?>" data-name="<?php echo $row_Re_u->u_name;?>"><i class="fas fa-trash-alt"></i></button>
                                                                        </div>
                                                                        <div class="col text-truncate ">
                                                                            <?php echo $row_Re_u->u_name;?>
                                                                            <br>
                                                                            <a href="<?php echo $row_Re_u->u_url;?>">
                                                                            <?php echo 'URL : ' . urldecode($row_Re_u->u_url);?></a>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                <?php } } ?>
                                                            </td>
                                                        </tr>
                                                        <?php } } ?>
                                                    </table>
                                                <?php }} ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal_box" style="display:none;"><form id="modal_box_form" name="modal_box_form"></form></div>
<script>
    $(document).ready(function() {
        $(document).on('click', '.btn_url_new', function() {
            var y_id = $(this).attr('data-yid');
            var g_id = $(this).attr('data-gid');
            var t_id = $(this).attr('data-tid');
            var s_id = $(this).attr('data-sid');
            $('#modal_box').html('<form id="modal_box_form" name="modal_box_form"></form>');
            $.ajax({
                url: '<?php echo base_url("B_Ita/ita_year_url_form"); ?>',
                method: "POST",
                data: {y_id:y_id, g_id:g_id, t_id:t_id, s_id:s_id},
                success: function (data) {
                    $('#modal_box_form').html(data);
                    $('#modal_box').dialog({
                        draggable: true,
                        closeOnEscape: true,
                        title: "เพิ่มลิ้งข้อมูล",
                        modal: true,
                        width: 600,
                        height: 350,
                        buttons: [
                            {
                                text: "บันทึก",
                                id: "btn-1",
                                click: function(){ 
                                    var isValid = true;
                                    $("#u_nane").each(function () {
                                        if (!$.isNumeric($(this).val()) || $(this).val().length < 1) {
                                            $(this).addClass('error');
                                            $(this).focus();
                                            isValid = false;
                                        } else {
                                            $(this).removeClass('error');
                                        }
                                    });
                                    $("#u_url").each(function () {
                                        if ($(this).val() == "" && $(this).val().length < 1) {
                                            $(this).addClass('error');
                                            $(this).focus();
                                            isValid = false;
                                        } else {
                                            $(this).removeClass('error');
                                        }
                                    });
                                    if (isValid) {
                                        $.ajax({
                                            url: '<?php echo base_url("B_Ita/ita_year_url_save"); ?>',
                                            method: "POST",
                                            dataType: "json",
                                            data: $('#modal_box_form').serialize(),
                                            beforeSend: function() { $('#loader').show(); },
                                            complete: function() { $('#loader').hide(); },
                                            success: function(data) {
                                                if(data.action=='Y'){
                                                    $('#modal_box').dialog("close");
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
                                            },
                                        });
                                    }
                                }
                            }, 
                            {
                                text: "ปิด",
                                id: "btn-2",
                                click: function(){            
                                    $('#modal_box').dialog("close");
                                }
                            }  
                        ]
                    });
                }
            });
        });
        $(document).on('click', '.btn_url_delete', function() {
            var u_id = $(this).attr('data-id');
            var u_name = $(this).attr('data-name');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรายการ',
                content: 'ต้องการลบก '+u_name+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: '<?php echo base_url("B_Ita/ita_year_url_delete"); ?>',
                                method: "POST",
                                dataType: "json",
                                data: {u_id: u_id},
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