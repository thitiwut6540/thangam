<?php
class B_Statute_m extends CI_Model {
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
        $this->db->from("tb_statute_type");
        $this->db->where("stt_t_name",$name);
        $query1 = $this->db->get();
        foreach ($query1->result() as $row);
        $id = $row->stt_t_id;
        return $id;
    }

    function getTypeList(){
        $this->db->select("*");
        $this->db->from("tb_statute_type");
        $this->db->order_by("stt_t_id", "ASC");
        $query1 = $this->db->get();
        $total_Re_st=$query1->num_rows();

        $fetch = array(
            'total_Re_st'=>$total_Re_st,
            'Re_st'=>$query1->result(),
        );
        return $fetch;
    }

    function getTypeEdit($id){
        $this->db->select("*");
        $this->db->from("tb_statute_type");
        $this->db->where("stt_t_id", $id);
        $query1 = $this->db->get();
        $total_Re_st=$query1->num_rows();

        $fetch = array(
            'total_Re_st'=>$total_Re_st,
            'Re_st'=>$query1->result(),
        );
        return $fetch;
    }

    function getTypeInsertSave($data){
        
        $this->db->trans_begin();
            $data1 = array(
                'stt_t_id' => NULL,
                'stt_t_name' => $data['stt_t_name'],
            );
            $this->db->insert('tb_statute_type', $data1);

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
                'stt_t_name' => $data['stt_t_name'],
            );
            $this->db->where('stt_t_id', $data['stt_t_id']);
            $this->db->update('tb_statute_type', $data1);


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

    function getSttList($limit, $offset, $search, $count){

        $stt_t_id=$search['type_id'];
        $condition="a.stt_id !='' AND a.stt_t_id='".$stt_t_id."' ";
        if($search){
            if(!empty($search['stt_name'])){
                $condition.="AND a.stt_name LINK '%".$search['stt_name']."' ";
            }
        } 

        $this->db->select("a.stt_id");
        $this->db->from("tb_statute a");
        $this->db->where($condition);
        $this->db->order_by("a.stt_id", "DESC");
        $query = $this->db->get();
        $total_Re_s=$query->num_rows();

        $this->db->select("a.*, b.stt_t_name, b.stt_t_id");
        $this->db->from("tb_statute a");
        $this->db->join("tb_statute_type b", "a.stt_t_id = b.stt_t_id", "left");
        $this->db->where($condition);
        $this->db->order_by("a.stt_id", "DESC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_s'=>$total_Re_s,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_s'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_s'=>$total_Re_s,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_s'=>$query2->result(),
        );
        return $fetch;

    }

    function getSttEdit($id){
        $this->db->select("a.*, b.stt_t_name, b.stt_t_id");
        $this->db->from("tb_statute a");
        $this->db->join("tb_statute_type b", "a.stt_t_id = b.stt_t_id", "left");
        $this->db->where("a.stt_id", $id);
        $query1 = $this->db->get();
        $total_Re_s=$query1->num_rows();

        $this->db->select("*");
        $this->db->from("tb_statute_file");
        $this->db->where("stt_id", $id);
        $query2 = $this->db->get();
        $total_Re_sf=$query2->num_rows();

        $fetch = array(
            'total_Re_s'=>$total_Re_s,
            'Re_s'=>$query1->result(),
            'total_Re_sf'=>$total_Re_sf,
            'Re_sf'=>$query2->result(),
        );
        return $fetch;
    }
}