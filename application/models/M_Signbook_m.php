<?php
class M_Signbook_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getSb($id){
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

        $condition="a.sbl_id !='' AND a.sb_id = '".$search['sb_id']."' ";

        $this->db->select("a.sbl_id");
        $this->db->from("tb_signbook_list a");
        $this->db->join("tb_signbook b","a.sb_id=b.sb_id","left");
        $this->db->where($condition);
        $this->db->order_by("a.sbl_id", "ASC");
        $query = $this->db->get();
        $total_Re_sb=$query->num_rows();
        
        $this->db->select("a.*, b.sb_form_title, b.sb_form_name");
        $this->db->from("tb_signbook_list a");
        $this->db->join("tb_signbook b","a.sb_id=b.sb_id","left");
        $this->db->where($condition);
        $this->db->order_by("a.sbl_id", "ASC");
  
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

    function getSblSave($data){

        $this->db->trans_begin();
            $d1 = array(
                'sbl_id' => NULL, 
                'sb_id' => $data['sb_id'], 
                'sbl_name' => $data['sbl_name'], 
                'sbl_detail' => $data['sbl_detail'], 
                'sbl_date' => date('Y-m-d H:i:s'), 
            );
            $this->db->insert('tb_signbook_list', $d1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'เกิดความผิดพลาดไม่สามารถการบันทึกข้อความได้');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'บันทึกข้อความเรียบร้อย');
            return $Response;
            exit;
        }
        
    }
}