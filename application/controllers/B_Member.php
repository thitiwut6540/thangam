<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Member extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Member_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('Backoffice/login', 'refresh');
        }
        $accesstype_no='203';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('/backoffice/accesstype', 'refresh');
        }
    }

    public function member(){
        $name= $this->uri->segment(3);
        $id= $this->B_Member_m->getTypeID($name);
        $data['type_id'] = $id;
        $data['type_name'] = $name;
        $data['depart_id'] = '';
        $data['depart_name'] = '';
        $data['ReDP'] = $this->B_Member_m->getDepart('1');
        $data['pA'] = "m_member";

        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/member',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function member_list(){
        $data['type_id'] = $this->input->POST('type_id');
        $data['type_name'] = $this->input->POST('type_name');
        $data['depart_id'] = $this->input->POST('depart_id');
        $data['depart_name'] = $this->input->POST('depart_name');
        
        $this->load->view('backoffice/member_fetch', $data);
    }

    public function member_depart(){

        $type_name= $this->uri->segment(3);
        $dp_name= $this->uri->segment(4);
        $type_id= $this->B_Member_m->getTypeID($type_name);
        $mem_id= $this->B_Member_m->getDPID($dp_name);

        $data['type_id'] = $type_id;
        $data['type_name'] = $type_name;
        $data['depart_id'] = $mem_id;
        $data['depart_name'] = $dp_name;
        $data['ReDP'] = $this->B_Member_m->getDepart('1');
        $data['pA'] = "m_member";

        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/member_depart',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function member_insert(){
        $type_name= $this->uri->segment(3);
        $type_id= $this->B_Member_m->getTypeID($type_name);
        $segment4 = $this->uri->segment(4);

        if($segment4=='insert'){
            $dp_name='';
            $mem_id= '';
        }else{
            $dp_name= $this->uri->segment(4);
            $mem_id= $this->B_Member_m->getDPID($dp_name);
        }

        $data['type_id'] = $type_id;
        $data['type_name'] = $type_name;
        $data['depart_id'] = $mem_id;
        $data['depart_name'] = $dp_name;
        $data['ReDP'] = $this->B_Member_m->getDepart('1');
        $data['pA'] = "m_member";

        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/member_insert',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function member_insert_save(){ 

        if(!empty($_FILES['mem_photo']['name'])) {
            $filename = $_FILES['mem_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="M".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName="";
        }

        $Re=$this->B_Member_m->getInsertSave($this->input->POST(),$photoName);
        
        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['mem_photo']['name'])) {
                $config['upload_path'] ='./public/images/member';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('mem_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/member/'.$data['file_name'];
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

    public function member_edit(){

        $type_name= $this->uri->segment(3);
        $type_id= $this->B_Member_m->getTypeID($type_name);
        $segment4 = $this->uri->segment(4);

        if($segment4=='edit'){
            $dp_name='';
            $dp_id= '';
            $mem_id=$this->uri->segment(5);;
        }else{
            $dp_name= $this->uri->segment(4);
            $dp_id= $this->B_Member_m->getDPID($dp_name);
            $mem_id=$this->uri->segment(6);;
        }

        $data['type_id'] = $type_id;
        $data['type_name'] = $type_name;
        $data['depart_id'] = $dp_id;
        $data['depart_name'] = $dp_name;
        $data['ReDP'] = $this->B_Member_m->getDepart('1');
        $data['Re'] = $this->B_Member_m->getEdit($mem_id);
        $data['pA'] = "m_member";

        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/member_edit',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function member_edit_save(){ 

        if(!empty($_FILES['mem_photo']['name'])) {
            $filename = $_FILES['mem_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="M".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName=$this->input->POST('h_mem_photo');
        }
        $ReD=$this->B_Member_m->getEdit($this->input->POST('mem_id'));
        foreach ($ReD['Re_m'] as $row);
        $delPhoto=$row->mem_photo;

        $Re=$this->B_Member_m->getEditSave($this->input->POST(),$photoName);
        
        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['mem_photo']['name'])) {
                $config['upload_path'] ='./public/images/member';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('mem_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/member/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 420;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }

                if(!empty($delPhoto)){
                    if(!empty($delPhoto) AND file_exists('public/images/member/'.$delPhoto)){
                        unlink('public/images/member/'.$delPhoto);
                    }
                }
                
            }
        }
        echo json_encode($Re);
        
    }

    public function member_no(){
        
        $id=$this->input->POST('mem_id');
        $list_new=$this->input->POST('list');
        $status=$this->input->POST('status');
        $type=$this->input->POST('type');
        $depart=$this->input->POST('depart');
        $group=$this->input->POST('group');

        $this->db->trans_begin();
            if($status=="down"){
                $list_old=1+$list_new;
                $list_new=$list_new;
            }else if($status=="up"){
                $list_old=$list_new-1;
                $list_new=$list_new;
                if($list_old<1){$list_old=1;}
            }

            $data = array('mem_no' => $list_new,);
            $this->db->where('mem_no', $list_old);
            $this->db->where('memtype_id', $type);
            if($type=='3'){$this->db->where('dp_id', $depart);}
            $this->db->where('mem_group', $group);
            $this->db->update('tb_member', $data);

            $data = array('mem_no' => $list_old,);
            $this->db->where('mem_id', $id);
            $this->db->where('memtype_id', $type);
            if($type=='3'){$this->db->where('dp_id', $depart);}
            $this->db->where('mem_group', $group);
            $this->db->update('tb_member', $data);

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

    public function member_delete_photo(){

        $this->db->trans_begin();

            $ReD=$this->B_Member_m->getEdit($this->input->POST('mem_id'));
            foreach ($ReD['Re_m'] as $row);
            $delPhoto=$row->mem_photo;

            $data = array('mem_photo' => '',);
            $this->db->where('mem_id', $this->input->post('mem_id'));
            $this->db->update('tb_member', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรูปภาพได้');
            echo json_encode($Response);
        }else{
            $this->db->trans_commit();
            if(!empty($delPhoto)){
                if(!empty($delPhoto) AND file_exists('public/images/member/'.$delPhoto)){
                    unlink('public/images/member/'.$delPhoto);
                }
            }
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }

    public function member_delete(){
        $ReD=$this->B_Member_m->getEdit($this->input->POST('mem_id'));
        foreach ($ReD['Re_m'] as $row);
        $delPhoto=$row->mem_photo;

        $this->db->trans_begin();

            $this->db->where('mem_id', $this->input->POST('mem_id'));
            $this->db->delete('tb_member');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการได้');
            echo json_encode($Response);
            exit;
            
        }else{
            $this->db->trans_commit();
            if(!empty($delPhoto) AND file_exists('public/images/member/'.$delPhoto)){
                unlink('public/images/member/'.$delPhoto);
            }
            $Response = array('action' => 'Y','output' => 'ลบรายการเรียบร้อย');
            echo json_encode($Response);
        }
    }

}
