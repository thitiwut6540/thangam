<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Banner_top extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Banner_top_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('Backoffice/login', 'refresh');
        }
        $accesstype_no='106';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('/backoffice/accesstype', 'refresh');
        }
    }

    public function index(){
        $data['pA'] = "m_banner_popup";
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/banner_top',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function banner_list(){
        $data['Re'] = $this->B_Banner_top_m->getList();
        $this->load->view('backoffice/banner_top_fetch', $data);
    }

    public function banner_insert(){
        $data['pA'] = "m_banner_popup";
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/banner_top_insert.php',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function banner_insert_save(){ 

        $this->db->select_max('ban_no', 'ban_no_max');
        $Re_m = $this->db->get('tb_banner_top');

        foreach ($Re_m->result() as $row){
            if($row->ban_no_max==0){$ban_no=1;}
            else{$ban_no=$row->ban_no_max+1;}
        }

        if(!empty($_FILES['ban_photo']['name'])) {
            $config['upload_path'] ='./public/images/banner_top';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 0;
            $config['file_name'] = "BT".date('YmdHis').rand(1000,9999);
            $this->upload->initialize($config);
            if($this->upload->do_upload('ban_photo')){
                $data=$this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = './public/images/banner_top/'.$data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width']         = 1200;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $ban_photo=$data['file_name'];
            }else{$ban_photo="";}
        }else{$ban_photo="";}

        $this->db->trans_begin();
        $data = array(
            'ban_id' => NULL,
            'ban_no' => $ban_no,
            'ban_url' => $this->input->POST('ban_url'),
            'ban_name' => $this->input->POST('ban_name'),
            'ban_photo' => $ban_photo,
            'ban_status' => $this->input->POST('ban_status'),
        );
        $this->db->insert('tb_banner_top', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => '????????????????????????????????????????????????????????????????????????????????????????????????????????????');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => '???????????????????????????????????????????????????????????????');
            echo json_encode($Response);
            exit;
        }
        
    }

    public function banner_edit(){
        $id=$this->uri->segment(4);
        $data['pA'] = "m_banner_popup";
        $data['Re'] = $this->B_Banner_top_m->getEdit($id);

        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/banner_top_edit.php',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function banner_edit_save(){
        $ban_id=$this->input->POST('ban_id');
        $h_ban_photo=$this->input->POST('h_ban_photo');

        if(!empty($_FILES['ban_photo']['name'])) {

            $this->db->select('*');
            $this->db->where('ban_id', $ban_id);
            $ReCHK = $this->db->get('tb_banner_top');
            foreach ($ReCHK->result() as $row);
            $pDele1=$row->ban_photo;

            $config['upload_path'] ='./public/images/banner_top';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 0;
            $config['file_name'] = "BT".date('YmdHis').rand(1000,9999);
            $this->upload->initialize($config);
            if($this->upload->do_upload('ban_photo')){
                $data=$this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = './public/images/banner_top/'.$data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width']         = 1200;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $ban_photo=$data['file_name'];
            }else{$ban_photo=$h_ban_photo;}
        }else{$ban_photo=$h_ban_photo;}

        $this->db->trans_begin();

            $data = array(
                'ban_name' => $this->input->POST('ban_name'),
                'ban_photo' => $ban_photo,
                'ban_url' => $this->input->POST('ban_url'),
                'ban_status' => $this->input->POST('ban_status'),
                );
            $this->db->where('ban_id', $ban_id);
            $this->db->update('tb_banner_top', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => '???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            if(!empty($pDele1) AND file_exists('public/images/banner_top/'.$pDele1)){
                unlink('public/images/banner_top/'.$pDele1);
            }
            $Response = array('action' => 'Y','output' => '??????????????????????????????????????????????????????????????????????????????');
            echo json_encode($Response);
            exit;
        }
    }

    public function banner_delete(){
 
        $ban_id=$this->input->post('ban_id');
        $sql="SELECT * FROM tb_banner_top WHERE ban_id='$ban_id'";
        $Re_dele = $this->db->query($sql);
        foreach ($Re_dele->result() as $row_Re_dele);
        $pDele1=$row_Re_dele->ban_photo;

        $this->db->trans_begin();
            $this->db->where('ban_id', $this->input->post('ban_id'));
            $this->db->delete('tb_banner_top');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => '???????????????????????????????????????????????????????????????????????????????????????');
            echo json_encode($Response);
            exit;
            
        }else{
            $this->db->trans_commit();
            if(!empty($pDele1) AND file_exists('public/images/banner_top/'.$pDele1)){
                unlink('public/images/banner_top/'.$pDele1);
            }
            $Response = array('action' => 'Y','output' => '??????????????????????????????????????????????????????????????????????????????');
            echo json_encode($Response);
        }

    }

    
    public function banner_status(){
        $ban_id=$this->input->POST('ban_id');
        $ban_status=$this->input->POST('ban_status');

        $this->db->trans_begin();
            $data = array(
                'ban_status' => $ban_status,
            );
            $this->db->where('ban_id', $ban_id);
            $this->db->update('tb_banner_top', $data);
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

    public function banner_no(){
        $id=$this->input->POST('ban_id');
        $list_new=$this->input->POST('list');
        $status=$this->input->POST('status');

        $this->db->trans_begin();
            if($status=="down"){
                $list_old=1+$list_new;
                $list_new=$list_new;
            }else if($status=="up"){
                $list_old=$list_new-1;
                $list_new=$list_new;
                if($list_old<1){$list_old=1;}
            }

            $data = array('ban_no' => $list_new,);
            $this->db->where('ban_no', $list_old);
            $this->db->update('tb_banner_top', $data);

            $data = array('ban_no' => $list_old,);
            $this->db->where('ban_id', $id);
            $this->db->update('tb_banner_top', $data);

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
}
