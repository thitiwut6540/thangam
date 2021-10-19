<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

    public function __construct(){
        parent::__construct();
		$this->load->model('M_Function_m');
        $this->load->model('M_Department_m');
        $this->load->model('M_Company_m');
        $this->load->model('M_Banner_m');
    }


	public function department_detail(){

        $dptype_id =$this->M_Department_m->getDepartTypeID($this->uri->segment(2));
        $dp_id =$this->M_Department_m->getDepartID($this->uri->segment(3));

        $data['pA']='depart'.$dptype_id;
        $data['pAS']=$this->uri->segment(3);
        $data['type']=$this->uri->segment(2);
        $data['title']=$this->uri->segment(3);
		$data['Re'] = $this->M_Department_m->getDepart($dptype_id,$dp_id);

        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main',$data);
        $this->load->view('department',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }

}
