<div id="menu_side">
    <ul>
        <li><a class="home" href="<?php echo base_url('backoffice/tab/3');?>"><i class="fas fa-home"></i> เมนูหลัก</a></li>
        <li><a class="<?php if($pA==''){echo 'active';}?>" href="<?php echo base_url('backoffice/ข่าวสาร/'.$type);?>"><i class="fas fa-newspaper"></i> ทั้งหมด</a></li> 
        <?php 
        foreach ($ReDPT['Re_dpt'] as $row_Re_dpt){ 
            $ReDP = $this->B_News_m->getDP($row_Re_dpt->dptype_id);
        ?>
            <div class="row mb-3 border">
                <div class="col-12 bg_main_light p-1 text-center">
                    <?php echo $row_Re_dpt->dptype_name;?>
                </div>
                <div class="col-12">
                    <?php foreach ($ReDP['Re_dp'] as $row_Re_dp){ ?>
                        <li><a class="<?php if($pA==$row_Re_dp->dp_name){echo 'active';}?>" href="<?php echo base_url('backoffice/ข่าวสาร/'.$type.'/'.$row_Re_dp->dp_name.'');?>"><i class="fas fa-newspaper"></i> <?php echo $row_Re_dp->dp_name?></a></li> 
                    <?php } ?>
                </div>
            </div>

        <?php } ?>
    </ul>
</div>
<br><br><br><br><br>