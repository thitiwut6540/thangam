<?php
class M_Department_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getDepartTypeID($name){
        $this->db->select("dptype_id ");
        $this->db->from("tb_depart_type");
        $this->db->where("dptype_name", $name);
        $query = $this->db->get();
        $total_Re_dp=$query->num_rows();
        foreach ($query->result() as $row);

        if($total_Re_dp>0){
            $id = $row->dptype_id ;
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

    function getDepart($dptype_id,$dp_id){

        $this->db->select("a.*,b.dptype_name");
        $this->db->from("tb_depart a");
        $this->db->join("tb_depart_type b", "a.dptype_id=b.dptype_id", "left");
        $this->db->where("a.dptype_id", $dptype_id);
        $this->db->where("a.dp_id", $dp_id);
        $query = $this->db->get();

        $fetch = array(
            'total_Re_dp'=>$query->num_rows(),
            'Re_dp'=>$query->result(),
        );
        return $fetch;
    }

}