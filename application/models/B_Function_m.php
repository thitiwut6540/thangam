<?php
class B_Function_m extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    //number format
    function numberChk($num){
        if($num!=0){
            return number_format($num,2);
        }else if($num==0 OR $num==""){
            return "-";
        }
    }

    function numberChk_0($num){
        if($num!=0){
            return number_format($num);
        }else if($num==0 OR $num==""){
            return "-";
        }
    }

    //หาค่าสิทธิ insert edit dele
    function getUserAction($id,$usa){

        $sql1="SELECT b.usa_num FROM tb_user a LEFT JOIN tb_user_level b ON(b.usl_id=a.usl_id) WHERE a.us_id='$id' ";
        $Ru = $this->db->query($sql1);
        foreach ($Ru->result() AS $row_Ru);

        $this->db->select("a.usa_num, b.*");
        $this->db->from("tb_user_accesstype a");
        $this->db->join('tb_user_action b', 'b.usa_num = a.usa_num', 'left');
        $this->db->WHERE("b.us_id=", $id);
        $this->db->WHERE("a.usa_num=", $usa);
        $query = $this->db->get();
        return $query->result();
    }

    function number_comma($date){
        $newString="";
        $arrString = explode(',', $date);
        foreach ($arrString as $v) {
            $newString .=  $v;
        }
        $number = (int) $newString;
        return $number;
    }

    function comma_remove($num){
        if($num!=""){
            $new = str_replace(",","", $num);
        }else{$new = 0;}
        return $new;
    }


	function toBaht($number ){
		if(!preg_match( '/^([0-9]+)(\.[0-9]{0,4}){0,1}$/' , $number=str_replace(',', '', $number), $m ))
		return 'This is not currency format';
		$m[2]=count($m)==3? intval(('0'.$m[2])*100 + 0.5) : 0;
		$st = $this->cv( $m[2]);
		return $this->cv( $m[1]) . 'บาท' . $st . ($st>''? 'สตางค์' : ''); 
	}
	function cv( $num ){
		$th_num = array('', array('หนึ่ง', 'เอ็ด'), array('สอง', 'ยี่'),'สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
		$th_digit = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
		$ln=strlen($num);
		$t='';
		for($i=$ln; $i>0;$i--){
			$x=$i-1;
			$n = substr($num, $ln-$i,1);
			$digit=$x % 6; 
			if($n!=0){ 
				if( $n==1 ){ $t .= $digit==1? '' : $th_num[1][$digit==0? ($t? 1 : 0) : 0]; }
				elseif( $n==2 ){  $t .= $th_num[2][$digit==1? 1 : 0]; } 
				else{ $t.= $th_num[$n]; } 
				$t.= $th_digit[($digit==0 && $x>0 ? 6 : $digit )]; 
			}else{
				$t .= $th_digit[ $digit==0 && $x>0 ? 6 : 0 ]; 
			}
		}
		return $t; 
    }
    
    function dateformat_start($date) {
        //หาค่าวันที่ว่าง
        $format="Y-m-d H:i:s";
        if (trim($date) == '' || substr($date,0,10) == '0000-00-00') {return '';}
        $ts = strtotime($date);
        if ($ts === false) {return '';}
        return date($format,$ts);
    } 
    function dateformat_end($date) {
        //หาค่าวันที่ว่าง
        $format="Y-m-d 23:59:59";
        if (trim($date) == '' || substr($date,0,10) == '0000-00-00') {return '';}
        $ts = strtotime($date);
        if ($ts === false) {return '';}
        return date($format,$ts);
    } 


    //หาจำนวนวันของเดือน
    function MonthDays($someMonth, $someYear){
        return date("t", strtotime($someYear . "-" . $someMonth . "-01"));
    }

    //หาวันที่ข้างหน้า
    function NextDate($start,$day){
        $strdate = explode("-",$start);
        return( date("Y-m-d", mktime(0, 0, 0, $strdate["1"], $strdate["2"]+$day, $strdate["0"])));
    }

    //หาสิ้นสุดสัญญา
    function EndDate($date,$num){
        $D1=substr($date,8,2);
        $YM = strtotime(date('Y-m', strtotime($date)));
        $nextYM=date('Y-m', strtotime('+'.$num.' month', $YM));
        $nextEndDay=date('t',strtotime($nextYM));
        if($D1>$nextEndDay){
            $EndDate=$nextYM."-".$nextEndDay;
        }else{
            $EndDate=$nextYM."-".$D1;
        }
        return($EndDate);
    }

    //หาวันที่อีก 1 เดือนข้างหน้า ตัดห้ามเกินวันสิ้นเดือน
    function NextMount($date){
        $D1=substr($date,8,2);
        $YM = strtotime(date('Y-m', strtotime($date)));
        $nextYM=date('Y-m', strtotime('+1 month', $YM));
        return($nextDate);
    }

    //หาวันที่สิ้นเดือน
    function EndDayOfMount($date){
        $nextEndDay=date('t',strtotime($date));
        return($nextEndDay);
    }

    // เปรียบเทียบเวลา
    function DateDayDiff($start,$end){
        return (strtotime($start) - strtotime($end))/( 60 * 60 * 24 ); // เช็คจำนวนวัน
    }

    function DateTimeDiff($start,$end){
        return (strtotime($start) - strtotime($end))/( 60 * 60 ); // 1 Hour =  60*60
    }

    //อายุ
    function DateToAge($date){
        if(!empty($date)){
            $bd = new DateTime($date);
            $today   = new DateTime('today');
            $age = $bd->diff($today)->y;
            return $age;
        }else{
            return 0;
        }
    }

    function DateMY($date){
        if($date>0){
            $yy=substr($date,0,4);
            $mm=substr($date,5,2);
            $mNow=date('m');
            $yNow=date('Y');

            if($yy==$yNow AND $mm==$mNow){
                return true;
            }else{
                return false;
            }
        }else{
            $datethai="";
            return false;
        }
    }

    function datethai($date){
        if($date>0){
            $_month_name = array(
            "01"=>"มกราคม",
            "02"=>"กุมภาพันธ์",
            "03"=>"มีนาคม",
            "04"=>"เมษายน",
            "05"=>"พฤษภาคม",
            "06"=>"มิถุนายน",
            "07"=>"กรกฏาคม",
            "08"=>"สิงหาคม",
            "09"=>"กันยายน",
            "10"=>"ตุลาคม",
            "11"=>"พฤศจิกายน",
            "12"=>"ธันวาคม");
            $yy=substr($date,0,4);
            $mm=substr($date,5,2);
            $dd=substr($date,8,2);
            $time=substr($date,11,8);
            $yy+=543;
            $datethai = intval($dd)." ".$_month_name[$mm]." ".$yy;
            return $datethai;
        }else{
            $datethai="";
            return $datethai;
        }
    }

    function datethai_time($date){
        if($date>0){
            $_month_name = array(
            "01"=>"มกราคม",
            "02"=>"กุมภาพันธ์",
            "03"=>"มีนาคม",
            "04"=>"เมษายน",
            "05"=>"พฤษภาคม",
            "06"=>"มิถุนายน",
            "07"=>"กรกฏาคม",
            "08"=>"สิงหาคม",
            "09"=>"กันยายน",
            "10"=>"ตุลาคม",
            "11"=>"พฤศจิกายน",
            "12"=>"ธันวาคม");
            $yy=substr($date,0,4);
            $mm=substr($date,5,2);
            $dd=substr($date,8,2);
            $time=substr($date,11,5);
            $yy+=543;
            $datethai_time = intval($dd)." ".$_month_name[$mm]." ".$yy." ".$time;
            return $datethai_time;
        }else{
            $datethai_time="";
            return $datethai_time;
        }
    }

    function datethai_sm($date){
        if($date>0){
            $_month_name = array(
            "01"=>"ม.ค.",
            "02"=>"ก.พ.",
            "03"=>"มี.ค.",
            "04"=>"เม.ย.",
            "05"=>"พ.ค.",
            "06"=>"มิ.ย.",
            "07"=>"ก.ค.",
            "08"=>"ส.ค.",
            "09"=>"ก.ย.",
            "10"=>"ต.ค.",
            "11"=>"พ.ย.",
            "12"=>"ธ.ค.");
            $yy=substr($date,0,4);
            $mm=substr($date,5,2);
            $dd=substr($date,8,2);
            $yy+=543;
            $datethai_sm = intval($dd)." ".$_month_name[$mm]." ".$yy;
            return $datethai_sm;
        }else{
            $datethai_sm="";
            return $datethai_sm;
        }
    }

    function datethai_sm_time($date){
        if($date>0){
            $_month_name = array(
            "01"=>"ม.ค.",
            "02"=>"ก.พ.",
            "03"=>"มี.ค.",
            "04"=>"เม.ย.",
            "05"=>"พ.ค.",
            "06"=>"มิ.ย.",
            "07"=>"ก.ค.",
            "08"=>"ส.ค.",
            "09"=>"ก.ย.",
            "10"=>"ต.ค.",
            "11"=>"พ.ย.",
            "12"=>"ธ.ค.");
            $yy=substr($date,0,4);
            $mm=substr($date,5,2);
            $dd=substr($date,8,2);
            $time=substr($date,11,5);
            $yy+=543;
            $yy2=substr($yy,2,2);
            $datethai_sm_time = intval($dd)." ".$_month_name[$mm]." ".$yy2." ".$time;
            return $datethai_sm_time;
        }else{
            $datethai_sm_time="";
            return $datethai_sm_time;
        }
    }

    function dateEng($date){
        if($date>0){
            $d=explode("/",$date);
            $dd=$d[0];
            $mm=$d[1];
            $yy=$d[2];
            $yy-=543;
            $dateEng = $yy."-".$mm."-".$dd;
            return $dateEng;
        }else{
            $dateEng="";
            return $dateEng;
        }
    }

    function dateTha($date){
        if($date>0){
            $yy=substr($date,0,4);
            $mm=substr($date,5,2);
            $dd=substr($date,8,2);
            $yy+=543;
            $dateTha = intval($dd)."/".$mm."/".$yy;
            return $dateTha;
        }else{
            $dateTha="";
            return $dateTha;
        }
    }

    function dateThaYMD($date){
        if($date>0){
            $yy=substr($date,6,9);
            $mm=substr($date,3,2);
            $dd=substr($date,0,2);
            $dateThaYMD = intval($yy)."-".$mm."-".$dd;
            return $dateThaYMD;
        }else{
            $dateThaYMD="";
            return $dateThaYMD;
        }
    }

    function dateTime($date){
        if($date>0){
            $time=substr($date,11,5);
            $dateTime = $time;
            return $dateTime;
        }else{
            $dateTime="";
            return $dateTime;
        }
    }

    function dateTime_sm($date){
        if($date>0){
            $time=substr($date,0,5);
            $dateTime = $time;
            return $dateTime;
        }else{
            $dateTime="";
            return $dateTime;
        }
    }

    function datethai_my($date){
        if($date>0){
            $_month_name = array(
            "01"=>"มกราคม",
            "02"=>"กุมภาพันธ์",
            "03"=>"มีนาคม",
            "04"=>"เมษายน",
            "05"=>"พฤษภาคม",
            "06"=>"มิถุนายน",
            "07"=>"กรกฏาคม",
            "08"=>"สิงหาคม",
            "09"=>"กันยายน",
            "10"=>"ตุลาคม",
            "11"=>"พฤศจิกายน",
            "12"=>"ธันวาคม");
            $yy=substr($date,0,4);
            $mm=substr($date,5,2);
            $yy+=543;
            $datethai_my = $_month_name[$mm]." ".$yy;
            return $datethai_my;
        }else{
            return "";
        }
    }

    function datethai_m($date){
        if($date>0){
            $_month_name = array(
            "01"=>"มกราคม",
            "02"=>"กุมภาพันธ์",
            "03"=>"มีนาคม",
            "04"=>"เมษายน",
            "05"=>"พฤษภาคม",
            "06"=>"มิถุนายน",
            "07"=>"กรกฏาคม",
            "08"=>"สิงหาคม",
            "09"=>"กันยายน",
            "10"=>"ตุลาคม",
            "11"=>"พฤศจิกายน",
            "12"=>"ธันวาคม");
            $datethai_m = $_month_name[$date];
            return $datethai_m;
        }else{
            return "";
        }
    }


    function status_order($data){
        if($data=='OD'){return "<font class='tx_yellow'>สั่งซื้อสินค้า</font>";}
        else if($data=='OF'){return "<font color='red'>ชำระเงินไม่ครบ</font>";}
        else if($data=='PY'){return "<font color='green'>แจ้งชำระเงิน</font>";}
        else if($data=='PG'){return "<font color='blue'>จัดเตรียมสินค้า</font>";}
        else if($data=='TP'){return "<font color='orange'>เตรียมส่งสินค้า</font>";}
        else if($data=='SC'){return "<font color='green'>ส่งสินค้าเรียบร้อย</font>";}
        else {return "-";}
    }


    function status_Order_pay($data){
        if($data=='W'){return "<font class='tx_yellow'>รอชำระเงิน</font>";}
        else if($data=='P'){return "<font color='green'>แจ้งชำระเงิน</font>";}
        else if($data=='S'){return "<font color='blue'>ชำระเงินครบ</font>";}
        else if($data=='F'){return "<font color='red'>ชำระเงินบางส่วน</font>";}
        else if($data=='V'){return "<font color='blue'>ชำระเงินเกิน</font>";}
        else if($data=='N'){return "<font color='red'>ไม่มีชำระตามที่แจ้ง</font>";}
        else if($data=='C'){return "<font color='red'>ยกเลิก</font>";}
        else {return "-";}
    }


    function status_Order_pay_input($data){
        if($data=='W'){return "รอชำระเงิน";}
        else if($data=='P'){return "แจ้งชำระเงิน";}
        else if($data=='S'){return "ชำระเงินครบ";}
        else if($data=='F'){return "ชำระเงินบางส่วน";}
        else if($data=='V'){return "ชำระเงินเกิน";}
        else if($data=='N'){return "ไม่มีชำระตามที่แจ้ง";}
        else if($data=='C'){return "ยกเลิก";}
        else {return "-";}
    }


    function status_bt_code($data){
        if($data=='BA'){return "ชำระเงินผ่านธนาคาร/ATM";}
        else if($data=='BP'){return "ชำระเงินผ่านบริการพร้อมเพย์";}
        else if($data=='BC'){return "ชำระเงินสดตอนรับสินค้าที่หน้าร้าน";}
        else if($data=='BD'){return "ชำระผ่านบัตรเครดิต/เดบิต";}
        else {return "ไม่ได้แจ้งวิธีการชำระเงิน";}
    }

}