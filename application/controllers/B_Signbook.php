<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Signbook extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Signbook_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('Backoffice/login', 'refresh');
        }
        $accesstype_no='206';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('/backoffice/accesstype', 'refresh');
        }
    }

    public function index(){
        $data['pA'] = "m_signbook";
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/signbook',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function signbook_list(){

        $search = '';
        $this->load->library('pagination');
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Signbook/signbook_list');
        $config['total_rows'] = $this->B_Signbook_m->getSbList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->B_Signbook_m->getSbList($limit, $offset, $search, $count=false);
		$data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('backoffice/signbook_fetch', $data);
    }

    public function signbook_detail(){
        $data['pA'] = "m_signbook";
        $data['Re'] = $this->B_Signbook_m->getEdit($this->uri->segment(4));
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/signbook_detail',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function signbook_insert(){
        $data['pA'] = "m_signbook";
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/signbook_insert',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function signbook_insert_save(){ 
        if(!empty($_FILES['sb_photo']['name'])) {
            $filename = $_FILES['sb_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="B".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName="";
        }
        $Re=$this->B_Signbook_m->getInsertSave($this->input->POST(),$photoName);

        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['sb_photo']['name'])) {
                $config['upload_path'] ='./public/images/signbook';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('sb_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/signbook/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 420;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
        }
        echo json_encode($Re);
    }

    public function signbook_edit(){

        $data['Re'] = $this->B_Signbook_m->getEdit($this->uri->segment(4));
        $data['pA'] = "m_signbook";
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/signbook_edit',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function signbook_edit_save(){ 

        if(!empty($_FILES['sb_photo']['name'])) {
            $filename = $_FILES['sb_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="B".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName=$this->input->POST('h_sb_photo');
        }
        $ReD=$this->B_Signbook_m->getEdit($this->input->POST('sb_id'));
        foreach ($ReD['Re_sb'] as $row);
        $delPhoto=$row->sb_photo;

        $Re=$this->B_Signbook_m->getEditSave($this->input->POST(),$photoName);
        
        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['sb_photo']['name'])) {
                $config['upload_path'] ='./public/images/signbook';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('sb_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/signbook/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 420;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }

                if(!empty($delPhoto)){
                    if(!empty($delPhoto) AND file_exists('public/images/signbook/'.$delPhoto)){
                        unlink('public/images/signbook/'.$delPhoto);
                    }
                }
                
            }
        }
        echo json_encode($Re);
        
    }

    public function signbook_delete_photo(){

        $this->db->trans_begin();

            $ReD=$this->B_Signbook_m->getEdit($this->input->POST('sb_id'));
            foreach ($ReD['Re_sb'] as $row);
            $delPhoto=$row->sb_photo;

            $data = array('sb_photo' => '',);
            $this->db->where('sb_id', $this->input->post('sb_id'));
            $this->db->update('tb_signbook', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรูปภาพได้');
            echo json_encode($Response);
        }else{
            $this->db->trans_commit();
            if(!empty($delPhoto)){
                if(!empty($delPhoto) AND file_exists('public/images/signbook/'.$delPhoto)){
                    unlink('public/images/signbook/'.$delPhoto);
                }
            }
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }

    public function signbook_delete(){
        $ReD=$this->B_Signbook_m->getEdit($this->input->POST('sb_id'));
        foreach ($ReD['Re_sb'] as $row);
        $delPhoto=$row->sb_photo;

        $this->db->trans_begin();

            $this->db->where('sb_id', $this->input->POST('sb_id'));
            $this->db->delete('tb_signbook');

            $this->db->where('sb_id', $this->input->POST('sb_id'));
            $this->db->delete('tb_signbook_list');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการได้');
            echo json_encode($Response);
            exit;
            
        }else{
            $this->db->trans_commit();
            if(!empty($delPhoto) AND file_exists('public/images/signbook/'.$delPhoto)){
                unlink('public/images/signbook/'.$delPhoto);
            }
            $Response = array('action' => 'Y','output' => 'ลบรายการเรียบร้อย');
            echo json_encode($Response);
        }
    }

    public function signbook_sign_delete(){
        $this->db->trans_begin();
            $this->db->where('sbl_id', $this->input->POST('sbl_id'));
            $this->db->delete('tb_signbook_list');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการได้');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'ลบรายการเรียบร้อย');
            echo json_encode($Response);
        }
    }

    public function signbook_sign_list(){

        $search = array(
            'sb_id' => trim($this->input->post('SH_sb_id')),
        );

        $this->load->library('pagination');
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Signbook/signbook_sign_list');
        $config['total_rows'] = $this->B_Signbook_m->getSblList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->B_Signbook_m->getSblList($limit, $offset, $search, $count=false);
		$data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('backoffice/signbook_sign_fetch', $data);
    }

}
