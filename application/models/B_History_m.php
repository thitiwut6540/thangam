<?php
class B_History_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getList($type){
        $this->db->select("*");
        $this->db->from("tb_history");
        $this->db->where('h_type',$type);
        $this->db->order_by("h_no", "ASC");
        $query1 = $this->db->get();
        $total_Re_h=$query1->num_rows();
        
        $this->db->select("MIN(h_no) AS h_min, MAX(h_no) AS h_max");
        $this->db->from("tb_history");
        $this->db->where('h_type',$type);
        $query2 = $this->db->get();

        $fetch = array(
            'total_Re_h'=>$total_Re_h,
            'Re_h'=>$query1->result(),
            'Re_mimx'=>$query2->result(),
        );
        return $fetch;
    }

    function getEdit($id){
        $this->db->select("*");
        $this->db->from("tb_history");
        $this->db->where('h_id',$id);
        $query1 = $this->db->get();
        $total_Re_h=$query1->num_rows();

        $fetch = array(
            'total_Re_h'=>$total_Re_h,
            'Re_h'=>$query1->result(),
        );
        return $fetch;
    }

    function getInsertSave($data,$photoName){
        $this->db->select_max('h_no', 'no_max');
        $this->db->from("tb_history");
        $this->db->where("h_type", $data['h_type']);
        $query1 = $this->db->get();

        foreach ($query1->result() as $row);
        if($row->no_max==0){$h_no=1;}
        else{$h_no=$row->no_max+1;}

        $this->db->trans_begin();
            $d1 = array(
                'h_id' => NULL, 
                'h_type' => $data['h_type'], 
                'h_no' => $h_no, 
                'h_name' => $data['h_name'], 
                'h_position' => $data['h_position'], 
                'h_term' => $data['h_term'], 
                'h_start' => $this->B_Function_m->dateEng($data['h_start']), 
                'h_end' => $this->B_Function_m->dateEng($data['h_end']), 
                'h_term' => $data['h_term'], 
                'h_photo' => $photoName
            );
            $this->db->insert('tb_history', $d1);

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

    function getEditSave($data,$photoName){
        $this->db->trans_begin();
            $d1 = array(
                'h_name' => $data['h_name'], 
                'h_position' => $data['h_position'], 
                'h_term' => $data['h_term'], 
                'h_start' => $this->B_Function_m->dateEng($data['h_start']), 
                'h_end' => $this->B_Function_m->dateEng($data['h_end']), 
                'h_term' => $data['h_term'], 
                'h_photo' => $photoName
            );
            $this->db->where('h_id', $data['h_id']);
            $this->db->update('tb_history', $d1);

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

}