<div id="menu_side">
    <ul>
        <li><a class="home" href="<?php echo base_url('backoffice/tab/2');?>"><i class="fas fa-home"></i> เมนูหลัก</a></li> 
        
        <li><a class="<?php if($pA=='m_ita_year'){echo 'active';}?>" href="<?php echo base_url('backoffice/ita/รายการประเมินประจำปี');?>"><i class="far fa-calendar-minus"></i> รายการประเมินประจำปี</a></li> 

        <li><a class="<?php if($pA=='m_ita_new'){echo 'active';}?>" href="<?php echo base_url('backoffice/ita/สร้างประเมินประจำปี');?>"><i class="fas fa-plus"></i> สร้างประเมินประจำปี</a></li> 
    </ul> 
</div>