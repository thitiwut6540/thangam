<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Research extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('M_Function_m');
        $this->load->model('M_Research_m');
        $this->load->model('M_Company_m');
        $this->load->model('M_Banner_m');
    }

    public function index(){
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main');
        $this->load->view('research');
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }

    public function research_save(){ 
        $Re=$this->M_Research_m->getSave($this->input->POST());
        echo json_encode($Re);
    }
}
