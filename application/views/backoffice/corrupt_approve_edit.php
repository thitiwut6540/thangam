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
            <div class="form-group col-6 col-md-2">
                <label>วันที่รับเรื่องร้องทุกข์</label>
                <input type="text" class="form-control form-control-sm dTH" id="ca_date" name="ca_date" value="<?php echo $this->B_Function_m->dateTha(date("Y-m-d"));?>" readonly>
            </div>
            <div class="form-group col-6 col-md-1">
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