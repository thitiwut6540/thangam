<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('M_Function_m');
        $this->load->model('M_Service_m');
        $this->load->model('M_Company_m');
        $this->load->model('M_Banner_m');
        $this->load->model('M_Notify_m');
    }

    public function index(){
        $data['Re'] = $this->M_Service_m->getServiceType();
        $this->load->view('template/a_header');
        $this->load->view('template/a_nav');
        $this->load->view('template/a_menu_main');
        $this->load->view('service',$data);
        $this->load->view('template/a_menu_link');
        $this->load->view('template/a_footer');
    }

    public function Service_save(){ 

        if(!empty($_FILES['s_file']['name'])) {
            $filename = $_FILES['s_file']['name'];
            $exp = explode('.' , $filename);
            $fileName1="SV".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{$fileName1="";}

        $Re=$this->M_Service_m->getServiceInsert($this->input->POST(),$fileName1);
        
        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['s_file']['name'])) {
                $config['upload_path'] ='./public/files/service';
                $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                $config['max_size'] = 0;
                $config['file_name'] = $fileName1;
                $this->upload->initialize($config);
                if($this->upload->do_upload('s_file')){
                    $data=$this->upload->data();
                }
            }
        }
        echo json_encode($Re);
    }
}
