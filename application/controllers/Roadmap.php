<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roadmap extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_Function_m');
        $this->load->model('M_Roadmap_m');
        $this->load->model('M_Company_m');
        $this->load->model('M_Banner_m');
        $this->load->library('image_lib');
    }

	public function index(){

        $data['pA']='roadmap';
        $data['pAS']=$this->uri->segment(2);
        $data['type']=$this->uri->segment(2);
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main',$data);
        $this->load->view('roadmap',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }

	public function roadmap_list(){

        $this->load->library('pagination');
        $search = array(
			'rm_t_id' => $this->M_Roadmap_m->getRmTypeID($this->input->POST('SH_type')),
        );
		$limit = 30;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('Roadmap/roadmap_list');
        $config['total_rows'] = $this->M_Roadmap_m->getRmList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->M_Roadmap_m->getRmList($limit, $offset, $search, $count=false);
		$data['pagelinks'] = $this->pagination->create_links();
		$data['type'] = $this->input->POST('SH_type');
        $this->load->view('roadmap_fetch', $data);
    }

	public function roadmap_detail(){
        $data['pA']='roadmap';
        $data['pAS']=$this->uri->segment(2);
        $data['type']=$this->uri->segment(2);
        $data['Re'] = $this->M_Roadmap_m->getRm($this->uri->segment(4));

        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main',$data);
        $this->load->view('roadmap_detail',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }










}
