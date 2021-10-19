<?php
class M_Performance_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getDepartID($name){
        $this->db->select("dp_id");
        $this->db->from("tb_depart");
        $this->db->where("dp_name", $name);
        $query = $this->db->get();
        $total_Re_dp=$query->num_rows();
        foreach ($query->result() as $row);

        if($total_Re_dp>0){
            $id = $row->dp_id;
        }else{
            $id='';
        }
        return $id;
    }


    function getPrefList($limit, $offset, $search, $count){

        if($search){
            $dp_id = $search['dp_id'];
        }
        $condition="a.pm_id > 0 AND a.pm_approve='Y' AND a.pm_status='Y' ";
        $condition.="AND a.dp_id = ".$dp_id." ";

        $this->db->select("a.pm_id");
        $this->db->from("tb_performance a");
        $this->db->join("tb_depart b", "a.dp_id = b.dp_id", "left");
        $this->db->where($condition);
        $this->db->order_by("a.pm_id", "DESC");
        $query = $this->db->get();
        $total_Re_pm=$query->num_rows();

        $this->db->select("a.*, b.dp_name");
        $this->db->from("tb_performance a");
        $this->db->join("tb_depart b", "a.dp_id = b.dp_id", "left");
        $this->db->where($condition);
        $this->db->order_by("a.pm_id", "DESC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_pm'=>$total_Re_pm,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_pm'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_pm'=>$total_Re_pm,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_pm'=>$query2->result(),
        );
        return $fetch;
    }

    function getPref($id){

        $this->db->select("a.*, b.dp_name");
        $this->db->from("tb_performance a");
        $this->db->join("tb_depart b", "a.dp_id = b.dp_id", "left");
        $this->db->where('a.pm_id',$id);
        $this->db->where('a.pm_approve','Y');
        $this->db->where('a.pm_status','Y');
        $query = $this->db->get();
        $total_Re_pm=$query->num_rows();

        $this->db->select("*");
        $this->db->from("tb_performance_file");
        $this->db->where('pm_id',$id);
        $this->db->order_by("pm_f_id", "ASC");
        $query2 = $this->db->get();
        $total_Re_pmf=$query->num_rows();

        $fetch = array(
            'total_Re_pm'=>$total_Re_pm,
            'Re_pm'=>$query->result(),

            'total_Re_pmf'=>$total_Re_pmf,
            'Re_pmf'=>$query2->result(),
        );
        return $fetch;
    }


}