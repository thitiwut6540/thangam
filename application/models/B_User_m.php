<?php
class B_User_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getDepart(){
        $this->db->select("*"); 
        $this->db->from('tb_depart');
        $this->db->order_by("dp_id", "asc");
        $query = $this->db->get();
        return $query->result();
    }
    
    function getUsl(){
        $this->db->select("*"); 
        $this->db->from('tb_user_level');
        $this->db->order_by("usl_no", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    function getUser($id){
        $this->db->select("a.*, b.usl_name"); 
        $this->db->from("tb_user a");
        $this->db->join("tb_user_level b", "a.usl_id = b.usl_id", "left");
        $this->db->WHERE("a.us_id=", $id);
        $query = $this->db->get();
        $fetch = array(
            'total_Re_u'=>$query->num_rows(),
            'Re_u'=>$query->result(),
        );
        return $fetch;
    }

    function getUserList(){
        $this->db->select("a.*, b.usl_name"); 
        $this->db->from("tb_user a");
        $this->db->join("tb_user_level b", "a.usl_id = b.usl_id", "left");
        $this->db->order_by("a.usl_id", "ASC");
        $this->db->order_by("a.dp_id", "ASC");
        $this->db->order_by("a.us_id", "ASC");
        $query = $this->db->get();
        $fetch = array(
            'total_Re_u'=>$query->num_rows(),
            'Re_u'=>$query->result(),
        );
        return $fetch;
    }
}