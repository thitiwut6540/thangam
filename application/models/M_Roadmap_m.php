<?php
class M_Roadmap_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getRmTypeID($name){
        $this->db->select("rm_t_id");
        $this->db->from("tb_roadmap_type");
        $this->db->where("rm_t_name", $name);
        $query = $this->db->get();
        $total_Re_dp=$query->num_rows();
        foreach ($query->result() as $row);

        if($total_Re_dp>0){
            $id = $row->rm_t_id ;
        }else{
            $id='';
        }
        return $id;
    }

    function getRmList($limit, $offset, $search, $count){

        if($search){
            $rm_t_id = $search['rm_t_id'];
        }
        $condition="a.rm_id > 0 AND a.rm_approve='Y' AND a.rm_status='Y' ";
        $condition.="AND a.rm_t_id = ".$rm_t_id." ";

        $this->db->select("a.rm_id");
        $this->db->from("tb_roadmap a");
        $this->db->join("tb_roadmap_type b", "a.rm_t_id = b.rm_t_id", "left");
        $this->db->where($condition);
        $this->db->order_by("a.rm_id", "DESC");
        $query = $this->db->get();
        $total_Re_rm=$query->num_rows();

        $this->db->select("a.*, b.rm_t_name");
        $this->db->from("tb_roadmap a");
        $this->db->join("tb_roadmap_type b", "a.rm_t_id = b.rm_t_id", "left");
        $this->db->where($condition);
        $this->db->order_by("a.rm_id", "DESC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_rm'=>$total_Re_rm,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_rm'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_rm'=>$total_Re_rm,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_rm'=>$query2->result(),
        );
        return $fetch;
    }

    function getRm($id){

        $this->db->select("a.*, b.rm_t_name");
        $this->db->from("tb_roadmap a");
        $this->db->join("tb_roadmap_type b", "a.rm_t_id = b.rm_t_id", "left");
        $this->db->where('a.rm_id',$id);
        $this->db->where('a.rm_approve','Y');
        $this->db->where('a.rm_status','Y');
        $query = $this->db->get();
        $total_Re_rm=$query->num_rows();

        $this->db->select("*");
        $this->db->from("tb_roadmap_file");
        $this->db->where('rm_id',$id);
        $this->db->order_by("rm_f_id", "ASC");
        $query2 = $this->db->get();
        $total_Re_rmf=$query->num_rows();

        $fetch = array(
            'total_Re_rm'=>$total_Re_rm,
            'Re_rm'=>$query->result(),

            'total_Re_rmf'=>$total_Re_rmf,
            'Re_rmf'=>$query2->result(),
        );
        return $fetch;
    }


}