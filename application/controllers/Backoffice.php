<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backoffice extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->model('B_Function_m');
        $this->load->model('B_Dashboard_m');
    }

	public function index(){
        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('backoffice/login', 'refresh');
        }

        $data['ReMT'] = $this->B_Dashboard_m->getMemType();
        $data['ReNT'] = $this->B_Dashboard_m->getNewsType();
        $data['ReST'] = $this->B_Dashboard_m->getSttType();
        $data['ReRMT'] = $this->B_Dashboard_m->getRmType();

        $tab=$this->uri->segment(3);
        if(!empty($tab)){
            $data['tab'] = $tab;
        }else{
            $data['tab'] = '';
        }

        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/dashboard',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function accesstype(){
        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('Backoffice/login', 'refresh');
        }
        $data['accesstype'] = '404';
        $data['ReMT'] = $this->B_Dashboard_m->getMemType();
        $data['ReNT'] = $this->B_Dashboard_m->getNewsType();
        $data['ReST'] = $this->B_Dashboard_m->getSttType();
        $data['ReRMT'] = $this->B_Dashboard_m->getRmType();
        
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/dashboard', $data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function login(){
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/login');
        $this->load->view('backoffice/template/a_footer');
    }

    public function login_check(){
        if($this->input->post('username') AND $this->input->post('password')){
            $this->load->model('B_Login_m');
            $u=$this->input->post('username');
            $p=$this->input->post('password');
            $data = $this->B_Login_m->check($u,$p);
            echo json_encode($data);
        }else{
            redirect('Backoffice/login', 'refresh');
        }
    }
}

