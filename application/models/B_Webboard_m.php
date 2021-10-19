<?php
class B_Webboard_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getWB($limit, $offset, $search, $count){

        $this->db->select("wb_t_id");
        $this->db->from("tb_wb_topic");
        $this->db->order_by("wb_t_id", "DESC");
        $query = $this->db->get();
        $total_Re_wt=$query->num_rows();

        $this->db->select("a.*, b.us_name");
        $this->db->from("tb_wb_topic a");
        $this->db->join("tb_user b", "a.wb_t_user_save = b.us_id", "left");
        $this->db->order_by("a.wb_t_id", "DESC");
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_wt'=>$total_Re_wt,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_wt'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_wt'=>$total_Re_wt,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_wt'=>$query2->result(),
        );
        return $fetch;

    }

    function getSubTotal($wb_t_id){
        $this->db->select("*");
        $this->db->from("tb_wb_sub");
        $this->db->where("wb_t_id", $wb_t_id);
        $this->db->order_by("wb_s_id", "ASC");
        $query1 = $this->db->get();

        $fetch = array(
            'total_Re_sb'=>$query1->num_rows(),
            'Re_sb'=>$query1->result(),
        );
        return $fetch;
    }

    function getTopic($wb_t_id){

        $this->db->select("*");
        $this->db->from("tb_wb_topic");
        $this->db->where("wb_t_id", $wb_t_id);
        $query = $this->db->get();

        $this->db->select("a.*, b.wb_p_count ");
        $this->db->from("tb_wb_sub a");
        $this->db->join("(select wb_s_id,count(wb_p_id) as wb_p_count from tb_wb_post where wb_p_type='S' group by wb_s_id) b ","a.wb_s_id=b.wb_s_id","LEFT") ;
        $this->db->where("a.wb_t_id", $wb_t_id);
        $this->db->order_by("a.wb_s_id", "ASC");
        $query2 = $this->db->get();

        $this->db->select("*");
        $this->db->from("tb_wb_post");
        $this->db->where("wb_p_type", "T");
        $this->db->where("wb_t_id", $wb_t_id);
        $this->db->where("wb_s_id", "");
        $this->db->order_by("wb_p_id", "ASC");
        $query3 = $this->db->get();
        
        $fetch = array(
            'total_Re_wt'=>$query->num_rows(),
            'Re_wt'=>$query->result(),
            'total_Re_ws'=>$query2->num_rows(),
            'Re_ws'=>$query2->result(),
            'total_Re_wp'=>$query3->num_rows(),
            'Re_wp'=>$query3->result(),
        );
        return $fetch;

    }

    function getSub($wb_t_id,$wb_s_id){

        $this->db->select("a.*, b.wb_t_title, b.wb_t_date");
        $this->db->from("tb_wb_sub a");
        $this->db->join("tb_wb_topic b", "a.wb_t_id=b.wb_t_id", "LEFT");
        $this->db->where("a.wb_t_id", $wb_t_id);
        $this->db->where("a.wb_s_id", $wb_s_id);
        $query2 = $this->db->get();
        
        $fetch = array(
            'total_Re_ws'=>$query2->num_rows(),
            'Re_ws'=>$query2->result(),
        );
        return $fetch;

    }

    function getTopicEdit($wb_t_id){

        $this->db->select("*");
        $this->db->from("tb_wb_topic");
        $this->db->where("wb_t_id", $wb_t_id);
        $query = $this->db->get();
        $fetch = array(
            'total_Re_wt'=>$query->num_rows(),
            'Re_wt'=>$query->result(),
        );
        return $fetch;

    }

    function getTopicNewSave($data,$photoName){

        $wb_t_date = $this->B_Function_m->dateEng($data['wb_t_date']);
        $wb_t_time = $data['wb_t_time'];
        $wb_date_time = $wb_t_date." ".$wb_t_time;

        $this->db->trans_begin();
            $data1 = array(
                'wb_t_id' => NULL,
                'wb_t_title' => $data['wb_t_title'],
                'wb_t_detail' => $data['wb_t_detail'],
                'wb_t_note' => $data['wb_t_note'],
                'wb_t_photo' => $photoName,
                'wb_t_comment' => $data['wb_t_comment'],
                'wb_t_date' => $wb_date_time,
                'wb_t_user_save' => $data['wb_t_user_save'],
            );
            $this->db->insert('tb_wb_topic', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถเพิ่มหัวข้อใหม่ได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'เพิ่มหัวข้อใหม่เรียบร้อย');
            return $Response;
            exit;
        }
    }

    function getTopicEditSave($data,$photoName){

        $wb_t_date = $this->B_Function_m->dateEng($data['wb_t_date']);
        $wb_t_time = $data['wb_t_time'];
        $wb_date_time = $wb_t_date." ".$wb_t_time;

        $this->db->trans_begin();
            $data1 = array(
                'wb_t_title' => $data['wb_t_title'],
                'wb_t_detail' => $data['wb_t_detail'],
                'wb_t_note' => $data['wb_t_note'],
                'wb_t_photo' => $photoName,
                'wb_t_comment' => $data['wb_t_comment'],
                'wb_t_date' => $wb_date_time,
                'wb_t_user_save' => $data['wb_t_user_save'],
            );
            $this->db->where('wb_t_id', $data['wb_t_id']);
            $this->db->update('tb_wb_topic', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถแก้ไขหัวข้อได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'แก้ไขหัวข้อเรียบร้อย');
            return $Response;
            exit;
        }
    }

    function getSubNewSave($data,$photoName){
        $wb_s_date = $this->B_Function_m->dateEng($data['wb_s_date']);
        $wb_s_time = $data['wb_s_time'];
        $wb_date_time = $wb_s_date." ".$wb_s_time;

        $this->db->trans_begin();
            $data1 = array(
                'wb_s_id' => NULL,
                'wb_t_id' => $data['wb_t_id'],
                'wb_s_title' => $data['wb_s_title'],
                'wb_s_detail' => $data['wb_s_detail'],
                'wb_s_photo' => $photoName,
                'wb_s_date' => $wb_date_time,
                'wb_s_user_save' => $data['wb_s_user_save'],
                'wb_s_pin' => $data['wb_s_pin'],
            );
            $this->db->insert('tb_wb_sub', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถเพิ่มหัวข้อย่อยใหม่ได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'เพิ่มหัวข้อย่อยใหม่เรียบร้อย');
            return $Response;
            exit;
        }
    }

    function getSubEdit($wb_s_id){

        $this->db->select("a.*,b.wb_t_title,b.wb_t_photo");
        $this->db->from("tb_wb_sub a");
        $this->db->join("tb_wb_topic b" , "a.wb_t_id=b.wb_t_id", "LEFT");
        $this->db->where("a.wb_s_id" , $wb_s_id);
        $query = $this->db->get();
        $fetch = array(
            'total_Re_ws'=>$query->num_rows(),
            'Re_ws'=>$query->result(),
        );
        return $fetch;
    }

    function getSubEditSave($data,$photoName){

        $wb_s_date = $this->B_Function_m->dateEng($data['wb_s_date']);
        $wb_s_time = $data['wb_s_time'];
        $wb_date_time = $wb_s_date." ".$wb_s_time;

        $this->db->trans_begin();
            $data1 = array(
                'wb_s_title' => $data['wb_s_title'],
                'wb_s_detail' => $data['wb_s_detail'],
                'wb_s_photo' => $photoName,
                'wb_s_date' => $wb_date_time,
                'wb_s_user_save' => $data['wb_s_user_save'],
                'wb_s_pin' => $data['wb_s_pin'],
            );
            $this->db->where('wb_s_id', $data['wb_s_id']);
            $this->db->update('tb_wb_sub', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถแก้ไขหัวข้อย่อยได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'แก้ไขหัวข้อย่อยเรียบร้อย');
            return $Response;
            exit;
        }
    }

    function getSubTopic($wb_t_id){
        $this->db->select("*");
        $this->db->from("tb_wb_sub");
        $this->db->where("wb_t_id", $wb_t_id);
        $this->db->order_by("wb_s_id", "ASC");
        $query1 = $this->db->get();

        $fetch = array(
            'total_Re_stp'=>$query1->num_rows(),
            'Re_stp'=>$query1->result(),
        );
        return $fetch;
    }

    function getCommentTopic($limit, $offset, $search, $count){

        $wb_t_id=$search['wb_t_id'];

        $this->db->select("wb_p_id");
        $this->db->from("tb_wb_post");
        $this->db->where("wb_p_type", "T");
        $this->db->where("wb_t_id", $wb_t_id);
        $query = $this->db->get();
        $total_Re_ct=$query->num_rows();

        $this->db->select("*");
        $this->db->from("tb_wb_post");
        $this->db->where("wb_p_type", "T");
        $this->db->where("wb_t_id", $wb_t_id);
        $this->db->order_by("wb_p_id", "ASC");


		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_ct'=>$total_Re_ct,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_ct'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_ct'=>$total_Re_ct,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_ct'=>$query2->result(),
        );
        return $fetch;

    }

    function getCommentSub($limit, $offset, $search, $count){

        $wb_t_id=$search['wb_t_id'];
        $wb_s_id=$search['wb_s_id'];

        $this->db->select("wb_p_id");
        $this->db->from("tb_wb_post");
        $this->db->where("wb_p_type", "S");
        $this->db->where("wb_t_id", $wb_t_id);
        $this->db->where("wb_s_id", $wb_s_id);
        $query = $this->db->get();
        $total_Re_ct=$query->num_rows();


        $this->db->select("*");
        $this->db->from("tb_wb_post");
        $this->db->where("wb_p_type", "S");
        $this->db->where("wb_t_id", $wb_t_id);
        $this->db->where("wb_s_id", $wb_s_id);
        $this->db->order_by("wb_p_id", "ASC");


		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_ct'=>$total_Re_ct,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_ct'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_ct'=>$total_Re_ct,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_ct'=>$query2->result(),
        );
        return $fetch;

    }

    function getCommentSave($data,$photoName){

        $this->db->trans_begin();
            $data1 = array(
                'wb_p_id' => NULL, 
                'wb_p_type' => $data['wb_p_type'], 
                'wb_t_id' => $data['wb_t_id'], 
                'wb_s_id' => $data['wb_s_id'], 
                'wb_p_comment' => $data['wb_p_comment'], 
                'wb_p_photo' => $photoName, 
                'wb_p_sent' => $data['wb_p_sent'], 
                'wb_p_admin' => $data['wb_p_admin'], 
                'wb_p_date' => date("Y-m-d H:i:s"),
            );
            $this->db->insert('tb_wb_post', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถโพสต์ข้อความได้');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'เพิ่มโพสต์ข้อความรียบร้อย');
            return $Response;
            exit;
        }
    }

    function getCommentEditSave($data,$photoName){

        $this->db->trans_begin();
            $data1 = array(
                'wb_t_id' => $data['wb_t_id'], 
                'wb_s_id' => $data['wb_s_id'], 
                'wb_p_comment' => $data['wb_p_comment2'], 
                'wb_p_photo' => $photoName, 
                'wb_p_sent' => $data['wb_p_sent'], 
                'wb_p_admin' => $data['wb_p_admin'], 
                'wb_p_date' => date("Y-m-d H:i:s"),
            );
            $this->db->where('wb_p_id', $data['wb_p_id']);
            $this->db->update('tb_wb_post', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถcแก้ไขโพสต์ข้อความได้');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'แก้ไขโพสต์ข้อความรียบร้อย');
            return $Response;
            exit;
        }
    }

    function getComment($id){
        $this->db->select("*");
        $this->db->from("tb_wb_post");
        $this->db->where("wb_p_id", $id);
        $query1 = $this->db->get();

        $fetch = array(
            'total_Re_wp'=>$query1->num_rows(),
            'Re_wp'=>$query1->result(),
        );
        return $fetch;
    }

}