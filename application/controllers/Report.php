<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('M_Function_m');
        $this->load->model('M_Report_m');
    }

    public function list(){ 

        $this->load->library('pagination');
        $search = '';
		$limit = 20;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('Report/list');
        $config['total_rows'] = $this->M_Report_m->getList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->M_Report_m->getList($limit, $offset, $search, $count=false);
        $data['pagelinks'] = $this->pagination->create_links();
        $data['action'] = "List";
        $this->load->view('report_fetch', $data);
    }

    public function insert(){ 

        $this->db->trans_begin();
            $data = array(
                'report_detail' => $this->input->POST('report_detail'),
                'report_name' => $this->input->POST('report_name'),
                'report_tel' => $this->input->POST('report_tel'),
                'report_date' => date("Y-m-d H:i:s"),
                'report_status' => 'ยังไม่ได้ดำเนินการ',
            );
            $this->db->insert('tb_report', $data);
            $report_id=$this->db->insert_id();

            // file --
            if($this->M_Report_m->emptyArray($_FILES['report_file']['name'])){
                $count=count($_FILES['report_file']['name']);
                $files = $_FILES;
                for($i = 0; $i<$count; $i++){
                    if(!empty($_FILES['report_file']['name'][$i])){
                        
                        $_FILES['temp']['name']= $files['report_file']['name'][$i];
                        $_FILES['temp']['type']= $files['report_file']['type'][$i];
                        $_FILES['temp']['tmp_name']= $files['report_file']['tmp_name'][$i];
                        $_FILES['temp']['error']= $files['report_file']['error'][$i];
                        $_FILES['temp']['size']= $files['report_file']['size'][$i];
            
                        if(!empty($_FILES['report_file']['name'][$i])) {
            
                            $config['upload_path'] = './public/file/report'; 
                            $config['allowed_types'] = 'pdf|jpg|jpeg|png';
                            $config['max_size'] = 0;
                            $config['file_name'] = "FL".date('ymdhis').rand(1000,9999);
                            $this->upload->initialize($config);
                            
                            if($this->upload->do_upload('temp')){
                                $data=$this->upload->data();
                                $file_ul=$data['file_name'];
                            }
                        }

                        $data = array(
                            'report_id' => $report_id,
                            'rf_name' => $file_ul,
                        );
            
                        $this->db->insert('tb_report_file', $data);
                    }
                }
            }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'แจ้งร้องเรียนร้องทุกข์เรียบร้อย');
            echo json_encode($Response);
            exit;
        }
    }

}
