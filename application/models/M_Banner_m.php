<?php
class M_Banner_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getBanMain(){
        $this->db->select("*");
        $this->db->from("tb_banner");
        $this->db->where("ban_status", "1");
        $this->db->order_by("ban_no", "ASC");
        $query1 = $this->db->get();
        $fetch = array(
            'total_Re_bm'=>$query1->num_rows(),
            'Re_bm'=>$query1->result(),
        );
        return $fetch;
    }

    function getBanTop(){
        $this->db->select("*");
        $this->db->from("tb_banner_top");
        $this->db->where("ban_status", "1");
        $this->db->order_by("ban_no", "ASC");
        $query1 = $this->db->get();
        $fetch = array(
            'total_Re_bt'=>$query1->num_rows(),
            'Re_bt'=>$query1->result(),
        );
        return $fetch;
    }


    function getBanPOP(){
        $this->db->select("*");
        $this->db->from("tb_banner_popup");
        $this->db->where("ban_status", "1");
        $this->db->order_by("ban_no", "ASC");
        $query1 = $this->db->get();
        $fetch = array(
            'total_Re_bp'=>$query1->num_rows(),
            'Re_bp'=>$query1->result(),
        );
        return $fetch;
    }

}