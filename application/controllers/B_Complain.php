<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Complain extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Complain_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('backoffice/login', 'refresh');
        }
        $accesstype_no='402';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('backoffice/accesstype', 'refresh');
        }
    }

    public function index(){
        $status = $this->uri->segment(3);
        if(empty($status)){
            $status='แจ้งเรื่อง';
            $url1='backoffice/complain_new';
        }else if($status =='แจ้งเรื่อง'){
            $url1='backoffice/complain_new';
        }else if($status =='รับเรื่อง'){
            $url1='backoffice/complain_approve';
        }else if($status =='ดำเนินการ'){
            $url1='backoffice/complain_working';
        }else if($status =='เสร็จสิ้น'){
            $url1='backoffice/complain_success';
        }else if($status=='ไม่รับแจ้ง'){
            $url1='backoffice/complain_cancel';
        }
        $data['pA'] =  $status;
        $data['status'] =  $status;
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view($url1,$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function type(){
        $data['pA'] = "ประเภท";
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/complain_type',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function type_list(){
        $data['Re'] = $this->B_Complain_m->getTypeList();
        $this->load->view('backoffice/complain_type_fetch', $data);
    }

    public function type_insert_form(){ 
        $output='<div class="form-row">
                <div class="form-group col-12">
                    <label>ชื่อประเภทเรื่องร้องเรียนร้องทุกข์</label> 
                    <input type="text" id="ct_name" name="ct_name" class="form-control form-control-sm">
                </div>
            </div>';
        echo $output;
        exit;
    }

    public function type_insert_save(){ 
        $Re=$this->B_Complain_m->getTypeInsertSave($this->input->POST());
        echo json_encode($Re);
    }

    public function type_edit_form(){ 
        $Re= $this->B_Complain_m->getTypeEdit($this->input->POST('ct_id'));
        foreach ($Re['Re_ct'] as $row_Re_ct);
        $output='<div class="form-row">
                <div class="form-group col-12">
                    <label>ชื่อประเภทเรื่องร้องเรียนร้องทุกข์</label> 
                    <input type="text" id="ct_name" name="ct_name" class="form-control form-control-sm" value="'.$row_Re_ct->ct_name.'">
                    <input type="hidden" id="ct_id" name="ct_id" value="'.$row_Re_ct->ct_id.'">
                </div>
            </div>';
        echo $output;
        exit;
    }

    public function type_edit_save(){ 
        $Re=$this->B_Complain_m->getTypeEditSave($this->input->POST());
        echo json_encode($Re);
    }

    public function type_delete(){
        $this->db->trans_begin();
            $this->db->where('ct_id', $this->input->POST('ct_id'));
            $this->db->delete('tb_complain_type');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการได้');
            echo json_encode($Response);
            exit;
            
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'ลบรายการเรียบร้อย');
            echo json_encode($Response);
        }
    }

    public function complain_detail(){
        $data['pA'] = $this->uri->segment(3);
        $data['Re'] = $this->B_Complain_m->getComplainDetail($this->uri->segment(5));
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/complain_detail',$data);
        $this->load->view('backoffice/template/a_footer');
    }


    public function complain_action(){
        $status = $this->uri->segment(3);
        if(empty($status)){
            $status='แจ้งเรื่อง';
            $url1='backoffice/complain_new_action';
        }else if($status =='แจ้งเรื่อง'){
            $url1='backoffice/complain_new_action';
        }else if($status =='รับเรื่อง'){
            $url1='backoffice/complain_approve_action';
        }else if($status =='ดำเนินการ'){
            $url1='backoffice/complain_working_action';
        }else if($status =='เสร็จสิ้น'){
            $url1='backoffice/complain_success_action';
        }else if($status =='ไม่รับแจ้ง'){
            $url1='backoffice/complain_cancel_action';
        }

        $data['pA'] = $status;
        $data['status'] =  $status;
        $data['Re'] = $this->B_Complain_m->getComplainDetail($this->uri->segment(5));
        $data['ReDP'] = $this->B_Complain_m->getDepartList();
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view($url1,$data);
        $this->load->view('backoffice/template/a_footer');
    }


    public function complain_action_delete(){ 

        $c_id = $this->input->POST('c_id');
        $ca_id = $this->input->POST('ca_id');
        $c_status = $this->input->POST('c_status');

        if($c_status=='รับเรื่อง'){
            $new_status='แจ้งเรื่อง';
        } else if($c_status=='ดำเนินการ'){
            $new_status='รับเรื่อง';
        } else if($c_status=='เสร็จสิ้น'){
            $new_status='ดำเนินการ';
        }

        $this->db->select("*");
        $this->db->from("tb_complain_action");
        $this->db->where("ca_id", $ca_id);
        $Re_ca = $this->db->get();
        foreach ($Re_ca->result() as $row_Re_ca);

        $this->db->trans_begin();
            $data1 = array(
                'c_status' => $new_status,
            );
            $this->db->where('c_id', $c_id);
            $this->db->update('tb_complain', $data1);

            $this->db->where('ca_id', $ca_id);
            $this->db->delete('tb_complain_action');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการได้กรุณาตรวจสอบ');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();

            if(!empty($row_Re_ca->ca_photo1) AND file_exists('public/images/complain/'.$row_Re_ca->ca_photo1)){
                unlink('public/images/complain/'.$row_Re_ca->ca_photo1);
            }
    
            if(!empty($row_Re_ca->ca_photo2) AND file_exists('public/images/complain/'.$row_Re_ca->ca_photo2)){
                unlink('public/images/complain/'.$row_Re_ca->ca_photo2);
            }
        
            $Response = array('action' => 'Y','status' => $new_status,'output' => 'ลบรายการเรียบร้อย');
            echo json_encode($Response);
            exit;
        }
    }

    public function complain_action_photo_delete(){ 

        $ca_id = $this->input->POST('ca_id');
        $photo = $this->input->POST('photo');

        $this->db->select("*");
        $this->db->from("tb_complain_action");
        $this->db->where("ca_id", $ca_id);
        $Re_ca = $this->db->get();
        foreach ($Re_ca->result() as $row_Re_ca);

        $this->db->trans_begin();

            if($photo=='1'){
                $delPhoto=$row_Re_ca->ca_photo1;
                $data1 = array('ca_photo1' => '');
            }else if($photo=='2'){
                $delPhoto=$row_Re_ca->ca_photo2;
                $data1 = array('ca_photo2' => '');
            }
            $this->db->where('ca_id', $ca_id);
            $this->db->update('tb_complain_action', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรูปภาพได้กรุณาตรวจสอบ');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            if(!empty($delPhoto) AND file_exists('public/images/complain/'.$delPhoto)){
                unlink('public/images/complain/'.$delPhoto);
            }
            $Response = array('action' => 'Y','output' => 'ลบรูปภาพเรียบร้อย');
            echo json_encode($Response);
            exit;
        }
    }

    public function complain_delete(){ 

        $c_no = $this->input->POST('c_no');

        $this->db->select("*");
        $this->db->from("tb_complain");
        $this->db->where("c_no", $c_no);
        $Re_c = $this->db->get();
        foreach ($Re_c->result() as $row_Re_c);

        $this->db->select("*");
        $this->db->from("tb_complain_action");
        $this->db->where("c_no", $c_no);
        $Re_ca = $this->db->get();

        $this->db->trans_begin();

            $this->db->where('c_no', $c_no);
            $this->db->delete('tb_complain');

            $this->db->where('c_no', $c_no);
            $this->db->delete('tb_complain_action');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            if(!empty($row_Re_c->c_photo1) AND file_exists('public/images/complain/'.$row_Re_c->c_photo1)){
                unlink('public/images/complain/'.$row_Re_c->c_photo1);
            }
    
            if(!empty($row_Re_c->c_photo2) AND file_exists('public/images/complain/'.$row_Re_c->c_photo2)){
                unlink('public/images/complain/'.$row_Re_c->c_photo2);
            }
    
            foreach ($Re_ca->result() as $row_Re_ca){
                if(!empty($row_Re_ca->ca_photo1) AND file_exists('public/images/complain/'.$row_Re_ca->ca_photo1)){
                    unlink('public/images/complain/'.$row_Re_ca->ca_photo1);
                }
        
                if(!empty($row_Re_ca->ca_photo2) AND file_exists('public/images/complain/'.$row_Re_ca->ca_photo2)){
                    unlink('public/images/complain/'.$row_Re_ca->ca_photo2);
                }
            }
            
            $Response = array('action' => 'Y','output' => 'ลบรายการแจ้งร้องเรียนทุจริตและประพฤติมิชอบเรียบร้อย');
            echo json_encode($Response);
            exit;
        }
    }

    public function complain_new_list(){

        $search = array(
            'c_status' => trim($this->input->post('SH_status')),
            'c_title' => trim($this->input->post('SH_title')),
            'c_cus_name' => trim($this->input->post('SH_name')),
        );

        $this->load->library('pagination');
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Complain/complain_new_list');
        $config['total_rows'] = $this->B_Complain_m->getComplainList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->B_Complain_m->getComplainList($limit, $offset, $search, $count=false);
		$data['pagelinks'] = $this->pagination->create_links();
        $data['status'] =  trim($this->input->post('SH_status'));
        $this->load->view('backoffice/complain_new_fetch', $data);
    }

    public function complain_new_action(){
        $Re=$this->B_Complain_m->getNewSave($this->input->POST());
        echo json_encode($Re);
    }

    public function complain_approve_list(){

        $search = array(
            'c_status' => trim($this->input->post('SH_status')),
            'c_title' => trim($this->input->post('SH_title')),
            'c_cus_name' => trim($this->input->post('SH_name')),
        );

        $this->load->library('pagination');
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Complain/complain_approve_list');
        $config['total_rows'] = $this->B_Complain_m->getComplainList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->B_Complain_m->getComplainList($limit, $offset, $search, $count=false);
		$data['pagelinks'] = $this->pagination->create_links();
        $data['status'] =  trim($this->input->post('SH_status'));
        $this->load->view('backoffice/complain_approve_fetch', $data);
    }

    public function complain_approve_edit(){
        $id=$this->input->post('id');
        $data['Re']=$this->B_Complain_m->getAction($id);
        $this->load->view('backoffice/complain_approve_edit',$data);
    }

    public function complain_approve_edit_save(){
        $Re=$this->B_Complain_m->getApproveEditSave($this->input->POST());
        echo json_encode($Re);
    }

    public function complain_approve_action(){ 

        if(!empty($_FILES['ca_photo1']['name'])) {
            $filename = $_FILES['ca_photo1']['name'];
            $exp = explode('.' , $filename);
            $photoName1="CA".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName1="";
        }

        if(!empty($_FILES['ca_photo2']['name'])) {
            $filename = $_FILES['ca_photo2']['name'];
            $exp = explode('.' , $filename);
            $photoName2="CA".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName2="";
        }

        $Re=$this->B_Complain_m->getApproveSave($this->input->POST(),$photoName1,$photoName2);

        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['ca_photo1']['name'])) {
                $config['upload_path'] ='./public/images/complain';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName1;
                $this->upload->initialize($config);
                if($this->upload->do_upload('ca_photo1')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/complain/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 920;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
            if(!empty($_FILES['ca_photo2']['name'])) {
                $config['upload_path'] ='./public/images/complain';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName2;
                $this->upload->initialize($config);
                if($this->upload->do_upload('ca_photo2')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/complain/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 920;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
            
        }
        echo json_encode($Re);
    }

    public function complain_working_list(){

        $search = array(
            'c_status' => trim($this->input->post('SH_status')),
            'c_title' => trim($this->input->post('SH_title')),
            'c_cus_name' => trim($this->input->post('SH_name')),
        );

        $this->load->library('pagination');
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Complain/complain_working_list');
        $config['total_rows'] = $this->B_Complain_m->getComplainList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->B_Complain_m->getComplainList($limit, $offset, $search, $count=false);
		$data['pagelinks'] = $this->pagination->create_links();
        $data['status'] =  trim($this->input->post('SH_status'));
        $this->load->view('backoffice/complain_working_fetch', $data);
    }

    public function complain_working_edit(){
        $id=$this->input->post('id');
        $data['Re']=$this->B_Complain_m->getAction($id);
        $data['ReDP'] = $this->B_Complain_m->getDepartList();
        $this->load->view('backoffice/complain_working_edit',$data);
    }

    public function complain_working_edit_save(){ 

        if(!empty($_FILES['ca_photo1']['name'])) {
            $filename = $_FILES['ca_photo1']['name'];
            $exp = explode('.' , $filename);
            $photoName1="CA".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName1=$this->input->POST('h_ca_photo1');
        }

        if(!empty($_FILES['ca_photo2']['name'])) {
            $filename = $_FILES['ca_photo2']['name'];
            $exp = explode('.' , $filename);
            $photoName2="CA".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName2=$this->input->POST('h_ca_photo2');
        }

        $Re=$this->B_Complain_m->getWorkingEditSave($this->input->POST(),$photoName1,$photoName2);

        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['ca_photo1']['name'])) {
                $config['upload_path'] ='./public/images/complain';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName1;
                $this->upload->initialize($config);
                if($this->upload->do_upload('ca_photo1')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/complain/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 920;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
            if(!empty($_FILES['ca_photo2']['name'])) {
                $config['upload_path'] ='./public/images/complain';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName2;
                $this->upload->initialize($config);
                if($this->upload->do_upload('ca_photo2')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/complain/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 920;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
            
        }
        echo json_encode($Re);
    }

    public function complain_working_action(){ 

        if(!empty($_FILES['ca_photo1']['name'])) {
            $filename = $_FILES['ca_photo1']['name'];
            $exp = explode('.' , $filename);
            $photoName1="CA".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName1="";
        }

        if(!empty($_FILES['ca_photo2']['name'])) {
            $filename = $_FILES['ca_photo2']['name'];
            $exp = explode('.' , $filename);
            $photoName2="CA".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName2="";
        }

        $Re=$this->B_Complain_m->getWorkingSave($this->input->POST(),$photoName1,$photoName2);

        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['ca_photo1']['name'])) {
                $config['upload_path'] ='./public/images/complain';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName1;
                $this->upload->initialize($config);
                if($this->upload->do_upload('ca_photo1')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/complain/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 920;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
            if(!empty($_FILES['ca_photo2']['name'])) {
                $config['upload_path'] ='./public/images/complain';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName2;
                $this->upload->initialize($config);
                if($this->upload->do_upload('ca_photo2')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/complain/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 920;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
            
        }
        echo json_encode($Re);
    }

    public function complain_success_list(){

        $search = array(
            'c_status' => trim($this->input->post('SH_status')),
            'c_title' => trim($this->input->post('SH_title')),
            'c_cus_name' => trim($this->input->post('SH_name')),
        );
        
        $this->load->library('pagination');
        $limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $config['base_url'] = base_url('B_Complain/complain_success_list');
        $config['total_rows'] = $this->B_Complain_m->getComplainList($limit, $offset, $search, $count=true);
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
        $data['Re'] = $this->B_Complain_m->getComplainList($limit, $offset, $search, $count=false);
        $data['pagelinks'] = $this->pagination->create_links();
        $data['status'] =  trim($this->input->post('SH_status'));
        $this->load->view('backoffice/complain_success_fetch', $data);
    }
        
    public function complain_success_edit(){
        $id=$this->input->post('id');
        $data['Re']=$this->B_Complain_m->getAction($id);
        $data['ReDP'] = $this->B_Complain_m->getDepartList();
        $this->load->view('backoffice/complain_success_edit',$data);
    }
        
    public function complain_success_edit_save(){ 
        
        if(!empty($_FILES['ca_photo1']['name'])) {
            $filename = $_FILES['ca_photo1']['name'];
            $exp = explode('.' , $filename);
            $photoName1="CA".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName1=$this->input->POST('h_ca_photo1');
        }
        
        if(!empty($_FILES['ca_photo2']['name'])) {
            $filename = $_FILES['ca_photo2']['name'];
            $exp = explode('.' , $filename);
            $photoName2="CA".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName2=$this->input->POST('h_ca_photo2');
        }
        
        $Re=$this->B_Complain_m->getSuccessEditSave($this->input->POST(),$photoName1,$photoName2);
        
        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['ca_photo1']['name'])) {
                $config['upload_path'] ='./public/images/complain';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName1;
                $this->upload->initialize($config);
                if($this->upload->do_upload('ca_photo1')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/complain/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 920;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
            if(!empty($_FILES['ca_photo2']['name'])) {
                $config['upload_path'] ='./public/images/complain';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName2;
                $this->upload->initialize($config);
                if($this->upload->do_upload('ca_photo2')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/complain/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 920;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
            
        }
        echo json_encode($Re);
    }

    public function complain_cancel_list(){

        $search = array(
            'c_status' => trim($this->input->post('SH_status')),
            'c_title' => trim($this->input->post('SH_title')),
            'c_cus_name' => trim($this->input->post('SH_name')),
        );
        
        $this->load->library('pagination');
        $limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $config['base_url'] = base_url('B_Complain/complain_cancel_list');
        $config['total_rows'] = $this->B_Complain_m->getComplainList($limit, $offset, $search, $count=true);
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
        $data['Re'] = $this->B_Complain_m->getComplainList($limit, $offset, $search, $count=false);
        $data['pagelinks'] = $this->pagination->create_links();
        $data['status'] =  trim($this->input->post('SH_status'));
        $this->load->view('backoffice/complain_cancel_fetch', $data);
    }

}
