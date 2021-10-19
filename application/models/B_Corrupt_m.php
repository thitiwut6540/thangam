<?php
class B_Corrupt_m extends CI_Model {
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

    function getDepart($id){
        $this->db->select("dp_id, dp_name");
        $this->db->from("tb_depart");
        $this->db->where("dp_id", $id);
        $this->db->order_by("dptype_id", "ASC");
        $this->db->order_by("dp_no", "ASC");
        $query1 = $this->db->get();
        $fetch = array(
            'Re_dp'=>$query1->result(),
        );
        return $fetch;
    }

    function getDepartList(){
        $this->db->select("dp_id, dp_name");
        $this->db->from("tb_depart");
        $this->db->order_by("dptype_id", "ASC");
        $this->db->order_by("dp_no", "ASC");
        $query1 = $this->db->get();
        $fetch = array(
            'Re_dp'=>$query1->result(),
        );
        return $fetch;
    }

    function getCorruptDetail($no){
        $this->db->select("*");
        $this->db->from("tb_complain");
        $this->db->where("c_no", $no);
        $this->db->where("c_cata", 'C');
        $query = $this->db->get();
        $total_Re1=$query->num_rows();

        $this->db->select("a.*, b.c_id, b.c_status, c.dp_name");
        $this->db->from("tb_complain_action a");
        $this->db->join("tb_complain b", "a.c_no = b.c_no", "left");
        $this->db->join("tb_depart c", "a.dp_id = c.dp_id", "left");
        $this->db->where("a.c_no", $no);
        $this->db->where("b.c_cata", 'C');
        $this->db->order_by("a.ca_id", 'ASC');
        $query1 = $this->db->get();
        $total_Re2=$query1->num_rows();

        $fetch = array(
            'total_Re_c'=>$total_Re1,
            'Re_c'=>$query->result(),
            'total_Re_ca'=>$total_Re2,
            'Re_ca'=>$query1->result(),
        );
        return $fetch;
    }

    function getAction($id){
        $this->db->select("a.*, c.dp_name");
        $this->db->from("tb_complain_action a");
        $this->db->join("tb_complain b", "a.c_no = b.c_no", "left");
        $this->db->join("tb_depart c", "a.dp_id = c.dp_id", "left");
        $this->db->where("a.ca_id", $id);
        $this->db->where("b.c_cata", 'C');
        $query1 = $this->db->get();
        $fetch = array(
            'Re_ca'=>$query1->result(),
        );
        return $fetch;
    }

    function getCorruptList($limit, $offset, $search, $count){

        $c_status = $search['c_status'];
        $condition="a.c_cata='C' AND a.c_status ='".$c_status."' ";
        if($search){
            if(!empty($search['c_title'])){
                $condition.="AND a.c_title LINK '%".$search['c_title']."' ";
            }
            if(!empty($search['c_cus_name'])){
                $condition.="AND a.c_cus_name LINK '%".$search['c_cus_name']."' ";
            }
        } 

        $this->db->select("a.c_id");
        $this->db->from("tb_complain a");
        $this->db->where($condition);
        $query = $this->db->get();
        $total_Re_c=$query->num_rows();
        
        //LIST
        $this->db->select("a.*, b.ct_name");
        $this->db->from("tb_complain a");
        $this->db->join("tb_complain_type b", "a.c_type = b.ct_id", "left");
        $this->db->where($condition);
        $this->db->order_by("a.c_no", "DESC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_c'=>$total_Re_c,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_c'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_c'=>$total_Re_c,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_c'=>$query2->result(),
        );
        return $fetch;
    }

    function getNewSave($data){
        $status = $data['c_status'];
        $date = $this->B_Function_m->dateEng($data['ca_date']);
        $ca_date = $date." ".$data['ca_date_time'];
        $this->db->trans_begin();
        $data1 = array(
            'ca_id' => NULL,
            'c_no' => $data['c_no'],
            'dp_id' => NULL,
            'ca_status' => $status,
            'ca_date' => $ca_date,
            'ca_comment' => $data['ca_comment'],
            'ca_public' => $data['ca_public'],
            'ca_receive' => $data['ca_receive'],
            'ca_dp_id' => $data['ca_dp_id'],
            'ca_photo1' => NULL,
            'ca_photo2' => NULL,
        );
        $this->db->insert('tb_complain_action', $data1);

        $data2 = array(
            'c_status' => $status,
        );
        $this->db->where('c_id', $this->input->POST('c_id'));
        $this->db->update('tb_complain', $data2);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกการดำเนินการได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','status' => $status, 'output' => 'บันทึกการดำเนินการเรียบร้อย');
            return $Response;
            exit;
        }
    }

    function getApproveEditSave($data){
        $date = $this->B_Function_m->dateEng($data['ca_date']);
        $ca_date = $date." ".$data['ca_date_time'];
        $this->db->trans_begin();
        $data1 = array(
            'ca_date' => $ca_date,
            'ca_comment' => $data['ca_comment'],
            'ca_public' => $data['ca_public'],
            'ca_receive' => $data['ca_receive'],
            'ca_dp_id' => $data['ca_dp_id'],
            'ca_photo1' => NULL,
            'ca_photo2' => NULL,
        );
        $this->db->where('ca_id', $data['ca_id']);
        $this->db->update('tb_complain_action', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกแก้ไขได้กรุณาตรวจสอบ');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'บันทึกแก้ไขเรียบร้อย');
            echo json_encode($Response);
            exit;
        }
    }

    function getApproveSave($data,$photoName1,$photoName2){
        $status = $data['c_status'];
        $date = $this->B_Function_m->dateEng($data['ca_date']);
        $ca_date = $date." ".$data['ca_date_time'];
        $this->db->trans_begin();
            $data1 = array(
                'ca_id' => NULL,
                'c_no' => $data['c_no'],
                'dp_id' => $data['dp_id'],
                'ca_status' => $status,
                'ca_date' => $ca_date,
                'ca_comment' => $data['ca_comment'],
                'ca_public' => $data['ca_public'],
                'ca_receive' => $data['ca_receive'],
                'ca_dp_id' => $data['ca_dp_id'],
                'ca_photo1' => $photoName1,
                'ca_photo2' => $photoName2,
            );
            $this->db->insert('tb_complain_action', $data1);

            $data2 = array(
                'c_status' => $status,
            );
            $this->db->where('c_id', $data['c_id']);
            $this->db->update('tb_complain', $data2);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกการดำเนินการได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','status' => $status, 'output' => 'บันทึกการดำเนินการเรียบร้อย');
            return $Response;
            exit;
        }
    }

    function getWorkingEditSave($data,$photoName1,$photoName2){
        $date = $this->B_Function_m->dateEng($data['ca_date']);
        $ca_date = $date." ".$data['ca_date_time'];
        $this->db->trans_begin();
            $data1 = array(
                'dp_id' => $data['dp_id'],
                'ca_date' => $ca_date,
                'ca_comment' => $data['ca_comment'],
                'ca_public' => $data['ca_public'],
                'ca_receive' => $data['ca_receive'],
                'ca_dp_id' => $data['ca_dp_id'],
                'ca_photo1' => $photoName1,
                'ca_photo2' => $photoName2,
            );
            $this->db->where('ca_id', $data['ca_id']);
            $this->db->update('tb_complain_action', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกแก้ไขได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'บันทึกแก้ไขเรียบร้อย');
            return $Response;
            exit;
        }
    }

    function getWorkingSave($data,$photoName1,$photoName2){
        $status = $data['c_status'];
        $date = $this->B_Function_m->dateEng($data['ca_date']);
        $ca_date = $date." ".$data['ca_date_time'];
        $this->db->trans_begin();
            $data1 = array(
                'ca_id' => NULL,
                'c_no' => $data['c_no'],
                'dp_id' => $data['dp_id'],
                'ca_status' => $status,
                'ca_date' => $ca_date,
                'ca_comment' => $data['ca_comment'],
                'ca_public' => $data['ca_public'],
                'ca_receive' => $data['ca_receive'],
                'ca_dp_id' => $data['ca_dp_id'],
                'ca_photo1' => $photoName1,
                'ca_photo2' => $photoName2,
            );
            $this->db->insert('tb_complain_action', $data1);

            $data2 = array(
                'c_status' => $status,
            );
            $this->db->where('c_id', $data['c_id']);
            $this->db->update('tb_complain', $data2);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกการดำเนินการได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','status' => $status, 'output' => 'บันทึกการดำเนินการเรียบร้อย');
            return $Response;
            exit;
        }
    }

    function getSuccessEditSave($data,$photoName1,$photoName2){
        $date = $this->B_Function_m->dateEng($data['ca_date']);
        $ca_date = $date." ".$data['ca_date_time'];
        $this->db->trans_begin();
            $data1 = array(
                'dp_id' => $data['dp_id'],
                'ca_date' => $ca_date,
                'ca_comment' => $data['ca_comment'],
                'ca_public' => $data['ca_public'],
                'ca_receive' => $data['ca_receive'],
                'ca_dp_id' => $data['ca_dp_id'],
                'ca_photo1' => $photoName1,
                'ca_photo2' => $photoName2,
            );
            $this->db->where('ca_id', $data['ca_id']);
            $this->db->update('tb_complain_action', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกแก้ไขได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'บันทึกแก้ไขเรียบร้อย');
            return $Response;
            exit;
        }
    }

}