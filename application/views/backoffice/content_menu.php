<div id="menu_side">
    <ul>
        <li><a class="home" href="<?php echo base_url('Backoffice/dashboard');?>"><i class="fas fa-home"></i> เมนูหลัก</a></li>
        <li><a class="<?php if($pA=='หัวข้อข้อมูล'){echo 'active';}?>" href="<?php echo base_url('Backoffice/หัวข้อข้อมูล');?>"><i class="fas fa-list"></i> ประเภทหัวข้อข้อมูล</a></li>
        <?php
            if ($Re_m['total_ReD'] > 0){
            foreach ($Re_m['ReD'] as $row_Re_D){
            ?>
            <li><a class="<?php if($pA==$row_Re_D->dp_name){echo 'active';}?> text-nowrap" href="<?php echo base_url('Backoffice/หัวข้อข้อมูล/'.$row_Re_D->dp_name.'');?>"><i class="fas fa-list"></i> <?php echo $row_Re_D->dp_name; ?></a></li>
        <?php }} ?>
    </ul>
</div>