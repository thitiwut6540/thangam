<div id="menu_side">
    <ul>
        <li><a class="home" href="<?php echo base_url('backoffice/tab/4');?>"><i class="fas fa-home"></i> เมนูหลัก</a></li>

        
        <li><a class="<?php if($pA=='ประเภท'){echo 'active';}?>" href="<?php echo base_url('backoffice/ร้องเรียนร้องทุกข์/ประเภท');?>"><i class="fas fa-list-ul fa-lg"></i> ประเภทเรื่องร้องเรียนร้องทุกข์</a></li>


        <li><a class="<?php if($pA=='แจ้งเรื่อง'){echo 'active';}?>" href="<?php echo base_url('backoffice/ร้องเรียนร้องทุกข์/แจ้งเรื่อง');?>"><i class="fas fa-envelope text-danger fa-lg"></i> แจ้งเรื่อง</a></li>

        <li><a class="<?php if($pA=='รับเรื่อง'){echo 'active';}?>" href="<?php echo base_url('backoffice/ร้องเรียนร้องทุกข์/รับเรื่อง');?>"><i class="fas fa-plus-circle text-warning fa-lg"></i> รับเรื่องร้องเรียน</a></li>

        <li><a class="<?php if($pA=='ดำเนินการ'){echo 'active';}?>" href="<?php echo base_url('backoffice/ร้องเรียนร้องทุกข์/ดำเนินการ');?>"><i class="fas fa-clock text-primary fa-lg"></i> ดำเนินการ</a></li>

        <li><a class="<?php if($pA=='เสร็จสิ้น'){echo 'active';}?>" href="<?php echo base_url('backoffice/ร้องเรียนร้องทุกข์/เสร็จสิ้น');?>"><i class="fas fa-check-circle text-success fa-lg"></i> ดำเนินการเสร็จสิ้น</a></li>

        <li><a class="<?php if($pA=='ไม่รับแจ้ง'){echo 'active';}?>" href="<?php echo base_url('backoffice/ร้องเรียนร้องทุกข์/ไม่รับแจ้ง');?>"><i class="fas fa-ban fa-lg"></i> ไม่รับแจ้ง</a></li>
    </ul>
</div>