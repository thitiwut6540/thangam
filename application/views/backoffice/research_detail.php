<?php foreach ($Re['Re_rm'] as $row_Re_rm);?>
<div class="container-fluid">
    <div id="panel" class="toggled">
        <div id="sidebar">
            <?php $this->load->view('backoffice/research_menu.php');?>
        </div>
    </div> 
    <div id="content" class="toggled">    
        <div class="row mb-2">
            <div id="navi" class="col-12">
                <a href="<?php echo base_url('backoffice');?>" ><span class="border-right pr-3 mr-3">Backoffice</span></a>
                <i class="fas fa-caret-right"></i> <a href="<?php echo base_url('รายการผู้กรอกแบบสำรวจ');?>" >รายการผู้กรอกแบบสำรวจ</a>
                <i class="fas fa-caret-right"></i> รายละเอียด
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12">
                                <i class="fas fa-list-ol fa-lg"></i> รายการข้อมูลผู้กรอกแบบสำรวจ
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                        <?php if ($Re['total_Re_rm'] > 0){ ?>
                            <div class="row mt-4 mb-4">
                                <div class="col-12">
                                    <div class="jumbotron bg-white p-4">
                                  
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    ชื่อ-นามสกุล ผู้กรอกข้อมูล : <?php echo $row_Re_rm->rs_name;?>
                                                </div>
                                            </div>
                                            <div class="form-row mb-3">
                                                <div class="col-12">
                                                    <?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_sex,'M');?>เพศชาย
                                                    &nbsp;&nbsp;&nbsp;<?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_sex,'W');?>เพศหญิง
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-12">
                                                    <?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_age,'1');?>ต่ำกว่า 20 ปี
                                                    &nbsp;&nbsp;&nbsp;<?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_age,'2');?>20 - 30 ปี
                                                    &nbsp;&nbsp;&nbsp;<?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_age,'3');?>31 - 40 ปี
                                                    &nbsp;&nbsp;&nbsp;<?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_age,'4');?>41 - 50 ปี
                                                    &nbsp;&nbsp;&nbsp;<?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_age,'5');?>50 ปีขึ้นไป
                                                </div>
                                            </div>
                                            <div class="form-row mt-3">
                                                <div class="form-group col-md-12">
                                                    <label for="">ที่อยู่</label>
                                                    <div class="col-12 p-2 border"><?php echo nl2br($row_Re_rm->rs_add);?></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    เบอร์โทรศัพท์ : <?php echo $row_Re_rm->rs_tel;?>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    อีเมลล์ : <?php echo $row_Re_rm->rs_email;?>
                                                </div>
                                            </div>
                                            <div class="row"><div class="col-12"><hr></div></div>

                                            <div class="row">
                                                <div class="col-12 mb-3 font-weight-bold">1. เรื่องที่รับบริการ (ตอบได้มากกว่า 1 ข้อ) <span class="tx_red">*</span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_1_1);?>การชำระภาษีโรงเรือนและที่ดิน
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_1_2);?>การชำระภาษีป้าย
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_1_3);?>การขอรับเบี้ยยังชีพผู้สูงอายุ
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_1_4);?>การขอรับเบี้ยยังชีพคนพิการ
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_1_5);?>การขอรับเบี้ยยังชีพผู้ป่วยโรคเอดส์
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_1_6);?>การขออนุญาตปลูกสร้างอาคาร
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_1_7);?>การขอจัดตั้งสถานจำหน่ายอาหารและสะสมอาหาร
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_1_8);?>การขอประกอบกิจการที่เป็นอันตรายต่อสุขภาพ
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_1_9);?>การขอแบบบ้านเพื่อประชาชน
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_1_10);?>การขอจดทะเบียนพาญิชย์
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_1_11);?>การฉีดวัดซีนป้องกันโรคพิษสุนัขบ้า
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_1_12);?>การฉีดพ่นสารเคมีเพื่อป้องกันโรคไข้เลือดออก
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_1_13);?>การยื่นเรื่องร้องทุกข์/ร้องเรียน
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_1_14);?>การขอข้อมูลข่าวสารทางราชการ
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_1_15);?>การใช้ Internet ตำบล
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_1_16);?>การชำระภาษีบำรุงท้องที่
                                                </div>
                                            </div>
                                            <div class="row"><div class="col-12"><hr></div></div>

                                            <div class="row">
                                                <div class="col-12 font-weight-bold">2. ด้านกระบวนการ/ขั้นตอนในการให้บริการ <span class="tx_red">*</span></div>
                                                <div class="col-12 tx_red">ระดับความพึงพอใจ 5 = มากที่สุด 4 = มาก 3 = ปานกลาง 2 = น้อย และ 1 = น้อยที่สุด</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 mt-3">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th width="40">1</th>
                                                            <th width="40">2</th>
                                                            <th width="40">3</th>
                                                            <th width="40">4</th>
                                                            <th width="40">5</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>2.1 ขั้นตอนในการให้บริการมีความคล่องตัว ไม่ซับซ้อน</td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_1,'1');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_1,'2');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_1,'3');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_1,'4');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_1,'5');?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2.2 ขั้นตอนในการให้บริการมีความเหมาะสม</td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_2,'1');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_2,'2');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_2,'3');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_2,'4');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_2,'5');?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2.3 ระยะเวลาในการให้บริการมีความเหมาะสม</td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_3,'1');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_3,'2');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_3,'3');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_3,'4');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_3,'5');?></td>
                                                        </tr>
                                                        <tr>
                                                            <td> 2.4 ให้บริการด้วยความเสมอภาคตามลำดับก่อน-หลัง</td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_4,'1');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_4,'2');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_4,'3');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_4,'4');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_4,'5');?></td>
                                                        </tr>
                                                        <tr>
                                                            <td> 2.5 ให้บริการด้วยความสะดวกรวดเร็ว ทันตามกำหนดเวลา</td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_5,'1');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_5,'2');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_5,'3');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_5,'4');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_2_5,'5');?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-12 font-weight-bold">3. ด้านการให้บริการของเจ้าหน้าที่ <span class="tx_red">*</span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 mt-3">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th width="40">1</th>
                                                            <th width="40">2</th>
                                                            <th width="40">3</th>
                                                            <th width="40">4</th>
                                                            <th width="40">5</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>3.1 ให้บริการด้วยความสุภาพ อ่อนน้อม และเป็นกันเอง</td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_1,'1');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_1,'2');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_1,'3');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_1,'4');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_1,'5');?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>3.2 มีความเอาใจใส่ กระตือรือร้น และเต็มใจให้บริการ</td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_2,'1');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_2,'2');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_2,'3');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_2,'4');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_2,'5');?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>3.3 รับฟังปัญหาหรือข้อซักถามของผู้รับบริการอย่างเต็มใจ</td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_3,'1');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_3,'2');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_3,'3');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_3,'4');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_3,'5');?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>3.4 ให้คำอธิบายและตอบข้อสงสัยได้ตรงประเด็น</td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_4,'1');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_4,'2');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_4,'3');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_4,'4');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_4,'5');?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>3.5 มีความชัดเจนในการให้คำแนะนำที่เป็นประโยชน์</td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_5,'1');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_5,'2');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_5,'3');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_5,'4');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_3_5,'5');?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-12 font-weight-bold">4. ด้านสิ่งอำนวยความสะดวก <span class="tx_red">*</span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 mt-3">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th width="40">1</th>
                                                            <th width="40">2</th>
                                                            <th width="40">3</th>
                                                            <th width="40">4</th>
                                                            <th width="40">5</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td> 4.1 ความชัดเจนของป้าย สัญลักษณ์ ประชาสัมพันธ์บอกจุดบริการ</td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_1,'1');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_1,'2');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_1,'3');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_1,'4');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_1,'5');?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>4.2 จุด /ช่อง การให้บริการมีความเหมาะสมและเข้าถึงได้สะดวก</td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_2,'1');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_2,'2');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_2,'3');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_2,'4');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_2,'5');?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>4.3 ความเพียงพอของสิ่งอำนวยความสะดวก เช่น ที่นั่งรอ รับบริการ น้ำดื่ม  ที่จอดรถ ฯลฯ</td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_3,'1');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_3,'2');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_3,'3');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_3,'4');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_3,'5');?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>4.4 ความสะอาดของสถานที่ให้บริการ </td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_4,'1');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_4,'2');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_4,'3');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_4,'4');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_4,'5');?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>4.5 ท่านมีความพึงพอใจ / ไม่พึงพอใจต่อการให้บริการในภาพรวม อยู่ในระดับใด</td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_5,'1');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_5,'2');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_5,'3');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_5,'4');?></td>
                                                            <td><?php echo $this->B_Research_m->chkRadio($row_Re_rm->rs_4_5,'5');?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                            <div class="row"><div class="col-12"><hr></div></div>

                                            <div class="row">
                                                <div class="col-12 mb-3 font-weight-bold">5. <?php echo ANW_N1;?> ควรปรับปรุงเรื่องใด (ตอบได้มากกว่า 1 ข้อ) <span class="tx_red">*</span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_5_1);?>ด้านการให้บริการของเจ้าหน้าที่ในหน่วยงาน
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_5_2);?>ด้านข้อมูลข่าวสารที่ให้บริการแก่ประชาชน
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_5_3);?>ด้านสถานที่ในการบริการข้อมูลข่าวสาร
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_5_4);?>ด้านวิธีการเข้ามามีส่วนร่วมของประชาชนในการจัดทำแผนพัฒนา
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_5_5);?>ด้านบริการการรับชำระภาษี
                                                    <br><?php echo $this->B_Research_m->chkCheckbox($row_Re_rm->rs_5_6);?>ด้านบริการการอนุญาตก่อสร้างอาคาร
                                                </div>
                                            </div>
                                            <div class="row"><div class="col-12"><hr></div></div>
                                            <div class="row px-3">
                                                6. ข้อเสนอแนะอื่นๆ
                                                <div class="col-12 p-2 border"><?php echo nl2br($row_Re_rm->rs_6);?></div>
                                            </div>
                            
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-danger mb-0" role="alert"><i class="fas fa-exclamation-triangle"></i> ไม่สามารถระบุข้อมูลผู้กรอกแบบสำรวจได้</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>