<?php
class B_Performance_m extends CI_Model {
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

    function getDPT(){
        $this->db->select("*");
        $this->db->from("tb_depart_type");
        $query = $this->db->get();
        $fetch = array(
            'Re_dpt'=>$query->result(),
        );
        return $fetch;
    }

    function getDP($type){
        $this->db->select("*");
        $this->db->from("tb_depart");
        $this->db->where("dptype_id",$type);
        $query = $this->db->get();
        $fetch = array(
            'Re_dp'=>$query->result(),
        );
        return $fetch;
    }

    function getDepart(){
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

    function getDepartByName($name){
        $this->db->select("*");
        $this->db->from("tb_depart");
        $this->db->where("dp_name",$name);
        $query1 = $this->db->get();
        foreach ($query1->result() as $row);
        $id = $row->dp_id;
        return $id;
    }


    function getPmList($limit, $offset, $search, $count){

        $dp_id=$search['dp_id'];
        $condition="a.pm_id !='' AND a.dp_id='".$dp_id."' ";
        if($search){
            if(!empty($search['pm_name'])){
                $condition.="AND a.pm_name LINK '%".$search['pm_name']."' ";
            }
        } 

        $this->db->select("a.pm_id");
        $this->db->from("tb_performance a");
        $this->db->where($condition);
        $this->db->order_by("a.pm_id", "DESC");
        $query = $this->db->get();
        $total_Re_pm=$query->num_rows();

        $this->db->select("a.*, c.dp_name");
        $this->db->from("tb_performance a");
        $this->db->join("tb_depart c", "a.dp_id = c.dp_id", "left");
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

    function getPmEdit($id){
        $this->db->select("a.*, c.dp_name");
        $this->db->from("tb_performance a");
        $this->db->join("tb_depart c", "a.dp_id = c.dp_id", "left");
        $this->db->where("a.pm_id", $id);
        $query1 = $this->db->get();
        $total_Re_pm=$query1->num_rows();

        $this->db->select("*");
        $this->db->from("tb_performance_file");
        $this->db->where("pm_id", $id);
        $query2 = $this->db->get();
        $total_Re_pmf=$query2->num_rows();

        $fetch = array(
            'total_Re_pm'=>$total_Re_pm,
            'Re_pm'=>$query1->result(),
            'total_Re_pmf'=>$total_Re_pmf,
            'Re_pmf'=>$query2->result(),
        );
        return $fetch;
    }
}