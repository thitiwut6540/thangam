<?php
class B_File_m extends CI_Model {
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
        $this->db->from("tb_depart");
        $this->db->order_by("dp_id", "ASC");
        $query1 = $this->db->get();
        $total_Re_flm=$query1->num_rows();

        $fetch = array(
            'total_Re_flm'=>$total_Re_flm,
            'Re_flm'=>$query1->result(),
        );
        return $fetch;
    }

    function getDepart(){
        $this->db->select("*");
        $this->db->from("tb_depart");
        $this->db->order_by("dp_id", "ASC");
        $query1 = $this->db->get();

        $fetch = array(
            'Re_dp'=>$query1->result(),
        );
        return $fetch;
    }

    function getEdit($file_id){
        $this->db->select("*");
        $this->db->from("tb_depart");
        $this->db->order_by("dp_id", "ASC");
        $query1 = $this->db->get();

        //file
        $this->db->select("a.*, b.filelist_name, b.filelist_id");
        $this->db->from("tb_file a");
        $this->db->join("tb_filelist b", "a.file_id = b.file_id", "left");
        $this->db->where("a.file_id", $file_id);
        $query = $this->db->get();

        $fetch = array(
            'Re_fl'=>$query->result(),
            'Re_dp'=>$query1->result(),
        );
        return $fetch;
    }

    function getList($limit, $offset, $search, $count){

        //chk
        $this->db->select("*");
        $this->db->from("tb_depart");
        if($search != 'เอกสารทั้งหมด'){
            $this->db->where("dp_name", $search);
        }
        $this->db->order_by("dp_id", "DESC");
        $query3 = $this->db->get();
        if($search != 'เอกสารทั้งหมด'){
            foreach ($query3->result() as $row);
            $id = $row->dp_id;
        }

        //total
        $this->db->select("a.*, c.dp_name");
        $this->db->from("tb_file a");
        $this->db->join("tb_depart c", "a.dp_id = c.dp_id", "left");
        if($search != 'เอกสารทั้งหมด'){
            $this->db->where("c.dp_id", $id);
        }
        $this->db->order_by("a.file_id", "DESC");
        $query = $this->db->get();
        $total_Re_chk=$query->num_rows();

        //LIST
        $this->db->select("a.*, c.dp_name");
        $this->db->from("tb_file a");
        $this->db->join("tb_depart c", "a.dp_id = c.dp_id", "left");
        if($search != 'เอกสารทั้งหมด'){
            $this->db->where("c.dp_id", $id);
        }
        $this->db->order_by("a.file_id", "DSC");
  
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
                    'Re_fl'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_chk'=>$total_Re_chk,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_fl'=>$query2->result(),
        );
        return $fetch;

    }





}