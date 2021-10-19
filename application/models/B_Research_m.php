<?php
class B_Research_m extends CI_Model {
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

    function getRs(){

        //select 1
        $this->db->select("(SELECT count(rs_1_1) FROM tb_research WHERE rs_1_1 ='Y') AS c_rs_1_1");
        $this->db->select("(SELECT count(rs_1_2) FROM tb_research WHERE rs_1_2 ='Y') AS c_rs_1_2");
        $this->db->select("(SELECT count(rs_1_3) FROM tb_research WHERE rs_1_3 ='Y') AS c_rs_1_3");
        $this->db->select("(SELECT count(rs_1_4) FROM tb_research WHERE rs_1_4 ='Y') AS c_rs_1_4");
        $this->db->select("(SELECT count(rs_1_5) FROM tb_research WHERE rs_1_5 ='Y') AS c_rs_1_5");
        $this->db->select("(SELECT count(rs_1_6) FROM tb_research WHERE rs_1_6 ='Y') AS c_rs_1_6");
        $this->db->select("(SELECT count(rs_1_7) FROM tb_research WHERE rs_1_7 ='Y') AS c_rs_1_7");
        $this->db->select("(SELECT count(rs_1_8) FROM tb_research WHERE rs_1_8 ='Y') AS c_rs_1_8");
        $this->db->select("(SELECT count(rs_1_9) FROM tb_research WHERE rs_1_9 ='Y') AS c_rs_1_9");
        $this->db->select("(SELECT count(rs_1_10) FROM tb_research WHERE rs_1_10 ='Y') AS c_rs_1_10");
        $this->db->select("(SELECT count(rs_1_11) FROM tb_research WHERE rs_1_11 ='Y') AS c_rs_1_11");
        $this->db->select("(SELECT count(rs_1_12) FROM tb_research WHERE rs_1_12 ='Y') AS c_rs_1_12");
        $this->db->select("(SELECT count(rs_1_13) FROM tb_research WHERE rs_1_13 ='Y') AS c_rs_1_13");
        $this->db->select("(SELECT count(rs_1_14) FROM tb_research WHERE rs_1_14 ='Y') AS c_rs_1_14");
        $this->db->select("(SELECT count(rs_1_15) FROM tb_research WHERE rs_1_15 ='Y') AS c_rs_1_15");
        $this->db->select("(SELECT count(rs_1_16) FROM tb_research WHERE rs_1_16 ='Y') AS c_rs_1_16");
        $this->db->select("(SELECT count(rs_2_1) FROM tb_research WHERE rs_2_1 = 1) AS c_rs_2_1_1");
        $this->db->select("(SELECT count(rs_2_1) FROM tb_research WHERE rs_2_1 = 2) AS c_rs_2_1_2");
        $this->db->select("(SELECT count(rs_2_1) FROM tb_research WHERE rs_2_1 = 3) AS c_rs_2_1_3");
        $this->db->select("(SELECT count(rs_2_1) FROM tb_research WHERE rs_2_1 = 4) AS c_rs_2_1_4");
        $this->db->select("(SELECT count(rs_2_1) FROM tb_research WHERE rs_2_1 = 5) AS c_rs_2_1_5");
        $this->db->select("(SELECT count(rs_2_2) FROM tb_research WHERE rs_2_2 = 1) AS c_rs_2_2_1");
        $this->db->select("(SELECT count(rs_2_2) FROM tb_research WHERE rs_2_2 = 2) AS c_rs_2_2_2");
        $this->db->select("(SELECT count(rs_2_2) FROM tb_research WHERE rs_2_2 = 3) AS c_rs_2_2_3");
        $this->db->select("(SELECT count(rs_2_2) FROM tb_research WHERE rs_2_2 = 4) AS c_rs_2_2_4");
        $this->db->select("(SELECT count(rs_2_2) FROM tb_research WHERE rs_2_2 = 5) AS c_rs_2_2_5");
        $this->db->select("(SELECT count(rs_2_3) FROM tb_research WHERE rs_2_3 = 1) AS c_rs_2_3_1");
        $this->db->select("(SELECT count(rs_2_3) FROM tb_research WHERE rs_2_3 = 2) AS c_rs_2_3_2");
        $this->db->select("(SELECT count(rs_2_3) FROM tb_research WHERE rs_2_3 = 3) AS c_rs_2_3_3");
        $this->db->select("(SELECT count(rs_2_3) FROM tb_research WHERE rs_2_3 = 4) AS c_rs_2_3_4");
        $this->db->select("(SELECT count(rs_2_3) FROM tb_research WHERE rs_2_3 = 5) AS c_rs_2_3_5");
        $this->db->select("(SELECT count(rs_2_4) FROM tb_research WHERE rs_2_4 = 1) AS c_rs_2_4_1");
        $this->db->select("(SELECT count(rs_2_4) FROM tb_research WHERE rs_2_4 = 2) AS c_rs_2_4_2");
        $this->db->select("(SELECT count(rs_2_4) FROM tb_research WHERE rs_2_4 = 3) AS c_rs_2_4_3");
        $this->db->select("(SELECT count(rs_2_4) FROM tb_research WHERE rs_2_4 = 4) AS c_rs_2_4_4");
        $this->db->select("(SELECT count(rs_2_4) FROM tb_research WHERE rs_2_4 = 5) AS c_rs_2_4_5");
        $this->db->select("(SELECT count(rs_2_5) FROM tb_research WHERE rs_2_5 = 1) AS c_rs_2_5_1");
        $this->db->select("(SELECT count(rs_2_5) FROM tb_research WHERE rs_2_5 = 2) AS c_rs_2_5_2");
        $this->db->select("(SELECT count(rs_2_5) FROM tb_research WHERE rs_2_5 = 3) AS c_rs_2_5_3");
        $this->db->select("(SELECT count(rs_2_5) FROM tb_research WHERE rs_2_5 = 4) AS c_rs_2_5_4");
        $this->db->select("(SELECT count(rs_2_5) FROM tb_research WHERE rs_2_5 = 5) AS c_rs_2_5_5");
        $this->db->select("(SELECT count(rs_3_1) FROM tb_research WHERE rs_3_1 = 1) AS c_rs_3_1_1");
        $this->db->select("(SELECT count(rs_3_1) FROM tb_research WHERE rs_3_1 = 2) AS c_rs_3_1_2");
        $this->db->select("(SELECT count(rs_3_1) FROM tb_research WHERE rs_3_1 = 3) AS c_rs_3_1_3");
        $this->db->select("(SELECT count(rs_3_1) FROM tb_research WHERE rs_3_1 = 4) AS c_rs_3_1_4");
        $this->db->select("(SELECT count(rs_3_1) FROM tb_research WHERE rs_3_1 = 5) AS c_rs_3_1_5");
        $this->db->select("(SELECT count(rs_3_2) FROM tb_research WHERE rs_3_2 = 1) AS c_rs_3_2_1");
        $this->db->select("(SELECT count(rs_3_2) FROM tb_research WHERE rs_3_2 = 2) AS c_rs_3_2_2");
        $this->db->select("(SELECT count(rs_3_2) FROM tb_research WHERE rs_3_2 = 3) AS c_rs_3_2_3");
        $this->db->select("(SELECT count(rs_3_2) FROM tb_research WHERE rs_3_2 = 4) AS c_rs_3_2_4");
        $this->db->select("(SELECT count(rs_3_2) FROM tb_research WHERE rs_3_2 = 5) AS c_rs_3_2_5");
        $this->db->select("(SELECT count(rs_3_3) FROM tb_research WHERE rs_3_3 = 1) AS c_rs_3_3_1");
        $this->db->select("(SELECT count(rs_3_3) FROM tb_research WHERE rs_3_3 = 2) AS c_rs_3_3_2");
        $this->db->select("(SELECT count(rs_3_3) FROM tb_research WHERE rs_3_3 = 3) AS c_rs_3_3_3");
        $this->db->select("(SELECT count(rs_3_3) FROM tb_research WHERE rs_3_3 = 4) AS c_rs_3_3_4");
        $this->db->select("(SELECT count(rs_3_3) FROM tb_research WHERE rs_3_3 = 5) AS c_rs_3_3_5");
        $this->db->select("(SELECT count(rs_3_4) FROM tb_research WHERE rs_3_4 = 1) AS c_rs_3_4_1");
        $this->db->select("(SELECT count(rs_3_4) FROM tb_research WHERE rs_3_4 = 2) AS c_rs_3_4_2");
        $this->db->select("(SELECT count(rs_3_4) FROM tb_research WHERE rs_3_4 = 3) AS c_rs_3_4_3");
        $this->db->select("(SELECT count(rs_3_4) FROM tb_research WHERE rs_3_4 = 4) AS c_rs_3_4_4");
        $this->db->select("(SELECT count(rs_3_4) FROM tb_research WHERE rs_3_4 = 5) AS c_rs_3_4_5");
        $this->db->select("(SELECT count(rs_3_5) FROM tb_research WHERE rs_3_5 = 1) AS c_rs_3_5_1");
        $this->db->select("(SELECT count(rs_3_5) FROM tb_research WHERE rs_3_5 = 2) AS c_rs_3_5_2");
        $this->db->select("(SELECT count(rs_3_5) FROM tb_research WHERE rs_3_5 = 3) AS c_rs_3_5_3");
        $this->db->select("(SELECT count(rs_3_5) FROM tb_research WHERE rs_3_5 = 4) AS c_rs_3_5_4");
        $this->db->select("(SELECT count(rs_3_5) FROM tb_research WHERE rs_3_5 = 5) AS c_rs_3_5_5");
        $this->db->select("(SELECT count(rs_4_1) FROM tb_research WHERE rs_4_1 = 1) AS c_rs_4_1_1");
        $this->db->select("(SELECT count(rs_4_1) FROM tb_research WHERE rs_4_1 = 2) AS c_rs_4_1_2");
        $this->db->select("(SELECT count(rs_4_1) FROM tb_research WHERE rs_4_1 = 3) AS c_rs_4_1_3");
        $this->db->select("(SELECT count(rs_4_1) FROM tb_research WHERE rs_4_1 = 4) AS c_rs_4_1_4");
        $this->db->select("(SELECT count(rs_4_1) FROM tb_research WHERE rs_4_1 = 5) AS c_rs_4_1_5");
        $this->db->select("(SELECT count(rs_4_2) FROM tb_research WHERE rs_4_2 = 1) AS c_rs_4_2_1");
        $this->db->select("(SELECT count(rs_4_2) FROM tb_research WHERE rs_4_2 = 2) AS c_rs_4_2_2");
        $this->db->select("(SELECT count(rs_4_2) FROM tb_research WHERE rs_4_2 = 3) AS c_rs_4_2_3");
        $this->db->select("(SELECT count(rs_4_2) FROM tb_research WHERE rs_4_2 = 4) AS c_rs_4_2_4");
        $this->db->select("(SELECT count(rs_4_2) FROM tb_research WHERE rs_4_2 = 5) AS c_rs_4_2_5");
        $this->db->select("(SELECT count(rs_4_3) FROM tb_research WHERE rs_4_3 = 1) AS c_rs_4_3_1");
        $this->db->select("(SELECT count(rs_4_3) FROM tb_research WHERE rs_4_3 = 2) AS c_rs_4_3_2");
        $this->db->select("(SELECT count(rs_4_3) FROM tb_research WHERE rs_4_3 = 3) AS c_rs_4_3_3");
        $this->db->select("(SELECT count(rs_4_3) FROM tb_research WHERE rs_4_3 = 4) AS c_rs_4_3_4");
        $this->db->select("(SELECT count(rs_4_3) FROM tb_research WHERE rs_4_3 = 5) AS c_rs_4_3_5");
        $this->db->select("(SELECT count(rs_4_4) FROM tb_research WHERE rs_4_4 = 1) AS c_rs_4_4_1");
        $this->db->select("(SELECT count(rs_4_4) FROM tb_research WHERE rs_4_4 = 2) AS c_rs_4_4_2");
        $this->db->select("(SELECT count(rs_4_4) FROM tb_research WHERE rs_4_4 = 3) AS c_rs_4_4_3");
        $this->db->select("(SELECT count(rs_4_4) FROM tb_research WHERE rs_4_4 = 4) AS c_rs_4_4_4");
        $this->db->select("(SELECT count(rs_4_4) FROM tb_research WHERE rs_4_4 = 5) AS c_rs_4_4_5");
        $this->db->select("(SELECT count(rs_4_5) FROM tb_research WHERE rs_4_5 = 1) AS c_rs_4_5_1");
        $this->db->select("(SELECT count(rs_4_5) FROM tb_research WHERE rs_4_5 = 2) AS c_rs_4_5_2");
        $this->db->select("(SELECT count(rs_4_5) FROM tb_research WHERE rs_4_5 = 3) AS c_rs_4_5_3");
        $this->db->select("(SELECT count(rs_4_5) FROM tb_research WHERE rs_4_5 = 4) AS c_rs_4_5_4");
        $this->db->select("(SELECT count(rs_4_5) FROM tb_research WHERE rs_4_5 = 5) AS c_rs_4_5_5");
        $this->db->select("(SELECT count(rs_5_1) FROM tb_research WHERE rs_5_1 ='Y') AS c_rs_5_1");
        $this->db->select("(SELECT count(rs_5_2) FROM tb_research WHERE rs_5_2 ='Y') AS c_rs_5_2");
        $this->db->select("(SELECT count(rs_5_3) FROM tb_research WHERE rs_5_3 ='Y') AS c_rs_5_3");
        $this->db->select("(SELECT count(rs_5_4) FROM tb_research WHERE rs_5_4 ='Y') AS c_rs_5_4");
        $this->db->select("(SELECT count(rs_5_5) FROM tb_research WHERE rs_5_5 ='Y') AS c_rs_5_5");
        $this->db->select("(SELECT count(rs_5_6) FROM tb_research WHERE rs_5_6 ='Y') AS c_rs_5_6");
        $this->db->select("count(rs_id) as c_rs_all");
        $this->db->from("tb_research");
        $this->db->order_by("rs_id", "DESC");
        $query = $this->db->get();
        $total_Re_rm=$query->num_rows();

        //Re_AVG
        $this->db->select("AVG(rs_2_1) as a_rs_2_1");
        $this->db->select("AVG(rs_2_2) as a_rs_2_2");
        $this->db->select("AVG(rs_2_3) as a_rs_2_3");
        $this->db->select("AVG(rs_2_4) as a_rs_2_4");
        $this->db->select("AVG(rs_2_5) as a_rs_2_5");
        $this->db->select("AVG(rs_3_1) as a_rs_3_1");
        $this->db->select("AVG(rs_3_2) as a_rs_3_2");
        $this->db->select("AVG(rs_3_3) as a_rs_3_3");
        $this->db->select("AVG(rs_3_4) as a_rs_3_4");
        $this->db->select("AVG(rs_3_5) as a_rs_3_5");
        $this->db->select("AVG(rs_4_1) as a_rs_4_1");
        $this->db->select("AVG(rs_4_2) as a_rs_4_2");
        $this->db->select("AVG(rs_4_3) as a_rs_4_3");
        $this->db->select("AVG(rs_4_4) as a_rs_4_4");
        $this->db->select("AVG(rs_4_5) as a_rs_4_5");
        $this->db->from("tb_research");
        $query2 = $this->db->get();
        $total_Re_avg=$query2->num_rows();

        //Re_std
        $this->db->select("STDDEV(rs_2_1) as std_rs_2_1");
        $this->db->select("STDDEV(rs_2_2) as std_rs_2_2");
        $this->db->select("STDDEV(rs_2_3) as std_rs_2_3");
        $this->db->select("STDDEV(rs_2_4) as std_rs_2_4");
        $this->db->select("STDDEV(rs_2_5) as std_rs_2_5");
        $this->db->select("STDDEV(rs_3_1) as std_rs_3_1");
        $this->db->select("STDDEV(rs_3_2) as std_rs_3_2");
        $this->db->select("STDDEV(rs_3_3) as std_rs_3_3");
        $this->db->select("STDDEV(rs_3_4) as std_rs_3_4");
        $this->db->select("STDDEV(rs_3_5) as std_rs_3_5");
        $this->db->select("STDDEV(rs_4_1) as std_rs_4_1");
        $this->db->select("STDDEV(rs_4_2) as std_rs_4_2");
        $this->db->select("STDDEV(rs_4_3) as std_rs_4_3");
        $this->db->select("STDDEV(rs_4_4) as std_rs_4_4");
        $this->db->select("STDDEV(rs_4_5) as std_rs_4_5");
        $this->db->from("tb_research");
        $query3 = $this->db->get();
        $total_Re_std=$query3->num_rows();

        $fetch = array(
            'Re_rs'=>$query->result(),
            'Re_avg'=>$query2->result(),
            'Re_std'=>$query3->result(),
        );
        return $fetch;

    }

    function getList($limit, $offset, $search, $count){

        $this->db->select("*");
        $this->db->from("tb_research");
        $this->db->order_by("rs_id", "DESC");
        $query = $this->db->get();
        $total_Re_rm=$query->num_rows();

        $this->db->select("*");
        $this->db->from("tb_research");
        $this->db->order_by("rs_id", "DESC");
  
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

    function getRsDetail($id){

        $this->db->select("*");
        $this->db->from("tb_research");
        $this->db->where("rs_id", $id);
        $query = $this->db->get();
        $total_Re_rm=$query->num_rows();

        $fetch = array(
            'total_Re_rm'=>$total_Re_rm,
            'Re_rm'=>$query->result(),
        );
        return $fetch;

    }

    function chkRadio($data,$chk){
        if($data==$chk){
            return '<i class="far fa-check-circle fa-lg text-danger"></i>&nbsp;';
        }else {
            return '<i class="far fa-circle fa-lg"></i>&nbsp;';
        }
    }

    function chkCheckbox($data){
        if($data=='Y'){
            return '<i class="far fa-check-square fa-lg text-danger"></i>&nbsp;';
        }else {
            return '<i class="far fa-square fa-lg"></i>&nbsp;';
        }
    }

}