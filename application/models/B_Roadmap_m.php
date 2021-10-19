<?php
class B_Roadmap_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function emptyArray($array){
        $no=0;
        for($i=0;$i<count($array);$i++){
            if(!empty($array[$i])){
                $no+=1;
            }else{
                $no+=0;
            }
        }
        if($no==0){return false;}else{return true;}
    }

    function getTypeByName($name){
        $this->db->select("*");
        $this->db->from("tb_roadmap_type");
        $this->db->where("rm_t_name",$name);
        $query1 = $this->db->get();
        foreach ($query1->result() as $row);
        $id = $row->rm_t_id;
        return $id;
    }

    function getTypeList(){
        $this->db->select("*");
        $this->db->from("tb_roadmap_type");
        $this->db->order_by("rm_t_id", "ASC");
        $query1 = $this->db->get();
        $total_Re_rmt=$query1->num_rows();

        $fetch = array(
            'total_Re_rmt'=>$total_Re_rmt,
            'Re_rmt'=>$query1->result(),
        );
        return $fetch;
    }

    function getTypeEdit($id){
        $this->db->select("*");
        $this->db->from("tb_roadmap_type");
        $this->db->where("rm_t_id", $id);
        $query1 = $this->db->get();
        $total_Re_rmt=$query1->num_rows();

        $fetch = array(
            'total_Re_rmt'=>$total_Re_rmt,
            'Re_rmt'=>$query1->result(),
        );
        return $fetch;
    }

    function getTypeInsertSave($data){
        
        $this->db->trans_begin();
            $data1 = array(
                'rm_t_id' => NULL,
                'rm_t_name' => $data['rm_t_name'],
            );
            $this->db->insert('tb_roadmap_type', $data1);

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

    function getTypeEditSave($data){
        $this->db->trans_begin();
            $data1 = array(
                'rm_t_name' => $data['rm_t_name'],
            );
            $this->db->where('rm_t_id', $data['rm_t_id']);
            $this->db->update('tb_roadmap_type', $data1);


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

    function getRmList($limit, $offset, $search, $count){

        $rm_t_id=$search['type_id'];
        $condition="a.rm_id !='' AND a.rm_t_id='".$rm_t_id."' ";
        if($search){
            if(!empty($search['rm_name'])){
                $condition.="AND a.rm_name LINK '%".$search['rm_name']."' ";
            }
        } 

        $this->db->select("a.rm_id");
        $this->db->from("tb_roadmap a");
        $this->db->where($condition);
        $this->db->order_by("a.rm_id", "DESC");
        $query = $this->db->get();
        $total_Re_rm=$query->num_rows();

        $this->db->select("a.*, b.rm_t_name, b.rm_t_id");
        $this->db->from("tb_roadmap a");
        $this->db->join("tb_roadmap_type b", "a.rm_t_id = b.rm_t_id", "left");
        $this->db->where($condition);
        $this->db->order_by("a.rm_id", "DESC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_rm'=>$total_Re_rm,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_rm'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_rm'=>$total_Re_rm,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_rm'=>$query2->result(),
        );
        return $fetch;

    }

    function getRmEdit($id){
        $this->db->select("a.*, b.rm_t_name, b.rm_t_id");
        $this->db->from("tb_roadmap a");
        $this->db->join("tb_roadmap_type b", "a.rm_t_id = b.rm_t_id", "left");
        $this->db->where("a.rm_id", $id);
        $query1 = $this->db->get();
        $total_Re_rm=$query1->num_rows();

        $this->db->select("*");
        $this->db->from("tb_roadmap_file");
        $this->db->where("rm_id", $id);
        $query2 = $this->db->get();
        $total_Re_rmf=$query2->num_rows();

        $fetch = array(
            'total_Re_rm'=>$total_Re_rm,
            'Re_rm'=>$query1->result(),
            'total_Re_rmf'=>$total_Re_rmf,
            'Re_rmf'=>$query2->result(),
        );
        return $fetch;
    }
}