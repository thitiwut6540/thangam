<?php
class M_Eoffice_m extends CI_Model {
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

    function login_check($u,$p){

        $this->db->select("*");
        $this->db->from("tb_member");
        $this->db->where("mem_user", $u);
        $Re_mem = $this->db->get();
        $total_Re_chk=$Re_mem->num_rows();
        foreach ($Re_mem->result() as $row_Re_mem);

        if ($total_Re_chk > 0){
            $counter=0;
            $mem_logindate=date("Y-m-d H:i:s");
            if(password_verify($p,$row_Re_mem->mem_pass)){
                $_SESSION['E'.ANW_SS.'mem_id'] = $row_Re_mem->mem_id;
                $_SESSION['E'.ANW_SS.'mem_name'] = $row_Re_mem->mem_name;
                $mem_logindate=date("Y-m-d H:i:s");

                if($row_Re_mem->mem_counter=="" OR $row_Re_mem->mem_counter==null ){
                    $counter=0;
                }else{$counter=$row_Re_mem->mem_counter;}
                $counter=$row_Re_mem->mem_counter;
                $mem_counter=$counter+1;

                $d1 = array(
                    'mem_logindate' => $mem_logindate,
                    'mem_counter' => $mem_counter
                );
                $this->db->where('mem_id', $row_Re_mem->mem_id);
                $this->db->update('tb_member', $d1);
                
                $fetch = array(
                    'action'=>'Y',
                    'output'=>'',
                );
                return $fetch;
                exit;
            }else{
                $fetch = array(
                    'action'=>'P',
                    'output'=>'Password ไม่ถูกต้องกรุณาตรวจสอบ',
                );
                return $fetch;
                exit;
            }
        }else{
            session_unset();
            $fetch = array(
                'action'=>'N',
                'output'=>'Username ไม่ถูกต้องกรุณาตรวจสอบ',
            );
            return $fetch;
            exit;
        }
    }

    function getMenu($mem_id){
        $this->db->select("*");
        $this->db->from("tb_member");
        $this->db->where("mem_id", $mem_id);
        $query = $this->db->get();
        $fetch = array(
            'Re_mem'=>$query->result(),
        );
        return $fetch;
    }

    function getPasswordSave($data){

        $mem_id=$data['mem_id'];
        $mem_d_pass=$data['mem_d_pass'];
        $mem_n_pass=$data['mem_n_pass'];
        $pass = password_hash($mem_n_pass, PASSWORD_DEFAULT);

        $sql ="SELECT * FROM tb_member WHERE mem_id = '$mem_id'";
        $Re_mem = $this->db->query($sql);
        $row_Re_mem = $Re_mem->row();
        $total_Re_chk=$Re_mem->num_rows();
        if($total_Re_chk>0){
            if(password_verify($mem_d_pass,$row_Re_mem->mem_pass)){

                $this->db->trans_begin();

                    $d1 = array('mem_pass' => $pass,);
                    $this->db->where('mem_id', $mem_id);
                    $this->db->update('tb_member', $d1);

                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    $Response = array('action' => 'N','output' => 'ไม่สามารถกำหนดรหัสผ่านได้กรุณาตรวจสอบ');
                    return $Response;
                    exit;
                }else{
                    $this->db->trans_commit();
                    $Response = array('action' => 'Y', 'output' => 'แก้ไขรหัสผ่านเรียบร้อย');
                    return $Response;
                    exit;
                }
    
            } else {
    
                $Response = array('action' => 'D','output' => 'Password เดิมไม่ถูกต้อง');
                return $Response;
                exit;
    
            }
        }else{
            $Response = array('action' => 'N','output' => 'ไม่สามารถระบุผู้ใช้งานได้กรุณาเข้าสู่ระบบอีกครั้ง');
            return $Response;
            exit;
        }



        
    }

    function getDepart(){

        $this->db->select("*");
        $this->db->from("tb_depart");
        $this->db->order_by("dp_id", 'ASC');
        $query = $this->db->get();

        $fetch = array(
            'Re_dp'=>$query->result(),
        );
        return $fetch;

    }

    function getDepartchk($dp_id){

        $this->db->select("b.dp_id, b.dp_name");
        $this->db->from("tb_member a");
        $this->db->join("tb_depart b", "a.dp_id = b.dp_id", "left");
        $this->db->where("a.dp_id", $dp_id);
        $this->db->order_by("a.dp_id", 'ASC');
        $query = $this->db->get();
        $total_Re_chk=$query->num_rows();

        $fetch = array(
            'total_Re_chk'=>$total_Re_chk,
            'Re_chk'=>$query->result(),
        );
        return $fetch;

    }

    function getMemDepart($dp_id, $id){
        $this->db->select("*");
        $this->db->from("tb_member");
        $this->db->where("dp_id", $dp_id);
        $this->db->where("mem_id !=", $id);
        $this->db->order_by("dp_id", 'ASC');
        $query = $this->db->get();

        $fetch = array(
            'Re_mdp'=>$query->result(),
        );
        return $fetch;
    }


    /* Receive ----------------- */
    function getReceiveList($limit, $offset, $search, $count){

        if($search){
            $er_status = $search['er_status'];
            $mem_id = $search['mem_id'];
        }

        $this->db->select("er_id");
        $this->db->from("tb_e_receive");
        $this->db->where("er_status", $er_status);
        $this->db->where("mem_id", $mem_id);
        $this->db->order_by("er_date_sent", 'DESC');
        $query = $this->db->get();
        $total_Re_chk=$query->num_rows();

        $this->db->select("a.*, b.ed_name, b.ed_speed, c.et_name, b.ed_status, d.mem_name as mem_name_sent");
        $this->db->from("tb_e_receive a");
        $this->db->join("tb_e_doc b", "a.ed_id = b.ed_id", "left");
        $this->db->join("tb_e_type c", "b.et_id = c.et_id", "left");
        $this->db->join("tb_member d", "b.mem_id = d.mem_id", "left");
        $this->db->where("a.er_status", $er_status);
        $this->db->where("a.mem_id", $mem_id);
        $this->db->order_by("a.er_date_sent", 'DESC');

		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_chk'=>$total_Re_chk,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_list'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_chk'=>$total_Re_chk,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_list'=>$query2->result(),
        );
        return $fetch;
        

    }

    function getReceiveDetail($er_id){
        $this->db->select("a.er_id, a.mem_id AS mem_id_receive, a.er_status, b.*, e.mem_name as mem_name_sent, c.et_name");
        $this->db->from("tb_e_receive a");
        $this->db->join("tb_e_doc b", "a.ed_id = b.ed_id", "left");
        $this->db->join("tb_e_type c", "b.et_id = c.et_id", "left");
        $this->db->join("tb_member e", "b.mem_id = e.mem_id", "left");
        $this->db->where("a.er_id", $er_id);
        $query = $this->db->get();
        $Re=$query->result();
        foreach ($Re as $row);

        $this->db->select("a.er_id, b.mem_name");
        $this->db->from("tb_e_receive a");
        $this->db->join("tb_member b", "a.mem_id = b.mem_id", "left");
        $this->db->where("a.ed_id", $row->ed_id);
        $this->db->order_by("b.mem_name", "ASC");
        $query2 = $this->db->get();

        $this->db->select("*");
        $this->db->from("tb_e_file");
        $this->db->where("ed_id", $row->ed_id);
        $this->db->order_by("ef_id", 'ASC');
        $query3 = $this->db->get();

		$fetch = array(
            'total_Re_er'=>$query->num_rows(),
            'Re_er'=>$query->result(),
            'total_Re_erm'=>$query2->num_rows(),
            'Re_erm'=>$query2->result(), 
            'total_Re_f'=>$query2->num_rows(),
            'Re_f'=>$query3->result(), 
        );
        return $fetch;
        
    }

    function getReceiveOpen(){
        $this->db->trans_begin();
            $data = array(
                'er_status' => 'R',
                'er_date_open' => date("Y-m-d H:i:s"),
            );
            $this->db->where('er_id', $this->input->POST('er_id'));
            $this->db->where('mem_id', $this->input->POST('mem_id'));
            $this->db->update('tb_e_receive', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N');
            return($Response);
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y');
            return($Response);
            exit;
        }
    }

    function getReceiveConfirm(){

        $this->db->trans_begin();
            $data = array(
                'er_status' => 'S',
                'er_date_conf' => date("Y-m-d H:i:s"),
            );
            $this->db->where('er_id', $this->input->POST('er_id'));
            $this->db->where('mem_id', $this->input->POST('mem_id'));
            $this->db->update('tb_e_receive', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'เกิดความผิดพลาดไม่สามารถยืนยันรับหนังสือได้');
            return($Response);
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y');
            return($Response);
            exit;
        }
    }
    


    /* New ----------------- */
    function getSentType(){
        $this->db->select("*");
        $this->db->from("tb_e_type");
        $this->db->order_by("et_id", 'ASC');
        $query = $this->db->get();

        $fetch = array(
            'Re_t'=>$query->result(),
        );
        return $fetch;
    }

    function getSentSave(){
        $ed_date_sign = $this->M_Function_m->dateEng($this->input->POST('ed_date_sign'));
        $ed_time_sign = $this->input->POST('ed_time_sign');
        $ed_date_time = $ed_date_sign." ".$ed_time_sign;

        $this->db->trans_begin();
        $data = array(
            'ed_id' => NULL,
            'ed_no' => $this->input->POST('ed_no'),
            'et_id' => $this->input->POST('et_id'),
            'ed_speed' => $this->input->POST('ed_speed'),
            'ed_name' => $this->input->POST('ed_name'),
            'ed_detail' => $this->input->POST('ed_detail'),
            'ed_date_sign' => $ed_date_time,
            'ed_date_sent' => date("Y-m-d H:i:s"),
            'ed_status' => 'N', 
            'mem_id' => $this->input->POST('post_id'),
        );
        $this->db->insert('tb_e_doc', $data);
        $id=$this->db->insert_id();

        $receive = explode(",", $this->input->POST('mem_id'));
        $data1 = '';
        for ($x=0; $x < count($receive); $x++){
            $data1 = array(
                'er_id' => NULL,
                'ed_id' => $id,
                'mem_id' => $receive[$x],
                'er_status' => 'N',
                'er_date_sent' => $ed_date_time,
            );
            $this->db->insert('tb_e_receive', $data1);
        }

        if($this->M_Eoffice_m->emptyArray($_FILES['ef_name']['name'])){
            $count=count($_FILES['ef_name']['name']);
            $files = $_FILES;

            for($i = 0; $i<$count; $i++){
                if(!empty($_FILES['ef_name']['name'][$i])){
                    
                    $_FILES['temp']['name']= $files['ef_name']['name'][$i];
                    $_FILES['temp']['type']= $files['ef_name']['type'][$i];
                    $_FILES['temp']['tmp_name']= $files['ef_name']['tmp_name'][$i];
                    $_FILES['temp']['error']= $files['ef_name']['error'][$i];
                    $_FILES['temp']['size']= $files['ef_name']['size'][$i];
        
                    if(!empty($_FILES['ef_name']['name'][$i])) {
                        $name1 = explode(".", $_FILES['temp']['name']);
                        $config['upload_path'] = './public/files/eoffice'; 
                        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                        $config['max_size'] = 0;
                        $config['file_name'] = $name1[0]."_".date('ymdhis');
                        $this->upload->initialize($config);
                        
                        if($this->upload->do_upload('temp')){
                            $data=$this->upload->data();
                            $ef_name=$data['file_name'];
                        }
                    }
                    $data = array(
                        'ef_id' => NULL,
                        'ed_id' => $id,
                        'ef_name' => $ef_name,
                    );
                    $this->db->insert('tb_e_file', $data);
                }

            }
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'เกิดความผิดพลาดไม่สามารถส่งจดหมาบได้');
            return($Response);
            exit;
        }else{
            $this->db->trans_commit();

            $_SESSION['SS_mem_id'] = NULL;
            unset($_SESSION['SS_mem_id']);

            $Response = array('action' => 'Y','output' => 'ส่งจดหมายเรียบร้อย');
            return($Response);
            exit;
        }
    }

    function getMemSelect($mem_id){
        $this->db->select("*");
        $this->db->from("tb_member");
        $this->db->where_in('mem_id', $mem_id);
        $this->db->order_by("dp_id", 'ASC');
        $this->db->order_by("mem_id", 'ASC');
        $query = $this->db->get();

        $fetch = array(
            'total_Re_m'=>$query->num_rows(),
            'Re_m'=>$query->result(),
        );
        return $fetch;
    }


    /* Sent ----------------- */
    function getSentList($limit, $offset, $search, $count){

        if($search){
            $mem_id=$search['mem_id'];
        }

        $this->db->select("a.*, b.et_name");
        $this->db->from("tb_e_doc a");
        $this->db->join("tb_e_type b", "a.et_id = b.et_id", "left");
        $this->db->where("a.ed_status", 'N');
        $this->db->where("a.mem_id", $mem_id);
        $this->db->order_by("a.ed_date_sent", 'DESC');
        $query = $this->db->get();
        $total_Re_p=$query->num_rows();

        $this->db->select("a.*, b.et_name");
        $this->db->from("tb_e_doc a");
        $this->db->join("tb_e_type b", "a.et_id = b.et_id", "left");
        $this->db->where("a.ed_status", 'N');
        $this->db->where("a.mem_id", $mem_id);
        $this->db->order_by("a.ed_date_sent", 'DESC');
  
		if($count){
			return $this->db->count_all_results();
		} else {
			$this->db->limit($limit, $offset);
            $query2 = $this->db->get();
            $page_total=$query2->num_rows();
			if($query2->num_rows() > 0) {
                $fetch = array(
                    'total_Re_p'=>$total_Re_p,
                    'page_start'=>($offset+1),
                    'page_end'=>($page_total+($offset)),
                    'Re_p'=>$query2->result(),
                );
                return $fetch;
			}
		}
        $fetch = array(
            'total_Re_p'=>$total_Re_p,
            'page_start'=>($offset+1),
            'page_end'=>($page_total+($offset)),
            'Re_p'=>$query2->result(),
        );
        return $fetch;

    }

    function getSentDetail($id){

        $this->db->select("a.*, b.et_name");
        $this->db->from("tb_e_doc a");
        $this->db->join("tb_e_type b", "a.et_id = b.et_id", "left");
        $this->db->where("a.ed_id", $id);
        $query = $this->db->get();

        $this->db->select("a.*, b.mem_name");
        $this->db->from("tb_e_receive a");
        $this->db->join("tb_member b", "a.mem_id = b.mem_id", "left");
        $this->db->where('a.ed_id', $id);
        $query2 = $this->db->get();

        $this->db->select("*");
        $this->db->from("tb_e_file");
        $this->db->where("ed_id", $id);
        $this->db->order_by("ef_id", 'ASC');
        $query3 = $this->db->get();
  
		$fetch = array(
            'total_Re_dc'=>$query->num_rows(),
            'Re_dc'=>$query->result(),
            'total_Re_dcm'=>$query2->num_rows(),
            'Re_dcm'=>$query2->result(),
            'total_Re_f'=>$query2->num_rows(),
            'Re_f'=>$query3->result(), 
        );
        return $fetch;
        

    }
    
}