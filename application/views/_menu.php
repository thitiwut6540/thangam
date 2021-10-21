<ul>
    <li><a href="<?php echo base_url(); ?>"><div class="btn_non_dropdown"><i class="fas fa-home fa-fw"></i> หน้าแรก</div></a></li>
    <li>
        <div class="dropdown">
            <button class="dropbtn">
                <div class="row">
                    <div class="col"><i class="fas fa-list-ul fa-fw"></i> ข้อมูลเทศบาล</div>
                    <div class="col-auto ms-auto my-auto"><i class="fas fa-caret-down"></i></div>
                </div>
            </button>
            <div class="dropdown-content">
                <?php 
                    $ReM1=$this->M_Menu_m->getMenuInfo();
                    foreach ($ReM1['Re_if'] as $menu_Re_if) {
                ?>
                    <a href="<?php echo base_url('ข้อมูลเทศบาล/'.$menu_Re_if->if_header); ?>"><?php echo $menu_Re_if->if_header; ?></a>
                <?php } ?>
            </div>
        </div>
    </li>
    <li>
        <div class="dropdown">
            <button class="dropbtn">
                <div class="row">
                    <div class="col"><i class="fas fa-images fa-fw"></i> แกลลอรี่</div>
                    <div class="col-auto ms-auto my-auto"><i class="fas fa-caret-down"></i></div>
                </div>
            </button>
            <div class="dropdown-content">
                <?php 
                    $ReM2=$this->M_Menu_m->getMenuGallery();
                    foreach ($ReM2['Re_dp'] as $menu_Re_dp) {
                ?>
                    <a href="<?php echo base_url('แกลเลอรี่/'.$menu_Re_dp->dp_name.''); ?>"><?php echo $menu_Re_dp->dp_name; ?></a>
                <?php } ?>
            </div>
        </div>
    </li>
    <li>
        <div class="dropdown">
            <button class="dropbtn">
                <div class="row">
                    <div class="col"><i class="fas fa-network-wired fa-fw"></i> หน่วยงานเทศบาล</div>
                    <div class="col-auto ms-auto my-auto"><i class="fas fa-caret-down"></i></div>
                </div>
            </button>
            <div class="dropdown-content">
                <?php 
                    $ReM3=$this->M_Menu_m->getMenuDepart('1');
                    foreach ($ReM3['Re_dp'] as $menu_Re_dp1) {
                ?>
                    <a href="<?php echo base_url('หน่วยงาน/'.$menu_Re_dp1->dptype_name.'/'.$menu_Re_dp1->dp_name.''); ?>"><?php echo $menu_Re_dp1->dp_name; ?></a>
                <?php } ?>
            </div>
        </div>
    </li>
    <li>
        <div class="dropdown">
            <button class="dropbtn">
                <div class="row">
                    <div class="col"><i class="fas fa-network-wired fa-fw"></i> โครงสร้าง</div>
                    <div class="col-auto ms-auto my-auto"><i class="fas fa-caret-down"></i></div>
                </div>
            </button>
            <div class="dropdown-content">
                <?php 
                    $ReM4=$this->M_Menu_m->getMenuDepart('2');
                    foreach ($ReM4['Re_dp'] as $menu_Re_dp2) {
                ?>
                    <a href="<?php echo base_url('หน่วยงาน/'.$menu_Re_dp2->dptype_name.'/'.$menu_Re_dp2->dp_name.''); ?>"><?php echo $menu_Re_dp2->dp_name; ?></a>
                <?php } ?>
            </div>
        </div>
    </li>
    <li>
        <div class="dropdown">
            <button class="dropbtn">
                <div class="row">
                    <div class="col"><i class="fas fa-network-wired fa-fw"></i> หน่วยงานในสังกัด</div>
                    <div class="col-auto ms-auto my-auto"><i class="fas fa-caret-down"></i></div>
                </div>
            </button>
            <div class="dropdown-content">
                <?php 
                    $ReM5=$this->M_Menu_m->getMenuDepart('3');
                    foreach ($ReM5['Re_dp'] as $menu_Re_dp3) {
                ?>
                    <a href="<?php echo base_url('หน่วยงาน/'.$menu_Re_dp3->dptype_name.'/'.$menu_Re_dp3->dp_name.''); ?>"><?php echo $menu_Re_dp3->dp_name; ?></a>
                <?php } ?>
            </div>
        </div>
    </li>
    <li><a href="<?php echo base_url('บุคลากร/คณะผู้บริหาร'); ?>"><div class="btn_non_dropdown"><i class="fas fa-id-card fa-fw"></i> คณะผู้บริหาร</div></a></li>
    <li><a href="<?php echo base_url('บุคลากร/สมาชิกสภาฯ'); ?>"><div class="btn_non_dropdown"><i class="fas fa-id-card fa-fw"></i> สมาชิกสภา</div></a></li>
    <li>
        <div class="dropdown">
            <button class="dropbtn">
                <div class="row">
                    <div class="col"><i class="fas fa-id-card fa-fw"></i> บุคลากร/เจ้าหน้าที่</div>
                    <div class="col-auto ms-auto my-auto"><i class="fas fa-caret-down"></i></div>
                </div>
            </button>
            <div class="dropdown-content">
                <?php 
                    $ReM6=$this->M_Menu_m->getMenuDepart('1');
                    foreach ($ReM6['Re_dp'] as $menu_Re_dp4) {
                ?>
                    <a href="<?php echo base_url('หน่วยงาน/'.$menu_Re_dp4->dptype_name.'/'.$menu_Re_dp4->dp_name.''); ?>"><?php echo $menu_Re_dp4->dp_name; ?></a>
                <?php } ?>
            </div>
        </div>
    </li>
    <li><a href="<?php echo base_url('บุคลากร/ผู้นำท้องถิ่น'); ?>"><div class="btn_non_dropdown"><i class="fas fa-id-card fa-fw"></i> ผู้นำท้องถิ่น</div></a></li>
    <li><a href="<?php echo base_url('บุคลากร/หัวหน้าส่วนราชการ'); ?>"><div class="btn_non_dropdown"><i class="fas fa-id-card fa-fw"></i> หัวหน้าส่วนราชการ</div></a></li>
    <li>
        <div class="dropdown">
            <button class="dropbtn">
                <div class="row">
                    <div class="col"><i class="fas fa-newspaper fa-fw"></i> ข่าวสาร</div>
                    <div class="col-auto ms-auto my-auto"><i class="fas fa-caret-down"></i></div>
                </div>
            </button>
            <div class="dropdown-content">
                <?php 
                    $ReM7=$this->M_Menu_m->getMenuNews();
                    foreach ($ReM7['Re_nt'] as $menu_Re_nt1) {
                ?>
                    <a href="<?php echo base_url('ข่าวสาร/'.$menu_Re_nt1->newstype_name.''); ?>"><?php echo $menu_Re_nt1->newstype_name; ?></a>
                <?php } ?>
            </div>
        </div>
    </li>
    <li>
        <div class="dropdown">
            <button class="dropbtn">
                <div class="row">
                    <div class="col"><i class="fas fa-balance-scale fa-fw"></i> กฎหมาย/ระเบียบ</div>
                    <div class="col-auto ms-auto my-auto"><i class="fas fa-caret-down"></i></div>
                </div>
            </button>
            <div class="dropdown-content">
                    <?php 
                        $ReM8=$this->M_Menu_m->getMenuLaws();
                        foreach ($ReM8['Re_stt'] as $menu_Re_stt1) {
                    ?>
                    <a href="<?php echo base_url('กฎหมายและระเบียบ/'.$menu_Re_stt1->stt_t_name.''); ?>"><?php echo $menu_Re_stt1->stt_t_name; ?></a>
                <?php } ?>
            </div>
        </div>
    </li>
    <li>
        <div class="dropdown">
            <button class="dropbtn">
                <div class="row">
                    <div class="col"><i class="fas fa-chart-line fa-fw"></i> ผลการดำเนินงาน</div>
                    <div class="col-auto ms-auto my-auto"><i class="fas fa-caret-down"></i></div>
                </div>
            </button>
            <div class="dropdown-content">
                    <?php 
                        $ReM9=$this->M_Menu_m->getMenuDepart("");
                        foreach ($ReM9['Re_dp'] as $menu_Re_dp5) {
                    ?>
                    <a href="<?php echo base_url('ผลการดำเนินงาน/'.$menu_Re_dp5->dp_name.''); ?>"><?php echo $menu_Re_dp5->dp_name; ?></a>
                <?php } ?>
            </div>
        </div>
    </li>
    <li>
        <div class="dropdown">
            <button class="dropbtn">
                <div class="row">
                    <div class="col"><i class="fas fa-paper-plane fa-fw"></i> แผนงาน</div>
                    <div class="col-auto ms-auto my-auto"><i class="fas fa-caret-down"></i></div>
                </div>
            </button>
            <div class="dropdown-content">
                    <?php 
                        $ReM10=$this->M_Menu_m->getMenuRoadmapType();
                        foreach ($ReM10['Re_rmt'] as $menu_Re_rmt) {
                    ?>
                    <a href="<?php echo base_url('แผนงาน/'.$menu_Re_rmt->rm_t_name.''); ?>"><?php echo $menu_Re_rmt->rm_t_name; ?></a>
                <?php } ?>
            </div>
        </div>
    </li>
    <li><a href="<?php echo base_url('ทําเนียบนายกเทศมนตรี'); ?>"><div class="btn_non_dropdown"><i class="fas fa-user-clock fa-fw"></i> ทําเนียบนายกเทศมนตรี</div></a></li>
    <li><a href="<?php echo base_url('ทําเนียบปลัดเทศบาล'); ?>"><div class="btn_non_dropdown"><i class="fas fa-user-clock fa-fw"></i> ทําเนียบปลัดเทศบาล</div></a></li>





    
</ul>