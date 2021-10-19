<?php
class M_Statute_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getSttTypeID($name){
        $this->db->select("stt_t_id");
        $this->db->from("tb_statute_type");
        $this->db->where("stt_t_name", $name);
        $query = $this->db->get();
        $total_Re_dp=$query->num_rows();
        foreach ($query->result() as $row);

        if($total_Re_dp>0){
            $id = $row->stt_t_id ;
        }else{
            $id='';
        }
        return $id;
    }

    function getSttList($limit, $offset, $search, $count){

        if($search){
            $stt_t_id = $search['stt_t_id'];
        }
        $condition="a.stt_id > 0 AND a.stt_approve='Y' AND a.stt_status='Y' ";
        $condition.="AND a.stt_t_id = ".$stt_t_id." ";

        $this->db->select("a.*, b.stt_t_name");
        $this->db->from("tb_statute a");
        $this->db->join("tb_statute_type b", "a.stt_t_id = b.stt_t_id", "left");
        $this->db->where($condition);
        $this->db->order_by("a.stt_id", "DESC");
        $query = $this->db->get();
        $total_Re_stt=$query->num_rows();

        $this->db->select("a.*, b.stt_t_name");
        $this->db->from("tb_statute a");
        $this->db->join("tb_statute_type b", "a.stt_t_id = b.stt_t_id", "left");
        $this->db->where($condition);
        $this->db->order_by("a.stt_id", "DESC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_stt'=>$total_Re_stt,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_stt'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_stt'=>$total_Re_stt,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_stt'=>$query2->result(),
        );
        return $fetch;
    }

    function getStt($id){

        $this->db->select("a.*, b.stt_t_name");
        $this->db->from("tb_statute a");
        $this->db->join("tb_statute_type b", "a.stt_t_id = b.stt_t_id", "left");
        $this->db->where('a.stt_id',$id);
        $this->db->where('a.stt_approve','Y');
        $this->db->where('a.stt_status','Y');
        $query = $this->db->get();
        $total_Re_stt=$query->num_rows();

        $this->db->select("*");
        $this->db->from("tb_statute_file");
        $this->db->where('stt_id',$id);
        $this->db->order_by("stt_f_id", "ASC");
        $query2 = $this->db->get();
        $total_Re_sttf=$query->num_rows();

        $fetch = array(
            'total_Re_stt'=>$total_Re_stt,
            'Re_stt'=>$query->result(),

            'total_Re_sttf'=>$total_Re_sttf,
            'Re_sttf'=>$query2->result(),
        );
        return $fetch;
    }


}