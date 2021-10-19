<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Performance extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Performance_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('backoffice/login', 'refresh');
        }
        $accesstype_no='305';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('backoffice/accesstype', 'refresh');
        }
    }

    public function performance(){
        $depart = $this->uri->segment(3);
        $data['depart'] = $depart;
        if(!empty($depart)){
            $data['depart_id'] = $this->B_Performance_m->getDepartByName($depart);
        }else{
            $data['depart_id'] = '';
        }

        $data['ReDPT'] = $this->B_Performance_m->getDPT();
    
        $data['pA'] = $depart;
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/performance',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function performance_insert(){
        $data['depart'] = $this->uri->segment(3);
        $data['depart_id'] = $this->B_Performance_m->getDepartByName($this->uri->segment(3));
        $data['ReDPT'] = $this->B_Performance_m->getDPT();
        $data['ReDepart'] = $this->B_Performance_m->getDepart();

        $data['pA'] = $this->uri->segment(3);
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/performance_insert',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function performance_insert_save(){ 

        $dd =$this->B_Function_m->dateEng($this->input->POST('pm_date_post'));
        $dt =$this->input->POST('pm_time');
        $pm_date=$dd." ".$dt;


        $this->db->trans_begin();
            $data = array(
                'pm_id' => NULL,
                'pm_status' => $this->input->POST('pm_status'),
                'pm_approve' => 'N',
                'dp_id' => $this->input->POST('dp_id'),
                'pm_name' => $this->input->POST('pm_name'),
                'pm_date' => $pm_date,
                'us_id' => $_SESSION[''.ANW_SS.'us_id'],
            );
            $this->db->insert('tb_performance', $data);
            $pm_id=$this->db->insert_id();

            if($this->B_Performance_m->emptyArray($_FILES['pm_f_file']['name'])){
                $count=count($_FILES['pm_f_file']['name']);
                $files = $_FILES;
                for($i = 0; $i<$count; $i++){
                    if(!empty($_FILES['pm_f_file']['name'][$i])){
                        $_FILES['temp']['name']= $files['pm_f_file']['name'][$i];
                        $_FILES['temp']['type']= $files['pm_f_file']['type'][$i];
                        $_FILES['temp']['tmp_name']= $files['pm_f_file']['tmp_name'][$i];
                        $_FILES['temp']['error']= $files['pm_f_file']['error'][$i];
                        $_FILES['temp']['size']= $files['pm_f_file']['size'][$i];
            
                        if(!empty($_FILES['pm_f_file']['name'][$i])) {
            
                            $config['upload_path'] = './public/files/performance'; 
                            $config['allowed_types'] = 'pdf';
                            $config['max_size'] = 0;
                            $config['file_name'] = "PF".date('ymdhis').rand(1000,9999);
                            $this->upload->initialize($config);
                            
                            if($this->upload->do_upload('temp')){
                                $data=$this->upload->data();
                                $file_ul=$data['file_name'];
                            }
                        }

                        $data = array(
                            'pm_f_id' => NULL,
                            'pm_id' => $pm_id,
                            'pm_f_file' => $file_ul,
                            'pm_f_name' => $_POST['pm_f_name'][$i],
                        );
                        $this->db->insert('tb_performance_file', $data);
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
            $Response = array('action' => 'Y','output' => 'บันทึกข้อมูลเรียบร้อย');
            echo json_encode($Response);
            exit;
        }

    }

    public function performance_add_file(){ 
        $id="1".rand(1000,9999);
        $output='<div id="'.$id.'" class="form-row"><div class="form-group col-4"><input type="file" name="pm_f_file[]" class="form-control form-control-sm"></div><div class="form-group col-4"><input type="text" name="pm_f_name[]" class="form-control form-control-sm" placeholder="ชื่อเรียกเอกสาร"/></div><div class="form-group col-4"><button type="button" class="btn btn-sm btn-danger btn_dele_file" data-id="'.$id.'"><i class="fas fa-minus"></i></button></div></div>';

        $Response = array('action' => 'Y','output' => $output);
        echo json_encode($Response);
        exit;
    }

    public function performance_list(){

        $search = array(
            'dp_id' => trim($this->input->POST('SH_dp_id')),
            'pm_name' => trim($this->input->post('SH_name')),
        );

        $this->load->library('pagination');
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Performance/performance_list');
        $config['total_rows'] = $this->B_Performance_m->getPmList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->B_Performance_m->getPmList($limit, $offset, $search, $count=false);
        $data['depart'] = $this->input->POST('SH_depart_name');
		$data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('backoffice/performance_fetch', $data);
    }


    public function performance_dele_photo(){
        $pm_id =$this->input->post('pm_id');
        $sql="SELECT * FROM tb_performance WHERE pm_id='$pm_id'";
        $Re = $this->db->query($sql);
        foreach ($Re->result() as $row);
        $delFile=$row->pm_photo;

        $this->db->trans_begin();
            $data = array(
                'pm_photo' => '',
            );
            $this->db->where('pm_id ', $pm_id);
            $this->db->update('tb_performance',$data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบ ภาพผลการดำเนินงาน ได้');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            if(!empty($delFile)){
                if(!empty($delFile) AND file_exists('public/images/performance/'.$delFile)){
                    unlink('public/images/performance/'.$delFile);
                }
            }
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }

    public function performance_dele_file(){
        $pm_f_id =$this->input->post('pm_f_id');
        $sql="SELECT * FROM tb_performance_file WHERE pm_f_id='$pm_f_id'";
        $Re = $this->db->query($sql);
        foreach ($Re->result() as $row);
        $delFile=$row->pm_f_file;

        $this->db->trans_begin();
            $this->db->where('pm_f_id ', $pm_f_id);
            $this->db->delete('tb_performance_file');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบ แนบไฟล์เอกสาร ได้');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            if(!empty($delFile)){
                if(!empty($delFile) AND file_exists('public/files/performance/'.$delFile)){
                    unlink('public/files/performance/'.$delFile);
                }
            }
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }
    

    public function performance_edit(){
        $data['depart'] = $this->uri->segment(3);
        $data['ReDPT'] = $this->B_Performance_m->getDPT();
        $data['ReDepart'] = $this->B_Performance_m->getDepart();
        $data['Re'] = $this->B_Performance_m->getPmEdit($this->uri->segment(5));

        $data['pA'] = $this->uri->segment(3);
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/performance_edit',$data);
        $this->load->view('backoffice/template/a_footer');
    }


    public function performance_edit_save(){ 

        $pm_id =$this->input->post('pm_id');
        $dd =$this->B_Function_m->dateEng($this->input->POST('pm_date_post'));
        $dt =$this->input->POST('pm_time');
        $pm_date=$dd." ".$dt;

        $this->db->trans_begin();
            $data = array(
                'pm_status' => $this->input->POST('pm_status'),
                'pm_approve' => 'N',
                'dp_id' => $this->input->POST('dp_id'),
                'pm_name' => $this->input->POST('pm_name'),
                'pm_date' => $pm_date,
                'us_id' => $_SESSION[''.ANW_SS.'us_id'],
            );
            $this->db->where('pm_id', $pm_id);
            $this->db->update('tb_performance', $data);

            if($this->B_Performance_m->emptyArray($_FILES['pm_f_file']['name'])){
                $count=count($_FILES['pm_f_file']['name']);
                $files = $_FILES;
                for($i = 0; $i<$count; $i++){
                    if(!empty($_FILES['pm_f_file']['name'][$i])){
                        $_FILES['temp']['name']= $files['pm_f_file']['name'][$i];
                        $_FILES['temp']['type']= $files['pm_f_file']['type'][$i];
                        $_FILES['temp']['tmp_name']= $files['pm_f_file']['tmp_name'][$i];
                        $_FILES['temp']['error']= $files['pm_f_file']['error'][$i];
                        $_FILES['temp']['size']= $files['pm_f_file']['size'][$i];
            
                        if(!empty($_FILES['pm_f_file']['name'][$i])) {
            
                            $config['upload_path'] = './public/files/performance'; 
                            $config['allowed_types'] = 'pdf';
                            $config['max_size'] = 0;
                            $config['file_name'] = "PF".date('ymdhis').rand(1000,9999);
                            $this->upload->initialize($config);
                            
                            if($this->upload->do_upload('temp')){
                                $data=$this->upload->data();
                                $file_ul=$data['file_name'];
                            }
                        }

                        $data = array(
                            'pm_f_id' => NULL,
                            'pm_id' => $pm_id,
                            'pm_f_file' => $file_ul,
                            'pm_f_name' => $_POST['pm_f_name'][$i],
                        );
                        $this->db->insert('tb_performance_file', $data);
                    }
                }
            }

        //exit;
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกแก้ไขข้อมูลได้กรุณาตรวจสอบ');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'บันทึกแก้ไขข้อมูลเรียบร้อย');
            echo json_encode($Response);
            exit;
        }

    }

    public function performance_delete(){

        $pm_id=$this->input->post('pm_id');
        $this->db->select("*");
        $this->db->from("tb_performance_file");
        $this->db->where("pm_id", $pm_id);
        $Re2 = $this->db->get();
        $total2=$Re2->num_rows();
        foreach ($Re2->result() as $row2);


        $this->db->trans_begin();

            $this->db->where('pm_id', $pm_id);
            $this->db->delete('tb_performance');

            $this->db->where('pm_id', $pm_id);
            $this->db->delete('tb_performance_file');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการผลการดำเนินงานได้');
            echo json_encode($Response);
            exit;
            
        }else{
            $this->db->trans_commit();
            if($total2>0){
                foreach ($Re2->result() as $row2) {
                    if(!empty($row2->pm_f_file) AND file_exists('public/files/performance/'.$row2->pm_f_file)){
                        unlink('public/files/performance/'.$row2->pm_f_file);
                    }
                }
            }

            $Response = array('action' => 'Y','output' => 'ลบรายการผลการดำเนินงานเรียบร้อย');
            echo json_encode($Response);
        }

    }

    public function performance_approve(){ 

        $pm_id =$this->input->post('pm_id');
        $pm_approve =$this->input->post('status');
        if($pm_approve=='Y'){
            $tx='อนุมัติ';
        }else{
            $tx='ยกเลิกอนุมัติ';
        }

        $this->db->trans_begin();
            $data = array(
                'pm_approve' => $pm_approve,
            );
            $this->db->where('pm_id', $pm_id);
            $this->db->update('tb_performance', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถ '.$tx.' ได้กรุณาตรวจสอบ');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => ''.$tx.' รายการเรียบร้อย');
            echo json_encode($Response);
            exit;
        }

    }

}
