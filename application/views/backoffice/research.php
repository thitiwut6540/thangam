<?php
foreach($Re['Re_rs'] as $row_Re_rs);
foreach($Re['Re_avg'] as $row_Re_avg);
foreach($Re['Re_std'] as $row_Re_std);
?>
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
                <i class="fas fa-caret-right"></i> ผลสำรวจความพึงพอใจ
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="box_con">
                    <div class="box_con_header">
                        <div class="row">
                            <div class="col-12">
                            <i class="fas fa-chart-bar fa-lg"></i> ผลสำรวจความพึงพอใจ
                            </div>
                        </div>
                    </div>
                    <div class="box_con_detail">
                    <div class="row">
                            <div class="col-12 font-weight-bold">1. เรื่องที่รับบริการ (ตอบได้มากกว่า 1 ข้อ)</div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="40">ข้อ</th>
                                            <th width="">เรื่องที่รับบริการ</th>
                                            <th width="100">จำนวน</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.1</td>
                                            <td>การชำระภาษีโรงเรือนและที่ดิน</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_1; ?></td>
                                        </tr>
                                        <tr>
                                            <td>1.2</td>
                                            <td>การชำระภาษีป้าย</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_2; ?></td>
                                        </tr>
                                        <tr>
                                            <td>1.3</td>
                                            <td>การขอรับเบี้ยยังชีพผู้สูงอายุ</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_3; ?></td>
                                        </tr>
                                        <tr>
                                            <td>1.4</td>
                                            <td>การขอรับเบี้ยยังชีพคนพิการ</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_4; ?></td>
                                        </tr>
                                        <tr>
                                            <td>1.5</td>
                                            <td>การขอรับเบี้ยยังชีพผู้ป่วยโรคเอดส์</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_5; ?></td>
                                        </tr>
                                        <tr>
                                            <td>1.6</td>
                                            <td>การขออนุญาตปลูกสร้างอาคาร</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_6; ?></td>
                                        </tr>
                                        <tr>
                                            <td>1.7</td>
                                            <td>การขอจัดตั้งสถานจำหน่ายอาหารและสะสมอาหาร</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_7; ?></td>
                                        </tr>
                                        <tr>
                                            <td>1.8</td>
                                            <td>การขอประกอบกิจการที่เป็นอันตรายต่อสุขภาพ</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_8; ?></td>
                                        </tr>
                                        <tr>
                                            <td>1.9</td>
                                            <td>การขอแบบบ้านเพื่อประชาชน</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_9; ?></td>
                                        </tr>
                                        <tr>
                                            <td>1.10</td>
                                            <td>การขอจดทะเบียนพาญิชย์</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_10; ?></td>
                                        </tr>
                                        <tr>
                                            <td>1.11</td>
                                            <td>การฉีดวัดซีนป้องกันโรคพิษสุนัขบ้า</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_11; ?></td>
                                        </tr>
                                        <tr>
                                            <td>1.12</td>
                                            <td>การฉีดพ่นสารเคมีเพื่อป้องกันโรคไข้เลือดออก</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_12; ?></td>
                                        </tr>
                                        <tr>
                                            <td>1.13</td>
                                            <td>การยื่นเรื่องร้องทุกข์/ร้องเรียน</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_13; ?></td>
                                        </tr>
                                        <tr>
                                            <td>1.14</td>
                                            <td>การขอข้อมูลข่าวสารทางราชการ</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_14; ?></td>
                                        </tr>
                                        <tr>
                                            <td>1.15</td>
                                            <td>การใช้ Internet ตำบล</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_15; ?></td>
                                        </tr>
                                        <tr>
                                            <td>1.16</td>
                                            <td>การชำระภาษีบำรุงท้องที่</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_16; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6 mt-3">
                            <?php
                            //กราฟ 1--------

                            $sum_rs=($row_Re_rs->c_rs_1_1+$row_Re_rs->c_rs_1_2+$row_Re_rs->c_rs_1_3+$row_Re_rs->c_rs_1_4+$row_Re_rs->c_rs_1_5+$row_Re_rs->c_rs_1_6+$row_Re_rs->c_rs_1_7+$row_Re_rs->c_rs_1_8+$row_Re_rs->c_rs_1_9+$row_Re_rs->c_rs_1_10+$row_Re_rs->c_rs_1_11+$row_Re_rs->c_rs_1_12+$row_Re_rs->c_rs_1_13+$row_Re_rs->c_rs_1_14+$row_Re_rs->c_rs_1_15+$row_Re_rs->c_rs_1_16);

                            if($sum_rs != 0){$p1_1=round((($row_Re_rs->c_rs_1_1*100)/$sum_rs),2);}else{$p1_1=0;}
                            if($sum_rs != 0){$p1_2=round((($row_Re_rs->c_rs_1_2*100)/$sum_rs),2);}else{$p1_2=0;}
                            if($sum_rs != 0){$p1_3=round((($row_Re_rs->c_rs_1_3*100)/$sum_rs),2);}else{$p1_3=0;}
                            if($sum_rs != 0){$p1_4=round((($row_Re_rs->c_rs_1_4*100)/$sum_rs),2);}else{$p1_4=0;}
                            if($sum_rs != 0){$p1_5=round((($row_Re_rs->c_rs_1_5*100)/$sum_rs),2);}else{$p1_5=0;}
                            if($sum_rs != 0){$p1_6=round((($row_Re_rs->c_rs_1_6*100)/$sum_rs),2);}else{$p1_6=0;}
                            if($sum_rs != 0){$p1_7=round((($row_Re_rs->c_rs_1_7*100)/$sum_rs),2);}else{$p1_7=0;}
                            if($sum_rs != 0){$p1_8=round((($row_Re_rs->c_rs_1_8*100)/$sum_rs),2);}else{$p1_8=0;}
                            if($sum_rs != 0){$p1_9=round((($row_Re_rs->c_rs_1_9*100)/$sum_rs),2);}else{$p1_9=0;}
                            if($sum_rs != 0){$p1_10=round((($row_Re_rs->c_rs_1_10*100)/$sum_rs),2);}else{$p1_10=0;}
                            if($sum_rs != 0){$p1_11=round((($row_Re_rs->c_rs_1_11*100)/$sum_rs),2);}else{$p1_11=0;}
                            if($sum_rs != 0){$p1_12=round((($row_Re_rs->c_rs_1_12*100)/$sum_rs),2);}else{$p1_12=0;}
                            if($sum_rs != 0){$p1_13=round((($row_Re_rs->c_rs_1_13*100)/$sum_rs),2);}else{$p1_13=0;}
                            if($sum_rs != 0){$p1_14=round((($row_Re_rs->c_rs_1_14*100)/$sum_rs),2);}else{$p1_14=0;}
                            if($sum_rs != 0){$p1_15=round((($row_Re_rs->c_rs_1_15*100)/$sum_rs),2);}else{$p1_15=0;}
                            if($sum_rs != 0){$p1_16=round((($row_Re_rs->c_rs_1_16*100)/$sum_rs),2);}else{$p1_16=0;}

                            $g1_1=$p1_1*2;
                            $g1_2=$p1_2*2;
                            $g1_3=$p1_3*2;
                            $g1_4=$p1_4*2;
                            $g1_5=$p1_5*2;
                            $g1_6=$p1_6*2;
                            $g1_7=$p1_7*2;
                            $g1_8=$p1_8*2;
                            $g1_9=$p1_9*2;
                            $g1_10=$p1_10*2;
                            $g1_11=$p1_11*2;
                            $g1_12=$p1_12*2;
                            $g1_13=$p1_13*2;
                            $g1_14=$p1_14*2;
                            $g1_15=$p1_15*2;
                            $g1_16=$p1_16*2;

                            ?>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="40">ข้อ</th>
                                            <th width="150">จำนวน</th>
                                            <th width="150">เปอร์เซ็นต์</th>
                                            <th width="80%">กราฟ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.1</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_1; ?></td>
                                            <td><?php echo $g1_1."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $g1_1; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1.2</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_2; ?></td>
                                            <td><?php echo $g1_2."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $g1_2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1.3</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_3; ?></td>
                                            <td><?php echo $g1_3."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $g1_3; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1.4</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_4; ?></td>
                                            <td><?php echo $g1_4."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $g1_4; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1.5</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_5; ?></td>
                                            <td><?php echo $g1_5."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $g1_5; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1.6</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_6; ?></td>
                                            <td><?php echo $g1_6."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $g1_6; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1.7</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_7; ?></td>
                                            <td><?php echo $g1_7."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $g1_7; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1.8</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_8; ?></td>
                                            <td><?php echo $g1_8."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $g1_8; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1.9</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_9; ?></td>
                                            <td><?php echo $g1_9."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $g1_9; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1.10</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_10; ?></td>
                                            <td><?php echo $g1_10."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $g1_10; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1.11</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_11; ?></td>
                                            <td><?php echo $g1_11."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $g1_11; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1.12</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_12; ?></td>
                                            <td><?php echo $g1_12."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $g1_12; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1.13</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_13; ?></td>
                                            <td><?php echo $g1_13."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $g1_13; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1.14</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_14; ?></td>
                                            <td><?php echo $g1_14."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $g1_14; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1.15</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_15; ?></td>
                                            <td><?php echo $g1_15."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $g1_15; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1.16</td>
                                            <td><?php echo $row_Re_rs->c_rs_1_16; ?></td>
                                            <td><?php echo $g1_16."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $g1_16; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>รวม</td>
                                            <td><?php echo $sum_rs; ?></td>
                                            <td>100 %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row"><div class="col-12"><hr></div></div>
                        <div class="row">
                            <div class="col-12 font-weight-bold">2. ด้านกระบวนการ/ขั้นตอนในการให้บริการ</div>
                        </div>
                        <div class="row">
                            <!-- 2.1 -->
                            <div class="col-12 col-lg-6 mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-6"></div>
                                                <div class="col-3">คะแนนเฉลี่ย</div>
                                                <div class="col-3">ค่าเบียงเบน</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bg_darkpink p-2">
                                            <div class="row">
                                                <div class="col-6">2.1 ขั้นตอนในการให้บริการมีความคล่องตัว ไม่ซับซ้อน</div>
                                                <div class="col-3"><?php echo $row_Re_avg->a_rs_2_1; ?></div>
                                                <div class="col-3"><?php echo $row_Re_std->std_rs_2_1; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                //กราฟ 2--------

                                $sum_rs_2_1=($row_Re_rs->c_rs_2_1_1+$row_Re_rs->c_rs_2_1_2+$row_Re_rs->c_rs_2_1_3+$row_Re_rs->c_rs_2_1_4+$row_Re_rs->c_rs_2_1_5);

                                if($sum_rs_2_1 != 0){$p2_1_1=round((($row_Re_rs->c_rs_2_1_1*100)/$sum_rs_2_1),2);}else{$p2_1_1=0;}
                                if($sum_rs_2_1 != 0){$p2_1_2=round((($row_Re_rs->c_rs_2_1_2*100)/$sum_rs_2_1),2);}else{$p2_1_2=0;}
                                if($sum_rs_2_1 != 0){$p2_1_3=round((($row_Re_rs->c_rs_2_1_3*100)/$sum_rs_2_1),2);}else{$p2_1_3=0;}
                                if($sum_rs_2_1 != 0){$p2_1_4=round((($row_Re_rs->c_rs_2_1_4*100)/$sum_rs_2_1),2);}else{$p2_1_4=0;}
                                if($sum_rs_2_1 != 0){$p2_1_5=round((($row_Re_rs->c_rs_2_1_5*100)/$sum_rs_2_1),2);}else{$p2_1_5=0;}

                                ?>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="20%">คะแนน</th>
                                            <th width="150">จำนวน</th>
                                            <th width="150">เปอร์เซ็นต์</th>
                                            <th width="80%">กราฟ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 น้อยที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_1_1; ?></td>
                                            <td><?php echo $p2_1_1."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_1_1; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2 น้อย</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_1_2; ?></td>
                                            <td><?php echo $p2_1_2."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_1_2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3 ปานกลาง</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_1_3; ?></td>
                                            <td><?php echo $p2_1_3."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_1_3; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4 มาก</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_1_4; ?></td>
                                            <td><?php echo $p2_1_4."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_1_4; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5 มากที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_1_5; ?></td>
                                            <td><?php echo $p2_1_5."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_1_5; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>รวม</td>
                                            <td><?php echo $sum_rs_2_1; ?></td>
                                            <td>100 %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- 2.2 -->
                            <div class="col-12 col-lg-6 mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-6"></div>
                                                <div class="col-3">คะแนนเฉลี่ย</div>
                                                <div class="col-3">ค่าเบียงเบน</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bg_darkpink p-2">
                                            <div class="row">
                                                <div class="col-6">2.2 ขั้นตอนในการให้บริการมีความเหมาะสม</div>
                                                <div class="col-3"><?php echo $row_Re_avg->a_rs_2_2; ?></div>
                                                <div class="col-3"><?php echo $row_Re_std->std_rs_2_2; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                //กราฟ 2.2 --------

                                $sum_rs_2_2=($row_Re_rs->c_rs_2_2_1+$row_Re_rs->c_rs_2_2_2+$row_Re_rs->c_rs_2_2_3+$row_Re_rs->c_rs_2_2_4+$row_Re_rs->c_rs_2_2_5);

                                if($sum_rs_2_2 != 0){$p2_2_1=round((($row_Re_rs->c_rs_2_2_1*100)/$sum_rs_2_2),2);}else{$p2_2_1=0;}
                                if($sum_rs_2_2 != 0){$p2_2_2=round((($row_Re_rs->c_rs_2_2_2*100)/$sum_rs_2_2),2);}else{$p2_2_2=0;}
                                if($sum_rs_2_2 != 0){$p2_2_3=round((($row_Re_rs->c_rs_2_2_3*100)/$sum_rs_2_2),2);}else{$p2_2_3=0;}
                                if($sum_rs_2_2 != 0){$p2_2_4=round((($row_Re_rs->c_rs_2_2_4*100)/$sum_rs_2_2),2);}else{$p2_2_4=0;}
                                if($sum_rs_2_2 != 0){$p2_2_5=round((($row_Re_rs->c_rs_2_2_5*100)/$sum_rs_2_2),2);}else{$p2_2_5=0;}


                                ?>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="20%">คะแนน</th>
                                            <th width="150">จำนวน</th>
                                            <th width="150">เปอร์เซ็นต์</th>
                                            <th width="80%">กราฟ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 น้อยที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_2_1; ?></td>
                                            <td><?php echo $p2_2_1."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_2_1; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2 น้อย</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_2_2; ?></td>
                                            <td><?php echo $p2_2_2."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_2_2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3 ปานกลาง</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_2_3; ?></td>
                                            <td><?php echo $p2_2_3."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_2_3; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4 มาก</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_2_4; ?></td>
                                            <td><?php echo $p2_2_4."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_2_4; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5 มากที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_2_5; ?></td>
                                            <td><?php echo $p2_2_5."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_2_5; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>รวม</td>
                                            <td><?php echo $sum_rs_2_2; ?></td>
                                            <td>100 %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- 2.3 -->
                            <div class="col-12 col-lg-6 mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-6"></div>
                                                <div class="col-3">คะแนนเฉลี่ย</div>
                                                <div class="col-3">ค่าเบียงเบน</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bg_darkpink p-2">
                                            <div class="row">
                                                <div class="col-6">2.3 ระยะเวลาในการให้บริการมีความเหมาะสม</div>
                                                <div class="col-3"><?php echo $row_Re_avg->a_rs_2_3; ?></div>
                                                <div class="col-3"><?php echo $row_Re_std->std_rs_2_3; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                //กราฟ 2.3 --------

                                $sum_rs_2_3=($row_Re_rs->c_rs_2_3_1+$row_Re_rs->c_rs_2_3_2+$row_Re_rs->c_rs_2_3_3+$row_Re_rs->c_rs_2_3_4+$row_Re_rs->c_rs_2_3_5);

                                if($sum_rs_2_3 != 0){$p2_3_1=round((($row_Re_rs->c_rs_2_3_1*100)/$sum_rs_2_3),2);}else{$p2_3_1=0;}
                                if($sum_rs_2_3 != 0){$p2_3_2=round((($row_Re_rs->c_rs_2_3_2*100)/$sum_rs_2_3),2);}else{$p2_3_2=0;}
                                if($sum_rs_2_3 != 0){$p2_3_3=round((($row_Re_rs->c_rs_2_3_3*100)/$sum_rs_2_3),2);}else{$p2_3_3=0;}
                                if($sum_rs_2_3 != 0){$p2_3_4=round((($row_Re_rs->c_rs_2_3_4*100)/$sum_rs_2_3),2);}else{$p2_3_4=0;}
                                if($sum_rs_2_3 != 0){$p2_3_5=round((($row_Re_rs->c_rs_2_3_5*100)/$sum_rs_2_3),2);}else{$p2_3_5=0;}


                                ?>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="20%">คะแนน</th>
                                            <th width="150">จำนวน</th>
                                            <th width="150">เปอร์เซ็นต์</th>
                                            <th width="80%">กราฟ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 น้อยที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_3_1; ?></td>
                                            <td><?php echo $p2_3_1."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_3_1; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2 น้อย</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_3_2; ?></td>
                                            <td><?php echo $p2_3_2."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_3_2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3 ปานกลาง</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_3_3; ?></td>
                                            <td><?php echo $p2_3_3."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_3_3; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4 มาก</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_3_4; ?></td>
                                            <td><?php echo $p2_3_4."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_3_4; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5 มากที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_3_5; ?></td>
                                            <td><?php echo $p2_3_5."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_3_5; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>รวม</td>
                                            <td><?php echo $sum_rs_2_3; ?></td>
                                            <td>100 %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- 2.4 -->
                            <div class="col-12 col-lg-6 mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-6"></div>
                                                <div class="col-3">คะแนนเฉลี่ย</div>
                                                <div class="col-3">ค่าเบียงเบน</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bg_darkpink p-2">
                                            <div class="row">
                                                <div class="col-6">2.4 ให้บริการด้วยความเสมอภาคตามลำดับก่อน-หลัง</div>
                                                <div class="col-3"><?php echo $row_Re_avg->a_rs_2_4; ?></div>
                                                <div class="col-3"><?php echo $row_Re_std->std_rs_2_4; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                //กราฟ 2.4 --------

                                $sum_rs_2_4=($row_Re_rs->c_rs_2_4_1+$row_Re_rs->c_rs_2_4_2+$row_Re_rs->c_rs_2_4_3+$row_Re_rs->c_rs_2_4_4+$row_Re_rs->c_rs_2_4_5);

                                if($sum_rs_2_4 != 0){$p2_4_1=round((($row_Re_rs->c_rs_2_4_1*100)/$sum_rs_2_4),2);}else{$p2_4_1=0;}
                                if($sum_rs_2_4 != 0){$p2_4_2=round((($row_Re_rs->c_rs_2_4_2*100)/$sum_rs_2_4),2);}else{$p2_4_2=0;}
                                if($sum_rs_2_4 != 0){$p2_4_3=round((($row_Re_rs->c_rs_2_4_3*100)/$sum_rs_2_4),2);}else{$p2_4_3=0;}
                                if($sum_rs_2_4 != 0){$p2_4_4=round((($row_Re_rs->c_rs_2_4_4*100)/$sum_rs_2_4),2);}else{$p2_4_4=0;}
                                if($sum_rs_2_4 != 0){$p2_4_5=round((($row_Re_rs->c_rs_2_4_5*100)/$sum_rs_2_4),2);}else{$p2_4_5=0;}

                                ?>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="20%">คะแนน</th>
                                            <th width="150">จำนวน</th>
                                            <th width="150">เปอร์เซ็นต์</th>
                                            <th width="80%">กราฟ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 น้อยที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_4_1; ?></td>
                                            <td><?php echo $p2_4_1."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_4_1; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2 น้อย</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_4_2; ?></td>
                                            <td><?php echo $p2_4_2."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_4_2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3 ปานกลาง</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_4_3; ?></td>
                                            <td><?php echo $p2_4_3."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_4_3; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4 มาก</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_4_4; ?></td>
                                            <td><?php echo $p2_4_4."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_4_4; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5 มากที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_4_5; ?></td>
                                            <td><?php echo $p2_4_5."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_4_5; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>รวม</td>
                                            <td><?php echo $sum_rs_2_4; ?></td>
                                            <td>100 %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- 2.5 -->
                            <div class="col-12 col-lg-6 mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-6"></div>
                                                <div class="col-3">คะแนนเฉลี่ย</div>
                                                <div class="col-3">ค่าเบียงเบน</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bg_darkpink p-2">
                                            <div class="row">
                                                <div class="col-6">2.5 ให้บริการด้วยความสะดวกรวดเร็ว ทันตามกำหนดเวลา</div>
                                                <div class="col-3"><?php echo $row_Re_avg->a_rs_2_5; ?></div>
                                                <div class="col-3"><?php echo $row_Re_std->std_rs_2_5; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                //กราฟ 2.5 --------

                                $sum_rs_2_5=($row_Re_rs->c_rs_2_5_1+$row_Re_rs->c_rs_2_5_2+$row_Re_rs->c_rs_2_5_3+$row_Re_rs->c_rs_2_5_4+$row_Re_rs->c_rs_2_5_5);

                                if($sum_rs_2_5 != 0){$p2_5_1=round((($row_Re_rs->c_rs_2_5_1*100)/$sum_rs_2_5),2);}else{$p2_5_1=0;}
                                if($sum_rs_2_5 != 0){$p2_5_2=round((($row_Re_rs->c_rs_2_5_2*100)/$sum_rs_2_5),2);}else{$p2_5_2=0;}
                                if($sum_rs_2_5 != 0){$p2_5_3=round((($row_Re_rs->c_rs_2_5_3*100)/$sum_rs_2_5),2);}else{$p2_5_3=0;}
                                if($sum_rs_2_5 != 0){$p2_5_4=round((($row_Re_rs->c_rs_2_5_4*100)/$sum_rs_2_5),2);}else{$p2_5_4=0;}
                                if($sum_rs_2_5 != 0){$p2_5_5=round((($row_Re_rs->c_rs_2_5_5*100)/$sum_rs_2_5),2);}else{$p2_5_5=0;}


                                ?>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="20%">คะแนน</th>
                                            <th width="150">จำนวน</th>
                                            <th width="150">เปอร์เซ็นต์</th>
                                            <th width="80%">กราฟ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 น้อยที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_5_1; ?></td>
                                            <td><?php echo $p2_5_1."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_5_1; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2 น้อย</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_5_2; ?></td>
                                            <td><?php echo $p2_5_2."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_5_2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3 ปานกลาง</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_5_3; ?></td>
                                            <td><?php echo $p2_5_3."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_5_3; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4 มาก</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_5_4; ?></td>
                                            <td><?php echo $p2_5_4."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_5_4; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5 มากที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_2_5_5; ?></td>
                                            <td><?php echo $p2_5_5."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p2_5_5; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>รวม</td>
                                            <td><?php echo $sum_rs_2_5; ?></td>
                                            <td>100 %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row"><div class="col-12"><hr></div></div>
                        <div class="row">
                            <div class="col-12 font-weight-bold">3. ด้านการให้บริการของเจ้าหน้าที่</div>
                        </div>
                        <div class="row">
                            <!-- 3.1 -->
                            <div class="col-12 col-lg-6 mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-6"></div>
                                                <div class="col-3">คะแนนเฉลี่ย</div>
                                                <div class="col-3">ค่าเบียงเบน</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bg_darkpink p-2">
                                            <div class="row">
                                                <div class="col-6">3.1 ให้บริการด้วยความสุภาพ อ่อนน้อม และเป็นกันเอง</div>
                                                <div class="col-3"><?php echo $row_Re_avg->a_rs_3_1; ?></div>
                                                <div class="col-3"><?php echo $row_Re_std->std_rs_3_1; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                //กราฟ 3.1 --------

                                $sum_rs_3_1=($row_Re_rs->c_rs_3_1_1+$row_Re_rs->c_rs_3_1_2+$row_Re_rs->c_rs_3_1_3+$row_Re_rs->c_rs_3_1_4+$row_Re_rs->c_rs_3_1_5);

                                if($sum_rs_3_1 != 0){$p3_1_1=round((($row_Re_rs->c_rs_3_1_1*100)/$sum_rs_3_1),2);}else{$p3_1_1=0;}
                                if($sum_rs_3_1 != 0){$p3_1_2=round((($row_Re_rs->c_rs_3_1_2*100)/$sum_rs_3_1),2);}else{$p3_1_2=0;}
                                if($sum_rs_3_1 != 0){$p3_1_3=round((($row_Re_rs->c_rs_3_1_3*100)/$sum_rs_3_1),2);}else{$p3_1_3=0;}
                                if($sum_rs_3_1 != 0){$p3_1_4=round((($row_Re_rs->c_rs_3_1_4*100)/$sum_rs_3_1),2);}else{$p3_1_4=0;}
                                if($sum_rs_3_1 != 0){$p3_1_5=round((($row_Re_rs->c_rs_3_1_5*100)/$sum_rs_3_1),2);}else{$p3_1_5=0;}

                                ?>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="20%">คะแนน</th>
                                            <th width="150">จำนวน</th>
                                            <th width="150">เปอร์เซ็นต์</th>
                                            <th width="80%">กราฟ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 น้อยที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_1_1; ?></td>
                                            <td><?php echo $p3_1_1."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_1_1; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2 น้อย</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_1_2; ?></td>
                                            <td><?php echo $p3_1_2."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_1_2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3 ปานกลาง</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_1_3; ?></td>
                                            <td><?php echo $p3_1_3."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_1_3; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4 มาก</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_1_4; ?></td>
                                            <td><?php echo $p3_1_4."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_1_4; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5 มากที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_1_5; ?></td>
                                            <td><?php echo $p3_1_5."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_1_5; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>รวม</td>
                                            <td><?php echo $sum_rs_3_1; ?></td>
                                            <td>100 %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- 3.2 -->
                            <div class="col-12 col-lg-6 mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-6"></div>
                                                <div class="col-3">คะแนนเฉลี่ย</div>
                                                <div class="col-3">ค่าเบียงเบน</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bg_darkpink p-2">
                                            <div class="row">
                                                <div class="col-6">3.2 มีความเอาใจใส่ กระตือรือร้น และเต็มใจให้บริการ</div>
                                                <div class="col-3"><?php echo $row_Re_avg->a_rs_3_2; ?></div>
                                                <div class="col-3"><?php echo $row_Re_std->std_rs_3_2; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                //กราฟ 3.2 --------

                                $sum_rs_3_2=($row_Re_rs->c_rs_3_2_1+$row_Re_rs->c_rs_3_2_2+$row_Re_rs->c_rs_3_2_3+$row_Re_rs->c_rs_3_2_4+$row_Re_rs->c_rs_3_2_5);

                                if($sum_rs_3_2 != 0){$p3_2_1=round((($row_Re_rs->c_rs_3_2_1*100)/$sum_rs_3_2),2);}else{$p3_2_1=0;}
                                if($sum_rs_3_2 != 0){$p3_2_2=round((($row_Re_rs->c_rs_3_2_2*100)/$sum_rs_3_2),2);}else{$p3_2_2=0;}
                                if($sum_rs_3_2 != 0){$p3_2_3=round((($row_Re_rs->c_rs_3_2_3*100)/$sum_rs_3_2),2);}else{$p3_2_3=0;}
                                if($sum_rs_3_2 != 0){$p3_2_4=round((($row_Re_rs->c_rs_3_2_4*100)/$sum_rs_3_2),2);}else{$p3_2_4=0;}
                                if($sum_rs_3_2 != 0){$p3_2_5=round((($row_Re_rs->c_rs_3_2_5*100)/$sum_rs_3_2),2);}else{$p3_2_5=0;}


                                ?>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="20%">คะแนน</th>
                                            <th width="150">จำนวน</th>
                                            <th width="150">เปอร์เซ็นต์</th>
                                            <th width="80%">กราฟ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 น้อยที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_2_1; ?></td>
                                            <td><?php echo $p3_2_1."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_2_1; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2 น้อย</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_2_2; ?></td>
                                            <td><?php echo $p3_2_2."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_2_2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3 ปานกลาง</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_2_3; ?></td>
                                            <td><?php echo $p3_2_3."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_2_3; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4 มาก</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_2_4; ?></td>
                                            <td><?php echo $p3_2_4."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_2_4; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5 มากที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_2_5; ?></td>
                                            <td><?php echo $p3_2_5."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_2_5; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>รวม</td>
                                            <td><?php echo $sum_rs_3_2; ?></td>
                                            <td>100 %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- 3.3 -->
                            <div class="col-12 col-lg-6 mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-6"></div>
                                                <div class="col-3">คะแนนเฉลี่ย</div>
                                                <div class="col-3">ค่าเบียงเบน</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bg_darkpink p-2">
                                            <div class="row">
                                                <div class="col-6">3.3 รับฟังปัญหาหรือข้อซักถามของผู้รับบริการอย่างเต็มใจ</div>
                                                <div class="col-3"><?php echo $row_Re_avg->a_rs_3_3; ?></div>
                                                <div class="col-3"><?php echo $row_Re_std->std_rs_3_3; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                //กราฟ 3.3 --------

                                $sum_rs_3_3=($row_Re_rs->c_rs_3_3_1+$row_Re_rs->c_rs_3_3_2+$row_Re_rs->c_rs_3_3_3+$row_Re_rs->c_rs_3_3_4+$row_Re_rs->c_rs_3_3_5);

                                if($sum_rs_3_3 != 0){$p3_3_1=round((($row_Re_rs->c_rs_3_3_1*100)/$sum_rs_3_3),2);}else{$p3_3_1=0;}
                                if($sum_rs_3_3 != 0){$p3_3_2=round((($row_Re_rs->c_rs_3_3_2*100)/$sum_rs_3_3),2);}else{$p3_3_2=0;}
                                if($sum_rs_3_3 != 0){$p3_3_3=round((($row_Re_rs->c_rs_3_3_3*100)/$sum_rs_3_3),2);}else{$p3_3_3=0;}
                                if($sum_rs_3_3 != 0){$p3_3_4=round((($row_Re_rs->c_rs_3_3_4*100)/$sum_rs_3_3),2);}else{$p3_3_4=0;}
                                if($sum_rs_3_3 != 0){$p3_3_5=round((($row_Re_rs->c_rs_3_3_5*100)/$sum_rs_3_3),2);}else{$p3_3_5=0;}


                                ?>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="20%">คะแนน</th>
                                            <th width="150">จำนวน</th>
                                            <th width="150">เปอร์เซ็นต์</th>
                                            <th width="80%">กราฟ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 น้อยที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_3_1; ?></td>
                                            <td><?php echo $p3_3_1."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_3_1; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2 น้อย</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_3_2; ?></td>
                                            <td><?php echo $p3_3_2."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_3_2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3 ปานกลาง</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_3_3; ?></td>
                                            <td><?php echo $p3_3_3."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_3_3; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4 มาก</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_3_4; ?></td>
                                            <td><?php echo $p3_3_4."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_3_4; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5 มากที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_3_5; ?></td>
                                            <td><?php echo $p3_3_5."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_3_5; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>รวม</td>
                                            <td><?php echo $sum_rs_3_3; ?></td>
                                            <td>100 %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- 3.4 -->
                            <div class="col-12 col-lg-6 mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-6"></div>
                                                <div class="col-3">คะแนนเฉลี่ย</div>
                                                <div class="col-3">ค่าเบียงเบน</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bg_darkpink p-2">
                                            <div class="row">
                                                <div class="col-6">3.4 ให้คำอธิบายและตอบข้อสงสัยได้ตรงประเด็น</div>
                                                <div class="col-3"><?php echo $row_Re_avg->a_rs_2_4; ?></div>
                                                <div class="col-3"><?php echo $row_Re_std->std_rs_2_4; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                //กราฟ 3.4 --------

                                $sum_rs_3_4=($row_Re_rs->c_rs_3_4_1+$row_Re_rs->c_rs_3_4_2+$row_Re_rs->c_rs_3_4_3+$row_Re_rs->c_rs_3_4_4+$row_Re_rs->c_rs_3_4_5);

                                if($sum_rs_3_4 != 0){$p3_4_1=round((($row_Re_rs->c_rs_3_4_1*100)/$sum_rs_3_4),2);}else{$p3_4_1=0;}
                                if($sum_rs_3_4 != 0){$p3_4_2=round((($row_Re_rs->c_rs_3_4_2*100)/$sum_rs_3_4),2);}else{$p3_4_2=0;}
                                if($sum_rs_3_4 != 0){$p3_4_3=round((($row_Re_rs->c_rs_3_4_3*100)/$sum_rs_3_4),2);}else{$p3_4_3=0;}
                                if($sum_rs_3_4 != 0){$p3_4_4=round((($row_Re_rs->c_rs_3_4_4*100)/$sum_rs_3_4),2);}else{$p3_4_4=0;}
                                if($sum_rs_3_4 != 0){$p3_4_5=round((($row_Re_rs->c_rs_3_4_5*100)/$sum_rs_3_4),2);}else{$p3_4_5=0;}

                                ?>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="20%">คะแนน</th>
                                            <th width="150">จำนวน</th>
                                            <th width="150">เปอร์เซ็นต์</th>
                                            <th width="80%">กราฟ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 น้อยที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_4_1; ?></td>
                                            <td><?php echo $p3_4_1."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_4_1; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2 น้อย</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_4_2; ?></td>
                                            <td><?php echo $p3_4_2."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_4_2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3 ปานกลาง</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_4_3; ?></td>
                                            <td><?php echo $p3_4_3."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_4_3; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4 มาก</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_4_4; ?></td>
                                            <td><?php echo $p3_4_4."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_4_4; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5 มากที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_4_5; ?></td>
                                            <td><?php echo $p3_4_5."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_4_5; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>รวม</td>
                                            <td><?php echo $sum_rs_3_4; ?></td>
                                            <td>100 %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- 3.5 -->
                            <div class="col-12 col-lg-6 mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-6"></div>
                                                <div class="col-3">คะแนนเฉลี่ย</div>
                                                <div class="col-3">ค่าเบียงเบน</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bg_darkpink p-2">
                                            <div class="row">
                                                <div class="col-6">3.5 มีความชัดเจนในการให้คำแนะนำที่เป็นประโยชน์</div>
                                                <div class="col-3"><?php echo $row_Re_avg->a_rs_3_5; ?></div>
                                                <div class="col-3"><?php echo $row_Re_std->std_rs_3_5; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                //กราฟ 3.5 --------

                                $sum_rs_3_5=($row_Re_rs->c_rs_3_5_1+$row_Re_rs->c_rs_3_5_2+$row_Re_rs->c_rs_3_5_3+$row_Re_rs->c_rs_3_5_4+$row_Re_rs->c_rs_3_5_5);

                                if($sum_rs_3_5 != 0){$p3_5_1=round((($row_Re_rs->c_rs_3_5_1*100)/$sum_rs_3_5),2);}else{$p3_5_1=0;}
                                if($sum_rs_3_5 != 0){$p3_5_2=round((($row_Re_rs->c_rs_3_5_2*100)/$sum_rs_3_5),2);}else{$p3_5_2=0;}
                                if($sum_rs_3_5 != 0){$p3_5_3=round((($row_Re_rs->c_rs_3_5_3*100)/$sum_rs_3_5),2);}else{$p3_5_3=0;}
                                if($sum_rs_3_5 != 0){$p3_5_4=round((($row_Re_rs->c_rs_3_5_4*100)/$sum_rs_3_5),2);}else{$p3_5_4=0;}
                                if($sum_rs_3_5 != 0){$p3_5_5=round((($row_Re_rs->c_rs_3_5_5*100)/$sum_rs_3_5),2);}else{$p3_5_5=0;}


                                ?>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="20%">คะแนน</th>
                                            <th width="150">จำนวน</th>
                                            <th width="150">เปอร์เซ็นต์</th>
                                            <th width="80%">กราฟ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 น้อยที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_5_1; ?></td>
                                            <td><?php echo $p3_5_1."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_5_1; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2 น้อย</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_5_2; ?></td>
                                            <td><?php echo $p3_5_2."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_5_2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3 ปานกลาง</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_5_3; ?></td>
                                            <td><?php echo $p3_5_3."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_5_3; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4 มาก</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_5_4; ?></td>
                                            <td><?php echo $p3_5_4."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_5_4; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5 มากที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_5_5; ?></td>
                                            <td><?php echo $p3_5_5."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p3_5_5; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>รวม</td>
                                            <td><?php echo $sum_rs_3_5; ?></td>
                                            <td>100 %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row"><div class="col-12"><hr></div></div>
                        <div class="row">
                            <div class="col-12 font-weight-bold">4. ด้านสิ่งอำนวยความสะดวก</div>
                        </div>
                        <div class="row">
                            <!-- 4.1 -->
                            <div class="col-12 col-lg-6 mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-6"></div>
                                                <div class="col-3">คะแนนเฉลี่ย</div>
                                                <div class="col-3">ค่าเบียงเบน</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bg_darkpink p-2">
                                            <div class="row">
                                                <div class="col-6">4.1 ความชัดเจนของป้าย สัญลักษณ์ ประชาสัมพันธ์บอกจุดบริการ</div>
                                                <div class="col-3"><?php echo $row_Re_avg->a_rs_4_1; ?></div>
                                                <div class="col-3"><?php echo $row_Re_std->std_rs_4_1; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                //กราฟ 4.1 --------

                                $sum_rs_4_1=($row_Re_rs->c_rs_4_1_1+$row_Re_rs->c_rs_4_1_2+$row_Re_rs->c_rs_4_1_3+$row_Re_rs->c_rs_4_1_4+$row_Re_rs->c_rs_4_1_5);

                                if($sum_rs_4_1 != 0){$p4_1_1=round((($row_Re_rs->c_rs_4_1_1*100)/$sum_rs_4_1),2);}else{$p4_1_1=0;}
                                if($sum_rs_4_1 != 0){$p4_1_2=round((($row_Re_rs->c_rs_4_1_2*100)/$sum_rs_4_1),2);}else{$p4_1_2=0;}
                                if($sum_rs_4_1 != 0){$p4_1_3=round((($row_Re_rs->c_rs_4_1_3*100)/$sum_rs_4_1),2);}else{$p4_1_3=0;}
                                if($sum_rs_4_1 != 0){$p4_1_4=round((($row_Re_rs->c_rs_4_1_4*100)/$sum_rs_4_1),2);}else{$p4_1_4=0;}
                                if($sum_rs_4_1 != 0){$p4_1_5=round((($row_Re_rs->c_rs_4_1_5*100)/$sum_rs_4_1),2);}else{$p4_1_5=0;}

                                ?>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="20%">คะแนน</th>
                                            <th width="150">จำนวน</th>
                                            <th width="150">เปอร์เซ็นต์</th>
                                            <th width="80%">กราฟ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 น้อยที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_1_1; ?></td>
                                            <td><?php echo $p4_1_1."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_1_1; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2 น้อย</td>
                                            <td><?php echo $row_Re_rs->c_rs_3_1_2; ?></td>
                                            <td><?php echo $p4_1_2."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_1_2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3 ปานกลาง</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_1_3; ?></td>
                                            <td><?php echo $p4_1_3."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_1_3; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4 มาก</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_1_4; ?></td>
                                            <td><?php echo $p4_1_4."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_1_4; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5 มากที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_1_5; ?></td>
                                            <td><?php echo $p4_1_5."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_1_5; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>รวม</td>
                                            <td><?php echo $sum_rs_4_1; ?></td>
                                            <td>100 %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- 4.2 -->
                            <div class="col-12 col-lg-6 mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-6"></div>
                                                <div class="col-3">คะแนนเฉลี่ย</div>
                                                <div class="col-3">ค่าเบียงเบน</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bg_darkpink p-2">
                                            <div class="row">
                                                <div class="col-6">4.2 จุด /ช่อง การให้บริการมีความเหมาะสมและเข้าถึงได้สะดวก</div>
                                                <div class="col-3"><?php echo $row_Re_avg->a_rs_4_2; ?></div>
                                                <div class="col-3"><?php echo $row_Re_std->std_rs_4_2; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                //กราฟ 4.2 --------

                                $sum_rs_4_2=($row_Re_rs->c_rs_4_2_1+$row_Re_rs->c_rs_4_2_2+$row_Re_rs->c_rs_4_2_3+$row_Re_rs->c_rs_4_2_4+$row_Re_rs->c_rs_4_2_5);

                                if($sum_rs_4_2 != 0){$p4_2_1=round((($row_Re_rs->c_rs_4_2_1*100)/$sum_rs_4_2),2);}else{$p4_2_1=0;}
                                if($sum_rs_4_2 != 0){$p4_2_2=round((($row_Re_rs->c_rs_4_2_2*100)/$sum_rs_4_2),2);}else{$p4_2_2=0;}
                                if($sum_rs_4_2 != 0){$p4_2_3=round((($row_Re_rs->c_rs_4_2_3*100)/$sum_rs_4_2),2);}else{$p4_2_3=0;}
                                if($sum_rs_4_2 != 0){$p4_2_4=round((($row_Re_rs->c_rs_4_2_4*100)/$sum_rs_4_2),2);}else{$p4_2_4=0;}
                                if($sum_rs_4_2 != 0){$p4_2_5=round((($row_Re_rs->c_rs_4_2_5*100)/$sum_rs_4_2),2);}else{$p4_2_5=0;}


                                ?>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="20%">คะแนน</th>
                                            <th width="150">จำนวน</th>
                                            <th width="150">เปอร์เซ็นต์</th>
                                            <th width="80%">กราฟ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 น้อยที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_2_1; ?></td>
                                            <td><?php echo $p4_2_1."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_2_1; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2 น้อย</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_2_2; ?></td>
                                            <td><?php echo $p4_2_2."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_2_2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3 ปานกลาง</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_2_3; ?></td>
                                            <td><?php echo $p4_2_3."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_2_3; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4 มาก</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_2_4; ?></td>
                                            <td><?php echo $p4_2_4."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_2_4; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5 มากที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_2_5; ?></td>
                                            <td><?php echo $p4_2_5."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_2_5; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>รวม</td>
                                            <td><?php echo $sum_rs_4_2; ?></td>
                                            <td>100 %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- 4.3 -->
                            <div class="col-12 col-lg-6 mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-6"></div>
                                                <div class="col-3">คะแนนเฉลี่ย</div>
                                                <div class="col-3">ค่าเบียงเบน</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bg_darkpink p-2">
                                            <div class="row">
                                                <div class="col-6">4.3 ความเพียงพอของสิ่งอำนวยความสะดวก เช่น ที่นั่งรอ รับบริการ น้ำดื่ม ที่จอดรถ ฯลฯ</div>
                                                <div class="col-3"><?php echo $row_Re_avg->a_rs_3_3; ?></div>
                                                <div class="col-3"><?php echo $row_Re_std->std_rs_3_3; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                //กราฟ 4.3 --------

                                $sum_rs_4_3=($row_Re_rs->c_rs_4_3_1+$row_Re_rs->c_rs_4_3_2+$row_Re_rs->c_rs_4_3_3+$row_Re_rs->c_rs_4_3_4+$row_Re_rs->c_rs_4_3_5);

                                if($sum_rs_4_3 != 0){$p4_3_1=round((($row_Re_rs->c_rs_4_3_1*100)/$sum_rs_4_3),2);}else{$p4_3_1=0;}
                                if($sum_rs_4_3 != 0){$p4_3_2=round((($row_Re_rs->c_rs_4_3_2*100)/$sum_rs_4_3),2);}else{$p4_3_2=0;}
                                if($sum_rs_4_3 != 0){$p4_3_3=round((($row_Re_rs->c_rs_4_3_3*100)/$sum_rs_4_3),2);}else{$p4_3_3=0;}
                                if($sum_rs_4_3 != 0){$p4_3_4=round((($row_Re_rs->c_rs_4_3_4*100)/$sum_rs_4_3),2);}else{$p4_3_4=0;}
                                if($sum_rs_4_3 != 0){$p4_3_5=round((($row_Re_rs->c_rs_4_3_5*100)/$sum_rs_4_3),2);}else{$p4_3_5=0;}

                                ?>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="20%">คะแนน</th>
                                            <th width="150">จำนวน</th>
                                            <th width="150">เปอร์เซ็นต์</th>
                                            <th width="80%">กราฟ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 น้อยที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_3_1; ?></td>
                                            <td><?php echo $p4_3_1."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_3_1; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2 น้อย</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_3_2; ?></td>
                                            <td><?php echo $p4_3_2."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_3_2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3 ปานกลาง</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_3_3; ?></td>
                                            <td><?php echo $p4_3_3."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_3_3; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4 มาก</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_3_4; ?></td>
                                            <td><?php echo $p4_3_4."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_3_4; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5 มากที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_3_5; ?></td>
                                            <td><?php echo $p4_3_5."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_3_5; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>รวม</td>
                                            <td><?php echo $sum_rs_4_3; ?></td>
                                            <td>100 %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- 4.4 -->
                            <div class="col-12 col-lg-6 mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-6"></div>
                                                <div class="col-3">คะแนนเฉลี่ย</div>
                                                <div class="col-3">ค่าเบียงเบน</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bg_darkpink p-2">
                                            <div class="row">
                                                <div class="col-6">4.4 ความสะอาดของสถานที่ให้บริการ</div>
                                                <div class="col-3"><?php echo $row_Re_avg->a_rs_4_4; ?></div>
                                                <div class="col-3"><?php echo $row_Re_std->std_rs_4_4; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                //กราฟ 4.4 --------

                                $sum_rs_4_4=($row_Re_rs->c_rs_4_4_1+$row_Re_rs->c_rs_4_4_2+$row_Re_rs->c_rs_4_4_3+$row_Re_rs->c_rs_4_4_4+$row_Re_rs->c_rs_4_4_5);

                                if($sum_rs_4_4 != 0){$p4_4_1=round((($row_Re_rs->c_rs_4_4_1*100)/$sum_rs_4_4),2);}else{$p4_4_1=0;}
                                if($sum_rs_4_4 != 0){$p4_4_2=round((($row_Re_rs->c_rs_4_4_2*100)/$sum_rs_4_4),2);}else{$p4_4_2=0;}
                                if($sum_rs_4_4 != 0){$p4_4_3=round((($row_Re_rs->c_rs_4_4_3*100)/$sum_rs_4_4),2);}else{$p4_4_3=0;}
                                if($sum_rs_4_4 != 0){$p4_4_4=round((($row_Re_rs->c_rs_4_4_4*100)/$sum_rs_4_4),2);}else{$p4_4_4=0;}
                                if($sum_rs_4_4 != 0){$p4_4_5=round((($row_Re_rs->c_rs_4_4_5*100)/$sum_rs_4_4),2);}else{$p4_4_5=0;}


                                ?>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="20%">คะแนน</th>
                                            <th width="150">จำนวน</th>
                                            <th width="150">เปอร์เซ็นต์</th>
                                            <th width="80%">กราฟ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 น้อยที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_4_1; ?></td>
                                            <td><?php echo $p4_4_1."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_4_1; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2 น้อย</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_4_2; ?></td>
                                            <td><?php echo $p4_4_2."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_4_2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3 ปานกลาง</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_4_3; ?></td>
                                            <td><?php echo $p4_4_3."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_4_3; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4 มาก</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_4_4; ?></td>
                                            <td><?php echo $p4_4_4."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_4_4; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5 มากที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_4_5; ?></td>
                                            <td><?php echo $p4_4_5."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_4_5; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>รวม</td>
                                            <td><?php echo $sum_rs_4_4; ?></td>
                                            <td>100 %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- 4.5 -->
                            <div class="col-12 col-lg-6 mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-6"></div>
                                                <div class="col-3">คะแนนเฉลี่ย</div>
                                                <div class="col-3">ค่าเบียงเบน</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="bg_darkpink p-2">
                                            <div class="row">
                                                <div class="col-6">4.5 ท่านมีความพึงพอใจ / ไม่พึงพอใจต่อการให้บริการในภาพรวม อยู่ในระดับใด</div>
                                                <div class="col-3"><?php echo $row_Re_avg->a_rs_3_5; ?></div>
                                                <div class="col-3"><?php echo $row_Re_std->std_rs_3_5; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                //กราฟ 4.5 --------

                                $sum_rs_4_5=($row_Re_rs->c_rs_4_5_1+$row_Re_rs->c_rs_4_5_2+$row_Re_rs->c_rs_4_5_3+$row_Re_rs->c_rs_4_5_4+$row_Re_rs->c_rs_4_5_5);

                                if($sum_rs_4_5 != 0){$p4_5_1=round((($row_Re_rs->c_rs_4_5_1*100)/$sum_rs_4_5),2);}else{$p4_5_1=0;}
                                if($sum_rs_4_5 != 0){$p4_5_2=round((($row_Re_rs->c_rs_4_5_2*100)/$sum_rs_4_5),2);}else{$p4_5_2=0;}
                                if($sum_rs_4_5 != 0){$p4_5_3=round((($row_Re_rs->c_rs_4_5_3*100)/$sum_rs_4_5),2);}else{$p4_5_3=0;}
                                if($sum_rs_4_5 != 0){$p4_5_4=round((($row_Re_rs->c_rs_4_5_4*100)/$sum_rs_4_5),2);}else{$p4_5_4=0;}
                                if($sum_rs_4_5 != 0){$p4_5_5=round((($row_Re_rs->c_rs_4_5_5*100)/$sum_rs_4_5),2);}else{$p4_5_5=0;}


                                ?>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="20%">คะแนน</th>
                                            <th width="150">จำนวน</th>
                                            <th width="150">เปอร์เซ็นต์</th>
                                            <th width="80%">กราฟ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 น้อยที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_5_1; ?></td>
                                            <td><?php echo $p4_5_1."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_5_1; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2 น้อย</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_5_2; ?></td>
                                            <td><?php echo $p4_5_2."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_5_2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3 ปานกลาง</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_5_3; ?></td>
                                            <td><?php echo $p4_5_3."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_5_3; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4 มาก</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_5_4; ?></td>
                                            <td><?php echo $p4_5_4."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_5_4; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5 มากที่สุด</td>
                                            <td><?php echo $row_Re_rs->c_rs_4_5_5; ?></td>
                                            <td><?php echo $p4_5_5."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p4_5_5; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>รวม</td>
                                            <td><?php echo $sum_rs_4_5; ?></td>
                                            <td>100 %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row"><div class="col-12"><hr></div></div>
                        <div class="row">
                            <div class="col-12 font-weight-bold">5. เทศบาลตำบลช่องลมควรปรับปรุงเรื่องใด (ตอบได้มากกว่า 1 ข้อ)</div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="40">ข้อ</th>
                                            <th width="">เรื่องที่รับบริการ</th>
                                            <th width="100">จำนวน</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>5.1</td>
                                            <td>ด้านการให้บริการของเจ้าหน้าที่ในหน่วยงาน</td>
                                            <td><?php echo $row_Re_rs->c_rs_5_1; ?></td>
                                        </tr>
                                        <tr>
                                            <td>5.2</td>
                                            <td>ด้านข้อมูลข่าวสารที่ให้บริการแก่ประชาชน</td>
                                            <td><?php echo $row_Re_rs->c_rs_5_2; ?></td>
                                        </tr>
                                        <tr>
                                            <td>5.3</td>
                                            <td>ด้านสถานที่ในการบริการข้อมูลข่าวสาร</td>
                                            <td><?php echo $row_Re_rs->c_rs_5_3; ?></td>
                                        </tr>
                                        <tr>
                                            <td>5.4</td>
                                            <td>ด้านสถานที่ในการบริการข้อมูลข่าวสาร</td>
                                            <td><?php echo $row_Re_rs->c_rs_5_4; ?></td>
                                        </tr>
                                        <tr>
                                            <td>5.5</td>
                                            <td>ด้านบริการการรับชำระภาษี</td>
                                            <td><?php echo $row_Re_rs->c_rs_5_5; ?></td>
                                        </tr>
                                        <tr>
                                            <td>5.6</td>
                                            <td>ด้านบริการการอนุญาตก่อสร้างอาคาร</td>
                                            <td><?php echo $row_Re_rs->c_rs_5_6; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6 mt-3">
                                <?php
                                //กราฟ 4.1 --------

                                $sum_rs_5=($row_Re_rs->c_rs_5_1+$row_Re_rs->c_rs_5_2+$row_Re_rs->c_rs_5_3+$row_Re_rs->c_rs_5_4+$row_Re_rs->c_rs_5_5+$row_Re_rs->c_rs_5_6);

                                if($sum_rs_5 != 0){$p5_1=round((($row_Re_rs->c_rs_5_1*100)/$sum_rs_5),2);}else{$p5_1=0;}
                                if($sum_rs_5 != 0){$p5_2=round((($row_Re_rs->c_rs_5_2*100)/$sum_rs_5),2);}else{$p5_2=0;}
                                if($sum_rs_5 != 0){$p5_3=round((($row_Re_rs->c_rs_5_3*100)/$sum_rs_5),2);}else{$p5_3=0;}
                                if($sum_rs_5 != 0){$p5_4=round((($row_Re_rs->c_rs_5_4*100)/$sum_rs_5),2);}else{$p5_4=0;}
                                if($sum_rs_5 != 0){$p5_5=round((($row_Re_rs->c_rs_5_5*100)/$sum_rs_5),2);}else{$p5_5=0;}
                                if($sum_rs_5 != 0){$p5_6=round((($row_Re_rs->c_rs_5_6*100)/$sum_rs_5),2);}else{$p5_6=0;}

                                ?>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th width="40">คะแนน</th>
                                            <th width="150">จำนวน</th>
                                            <th width="150">เปอร์เซ็นต์</th>
                                            <th width="80%">กราฟ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>5.1</td>
                                            <td><?php echo $row_Re_rs->c_rs_5_1; ?></td>
                                            <td><?php echo $p5_1."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p5_1; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5.2</td>
                                            <td><?php echo $row_Re_rs->c_rs_5_2; ?></td>
                                            <td><?php echo $p5_2."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p5_2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5.3</td>
                                            <td><?php echo $row_Re_rs->c_rs_5_3; ?></td>
                                            <td><?php echo $p5_3."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p5_3; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5.4</td>
                                            <td><?php echo $row_Re_rs->c_rs_5_4; ?></td>
                                            <td><?php echo $p5_4."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p5_4; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5.5</td>
                                            <td><?php echo $row_Re_rs->c_rs_5_5; ?></td>
                                            <td><?php echo $p5_5."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p5_5; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5.6</td>
                                            <td><?php echo $row_Re_rs->c_rs_5_6; ?></td>
                                            <td><?php echo $p5_6."%"; ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $p5_6; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="font-weight-bold">
                                            <td>รวม</td>
                                            <td><?php echo $sum_rs_5; ?></td>
                                            <td>100 %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>