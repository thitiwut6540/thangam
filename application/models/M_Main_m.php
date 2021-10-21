<?php
class M_Main_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getNewsMain(){

        $this->db->select("*");
        $this->db->from("tb_news_type");
        $query = $this->db->get();
        $total_Re_ntm=$query->num_rows();

        $this->db->select("a.*, b.newstype_name");
        $this->db->from("tb_news a");
        $this->db->join("tb_news_type b", "a.newstype_id = b.newstype_id", "LEFT");
        $this->db->where("a.news_status", "Y");
        $this->db->where("a.news_approve", "Y");
        $query2 = $this->db->get();
        $total_Re_n=$query2->num_rows();

        $fetch = array(
            'total_Re_ntm'=>$total_Re_ntm,
            'Re_ntm'=>$query->result(),
            'total_Re_n'=>$total_Re_n,
            'Re_n'=>$query2->result(),
        );
        return $fetch;
    }

    // function getTopicID($topic){

    //     $this->db->select("*");
    //     $this->db->from("tb_newstype");
    //     $this->db->where("nt_name", $topic);
    //     $query = $this->db->get();
    //     foreach($query->result() as $row_topic);
    //     return $row_topic->nt_id;

    // }

    // function getSubID($sub){

    //     $this->db->select("*");
    //     $this->db->from("tb_news_sub");
    //     $this->db->where("ns_name", $sub);
    //     $query = $this->db->get();
    //     foreach($query->result() as $row_sub);
    //     return $row_sub->ns_id;

    // }

    // function getNewID($new){

    //     $this->db->select("*");
    //     $this->db->from("tb_news");
    //     $this->db->where("n_name", $new);
    //     $query = $this->db->get();
    //     foreach($query->result() as $row);
    //     return $row->n_id;

    // }

    // function getslideshow(){

    //     $this->db->select("*");
    //     $this->db->from("tb_banner");
    //     $this->db->order_by("ban_no", "ASC");
    //     $query = $this->db->get();
    //     $total_Re_sls=$query->num_rows();

    //     $fetch = array(
    //         'total_Re_sls'=>$total_Re_sls,
    //         'Re_sls'=>$query->result(),
    //     );
    //     return $fetch;
    // }

    // function getheader(){

    //     $this->db->select("*");
    //     $this->db->from("tb_newstype");
    //     $this->db->order_by("nt_no", "ASC");
    //     $query = $this->db->get();
    //     $total_Re_hd=$query->num_rows();

    //     $fetch = array(
    //         'total_Re_hd'=>$total_Re_hd,
    //         'Re_hd'=>$query->result(),
    //     );
    //     return $fetch;

    // }

    // function getmenu(){

    //     $this->db->select("*");
    //     $this->db->from("tb_newstype");
    //     $this->db->where("nt_status", "Y");
    //     $this->db->order_by("nt_no", "ASC");
    //     $query = $this->db->get();
    //     $total_Re_mn=$query->num_rows();

    //     $fetch = array(
    //         'total_Re_mn'=>$total_Re_mn,
    //         'Re_mn'=>$query->result(),
    //     );
    //     return $fetch;

    // }

    // function getmenusub($nt_id){

    //     $this->db->select("*");
    //     $this->db->from("tb_news_sub");
    //     $this->db->where("nt_id", $nt_id);
    //     $this->db->order_by("ns_no", "ASC");
    //     $query = $this->db->get();
    //     $total_Re_ns=$query->num_rows();

    //     $fetch = array(
    //         'total_Re_ns'=>$total_Re_ns,
    //         'Re_ns'=>$query->result(),
    //     );
    //     return $fetch;

    // }

    // function getuniversity(){

    //     $this->db->select("*");
    //     $this->db->from("tb_university");
    //     $this->db->where("u_id", 1);
    //     $query = $this->db->get();
    //     $total_Re_uni=$query->num_rows();

    //     $fetch = array(
    //         'total_Re_uni'=>$total_Re_uni,
    //         'Re_uni'=>$query->result(),
    //     );
    //     return $fetch;

    // }

    // function getwebsiteinfo(){

    //     $this->db->select("*");
    //     $this->db->from("tb_site_topic");
    //     $this->db->order_by("st_no", "ASC");
    //     $query = $this->db->get();
    //     $total_Re_info=$query->num_rows();

    //     $fetch = array(
    //         'total_Re_info'=>$total_Re_info,
    //         'Re_info'=>$query->result(),
    //     );
    //     return $fetch;

    // }

    // function getsubinfo($st_id){

    //     $this->db->select("*");
    //     $this->db->from("tb_site");
    //     $this->db->where("st_id", $st_id);
    //     $this->db->order_by("s_id", "DESC");
    //     $query = $this->db->get();
    //     $total_Re_sub=$query->num_rows();

    //     $fetch = array(
    //         'total_Re_sub'=>$total_Re_sub,
    //         'Re_sub'=>$query->result(),
    //     );
    //     return $fetch;

    // }

    // function getnews($nt_id){

    //     $this->db->select("a.*, b.ns_type, b.ns_name");
    //     $this->db->from("tb_news a");
    //     $this->db->join("tb_news_sub b", "a.ns_id = b.ns_id", "left");
    //     $this->db->where("a.nt_id", $nt_id);
    //     $this->db->order_by("a.nt_id", "ASC");
    //     $this->db->limit(6);
    //     $query = $this->db->get();
    //     $total_Re_new=$query->num_rows();

    //     $fetch = array(
    //         'total_Re_new'=>$total_Re_new,
    //         'Re_new'=>$query->result(),
    //     );
    //     return $fetch;

    // }

    // function getChknews($topic, $sub){

    //     $this->db->select("*");
    //     $this->db->from("tb_newstype");
    //     $this->db->where("nt_name", $topic);
    //     $query = $this->db->get();
        
    //     $this->db->select("*");
    //     $this->db->from("tb_news_sub");
    //     $this->db->where("ns_name", $sub);
    //     $query2 = $this->db->get();

    //     foreach($query->result() as $row_topic);
    //     foreach($query2->result() as $row_sub);

    //     $nt_id = $row_topic->nt_id;
    //     $ns_id = $row_sub->ns_id;

    //     $this->db->select("*");
    //     $this->db->from("tb_news_sub");
    //     $this->db->where("nt_id", $nt_id);
    //     $this->db->where("ns_id", $ns_id);
    //     $query3 = $this->db->get();
    //     foreach($query3->result() as $row_type);
        
    //     return $row_type->ns_type;

    // }

    // function getGalList($limit, $offset, $search, $count){

    //     if($search){
    //         $nt_id = $search['nt_id'];
    //         $ns_id = $search['ns_id'];
    //     }

    //     //total
    //     $this->db->select("a.*, b.ns_name");
    //     $this->db->from("tb_news a");
    //     $this->db->join("tb_news_sub b", "a.ns_id = b.ns_id", "left");
    //     $this->db->where("a.nt_id", $nt_id);
    //     $this->db->where("a.ns_id", $ns_id);
    //     $this->db->order_by("a.n_id", "DESC");
    //     $query = $this->db->get();
    //     $total_Re_n=$query->num_rows();

    //     //LIST
    //     $this->db->select("a.*, b.ns_name");
    //     $this->db->from("tb_news a");
    //     $this->db->join("tb_news_sub b", "a.ns_id = b.ns_id", "left");
    //     $this->db->where("a.nt_id", $nt_id);
    //     $this->db->where("a.ns_id", $ns_id);
    //     $this->db->order_by("a.n_id", "DESC");
  
	// 	if($count){
	// 		return $this->db->count_all_results();
	// 	} else {
	// 		$this->db->limit($limit, $offset);
    //         $query2 = $this->db->get();
    //         $page_total=$query2->num_rows();
	// 		if($query2->num_rows() > 0) {
    //             $fetch = array(
    //                 'total_Re_n'=>$total_Re_n,
    //                 'page_start'=>($offset+1),
    //                 'page_end'=>($page_total+($offset)),
    //                 'Re_n'=>$query2->result(),
    //             );
    //             return $fetch;
	// 		}
	// 	}
    //     $fetch = array(
    //         'total_Re_n'=>$total_Re_n,
    //         'page_start'=>($offset+1),
    //         'page_end'=>($page_total+($offset)),
    //         'Re_n'=>$query2->result(),
    //     );
    //     return $fetch;

    // }

    // function getsubdetail($ns_id){

    //     $this->db->select("*");
    //     $this->db->from("tb_news_sub");
    //     $this->db->where("ns_id", $ns_id);
    //     $query = $this->db->get();
    //     $total_Re_dt=$query->num_rows();

    //     $fetch = array(
    //         'total_Re_dt'=>$total_Re_dt,
    //         'Re_dt'=>$query->result(),
    //     );
    //     return $fetch;

    // }

    // function getnewdetail($n_id){

    //     $this->db->select("*");
    //     $this->db->from("tb_news");
    //     $this->db->where("n_id", $n_id);
    //     $query = $this->db->get();
    //     $total_Re_dt=$query->num_rows();

    //     $fetch = array(
    //         'total_Re_dt'=>$total_Re_dt,
    //         'Re_dt'=>$query->result(),
    //     );
    //     return $fetch;

    // }

    // function gettopicdetail($nt_id){

    //     $this->db->select("*");
    //     $this->db->from("tb_newstype");
    //     $this->db->where("nt_id", $nt_id);
    //     $query = $this->db->get();
    //     $total_Re_dt=$query->num_rows();

    //     $fetch = array(
    //         'total_Re_dt'=>$total_Re_dt,
    //         'Re_dt'=>$query->result(),
    //     );
    //     return $fetch;

    // }


}