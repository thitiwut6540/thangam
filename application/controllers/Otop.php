<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Otop extends CI_Controller {

    public function __construct(){
        parent::__construct();
		$this->load->model('M_Function_m');
        $this->load->model('M_Otop_m');
        $this->load->model('M_Company_m');
        $this->load->model('M_Banner_m');
    }

	public function index(){
        $data['pA']='otop';
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main',$data);
        $this->load->view('otop',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }
    
    public function otop_list(){

        $this->load->library('pagination');
        $search = '';
		$limit = 30;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('Otop/list');
        $config['total_rows'] = $this->M_Otop_m->getOtop($limit, $offset, $search, $count=true);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 0;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="" class="current_page">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = 'Next <i class="fas fa-angle-right"></i>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="fas fa-angle-left"></i> Previous';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_link'] = '<i class="fas fa-angle-double-left"></i> First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last <i class="fas fa-angle-double-right"></i>';
		$config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);
		$data['Re'] = $this->M_Otop_m->getOtop($limit, $offset, $search, $count=false);
		$data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('otop_fetch', $data);
    }

	public function otop_detail(){
		$id = $this->uri->segment(3);
		$data['Re'] = $this->M_Otop_m->getDetail($id);
        $data['pA']='otop';
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main',$data);
        $this->load->view('otop_detail',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }

}
