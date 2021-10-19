<?php
class B_Content_m extends CI_Model {
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

    function getDepart(){
        $this->db->select("*");
        $this->db->from("tb_depart");
        $this->db->order_by("dp_id", "ASC");
        $query1 = $this->db->get();
        $total_ReD=$query1->num_rows();

        $fetch = array(
            'total_ReD'=>$total_ReD,
            'ReD'=>$query1->result(),
        );
        return $fetch;
    }

    function getContentType(){
        $this->db->select("*");
        $this->db->from("tb_content_type");
        $this->db->order_by("con_type_id", "DESC");
        $query = $this->db->get();
        $total_Re_ct=$query->num_rows();

        $fetch = array(
            'total_Re_ct'=>$total_Re_ct,
            'Re_ct'=>$query->result(),
        );
        return $fetch;
    }

    function getTypeList($limit, $offset, $search, $count){
        //total
        $this->db->select("a.*, b.dp_name");
        $this->db->from("tb_content_type a");
        $this->db->join("tb_depart b", "a.dp_id = b.dp_id", "left");
        $this->db->order_by("a.con_type_id", "DESC");
        $query1 = $this->db->get();
        $total_Re_c=$query1->num_rows();

        //LIST
        $this->db->select("a.*, b.dp_name");
        $this->db->from("tb_content_type a");
        $this->db->join("tb_depart b", "a.dp_id = b.dp_id", "left");
        $this->db->order_by("a.con_type_id", "DESC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query = $this->db->get();
            $page_total=$query->num_rows();
			if($query->num_rows() > 0) {
                $fetch = array(
                    'total_Re_c'=>$total_Re_c,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_c'=>$query->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_c'=>$total_Re_c,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_c'=>$query->result(),
        );
        return $fetch;
    }

    function getList($limit, $offset, $search, $count){
        //chk
        $this->db->select("*");
        $this->db->from("tb_depart");
        $this->db->where("dp_name !=", "");
        $this->db->like("dp_name", $search);
        $query2 = $this->db->get();
        $total_Re_gal=$query2->num_rows();
        foreach ($query2->result() as $row);
        $id = $row->dp_id;

        //total
        $this->db->select("a.*, b.con_type_name");
        $this->db->from("tb_content a");
        $this->db->join("tb_content_type b", "a.con_type_id = b.con_type_id", "left");
        $this->db->where("a.dp_id", $id);
        $this->db->order_by("a.con_date", "DESC");
        $query1 = $this->db->get();
        $total_Re_c=$query1->num_rows();

        //LIST
        $this->db->select("a.*, b.con_type_name");
        $this->db->from("tb_content a");
        $this->db->join("tb_content_type b", "a.con_type_id = b.con_type_id", "left");
        $this->db->where("a.dp_id", $id);
        $this->db->order_by("a.con_date", "DESC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query = $this->db->get();
            $page_total=$query->num_rows();
			if($query->num_rows() > 0) {
                $fetch = array(
                    'total_Re_c'=>$total_Re_c,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_c'=>$query->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_c'=>$total_Re_c,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_c'=>$query->result(),
        );
        return $fetch;
    }

    function getEdit($con_id){
        $this->db->select("a.*, b.con_type_name, c.con_l_link, d.con_f_name");
        $this->db->from("tb_content a");
        $this->db->join("tb_content_type b", "a.con_type_id = b.con_type_id", "left");
        $this->db->join("tb_content_link c", "a.con_id = c.con_id", "left");
        $this->db->join("tb_content_file d", "a.con_id = d.con_id", "left");
        $this->db->where("a.con_id", $con_id);
        $query1 = $this->db->get();
        $total_Re_ed=$query1->num_rows();

        $this->db->select("*");
        $this->db->from("tb_content_file");
        $this->db->where("con_id", $con_id);
        $this->db->order_by("con_f_id", "DESC");
        $query2 = $this->db->get();
        $total_Re_f=$query2->num_rows();

        $fetch = array(
            'total_Re_ed'=>$total_Re_ed,
            'total_Re_f'=>$total_Re_f,
            'Re_ed'=>$query1->result(),
            'Re_f'=>$query2->result(),
        );
        return $fetch;
    }


}