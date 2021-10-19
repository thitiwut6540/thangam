<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_History extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_History_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('Backoffice/login', 'refresh');
        }
        $accesstype_no='206';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('/backoffice/accesstype', 'refresh');
        }
    }

    public function index(){
        $name= $this->uri->segment(3);
        if($name=='นายกเทศมนตรี'){
            $h_type='P';
        }else if($name=='ปลัดเทศบาล'){
            $h_type='C';
        }

        $data['h_type'] = $h_type;
        $data['h_type_name'] = $name;
        $data['pA'] = "m_history";
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/history',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function history_list(){
        $data['h_type'] = $this->input->POST('h_type');
        $data['h_type_name'] = $this->input->POST('h_type_name');
        $data['Re'] = $this->B_History_m->getList($this->input->POST('h_type'));
        $this->load->view('backoffice/history_fetch', $data);
    }

    public function history_insert(){
        $name= $this->uri->segment(3);
        if($name=='นายกเทศมนตรี'){
            $h_type='P';
        }else if($name=='ปลัดเทศบาล'){
            $h_type='C';
        }

        $data['h_type'] = $h_type;
        $data['h_type_name'] = $name;
        $data['pA'] = "m_history";
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/history_insert',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function history_insert_save(){ 
        if(!empty($_FILES['h_photo']['name'])) {
            $filename = $_FILES['h_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="H".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName="";
        }

        $Re=$this->B_History_m->getInsertSave($this->input->POST(),$photoName);

        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['h_photo']['name'])) {
                $config['upload_path'] ='./public/images/history';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('h_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/history/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 420;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
        }
        echo json_encode($Re);
    }

    public function history_edit(){
        $name= $this->uri->segment(3);
        if($name=='นายกเทศมนตรี'){
            $h_type='P';
        }else if($name=='ปลัดเทศบาล'){
            $h_type='C';
        }

        $data['h_type'] = $h_type;
        $data['h_type_name'] = $name;
        $data['Re'] = $this->B_History_m->getEdit($this->uri->segment(5));
        $data['pA'] = "m_history";
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/history_edit',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function history_edit_save(){ 

        if(!empty($_FILES['h_photo']['name'])) {
            $filename = $_FILES['h_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="H".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName=$this->input->POST('h_h_photo');
        }
        $ReD=$this->B_History_m->getEdit($this->input->POST('h_id'));
        foreach ($ReD['Re_h'] as $row);
        $delPhoto=$row->h_photo;

        $Re=$this->B_History_m->getEditSave($this->input->POST(),$photoName);
        
        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['h_photo']['name'])) {
                $config['upload_path'] ='./public/images/history';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('h_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/history/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 420;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }

                if(!empty($delPhoto)){
                    if(!empty($delPhoto) AND file_exists('public/images/history/'.$delPhoto)){
                        unlink('public/images/history/'.$delPhoto);
                    }
                }
                
            }
        }
        echo json_encode($Re);
        
    }

    public function history_no(){
        
        $id=$this->input->POST('h_id');
        $list_new=$this->input->POST('list');
        $status=$this->input->POST('status');
        $type=$this->input->POST('type');

        $this->db->trans_begin();
            if($status=="down"){
                $list_old=1+$list_new;
                $list_new=$list_new;
            }else if($status=="up"){
                $list_old=$list_new-1;
                $list_new=$list_new;
                if($list_old<1){$list_old=1;}
            }

            $data = array('h_no' => $list_new,);
            $this->db->where('h_no', $list_old);
            $this->db->where('h_type', $type);
            $this->db->update('tb_history', $data);

            $data = array('h_no' => $list_old,);
            $this->db->where('h_id', $id);
            $this->db->where('h_type', $type);
            $this->db->update('tb_history', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y');
            echo json_encode($Response);
            exit;
        }
    }

    public function history_delete_photo(){

        $this->db->trans_begin();

            $ReD=$this->B_History_m->getEdit($this->input->POST('h_id'));
            foreach ($ReD['Re_h'] as $row);
            $delPhoto=$row->h_photo;

            $data = array('h_photo' => '',);
            $this->db->where('h_id', $this->input->post('h_id'));
            $this->db->update('tb_history', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรูปภาพได้');
            echo json_encode($Response);
        }else{
            $this->db->trans_commit();
            if(!empty($delPhoto)){
                if(!empty($delPhoto) AND file_exists('public/images/history/'.$delPhoto)){
                    unlink('public/images/history/'.$delPhoto);
                }
            }
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }

    public function history_delete(){
        $ReD=$this->B_History_m->getEdit($this->input->POST('h_id'));
        foreach ($ReD['Re_h'] as $row);
        $delPhoto=$row->h_photo;

        $this->db->trans_begin();

            $this->db->where('h_id', $this->input->POST('h_id'));
            $this->db->delete('tb_history');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการได้');
            echo json_encode($Response);
            exit;
            
        }else{
            $this->db->trans_commit();
            if(!empty($delPhoto) AND file_exists('public/images/history/'.$delPhoto)){
                unlink('public/images/history/'.$delPhoto);
            }
            $Response = array('action' => 'Y','output' => 'ลบรายการเรียบร้อย');
            echo json_encode($Response);
        }
    }

}
