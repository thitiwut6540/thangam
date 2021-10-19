<?php
class B_Operations_m extends CI_Model {
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

    function getOprList($limit, $offset, $search, $count){

        if($search){
            $SH_dp_name = $search['SH_dp_name'];
        }

        //total
        $this->db->select("a.opr_id");
        $this->db->from("tb_opr a");
        $this->db->join('tb_depart b', 'b.dp_id=a.dp_id', 'left');
        $this->db->where("b.dp_name", $SH_dp_name);
        $query1 = $this->db->get();
        $total_ReOPR=$query1->num_rows();

        //LIST
        $this->db->select("a.*,b.dp_name,c.mem_name");
        $this->db->from("tb_opr a");
        $this->db->join('tb_depart b', 'b.dp_id=a.dp_id', 'left');
        $this->db->join('tb_member c', ' c.mem_id=a.mem_id', 'left');
        $this->db->where("b.dp_name", $SH_dp_name);
        $this->db->order_by("a.opr_id", "DESC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query = $this->db->get();
            $page_total=$query->num_rows();
			if($query->num_rows() > 0) {
                $fetch = array(
                    'total_ReOPR'=>$total_ReOPR,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'ReOPR'=>$query->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_ReOPR'=>$total_ReOPR,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'ReOPR'=>$query->result(),
        );
        return $fetch;
    }

    function getOprEdit($id){
        $this->db->select("*");
        $this->db->from("tb_opr");
        $this->db->where("opr_id", $id);
        $query1 = $this->db->get();

        $this->db->select("*");
        $this->db->from("tb_opr_f");
        $this->db->where("opr_id", $id);
        $this->db->order_by("opr_f_id", "ASC");
        $query2 = $this->db->get();

        $fetch = array(
            'ReOPR'=>$query1->result(),
            'ReOPRF'=>$query2->result(),
            'total_ReOPRF'=>$query2->num_rows()
        );
        return $fetch;
    }

}