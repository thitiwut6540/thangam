<?php
class M_Gallery_m extends CI_Model {
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

    function getGalleryList($limit, $offset, $search, $count){

        if($search){
            $dp_id = $search['dp_id'];
        }
        $condition="a.gal_id > 0 AND a.gal_approve='Y' ";
        if(!empty($dp_id)){
            $condition.="AND a.dp_id = ".$dp_id." ";
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
            $query = $this->db->get();
            $page_total=$query->num_rows();
			if($query->num_rows() > 0) {
                $fetch = array(
                    'total_Re_g'=>$total_Re_g,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_g'=>$query->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_g'=>$total_Re_g,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_g'=>$query->result(),
        );
        return $fetch;
    }

    function getGallery($id){

        $this->db->select("a.*, b.dp_name");
        $this->db->from("tb_gal a");
        $this->db->join("tb_depart b", "a.dp_id = b.dp_id", "left");
        $this->db->where("a.gal_id", $id);
        $this->db->where("a.gal_approve", 'Y');
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

    function getLightbox($g_id, $p_id){
        $this->db->select("*");
        $this->db->from("tb_galp");
        $this->db->where("gal_id", $g_id);
        $this->db->where("galp_id", $p_id);
        $this->db->order_by("galp_id", "DESC");
        $query = $this->db->get();
  
        $fetch = array(
            'Re_lb'=>$query->result(),
        );
        return $fetch;
    }

    function getLightboxPhoto($id){
        $this->db->select("*");
        $this->db->from("tb_galp");
        $this->db->where("gal_id", $id);
        $query = $this->db->get();
        $total_Re_max=$query->num_rows();
  
        $fetch = array(
            'Re_lb'=>$query->result(),
            'total_Re_max'=>$total_Re_max,
        );
        return $fetch;
    }
}