<?php
class M_Operations_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getOpr($limit, $offset, $search, $count){
        //total
        $this->db->select("a.*, b.dp_name");
        $this->db->from("tb_opr a");
        $this->db->join("tb_depart b", "a.dp_id = b.dp_id", "left");
        $this->db->order_by("a.opr_id", "DESC");
        $query = $this->db->get();
        $total_Re_chk=$query->num_rows();

        //LIST
        $this->db->select("a.*, b.dp_name");
        $this->db->from("tb_opr a");
        $this->db->join("tb_depart b", "a.dp_id = b.dp_id", "left");
        $this->db->order_by("a.opr_id", "DESC");
  
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
                    'Re_all'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_chk'=>$total_Re_chk,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_all'=>$query2->result(),
        );
        return $fetch;
    }

    function getOprType($limit, $offset, $search, $count){
        //total
        $this->db->select("a.*, b.dp_name");
        $this->db->from("tb_opr a");
        $this->db->join("tb_depart b", "a.dp_id = b.dp_id", "left");
        $this->db->where("a.dp_id", $search);
        $this->db->order_by("a.opr_id", "DESC");
        $query = $this->db->get();
        $total_Re_chk=$query->num_rows();

        //LIST
        $this->db->select("a.*, b.dp_name");
        $this->db->from("tb_opr a");
        $this->db->join("tb_depart b", "a.dp_id = b.dp_id", "left");
        $this->db->where("a.dp_id", $search);
        $this->db->order_by("a.opr_id", "DESC");
  
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
                    'Re_all'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_chk'=>$total_Re_chk,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_all'=>$query2->result(),
        );
        return $fetch;
    }

}