<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('M_Function_m');
        $this->load->model('M_Service_m');
        $this->load->model('M_Company_m');
        $this->load->model('M_Banner_m');
        $this->load->model('M_Webboard_m');
    }

    public function index(){
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main');
        $this->load->view('webboard');
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }

    public function webboard_list(){
        $this->load->library('pagination');
        $search= '';
		$limit = 30;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config['base_url'] = base_url('Webboard/webboard_list');
        $config['total_rows'] = $this->M_Webboard_m->getWB($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->M_Webboard_m->getWB($limit, $offset, $search, $count=false);
        $data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('webboard_fetch', $data);
    }

    public function webboard_detail(){
        $wb_t_id = $this->uri->segment(3);
        $data['Re'] = $this->M_Webboard_m->getTopic($wb_t_id);
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main');
        $this->load->view('webboard_detail',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }

    public function comment_topic_list(){ 

        $this->load->library('pagination');
        $search = array(
            'wb_t_id' => trim($this->input->POST('wb_t_id')),
        );

		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('Webboard/comment_topic_list');
        $config['total_rows'] = $this->M_Webboard_m->getCommentTopic($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->M_Webboard_m->getCommentTopic($limit, $offset, $search, $count=false);
        $data['pagelinks'] = $this->pagination->create_links();

        $this->load->view('webboard_detail_topic_fetch', $data);
    }

    public function comment_topic_save(){

        if(!empty($_FILES['wb_p_photo']['name'])) {
            $filename = $_FILES['wb_p_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="WP".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName="";
        }
        $Re=$this->M_Webboard_m->getCommentSave($this->input->POST(),$photoName);

        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['wb_p_photo']['name'])) {
                $config['upload_path'] ='./public/images/webboard';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('wb_p_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/webboard/'.$data['file_name'];
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

    public function webboard_detail_sub(){
        $wb_t_id = $this->uri->segment(3);
        $wb_s_id = $this->uri->segment(5);
        $data['Re'] = $this->M_Webboard_m->getSub($wb_t_id,$wb_s_id);
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main');
        $this->load->view('webboard_detail_sub',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }

    public function comment_sub_list(){ 

        $this->load->library('pagination');
        $search = array(
            'wb_t_id' => trim($this->input->POST('wb_t_id')),
            'wb_s_id' => trim($this->input->POST('wb_s_id')),
        );

		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('Webboard/comment_sub_list');
        $config['total_rows'] = $this->M_Webboard_m->getCommentSub($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->M_Webboard_m->getCommentSub($limit, $offset, $search, $count=false);
        $data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('webboard_detail_sub_fetch', $data);
    }

    public function comment_sub_save(){

        if(!empty($_FILES['wb_p_photo']['name'])) {
            $filename = $_FILES['wb_p_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="WP".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName="";
        }
        $Re=$this->M_Webboard_m->getCommentSave($this->input->POST(),$photoName);

        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['wb_p_photo']['name'])) {
                $config['upload_path'] ='./public/images/webboard';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('wb_p_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/webboard/'.$data['file_name'];
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

}
