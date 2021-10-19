<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Qa extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->model('B_Function_m');
        $this->load->model('B_Qa_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('backoffice/login', 'refresh');
        }
        $accesstype_no='306';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('backoffice/accesstype', 'refresh');
        }
    }

    public function index(){
        $data['pA'] = 'ถามและตอบ';
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/qa',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function qa_insert(){
        $data['pA'] = 'ถามและตอบ';
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/qa_insert',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function qa_insert_save(){ 

        $this->db->trans_begin();
            $data = array(
                'qa_id' => NULL,
                'qa_question' => $this->input->POST('qa_question'),
                'qa_answer' => $this->input->POST('qa_answer'),
            );
            $this->db->insert('tb_qa', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'บันทึกข้อมูลเรียบร้อย');
            echo json_encode($Response);
            exit;
        }

    }

    public function qa_list(){

        $search = '';
        $this->load->library('pagination');
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Qa/qa_list');
        $config['total_rows'] = $this->B_Qa_m->getQaList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->B_Qa_m->getQaList($limit, $offset, $search, $count=false);
		$data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('backoffice/qa_fetch', $data);
    }

    public function qa_edit(){

        $data['Re'] = $this->B_Qa_m->getQaEdit($this->uri->segment(4));
        $data['pA'] = 'ถามและตอบ';
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/qa_edit',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function qa_edit_save(){ 

        $qa_id =$this->input->post('qa_id');

        $this->db->trans_begin();
            $data = array(
                'qa_question' => $this->input->POST('qa_question'),
                'qa_answer' => $this->input->POST('qa_answer'),
            );
            $this->db->where('qa_id', $qa_id);
            $this->db->update('tb_qa', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกแก้ไขข้อมูลได้กรุณาตรวจสอบ');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'บันทึกแก้ไขข้อมูลเรียบร้อย');
            echo json_encode($Response);
            exit;
        }

    }

    public function qa_delete(){

        $qa_id=$this->input->post('qa_id');
        $this->db->trans_begin();

            $this->db->where('qa_id', $qa_id);
            $this->db->delete('tb_qa');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการถามและตอบได้');
            echo json_encode($Response);
            exit;
            
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'ลบรายการถามและตอบเรียบร้อย');
            echo json_encode($Response);
        }
    }
}
