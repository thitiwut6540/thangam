<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Laws extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Laws_m');

        if(!$this->session->userdata('SS_TL_us_name') 
        OR !$this->session->userdata('SS_TL_usa_num') 
        OR !$this->session->userdata('SS_TL_us_level')) {
            redirect('Backoffice', 'refresh');
        }
        
        $accesstype_no='100';
        $usa_num = $this->session->userdata('SS_TL_usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('Backoffice/accesstype', 'refresh');
        }
    }

    public function list(){ 

        $page = $this->input->post('page');

        $this->load->library('pagination');
        $search = $page;
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Laws/list');
        $config['total_rows'] = $this->B_Laws_m->getList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->B_Laws_m->getList($limit, $offset, $search, $count=false);
        $data['pagelinks'] = $this->pagination->create_links();
        $data['action'] = "List";
        $this->load->view('backoffice/laws_fetch', $data);
    }

    public function list_type(){ 

        $this->load->library('pagination');
        $search = '';
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Laws/list');
        $config['total_rows'] = $this->B_Laws_m->getTypeList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->B_Laws_m->getTypeList($limit, $offset, $search, $count=false);
        $data['pagelinks'] = $this->pagination->create_links();
        $data['action'] = "Listtype";
        $this->load->view('backoffice/laws_fetch', $data);
    }

    public function delete(){ 

        $l_id = $this->input->POST('l_id');

        $this->db->trans_begin();
            //dele file
            $sql="SELECT * FROM tb_laws_file WHERE l_id='$l_id '";
            $Re_file = $this->db->query($sql);

            foreach ($Re_file->result() as $row) {
                if(!empty($row->lf_name)){$lf_name = $row->lf_name;}else{$lf_name = "";}
            }


            foreach ($Re_file->result() as $row2){
                if(!empty($row2->lf_name) AND file_exists('public/file/laws/'.$row2->lf_name)){
                    unlink('public/file/laws/'.$row2->lf_name);
                }
            }
            $data = array('lf_name' => NULL,);

            $this->db->where('l_id', $l_id);
            $this->db->delete('tb_laws_file');

            $this->db->where('l_id', $l_id );
            $this->db->delete('tb_laws');

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

    public function type_insert_form(){ 
        if($this->input->post('action')=="insert"){

            $output='';
            $output.='<div class="form-row">
                    <div class="form-group col-12">
                        <label for="lt_name">ชื่อประเภทกฎหมายและระเบียบ</label> 
                        <input type="text" id="lt_name" name="lt_name" class="form-control form-control-sm">
                    </div>
                </div>';

            $Response = array('action' => 'Y','output' => $output);
            echo json_encode($Response);
            exit;
            
        }
    }

    public function type_edit_form(){ 
        if($this->input->post('action')=="edit"){

            $it_id = $this->input->POST('it_id');
            $it_name = $this->input->POST('it_name');

            $output='';
            $output.='<div class="form-row">
                    <div class="form-group col-12">
                        <label for="lt_name">ชื่อประเภทกฎหมายและระเบียบ</label> 
                        <input type="text" id="lt_name" name="lt_name" class="form-control form-control-sm" value="'.$it_name.'">
                        <input type="hidden" id="lt_id" name="lt_id" class="form-control form-control-sm" value="'.$it_id.'">
                    </div>
                </div>';

            $Response = array('action' => 'Y','output' => $output);
            echo json_encode($Response);
            exit;
            
        }
    }

    public function type_insert_save(){ 

        $this->db->trans_begin();
            $data = array(
                'lt_name' => $this->input->POST('lt_name'),
            );
            $this->db->insert('tb_laws_type', $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'เพิ่มประเภทกฎหมายและระเบียบเรียบร้อย');
            echo json_encode($Response);
            exit;
        }
    }

    public function type_edit_save(){ 

        $this->db->trans_begin();
            $data = array(
                'lt_name' => $this->input->POST('lt_name'),
            );
            $this->db->where('lt_id', $this->input->POST('lt_id'));
            $this->db->update('tb_laws_type', $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'บันทึกแก้ไขประเภทกฎหมายและระเบียบเรียบร้อย');
            echo json_encode($Response);
            exit;
        }
    }

    public function type_delete(){ 
        $this->db->trans_begin();
            $this->db->where('lt_id', $this->input->POST('lt_id'));
            $this->db->delete('tb_laws_type');

            $this->db->where('lt_id', $this->input->POST('lt_id'));
            $this->db->delete('tb_laws');

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

        if($this->input->post('action')=="laws-insert"){

            $this->db->trans_begin();
            $data = array(
                'lt_id' => $this->input->POST('lt_id'),
                'l_list' => $this->input->POST('l_list'),
                'l_list_update' => date("Y-m-d H:i:s"),
            );

            $this->db->insert('tb_laws', $data);
            $laws_id=$this->db->insert_id();

            // file --
            if($this->B_Laws_m->emptyArray($_FILES['lawsf_name']['name'])){
                $count=count($_FILES['lawsf_name']['name']);
                $files = $_FILES;
                for($i = 0; $i<$count; $i++){
                    if(!empty($_FILES['lawsf_name']['name'][$i])){
                        
                        $_FILES['temp']['name']= $files['lawsf_name']['name'][$i];
                        $_FILES['temp']['type']= $files['lawsf_name']['type'][$i];
                        $_FILES['temp']['tmp_name']= $files['lawsf_name']['tmp_name'][$i];
                        $_FILES['temp']['error']= $files['lawsf_name']['error'][$i];
                        $_FILES['temp']['size']= $files['lawsf_name']['size'][$i];
            
                        if(!empty($_FILES['lawsf_name']['name'][$i])) {
            
                            $config['upload_path'] = './public/file/laws'; 
                            $config['allowed_types'] = 'pdf';
                            $config['max_size'] = 0;
                            $config['file_name'] = "LW".date('ymdhis').rand(1000,9999);
                            $this->upload->initialize($config);
                            
                            if($this->upload->do_upload('temp')){
                                $data=$this->upload->data();
                                $file_ul=$data['file_name'];
                            }
                        }

                        $data = array(
                            'l_id' => $laws_id,
                            'lf_name' => $file_ul,
                        );
            
                        $this->db->insert('tb_laws_file', $data);
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
                    'log_data' => $this->input->POST('topic')." : ID".$laws_id,
                );
                $this->db->insert('tb_user_log', $dataLog);
                $Response = array('action' => 'Y','output' => '<i class="fas fa-check"></i> บันทึกข้อมูลเรียบร้อย');
                echo json_encode($Response);
                exit;
            }
            
        }

    }

    public function edit(){ 

        $l_id = $this->input->post('l_id');
        $l_list = $this->input->post('l_list');

        if($this->input->post('action')=="laws-edit"){

            $chk ="SELECT l_list FROM tb_laws WHERE l_list = '$l_list' AND l_id != '$l_id'";
            $Re_chk = $this->db->query($chk);
            $total_Re_chk=$Re_chk->num_rows();
            if($total_Re_chk>0){
                $Response = array('action' => 'D','output' => '<i class="fas fa-exclamation-triangle"></i> กฎหมายและระเบียบ : '.$l_list.' มีในระบบแล้ว');
                echo json_encode($Response);
                exit;
            }else{

                $this->db->trans_begin();
                    //start transaction
                    $data = array(
                        'lt_id' => $this->input->POST('lt_id'),
                        'l_list' => $this->input->POST('l_list'),
                        'l_list_update' => date("Y-m-d H:i:s"),
                    );

                    $this->db->where('l_id', $l_id);
                    $this->db->update('tb_laws', $data);

                    // Photo --
                    if($this->B_Laws_m->emptyArray($_FILES['lawsf_name']['name'])){
                        $count=count($_FILES['lawsf_name']['name']);
                        $files = $_FILES;
                        for($i = 0; $i<$count; $i++){
                            if(!empty($_FILES['lawsf_name']['name'][$i])){
                                
                                $_FILES['temp']['name']= $files['lawsf_name']['name'][$i];
                                $_FILES['temp']['type']= $files['lawsf_name']['type'][$i];
                                $_FILES['temp']['tmp_name']= $files['lawsf_name']['tmp_name'][$i];
                                $_FILES['temp']['error']= $files['lawsf_name']['error'][$i];
                                $_FILES['temp']['size']= $files['lawsf_name']['size'][$i];
                    
                                if(!empty($_FILES['lawsf_name']['name'][$i])) {
                    
                                    $config['upload_path'] = './public/file/laws'; 
                                    $config['allowed_types'] = 'pdf';
                                    $config['max_size'] = 0;
                                    $config['file_name'] = "FL".date('ymdhis').rand(1000,9999);
                                    $this->upload->initialize($config);
                                    
                                    if($this->upload->do_upload('temp')){
                                        $data=$this->upload->data();
                                        $file_ul=$data['file_name'];
                                    }
                                }
        
                                $data = array(
                                    'l_id' => $l_id,
                                    'lf_name' => $file_ul,
                                );
                    
                                $this->db->insert('tb_laws_file', $data);
                            }
                        }
                    }

                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    $Response = array('action' => 'N','output' => '<i class="fas fa-exclamation-triangle"></i> ไม่สามารถบันทึกแก้ไขข้อมูลได้กรุณาตรวจสอบ');
                    echo json_encode($Response);
                    exit;
                }else{
                    $this->db->trans_commit();
                    $dataLog = array(
                        'log_id'=>NULL,
                        'log_name' => $_SESSION["SS_TL_us_name"],
                        'log_date' => date("Y-m-d H:i:s"),
                        'log_action' => "Edit",
                        'log_data' => $this->input->POST('topic')." : ID".$l_id,
                    );
                    $this->db->insert('tb_user_log', $dataLog);
                    $Response = array('action' => 'Y','id' => $l_id,'output' => '<i class="fas fa-check"></i> บันทึกแก้ไขข้อมูลเรียบร้อย');
                    echo json_encode($Response);
                    exit;
                }
            }

        }
    }

    //file show - delete
    public function list_file(){
        $l_id=$this->input->post('l_id');

        $this->db->select("*");
        $this->db->from("tb_laws_file");
        $this->db->where("l_id", $l_id);
        $Re_lf = $this->db->get();

        $output='<div class="form-row"><div class="form-group col-md-3">';
        foreach ($Re_lf->result() as $row_Re_lf){
            if(!empty($row_Re_lf->lf_name)){
                $output.='<button type="button" class="btn_fm btn_red btn_file_dele" id="file" name="'.$row_Re_lf->lf_id.'"><i class="fas fa-times"></i> ลบ</button><br>
                <i class="fas fa-file m-2 p-2 border rounded bg-dark text-white"></i> '.$row_Re_lf->lf_name.'';
            }
            $output.='</div><div class="form-group col-md-3">';
        }
        echo $output;








    }
    public function dele_file(){
        $lf_id=$this->input->post('lf_id');
        $name=$this->input->post('name');

        $this->db->trans_begin();
            //dele file
            $sql="SELECT * FROM tb_laws_file WHERE lf_id='$lf_id'";
            $Re_file = $this->db->query($sql);
            foreach ($Re_file->result() as $row);
            
            if(!empty($row->lf_name)){$lf_name = $row->lf_name;}else{$lf_name = "";}
            

            if($name=='file'){
                if(!empty($lf_name) AND file_exists('public/file/laws/'.$lf_name)){
                    unlink('public/file/laws/'.$lf_name);
                }
                $data = array('lf_name' => NULL,);
            }

            $this->db->where('lf_id', $lf_id);
            $this->db->delete('tb_laws_file');

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
}
