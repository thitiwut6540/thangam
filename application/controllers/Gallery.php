<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->model('M_Function_m');
        $this->load->model('M_Main_m');
    }

	public function index(){

        $data['pA'] = "all gallery";
        $this->load->view('include/a_header');
        $this->load->view('gallery');
        $this->load->view('include/a_footer');

    }

    public function หน่วยงาน(){

        $data['pA'] = "detail";
        $this->load->view('include/a_header');
        $this->load->view('gallery');
        $this->load->view('include/a_footer');

    }

    public function รายการ(){

        $data['pA'] = "detail";
        $this->load->view('include/a_header');
        $this->load->view('gallery_detail');
        $this->load->view('include/a_footer');

    }

    
	
}
