<div id="menu_side">
    <ul>
        <li><a class="home" href="<?php echo base_url('backoffice/tab/2');?>"><i class="fas fa-home"></i> เมนูหลัก</a></li> 
        <li><a class="<?php if($pA=='m_info'){echo 'active';}?>" href="<?php echo base_url('backoffice/ข้อมูลเทศบาล');?>"><i class="fas fa-address-card"></i> ข้อมูลเทศบาล</a></li> 

        <li><a class="<?php if($pA=='m_info_about'){echo 'active';}?>" href="<?php echo base_url('backoffice/เกี่ยวกับเทศบาล');?>"><i class="fas fa-address-card"></i> เกี่ยวกับเทศบาล</a></li>

        <li><a class="<?php if($pA=='m_info_general'){echo 'active';}?>" href="<?php echo base_url('backoffice/สภาพทั่วไป');?>"><i class="fas fa-address-card"></i> สภาพทั่วไป</a></li>
        
        <li><a class="<?php if($pA=='m_info_vision'){echo 'active';}?>" href="<?php echo base_url('backoffice/วิสัยทัศน์และพันธกิจ');?>"><i class="fas fa-address-card"></i> วิสัยทัศน์/พันธกิจ</a></li> 

        <li><a class="<?php if($pA=='m_info_structure'){echo 'active';}?>" href="<?php echo base_url('backoffice/โครงสร้างองค์กร');?>"><i class="fas fa-address-card"></i> โครงสร้างองค์กร</a></li> 

        <li><a class="<?php if($pA=='m_info_staff'){echo 'active';}?>" href="<?php echo base_url('backoffice/อัตรากำลัง');?>"><i class="fas fa-address-card"></i> อัตรากำลัง</a></li> 

        <li><a class="<?php if($pA=='m_info_role'){echo 'active';}?>" href="<?php echo base_url('backoffice/อำนาจหน้าที่');?>"><i class="fas fa-address-card"></i> อำนาจหน้าที่</a></li> 
        
        <li><a class="<?php if($pA=='m_info_contact'){echo 'active';}?>" href="<?php echo base_url('backoffice/การติดต่อ');?>"><i class="fas fa-address-card"></i> การติดต่อ</a></li> 

        <li><a class="<?php if($pA=='m_info_map'){echo 'active';}?>" href="<?php echo base_url('backoffice/แผนที่');?>"><i class="fas fa-address-card"></i> แผนที่</a></li> 
    </ul>
</div>