<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Landmark extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->model('B_Function_m');
        $this->load->model('B_Landmark_m');
        $this->load->library('upload');
        $this->load->library('image_lib');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('Backoffice/login', 'refresh');
        }
        $accesstype_no='204';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('/backoffice/accesstype', 'refresh');
        }
    }

    public function land(){
        $data['pA'] = "m_land";
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/landmark',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function land_list(){

        $this->load->library('pagination');
        $search = '';
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Landmark/land_list');
        $config['total_rows'] = $this->B_Landmark_m->getLand($limit, $offset, $search, $count=true);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
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
		$data['Re'] = $this->B_Landmark_m->getLand($limit, $offset, $search, $count=false);
		$data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('backoffice/landmark_fetch', $data);
    }

    public function land_insert(){
        $data['pA'] = "m_land";
        $data['Re'] = $this->B_Landmark_m->getLT();
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/landmark_insert',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function land_insert_save(){ 

        if(!empty($_FILES['land_photo']['name'])) {
            $filename = $_FILES['land_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="L".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName="";
        }

        $Re=$this->B_Landmark_m->getLandInsertSave($this->input->POST(),$photoName);
        
        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['land_photo']['name'])) {
                $config['upload_path'] ='./public/images/landmark';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('land_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/landmark/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 920;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
        }
        echo json_encode($Re);
    }

    public function land_edit(){
        $id = $this->uri->segment(4);
        $data['pA'] = "m_land";
        $data['Re'] = $this->B_Landmark_m->getLT();
        $data['ReE'] = $this->B_Landmark_m->getLandEdit($id);
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/landmark_edit',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function land_edit_save(){ 

        if(!empty($_FILES['land_photo']['name'])) {
            $filename = $_FILES['land_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="L".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName=$this->input->POST('h_land_photo');
        }
        $ReD=$this->B_Landmark_m->getLandEdit($this->input->POST('land_id'));
        foreach ($ReD['Re_l'] as $row);
        $delPhoto=$row->land_photo;

        $Re=$this->B_Landmark_m->getLandEditSave($this->input->POST(),$photoName);
        
        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['land_photo']['name'])) {
                $config['upload_path'] ='./public/images/landmark';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('land_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/landmark/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 920;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }

                if(!empty($delPhoto)){
                    if(!empty($delPhoto) AND file_exists('public/images/landmark/'.$delPhoto)){
                        unlink('public/images/landmark/'.$delPhoto);
                    }
                }
                
            }
        }
        echo json_encode($Re);
    }

    public function land_delete(){
        $ReD = $this->B_Landmark_m->getLandEdit($this->input->POST('land_id'));
        foreach ($ReD['Re_l'] as $row);
        $delPhoto=$row->land_photo;

        $this->db->trans_begin();

            $this->db->where('land_id', $this->input->POST('land_id'));
            $this->db->delete('tb_landmark');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการได้');
            echo json_encode($Response);
            exit;
            
        }else{
            $this->db->trans_commit();
            if(!empty($delPhoto) AND file_exists('public/images/landmark/'.$delPhoto)){
                unlink('public/images/landmark/'.$delPhoto);
            }
            $Response = array('action' => 'Y','output' => 'ลบรายการเรียบร้อย');
            echo json_encode($Response);
        }
    }


    public function type(){
        $data['pA'] = "m_type";
        $data['Re'] = $this->B_Landmark_m->getTypeList();
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/landmark_type',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function type_list(){
        $data['Re'] = $this->B_Landmark_m->getTypeList();
        $this->load->view('backoffice/landmark_type_fetch', $data);
    }

    public function type_insert_form(){ 
        $output='<div class="form-row">
                <div class="form-group col-12">
                    <label>ชื่อประเภทสถานที่</label> 
                    <input type="text" id="land_t_name" name="land_t_name" class="form-control form-control-sm">
                </div>
            </div>';
        echo $output;
        exit;
    }

    public function type_insert_save(){ 
        $Re=$this->B_Landmark_m->getTypeInsertSave($this->input->POST());
        echo json_encode($Re);
    }

    public function type_edit_form(){ 
        $Re= $this->B_Landmark_m->getTypeEdit($this->input->POST('land_t_id'));
        foreach ($Re['Re_lt'] as $row_Re_lt);
        $output='<div class="form-row">
                <div class="form-group col-12">
                    <label>ชื่อประเภทสถานที่</label> 
                    <input type="text" id="land_t_name" name="land_t_name" class="form-control form-control-sm" value="'.$row_Re_lt->land_t_name.'">
                    <input type="hidden" id="land_t_id" name="land_t_id" value="'.$row_Re_lt->land_t_id.'">
                </div>
            </div>';
        echo $output;
        exit;
    }

    public function type_edit_save(){ 
        $Re=$this->B_Landmark_m->getTypeEditSave($this->input->POST());
        echo json_encode($Re);
    }

    public function type_no(){
        $id=$this->input->POST('land_t_id');
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

            $data = array('land_t_no' => $list_new,);
            $this->db->where('land_t_no', $list_old);
            $this->db->update('tb_landmark_type', $data);

            $data = array('land_t_no' => $list_old,);
            $this->db->where('land_t_id', $id);
            $this->db->update('tb_landmark_type', $data);

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

    public function type_delete(){
        $this->db->trans_begin();
            $this->db->where('land_t_id', $this->input->POST('land_t_id'));
            $this->db->delete('tb_landmark_type');
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
}
