<div id="menu_side">
    <ul>
        <li><a class="home" href="<?php echo base_url('backoffice/tab/2');?>"><i class="fas fa-home"></i> เมนูหลัก</a></li> 

        <?php if($type_id!='3'){ ?>
        <li><a class="active" href="<?php echo base_url('backoffice/บุคลากร/'.$type_name.'');?>"><i class="fas fa-sitemap"></i> <?php echo $type_name;?></a></li> 
        <?php } ?>
        <?php 
        if($type_id=='3'){
        foreach ($ReDP['Re_d'] as $menu_Re_d){ 
        ?>
            <li><a class="<?php if($depart_name==$menu_Re_d->dp_name){echo 'active';}?>" href="<?php echo base_url('backoffice/บุคลากร/'.$type_name.'/'.$menu_Re_d->dp_name.'');?>"><i class="fas fa-caret-right"></i> <?php echo $menu_Re_d->dp_name;?></a></li> 
        <?php }} ?>
    </ul>
</div>