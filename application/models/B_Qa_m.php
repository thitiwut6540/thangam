<?php
class B_Qa_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getQaList($limit, $offset, $search, $count){

        $condition="qa_id !=''";

        $this->db->select("qa_id");
        $this->db->from("tb_qa");
        $this->db->where($condition);
        $query = $this->db->get();
        $total_Re_q=$query->num_rows();

        $this->db->select("*");
        $this->db->from("tb_qa");
        $this->db->where($condition);
        $this->db->order_by("qa_id", "ASC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_q'=>$total_Re_q,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_q'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_q'=>$total_Re_q,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_q'=>$query2->result(),
        );
        return $fetch;

    }

    function getQaEdit($id){
        $this->db->select("*");
        $this->db->from("tb_qa");
        $this->db->where("qa_id", $id);
        $query1 = $this->db->get();
        $total_Re_q=$query1->num_rows();

        $fetch = array(
            'total_Re_q'=>$total_Re_q,
            'Re_q'=>$query1->result(),
        );
        return $fetch;
    }
}