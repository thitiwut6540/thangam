<?php
class M_Member_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getMemTypeID($name){
        $this->db->select("memtype_id  ");
        $this->db->from("tb_member_type");
        $this->db->where("memtype_name", $name);
        $query = $this->db->get();
        $total_Re_dp=$query->num_rows();
        foreach ($query->result() as $row);

        if($total_Re_dp>0){
            $id = $row->memtype_id ;
        }else{
            $id='';
        }
        return $id;
    }

    function getDepartID($name){
        $this->db->select("dp_id");
        $this->db->from("tb_depart");
        $this->db->where("dp_name", $name);
        $query = $this->db->get();
        $total_Re_dp=$query->num_rows();
        foreach ($query->result() as $row);

        if($total_Re_dp>0){
            $id = $row->dp_id;
        }else{
            $id='';
        }
        return $id;
    }

    function getMember($memtype_id,$dp_id){

        $this->db->select("a.*,b.memtype_name");
        $this->db->from("tb_member a");
        $this->db->join("tb_member_type b", "a.memtype_id=b.memtype_id", "left");
        $this->db->where("a.memtype_id", $memtype_id);
        if(!empty($dp_id) AND $dp_id>0){
            $this->db->where("a.dp_id", $dp_id);
        }
        $this->db->order_by("a.mem_no", "ASC");
        $query = $this->db->get();

        $fetch = array(
            'total_Re_m'=>$query->num_rows(),
            'Re_m'=>$query->result(),
        );
        return $fetch;
    }

}