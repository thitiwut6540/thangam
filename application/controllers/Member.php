<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

    public function __construct(){
        parent::__construct();
		$this->load->model('M_Function_m');
        $this->load->model('M_Member_m');
        $this->load->model('M_Company_m');
        $this->load->model('M_Banner_m');
    }

	public function member_detail(){

        $memtype_id =$this->M_Member_m->getMemTypeID($this->uri->segment(2));
        $dp_id =$this->M_Member_m->getDepartID($this->uri->segment(3));
        $data['pA']='mem'.$memtype_id;
        $data['pAS']=$this->uri->segment(3);
        $data['type']=$this->uri->segment(2);
        $data['title']=$this->uri->segment(3);
        $data['memtype_id']=$memtype_id;
        $data['Re'] = $this->M_Member_m->getMember($memtype_id,$dp_id);

        if(!empty($dp_id)){
            $data['dp_id']=$dp_id;
        }

        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main',$data);
        $this->load->view('member',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }

}
