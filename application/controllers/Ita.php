<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ita extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_Function_m');
        $this->load->model('M_Service_m');
        $this->load->model('M_Company_m');
        $this->load->model('M_Banner_m');
        $this->load->model('M_Ita_m');
    }

    public function index(){
        $data['Re'] = $this->M_Ita_m->getItaYearDetail();
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main');
        $this->load->view('ita',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }

}
