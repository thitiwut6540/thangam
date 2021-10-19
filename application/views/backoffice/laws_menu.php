<div id="menu_side">
    <ul>
        <li><a class="home" href="<?php echo base_url('Backoffice/dashboard');?>"><i class="fas fa-home"></i> เมนูหลัก</a></li>
        <li><a class="<?php if($pA=='ประเภทกฎหมายและระเบียบ'){echo 'active';}?>" href="<?php echo base_url('Backoffice/กฎหมายและระเบียบ/ประเภทกฎหมายและระเบียบ');?>"><i class="fas fa-list-ol"></i> ประเภทกฎหมายและระเบียบ</a></li>
        <?php
            if ($Re_m['total_Re_lt_mu'] > 0){
            foreach ($Re_m['Re_lt_mu'] as $row_Re_lt_mu){
            ?>
            <li><a class="<?php if($pA==$row_Re_lt_mu->lt_name){echo 'active';}?> text-nowrap" href="<?php echo base_url('Backoffice/กฎหมายและระเบียบ/'.$row_Re_lt_mu->lt_name.'');?>"><i class="fas fa-book"></i> <?php echo $row_Re_lt_mu->lt_name; ?></a></li>
        <?php }} ?>
    </ul>
</div>