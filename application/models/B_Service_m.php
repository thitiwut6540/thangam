<?php
class B_Service_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getTypeList(){
        $this->db->select("*");
        $this->db->from("tb_service_type");
        $this->db->order_by("st_id", "ASC");
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
        $this->db->from("tb_service_type");
        $this->db->where("st_id", $id);
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
                'st_id' => NULL,
                'st_name' => $data['st_name'],
            );
            $this->db->insert('tb_service_type', $data1);

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
                'st_name' => $data['st_name'],
            );
            $this->db->where('st_id', $data['st_id']);
            $this->db->update('tb_service_type', $data1);


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

    function getServiceDetail($no){
        $this->db->select("a.*,b.st_name");
        $this->db->from("tb_service a");
        $this->db->join("tb_service_type b", "a.s_type = b.st_id", "left");
        $this->db->where("s_no", $no);
        $query = $this->db->get();
        $total_Re1=$query->num_rows();

        $fetch = array(
            'total_Re_s'=>$total_Re1,
            'Re_s'=>$query->result(),
        );
        return $fetch;
    }


    function getServiceList($limit, $offset, $search, $count){

        $s_status = $search['s_status'];
        $condition="a.s_id!='' AND a.s_status ='".$s_status."' ";
        if($search){
            if(!empty($search['s_type'])){
                $condition.="AND a.s_type='".$search['s_type']."' ";
            }
            if(!empty($search['s_title'])){
                $condition.="AND a.s_title LINK '%".$search['s_title']."' ";
            }
            if(!empty($search['s_cus_name'])){
                $condition.="AND a.s_cus_name LINK '%".$search['s_cus_name']."' ";
            }
        } 

        $this->db->select("a.s_id");
        $this->db->from("tb_service a");
        $this->db->where($condition);
        $query = $this->db->get();
        $total_Re_s=$query->num_rows();
        
        //LIST
        $this->db->select("a.*, b.st_name");
        $this->db->from("tb_service a");
        $this->db->join("tb_service_type b", "a.s_type = b.st_id", "left");
        $this->db->where($condition);
        $this->db->order_by("a.s_no", "DESC");
  
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

    function getServiceSave($data){
        $date = $this->B_Function_m->dateEng($data['s_sv_date']);
        $s_sv_date = $date." ".$data['s_sv_date_time'];
        $this->db->trans_begin();
        $data1 = array(
            's_status' => $data['s_status'],
            's_sv_us_name' => $data['s_sv_us_name'],
            's_sv_date' => $s_sv_date,
            's_sv_note' => $data['s_sv_note'],
        );
        $this->db->where('s_id', $data['s_id']);
        $this->db->update('tb_service', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกแก้ไขได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y', 'status' => $data['s_status'],'output' => 'บันทึกการดำเนินการเรียบร้อย');
            return $Response;
            exit;
        }
    }

}