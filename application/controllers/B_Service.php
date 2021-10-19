<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Service extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Service_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('backoffice/login', 'refresh');
        }
        $accesstype_no='403';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('backoffice/accesstype', 'refresh');
        }
    }

    public function index(){
        $status = $this->uri->segment(3);
        if(empty($status)){
            $status='ขอรับบริการ';
        }
        $data['pA'] =  $status;
        $data['status'] =  $status;
        $data['ReST'] = $this->B_Service_m->getTypeList();
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/service',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function type(){
        $data['pA'] = "ประเภท";
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/service_type',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function type_list(){
        $data['Re'] = $this->B_Service_m->getTypeList();
        $this->load->view('backoffice/service_type_fetch', $data);
    }

    public function type_insert_form(){ 
        $output='<div class="form-row">
                <div class="form-group col-12">
                    <label>ชื่อประเภทการบริการออนไลน์</label> 
                    <input type="text" id="st_name" name="st_name" class="form-control form-control-sm">
                </div>
            </div>';
        echo $output;
        exit;
    }

    public function type_insert_save(){ 
        $Re=$this->B_Service_m->getTypeInsertSave($this->input->POST());
        echo json_encode($Re);
    }

    public function type_edit_form(){ 
        $Re= $this->B_Service_m->getTypeEdit($this->input->POST('st_id'));
        foreach ($Re['Re_st'] as $row_Re_st);
        $output='<div class="form-row">
                <div class="form-group col-12">
                    <label>ชื่อประเภทการบริการออนไลน์</label> 
                    <input type="text" id="st_name" name="st_name" class="form-control form-control-sm" value="'.$row_Re_st->st_name.'">
                    <input type="hidden" id="st_id" name="st_id" value="'.$row_Re_st->st_id.'">
                </div>
            </div>';
        echo $output;
        exit;
    }

    public function type_edit_save(){ 
        $Re=$this->B_Service_m->getTypeEditSave($this->input->POST());
        echo json_encode($Re);
    }

    public function type_delete(){
        $this->db->trans_begin();
            $this->db->where('st_id', $this->input->POST('st_id'));
            $this->db->delete('tB_Service_type');
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

    public function service_detail(){
        $status = $this->uri->segment(3);
        $data['pA'] = $status;
        $data['status'] =  $status;
        $data['Re'] = $this->B_Service_m->getServiceDetail($this->uri->segment(5));
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/service_detail',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function service_delete(){ 

        $s_no = $this->input->POST('s_no');

        $this->db->select("*");
        $this->db->from("tB_Service");
        $this->db->where("s_no", $s_no);
        $Re_s = $this->db->get();
        foreach ($Re_s->result() as $row_Re_s);

        $this->db->select("*");
        $this->db->from("tB_Service_action");
        $this->db->where("s_no", $s_no);
        $Re_sa = $this->db->get();

        $this->db->trans_begin();

            $this->db->where('s_no', $s_no);
            $this->db->delete('tB_Service');

            $this->db->where('s_no', $s_no);
            $this->db->delete('tB_Service_action');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            if(!empty($row_Re_s->s_photo1) AND file_exists('public/images/service/'.$row_Re_s->s_photo1)){
                unlink('public/images/service/'.$row_Re_s->s_photo1);
            }
    
            if(!empty($row_Re_s->s_photo2) AND file_exists('public/images/service/'.$row_Re_s->s_photo2)){
                unlink('public/images/service/'.$row_Re_s->s_photo2);
            }
    
            foreach ($Re_sa->result() as $row_Re_sa){
                if(!empty($row_Re_sa->ca_photo1) AND file_exists('public/images/service/'.$row_Re_sa->ca_photo1)){
                    unlink('public/images/service/'.$row_Re_sa->ca_photo1);
                }
        
                if(!empty($row_Re_sa->ca_photo2) AND file_exists('public/images/service/'.$row_Re_sa->ca_photo2)){
                    unlink('public/images/service/'.$row_Re_sa->ca_photo2);
                }
            }
            
            $Response = array('action' => 'Y','output' => 'ลบรายการแจ้งร้องเรียนทุจริตและประพฤติมิชอบเรียบร้อย');
            echo json_encode($Response);
            exit;
        }
    }

    public function service_list(){

        $search = array(
            's_status' => trim($this->input->post('SH_status')),
            's_type' => trim($this->input->post('SH_type')),
            's_title' => trim($this->input->post('SH_title')),
            's_cus_name' => trim($this->input->post('SH_name')),
        );

        $this->load->library('pagination');
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Service/service_list');
        $config['total_rows'] = $this->B_Service_m->getServiceList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->B_Service_m->getServiceList($limit, $offset, $search, $count=false);
		$data['pagelinks'] = $this->pagination->create_links();
        $data['status'] =  trim($this->input->post('SH_status'));
        $this->load->view('backoffice/service_fetch', $data);
    }

    public function service_save(){
        $Re=$this->B_Service_m->getServiceSave($this->input->POST());
        echo json_encode($Re);
    }

}
