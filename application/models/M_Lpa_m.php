<?php
class M_Lpa_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getList(){
        $this->db->select("*");
        $this->db->from("tb_lpa");
        $this->db->where('lpa_id >0');
        $this->db->order_by("lpa_id", "DESC");
        $query = $this->db->get();
        $total_Re_l=$query->num_rows();

        $fetch = array(
            'total_Re_l'=>$total_Re_l,
            'Re_l'=>$query->result(),
        );
        return $fetch;

    }

}