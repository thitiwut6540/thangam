<?php
class M_History_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getList($type){
        $this->db->select("*");
        $this->db->from("tb_history");
        $this->db->where('h_type',$type);
        $this->db->order_by('h_no','ASC');
        $query1 = $this->db->get();

        $fetch = array(
            'total_Re_h'=>$query1->num_rows(),
            'Re_h'=>$query1->result(),
        );
        return $fetch;
    }
}