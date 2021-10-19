<?php
class B_Dashboard_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getMemtype(){
        $this->db->select("*");
        $this->db->from("tb_member_type");
        $this->db->order_by("memtype_id ", "ASC");
        $query1 = $this->db->get();
        $fetch = array(
            'total_Re_mt'=>$query1->num_rows(),
            'Re_mt'=>$query1->result(),
        );
        return $fetch;
    }

    function getNewstype(){
        $this->db->select("*");
        $this->db->from("tb_news_type");
        $this->db->order_by("newstype_id ", "ASC");
        $query1 = $this->db->get();
        $fetch = array(
            'total_Re_nt'=>$query1->num_rows(),
            'Re_nt'=>$query1->result(),
        );
        return $fetch;
    }

    function getStttype(){
        $this->db->select("*");
        $this->db->from("tb_statute_type");
        $this->db->order_by("stt_t_id ", "ASC");
        $query1 = $this->db->get();
        $fetch = array(
            'total_Re_st'=>$query1->num_rows(),
            'Re_st'=>$query1->result(),
        );
        return $fetch;
    }

    function getRmtype(){
        $this->db->select("*");
        $this->db->from("tb_roadmap_type");
        $this->db->order_by("rm_t_id ", "ASC");
        $query1 = $this->db->get();
        $fetch = array(
            'total_Re_rmt'=>$query1->num_rows(),
            'Re_rmt'=>$query1->result(),
        );
        return $fetch;
    }

    //Dashboard total process
    function getShowTotal(){
        $this->db->select("position_id");
        $this->db->from("tb_position");
        $this->db->order_by("position_id", "ASC");
        $query1 = $this->db->get();
        $total_ps=$query1->num_rows();

        $this->db->select("mem_id");
        $this->db->from("tb_member");
        $this->db->order_by("mem_id", "ASC");
        $query2 = $this->db->get();
        $total_mem=$query2->num_rows();

        $this->db->select("dp_id");
        $this->db->from("tb_depart");
        $this->db->where("dptype_id", '1');
        $this->db->order_by("dp_id", "ASC");
        $query3 = $this->db->get();
        $total_dp=$query3->num_rows();

        $this->db->select("dp_id");
        $this->db->from("tb_depart");
        $this->db->where("dptype_id", '2');
        $this->db->order_by("dp_id", "ASC");
        $query4 = $this->db->get();
        $total_pj=$query4->num_rows();

        $this->db->select("dp_id");
        $this->db->from("tb_depart");
        $this->db->where("dptype_id", '2');
        $this->db->order_by("dp_id", "ASC");
        $query4 = $this->db->get();
        $total_pj=$query4->num_rows();

        $this->db->select("gal_id");
        $this->db->from("tb_gal");
        $this->db->order_by("gal_id", "ASC");
        $query5 = $this->db->get();
        $total_gl=$query5->num_rows();

        $this->db->select("news_id");
        $this->db->from("tb_news");
        $this->db->order_by("news_id", "ASC");
        $query6 = $this->db->get();
        $total_nw=$query6->num_rows();

        $this->db->select("land_id");
        $this->db->from("tb_landmark");
        $this->db->order_by("land_id", "ASC");
        $query7 = $this->db->get();
        $total_lm=$query7->num_rows();

        $this->db->select("l_id");
        $this->db->from("tb_laws");
        $this->db->order_by("l_id", "ASC");
        $query8 = $this->db->get();
        $total_lw=$query8->num_rows();

        $this->db->select("file_id");
        $this->db->from("tb_file");
        $this->db->order_by("file_id", "ASC");
        $query9 = $this->db->get();
        $total_fl=$query9->num_rows();

        $this->db->select("c_id");
        $this->db->from("tb_complain");
        $this->db->order_by("c_id", "ASC");
        $query10 = $this->db->get();
        $total_cp=$query10->num_rows();

        $this->db->select("otop_id");
        $this->db->from("tb_otop");
        $this->db->order_by("otop_id", "ASC");
        $query11 = $this->db->get();
        $total_ot=$query11->num_rows();

        $this->db->select("qa_id");
        $this->db->from("tb_qa");
        $this->db->order_by("qa_id", "ASC");
        $query12 = $this->db->get();
        $total_qa=$query12->num_rows();

        $this->db->select("con_id");
        $this->db->from("tb_content");
        $this->db->order_by("con_id", "ASC");
        $query13 = $this->db->get();
        $total_ct=$query13->num_rows();

        $this->db->select("s_id");
        $this->db->from("tb_service");
        $this->db->order_by("s_id", "ASC");
        $query14 = $this->db->get();
        $total_rq=$query14->num_rows();

        $fetch = array(
            'total_ps'=>$this->B_Function_m->numberChk_0($total_ps),
            'total_mem'=>$this->B_Function_m->numberChk_0($total_mem),
            'total_dp'=>$this->B_Function_m->numberChk_0($total_dp),
            'total_pj'=>$this->B_Function_m->numberChk_0($total_pj),
            'total_gl'=>$this->B_Function_m->numberChk_0($total_gl),
            'total_nw'=>$this->B_Function_m->numberChk_0($total_nw),
            'total_lm'=>$this->B_Function_m->numberChk_0($total_lm),
            'total_lw'=>$this->B_Function_m->numberChk_0($total_lw),
            'total_fl'=>$this->B_Function_m->numberChk_0($total_fl),
            'total_cp'=>$this->B_Function_m->numberChk_0($total_cp),
            'total_ot'=>$this->B_Function_m->numberChk_0($total_ot),
            'total_qa'=>$this->B_Function_m->numberChk_0($total_qa),
            'total_ct'=>$this->B_Function_m->numberChk_0($total_ct),
            'total_rq'=>$this->B_Function_m->numberChk_0($total_rq),
        );
        return $fetch;
    }

}