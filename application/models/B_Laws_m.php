<?php
class B_Laws_m extends CI_Model {
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

    function getMenu(){
        $this->db->select("*");
        $this->db->from("tb_laws_type");
        $this->db->order_by("lt_id", "ASC");
        $query1 = $this->db->get();
        $total_Re_lt_mu=$query1->num_rows();

        $fetch = array(
            'total_Re_lt_mu'=>$total_Re_lt_mu,
            'Re_lt_mu'=>$query1->result(),
        );
        return $fetch;
    }

    function getType(){
        $this->db->select("*");
        $this->db->from("tb_laws_type");
        $this->db->order_by("lt_id", "ASC");
        $query1 = $this->db->get();
        $total_Re_type=$query1->num_rows();

        $fetch = array(
            'total_Re_type'=>$total_Re_type,
            'Re_type'=>$query1->result(),
        );
        return $fetch;
    }

    function getEdit($id){
        $this->db->select("*");
        $this->db->from("tb_laws");
        $this->db->where("l_id", $id);
        $query1 = $this->db->get();
        $total_Re_edit=$query1->num_rows();

        $this->db->select("*");
        $this->db->from("tb_laws_file");
        $this->db->where("l_id", $id);
        $this->db->order_by("lf_id", "DESC");
        $query2 = $this->db->get();
        $total_Re_f=$query1->num_rows();

        $fetch = array(
            'total_Re_edit'=>$total_Re_edit,
            'total_Re_f'=>$total_Re_f,
            'Re_edit'=>$query1->result(),
            'Re_f'=>$query2->result(),
        );
        return $fetch;
    }

    function getList($limit, $offset, $search, $count){

        //chk
        $this->db->select("*");
        $this->db->from("tb_laws_type");
        $this->db->where("lt_name", $search);
        $this->db->order_by("lt_id", "DSC");
        $query3 = $this->db->get();
        foreach ($query3->result() as $row);
        $id = $row->lt_id;

        //total
        $this->db->select("a.*, b.lt_name, b.lt_id");
        $this->db->from("tb_laws a");
        $this->db->join("tb_laws_type b", "a.lt_id = b.lt_id", "left");
        $this->db->where("a.lt_id", $id);
        $this->db->order_by("a.lt_id", "DSC");
        $query = $this->db->get();
        $total_Re_chk=$query->num_rows();

        //LIST
        $this->db->select("a.*, b.lt_name");
        $this->db->from("tb_laws a");
        $this->db->join("tb_laws_type b", "a.lt_id = b.lt_id", "left");
        $this->db->where("a.lt_id", $id);
        $this->db->order_by("a.lt_id", "DSC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_chk'=>$total_Re_chk,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_l'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_chk'=>$total_Re_chk,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_l'=>$query2->result(),
        );
        return $fetch;

    }

    function getTypeList($limit, $offset, $search, $count){

        //total
        $this->db->select("*");
        $this->db->from("tb_laws_type");
        $this->db->order_by("lt_id", "DSC");
        $query = $this->db->get();
        $total_Re_chk=$query->num_rows();

        //LIST
        $this->db->select("*");
        $this->db->from("tb_laws_type");
        $this->db->order_by("lt_id", "DSC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_chk'=>$total_Re_chk,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_lt'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_chk'=>$total_Re_chk,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_lt'=>$query2->result(),
        );
        return $fetch;

    }




}