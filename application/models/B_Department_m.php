<?php
class B_Department_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getType($name){
        $this->db->select("*");
        $this->db->from("tb_depart_type");
        $this->db->where("dptype_name", $name);
        $query1 = $this->db->get();
        foreach ($query1->result() as $row);
        $id = $row->dptype_id;
        return $id;
    }


    function getList($dptype){

        $this->db->select("*");
        $this->db->from("tb_depart a");
        $this->db->join("tb_depart_type b", "a.dptype_id = b.dptype_id", "left");
        $this->db->where("a.dptype_id", $dptype);
        $this->db->order_by("dp_no", "ASC");
        $query1 = $this->db->get();
        $total_Re_dp=$query1->num_rows();

        $this->db->select_max('dp_no', 'dp_max');
        $this->db->select_min('dp_no', 'dp_min');
        $this->db->from("tb_depart");
        $this->db->where("dptype_id", $dptype);
        $query2 = $this->db->get();
        $total_Re_m=$query2->num_rows();

        $fetch = array(
            'total_Re_dp'=>$total_Re_dp,
            'Re_dp'=>$query1->result(),
            'total_Re_m'=>$total_Re_m,
            'Re_m'=>$query2->result(),
        );
        return $fetch;
    }

    function getEdit($id){
        $this->db->select("*");
        $this->db->from("tb_depart");
        $this->db->where("dp_id", $id);
        $query1 = $this->db->get();
        $total_Re_dp=$query1->num_rows();

        $fetch = array(
            'total_Re_dp'=>$total_Re_dp,
            'Re_dp'=>$query1->result(),
        );
        return $fetch;
    }

    
    function getInsertSave($data,$photoName){

        $this->db->select_max('dp_no', 'no_max');
        $this->db->from("tb_depart");
        $this->db->where("dptype_id", $data['dptype_id']);
        $query1 = $this->db->get();
        foreach ($query1->result() as $row);
        if($row->no_max==0){$dp_no=1;}
        else{$dp_no=$row->no_max+1;}
        
        $this->db->trans_begin();
            $data1 = array(
                'dp_id' => NULL,
                'dptype_id' => $data['dptype_id'],
                'dp_no' => $dp_no,
                'dp_name' => $data['dp_name'],
                'dp_add' => $data['dp_add'],
                'dp_tel' => $data['dp_tel'],
                'dp_fax' => $data['dp_fax'],
                'dp_detail' => $data['dp_detail'],
                'dp_photo' => $photoName,
            );
            $this->db->insert('tb_depart', $data1);

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
            $data1 = array(
                'dp_name' => $data['dp_name'],
                'dp_add' => $data['dp_add'],
                'dp_tel' => $data['dp_tel'],
                'dp_fax' => $data['dp_fax'],
                'dp_detail' => $data['dp_detail'],
                'dp_photo' => $photoName,
            );
            $this->db->where('dp_id', $data['dp_id']);
            $this->db->update('tb_depart', $data1);

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