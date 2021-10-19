<?php
class B_Signbook_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getSbList($limit, $offset, $search, $count){

        $condition="a.sb_id !='' ";
        $this->db->select("a.sb_id");
        $this->db->from("tb_signbook a");
        $this->db->where($condition);
        $this->db->order_by("a.sb_id", "DESC");
        $query = $this->db->get();
        $total_Re_sb=$query->num_rows();

        $this->db->select("a.*, c.sum_sbl");
        $this->db->from("tb_signbook a");
        $this->db->join("(SELECT sb_id, COUNT(sbl_id) AS sum_sbl FROM tb_signbook_list GROUP BY sb_id) c", "a.sb_id = c.sb_id", "left");
        $this->db->where($condition);
        $this->db->order_by("a.sb_id", "DESC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
            
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'total_Re_sb'=>$total_Re_sb,
                    'Re_sb'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'total_Re_sb'=>$total_Re_sb,
            'Re_sb'=>$query2->result(),
        );
        return $fetch;
    }

    function getSblList($limit, $offset, $search, $count){

        $condition="sbl_id !='' AND sb_id = '".$search['sb_id']."' ";
        
        $this->db->select("sbl_id");
        $this->db->from("tb_signbook_list");
        $this->db->where($condition);
        $this->db->order_by("sbl_id", "ASC");
        $query = $this->db->get();
        $total_Re_sb=$query->num_rows();

        $this->db->select("*");
        $this->db->from("tb_signbook_list");
        $this->db->where($condition);
        $this->db->order_by("sbl_id", "ASC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
            
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'total_Re_sbl'=>$total_Re_sb,
                    'Re_sbl'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'total_Re_sbl'=>$total_Re_sb,
            'Re_sbl'=>$query2->result(),
        );
        return $fetch;
    }

    function getEdit($id){
        $this->db->select("*");
        $this->db->from("tb_signbook");
        $this->db->where('sb_id',$id);
        $query1 = $this->db->get();
        $total_Re_sb=$query1->num_rows();

        $fetch = array(
            'total_Re_sb'=>$total_Re_sb,
            'Re_sb'=>$query1->result(),
        );
        return $fetch;
    }

    function getEditSave($data,$photoName){
        $this->db->trans_begin();
            $d1 = array(
                'sb_name' => $data['sb_name'], 
                'sb_title' => $data['sb_title'], 
                'sb_date' => date('Y-m-d H:i:s'), 
                'sb_form_title' => $data['sb_form_title'], 
                'sb_form_name' => $data['sb_form_name'], 
                'sb_photo' => $photoName,
            );
            $this->db->where('sb_id', $data['sb_id']);
            $this->db->update('tb_signbook', $d1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกแก้ไขข้อมูลได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'บันทึกแก้ไขข้อมูลเรียบร้อย');
            return $Response;
            exit;
        }
        
    }

    function getInsertSave($data,$photoName){
        $this->db->trans_begin();
            $d1 = array(
                'sb_id' => NULL,
                'sb_name' => $data['sb_name'], 
                'sb_title' => $data['sb_title'], 
                'sb_date' => date('Y-m-d H:i:s'), 
                'sb_form_title' => $data['sb_form_title'], 
                'sb_form_name' => $data['sb_form_name'], 
                'sb_photo' => $photoName,
            );
            $this->db->insert('tb_signbook', $d1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกสมุดลงนามได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'เพิ่มสมุดลงนามเรียบร้อย');
            return $Response;
            exit;
        }
        
    }
}