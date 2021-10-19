<?php
class M_Qa_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getQA(){

        $this->db->select("*");
        $this->db->from("tb_qa");
        $this->db->order_by("qa_id", "ASC");
        $query = $this->db->get();
        $fetch = array(
            'total_Re_qa'=>$query->num_rows(),
            'Re_qa'=>$query->result(),
        );
        return $fetch;
    }

}