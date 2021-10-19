<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signbook extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_Function_m');
        $this->load->model('M_Signbook_m');
        $this->load->model('M_Company_m');
        $this->load->model('M_Banner_m');
        $this->load->library('image_lib');
    }

	public function index(){

        $data['pA']='Signbook';
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main',$data);
        $this->load->view('signbook',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }

	public function signbook_list(){

        $search = '';
        $this->load->library('pagination');
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('Signbook/signbook_list');
        $config['total_rows'] = $this->M_Signbook_m->getSbList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->M_Signbook_m->getSbList($limit, $offset, $search, $count=false);
		$data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('signbook_fetch', $data);
    }

	public function signbook_detail(){
        $data['pA']='Signbook';
        $data['st_id']=$this->uri->segment(2);
        $data['Re'] = $this->M_Signbook_m->getSb($this->uri->segment(2));

        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main',$data);
        $this->load->view('signbook_detail',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }

    public function signbook_sign_list(){

        $search = array(
            'sb_id' => trim($this->input->post('SH_sb_id')),
        );

        $this->load->library('pagination');
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('Signbook/signbook_sign_list');
        $config['total_rows'] = $this->M_Signbook_m->getSblList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->M_Signbook_m->getSblList($limit, $offset, $search, $count=false);
		$data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('signbook_sign_fetch', $data);
    }

    public function signbook_sign_save(){ 
        $Re=$this->M_Signbook_m->getSblSave($this->input->POST());
        echo json_encode($Re);
    }
}
