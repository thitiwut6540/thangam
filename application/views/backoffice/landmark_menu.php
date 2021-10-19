<div id="menu_side">
    <ul>
        <li><a class="home" href="<?php echo base_url('backoffice/tab/2');?>"><i class="fas fa-home"></i> เมนูหลัก</a></li> 

        <li><a class="<?php if($pA=='m_type'){echo 'active';}?>" href="<?php echo base_url('backoffice/สถานที่สำคัญ/ประเภท');?>"><i class="fas fa-map-marker-alt"></i> ประเภทสถานที่สำคัญ</a></li> 

        <li><a class="<?php if($pA=='m_land'){echo 'active';}?>" href="<?php echo base_url('backoffice/สถานที่สำคัญ');?>"><i class="fas fa-map-marker-alt"></i> รายการสถานที่สำคัญ</a></li> 

    </ul>   
</div>