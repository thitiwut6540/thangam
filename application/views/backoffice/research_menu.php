<div id="menu_side">
    <ul>
        <li><a class="home" href="<?php echo base_url('backoffice/tab/4');?>"><i class="fas fa-home fa-lg"></i> เมนูหลัก</a></li>
        <li><a class="<?php if($pA=='ผลสำรวจความพึงพอใจ'){echo 'active';}?>" href="<?php echo base_url('backoffice/ผลสำรวจความพึงพอใจ');?>"><i class="fas fa-chart-bar fa-lg"></i> ผลสำรวจความพึงพอใจ</a></li>
        <li><a class="<?php if($pA=='รายการผู้กรอกแบบสำรวจ'){echo 'active';}?>" href="<?php echo base_url('backoffice/ผลสำรวจความพึงพอใจ/รายการผู้กรอกแบบสำรวจ');?>"><i class="fas fa-list-ol fa-lg"></i> รายการผู้กรอกแบบสำรวจ</a></li>
    </ul>
</div>