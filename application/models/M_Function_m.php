<?php
class M_Function_m extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function status_order($data){
        if($data=='OD'){return "<font class='tx_yellow'>สั่งซื้อสินค้า</font>";}
        else if($data=='OF'){return "<font color='red'>ชำระเงินไม่ครบ</font>";}
        else if($data=='PY'){return "<font color='green'>แจ้งชำระเงิน</font>";}
        else if($data=='PG'){return "<font color='blue'>จัดเตรียมสินค้า</font>";}
        else if($data=='TP'){return "<font color='orange'>เตรียมส่งสินค้า</font>";}
        else if($data=='SC'){return "<font color='green'>ส่งสินค้าเรียบร้อย</font>";}
        else {return "-";}
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

    function comma_remove($num){
        if($num!=""){
            $new = str_replace(",","", $num);
        }else{$new = 0;}
        return $new;
    }

    function dateformat($date) {
        //หาค่าวันที่ว่าง
        $format="Y-m-d H:i:s";
        if (trim($date) == '' || substr($date,0,10) == '0000-00-00') {return '';}
        $ts = strtotime($date);
        if ($ts === false) {return '';}
        return date($format,$ts);
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


    function DateDayDiff($start,$end){
        return (strtotime($start) - strtotime($end))/ ( 60 * 60 * 24 ); // เช็คจำนวนวัน
    }



}