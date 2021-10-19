<div id="group_menu" class="carousel slide mt-5 pt-2 pt-md-0 mt-md-0" data-interval="false">
	<?php if(isset($accesstype) AND $accesstype='404'){ ?>
		<div class="row px-4 pt-2">
			<div class="col-12 px-4">
				<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
					<i class="fas fa-user-shield fa-4x"></i><br><br>
					<strong>ไม่สามารถเข้าใช้งานได้ !</strong> เนื่องจากการไม่ได้กำหนดสิทธิการใช้งานของในส่วนนี้
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
	<?php } ?>

	<?php 
		$pageTab1='';$pageTab2='';$pageTab3='';$pageTab4='';
		if(isset($tab) AND !empty($tab)){
			if($tab=='1'){$pageTab1='active';}
			else if($tab=='2'){$pageTab2='active';}
			else if($tab=='3'){$pageTab3='active';}
			else if($tab=='4'){$pageTab4='active';}
		}else{
			$pageTab1='active';
		}
		
	?>

	<div class="carousel-inner">
		<!-- 1. -->
		<div class="carousel-item <?php echo $pageTab1;?>">
			<div class="container-fluid p-0">
				<div class="row">
					<div class="col-12 col-lg-11 m_group_menu">
						<div class="row">
							<div class="col-8 text-center my-auto order-2"><h4>1. การจัดการเว็บไซต์</h4></div>
							<div class="col-2 text-left order-1">
								<a class="btn" href="#group_menu" role="button" data-slide="prev">
									<i class="fas fa-caret-left fa-2x"></i>
								</a>
							</div>
							<div class="col-2 text-right order-3">
								<a class="btn" href="#group_menu" role="button" data-slide="next">
									<i class="fas fa-caret-right fa-2x"></i>
								</a>
							</div>
						</div>
						<div class="row"><div class="col-12"><hr></div></div>

						<div class="row DS_box_menu d-flex justify-content-lg-left">
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/สิทธิการใช้งาน');?>" class="btn w-100 p-1 py-2 py-lg-4">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-user-shield fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text">สิทธิการใช้งาน</div>
									</div>
								</a>
							</div>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/ผู้ใช้งานระบบ');?>" class="btn w-100 p-1 py-2 py-lg-4">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-user fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text">ผู้ใช้งานระบบ</div>
									</div>
								</a>
							</div>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/สไลด์โชว์');?>" class="btn w-100 p-1 py-2 py-lg-4">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="far fa-images fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text">สไลด์โชว์</div>
									</div>
								</a>
							</div>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/ภาพแสดงหน้าแรก');?>" class="btn w-100 p-1 py-2 py-lg-4">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-image fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text">ภาพแสดงหน้าแรก (POPUP)</div>
									</div>
								</a>
							</div>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/ภาพประกาศ');?>" class="btn w-100 p-1 py-2 py-lg-4">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-bullhorn fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text">ภาพประกาศ</div>
									</div>
								</a>
							</div>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/ปุ่มลิงค์หน่วยงาน');?>" class="btn w-100 p-1 py-2 py-lg-4">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-link fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text">ปุ่มลิงค์หน่วยงาน</div>
									</div>
								</a>
							</div>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/ปุ่มลิงค์เมนู');?>" class="btn w-100 p-1 py-2 py-lg-4">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-bars fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text">ปุ่มลิงค์เมนู</div>
									</div>
								</a>
							</div>

							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('public/files/คู่มือการใช้งาน.pdf');?>" target="_blank" class="btn w-100 p-1 py-2 py-lg-4 btn_red">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-file-pdf fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text">คู่มือการใช้งาน Backoffice</div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- 2. -->
		<div class="carousel-item <?php echo $pageTab2;?>">
			<div class="container-fluid p-0">
				<div class="row">
					<div class="col-12 col-lg-11 m_group_menu">
						<div class="row">
							<div class="col-8 text-center my-auto order-2"><h4>2. ข้อมูลเทศบาล</h4></div>
							<div class="col-2 text-left order-1">
								<a class="btn" href="#group_menu" role="button" data-slide="prev">
									<i class="fas fa-caret-left fa-2x"></i>
								</a>
							</div>
							<div class="col-2 text-right order-3">
								<a class="btn" href="#group_menu" role="button" data-slide="next">
									<i class="fas fa-caret-right fa-2x"></i>
								</a>
							</div>
						</div>
						<div class="row"><div class="col-12"><hr></div></div>

						<div class="row DS_box_menu d-flex justify-content-lg-left">
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/ข้อมูลเทศบาล');?>" class="btn w-100 p-1 py-2 py-lg-4">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-table fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text">ข้อมูลเทศบาล</div>
									</div>
								</a>
							</div>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/หน่วยงานภายใน');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_purple">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-sitemap fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text">หน่วยงานภายใน</div>
									</div>
								</a>
							</div>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/โครงการ');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_purple">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-sitemap fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text">โครงการ</div>
									</div>
								</a>
							</div>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/หน่วยงานในสังกัด');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_purple">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-sitemap fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text">หน่วยงานในสังกัด</div>
									</div>
								</a>
							</div>
						</div>

						<div class="row DS_box_menu d-flex justify-content-lg-left">
							<?php 
							if ($ReMT['total_Re_mt'] > 0){
							foreach ($ReMT['Re_mt'] as $row_Re_mt){
							?>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/บุคลากร/'.$row_Re_mt->memtype_name.'');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_green">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-users fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text"><?php echo $row_Re_mt->memtype_name;?></div>
									</div>
								</a>
							</div>
							<?php }} ?>
						</div>

						<div class="row DS_box_menu d-flex justify-content-lg-left">
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/สถานที่สำคัญ');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_pst_green">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-map-marker-alt fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text">สถานที่สำคัญ</div>
									</div>
								</a>
							</div>

							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/สินค้าโอทอป');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_pst_green">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-lemon fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto">สินค้าโอทอป</div>
									</div>
								</a>
							</div>

							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/ita');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_pst_green">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-list-alt fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto">ITA</div>
									</div>
								</a>
							</div>

							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/lpa');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_pst_green">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-list-alt fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto">LPA</div>
									</div>
								</a>
							</div>

							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/ทําเนียบ/นายกเทศมนตรี');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_orange">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-user-clock fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto">ทําเนียบนายกเทศมนตรี</div>
									</div>
								</a>
							</div>

							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/ทําเนียบ/ปลัดเทศบาล');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_orange">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-user-clock fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto">ทําเนียบปลัดเทศบาล</div>
									</div>
								</a>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- 3. -->
		<div class="carousel-item <?php echo $pageTab3;?>">
			<div class="container-fluid p-0">
				<div class="row">
					<div class="col-12 col-lg-11 m_group_menu">
						<div class="row">
							<div class="col-8 text-center my-auto order-2"><h4>3. ประชาสัมพันธ์</h4></div>
							<div class="col-2 text-left order-1">
								<a class="btn" href="#group_menu" role="button" data-slide="prev">
									<i class="fas fa-caret-left fa-2x"></i>
								</a>
							</div>
							<div class="col-2 text-right order-3">
								<a class="btn" href="#group_menu" role="button" data-slide="next">
									<i class="fas fa-caret-right fa-2x"></i>
								</a>
							</div>
						</div>
						<div class="row"><div class="col-12"><hr></div></div>
						<div class="row DS_box_menu d-flex justify-content-lg-left">
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/ข่าวสาร/ประเภทข่าวสาร');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_orange">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="far fa-file-pdf fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text">ประเภทข่าวสาร</div>
									</div>
								</a>
							</div>

							<?php 
							if ($ReNT['total_Re_nt'] > 0){
							foreach ($ReNT['Re_nt'] as $row_Re_nt){
							?>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/ข่าวสาร/'.$row_Re_nt->newstype_name.'');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_orange">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="far fa-file-pdf fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text"><?php echo $row_Re_nt->newstype_name;?></div>
									</div>
								</a>
							</div>
							<?php }} ?>

						</div>

						<div class="row DS_box_menu d-flex justify-content-lg-left">
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/กฎหมายและระเบียบ/ประเภท');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_yellow">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-book fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text">ประเภทกฎหมายและระเบียบ</div>
									</div>
								</a>
							</div>

							<?php 
							if ($ReST['total_Re_st'] > 0){
							foreach ($ReST['Re_st'] as $row_Re_st){
							?>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/กฎหมายและระเบียบ/'.$row_Re_st->stt_t_name.'');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_yellow">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-book fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text"><?php echo $row_Re_st->stt_t_name;?></div>
									</div>
								</a>
							</div>
							<?php }} ?>
						</div>

						<div class="row DS_box_menu d-flex justify-content-lg-left">
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/แผนงาน/ประเภท');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_green">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="far fa-paper-plane fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text">ประเภทแผนงาน</div>
									</div>
								</a>
							</div>

							<?php 
							if ($ReRMT['total_Re_rmt'] > 0){
							foreach ($ReRMT['Re_rmt'] as $row_Re_rmt){
							?>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/แผนงาน/'.$row_Re_rmt->rm_t_name.'');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_green">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="far fa-paper-plane fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text"><?php echo $row_Re_rmt->rm_t_name;?></div>
									</div>
								</a>
							</div>
							<?php }} ?>
						</div>

						<div class="row DS_box_menu d-flex justify-content-lg-left">
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/ผลการดำเนินงาน');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_blue">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-trophy fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text">ผลการดำเนินงาน</div>
									</div>
								</a>
							</div>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/ถามและตอบ');?>" class="btn w-100 p-1 py-2 py-lg-4">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-question fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text"> ถามและตอบ (Q&A)</div>
									</div>
								</a>
							</div>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/แกลเลอรี่ภาพ');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_pst_green">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-images fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto DS_text">แกลเลอรี่ภาพ</div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- 4. -->
		<div class="carousel-item <?php echo $pageTab4;?>">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-lg-11 m_group_menu">
						<div class="row">
							<div class="col-8 text-center my-auto order-2"><h4>4. บริการประชาชน</h4></div>
							<div class="col-2 text-left order-1">
								<a class="btn btn_pink" href="#group_menu" role="button" data-slide="prev">
									<i class="fas fa-caret-left fa-2x"></i>
								</a>
							</div>
							<div class="col-2 text-right order-3">
								<a class="btn btn_pink" href="#group_menu" role="button" data-slide="next">
									<i class="fas fa-caret-right fa-2x"></i>
								</a>
							</div>
						</div>
						<div class="row"><div class="col-12"><hr></div></div>
						<div class="row mb-3 DS_box_menu d-flex justify-content-lg-left">
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<div id="total_fl" class="DS_total_icon"></div>
								<a href="<?php echo base_url('backoffice/เอกสารบริการประชาชน');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_blue">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="far fa-file-pdf fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto">เอกสารบริการประชาชน</div>
									</div>
								</a>
							</div>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<div id="total_cr" class="db_total_icon"></div>
								<a href="<?php echo base_url('backoffice/ร้องเรียนทุจริตและประพฤติมิชอบ');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_red">
									<div class="row">
									<div class="col-4 col-lg-12 text-center my-auto"><img class="img-fluid mb-lg-3" src="<?php echo base_url('public/images/menu/logo_corrupt.png'); ?>"></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto">ร้องเรียนทุจริต ประพฤติมิชอบ</div>
									</div>
								</a>
							</div>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<div id="total_cp" class="DS_total_icon"></div>
								<a href="<?php echo base_url('backoffice/ร้องเรียนร้องทุกข์');?>" class="btn w-100 p-1 py-2 py-lg-4">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-volume-up fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto">ร้องเรียนร้องทุกข์</div>
									</div>
								</a>
							</div>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<div id="total_rq" class="db_total_icon"></div>
								<a href="<?php echo base_url('backoffice/ขอรับบริการออนไลน์');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_grey">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><img class="img-fluid mb-lg-3" src="<?php echo base_url('public/images/menu/logo_service.png'); ?>"></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto">ขอรับบริการออนไลน์</div>
									</div>
								</a>
							</div>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/ผลสำรวจความพึงพอใจ');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_yellow">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-chart-pie fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto">ผลสำรวจความพึงพอใจ</div>
									</div>
								</a>
							</div>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<div id="total_qa" class="db_total_icon"></div>
								<a href="<?php echo base_url('backoffice/webboard');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_pst_blue">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-comment fa-3x fa-fw mb-lg-3 fa-flip-horizontal"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto">เว็บบอร์ด</div>
									</div>
								</a>
							</div>
							<div class="col-12 col-md-6 col-lg-2 p-2">
								<a href="<?php echo base_url('backoffice/สมุดลงนาม');?>" class="btn w-100 p-1 py-2 py-lg-4 btn_orange">
									<div class="row">
										<div class="col-4 col-lg-12 text-center my-auto"><i class="fas fa-book fa-3x fa-fw mb-lg-3"></i></div>
										<div class="col-8 col-lg-12 text-left text-lg-center my-auto">สมุดลงนาม</div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<script>
	$(document).ready(function() {
		setInterval(function(){showTotal()}, (5*(60*1000)));
		//showTotal();

		function showTotal(){
			$.ajax({
				type: "POST",
				url: base_url+"B_Dashboard/showTotal",
				dataType: "json",
				success: function(data) {
					// console.log(data);
					$("#total_ps").html(data.total_ps);
					$("#total_mem").html(data.total_mem);
					$("#total_dp").html(data.total_dp);
					$("#total_pj").html(data.total_pj);
					$("#total_gl").html(data.total_gl);
					$("#total_nw").html(data.total_nw);
					$("#total_lm").html(data.total_lm);
					$("#total_lw").html(data.total_lw);
					$("#total_fl").html(data.total_fl);
					$("#total_cp").html(data.total_cp);
					$("#total_ot").html(data.total_ot);
					$("#total_qa").html(data.total_qa);
					$("#total_ct").html(data.total_ct);
					$("#total_rq").html(data.total_rq);
				}
			});
		}
	});
</script>