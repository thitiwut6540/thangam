<?php
class M_Ita_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getItaYearDetail(){

        $this->db->select("*");
        $this->db->from("tb_ita_year");
        $this->db->where("y_status", 'Y');
        $this->db->order_by("y_name", 'DESC');
        $this->db->limit("1");
        $query1 = $this->db->get();
        foreach ($query1->result() as $row_Re_g);
        $y_id=$row_Re_g->y_id;

        $this->db->select("*");
        $this->db->from("tb_ita_year_group");
        $this->db->where("y_id", $y_id);
        $this->db->order_by("g_no", "ASC");
        $query2 = $this->db->get();
        
        $fetch = array(
            'Re_y'=>$query1->result(),
            'total_Re_g'=>$query2->num_rows(),
            'Re_g'=>$query2->result(),
        );
        return $fetch;
    }

    function getYearTopic($g_id){
        $this->db->select("*");
        $this->db->from("tb_ita_year_topic");
        $this->db->where("g_id", $g_id);
        $this->db->order_by("t_id", "ASC");
        $query = $this->db->get();
        $fetch = array(
            'total_Re_t'=>$query->num_rows(),
            'Re_t'=>$query->result(),
        );
        return $fetch;
    }

    function getYearSub($t_id){
        $this->db->select("*");
        $this->db->from("tb_ita_year_sub");
        $this->db->where("t_id", $t_id);
        $this->db->order_by("s_no", "ASC");
        $query = $this->db->get();
        $fetch = array(
            'total_Re_s'=>$query->num_rows(),
            'Re_s'=>$query->result(),
        );
        return $fetch;
    }

    function getYearUrl($s_id){
        $this->db->select("*");
        $this->db->from("tb_ita_year_url");
        $this->db->where("s_id", $s_id);
        $this->db->order_by("u_id", "ASC");
        $query = $this->db->get();
        $fetch = array(
            'total_Re_u'=>$query->num_rows(),
            'Re_u'=>$query->result(),
        );
        return $fetch;
    }

    function getYearUrlNew($data){

        $this->db->trans_begin();
            $data1 = array(
                'u_id' => NULL,
                'y_id' => $data['y_id'],
                'g_id' => $data['g_id'],
                't_id' => $data['t_id'],
                's_id' => $data['s_id'],
                'u_name' => $data['u_name'],
                'u_url' => $data['u_url']
            );
            $this->db->insert('tb_ita_year_url', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'เพิ่มข้อมูลเรียบร้อย');
            return $Response;
            exit;
        }
    }

}