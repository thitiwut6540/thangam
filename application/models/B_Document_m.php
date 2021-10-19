<?php
class B_Document_m extends CI_Model {
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

    function getDTM(){
        $this->db->select("*");
        $this->db->from("tb_document_type");
        $this->db->order_by("dt_id",'ASC');
        $query = $this->db->get();
        $fetch = array(
            'Re_dtm'=>$query->result(),
        );
        return $fetch;
    }

    function getDP(){
        $this->db->select("*");
        $this->db->from("tb_depart");
        $this->db->order_by("dptype_id",'ASC');
        $this->db->order_by("dp_no",'ASC');
        $query = $this->db->get();
        $fetch = array(
            'Re_dp'=>$query->result(),
        );
        return $fetch;
    }

    function getTypeByName($name){
        $this->db->select("*");
        $this->db->from("tb_document_type");
        $this->db->where("dt_name",$name);
        $query1 = $this->db->get();
        foreach ($query1->result() as $row);
        $id = $row->dt_id;
        return $id;
    }

    function getTypeList(){
        $this->db->select("*");
        $this->db->from("tb_document_type");
        $this->db->order_by("dt_id", "ASC");
        $query1 = $this->db->get();
        $total_Re_dt=$query1->num_rows();

        $fetch = array(
            'total_Re_dt'=>$total_Re_dt,
            'Re_dt'=>$query1->result(),
        );
        return $fetch;
    }

    function getTypeEdit($id){
        $this->db->select("*");
        $this->db->from("tb_document_type");
        $this->db->where("dt_id", $id);
        $query1 = $this->db->get();
        $total_Re_dt=$query1->num_rows();

        $fetch = array(
            'total_Re_dt'=>$total_Re_dt,
            'Re_dt'=>$query1->result(),
        );
        return $fetch;
    }

    function getTypeInsertSave($data){
        
        $this->db->trans_begin();
            $data1 = array(
                'dt_id' => NULL,
                'dt_name' => $data['dt_name'],
            );
            $this->db->insert('tb_document_type', $data1);

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
                'dt_name' => $data['dt_name'],
            );
            $this->db->where('dt_id', $data['dt_id']);
            $this->db->update('tb_document_type', $data1);


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

    function getDcList($limit, $offset, $search, $count){

        $dt_id=$search['type_id'];
        $condition="a.d_id !='' AND a.dt_id='".$dt_id."' ";
        if($search){
            if(!empty($search['dp_id'])){
                $condition.="AND a.dp_id = ".$search['dp_id']." ";
            }
            if(!empty($search['d_name'])){
                $condition.="AND a.d_name LINK '%".$search['d_name']."' ";
            }
        } 

        $this->db->select("a.d_id");
        $this->db->from("tb_document a");
        $this->db->where($condition);
        $this->db->order_by("a.d_id", "DESC");
        $query = $this->db->get();
        $total_Re_d=$query->num_rows();

        $this->db->select("a.*, b.dt_name, b.dt_id, c.dp_name");
        $this->db->from("tb_document a");
        $this->db->join("tb_document_type b", "a.dt_id = b.dt_id", "left");
        $this->db->join("tb_depart c", "a.dp_id = c.dp_id", "left");
        $this->db->where($condition);
        $this->db->order_by("a.d_id", "DESC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_d'=>$total_Re_d,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_d'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_d'=>$total_Re_d,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_d'=>$query2->result(),
        );
        return $fetch;

    }

    function getDcEdit($id){
        $this->db->select("a.*, b.dt_name, b.dt_id, c.dp_name");
        $this->db->from("tb_document a");
        $this->db->join("tb_document_type b", "a.dt_id = b.dt_id", "left");
        $this->db->join("tb_depart c", "a.dp_id = c.dp_id", "left");
        $this->db->where("a.d_id", $id);
        $query1 = $this->db->get();
        $total_Re_d=$query1->num_rows();

        $this->db->select("*");
        $this->db->from("tb_document_file");
        $this->db->where("d_id", $id);
        $query2 = $this->db->get();
        $total_Re_df=$query2->num_rows();

        $fetch = array(
            'total_Re_d'=>$total_Re_d,
            'Re_d'=>$query1->result(),
            'total_Re_df'=>$total_Re_df,
            'Re_df'=>$query2->result(),
        );
        return $fetch;
    }
}