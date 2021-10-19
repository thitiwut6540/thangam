<?php
class B_Member_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getTypeID($name){
        $this->db->select("memtype_id");
        $this->db->from("tb_member_type");
        $this->db->where("memtype_name", $name);
        $query1 = $this->db->get();
        foreach ($query1->result() as $row);
        $id = $row->memtype_id;
        return $id;
    }

    function getDPID($name){
        $this->db->select("dp_id");
        $this->db->from("tb_depart");
        $this->db->where("dp_name", $name);
        $query1 = $this->db->get();
        foreach ($query1->result() as $row);
        $id = $row->dp_id;
        return $id;
    }

    function getDepart($id){
        $this->db->select("dp_id,dp_name");
        $this->db->from("tb_depart");
        $this->db->where("dptype_id", $id);
        $this->db->order_by("dp_no", "ASC");
        $query1 = $this->db->get();
        $fetch = array(
            'total_Re_d'=>$query1->num_rows(),
            'Re_d'=>$query1->result(),
        );
        return $fetch;
    }

    function getGroup($group, $type, $depart){

        $condition='a.memtype_id = '.$type.' AND a.mem_group = '.$group.' ';
        if($depart!=''){
            $condition.='AND a.dp_id = '.$depart.'';
        }

        $this->db->select("a.*,b.position_name, c.dp_name, d.memtype_name");
        $this->db->from("tb_member a");
        $this->db->join("tb_position b", "a.position_id = b.position_id", "left");
        $this->db->join("tb_depart c", "a.dp_id = c.dp_id", "left");
        $this->db->join("tb_member_type d", "a.memtype_id = d.memtype_id", "left");
        $this->db->where($condition);
        $this->db->order_by("a.mem_no", "ASC");
        $query1 = $this->db->get();
        $total_Re_m=$query1->num_rows();

        $this->db->select("MIN(a.mem_no) AS mem_min, MAX(a.mem_no) AS mem_max");
        $this->db->from("tb_member a");
        $this->db->where($condition);
        $query2 = $this->db->get();

        $fetch = array(
            'total_Re_m'=>$total_Re_m,
            'Re_m'=>$query1->result(),
            'Re_mimx'=>$query2->result(),
            'type_id'=> $type,
            'depart_id'=> $depart,
        );
        return $fetch;
    }

    function getEdit($id){

        $this->db->select("a.*,b.position_name, c.dp_name, d.memtype_name");
        $this->db->from("tb_member a");
        $this->db->join("tb_position b", "a.position_id = b.position_id", "left");
        $this->db->join("tb_depart c", "a.dp_id = c.dp_id", "left");
        $this->db->join("tb_member_type d", "a.memtype_id = d.memtype_id", "left");
        $this->db->where('mem_id',$id);
        $query1 = $this->db->get();
        $total_Re_m=$query1->num_rows();

        $fetch = array(
            'total_Re_m'=>$total_Re_m,
            'Re_m'=>$query1->result(),
        );
        return $fetch;
    }

    function getInsertSave($data,$photoName){

        $user=$data['mem_user'];
        $p=$data['mem_pass'];
        $pass = password_hash($p, PASSWORD_DEFAULT);

        $chk ="SELECT mem_id FROM tb_member WHERE mem_user = '$user' ";
        $Re_chk = $this->db->query($chk);
        $total_Re_chk=$Re_chk->num_rows();
        if($total_Re_chk>0){
            $Response = array('action' => 'D','output' => 'USERNAME : '.$user.' มีในระบบแล้ว');
            echo json_encode($Response);
            exit;
        }else{

            $this->db->select_max('mem_no', 'no_max');
            $this->db->from("tb_member");
            $this->db->where("memtype_id", $data['memtype_id']);
            if($data['memtype_id']=='3'){
                $this->db->where("dp_id", $data['dp_id']);
            }

            $query1 = $this->db->get();
            foreach ($query1->result() as $row);
            if($row->no_max==0){$mem_no=1;}
            else{$mem_no=$row->no_max+1;}
            
            $this->db->trans_begin();
                $data1 = array(
                    'mem_id' => NULL,
                    'mem_president' => $data['mem_president'], 
                    'memtype_id' => $data['memtype_id'], 
                    'dp_id' => $data['dp_id'], 
                    'mem_group' => $data['mem_group'], 
                    'mem_no' => $mem_no, 
                    'mem_name' => $data['mem_name'], 
                    'mem_position' => $data['mem_position'],  
                    'mem_tel' => $data['mem_tel'], 
                    'mem_mobile' => $data['mem_mobile'], 
                    'mem_email' => $data['mem_email'],
                    'mem_user' => $data['mem_user'],
                    'mem_pass' => $pass,
                    'mem_photo' => $photoName,
                    'mem_counter' => NULL, 
                    'mem_logindate' => NULL,
                    'mem_regdate' => date('Y-m-d H:i:s'), 
                    'position_id' => NULL,
                );
                $this->db->insert('tb_member', $data1);
    
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

    function getEditSave($data,$photoName){

        $mem_id=$data['mem_id'];
        $user=$data['mem_user'];
        $p=$data['mem_pass'];
        if(!empty($p)){
            $pass = $data['h_mem_pass'];
        }else{
            $pass = password_hash($p, PASSWORD_DEFAULT);
        }
        
        $chk ="SELECT mem_id FROM tb_member WHERE mem_id != '$mem_id' AND mem_user = '$user' ";
        $Re_chk = $this->db->query($chk);
        $total_Re_chk=$Re_chk->num_rows();
        if(!empty($data['mem_user']) AND $total_Re_chk>0){
            $Response = array('action' => 'D','output' => 'USERNAME : '.$user.' มีในระบบแล้ว');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_begin();
                $data1 = array(
                    'mem_president' => $data['mem_president'], 
                    'mem_group' => $data['mem_group'], 
                    'mem_name' => $data['mem_name'], 
                    'mem_position' => $data['mem_position'],  
                    'mem_tel' => $data['mem_tel'], 
                    'mem_mobile' => $data['mem_mobile'], 
                    'mem_email' => $data['mem_email'],
                    'mem_user' => $data['mem_user'],
                    'mem_pass' => $pass,
                    'mem_photo' => $photoName,
                    'mem_regdate' => date('Y-m-d H:i:s'), 
                    'position_id' => '',
                );
                $this->db->where('mem_id', $mem_id);
                $this->db->update('tb_member', $data1);
    
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

}