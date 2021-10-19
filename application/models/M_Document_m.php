<?php
class M_Document_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getDocumentType(){
        $this->db->select("*");
        $this->db->from("tb_document_type");
        $this->db->order_by("dt_id", "ASC");
        $query = $this->db->get();
        $fetch = array(
            'Re_dt'=>$query->result(),
        );
        return $fetch;
    }

    function getDocument($type){
        $this->db->select("*");
        $this->db->from("tb_document");
        $this->db->where("dt_id", $type);
        $this->db->where("d_approve", "Y");
        $this->db->where("d_status", "Y");
        $this->db->order_by("d_id", "ASC");
        $query = $this->db->get();
        $fetch = array(
            'total_Re_d'=>$query->num_rows(),
            'Re_d'=>$query->result(),
        );
        return $fetch;
    }

    function getDocumentFile($id){
        $this->db->select("*");
        $this->db->from("tb_document_file");
        $this->db->where("d_id", $id);
        $this->db->order_by("df_id", "ASC");
        $query = $this->db->get();
        $fetch = array(
            'total_Re_df'=>$query->num_rows(),
            'Re_df'=>$query->result(),
        );
        return $fetch;
    }
}