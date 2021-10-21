<?php
class M_Menu_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    // ข้อมูลเทศบาล
    function getMenuInfo(){
        $this->db->select("*");
        $this->db->from("tb_info");
        $this->db->order_by("if_id", "ASC");
        $query = $this->db->get();
        $fetch = array(
            'total_Re_if'=>$query->num_rows(),
            'Re_if'=>$query->result(),
        );
        return $fetch;
    }

    function getMenuGallery(){
        $this->db->select("a.*,b.dptype_name");
        $this->db->from("tb_depart a");
        $this->db->join("tb_depart_type b", "a.dptype_id=b.dptype_id", "left");
        $this->db->order_by("a.dptype_id",'ASC');
        $this->db->order_by("a.dp_no",'ASC');
        $query = $this->db->get();
        $fetch = array(
            'total_Re_dp'=>$query->num_rows(),
            'Re_dp'=>$query->result(),
        );
        return $fetch;
    }

    function getMenuDepart($id){
        $this->db->select("a.*,b.dptype_name");
        $this->db->from("tb_depart a");
        $this->db->join("tb_depart_type b", "a.dptype_id=b.dptype_id", "left");
        if(!empty($id)){$this->db->where("a.dptype_id",$id);}
        $this->db->order_by("a.dptype_id",'ASC');
        $this->db->order_by("a.dp_no",'ASC');
        $query = $this->db->get();
        $fetch = array(
            'total_Re_dp'=>$query->num_rows(),
            'Re_dp'=>$query->result(),
        );
        return $fetch;
    }

    function getMenuNews(){
        $this->db->select("*");
        $this->db->from("tb_news_type");
        $this->db->order_by("newstype_id",'ASC');
        $query = $this->db->get();
        $fetch = array(
            'total_Re_nt'=>$query->num_rows(),
            'Re_nt'=>$query->result(),
        );
        return $fetch;
    }

    function getMenuLaws(){
        $this->db->select("*");
        $this->db->from("tb_statute_type");
        $this->db->order_by("stt_t_id",'ASC');
        $query = $this->db->get();
        $fetch = array(
            'total_Re_stt'=>$query->num_rows(),
            'Re_stt'=>$query->result(),
        );
        return $fetch;
    }

    function getMenuRoadmapType(){
        $this->db->select("*");
        $this->db->from("tb_roadmap_type");
        $this->db->order_by("rm_t_id",'ASC');
        $query = $this->db->get();
        $fetch = array(
            'total_Re_rmt'=>$query->num_rows(),
            'Re_rmt'=>$query->result(),
        );
        return $fetch;
    }

}