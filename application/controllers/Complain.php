<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complain extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('M_Function_m');
        $this->load->model('M_Complain_m');
        $this->load->model('M_Company_m');
        $this->load->model('M_Banner_m');
        $this->load->model('M_Notify_m');
    }

    public function index(){
        $data['Re'] = $this->M_Complain_m->getComplainType();
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main');
        $this->load->view('complain',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }

    public function Complain_save(){ 

        if(!empty($_FILES['c_photo1']['name'])) {
            $filename = $_FILES['c_photo1']['name'];
            $exp = explode('.' , $filename);
            $photoName1="C".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{$photoName1="";}

        if(!empty($_FILES['c_photo2']['name'])) {
            $filename = $_FILES['c_photo2']['name'];
            $exp2 = explode('.' , $filename);
            $photoName2="C".date('YmdHis').rand(1000,9999).".".$exp2[1];
        }else{$photoName2="";}

        $Re=$this->M_Complain_m->getComplainInsert($this->input->POST(),$photoName1,$photoName2);
        
        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['c_photo1']['name'])) {
                $config['upload_path'] ='./public/images/complain';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName1;
                $this->upload->initialize($config);
                if($this->upload->do_upload('c_photo1')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/complain/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 820;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }

            if(!empty($_FILES['c_photo2']['name'])) {
                $config['upload_path'] ='./public/images/complain';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName2;
                $this->upload->initialize($config);
                if($this->upload->do_upload('c_photo2')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/complain/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 820;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
        }
        echo json_encode($Re);
    }

    public function Complain_list(){
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main');
        $this->load->view('complain_list');
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }

    public function Complain_list_fetch(){
        $search = '';
        $this->load->library('pagination');
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('M_Complain/complain_list_fetch');
        $config['total_rows'] = $this->M_Complain_m->getComplainList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->M_Complain_m->getComplainList($limit, $offset, $search, $count=false);
		$data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('complain_list_fetch', $data);
    }


    public function Complain_detail(){
        $data['Re'] = $this->M_Complain_m->getComplain($this->uri->segment(3));

        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main');
        $this->load->view('complain_detail',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }

}
