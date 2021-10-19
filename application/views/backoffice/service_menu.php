<div id="menu_side">
    <ul>
        <li><a class="home" href="<?php echo base_url('backoffice/tab/4');?>"><i class="fas fa-home"></i> เมนูหลัก</a></li>
        <li><a class="<?php if($pA=='ประเภท'){echo 'active';}?>" href="<?php echo base_url('backoffice/ขอรับบริการออนไลน์/ประเภท');?>"><i class="fas fa-list-ul fa-lg"></i> ประเภทการบริการออนไลน์</a></li>

        <li><a class="<?php if($pA=='ขอรับบริการ'){echo 'active';}?>" href="<?php echo base_url('backoffice/ขอรับบริการออนไลน์');?>"><i class="fas fa-envelope text-danger fa-lg"></i> ขอรับบริการออนไลน์</a></li>

        <li><a class="<?php if($pA=='รับเรื่อง'){echo 'active';}?>" href="<?php echo base_url('backoffice/ขอรับบริการออนไลน์/รับเรื่อง');?>"><i class="fas fa-check-circle text-success fa-lg"></i> รับเรื่องแล้ว</a></li>
</div>