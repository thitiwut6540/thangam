<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_Function_m');
        $this->load->model('M_History_m');
        $this->load->model('M_Company_m');
        $this->load->model('M_Banner_m');
    }

	public function index(){

        $h1=$this->uri->segment(1);
        if($h1=='ทําเนียบนายกเทศมนตรี'){
            $type = 'P';
        }else if($h1=='ทําเนียบปลัดเทศบาล'){
            $type = 'C';
        }

        $data['type']=$h1;
        $data['pA']='history'.$type;
        $data['Re'] = $this->M_History_m->getList($type);
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main',$data);
        $this->load->view('history',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }

}
