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
                <i class="fas fa-caret-right"></i> สร้างประเมินประจำปี
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12">
                                <i class="fas fa-plus"></i> สร้างประเมินประจำปี
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <form id="form_ita" name="form_ita">
                            <div class="row">
                                <div class="col-6">
                                    สร้างหัวข้อการประเมินคุณธรรมและความโปร่งใสในการดำเนินงานขององค์กรปกครองส่วนท้องถิ่น ITA ประจำปี
                                </div>
                                <div class="col-3">
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label>กำหนด พ.ศ.</label>
                                            <input type="text" id="ita_year" name="ita_year" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label >สร้างหัวข้อกลุ่มข้อมูล ITA ใหม่</label>
                                            <button type="button" id="btn_group_new" class="form-control form-control-sm btn btn-sm btn-primary"><i class="fas fa-plus"></i> สร้างกลุ่ม</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if($Re['total_Re_g'] > 0){ ?>
                                <hr>
                                <div class="row p-4">
                                    <?php foreach ($Re['Re_g'] as $row_Re_g){?>
                                        <div class="col-12 p-4 bg_main_light p-4 mb-5 rounded">
                                            <div class="row mb-1">
                                                <div class="col-8">
                                                    <div class="form-row">
                                                        <div class="col-3">
                                                            <input type="text" class="form-control" name="tx_g_no[]" value="<?php echo $row_Re_g->g_no;?>" readonly>
                                                            <input type="hidden" name="tx_g_id[]" value="<?php echo $row_Re_g->g_id;?>" readonly>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text" class="form-control" name="tx_g_name[]" value="<?php echo $row_Re_g->g_name;?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <button type="button" class="btn btn-sm btn-primary btn_topic_new" data-id="<?php echo $row_Re_g->g_id;?>"><i class="fas fa-plus"></i> เพิ่มหัวข้อ</button>

                                                    <button type="button" class="btn btn-sm btn-warning btn_group_edit" data-id="<?php echo $row_Re_g->g_id;?>"><i class="fas fa-pencil-alt"></i> แก้ไข</button>

                                                    <button type="button" class="btn btn-sm btn-danger btn_group_delete" data-id="<?php echo $row_Re_g->g_id;?>" data-no="<?php echo $row_Re_g->g_no;?>"><i class="fas fa-minus"></i> ลบ</button>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-12">
                                                    <?php 
                                                    $Re1=$this->B_Ita_m->getMasterTopic($row_Re_g->g_id);
                                                    if ($Re1['total_Re_t'] > 0){ 
                                                        foreach ($Re1['Re_t'] as $row_Re_t){
                                                    ?>
                                                        <table class="tb_list mb-4" width="100%">
                                                            <tr>
                                                                <th colspan="4" class="text-left">
                                                                    <div class="form-row">
                                                                        <div class="col-10">
                                                                            <input type="text" class="form-control" name="tx_t_name[]" value="<?php echo $row_Re_t->t_name;?>" readonly>
                                                                            <input type="hidden" name="tx_t_id[]" value="<?php echo $row_Re_t->t_id;?>" readonly>
                                                                            <input type="hidden" name="tx_t_g_id[]" value="<?php echo $row_Re_t->g_id;?>" readonly>
                                                                        </div>
                                                                        <div class="col-2 text-right">
                                                                            <button type="button" class="btn btn-sm btn-primary btn_sub_new" data-gid="<?php echo $row_Re_t->g_id;?>" data-tid="<?php echo $row_Re_t->t_id;?>"><i class="fas fa-plus"></i></button>

                                                                            <button type="button" class="btn btn-sm btn-warning btn_topic_edit " data-id="<?php echo $row_Re_t->t_id;?>"><i class="fas fa-pencil-alt"></i></button>
                                                                
                                                                            <button type="button" class="btn btn-sm btn-danger btn_topic_delete " data-id="<?php echo $row_Re_t->t_id;?>" data-no="<?php echo $row_Re_t->t_name;?>"><i class="fas fa-minus"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                            </tr>
                                                            <?php 
                                                            $Re2=$this->B_Ita_m->getMasterSub($row_Re_t->t_id);
                                                            if ($Re2['total_Re_s'] > 0){ 
                                                                foreach ($Re2['Re_s'] as $row_Re_s){
                                                            ?>
                                                            <tr>
                                                                <td width="80" valign="top" class="text-center">
                                                                    <div class="form-row">
                                                                        <div class="col-12">
                                                                            <input type="hidden" name="tx_s_id[]" value="<?php echo $row_Re_s->s_id;?>" readonly>
                                                                            <input type="text" class="form-control" name="tx_s_no[]" value="<?php echo $row_Re_s->s_no;?>" readonly>
                                                                            <input type="hidden" name="tx_s_g_id[]" value="<?php echo $row_Re_s->g_id;?>" readonly>
                                                                            <input type="hidden" name="tx_s_t_id[]" value="<?php echo $row_Re_s->t_id;?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-row">
                                                                        <div class="col-12">
                                                                            <input type="text" class="form-control" name="tx_s_name[]" value="<?php echo $row_Re_s->s_name;?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td width="40" valign="top" class="text-center">
                                                                    <button type="button" class="btn btn-sm btn-warning btn_sub_edit w-100" data-id="<?php echo $row_Re_s->s_id;?>"><i class="fas fa-pencil-alt"></i></button>
                                                                </td>
                                                                <td width="40" valign="top" class="text-center">
                                                                    <button type="button" class="btn btn-sm btn-danger btn_sub_delete w-100" data-id="<?php echo $row_Re_s->s_id;?>" data-no="<?php echo $row_Re_s->s_no;?>"><i class="fas fa-minus"></i></button>
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
                            <hr>
                            <div class="row">
                                <div class="col-12 text-center mb-5">
                                    <button type="submit" id="btn_submit" class="btn btn-sm btn-success" ><i class="fas fa-save"></i> บันทึกสร้าง ITA ประจำปี</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal_box" style="display:none;"><form id="modal_box_form" name="modal_box_form"></form></div>
<script>
    $(document).ready(function() {

        $(document).on('click', '#btn_group_new', function() {
            $('#modal_box').html('<form id="modal_box_form" name="modal_box_form"></form>');
            $.ajax({
                url: '<?php echo base_url("B_Ita/ita_master_group_form"); ?>',
                method: "POST",
                success: function (data) {
                    $('#modal_box_form').html(data);
                    $('#modal_box').dialog({
                        draggable: true,
                        closeOnEscape: true,
                        title: "เพิ่มกลุ่มข้อมูลหัวข้อประเมิน ITA",
                        modal: true,
                        width: 600,
                        height: 350,
                        buttons: [
                            {
                                text: "บันทึก",
                                id: "btn-1",
                                click: function(){ 
                                    var isValid = true;
                                    $("#g_no").each(function () {
                                        if (!$.isNumeric($(this).val()) || $(this).val().length < 1) {
                                            $(this).addClass('error');
                                            $(this).focus();
                                            isValid = false;
                                        } else {
                                            $(this).removeClass('error');
                                        }
                                    });
                                    $("#g_name").each(function () {
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
                                            url: '<?php echo base_url("B_Ita/ita_master_group_save"); ?>',
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
        $(document).on('click', '.btn_group_edit', function() {
            var g_id = $(this).attr('data-id');
            $('#modal_box').html('<form id="modal_box_form" name="modal_box_form"></form>');
            $.ajax({
                url: '<?php echo base_url("B_Ita/ita_master_group_edit_form"); ?>',
                method: "POST",
                data: {g_id:g_id},
                success: function (data) {
                    $('#modal_box_form').html(data);
                    $('#modal_box').dialog({
                        draggable: true,
                        closeOnEscape: true,
                        title: "แก้ไขกลุ่มข้อมูลหัวข้อประเมิน ITA",
                        modal: true,
                        width: 600,
                        height: 350,
                        buttons: [
                            {
                                text: "บันทึก",
                                id: "btn-1",
                                click: function(){ 
                                    var isValid = true;
                                    $("#g_no").each(function () {
                                        if (!$.isNumeric($(this).val()) || $(this).val().length < 1) {
                                            $(this).addClass('error');
                                            $(this).focus();
                                            isValid = false;
                                        } else {
                                            $(this).removeClass('error');
                                        }
                                    });
                                    $("#g_name").each(function () {
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
                                            url: '<?php echo base_url("B_Ita/ita_master_group_edit_save"); ?>',
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
        $(document).on('click', '.btn_group_delete', function() {
            var g_id = $(this).attr('data-id');
            var g_no = $(this).attr('data-no');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรายการ',
                content: 'ต้องการลบกลุ่มข้อมูล หมายเลข '+g_no+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: '<?php echo base_url("B_Ita/ita_master_group_delete"); ?>',
                                method: "POST",
                                dataType: "json",
                                data: {g_id: g_id},
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


        $(document).on('click', '.btn_topic_new', function() {
            var g_id = $(this).attr('data-id');
            $('#modal_box').html('<form id="modal_box_form" name="modal_box_form"></form>');
            $.ajax({
                url: '<?php echo base_url("B_Ita/ita_master_topic_form"); ?>',
                method: "POST",
                data: {g_id:g_id},
                success: function (data) {
                    $('#modal_box_form').html(data);
                    $('#modal_box').dialog({
                        draggable: true,
                        closeOnEscape: true,
                        title: "เพิ่มข้อมูลหัวข้อประเมิน ITA",
                        modal: true,
                        width: 600,
                        height: 350,
                        buttons: [
                            {
                                text: "บันทึก",
                                id: "btn-1",
                                click: function(){ 
                                    var isValid = true;
                                    $("#t_no").each(function () {
                                        if (!$.isNumeric($(this).val()) || $(this).val().length < 1) {
                                            $(this).addClass('error');
                                            $(this).focus();
                                            isValid = false;
                                        } else {
                                            $(this).removeClass('error');
                                        }
                                    });
                                    $("#t_name").each(function () {
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
                                            url: '<?php echo base_url("B_Ita/ita_master_topic_save"); ?>',
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
        $(document).on('click', '.btn_topic_edit', function() {
            var t_id = $(this).attr('data-id');
            $('#modal_box').html('<form id="modal_box_form" name="modal_box_form"></form>');
            $.ajax({
                url: '<?php echo base_url("B_Ita/ita_master_topic_edit_form"); ?>',
                method: "POST",
                data: {t_id:t_id},
                success: function (data) {
                    $('#modal_box_form').html(data);
                    $('#modal_box').dialog({
                        draggable: true,
                        closeOnEscape: true,
                        title: "แก้ไขข้อมูลหัวข้อประเมิน ITA",
                        modal: true,
                        width: 600,
                        height: 350,
                        buttons: [
                            {
                                text: "บันทึก",
                                id: "btn-1",
                                click: function(){ 
                                    var isValid = true;
                                    $("#t_no").each(function () {
                                        if (!$.isNumeric($(this).val()) || $(this).val().length < 1) {
                                            $(this).addClass('error');
                                            $(this).focus();
                                            isValid = false;
                                        } else {
                                            $(this).removeClass('error');
                                        }
                                    });
                                    $("#t_name").each(function () {
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
                                            url: '<?php echo base_url("B_Ita/ita_master_topic_edit_save"); ?>',
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
        $(document).on('click', '.btn_topic_delete', function() {
            var t_id = $(this).attr('data-id');
            var t_no = $(this).attr('data-no');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรายการ',
                content: 'ต้องการลบกข้อมูลหัวข้อ หมายเลข '+t_no+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: '<?php echo base_url("B_Ita/ita_master_topic_delete"); ?>',
                                method: "POST",
                                dataType: "json",
                                data: {t_id: t_id},
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


        $(document).on('click', '.btn_sub_new', function() {
            var g_id = $(this).attr('data-gid');
            var t_id = $(this).attr('data-tid');
            $('#modal_box').html('<form id="modal_box_form" name="modal_box_form"></form>');
            $.ajax({
                url: '<?php echo base_url("B_Ita/ita_master_sub_form"); ?>',
                method: "POST",
                data: {g_id:g_id,t_id:t_id},
                success: function (data) {
                    $('#modal_box_form').html(data);
                    $('#modal_box').dialog({
                        draggable: true,
                        closeOnEscape: true,
                        title: "เพิ่มรายการ",
                        modal: true,
                        width: 600,
                        height: 350,
                        buttons: [
                            {
                                text: "บันทึก",
                                id: "btn-1",
                                click: function(){ 
                                    var isValid = true;
                                    $("#t_name").each(function () {
                                        if ($(this).val() == "" && $(this).val().length < 1) {
                                            $(this).addClass('error');
                                            $(this).focus();
                                            isValid = false;
                                        } else {
                                            $(this).removeClass('error');
                                        }
                                    });
                                    $("#s_no").each(function () {
                                        if (!$.isNumeric($(this).val()) || $(this).val().length < 1) {
                                            $(this).addClass('error');
                                            $(this).focus();
                                            isValid = false;
                                        } else {
                                            $(this).removeClass('error');
                                        }
                                    });
                                    $("#s_name").each(function () {
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
                                            url: '<?php echo base_url("B_Ita/ita_master_sub_save"); ?>',
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
        $(document).on('click', '.btn_sub_edit', function() {
            var s_id = $(this).attr('data-id');
            $('#modal_box').html('<form id="modal_box_form" name="modal_box_form"></form>');
            $.ajax({
                url: '<?php echo base_url("B_Ita/ita_master_sub_edit_form"); ?>',
                method: "POST",
                data: {s_id:s_id},
                success: function (data) {
                    $('#modal_box_form').html(data);
                    $('#modal_box').dialog({
                        draggable: true,
                        closeOnEscape: true,
                        title: "แก้ไขรายการ",
                        modal: true,
                        width: 600,
                        height: 350,
                        buttons: [
                            {
                                text: "บันทึก",
                                id: "btn-1",
                                click: function(){ 
                                    var isValid = true;
                                    $("#t_name").each(function () {
                                        if ($(this).val() == "" && $(this).val().length < 1) {
                                            $(this).addClass('error');
                                            $(this).focus();
                                            isValid = false;
                                        } else {
                                            $(this).removeClass('error');
                                        }
                                    });
                                    $("#s_no").each(function () {
                                        if (!$.isNumeric($(this).val()) || $(this).val().length < 1) {
                                            $(this).addClass('error');
                                            $(this).focus();
                                            isValid = false;
                                        } else {
                                            $(this).removeClass('error');
                                        }
                                    });
                                    $("#s_name").each(function () {
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
                                            url: '<?php echo base_url("B_Ita/ita_master_sub_edit_save"); ?>',
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
        $(document).on('click', '.btn_sub_delete', function() {
            var s_id = $(this).attr('data-id');
            var s_no = $(this).attr('data-no');
            $.confirm({
                icon: 'fas fa-trash-alt',
                title: 'ลบรายการ',
                content: 'ต้องการลบรายการ หมายเลข '+s_no+' หรือไม่',
                type: 'red',
                typeAnimated: true,
                boxWidth: '420px',
                useBootstrap: false,
                buttons: {
                    ลบ: {
                        btnClass: 'btn-red',
                        action: function() {
                            $.ajax({
                                url: '<?php echo base_url("B_Ita/ita_master_sub_delete"); ?>',
                                method: "POST",
                                dataType: "json",
                                data: {s_id: s_id},
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


        $(document).on('click', '#btn_submit', function() {
            $.validator.addMethod("allRequired", function(value, element){
                var name = element.name;
                return  $('input[name="'+name+'"]').map(function(i,obj){return $(obj).val();}).get().every(function(v){ return v; });
            });

            $('#form_ita').validate({
                rules: {
                    ita_year: { required: true },
                    'tx_g_id[]': { allRequired: true },
                    'tx_g_no[]': { allRequired: true },
                    'tx_g_name[]': { allRequired: true },

                    'tx_t_id[]': { allRequired: true },
                    'tx_t_g_id[]': { allRequired: true },
                    'tx_t_name[]': { allRequired: true },

                    'tx_s_id[]': { allRequired: true },
                    'tx_s_g_id[]': { allRequired: true },
                    'tx_s_t_id[]': { allRequired: true },
                    'tx_s_name[]': { allRequired: true },
                },
                errorPlacement: function(error,element) {return true;},
                submitHandler: function(form, event) {
                    $.ajax({
                        url: '<?php echo base_url("B_Ita/ita_master_year_save"); ?>',
                        method: "POST",
                        dataType: "json",
                        data: $('#form_ita').serialize(),
                        beforeSend: function() { $('#loader').show(); },
                        complete: function() { $('#loader').hide(); },
                        success: function(data) {
                            if (data.action == 'Y') {
                            $.confirm({
                                icon: 'fas fa-check',
                                title: 'เรียบร้อย',
                                content: 'ต้องการลบผู้ใช้งานระบบ '+us_name+' หรือไม่',
                                type: 'green',
                                typeAnimated: true,
                                boxWidth: '420px',
                                useBootstrap: false,
                                buttons: {
                                    ไปรายการประเมินประจำปี: {
                                        btnClass: 'btn-green',
                                        action: function(){
                                            window.location.href = "<?php echo base_url('backoffice/ita/รายการประเมินประจำปี');?>";
                                        }
                                    },
                                    ปิด: {
                                        action: function(){
                                            $('#ita_year').val('');
                                        }
                                    },
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
                },
            });
        });

    });
</script>