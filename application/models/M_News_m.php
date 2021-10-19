<?php
class M_News_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getNewTypeID($name){
        $this->db->select("newstype_id");
        $this->db->from("tb_news_type");
        $this->db->where("newstype_name", $name);
        $query = $this->db->get();
        $total_Re_dp=$query->num_rows();
        foreach ($query->result() as $row);

        if($total_Re_dp>0){
            $id = $row->newstype_id ;
        }else{
            $id='';
        }
        return $id;
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

    function getDepart(){
        $this->db->select("*");
        $this->db->from("tb_depart");
        $this->db->where("dptype_id", '1');
        $query = $this->db->get();
        $total_Re_dp=$query->num_rows();

        $fetch = array(
            'total_Re_n'=>$total_Re_dp,
            'Re_dp'=>$query->result(),
        );
        return $fetch;
    }

    function getNewsList($limit, $offset, $search, $count){

        if($search){
            $newstype_id = $search['newstype_id'];
            $dp_id = $search['dp_id'];
        }
        $condition="a.news_id > 0 AND a.news_approve='Y' AND a.news_status='Y' ";
        if(!empty($newstype_id)){
            $condition.="AND a.newstype_id = ".$newstype_id." ";
        }
        if(!empty($dp_id)){
            $condition.="AND a.dp_id = ".$dp_id." ";
        }
        

        $this->db->select("a.news_id");
        $this->db->from("tb_news a");
        $this->db->where($condition);
        $this->db->order_by("a.news_date", "DESC");
        $query = $this->db->get();
        $total_Re_n=$query->num_rows();

        $this->db->select("a.*, b.newstype_name, c.dp_name");
        $this->db->from("tb_news a");
        $this->db->join("tb_news_type b", "a.newstype_id = b.newstype_id", "left");
        $this->db->join("tb_depart c", "a.dp_id = c.dp_id", "left");
        $this->db->where($condition);
        $this->db->order_by("a.news_date", "DESC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query = $this->db->get();
            $page_total=$query->num_rows();
			if($query->num_rows() > 0) {
                $fetch = array(
                    'total_Re_n'=>$total_Re_n,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_n'=>$query->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_n'=>$total_Re_n,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_n'=>$query->result(),
        );
        return $fetch;
    }

    function getNews($id){

        $condition="a.news_id > 0 AND a.news_approve='Y' AND a.news_status='Y' ";
        $condition.="AND a.news_id = ".$id." ";

        $this->db->select("a.*, b.newstype_name, c.dp_name");
        $this->db->from("tb_news a");
        $this->db->join("tb_news_type b", "a.newstype_id = b.newstype_id", "left");
        $this->db->join("tb_depart c", "a.dp_id = c.dp_id", "left");
        $this->db->where($condition);
        $this->db->order_by("a.news_date", "DESC");
        $query = $this->db->get();
        $total_Re_n=$query->num_rows();

        $this->db->select("*");
        $this->db->from("tb_news_file");
        $this->db->where('news_id',$id);
        $this->db->order_by("newsf_id", "ASC");
        $query2 = $this->db->get();

        $this->db->select("*");
        $this->db->from("tb_news_link");
        $this->db->where('news_id',$id);
        $this->db->order_by("nl_id", "ASC");
        $query3 = $this->db->get();

  
        $fetch = array(
            'total_Re_n'=>$total_Re_n,
            'Re_n'=>$query->result(),

            'total_Re_nf'=>$query2->num_rows(),
            'Re_nf'=>$query2->result(),

            'total_Re_nl'=>$query3->num_rows(),
            'Re_nl'=>$query3->result(),
        );
        return $fetch;
    }

}