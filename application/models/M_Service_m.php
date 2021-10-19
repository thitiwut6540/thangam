<?php
class M_Service_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getServiceType(){

        $this->db->select("*");
        $this->db->from("tb_service_type");
        $this->db->order_by("st_id", "ASC");
        $query = $this->db->get();
        $fetch = array(
            'Re_st'=>$query->result(),
        );
        return $fetch;
    }

    function getServiceInsert($data,$fileName1){
        
        if(!empty($data['s_type']) AND !empty($data['s_title']) AND !empty($data['s_cus_name']) AND !empty($data['s_cus_id']) AND !empty($data['s_cus_tel']) ){
            $this->db->trans_begin();
                $yth=substr((date('Y')+543),2 ,2);
                $yid="S".$yth;
                
                $sql = "SELECT MAX(s_no) AS max_no FROM tb_service WHERE s_no like '$yid%'";
                $Re_co = $this->db->query($sql);
                $row_Re_co = $Re_co->row_array();

                $max_no=$row_Re_co['max_no'];
                if(strlen($max_no) < 1){
                    $s_no=$yid."0001";
                }else{
                    $num1=substr(($row_Re_co['max_no']),4 ,4);
                    $num2=$num1+1;
                    $num3=str_pad($num2,4,"0",STR_PAD_LEFT);
                    $s_no=$yid.$num3;
                }
                $day1=date("Y-m-d H:i:s");

                $data1 = array(
                    's_id' => NULL,
                    's_no' => $s_no,
                    's_status' => 'ขอรับบริการ',
                    's_date' =>  $day1,
                    's_type' => $data['s_type'],
                    's_title' => $data['s_title'],
                    's_detail' => $data['s_detail'],
                    's_file' => $fileName1,
                    's_cus_name' => $data['s_cus_name'],
                    's_cus_id' => $data['s_cus_id'],
                    's_cus_no' => $data['s_cus_no'],
                    's_cus_moo' => $data['s_cus_moo'],
                    's_cus_city' => $data['s_cus_city'],
                    's_cus_alley' => $data['s_cus_alley'],
                    's_cus_road' => $data['s_cus_road'],
                    's_cus_district' => $data['s_cus_district'],
                    's_cus_amphoe' => $data['s_cus_amphoe'],
                    's_cus_province' => $data['s_cus_province'],
                    's_cus_tel' => $data['s_cus_tel'],
                    's_cus_line' => $data['s_cus_line'],
                    's_sv_us_name' => NULL,
                    's_sv_date' => NULL,
                    's_sv_note' => NULL
                );
                $this->db->insert('tb_service', $data1);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $Response = array('action' => 'N','output' => 'ไม่สามารถขอรับบริการออนไลน์ได้กรุุณาติดต่อเจ้าหน้าที่');
                return $Response;
                exit;
            }else{
                $this->db->trans_commit();
                if(!empty(ANW_LINE)){
                    $msg = "\nขอรับบริการออนไลน์\nวันที่แจ้ง ".$this->M_Function_m->datethai_sm_time($day1)."\n".$data['s_title']." \nคุณ ".$data['s_cus_name']."";
                    $this->M_Notify_m->getLineNotify($msg);
                }

                $Response = array('action' => 'Y','output' => 'ขอรับบริการออนไลน์เรียบร้อย <br>เจ้าหน้าที่จะติดต่อในวันเวลาทำการโดยเร็ว');
                return $Response;
                exit;
            }
        }else{
            $Response = array('action' => 'N','output' => 'ไม่ได้ป้อนข้อมูล');
            return $Response;
            exit;
        }
    }

}