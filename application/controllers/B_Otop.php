<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Otop extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Otop_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('Backoffice/login', 'refresh');
        }
        $accesstype_no='205';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('/backoffice/accesstype', 'refresh');
        }
    }

    public function index(){
        $data['pA'] = "m_otop";
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/otop_list',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function otop_list(){ 

        $this->load->library('pagination');
        $search = '';
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Otop/otop_list');
        $config['total_rows'] = $this->B_Otop_m->getList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->B_Otop_m->getList($limit, $offset, $search, $count=false);
        $data['pagelinks'] = $this->pagination->create_links();
        $data['action'] = "List";
        $this->load->view('backoffice/otop_fetch', $data);
    }

    public function otop_insert(){
        $data['pA'] = "m_otop";
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/otop_insert',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function otop_insert_save(){ 

        if(!empty($_FILES['otop_photo']['name'])) {
            $config['upload_path'] ='./public/images/otop';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 0;
            $config['file_name'] = "OT".date('YmdHis').rand(1000,9999);
            $this->upload->initialize($config);
            if($this->upload->do_upload('otop_photo')){
                $data=$this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = './public/images/otop_photo/'.$data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width']         = 920;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $otop_p=$data['file_name'];
            }else{$otop_p=NULL;}
        }else{$otop_p=NULL;}

        $this->db->trans_begin();
            $data = array(
                'otop_id' => NULL,
                'otop_approve' => 'N',
                'otop_status' => $this->input->POST('otop_status'),
                'otop_name' => $this->input->POST('otop_name'),
                'otop_detail' => $this->input->POST('otop_detail'),
                'otop_price' => $this->input->POST('otop_price'),
                'otop_photo' => $otop_p,
                'otop_date' => date("Y-m-d H:i:s"),
            );
            $this->db->insert('tb_otop', $data);
            $otop_id=$this->db->insert_id();

            if($this->B_Otop_m->emptyArray($_FILES['otop_p_photo']['name'])){
                $count=count($_FILES['otop_p_photo']['name']);
                $files = $_FILES;
                for($i = 0; $i<$count; $i++){
                    if(!empty($_FILES['otop_p_photo']['name'][$i])){
                        
                        $_FILES['temp']['name']= $files['otop_p_photo']['name'][$i];
                        $_FILES['temp']['type']= $files['otop_p_photo']['type'][$i];
                        $_FILES['temp']['tmp_name']= $files['otop_p_photo']['tmp_name'][$i];
                        $_FILES['temp']['error']= $files['otop_p_photo']['error'][$i];
                        $_FILES['temp']['size']= $files['otop_p_photo']['size'][$i];
            
                        if(!empty($_FILES['otop_p_photo']['name'][$i])) {
            
                            $config['upload_path'] = './public/images/otop/'; 
                            $config['allowed_types'] = 'jpg|png';
                            $config['max_size'] = 0;
                            $config['file_name'] = "OT".date('ymdhis').rand(1000,9999);
                            $this->upload->initialize($config);
                            
                            if($this->upload->do_upload('temp')){
                                $data=$this->upload->data();
                                $config['image_library'] = 'gd2';
                                $config['source_image'] = './public/images/otop/'.$data['file_name'];
                                $config['create_thumb'] = false;
                                $config['maintain_ratio'] = true;
                                $config['width']= 920;
                                $this->image_lib->initialize($config);
                                $this->image_lib->resize();
                                $otop_p_photo=$data['file_name'];
                            }
                        }
                        $data = array(
                            'otop_p_id' => NULL,
                            'otop_p_photo' => $otop_p_photo,
                            'otop_id' => $otop_id,
                        );
                        $this->db->insert('tb_otop_photo', $data);
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

    public function otop_edit(){
        $id = $this->uri->segment(4);
        $data['pA'] = "m_otop";
        $data['Re'] = $this->B_Otop_m->getEdit($id);
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/otop_edit',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function otop_edit_save(){
        $otop_id=$this->input->POST('otop_id');
        $h_otop_photo=$this->input->POST('h_otop_photo');

        $sql="SELECT * FROM tb_otop WHERE otop_id='$otop_id'";
        $Re_otop = $this->db->query($sql);
        foreach ($Re_otop->result() as $row_Re_otop);

        if(!empty($_FILES['otop_photo']['name'])) {
            if(!empty($row_Re_otop->otop_photo) AND file_exists('public/images/otop/'.$row_Re_otop->otop_photo)){
                unlink('public/images/otop/'.$row_Re_otop->otop_photo);
            }
            $config['upload_path'] ='./public/images/otop';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 0;
            $config['file_name'] = "OT".date('YmdHis').rand(1000,9999);
            $this->upload->initialize($config);
            if($this->upload->do_upload('otop_photo')){
                $data=$this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = './public/images/otop/'.$data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width']         = 920;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $otop_p=$data['file_name'];
            }else{$otop_p=$h_otop_photo;}
        }else{$otop_p=$h_otop_photo;}


        $this->db->trans_begin();
            $data = array(
                'otop_approve' => 'N',
                'otop_status' => $this->input->POST('otop_status'),
                'otop_name' => $this->input->POST('otop_name'),
                'otop_detail' => $this->input->POST('otop_detail'),
                'otop_price' => $this->input->POST('otop_price'),
                'otop_photo' => $otop_p,
                'otop_date' => date("Y-m-d H:i:s"),
            );

            $this->db->where('otop_id', $otop_id);
            $this->db->update('tb_otop', $data);

            if($this->B_Otop_m->emptyArray($_FILES['otop_p_photo']['name'])){
                $count=count($_FILES['otop_p_photo']['name']);
                $files = $_FILES;
                for($i = 0; $i<$count; $i++){
                    if(!empty($_FILES['otop_p_photo']['name'][$i])){
                        
                        $_FILES['temp']['name']= $files['otop_p_photo']['name'][$i];
                        $_FILES['temp']['type']= $files['otop_p_photo']['type'][$i];
                        $_FILES['temp']['tmp_name']= $files['otop_p_photo']['tmp_name'][$i];
                        $_FILES['temp']['error']= $files['otop_p_photo']['error'][$i];
                        $_FILES['temp']['size']= $files['otop_p_photo']['size'][$i];
            
                        if(!empty($_FILES['otop_p_photo']['name'][$i])) {
            
                            $config['upload_path'] = './public/images/otop/'; 
                            $config['allowed_types'] = 'jpg|png';
                            $config['max_size'] = 0;
                            $config['file_name'] = "OT".date('ymdhis').rand(1000,9999);
                            $this->upload->initialize($config);
                            
                            if($this->upload->do_upload('temp')){
                                $data=$this->upload->data();
                                $config['image_library'] = 'gd2';
                                $config['source_image'] = './public/images/otop/'.$data['file_name'];
                                $config['create_thumb'] = false;
                                $config['maintain_ratio'] = true;
                                $config['width']= 920;
                                $this->image_lib->initialize($config);
                                $this->image_lib->resize();
                                $otop_p_photo=$data['file_name'];
                            }
                        }

                        $data = array(
                            'otop_p_id' => NULL,
                            'otop_p_photo' => $otop_p_photo,
                            'otop_id' => $otop_id,
                        );
                        $this->db->insert('tb_galp', $data);
                    }
                }
            }

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

    public function dele_otp_photo(){
        $otop_p_id=$this->input->post('otop_p_id');

        $this->db->trans_begin();
            $sql="SELECT * FROM tb_otop_photo WHERE otop_p_id='$otop_p_id'";
            $Re_otop = $this->db->query($sql);
            foreach ($Re_otop->result() as $row_Re_otop);
            $delePhoto = $row_Re_otop->otop_p_photo;

            $this->db->where('otop_p_id', $otop_p_id);
            $this->db->delete('tb_otop_photo');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรูปภาพได้');
            echo json_encode($Response);
        }else{
            $this->db->trans_commit();
            if(!empty($delePhoto)){
                if(!empty($delePhoto) AND file_exists('public/images/otop/'.$delePhoto)){
                    unlink('public/images/otop/'.$delePhoto);
                }
            }
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }

    public function otop_approve(){ 

        $otop_id =$this->input->post('otop_id');
        $otop_approve =$this->input->post('status');
        if($otop_approve=='Y'){
            $tx='อนุมัติ';
        }else{
            $tx='ยกเลิกอนุมัติ';
        }

        $this->db->trans_begin();
            $data = array(
                'otop_approve' => $otop_approve,
            );
            $this->db->where('otop_id', $otop_id);
            $this->db->update('tb_otop', $data);

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

    public function otop_delete(){
        $otop_id=$this->input->post('otop_id');

        $sql="SELECT * FROM tb_otop WHERE otop_id='$otop_id'";
        $Re1 = $this->db->query($sql);
        foreach ($Re1->result() as $row1);
        $delePhoto = $row1->otop_photo;

        $sql="SELECT * FROM tb_otop_photo WHERE otop_id='$otop_id'";
        $Re2 = $this->db->query($sql);

        $this->db->trans_begin();
            $this->db->where('otop_id', $otop_id);
            $this->db->delete('tb_otop');

            $this->db->where('otop_id', $otop_id);
            $this->db->delete('tb_otop_photo');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการ สินค้า Otop ได้');
            echo json_encode($Response);
            exit;
            
        }else{
            $this->db->trans_commit();
            if(!empty($delePhoto)){
                if(!empty($delePhoto) AND file_exists('public/images/otop/'.$delePhoto)){
                    unlink('public/images/otop/'.$delePhoto);
                }
            }
            foreach ($Re2->result() as $row2){
                if(!empty($row2->otop_p_photo) AND file_exists('public/images/otop/'.$row2->otop_p_photo)){
                    unlink('public/images/otop/'.$row2->otop_p_photo);
                }
            }
            $Response = array('action' => 'Y','output' => 'ลบรายการสินค้าโอทอปเรียบร้อย');
            echo json_encode($Response);
        }

    }
}
