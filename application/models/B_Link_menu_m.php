<?php
class B_Link_menu_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getList(){
        $this->db->select("*");
        $this->db->from("tb_link_menu");
        $this->db->order_by("l_no", "ASC");
        $query1 = $this->db->get();
        $total_Re_l=$query1->num_rows();

        $this->db->select_max('l_no', 'l_max');
        $this->db->select_min('l_no', 'l_min');
        $this->db->from("tb_link_menu");
        $this->db->order_by("l_no", "ASC");
        $query2 = $this->db->get();
        $total_Re_m=$query2->num_rows();

        $fetch = array(
            'total_Re_l'=>$total_Re_l,
            'Re_l'=>$query1->result(),
            'total_Re_m'=>$total_Re_m,
            'Re_m'=>$query2->result(),
        );
        return $fetch;
    }

    function getEdit($l_id){
        $this->db->select("*");
        $this->db->from("tb_link_menu");
        $this->db->where("l_id", $l_id);
        $query1 = $this->db->get();
        $total_Re_l=$query1->num_rows();

        $fetch = array(
            'total_Re_l'=>$total_Re_l,
            'Re_l'=>$query1->result(),
        );
        return $fetch;
    }

}