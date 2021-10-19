<div id="modal_password_edit" style="display:none;">
    <form name="form_password_edit" id="form_password_edit">
        <div class="form-row">
            <div class="form-group col-12">
                <label>Password เดิม</label>
                <input type="password" class="form-control form-control-sm" name="e_us_password" id="e_us_password" autofocus>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-12">
                <label>Password ที่ต้องการเปลี่ยน</label>
                <input type="password" class="form-control form-control-sm" name="e_us_password_new" id="e_us_password_new">
                <input type="hidden" name="e_id" id="e_id" value="<?php echo $_SESSION[''.ANW_SS.'us_id']; ?>">
            </div>
        </div>
    </form>
</div>
<div id="loader" style="display:none;"><img src="<?php echo base_url('public/images/icon/loading.gif');?>"><br>กำลังดำเนินการกรุณารอ</div>
</div>
</body>
</html>