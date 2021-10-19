<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Lpa extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Lpa_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('backoffice/login', 'refresh');
        }
        $accesstype_no='400';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('backoffice/accesstype', 'refresh');
        }
    }

    public function index(){
        $data['pA'] = 'LPA';
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/lpa',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function lpa_list(){

        $search = '';
        $this->load->library('pagination');
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Lpa/lpa_list');
        $config['total_rows'] = $this->B_Lpa_m->getList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->B_Lpa_m->getList($limit, $offset, $search, $count=false);
		$data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('backoffice/lpa_fetch', $data);
    }

    public function lpa_insert_form(){ 
        $output='<div class="form-row">
                <div class="form-group col-12">
                    <label>ชื่อ LPA</label> 
                    <input type="text" id="lpa_name" name="lpa_name" class="form-control form-control-sm">
                </div>
                <div class="form-group col-12">
                    <label>ไฟล์ LPA (PDF)</label> 
                    <input type="file" id="lpa_file" name="lpa_file" class="form-control form-control-sm">
                </div>
            </div>';
        echo $output;
        exit;
    }

    public function lpa_insert_save(){ 

        if(!empty($_FILES['lpa_file']['name'])) {
            $filename = $_FILES['lpa_file']['name'];
            $exp = explode('.' , $filename);
            $exp2 = $exp[1];
            $photoName="LPA".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName="";
            $exp2 = '';
        }

        if($exp2=='pdf'){
            $Re=$this->B_Lpa_m->getInsertSave($this->input->POST(),$photoName);
            if($Re AND $Re['action']=='Y'){
                if(!empty($_FILES['lpa_file']['name'])) {
                    $config['upload_path'] ='./public/files/lpa';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 0;
                    $config['file_name'] = $photoName;
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('lpa_file')){
                        $data=$this->upload->data();
                    }
                }
            }
            echo json_encode($Re);
        }else{
            $Response = array('action' => 'N','output' => 'รับเฉพาะไฟล์ PDF เท่านั้น');
            echo json_encode($Response);
        }
    }

    public function lpa_delete(){

        $lpa_id=$this->input->post('lpa_id');
        $this->db->select("*");
        $this->db->from("tb_lpa");
        $this->db->where("lpa_id", $lpa_id);
        $Re1 = $this->db->get();
        foreach ($Re1->result() as $row1);

        $this->db->trans_begin();

            $this->db->where('lpa_id', $lpa_id);
            $this->db->delete('tb_lpa');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการได้');
            echo json_encode($Response);
            exit;
            
        }else{
            $this->db->trans_commit();

            if(!empty($row1->d_photo) AND file_exists('public/files/lpa/'.$row1->d_photo)){
                unlink('public/files/lpa/'.$row1->d_photo);
            }

            $Response = array('action' => 'Y','output' => 'ลบรายการเอกสารเรียบร้อย');
            echo json_encode($Response);
        }
    }
}
