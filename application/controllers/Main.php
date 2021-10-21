<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->model('M_Function_m');
        $this->load->model('M_Main_m');
        $this->load->model('M_Menu_m');
        $this->load->model('M_Company_m');
    }

	public function index(){

        $data['Re_ntm']=$this->M_Main_m->getNewsMain();

        $data['pA'] = "index";
        $this->load->view('include/a_header');
        $this->load->view('index', $data);
        $this->load->view('include/a_footer');

    }

    
	
}
