<div id="menu_side">
    <ul>
        <li><a class="home" href="<?php echo base_url('Backoffice/dashboard');?>"><i class="fas fa-home"></i> เมนูหลัก</a></li> 
        <li><a class="<?php if($pA=='m_mem_management'){echo 'active';}?>" href="<?php echo base_url('Backoffice/ตำแหน่ง/คณะผู้บริหาร');?>"><i class="fas fa-user-plus"></i> คณะผู้บริหาร</a></li> 
        <li><a class="<?php if($pA=='m_mem_councilor'){echo 'active';}?>" href="<?php echo base_url('Backoffice/ตำแหน่ง/สมาชิกสภา');?>"><i class="fas fa-user-plus"></i> สมาชิกสภา</a></li> 
        <li><a class="<?php if($pA=='m_mem_permanent'){echo 'active';}?>" href="<?php echo base_url('Backoffice/ตำแหน่ง/สำนักงานปลัด');?>"><i class="fas fa-user-plus"></i> สำนักงานปลัด อบต.</a></li>
        <li><a class="<?php if($pA=='m_mem_finance'){echo 'active';}?>" href="<?php echo base_url('Backoffice/ตำแหน่ง/กองคลัง');?>"><i class="fas fa-user-plus"></i> กองคลัง</a></li> 
        <li><a class="<?php if($pA=='m_mem_mechanic'){echo 'active';}?>" href="<?php echo base_url('Backoffice/ตำแหน่ง/กองช่าง');?>"><i class="fas fa-user-plus"></i> กองช่าง</a></li> 
        <li><a class="<?php if($pA=='m_mem_council'){echo 'active';}?>" href="<?php echo base_url('Backoffice/ตำแหน่ง/งานสภา');?>"><i class="fas fa-user-plus"></i> งานสภา</a></li> 
        <li><a class="<?php if($pA=='m_mem_community'){echo 'active';}?>" href="<?php echo base_url('Backoffice/ตำแหน่ง/งานพัฒนาชุมชน');?>"><i class="fas fa-user-plus"></i> งานพัฒนาชุมชน</a></li> 
        <li><a class="<?php if($pA=='m_mem_seniors'){echo 'active';}?>" href="<?php echo base_url('Backoffice/ตำแหน่ง/โรงเรียนผู้สูงอายุ');?>"><i class="fas fa-user-plus"></i> โรงเรียนผู้สูงอายุ</a></li> 
        <li><a class="<?php if($pA=='m_mem_fund'){echo 'active';}?>" href="<?php echo base_url('Backoffice/ตำแหน่ง/กองทุนสวัสดิการชุมชน');?>"><i class="fas fa-user-plus"></i> กองทุนสวัสดิการชุมชน</a></li>
        <li><a class="<?php if($pA=='m_mem_local'){echo 'active';}?>" href="<?php echo base_url('Backoffice/ตำแหน่ง/ผู้นำท้องถิ่น');?>"><i class="fas fa-user-plus"></i> ผู้นำท้องถิ่น</a></li> 
    </ul>
</div>