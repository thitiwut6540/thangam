<?php
class B_Gallery_m extends CI_Model {
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

    function getDPID($name){
        $this->db->select("dp_id");
        $this->db->from("tb_depart");
        $this->db->where("dp_name", $name);
        $query1 = $this->db->get();
        foreach ($query1->result() as $row);
        $id = $row->dp_id;
        return $id;
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
        $this->db->select("a.*,b.dptype_name");
        $this->db->from("tb_depart a");
        $this->db->join("tb_depart_type b", "a.dptype_id=b.dptype_id", "left");
        $this->db->order_by("a.dptype_id",'ASC');
        $this->db->order_by("a.dp_no",'ASC');
        $query = $this->db->get();
        $fetch = array(
            'Re_dp'=>$query->result(),
        );
        return $fetch;
    }

    function getList($limit, $offset, $search, $count){

        $condition="a.gal_id !='' ";
        if($search){
            if(!empty($search['dp_id'])){
                $condition.="AND a.dp_id = ".$search['dp_id']." ";
            }
            if(!empty($search['gal_name'])){
                $condition.="AND a.gal_name LINK '%".$search['gal_name']."' ";
            }
        } 

        $this->db->select("a.gal_id");
        $this->db->from("tb_gal a");
        $this->db->where($condition);
        $this->db->order_by("a.gal_id", "DESC");
        $query = $this->db->get();
        $total_Re_g=$query->num_rows();

        $this->db->select("a.*, b.dp_name, c.sum_galp");
        $this->db->from("tb_gal a");
        $this->db->join("tb_depart b", "a.dp_id = b.dp_id", "left");
        $this->db->join("(SELECT gal_id, COUNT(galp_id) AS sum_galp FROM tb_galp GROUP BY gal_id) c", "a.gal_id = c.gal_id", "left");
        $this->db->where($condition);
        $this->db->order_by("a.gal_id", "DESC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
            
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'total_Re_g'=>$total_Re_g,
                    'Re_g'=>$query2->result(),
                );
                
                return $fetch;
			}
		}
        $fetch = array(
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'total_Re_g'=>$total_Re_g,
            'Re_g'=>$query2->result(),
        );
        return $fetch;
    }

    function getEdit($id){

        $this->db->select("*");
        $this->db->from("tb_gal");
        $this->db->where("gal_id", $id);
        $query1 = $this->db->get();
        $total_Re_g=$query1->num_rows();

        $this->db->select("*");
        $this->db->from("tb_galp");
        $this->db->where("gal_id", $id);
        $this->db->order_by("gal_id", "DESC");
        $query2 = $this->db->get();
        $total_Re_gp=$query2->num_rows();

            
        $fetch = array(
            'total_Re_g'=>$total_Re_g,
            'Re_g'=>$query1->result(),
            'total_Re_gp'=>$total_Re_gp,
            'Re_gp'=>$query2->result(),
        );
        return $fetch;
    }
}