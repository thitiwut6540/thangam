<?php
class B_Accesstype_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getACC($id){
        $this->db->select("*");
        $this->db->from("tb_user_level");
        $this->db->where("usl_id", $id);
        $query1 = $this->db->get();

        $this->db->select("*");
        $this->db->from("tb_user_accesstype");
        $this->db->order_by("usa_num", "ASC");
        $query2 = $this->db->get();

        $fetch = array(
            'total_Re_usl'=>$query1->num_rows(),
            'Re_usl'=>$query1->result(),
            'total_Re_usa'=>$query2->num_rows(),
            'Re_usa'=>$query2->result(),
        );
        return $fetch;
    }

    function getACC_IN($num){
        $this->db->select("*");
        $this->db->from("tb_user_accesstype");
        $this->db->where("usa_num IN(".$num.")");
        $this->db->order_by("usa_num", 'ASC');
        $query1 = $this->db->get();

        $fetch = array(
            'total_Re_in'=>$query1->num_rows(),
            'Re_in'=>$query1->result(),
        );
        return $fetch;
    }

    function getList(){
        $this->db->select("*");
        $this->db->from("tb_user_accesstype");
        $this->db->order_by("usa_num", "ASC");
        $query1 = $this->db->get();
        $total_Re_usa=$query1->num_rows();

        $this->db->select("*");
        $this->db->from("tb_user_level");
        $this->db->order_by("usl_no", "ASC");
        $query2 = $this->db->get();
        $total_Re_usl=$query2->num_rows();

        $fetch = array(
            'total_Re_usa'=>$total_Re_usa,
            'Re_usa'=>$query1->result(),
            'total_Re_usl'=>$total_Re_usl,
            'Re_usl'=>$query2->result(),
        );
        return $fetch;
    }
}