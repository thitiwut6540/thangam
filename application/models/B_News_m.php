<?php
class B_News_m extends CI_Model {
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

    function getTypeByName($name){
        $this->db->select("*");
        $this->db->from("tb_news_type");
        $this->db->where("newstype_name",$name);
        $query1 = $this->db->get();
        foreach ($query1->result() as $row);
        $id = $row->newstype_id;
        return $id;
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

    function getTypeList(){
        $this->db->select("*");
        $this->db->from("tb_news_type");
        $this->db->order_by("newstype_id", "ASC");
        $query1 = $this->db->get();
        $total_Re_nt=$query1->num_rows();

        $fetch = array(
            'total_Re_nt'=>$total_Re_nt,
            'Re_nt'=>$query1->result(),
        );
        return $fetch;
    }

    function getTypeEdit($id){
        $this->db->select("*");
        $this->db->from("tb_news_type");
        $this->db->where("newstype_id", $id);
        $query1 = $this->db->get();
        $total_Re_nt=$query1->num_rows();

        $fetch = array(
            'total_Re_nt'=>$total_Re_nt,
            'Re_nt'=>$query1->result(),
        );
        return $fetch;
    }

    function getTypeInsertSave($data){
        
        $this->db->trans_begin();
            $data1 = array(
                'newstype_id' => NULL,
                'newstype_name' => $data['newstype_name'],
            );
            $this->db->insert('tb_news_type', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'บันทึกข้อมูลเรียบร้อย');
            return $Response;
            exit;
        }
    }

    function getTypeEditSave($data){
        $this->db->trans_begin();
            $data1 = array(
                'newstype_name' => $data['newstype_name'],
            );
            $this->db->where('newstype_id', $data['newstype_id']);
            $this->db->update('tb_news_type', $data1);


        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'บันทึกข้อมูลเรียบร้อย');
            return $Response;
            exit;
        }
    }

    function getNewsList($limit, $offset, $search, $count){

        $newstype_id=$search['type_id'];
        $condition="a.news_id !='' AND a.newstype_id='".$newstype_id."' ";
        if($search){
            if(!empty($search['dp_id'])){
                $condition.="AND a.dp_id = ".$search['dp_id']." ";
            }
            if(!empty($search['news_name'])){
                $condition.="AND a.news_name LINK '%".$search['news_name']."' ";
            }
        } 

        $this->db->select("a.news_id");
        $this->db->from("tb_news a");
        $this->db->where($condition);
        $this->db->order_by("a.news_id", "DESC");
        $query = $this->db->get();
        $total_Re_n=$query->num_rows();

        $this->db->select("a.*, b.newstype_name, b.newstype_id, c.dp_name");
        $this->db->from("tb_news a");
        $this->db->join("tb_news_type b", "a.newstype_id = b.newstype_id", "left");
        $this->db->join("tb_depart c", "a.dp_id = c.dp_id", "left");
        $this->db->where($condition);
        $this->db->order_by("a.news_id", "DESC");
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_n'=>$total_Re_n,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_n'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_n'=>$total_Re_n,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_n'=>$query2->result(),
        );
        return $fetch;

    }

    function getNewsEdit($id){
        $this->db->select("a.*, b.newstype_name, b.newstype_id, c.dp_name");
        $this->db->from("tb_news a");
        $this->db->join("tb_news_type b", "a.newstype_id = b.newstype_id", "left");
        $this->db->join("tb_depart c", "a.dp_id = c.dp_id", "left");
        $this->db->where("a.news_id", $id);
        $query1 = $this->db->get();
        $total_Re_n=$query1->num_rows();

        $this->db->select("*");
        $this->db->from("tb_news_file");
        $this->db->where("news_id", $id);
        $query2 = $this->db->get();
        $total_Re_nf=$query2->num_rows();

        $this->db->select("*");
        $this->db->from("tb_news_link");
        $this->db->where("news_id", $id);
        $query3 = $this->db->get();
        $total_Re_nl=$query3->num_rows();

        $fetch = array(
            'total_Re_n'=>$total_Re_n,
            'Re_n'=>$query1->result(),
            'total_Re_nf'=>$total_Re_nf,
            'Re_nf'=>$query2->result(),
            'total_Re_nl'=>$total_Re_nl,
            'Re_nl'=>$query3->result(),
        );
        return $fetch;
    }
}