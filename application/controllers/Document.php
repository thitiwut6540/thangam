<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_Function_m');
        $this->load->model('M_Document_m');
        $this->load->model('M_Company_m');
        $this->load->model('M_Banner_m');
    }

    public function index(){
        $data['Re'] = $this->M_Document_m->getDocumentType();
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main');
        $this->load->view('document',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }
}
