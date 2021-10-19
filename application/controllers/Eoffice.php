<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eoffice extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_Function_m');
        $this->load->model('M_Service_m');
        $this->load->model('M_Company_m');
        $this->load->model('M_Banner_m');
        $this->load->model('M_Eoffice_m');
    }

    public function index(){
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main');
        $this->load->view('eoffice');
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }


    public function logout(){

        $_SESSION['E'.ANW_SS.'mem_id'] = NULL;
        $_SESSION['E'.ANW_SS.'mem_name'] = NULL;

        unset($_SESSION['E'.ANW_SS.'mem_id']);
        unset($_SESSION['E'.ANW_SS.'mem_name']);

        $this->session->sess_destroy();
        redirect('Eoffice', 'refresh');
    }

    public function login(){
        $u=$this->input->post('username');
        $p=$this->input->post('password');
        $data = $this->M_Eoffice_m->login_check($u,$p);
        if($data==true){
            $Response = array('action' => 'Y');
            echo json_encode($Response);
            exit;
        }else{
            $Response = array('action' => 'N','output' => 'กรุณาตรวจสอบ Username หรือ password ครั้ง');
            echo json_encode($Response);
            exit;
        }
    }

    public function eoffice_password_edit_form(){

        if(!$this->session->userdata('E'.ANW_SS.'mem_id') 
        OR !$this->session->userdata('E'.ANW_SS.'mem_name')) {
            redirect('Eoffice', 'refresh');
        }

        $mem_id=$this->input->post('mem_id');
        $output='<div class="container-fluid p-3">
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="mem_d_pass">Password เดิม</label> 
                        <input type="password" id="mem_d_pass" name="mem_d_pass" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="mem_n_pass">Password ใหม่</label> 
                        <input type="password" id="mem_n_pass" name="mem_n_pass" class="form-control form-control-sm">
                        <input type="hidden" id="mem_id" name="mem_id" value="'.$mem_id.'">
                    </div>
                </div>
            </div>';

        $Response = array('action' => 'Y','output' => $output);
        echo json_encode($Response);
        exit;
    }

    public function eoffice_password_edit_save(){

        if(!$this->session->userdata('E'.ANW_SS.'mem_id') 
        OR !$this->session->userdata('E'.ANW_SS.'mem_name')) {
            redirect('Eoffice', 'refresh');
        }

        $Re=$this->M_Eoffice_m->getPasswordSave($this->input->POST());
        echo json_encode($Re);
    }

    /* new ----------------------- */
    public function eoffice_new(){

        if(!$this->session->userdata('E'.ANW_SS.'mem_id') 
        OR !$this->session->userdata('E'.ANW_SS.'mem_name')) {
            redirect('Eoffice', 'refresh');
        }

        $data['er_status'] = 'N';
        $data['mem_id'] = $_SESSION['E'.ANW_SS.'mem_id'];
        $data['topic'] = "ส่งหนังสือใหม่";
        $data['Re_dp'] = $this->M_Eoffice_m->getDepart();
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_eoffice_menu_main',$data);
        $this->load->view('e_office_new', $data);
        $this->load->view('template/a_eoffice_menu_link');
        $this->load->view('template/a_footer');
    }

    public function eoffice_new_detail(){

        if(!$this->session->userdata('E'.ANW_SS.'mem_id') 
        OR !$this->session->userdata('E'.ANW_SS.'mem_name')) {
            redirect('Eoffice', 'refresh');
        }

        $data['er_status'] = 'N';
        $data['mem_id'] = $_SESSION['E'.ANW_SS.'mem_id'];
        $data['topic'] = "ส่งหนังสือใหม่";
        
        if(!$this->session->userdata('SS_mem_id')) {
            redirect(base_url('Eoffice/ส่งหนังสือใหม่'));
        }
        $data['Re_ty'] = $this->M_Eoffice_m->getSentType(); 
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_eoffice_menu_main',$data);
        $this->load->view('e_office_new_detail', $data);
        $this->load->view('template/a_eoffice_menu_link');
        $this->load->view('template/a_footer');

    }

    public function eoffice_new_step1(){
        if(!$this->session->userdata('E'.ANW_SS.'mem_id') 
        OR !$this->session->userdata('E'.ANW_SS.'mem_name')) {
            redirect('Eoffice', 'refresh');
        }

        $_SESSION['SS_mem_id'] = $this->input->POST('chk_m_dp');
        if($_SESSION['SS_mem_id']){
            $Response = array('action' => 'Y');
            echo json_encode($Response);
            exit;
        } else {
            $Response = array('action' => 'N','output' => 'กรุณาเลือกผู้รับจดหมาย');
            echo json_encode($Response);
            exit;
        }
    }

    public function eoffice_new_step2(){
        if(!$this->session->userdata('E'.ANW_SS.'mem_id') 
        OR !$this->session->userdata('E'.ANW_SS.'mem_name')) {
            redirect('Eoffice', 'refresh');
        }

        $Re=$this->M_Eoffice_m->getSentSave();
        echo json_encode($Re);
    }

    /* receive -------------------- */
    public function eoffice_receive(){

        if(!$this->session->userdata('E'.ANW_SS.'mem_id') 
        OR !$this->session->userdata('E'.ANW_SS.'mem_name')) {
            redirect('Eoffice', 'refresh');
        }

        $data['er_status'] = 'N';
        $data['mem_id'] = $_SESSION['E'.ANW_SS.'mem_id'];
        $data['topic'] = $this->uri->segment(2);

        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_eoffice_menu_main',$data);
        $this->load->view('e_office_receive_list', $data);
        $this->load->view('template/a_eoffice_menu_link');
        $this->load->view('template/a_footer');
    }

    public function eoffice_receive_list(){

        if(!$this->session->userdata('E'.ANW_SS.'mem_id') 
        OR !$this->session->userdata('E'.ANW_SS.'mem_name')) {
            redirect('Eoffice', 'refresh');
        }

        $this->load->library('pagination');
        $search = array(
            'er_status' => $this->input->POST('er_status'),
            'mem_id' => $this->input->POST('mem_id'),
        );
		$limit = 30;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('Eoffice/eoffice_receive_list');
        $config['total_rows'] = $this->M_Eoffice_m->getReceiveList($limit, $offset, $search, $count=true);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 2;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="" class="current_page">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = 'ถัดไป <i class="fas fa-angle-right"></i>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="fas fa-angle-left"></i> ย้อนกลับ';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_link'] = '<i class="fas fa-angle-double-left"></i> หน้าแรก';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'สุดท้าย <i class="fas fa-angle-double-right"></i>';
		$config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['Re'] = $this->M_Eoffice_m->getReceiveList($limit, $offset, $search, $count=false);
        $data['pagelinks'] = $this->pagination->create_links();
        $data['topic'] = $this->input->POST('topic');
        $this->load->view('e_office_receive_list_fetch', $data);

    }

    public function eoffice_receive_detail(){

        if(!$this->session->userdata('E'.ANW_SS.'mem_id') 
        OR !$this->session->userdata('E'.ANW_SS.'mem_name')) {
            redirect('Eoffice', 'refresh');
        }
        $data['er_status'] = 'N';
        $data['mem_id'] = $_SESSION['E'.ANW_SS.'mem_id'];
        $data['topic'] = $this->uri->segment(2);

        $er_id = $this->uri->segment(4);
        $data['Re'] = $this->M_Eoffice_m->getReceiveDetail($er_id);
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_eoffice_menu_main', $data);
        $this->load->view('e_office_receive_detail', $data);
        $this->load->view('template/a_eoffice_menu_link');
        $this->load->view('template/a_footer');
    }

    public function eoffice_receive_open(){

        if(!$this->session->userdata('E'.ANW_SS.'mem_id') 
        OR !$this->session->userdata('E'.ANW_SS.'mem_name')) {
            redirect('Eoffice', 'refresh');
        }

        $Re=$this->M_Eoffice_m->getReceiveOpen();
        echo json_encode($Re);

    }

    public function eoffice_receive_confirm(){

        if(!$this->session->userdata('E'.ANW_SS.'mem_id') 
        OR !$this->session->userdata('E'.ANW_SS.'mem_name')) {
            redirect('Eoffice', 'refresh');
        }

        $Re=$this->M_Eoffice_m->getReceiveConfirm();
        echo json_encode($Re);

    }

    public function eoffice_open(){

        if(!$this->session->userdata('E'.ANW_SS.'mem_id') 
        OR !$this->session->userdata('E'.ANW_SS.'mem_name')) {
            redirect('Eoffice', 'refresh');
        }

        $data['er_status'] = 'R';
        $data['mem_id'] = $_SESSION['E'.ANW_SS.'mem_id'];
        $data['topic'] = $this->uri->segment(2);

        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_eoffice_menu_main',$data);
        $this->load->view('e_office_receive_list', $data);
        $this->load->view('template/a_eoffice_menu_link');
        $this->load->view('template/a_footer');
    }

    public function eoffice_confirm(){

        if(!$this->session->userdata('E'.ANW_SS.'mem_id') 
        OR !$this->session->userdata('E'.ANW_SS.'mem_name')) {
            redirect('Eoffice', 'refresh');
        }

        $data['er_status'] = 'S';
        $data['mem_id'] = $_SESSION['E'.ANW_SS.'mem_id'];
        $data['topic'] = $this->uri->segment(2);

        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_eoffice_menu_main',$data);
        $this->load->view('e_office_receive_list', $data);
        $this->load->view('template/a_eoffice_menu_link');
        $this->load->view('template/a_footer');
    }


    /* sent -------------------- */
    public function eoffice_sent(){

        if(!$this->session->userdata('E'.ANW_SS.'mem_id') 
        OR !$this->session->userdata('E'.ANW_SS.'mem_name')) {
            redirect('Eoffice', 'refresh');
        }

        $data['mem_id'] = $_SESSION['E'.ANW_SS.'mem_id'];
        $data['topic'] = $this->uri->segment(2);

        $data['Re_dp'] = $this->M_Eoffice_m->getDepart();
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_eoffice_menu_main',$data);
        $this->load->view('e_office_sent', $data);
        $this->load->view('template/a_eoffice_menu_link');
        $this->load->view('template/a_footer');
    }

    public function eoffice_sent_detail(){

        if(!$this->session->userdata('E'.ANW_SS.'mem_id') 
        OR !$this->session->userdata('E'.ANW_SS.'mem_name')) {
            redirect('Eoffice', 'refresh');
        }

        $data['mem_id'] = $_SESSION['E'.ANW_SS.'mem_id'];
        $data['topic'] = $this->uri->segment(2);
        $data['Re_dc'] = $this->M_Eoffice_m->getSentDetail($this->uri->segment(4));
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_eoffice_menu_main',$data);
        $this->load->view('e_office_sent_detail', $data);
        $this->load->view('template/a_eoffice_menu_link');
        $this->load->view('template/a_footer');

    }

    public function eoffice_sent_list(){

        if(!$this->session->userdata('E'.ANW_SS.'mem_id') 
        OR !$this->session->userdata('E'.ANW_SS.'mem_name')) {
            redirect('Eoffice', 'refresh');
        }

        $this->load->library('pagination');
        $search = array(
            'mem_id' => $this->input->POST('mem_id'),
        );
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('Eoffice/eoffice_sent_list');
        $config['total_rows'] = $this->M_Eoffice_m->getSentList($limit, $offset, $search, $count=true);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 2;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="" class="current_page">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = 'ถัดไป <i class="fas fa-angle-right"></i>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="fas fa-angle-left"></i> ย้อนกลับ';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_link'] = '<i class="fas fa-angle-double-left"></i> หน้าแรก';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'สุดท้าย <i class="fas fa-angle-double-right"></i>';
		$config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['Re'] = $this->M_Eoffice_m->getSentList($limit, $offset, $search, $count=false);
        $data['pagelinks'] = $this->pagination->create_links();
        $data['topic'] = $this->input->POST('topic');
        $this->load->view('e_office_sent_fetch', $data);

    }

    public function eoffice_delete(){

        $ed_id=$this->input->post('ed_id');

        $this->db->select("*");
        $this->db->from("tb_e_file");
        $this->db->where("ed_id", $ed_id);
        $Re2 = $this->db->get();
        $total2=$Re2->num_rows();

        $this->db->trans_begin();

            $this->db->where('ed_id', $ed_id);
            $this->db->delete('tb_e_doc');

            $this->db->where('ed_id', $ed_id);
            $this->db->delete('tb_e_file');

            $this->db->where('ed_id', $ed_id);
            $this->db->delete('tb_e_receive');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการหนังสือที่ส่งได้');
            echo json_encode($Response);
            exit;
            
        }else{
            $this->db->trans_commit();

            if($total2>0){
                foreach ($Re2->result() as $row2) {
                    if(!empty($row2->ef_name) AND file_exists('public/files/eoffice/'.$row2->ef_name)){
                        unlink('public/files/eoffice/'.$row2->ef_name);
                    }
                }
            }

            $Response = array('action' => 'Y','output' => 'ลบรายการหนังสือเรียบร้อย');
            echo json_encode($Response);
        }

    }

}
