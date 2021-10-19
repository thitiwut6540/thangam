<?php
class B_Lpa_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getInsertSave($data,$file){
        
        $this->db->trans_begin();
            $d1 = array(
                'lpa_id' => NULL,
                'lpa_name' => $data['lpa_name'],
                'lpa_file' => $file,
            );
            $this->db->insert('tb_lpa', $d1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'บันทึกข้อมูลเรียบร้อย');
            return $Response;
            exit;
        }
    }

    function getEditSave($data,$file){
        $this->db->trans_begin();
            $d1 = array(
                'lpa_name' => $data['lpa_name'],
                'lpa_file' => $file,
            );
            $this->db->where('lpa_id', $data['lpa_id']);
            $this->db->update('tb_lpa', $d1);


        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'บันทึกข้อมูลเรียบร้อย');
            return $Response;
            exit;
        }
    }

    function getList($limit, $offset, $search, $count){

        $this->db->select("lpa_id");
        $this->db->from("tb_lpa");
        $this->db->where('lpa_id >0');
        $this->db->order_by("lpa_id", "DESC");
        $query = $this->db->get();
        $total_Re_l=$query->num_rows();

        $this->db->select("*");
        $this->db->from("tb_lpa ");
        $this->db->where('lpa_id >0');
        $this->db->order_by("lpa_id", "DESC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_l'=>$total_Re_l,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_l'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_l'=>$total_Re_l,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_l'=>$query2->result(),
        );
        return $fetch;

    }

    function getDcEdit($id){
        $this->db->select("*");
        $this->db->from("tb_lpa a");
        $this->db->where("lpa_id", $id);
        $query1 = $this->db->get();
        $total_Re_l=$query1->num_rows();

        $fetch = array(
            'total_Re_l'=>$total_Re_l,
            'Re_l'=>$query1->result(),
        );
        return $fetch;
    }
}