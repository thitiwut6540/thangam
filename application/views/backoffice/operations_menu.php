<div id="menu_side">
    <ul>
        <li><a class="home" href="<?php echo base_url('Backoffice/dashboard');?>"><i class="fas fa-home"></i> เมนูหลัก</a></li> 
        <?php foreach ($Re_m['ReD'] as $row_ReD){ ?>
            <li><a class="<?php if($pA==$row_ReD->dp_name){echo 'active';}?>" href="<?php echo base_url('Backoffice/ผลการดำเนินงาน/'.$row_ReD->dp_name);?>"><i class="far fa-calendar-minus"></i> <?php echo $row_ReD->dp_name;?></a></li> 
        <?php } ?>
    </ul>   
</div>