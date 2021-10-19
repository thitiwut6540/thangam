<?php
class B_Banner_main_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getList(){

        $this->db->select("*");
        $this->db->from("tb_banner");
        $this->db->order_by("ban_no", "ASC");
        $query1 = $this->db->get();
        $total_Re_b=$query1->num_rows();

        $this->db->select_max('ban_no', 'ban_max');
        $this->db->select_min('ban_no', 'ban_min');
        $this->db->from("tb_banner");
        $this->db->order_by("ban_no", "ASC");
        $query2 = $this->db->get();
        $total_Re_m=$query2->num_rows();

        $fetch = array(
            'total_Re_b'=>$total_Re_b,
            'Re_b'=>$query1->result(),
            'total_Re_m'=>$total_Re_m,
            'Re_m'=>$query2->result(),
        );
        return $fetch;
    }

    function getEdit($ban_id){

        $this->db->select("*");
        $this->db->from("tb_banner");
        $this->db->where("ban_id", $ban_id);
        $query1 = $this->db->get();
        $total_Re_b=$query1->num_rows();

        $fetch = array(
            'total_Re_b'=>$total_Re_b,
            'Re_b'=>$query1->result(),
        );
        return $fetch;
    }
}