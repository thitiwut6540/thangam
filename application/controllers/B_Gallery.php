<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Gallery extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Gallery_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('Backoffice/login', 'refresh');
        }
        $accesstype_no='300';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('/backoffice/accesstype', 'refresh');
        }
    }

    public function index(){
        $data['pA'] = "m_gallery";
        $data['ReDPT'] = $this->B_Gallery_m->getDPT();

        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/gallery',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function gallery(){
        $depart_name= $this->uri->segment(3);
        if($depart_name == 'ทั้งหมด'){
            $dp_id='';
        }else{
            $dp_id= $this->B_Gallery_m->getDPID($depart_name);
        }
        $data['pA'] = $depart_name;
        $data['ReDPT'] = $this->B_Gallery_m->getDPT();
        $data['depart_id'] = $dp_id;
        $data['depart_name'] = $depart_name;

        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/gallery_list',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function gallery_list(){

        $this->load->library('pagination');
        $search = array(
            'dp_id' => trim($this->input->POST('id')),
            'gal_name' => trim($this->input->post('name')),
        );
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Gallery/gallery_list');
        $config['total_rows'] = $this->B_Gallery_m->getList($limit, $offset, $search, $count=true);
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
        $data['depart_name']=trim($this->input->POST('depart'));
		$data['Re'] = $this->B_Gallery_m->getList($limit, $offset, $search, $count=false);
		$data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('backoffice/gallery_fetch', $data);
    }

    public function gallery_approve(){
        $gal_id=$this->input->POST('gal_id');

        if($_SESSION[''.ANW_SS.'us_approve']=='Y'){
            $this->db->trans_begin();
                $data = array(
                    'gal_approve' => 'Y',
                );
                $this->db->where('gal_id', $gal_id);
                $this->db->update('tb_gal', $data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $Response = array('action' => 'N','output' => 'ไม่สามารถอนุมัติแสดงรายการได้กรุณาตรวจสอบ');
                echo json_encode($Response);
                exit;
            }else{
                $this->db->trans_commit();
                $Response = array('action' => 'Y','output' => 'อนุมัติแสดงรายการเรียบร้อย');
                echo json_encode($Response);
                exit;
            }
        }else{
            $Response = array('action' => 'N','output' => 'ไม่มีสิทธิในการอนุมัติ');
            echo json_encode($Response);
            exit;
        }
        
    }

    public function gallery_insert(){
        $data['pA'] = $this->uri->segment(3);
        $data['ReDPT'] = $this->B_Gallery_m->getDPT();
        $data['ReD'] = $this->B_Gallery_m->getDepart();
        $data['depart_name'] = $this->uri->segment(3);

        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/gallery_insert',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function gallery_insert_save(){ 

        if(!empty($_FILES['gal_photo']['name'])) {
            $config['upload_path'] ='./public/images/gallery';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 0;
            $config['file_name'] = "GL".date('YmdHis').rand(1000,9999);
            $this->upload->initialize($config);
            if($this->upload->do_upload('gal_photo')){
                $data=$this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = './public/images/gallery/'.$data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width']         = 920;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $gal_p=$data['file_name'];
            }else{$gal_p=NULL;}
        }else{$gal_p=NULL;}

        $this->db->trans_begin();
        $data = array(
            'gal_id' => NULL,
            'gal_name' => $this->input->POST('gal_name'),
            'gal_detail' => $this->input->POST('gal_detail'),
            'gal_date' => date("Y-m-d H:i:s"),
            'gal_photo' => $gal_p,
            'us_name' => $_SESSION[''.ANW_SS.'us_name'],
            'dp_id' => $this->input->POST('dp_id'),
            'gal_approve' => 'N',
        );
        $this->db->insert('tb_gal', $data);
        $g_id=$this->db->insert_id();

        if($this->B_Gallery_m->emptyArray($_FILES['gal_p_photo']['name'])){
            $count=count($_FILES['gal_p_photo']['name']);
            $files = $_FILES;
            for($i = 0; $i<$count; $i++){
                if(!empty($_FILES['gal_p_photo']['name'][$i])){
                    
                    $_FILES['temp']['name']= $files['gal_p_photo']['name'][$i];
                    $_FILES['temp']['type']= $files['gal_p_photo']['type'][$i];
                    $_FILES['temp']['tmp_name']= $files['gal_p_photo']['tmp_name'][$i];
                    $_FILES['temp']['error']= $files['gal_p_photo']['error'][$i];
                    $_FILES['temp']['size']= $files['gal_p_photo']['size'][$i];
        
                    if(!empty($_FILES['gal_p_photo']['name'][$i])) {
                        $config['upload_path'] = './public/images/gallery/'; 
                        $config['allowed_types'] = 'jpg|png';
                        $config['max_size'] = 0;
                        $config['file_name'] = "GL".date('ymdhis').rand(1000,9999);
                        $this->upload->initialize($config);
                        
                        if($this->upload->do_upload('temp')){
                            $data=$this->upload->data();
                            $config['image_library'] = 'gd2';
                            $config['source_image'] = './public/images/gallery/'.$data['file_name'];
                            $config['create_thumb'] = false;
                            $config['maintain_ratio'] = true;
                            $config['width']= 920;
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();
                            $gal_p_photo=$data['file_name'];
                        }
                    }

                    $data = array(
                        'galp_id' => NULL,
                        'galp_photo' => $gal_p_photo,
                        'galp_detail' => NULL,
                        'gal_id' => $g_id,
                    );
                    $this->db->insert('tb_galp', $data);
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

    public function gallery_edit(){
        $gal_id= $this->uri->segment(5);
        $data['pA'] = $this->uri->segment(3);
        $data['ReDPT'] = $this->B_Gallery_m->getDPT();
        $data['ReD'] = $this->B_Gallery_m->getDepart();
        $data['Re'] = $this->B_Gallery_m->getEdit($gal_id);
        $data['depart_name'] = $this->uri->segment(3);

        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/gallery_edit',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function gallery_edit_save(){
        $gal_id=$this->input->POST('gal_id');
        $h_gal_photo=$this->input->POST('h_gal_photo');

        $sql="SELECT * FROM tb_gal WHERE gal_id='$gal_id'";
        $Re_gal = $this->db->query($sql);
        foreach ($Re_gal->result() as $row_Re_gal);
        $delePhoto = $row_Re_gal->gal_photo;

        if(!empty($_FILES['gal_photo']['name'])) {
            if(!empty($delePhoto) AND file_exists('public/images/gallery/'.$delePhoto)){
                unlink('public/images/gallery/'.$delePhoto);
            }

            $config['upload_path'] ='./public/images/gallery';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 0;
            $config['file_name'] = "GL".date('YmdHis').rand(1000,9999);
            $this->upload->initialize($config);
            if($this->upload->do_upload('gal_photo')){
                $data=$this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = './public/images/gallery/'.$data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width']         = 920;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $gal_p=$data['file_name'];
            }else{$gal_p=$h_gal_photo;}
        }else{$gal_p=$h_gal_photo;}


        $this->db->trans_begin();
            $data = array(
                'gal_name' => $this->input->POST('gal_name'),
                'gal_detail' => $this->input->POST('gal_detail'),
                'gal_date' => date("Y-m-d H:i:s"),
                'gal_photo' => $gal_p,
                'us_name' => $_SESSION[''.ANW_SS.'us_name'],
                'dp_id' => $this->input->POST('dp_id'),
                'gal_approve' => 'N',
                );
            $this->db->where('gal_id', $gal_id);
            $this->db->update('tb_gal', $data);

            if($this->B_Gallery_m->emptyArray($_FILES['gal_p_photo']['name'])){
                $count=count($_FILES['gal_p_photo']['name']);
                $files = $_FILES;
                for($i = 0; $i<$count; $i++){
                    if(!empty($_FILES['gal_p_photo']['name'][$i])){
                        
                        $_FILES['temp']['name']= $files['gal_p_photo']['name'][$i];
                        $_FILES['temp']['type']= $files['gal_p_photo']['type'][$i];
                        $_FILES['temp']['tmp_name']= $files['gal_p_photo']['tmp_name'][$i];
                        $_FILES['temp']['error']= $files['gal_p_photo']['error'][$i];
                        $_FILES['temp']['size']= $files['gal_p_photo']['size'][$i];
            
                        if(!empty($_FILES['gal_p_photo']['name'][$i])) {
            
                            $config['upload_path'] = './public/images/gallery/'; 
                            $config['allowed_types'] = 'jpg|png';
                            $config['max_size'] = 0;
                            $config['file_name'] = "GL".date('ymdhis').rand(1000,9999);
                            $this->upload->initialize($config);
                            
                            if($this->upload->do_upload('temp')){
                                $data=$this->upload->data();
                                $config['image_library'] = 'gd2';
                                $config['source_image'] = './public/images/gallery/'.$data['file_name'];
                                $config['create_thumb'] = false;
                                $config['maintain_ratio'] = true;
                                $config['width']= 920;
                                $config['height']= 920;
                                $this->image_lib->initialize($config);
                                $this->image_lib->resize();
                                $gal_p_photo=$data['file_name'];
                            }
                        }

                        $data = array(
                            'galp_photo' => $gal_p_photo,
                            'galp_detail' => NULL,
                            'gal_id' => $gal_id,
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

    public function gallery_dele_photo(){
        $galp_id=$this->input->post('galp_id');

        $this->db->trans_begin();
            $sql="SELECT * FROM tb_galp WHERE galp_id='$galp_id'";
            $Re_gp = $this->db->query($sql);
            foreach ($Re_gp->result() as $row_Re_gp);
            $delePhoto = $row_Re_gp->galp_photo;

            $this->db->where('galp_id', $galp_id);
            $this->db->delete('tb_galp');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรูปภาพได้');
            echo json_encode($Response);
        }else{
            $this->db->trans_commit();
            if(!empty($delePhoto)){
                if(!empty($delePhoto) AND file_exists('public/images/gallery/'.$delePhoto)){
                    unlink('public/images/gallery/'.$delePhoto);
                }
            }
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }

    public function gallery_delete(){
        $gal_id=$this->input->post('gal_id');

        $sql="SELECT * FROM tb_gal WHERE gal_id='$gal_id'";
        $Re1 = $this->db->query($sql);
        foreach ($Re1->result() as $row1);
        $delePhoto = $row1->gal_photo;

        $sql="SELECT * FROM tb_galp WHERE gal_id='$gal_id'";
        $Re2 = $this->db->query($sql);

        $this->db->trans_begin();
            $this->db->where('gal_id', $gal_id);
            $this->db->delete('tb_gal');

            $this->db->where('gal_id', $gal_id);
            $this->db->delete('tb_galp');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการแกลเลอรี่ภาพได้');
            echo json_encode($Response);
            exit;
            
        }else{
            $this->db->trans_commit();
            if(!empty($delePhoto)){
                if(!empty($delePhoto) AND file_exists('public/images/gallery/'.$delePhoto)){
                    unlink('public/images/gallery/'.$delePhoto);
                }
            }
            foreach ($Re2->result() as $row2){
                if(!empty($row2->galp_photo) AND file_exists('public/images/gallery/'.$row2->galp_photo)){
                    unlink('public/images/gallery/'.$row2->galp_photo);
                }
            }
            $Response = array('action' => 'Y','output' => 'ลบรายการสินค้าโอทอปเรียบร้อย');
            echo json_encode($Response);
        }

    }
}
