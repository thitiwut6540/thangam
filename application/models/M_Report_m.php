<?php
class M_Report_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function emptyArray($array){
        $no=0;
        for($i=0;$i<count($array);$i++){
            if(!empty($array[$i])){
                $no+=1;
            }else{
                $no+=0;
            }
        }
        if($no==0){return false;}else{return true;}
    }

    function getList($limit, $offset, $search, $count){

        //total
        $this->db->select("*");
        $this->db->from("tb_report");
        $this->db->order_by("report_id", "DESC");
        $query = $this->db->get();
        $total_Re_chk=$query->num_rows();

        //LIST
        $this->db->select("*");
        $this->db->from("tb_report");
        $this->db->order_by("report_id", "DESC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_chk'=>$total_Re_chk,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_rp'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_chk'=>$total_Re_chk,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_rp'=>$query2->result(),
        );
        return $fetch;

    }





}