<?php
if ($Re['total_Re_wt'] > 0){
foreach ($Re['Re_wt'] as $row_Re_wt){
?>
<div class="box_list_txt my-3">
    <div class="row">
        <div class="col-12">
            <table class="table" width="100%">
                <tr>
                    <td valign="top" width="50" align="center"><b>ID</b><div><?php echo $row_Re_wt->wb_t_id; ?></div></td>
                    <td valign="top" width="120">
                        <div class="row">
                            <div class="col-12 img_1_1">
                                <div>
                                <?php if(!empty($row_Re_wt->wb_t_photo)){ ?>
                                    <img class="img-fluid" src="<?php echo base_url('public/images/webboard/'.$row_Re_wt->wb_t_photo.''); ?>">
                                <?php } else { ?>
                                    <img class="img-fluid" src="<?php echo base_url('public/images/nophoto.png'); ?>">
                                <?php } ?>
                                <div>
                            </div>
                        </div>
                    </td>
                    <td valign="top"><b>ชื่อหัวข้อ</b><div><?php echo $row_Re_wt->wb_t_title; ?></div></td>
                    <td valign="top" width="100" align="center">
                        <b>หัวข้อย่อย</b>
                        <?php $Re_sub = $this->B_Webboard_m->getSubTotal($row_Re_wt->wb_t_id)?> 
                        <div><?php echo $Re_sub['total_Re_sb']; ?></div>
                    </td>
                    <td valign="top" width="140"><b>วันที่โพส</b><div><?php echo $this->B_Function_m->datethai_sm_time($row_Re_wt->wb_t_date); ?></div></td>
                    <td valign="top" width="180" align="right">
                        <a class="btn btn-sm btn-primary p-2" href="<?php echo base_url('backoffice/webboard/topic/'.$row_Re_wt->wb_t_id.''); ?>"><i class="fas fa-search"></i></a>

                        <a type="button" class="btn btn-sm btn-success p-2" href="<?php echo base_url('backoffice/webboard/topic/'.$row_Re_wt->wb_t_id.'/สร้างหัวข้อย่อย'); ?>"><i class="fas fa-plus"></i></a>

                        <a class="btn btn-sm btn-warning p-2" href="<?php echo base_url('backoffice/webboard/แก้ไขหัวข้อ/'.$row_Re_wt->wb_t_id.''); ?>"><i class="fas fa-pencil-alt"></i></a>

                        <button class="btn btn-sm btn-danger p-2 btn_topic_dele" data-id="<?php echo $row_Re_wt->wb_t_id;?>" data-name="<?php echo $row_Re_wt->wb_t_title;?>"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            </table>
        </div>

    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div id="accordion">
                <div class="card card_edit">
                    <div class="card-header p-0" id="headingOne">
                        <div class="col-12 text-left p-1 showClick" data-toggle="collapse" data-target="#wb_cl_<?php echo $row_Re_wt->wb_t_id; ?>" aria-expanded="true" aria-controls="wb_cl_<?php echo $row_Re_wt->wb_t_id; ?>">
                        <i class="fas fa-caret-down"></i> หัวข้อย่อย <span class="text-danger"> ** กรุณาคลิกที่หัวข้อย่อยเพื่อดูหัวข้อเพิ่มเติม **</span>
                        </div>
                    </div>

                    <div id="wb_cl_<?php echo $row_Re_wt->wb_t_id; ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body p-2 pt-0 m-0">
                            <div class="table-responsive" id="ajax_wb_sub_<?php echo $row_Re_wt->wb_t_id;?>">
                                <table class="table table-sm table-bordered mb-0" width="100%">
                                    <thead>
                                        <tr class="table-secondary">
                                            <th class="text-center" width="60">ลำดับ</th>
                                            <th width="">ชื่อหัวข้อ</th>
                                            <th class="text-center" width="50">แก้ไข</th>
                                            <th class="text-center" width="50">ลบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $Re_s_topic = $this->B_Webboard_m->getSubTopic($row_Re_wt->wb_t_id);
                                        if ($Re_s_topic['total_Re_stp'] > 0){
                                            $s_no=0;
                                            foreach ($Re_s_topic['Re_stp'] as $row_Re_stp){
                                        ?> 
                                            <tr>
                                                <td align="center"><?php echo ($s_no+=1); ?></td>
                                                <td align="left"><?php echo $row_Re_stp->wb_s_title; ?></td>
                                                <td align="center">
                                                    <a class="btn btn-sm" href="<?php echo base_url('backoffice/webboard/topic/'.$row_Re_stp->wb_t_id.'/แก้ไขหัวข้อย่อย/'.$row_Re_stp->wb_s_id.''); ?>"><i class="fas fa-pencil-alt"></i></a></td>
                                                <td align="center">
                                                    <button class="btn btn-sm btn_sub_dele" data-id="<?php echo $row_Re_stp->wb_s_id;?>" data-name="<?php echo $row_Re_stp->wb_s_title;?>" data-topic="<?php echo $row_Re_stp->wb_t_id;?>" data-url="ajax_wb_sub_<?php echo $row_Re_wt->wb_t_id;?>"><i class="fas fa-trash-alt"></i></button></td>
                                            </tr>
                                        <?php }} else { ?>
                                            <tr>
                                                <td colspan="5"><div class="alert alert-danger mb-0" role="alert"><i class="fas fa-exclamation-triangle"></i> ไม่มีหัวข้อย่อย</div></td>
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
    </div>
</div>
<?php }} else { ?>
    <div class="bg_alert w-100 p-3"><i class="fas fa-exclamation-triangle"></i> ขณะนี้ไม่มีรายการ หัวข้อหลักของเว็บบอร์ด ในขณะนี้</div>
<?php } ?>

<div class="row p-0 mt-2 mx-0 mb-2">
    <div class="col-12 col-md-6 col-md-6 p-0">
        <?php if($Re['total_Re_wt']>0){ ?>
            ลำดับที่ <?php echo $Re['page_start']." - ".$Re['page_end']." จากทั้งหมด ".$Re['total_Re_wt'];?> รายการ
        <?php } ?>
    </div>
    <div class="col-12 col-md-6 col-md-6 p-0">
        <ul class="pagination"><?php echo $pagelinks ?></div>
    </div>
</div>
