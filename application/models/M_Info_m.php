<?php
class M_Info_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getDetail($name){
        $this->db->select("*");
        $this->db->from("tb_info");
        $this->db->where("if_header", $name);
        $query = $this->db->get();
        $fetch = array(
            'Re_if'=>$query->result(),
            'total_Re_if'=>$query->num_rows(),
        );
        return $fetch;
    }

}