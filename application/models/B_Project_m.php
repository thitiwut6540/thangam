<?php
class B_Project_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getList($dptype){

        $this->db->select("*");
        $this->db->from("tb_depart a");
        $this->db->join("tb_depart_type b", "a.dptype_id = b.dptype_id", "left");
        $this->db->where("a.dptype_id", $dptype);
        $query1 = $this->db->get();
        $total_Re_rl=$query1->num_rows();

        $fetch = array(
            'total_Re_rl'=>$total_Re_rl,
            'Re_rl'=>$query1->result(),
        );
        return $fetch;
    }

    function getEdit($id){

        $this->db->select("*");
        $this->db->from("tb_depart");
        $this->db->where("dp_id", $id);
        $query1 = $this->db->get();
        $total_Re_rl=$query1->num_rows();

        $fetch = array(
            'total_Re_rl'=>$total_Re_rl,
            'Re_rl'=>$query1->result(),
        );
        return $fetch;
    }


}