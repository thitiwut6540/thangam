<div id="menu_side">
    <ul>
        <li><a class="home" href="<?php echo base_url('backoffice/tab/4');?>"><i class="fas fa-home"></i> เมนูหลัก</a></li>
        <li><a class="<?php if($pA=='ประเภท'){echo 'active';}?>" href="<?php echo base_url('backoffice/เอกสารบริการประชาชน/ประเภท');?>"><i class="far fa-file-pdf"></i> เพิ่มประเภท</a></li> 
   
        <?php foreach ($ReDTM['Re_dtm'] as $row_Re_dtm){ ?>
            <li><a class="<?php if($pA==$row_Re_dtm->dt_name){echo 'active';}?>" href="<?php echo base_url('backoffice/เอกสารบริการประชาชน/'.$row_Re_dtm->dt_name.'');?>"><i class="far fa-file-pdf"></i> <?php echo $row_Re_dtm->dt_name?></a></li> 
        <?php } ?>
           

    </ul>
</div>
<br><br><br><br><br>