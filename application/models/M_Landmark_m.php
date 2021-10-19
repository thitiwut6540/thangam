<?php
class M_Landmark_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getTypeList(){
        $this->db->select("*");
        $this->db->from("tb_landmark_type");
        $this->db->order_by("land_t_no", "ASC");
        $query1 = $this->db->get();
        $fetch = array(
            'total_Re_lt'=>$query1->num_rows(),
            'Re_lt'=>$query1->result(),
        );
        return $fetch;
    }

    function getLandList($limit, $offset, $search, $count){
        if($search){
            $land_t_id = $search['land_t_id'];
        }
        $condition="a.land_id > 0 ";
        if(!empty($land_t_id)){
            $condition.="AND a.land_t_id = ".$land_t_id." ";
        }

        $this->db->select("a.land_id");
        $this->db->from("tb_landmark a");
        $this->db->join('tb_landmark_type b', 'b.land_t_id = a.land_t_id', 'left');
        $this->db->where($condition);
        $this->db->order_by("b.land_t_no", "ASC");
        $this->db->order_by("a.land_id", "ASC");
        $query1 = $this->db->get();
        $total_Re_l=$query1->num_rows();

        $this->db->select("a.*,b.land_t_name");
        $this->db->from("tb_landmark a");
        $this->db->join('tb_landmark_type b', 'b.land_t_id = a.land_t_id', 'left');
        $this->db->where($condition);
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
                    'total_Re_l'=>$total_Re_l,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_l'=>$query->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_l'=>$total_Re_l,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_l'=>$query->result(),
        );
        return $fetch;
    }

    function getLand($id){
        $this->db->select("a.*");
        $this->db->from("tb_landmark a");
        $this->db->join('tb_landmark_type b', 'b.land_t_id = a.land_t_id', 'left');
        $this->db->where("land_id", $id);
        $query1 = $this->db->get();
        $total_Re_l=$query1->num_rows();

        $fetch = array(
            'Re_l'=>$query1->result(),
        );
        return $fetch;
    }
}