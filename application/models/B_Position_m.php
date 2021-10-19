<?php
class B_Position_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getList($page){

        if($page == 'คณะผู้บริหาร'){
            $memtype = 1;
        } else if ($page == 'สมาชิกสภา'){
            $memtype = 2;
        } else if ($page == 'ผู้นำท้องถิ่น'){
            $memtype = 4;
        } else if ($page == 'ผู้ดูแลระบบ'){
            $memtype = 5;
        } else {
            $memtype = 3;
        }

        $this->db->select("a.*, b.memtype_name, c.dp_name");
        $this->db->from("tb_position a");
        $this->db->join("tb_member_type b", "a.memtype_id = b.memtype_id", "left");
        $this->db->join("tb_depart c", "a.dp_id = c.dp_id", "left");
        $this->db->where("b.memtype_id", $memtype);
        if($page !="คณะผู้บริหาร" AND $page !="สมาชิกสภา" AND $page !="ผู้นำท้องถิ่น"){
            $this->db->LIKE("c.dp_name", $page);
        }
        $this->db->order_by("a.position_no", "ASC");
        $query1 = $this->db->get();
        $total_Re_pst=$query1->num_rows();

        $this->db->select_max('position_no', 'ps_max');
        $this->db->select_min('position_no', 'ps_min');
        $this->db->from("tb_position");
        $this->db->order_by("position_no", "ASC");
        $query4 = $this->db->get();
        $total_Re_m=$query4->num_rows();

        $this->db->select("*");
        $this->db->from("tb_depart");
        $this->db->order_by("dp_id", "ASC");
        $query2 = $this->db->get();

        $this->db->select("*");
        $this->db->from("tb_member_type");
        $this->db->order_by("memtype_id", "ASC");
        $query3 = $this->db->get();

        $fetch = array(
            'total_Re_pst'=>$total_Re_pst,
            'total_Re_m'=>$total_Re_m,
            'Re_pst'=>$query1->result(),
            'Re_dt'=>$query2->result(),
            'Re_mt'=>$query3->result(),
            'Re_m'=>$query4->result(),
        );
        return $fetch;
    }



}