<?php
class M_Corrupt_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getCorruptInsert($data,$photoName1,$photoName2){
        if(!empty($data['c_type']) AND !empty($data['c_title']) AND !empty($data['c_cus_name']) AND !empty($data['c_cus_id']) AND !empty($data['c_cus_tel']) ){
            $this->db->trans_begin();
                $yth=substr((date('Y')+543),2 ,2);
                $yid="C".$yth;
                
                $sql = "SELECT MAX(c_no) AS max_no FROM tb_complain WHERE c_cata='C' AND c_no like '$yid%'";
                $Re_co = $this->db->query($sql);
                $row_Re_co = $Re_co->row_array();

                $max_no=$row_Re_co['max_no'];
                if(strlen($max_no) < 1){
                    $c_no=$yid."0001";
                }else{
                    $num1=substr(($row_Re_co['max_no']),4 ,4);
                    $num2=$num1+1;
                    $num3=str_pad($num2,4,"0",STR_PAD_LEFT);
                    $c_no=$yid.$num3;
                }

                $day1=date("Y-m-d H:i:s");

                $data1 = array(
                    'c_id' => NULL,
                    'c_no' => $c_no,
                    'c_cata' => 'C',
                    'c_status' => 'แจ้งเรื่อง',
                    'c_date' =>  $day1,
                    'c_type' => '',
                    'c_title' => $data['c_title'],
                    'c_detail' => $data['c_detail'],
                    'c_photo1' => $photoName1,
                    'c_photo2' => $photoName2,
                    'c_cus_name' => $data['c_cus_name'],
                    'c_cus_id' => $data['c_cus_id'],
                    'c_cus_no' => $data['c_cus_no'],
                    'c_cus_moo' => $data['c_cus_moo'],
                    'c_cus_city' => $data['c_cus_city'],
                    'c_cus_alley' => $data['c_cus_alley'],
                    'c_cus_road' => $data['c_cus_road'],
                    'c_cus_district' => $data['c_cus_district'],
                    'c_cus_amphoe' => $data['c_cus_amphoe'],
                    'c_cus_province' => $data['c_cus_province'],
                    'c_cus_tel' => $data['c_cus_tel'],
                    'c_cus_line' => $data['c_cus_line']
                );
                $this->db->insert('tb_complain', $data1);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $Response = array('action' => 'N','output' => 'ไม่สามารถส่งเรื่อง ร้องเรียนทุจริตและประพฤติมิชอบได้<br>กรุุณาติดต่อเจ้าหน้าที่');
                return $Response;
                exit;
            }else{
                $this->db->trans_commit();

                if(!empty(ANW_LINE)){
                    $msg = "\nร้องเรียนทุจริตและประพฤติมิชอบ\nวันที่แจ้ง ".$this->M_Function_m->datethai_sm_time($day1)."\nเรื่อง ".$data['c_title']." \nคุณ ".$data['s_cus_name']."";
                    $this->M_Notify_m->getLineNotify($msg);

                    $msg = "\nร้องเรียนทุจริตและประพฤติมิชอบ\nวันที่แจ้ง ".$this->M_Function_m->datethai_sm_time($day1)."\n".$data['c_title']." \nคุณ ".$data['c_cus_name']."";
                    $this->M_Notify_m->getLineNotify($msg);
                }

                $Response = array('action' => 'Y','output' => 'แจ้งเรื่อง ร้องเรียนทุจริตและประพฤติมิชอบ เรียบร้อย');
                return $Response;
                exit;
            }
        }else{
            $Response = array('action' => 'N','output' => 'ไม่ได้ป้อนข้อมูล');
            return $Response;
            exit;
        }
    }

    function getCorruptList($limit, $offset, $search, $count){

        $this->db->select("c_id");
        $this->db->from("tb_complain");
        $this->db->where("c_cata", "C");
        $query = $this->db->get();
        $total_Re_c=$query->num_rows();

        $this->db->select("*");
        $this->db->from("tb_complain");
        $this->db->where("c_cata", "C");
        $this->db->order_by("c_no", "DESC");

		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_c'=>$total_Re_c,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_c'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_c'=>$total_Re_c,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_c'=>$query2->result(),
        );
        return $fetch;

    }

    function getCorrupt($no){

        $this->db->select("*");
        $this->db->from("tb_complain");
        $this->db->where("c_no", $no);
        $this->db->where("c_cata", "C");
        $query = $this->db->get();
        $total_Re1=$query->num_rows();

        $this->db->select("a.*, b.dp_name");
        $this->db->from("tb_complain_action a");
        $this->db->join("tb_depart b", "a.dp_id = b.dp_id", "left");
        $this->db->where("a.c_no", $no);
        $this->db->order_by("a.ca_id", 'ASC');
        $query1 = $this->db->get();
        $total_Re2=$query1->num_rows();
        foreach($query1->result() as $row);

        $fetch = array(
            'total_Re_c'=>$total_Re1,
            'Re_c'=>$query->result(),
            'total_Re_ca'=>$total_Re2,
            'Re_ca'=>$query1->result(),
        );
        return $fetch;
    }
}