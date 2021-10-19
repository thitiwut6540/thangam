<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Content extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Content_m');

        if(!$this->session->userdata('SS_TL_us_name') 
        OR !$this->session->userdata('SS_TL_usa_num') 
        OR !$this->session->userdata('SS_TL_us_level')) {
            redirect('Backoffice', 'refresh');
        }
        
    }

    public function list(){

        $page = $this->input->post('page');

        $this->load->library('pagination');
        $search = $page;
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Content/list');
        $config['total_rows'] = $this->B_Content_m->getList($limit, $offset, $search, $count=true);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 2;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="" class="current_page">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = 'Next <i class="fas fa-angle-right"></i>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="fas fa-angle-left"></i> Previous';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_link'] = '<i class="fas fa-angle-double-left"></i> First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last <i class="fas fa-angle-double-right"></i>';
		$config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);
		$data['Re'] = $this->B_Content_m->getList($limit, $offset, $search, $count=false);
		$data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('backoffice/content_list_fetch', $data);

    }

    public function Type_list(){

        $page = $this->input->post('page');

        $this->load->library('pagination');
        $search = $page;
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Content/Typelist');
        $config['total_rows'] = $this->B_Content_m->getTypeList($limit, $offset, $search, $count=true);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 2;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="" class="current_page">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = 'Next <i class="fas fa-angle-right"></i>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="fas fa-angle-left"></i> Previous';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_link'] = '<i class="fas fa-angle-double-left"></i> First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last <i class="fas fa-angle-double-right"></i>';
		$config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);
		$data['Re'] = $this->B_Content_m->getTypeList($limit, $offset, $search, $count=false);
		$data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('backoffice/content_type_fetch', $data);

    }

    //photo show
    public function list_photo(){
        $con_id=$this->input->post('con_id');

        $sql="SELECT * FROM tb_content WHERE con_id='$con_id'";
        $Re_con = $this->db->query($sql);
        foreach ($Re_con->result() as $row_Re_con);

        $output='<div class="form-row"><div class="form-group col-md-3">';
        if(!empty($row_Re_con->con_photo)){
            $output.='<button type="button" class="btn_fm btn_red btn_photo_dele_banner" id="photo" name="'.$row_Re_con->con_id.'"><i class="fas fa-times"></i> ลบ</button><br><img class="img-fluid w-100" src="'.base_url('public/images/content/'.$row_Re_con->con_photo).'">';
        }else{
            $output.='<button type="button" class="btn_fm btn_red" disabled><i class="fas fa-times"></i> ลบ</button><br><img class="img-fluid w-100" src="'.base_url('public/images/nophoto.png').'">';
        }
        $output.='<br>ตัวอย่างภาพหน่วยงาน</div><div class="form-group col-md-3">';

        echo $output;
    }

    //file show
    public function list_file(){
        $con_id=$this->input->post('con_id');

        $this->db->select("*");
        $this->db->from("tb_content_file");
        $this->db->where("con_id", $con_id);
        $Re_f = $this->db->get();

        $output='<div class="form-row"><div class="form-group col-md-3">';
        foreach ($Re_f->result() as $row_Re_f){
            if(!empty($row_Re_f->con_f_name)){
                $output.='<button type="button" class="btn_fm btn_red btn_file_dele" id="file" name="'.$row_Re_f->con_f_id.'"><i class="fas fa-times"></i> ลบ</button><br>
                <i class="fas fa-file m-2 p-2 border rounded bg-dark text-white"></i> '.$row_Re_f->con_f_name.'';
            }
            $output.='</div><div class="form-group col-md-3">';
        }
        echo $output;
    }

    public function type_insert_form(){ 
        if($this->input->post('action')=="insert"){

            $this->db->select("*");
            $this->db->from("tb_depart");
            $this->db->order_by("dp_id", "ASC");
            $query1 = $this->db->get();

            $output='';
            $output.='
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">หน่วยงาน</label>
                        <select name="dp_id" id="dp_id" class="form-control form-control-sm">
                                <option value="">เลือกหน่วยงาน</option>';
                                foreach ($query1->result() as $row_Re_dp){
                                    $output.='<option value="'.$row_Re_dp->dp_id.'">'.$row_Re_dp->dp_name.'</option>';
                                }
                        $output.='</select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="con_type_name">ชื่อหัวข้อ</label> 
                        <input type="text" id="con_type_name" name="con_type_name" class="form-control form-control-sm">
                    </div>
                </div>';

            $Response = array('action' => 'Y','output' => $output);
            echo json_encode($Response);
            exit;
            
        }
    }

    public function type_insert_save(){ 

        $con_type_name = $this->input->POST('con_type_name');

        $chk ="SELECT con_type_name FROM tb_content_type WHERE con_type_name = '$con_type_name'";
        $Re_chk = $this->db->query($chk);
        $total_Re_chk=$Re_chk->num_rows();
        if($total_Re_chk>0){
            $Response = array('action' => 'D','output' => '<i class="fas fa-exclamation-triangle"></i> มีหัวข้อข้อมูล : '.$con_type_name.' มีในระบบแล้ว');
            echo json_encode($Response);
            exit;
        }else{

            $this->db->trans_begin();
            //start transaction
            $data = array(
                'con_type_name' => $this->input->POST('con_type_name'),
                'dp_id' => $this->input->POST('dp_id'),
            );

            $this->db->insert('tb_content_type', $data);
            $con_type_id=$this->db->insert_id();


            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $Response = array('action' => 'N','output' => '<i class="fas fa-exclamation-triangle"></i> ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
                echo json_encode($Response);
                exit;
            }else{
                $this->db->trans_commit();
                $Response = array('action' => 'Y','id' => $con_type_id,'output' => '<i class="fas fa-check"></i> เพิ่มหัวข้อข้อมูลเรียบร้อย');
                echo json_encode($Response);
                exit;
            }
        }
    }

    public function type_edit_form(){ 
        if($this->input->post('action')=="edit"){

            $con_type_id = $this->input->POST('con_type_id');
            $con_type_name = $this->input->POST('con_type_name');

            $this->db->select("*");
            $this->db->from("tb_depart");
            $this->db->order_by("dp_id", "ASC");
            $query1 = $this->db->get();

            $this->db->select("*");
            $this->db->from("tb_content_type");
            $this->db->where("con_type_id", $con_type_id);
            $this->db->order_by("con_type_id", "DESC");
            $query2 = $this->db->get();

            foreach ($query2->result() as $row_Re_ct);

            $output='';
            $output.='
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">หน่วยงาน</label>
                        <select name="dp_id" id="dp_id" class="form-control form-control-sm">
                                <option value="">เลือกหน่วยงาน</option>';
                                foreach ($query1->result() as $row_Re_dp){
                                    $output.='<option value="'.$row_Re_dp->dp_id.'"';if($row_Re_dp->dp_id == $row_Re_ct->dp_id){$output.='selected';}$output.='>'.$row_Re_dp->dp_name.'</option>';
                                }
                        $output.='</select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="con_type_name">ชื่อหัวข้อ</label> 
                        <input type="text" id="con_type_name" name="con_type_name" class="form-control form-control-sm" value="'.$row_Re_ct->con_type_name.'">
                        <input type="hidden" id="con_type_id" name="con_type_id" class="form-control form-control-sm" value="'.$row_Re_ct->con_type_id.'">
                    </div>
                </div>';

            $Response = array('action' => 'Y','output' => $output);
            echo json_encode($Response);
            exit;
            
        }
    }

    public function type_edit_save(){ 

        $con_type_name = $this->input->POST('con_type_name');
        $con_type_id = $this->input->POST('con_type_id');
        $dp_id = $this->input->POST('dp_id');

        $chk ="SELECT con_type_name FROM tb_content_type WHERE con_type_name = '$con_type_name' AND con_type_id ='$con_type_id'";
        $Re_chk = $this->db->query($chk);
        $total_Re_chk=$Re_chk->num_rows();
        if($total_Re_chk>1){
            $Response = array('action' => 'D','output' => '<i class="fas fa-exclamation-triangle"></i> มีหัวข้อข้อมูล : '.$con_type_name.' มีในระบบแล้ว');
            echo json_encode($Response);
            exit;
        }else{

            $this->db->trans_begin();
            //start transaction
            $data = array(
                'con_type_name' => $con_type_name,
                'dp_id' => $dp_id,
            );

            $this->db->where('con_type_id', $con_type_id);
            $this->db->update('tb_content_type', $data);


            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $Response = array('action' => 'N','output' => '<i class="fas fa-exclamation-triangle"></i> ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
                echo json_encode($Response);
                exit;
            }else{
                $this->db->trans_commit();
                $Response = array('action' => 'Y','id' => $con_type_id,'output' => '<i class="fas fa-check"></i> เพิ่มหัวข้อข้อมูลเรียบร้อย');
                echo json_encode($Response);
                exit;
            }
        }
    }

    public function type_delete(){ 
        $this->db->trans_begin();
            $this->db->where('con_type_id', $this->input->POST('con_type_id'));
            $this->db->delete('tb_content_type');

            $this->db->where('con_type_id', $this->input->POST('con_type_id'));
            $this->db->delete('tb_content_type');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y');
            echo json_encode($Response);
            exit;
        }
    }

    public function insert(){ 

        if($this->input->post('action')=="con-insert"){

            if(!empty($_FILES['con_photo']['name'])) {
                $config['upload_path'] ='./public/images/content';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = "CT".date('YmdHis').rand(1000,9999);
                $this->upload->initialize($config);
                if($this->upload->do_upload('con_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/con_photo/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 1920;
                    $config['height']       = 473;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $con_p=$data['file_name'];
                }else{$con_p=NULL;}
            }else{$con_p=NULL;}

            $this->db->trans_begin();
            $data = array(
                'dp_id' => $this->input->POST('dp_id'),
                'con_type_id' => $this->input->POST('con_type_id'),
                'con_name' => $this->input->POST('con_name'),
                'con_detail' => $this->input->POST('con_detail'),
                'con_photo' => $con_p,
                'con_date' => date("Y-m-d H:i:s"),
                'mem_id' => $_SESSION["SS_TL_us_id"],
                'con_counter' => NULL,
                'con_notic' => 'N',
                'con_show' => 'Idle',
            );

            $this->db->insert('tb_content', $data);
            $con_id=$this->db->insert_id();

            // file --
            if($this->B_Content_m->emptyArray($_FILES['conf_name']['name'])){
                $count=count($_FILES['conf_name']['name']);
                $files = $_FILES;
                for($i = 0; $i<$count; $i++){
                    if(!empty($_FILES['conf_name']['name'][$i])){
                        
                        $_FILES['temp']['name']= $files['conf_name']['name'][$i];
                        $_FILES['temp']['type']= $files['conf_name']['type'][$i];
                        $_FILES['temp']['tmp_name']= $files['conf_name']['tmp_name'][$i];
                        $_FILES['temp']['error']= $files['conf_name']['error'][$i];
                        $_FILES['temp']['size']= $files['conf_name']['size'][$i];
            
                        if(!empty($_FILES['conf_name']['name'][$i])) {
            
                            $config['upload_path'] = './public/file/content'; 
                            $config['allowed_types'] = 'pdf|jpg|png';
                            $config['max_size'] = 0;
                            $config['file_name'] = "CT".date('ymdhis').rand(1000,9999);
                            $this->upload->initialize($config);
                            
                            if($this->upload->do_upload('temp')){
                                $data=$this->upload->data();
                                $file_ul=$data['file_name'];
                            }
                        }

                        $data = array(
                            'con_id' => $con_id,
                            'con_f_name' => $file_ul,
                        );

                        $data2 = array(
                            'con_id' => $con_id,
                            'con_l_link' => $this->input->POST('con_l_link'),
                        );
            
                        $this->db->insert('tb_content_file', $data);
                        $this->db->insert('tb_content_link', $data2);
                    }
                }
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $Response = array('action' => 'N','output' => '<i class="fas fa-exclamation-triangle"></i> ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
                echo json_encode($Response);
                exit;
            }else{
                $this->db->trans_commit();
                $dataLog = array(
                    'log_id'=>NULL,
                    'log_name' => $_SESSION["SS_TL_us_name"],
                    'log_date' => date("Y-m-d H:i:s"),
                    'log_action' => "Insert",
                    'log_data' => $this->input->POST('topic')." : ID".$con_id,
                );
                $this->db->insert('tb_user_log', $dataLog);
                $Response = array('action' => 'Y','output' => '<i class="fas fa-check"></i> บันทึกข้อมูลเรียบร้อย');
                echo json_encode($Response);
                exit;
            }
            
        }

    }

    public function edit(){ 

        $con_id = $this->input->post('con_id');
        $con_name = $this->input->post('con_name');
        $con_h_photo = $this->input->post('con_h_photo');

        if($this->input->post('action')=="con-edit"){

            $chk ="SELECT con_name FROM tb_content WHERE con_name = '$con_name' AND con_id != '$con_id'";
            $Re_chk = $this->db->query($chk);
            $total_Re_chk=$Re_chk->num_rows();
            if($total_Re_chk>1){
                $Response = array('action' => 'D','output' => '<i class="fas fa-exclamation-triangle"></i> หัวข้อข้อมูล : '.$con_name.' มีในระบบแล้ว');
                echo json_encode($Response);
                exit;
            }else{
                $sql="SELECT * FROM tb_content WHERE con_id='$con_id'";
                $Re_con = $this->db->query($sql);
                foreach ($Re_con->result() as $row_Re_con);

                if(!empty($_FILES['con_photo']['name'])) {
                    if(!empty($row_Re_con->con_photo) AND file_exists('public/images/content/'.$row_Re_con->con_photo)){
                        unlink('public/images/content/'.$row_Re_con->con_photo);
                    }
                    $config['upload_path'] ='./public/images/content';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size'] = 0;
                    $config['file_name'] = "CT".date('YmdHis').rand(1000,9999);
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('con_photo')){
                        $data=$this->upload->data();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './public/images/con_photo/'.$data['file_name'];
                        $config['create_thumb'] = FALSE;
                        $config['maintain_ratio'] = TRUE;
                        $config['width']         = 1920;
                        $config['height']       = 473;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $con_p=$data['file_name'];
                    }else{$con_p=$con_h_photo;}
                }else{$con_p=$con_h_photo;}


                $this->db->trans_begin();
                    //start transaction
                    $data = array(
                        'dp_id' => $this->input->POST('dp_id'),
                        'con_type_id' => $this->input->POST('con_type_id'),
                        'con_name' => $this->input->POST('con_name'),
                        'con_detail' => $this->input->POST('con_detail'),
                        'con_photo' => $con_p,
                        'con_date' => date("Y-m-d H:i:s"),
                        'mem_id' => $_SESSION["SS_TL_us_id"],
                        'con_counter' => NULL,
                        'con_notic' => 'N',
                        'con_show' => 'Idle',
                    );

                    $this->db->where('con_id', $con_id);
                    $this->db->update('tb_content', $data);

                    // Photo --
                    if($this->B_Content_m->emptyArray($_FILES['conf_name']['name'])){
                        $count=count($_FILES['conf_name']['name']);
                        $files = $_FILES;
                        for($i = 0; $i<$count; $i++){
                            if(!empty($_FILES['conf_name']['name'][$i])){
                                
                                $_FILES['temp']['name']= $files['conf_name']['name'][$i];
                                $_FILES['temp']['type']= $files['conf_name']['type'][$i];
                                $_FILES['temp']['tmp_name']= $files['conf_name']['tmp_name'][$i];
                                $_FILES['temp']['error']= $files['conf_name']['error'][$i];
                                $_FILES['temp']['size']= $files['conf_name']['size'][$i];
                    
                                if(!empty($_FILES['conf_name']['name'][$i])) {
                    
                                    $config['upload_path'] = './public/file/content'; 
                                    $config['allowed_types'] = 'pdf|jpg|png';
                                    $config['max_size'] = 0;
                                    $config['file_name'] = "CT".date('ymdhis').rand(1000,9999);
                                    $this->upload->initialize($config);
                                    
                                    if($this->upload->do_upload('temp')){
                                        $data=$this->upload->data();
                                        $file_ul=$data['file_name'];
                                    }
                                }
        
                                $data = array(
                                    'con_id' => $con_id,
                                    'con_f_name' => $file_ul,
                                );

                                
                    
                                $this->db->insert('tb_content_file', $data);
                                
                            }
                        }
                    }

                    $data2 = array(
                        'con_id' => $con_id,
                        'con_l_link' => $this->input->POST('con_l_link'),
                    );

                    $this->db->where('con_id', $con_id);
                    $this->db->update('tb_content_link', $data2);

                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    $Response = array('action' => 'N','output' => '<i class="fas fa-exclamation-triangle"></i> ไม่สามารถบันทึกแก้ไขข้อมูลได้กรุณาตรวจสอบ');
                    echo json_encode($Response);
                    exit;
                }else{
                    $this->db->trans_commit();
                    $Response = array('action' => 'Y','id' => $con_id,'output' => '<i class="fas fa-check"></i> บันทึกแก้ไขข้อมูลเรียบร้อย');
                    echo json_encode($Response);
                    exit;
                }
            }

        }
    }

    public function delete(){

        if($this->input->post('action')=="delete"){
            $con_id=$this->input->post('con_id');

            $this->db->select("a.*, b.con_f_name, c.con_l_link");
            $this->db->from("tb_content a");
            $this->db->join("tb_content_file b", "a.con_id = b.con_id", "left");
            $this->db->join("tb_content_link c", "a.con_id = c.con_id", "left");
            $this->db->where("a.con_id", $con_id);
            $query1 = $this->db->get();
            $total_Re_con=$query1->num_rows();

            foreach ($query1->result() as $row){
                if(!empty($row->con_photo)){$con_photo = $row->con_photo;}else{$con_photo = "";}
                if(!empty($row->con_f_name)){$con_f_name = $row->con_f_name;}else{$con_f_name = "";}
            }

            $this->db->trans_begin();

                foreach ($query1->result() as $row2) {
                    if(!empty($row2->con_photo) AND file_exists('public/images/content/'.$row2->con_photo)){
                        unlink('public/images/content/'.$row2->con_photo);
                    }
    
                    if(!empty($row2->con_f_name) AND file_exists('public/file/content/'.$row2->con_f_name)){
                        unlink('public/file/content/'.$row2->con_f_name);
                    }
                }
  
                //start transaction
                $this->db->where('con_id', $con_id);
                $this->db->delete('tb_content');

                $this->db->where('con_id', $con_id);
                $this->db->delete('tb_content_file');

                $this->db->where('con_id', $con_id);
                $this->db->delete('tb_content_link');
                //end transaction
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการหัวข้อข้อมูลได้');
                echo json_encode($Response);
                exit;
                
            }else{
                $this->db->trans_commit();
                $Response = array('action' => 'Y','output' => 'ลบรายการหัวข้อข้อมูลเรียบร้อย');
                echo json_encode($Response);
            }
        }else{
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการหัวข้อข้อมูลได้');
            echo json_encode($Response);
            exit;
        }
    }

    public function dele_photo(){
        $con_id=$this->input->post('con_id');
        $name=$this->input->post('name');

        $this->db->trans_begin();
            //dele photo
            $sql="SELECT * FROM tb_content WHERE con_id='$con_id'";
            $Re_con = $this->db->query($sql);
            foreach ($Re_con->result() as $row_Re_con);

            if($name=='photo'){
                if(!empty($row_Re_con->con_photo) AND file_exists('public/images/content/'.$row_Re_con->con_photo)){
                    unlink('public/images/content/'.$row_Re_con->con_photo);
                }
                $data = array('con_photo' => NULL,);
            }

            $this->db->where('con_id', $con_id);
            $this->db->update('tb_content', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => '<i class="fas fa-exclamation-triangle"></i> ไม่สามารถลบรูปภาพได้');
            echo json_encode($Response);
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }

    public function dele_file(){
        $con_f_id=$this->input->post('con_f_id');
        $name=$this->input->post('name');

        $this->db->trans_begin();
            //dele file
            $sql="SELECT * FROM tb_content_file WHERE con_f_id='$con_f_id'";
            $Re_file = $this->db->query($sql);
            foreach ($Re_file->result() as $row);

            if(!empty($row->con_f_name)){$con_f_name = $row->con_f_name;}else{$con_f_name = "";}

            if($name=='file'){

                if(!empty($con_f_name) AND file_exists('public/file/content/'.$con_f_name)){
                    unlink('public/file/content/'.$con_f_name);
                }

                $data = array('con_f_name' => NULL,);
            }

            $this->db->where('con_f_id', $con_f_id);
            $this->db->delete('tb_content_file');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => '<i class="fas fa-exclamation-triangle"></i> ไม่สามารถลบรูปภาพได้');
            echo json_encode($Response);
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }

    public function status(){
        $con_id=$this->input->POST('con_id');
        $con_show=$this->input->POST('con_show');

        $this->db->trans_begin();
            //start transaction
            $data = array(
                'con_show' => $con_show,
                );
            $this->db->where('con_id', $con_id);
            $this->db->update('tb_content', $data);
            //end transaction
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y');
            echo json_encode($Response);
            exit;
        }
    }

}
