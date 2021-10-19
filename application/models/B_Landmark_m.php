<?php
class B_Landmark_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    
    function getLT(){
        $this->db->select("*");
        $this->db->from("tb_landmark_type");
        $this->db->order_by("land_t_no", "ASC");
        $query1 = $this->db->get();
        $total_ReLT=$query1->num_rows();

        $fetch = array(
            'total_ReLT'=>$total_ReLT,
            'ReLT'=>$query1->result(),
        );
        return $fetch;
    }

    function getLandEdit($id){
        $this->db->select("*");
        $this->db->from("tb_landmark");
        $this->db->where("land_id", $id);
        $query1 = $this->db->get();
        $total_ReL=$query1->num_rows();

        $fetch = array(
            'Re_l'=>$query1->result(),
        );
        return $fetch;
    }

    function getLand($limit, $offset, $search, $count){


        $this->db->select("a.land_id");
        $this->db->from("tb_landmark a");
        $this->db->join('tb_landmark_type b', 'b.land_t_id = a.land_t_id', 'left');
        $this->db->order_by("b.land_t_no", "ASC");
        $this->db->order_by("a.land_id", "ASC");
        $query1 = $this->db->get();
        $total_ReL=$query1->num_rows();

        $this->db->select("a.*,b.land_t_name");
        $this->db->from("tb_landmark a");
        $this->db->join('tb_landmark_type b', 'b.land_t_id = a.land_t_id', 'left');
        $this->db->order_by("b.land_t_no", "ASC");
        $this->db->order_by("a.land_id", "ASC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query = $this->db->get();
            $page_total=$query->num_rows();
			if($query->num_rows() > 0) {
                $fetch = array(
                    'total_ReL'=>$total_ReL,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'ReL'=>$query->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_ReL'=>$total_ReL,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'ReL'=>$query->result(),
        );
        return $fetch;
    }

    function getLandInsertSave($data,$photoName){
        
        $this->db->trans_begin();
            $data1 = array(
                'land_id' => NULL, 
                'land_t_id' => $data['land_t_id'], 
                'land_name' => $data['land_name'], 
                'land_add' => $data['land_add'], 
                'land_detail' => $data['land_detail'], 
                'land_photo' => $photoName,
                'land_date' => date('Y-m-d H:i:s'), 
            );
            $this->db->insert('tb_landmark', $data1);

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

    function getLandEditSave($data,$photoName){
        $this->db->trans_begin();
            $data1 = array(
                'land_t_id' => $data['land_t_id'], 
                'land_name' => $data['land_name'], 
                'land_add' => $data['land_add'], 
                'land_detail' => $data['land_detail'], 
                'land_photo' => $photoName,
                'land_date' => date('Y-m-d H:i:s'), 
            );
            $this->db->where('land_id', $data['land_id']);
            $this->db->update('tb_landmark', $data1);


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


    function getTypeList(){
        $this->db->select("*");
        $this->db->from("tb_landmark_type");
        $this->db->order_by("land_t_no", "ASC");
        $query1 = $this->db->get();

        $this->db->select_max('land_t_no', 'land_t_max');
        $this->db->select_min('land_t_no', 'land_t_min');
        $this->db->from("tb_landmark_type");
        $query2 = $this->db->get();

        $fetch = array(
            'total_Re_lt'=>$query1->num_rows(),
            'Re_lt'=>$query1->result(),
            'Re_m'=>$query2->result(),
        );
        return $fetch;
    }

    function getTypeEdit($id){
        $this->db->select("*");
        $this->db->from("tb_landmark_type");
        $this->db->where("land_t_id", $id);
        $query1 = $this->db->get();
        $fetch = array(
            'Re_lt'=>$query1->result(),
        );
        return $fetch;
    }


    function getTypeInsertSave($data){

            $this->db->select_max('land_t_no', 'no_max');
            $this->db->from("tb_landmark_type");

            $query1 = $this->db->get();
            foreach ($query1->result() as $row);
            if($row->no_max==0){$land_t_no=1;}
            else{$land_t_no=$row->no_max+1;}
            
            $this->db->trans_begin();
                $data1 = array(
                    'land_t_id' => NULL,
                    'land_t_no' => $land_t_no, 
                    'land_t_name' => $data['land_t_name'], 
                );
                $this->db->insert('tb_landmark_type', $data1);
    
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
                'land_t_name' => $data['land_t_name'], 
            );
            $this->db->where('land_t_id', $data['land_t_id']);
            $this->db->update('tb_landmark_type', $data1);

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


}