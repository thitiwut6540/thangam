<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qa extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_Function_m');
        $this->load->model('M_Service_m');
        $this->load->model('M_Company_m');
        $this->load->model('M_Banner_m');
        $this->load->model('M_Qa_m');
    }

    public function index(){
        $data['Re'] = $this->M_Qa_m->getQA();
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main');
        $this->load->view('qa',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }
}
