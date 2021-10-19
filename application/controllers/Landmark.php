<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landmark extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_Function_m');
        $this->load->model('M_Landmark_m');
        $this->load->model('M_Company_m');
        $this->load->model('M_Banner_m');
    }

    public function index(){
        $data['ReM'] = $this->M_Landmark_m->getTypeList();
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main');
        $this->load->view('landmark',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }

    public function landmark_list(){

        $this->load->library('pagination');
        $search = array(
            'land_t_id' => $this->input->POST('SH_type'),
        );
		$limit = 30;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('Landmark/landmark_list');
        $config['total_rows'] = $this->M_Landmark_m->getLandList($limit, $offset, $search, $count=true);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 2;
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
		$data['Re'] = $this->M_Landmark_m->getLandList($limit, $offset, $search, $count=false);
		$data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('landmark_fetch', $data);
    }

    public function landmark_detail(){

        $data['ReM'] = $this->M_Landmark_m->getTypeList();
        $data['Re'] = $this->M_Landmark_m->getLand($this->uri->segment(3));
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main');
        $this->load->view('landmark_detail',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }
}
