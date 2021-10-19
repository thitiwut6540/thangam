<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller {

    public function __construct(){
        parent::__construct();
		$this->load->model('M_Function_m');
        $this->load->model('M_Info_m');
        $this->load->model('M_Company_m');
        $this->load->model('M_Banner_m');
    }

	public function index(){
        $data['pA']='info';
        $data['pAS']=$this->uri->segment(2);
        $data['title']=$this->uri->segment(2);
        $data['Re'] = $this->M_Info_m->getDetail($this->uri->segment(2));
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main',$data);
        $this->load->view('info',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }
    

}
