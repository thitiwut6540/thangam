<?php
class B_Info_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getCompany(){
        $this->db->select("*");
        $this->db->from("tb_company");
        $this->db->where("c_id", '1');
        $query = $this->db->get();
        $fetch = array(
            'Re_c'=>$query->result(),
        );
        return $fetch;
    }

    function getList($page){
        $this->db->select("*");
        $this->db->from("tb_info");
        $this->db->where("if_header", $page);
        $query1 = $this->db->get();
        $total_Re_f=$query1->num_rows();

        $fetch = array(
            'total_Re_if'=>$total_Re_f,
            'Re_if'=>$query1->result(),
        );
        return $fetch;
    }
}