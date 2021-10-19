<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Department extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Department_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('Backoffice/login', 'refresh');
        }
        $accesstype_no='200';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('/backoffice/accesstype', 'refresh');
        }
    }

    public function department(){
        $data['topic'] = $this->uri->segment(2);
        $data['type'] = $this->B_Department_m->getType($this->uri->segment(2));
        $data['pA'] = "m_depart";

        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/department',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function department_list(){
        $dptype_id=$this->input->POST('id');
        $dptype_name=$this->input->POST('name');
        $data['topic'] = $dptype_name;
        $data['Re'] = $this->B_Department_m->getList($dptype_id);
        $this->load->view('backoffice/department_fetch', $data);
    }

    public function department_no(){
        
        $id=$this->input->POST('dp_id');
        $list_new=$this->input->POST('list');
        $status=$this->input->POST('status');

        $this->db->trans_begin();
            if($status=="down"){
                $list_old=1+$list_new;
                $list_new=$list_new;
            }else if($status=="up"){
                $list_old=$list_new-1;
                $list_new=$list_new;
                if($list_old<1){$list_old=1;}
            }

            $data = array('dp_no' => $list_new,);
            $this->db->where('dp_no', $list_old);
            $this->db->update('tb_depart', $data);

            $data = array('dp_no' => $list_old,);
            $this->db->where('dp_id', $id);
            $this->db->update('tb_depart', $data);

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

    public function department_insert(){
        $id = $this->uri->segment(4);
        $data['topic'] = $this->uri->segment(2);
        $data['type'] = $this->B_Department_m->getType($this->uri->segment(2));
        $data['pA'] = "m_depart";

        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/department_insert',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function department_insert_save(){ 

        if(!empty($_FILES['dp_photo']['name'])) {
            $filename = $_FILES['dp_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="DP".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName="";
        }
        $Re=$this->B_Department_m->getInsertSave($this->input->POST(),$photoName);
        
        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['dp_photo']['name'])) {
                $config['upload_path'] ='./public/images/department';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('dp_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/department/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 1200;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
        }
        echo json_encode($Re);
    }


    public function department_edit(){
        $id = $this->uri->segment(4);
        $data['topic'] = $this->uri->segment(2);
        $data['type'] = $this->B_Department_m->getType($this->uri->segment(2));
        $data['Re'] = $this->B_Department_m->getEdit($id);
        $data['pA'] = "m_depart";

        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/department_edit',$data);
        $this->load->view('backoffice/template/a_footer');
    }


    public function department_edit_save(){ 

        if(!empty($_FILES['dp_photo']['name'])) {
            $filename = $_FILES['dp_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="DP".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName=$this->input->POST('h_dp_photo');
        }
        $ReD=$this->B_Department_m->getEdit($this->input->POST('dp_id'));
        foreach ($ReD['Re_dp'] as $row);
        $delPhoto=$row->dp_photo;

        $Re=$this->B_Department_m->getEditSave($this->input->POST(),$photoName);
        
        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['dp_photo']['name'])) {
                $config['upload_path'] ='./public/images/department';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('dp_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/department/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 1200;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }

                if(!empty($delPhoto)){
                    if(!empty($delPhoto) AND file_exists('public/images/department/'.$delPhoto)){
                        unlink('public/images/department/'.$delPhoto);
                    }
                }
                
            }
        }
        echo json_encode($Re);
    }

    public function department_delete_photo(){
        $dp_id=$this->input->post('dp_id');

        $this->db->trans_begin();

            $ReD=$this->B_Department_m->getEdit($this->input->POST('dp_id'));
            foreach ($ReD['Re_dp'] as $row);
            $delPhoto=$row->dp_photo;

            $data = array('dp_photo' => '',);
            $this->db->where('dp_id', $this->input->post('dp_id'));
            $this->db->update('tb_depart', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรูปภาพได้');
            echo json_encode($Response);
        }else{
            $this->db->trans_commit();
            if(!empty($delPhoto)){
                if(!empty($delPhoto) AND file_exists('public/images/department/'.$delPhoto)){
                    unlink('public/images/department/'.$delPhoto);
                }
            }
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }


    public function department_delete(){
        $ReD=$this->B_Department_m->getEdit($this->input->POST('dp_id'));
        foreach ($ReD['Re_dp'] as $row);
        $delPhoto=$row->dp_photo;

        $this->db->trans_begin();

            $this->db->where('dp_id', $this->input->POST('dp_id'));
            $this->db->delete('tb_depart');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการได้');
            echo json_encode($Response);
            exit;
            
        }else{
            $this->db->trans_commit();
            if(!empty($delPhoto) AND file_exists('public/images/department/'.$delPhoto)){
                unlink('public/images/department/'.$delPhoto);
            }
            $Response = array('action' => 'Y','output' => 'ลบรายการเรียบร้อย');
            echo json_encode($Response);
        }
    }

}
