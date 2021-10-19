<?php foreach ($Re['Re_ca'] as $row_Re_ca);?>
<div class="row m-0 p-0">
    <div class="col-12">
        <div class="form-row">
            <div class="form-group col-12 col-md-2">
                <label>เลขที่เรื่องร้องทุกข์</label>
                <input type="text" class="form-control form-control-sm" id="c_no" name="c_no" value="<?php echo $row_Re_ca->c_no;?>" readonly>
            </div>
            <div class="form-group col-12 col-md-3">
                <label>ผู้แก้ไขข้อมูล</label>
                <input type="text" class="form-control form-control-sm" id="ca_receive" name="ca_receive" value="<?php echo $_SESSION[''.ANW_SS.'us_name'];?>" readonly>
            </div>
            <div class="form-group col-12 col-md-3">
                <?php 
                $ReDP3 = $this->B_Corrupt_m->getDepart($_SESSION[''.ANW_SS.'dp_id']); 
                foreach ($ReDP3['Re_dp'] as $row_Re_dp3);
                ?>
                <label>หน่วยงาน</label>
                <input type="text" class="form-control form-control-sm" id="ca_dp_name" name="ca_dp_name" value="<?php echo $row_Re_dp3->dp_name;?>" readonly>
                <input type="hidden" class="form-control form-control-sm" id="ca_dp_id" name="ca_dp_id" value="<?php echo $_SESSION[''.ANW_SS.'dp_id'] ;?>" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-6 col-md-2">
                <label>บันทึกสถานะ</label>
                <input type="text" class="form-control form-control-sm" id="c_status" name="c_status" value="<?php echo $row_Re_ca->ca_status; ?>" readonly>
            </div>
            <div class="form-group col-md-auto">
                <label for="">หน่วยงานที่รับดำเนินการ</label>
                <select name="dp_id" id="dp_id" class="form-control form-control-sm">
                        <option value="">เลือกหน่วยงาน</option>
                        <?php foreach ($ReDP['Re_dp'] as $row_Re_dp3){ ?>
                        <option value="<?php echo $row_Re_dp3->dp_id;?>" <?php if($row_Re_dp3->dp_id==$row_Re_ca->dp_id){ echo "selected=\"selected\""; }?>><?php echo $row_Re_dp3->dp_name;?></option>
                        <?php } ?>
                </select>
            </div>
            <div class="form-group col-6 col-md-2">
                <label>วันที่รับเรื่องร้องทุกข์</label>
                <input type="text" class="form-control form-control-sm dTH" id="ca_date" name="ca_date" value="<?php echo $this->B_Function_m->dateTha(date("Y-m-d"));?>" readonly>
            </div>
            <div class="form-group col-6 col-md-2">
                <label>เวลา</label>
                <input type="time" class="form-control form-control-sm" id="ca_date_time" name="ca_date_time" value="<?php echo date("H:i");?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-12 col-md-6">
                <label>หมายเหตุ ( บันทึกภายใน )</label>
                <textarea class="form-control form-control-sm" rows="5" id="ca_comment" name="ca_comment"><?php echo $row_Re_ca->ca_comment; ?></textarea>
            </div>
            <div class="form-group col-12 col-md-6">
                <label>รายละเอียดดำเนินการ ( แสดงภายนอก )</label>
                <textarea class="form-control form-control-sm" rows="5" id="ca_public" name="ca_public"><?php echo $row_Re_ca->ca_public; ?></textarea>
                <input type="hidden" id="ca_id" name="ca_id" value="<?php echo $row_Re_ca->ca_id; ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="ban_photo">เปลี่ยนภาพประกอบ 1</label>
                <input type="file" name="ca_photo1" id="ca_photo1" class="form-control form-control-sm"> 
                <input type="hidden" id="h_ca_photo1" name="h_ca_photo1" value="<?php echo $row_Re_ca->ca_photo1; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="ban_photo">เปลี่ยนภาพประกอบ 2</label>
                <input type="file" name="ca_photo2" id="ca_photo2" class="form-control form-control-sm"> 
                <input type="hidden" id="h_ca_photo2" name="h_ca_photo2" value="<?php echo $row_Re_ca->ca_photo2; ?>">
            </div>
        </div>

        <div class="row">
            <?php if(!empty($row_Re_ca->ca_photo1)){?>
                <div class="col-12 col-md-6">
                    <button type="button" class="btn_fm btn_red btn_photo_dele" data-id="<?php echo $row_Re_ca->ca_id;?>" data-photo="1"><i class="fas fa-times"></i> ลบรูปที่ 1</button><br>
                    <img class="img-fluid" src="<?php echo base_url('public/images/complain/'.$row_Re_ca->ca_photo1.'');?>">
                </div>
            <?php } ?>
            <?php if(!empty($row_Re_ca->ca_photo2)){?>
                <div class="col-12 col-md-6">
                    <button type="button" class="btn_fm btn_red btn_photo_dele" data-id="<?php echo $row_Re_ca->ca_id;?>" data-photo="2"><i class="fas fa-times"></i> ลบรูปที่ 2</button><br>
                    <img class="img-fluid" src="<?php echo base_url('public/images/complain/'.$row_Re_ca->ca_photo2.'');?>">
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
        $(function(){
            $(".dTH").datepicker(
                $.extend({}, 
                    $.datepicker.regional.th, { 
                        dateFormat: "dd/mm/yy",
                        changeMonth:true,
                        changeYear:true,
                        yearRange:"-100:+10",
                    }
                )
            );
        });
</script>