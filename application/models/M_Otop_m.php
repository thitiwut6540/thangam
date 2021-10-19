<?php
class M_Otop_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getOtop($limit, $offset, $search, $count){

        $this->db->select("*");
        $this->db->from("tb_otop");
        $this->db->order_by("otop_id", "DESC");
        $query = $this->db->get();
        $total_Re_ot=$query->num_rows();

        $this->db->select("*");
        $this->db->from("tb_otop");
        $this->db->order_by("otop_id", "DESC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_ot'=>$total_Re_ot,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_ot'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_ot'=>$total_Re_ot,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_ot'=>$query2->result(),
        );
        return $fetch;
    }

    function getDetail($id){

        $this->db->select("*");
        $this->db->from("tb_otop");
        $this->db->where("otop_id", $id);
        $this->db->order_by("otop_id", "DESC");
        $query = $this->db->get();

        $this->db->select("*");
        $this->db->from("tb_otop_photo");
        $this->db->where("otop_id", $id);
        $this->db->order_by("otop_p_id", "DESC");
        $query2 = $this->db->get();
        $total_Re_otp=$query2->num_rows();

        $fetch = array(
            'Re_ot'=>$query->result(),
            'Re_otp'=>$query2->result(),
            'total_Re_otp'=>$total_Re_otp,
        );
        return $fetch;
    }

}