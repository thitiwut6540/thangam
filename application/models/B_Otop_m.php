<?php
class B_Otop_m extends CI_Model {
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

    function getEdit($id){
        $this->db->select("*");
        $this->db->from("tb_otop a");
        $this->db->where("otop_id", $id);
        $query1 = $this->db->get();

        $this->db->select("*");
        $this->db->from("tb_otop_photo ");
        $this->db->where("otop_id", $id);
        $this->db->order_by("otop_p_id ", "ASC");
        $query2 = $this->db->get();

        $fetch = array(
            'total_Re_ot'=>$query1->num_rows(),
            'Re_ot'=>$query1->result(),
            'total_Re_otp'=>$query2->num_rows(),
            'Re_otp'=>$query2->result(),
        );
        return $fetch;
    }

}