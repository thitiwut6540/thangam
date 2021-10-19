<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Link_menu extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Link_menu_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('Backoffice/login', 'refresh');
        }
        $accesstype_no='105';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('/backoffice/accesstype', 'refresh');
        }
    }

    public function index(){
        $data['pA'] = "m_link_menu";
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/link_menu.php',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function linkmenu_list(){
        $data['Re'] = $this->B_Link_menu_m->getList();
        $this->load->view('backoffice/link_menu_fetch', $data);
    }

    public function linkmenu_insert(){
        $data['pA'] = "m_link_menu";
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/link_menu_insert.php',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function linkmenu_insert_save(){ 

        if($this->input->post('action')=="l-depart-insert"){

            $this->db->select_max('l_no', 'l_no_max');
            $Re_m = $this->db->get('tb_link_menu');

            foreach ($Re_m->result() as $row){
                if($row->l_no_max==0){$l_no=1;}
                else{$l_no=$row->l_no_max+1;}
            }

            if(!empty($_FILES['l_photo']['name'])) {
                $config['upload_path'] ='./public/images/link_menu';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = "LM".date('YmdHis').rand(1000,9999);
                $this->upload->initialize($config);
                if($this->upload->do_upload('l_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/link_menu/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 320;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $l_p=$data['file_name'];
                }else{$l_p=NULL;}
            }else{$l_p=NULL;}

            $this->db->trans_begin();
            $data = array(
                'l_id' => NULL,
                'l_no' => $l_no,
                'l_url' => $this->input->POST('l_url'),
                'l_name' => $this->input->POST('l_name'),
                'l_photo' => $l_p,
                'l_status' => $this->input->POST('l_status'),
            );
            $this->db->insert('tb_link_menu', $data);

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

    }

    public function linkmenu_edit(){
        $id=$this->uri->segment(4);
        $data['pA'] = "m_link_menu";
        $data['Re'] = $this->B_Link_menu_m->getEdit($id);

        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/link_menu_edit.php',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function linkmenu_edit_save(){
        $l_id=$this->input->POST('l_id');
        $h_l_photo=$this->input->POST('h_l_photo');

        if(!empty($_FILES['l_photo']['name'])) {

            $this->db->select('*');
            $this->db->where('l_id', $l_id);
            $ReCHK = $this->db->get('tb_link_menu');
            foreach ($ReCHK->result() as $row);
            $pDele1=$row->l_photo;

            $config['upload_path'] ='./public/images/link_menu';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 0;
            $config['file_name'] = "LM".date('YmdHis').rand(1000,9999);
            $this->upload->initialize($config);
            if($this->upload->do_upload('l_photo')){
                $data=$this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = './public/images/link_menu/'.$data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width']         = 320;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $l_p=$data['file_name'];
            }else{$l_p=$h_l_photo;}
        }else{$l_p=$h_l_photo;}

        $this->db->trans_begin();

            $data = array(
                'l_name' => $this->input->POST('l_name'),
                'l_photo' => $l_p,
                'l_url' => $this->input->POST('l_url'),
                'l_status' => $this->input->POST('l_status'),
                );
            $this->db->where('l_id', $l_id);
            $this->db->update('tb_link_menu', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกแก้ไขข้อมูลได้กรุณาตรวจสอบ');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            if(!empty($pDele1) AND file_exists('public/images/link_menu/'.$pDele1)){
                unlink('public/images/link_menu/'.$pDele1);
            }
            $Response = array('action' => 'Y','output' => 'บันทึกแก้ไขข้อมูลเรียบร้อย');
            echo json_encode($Response);
            exit;
        }
    }

    public function linkmenu_delete(){
 
        $l_id=$this->input->post('l_id');
        $sql="SELECT * FROM tb_link_menu WHERE l_id='$l_id'";
        $Re_dele = $this->db->query($sql);
        foreach ($Re_dele->result() as $row_Re_dele);
        $pDele1=$row_Re_dele->l_photo;

        $this->db->trans_begin();
            $this->db->where('l_id', $this->input->post('l_id'));
            $this->db->delete('tb_link_menu');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการปุ่มลิงค์เมนูได้');
            echo json_encode($Response);
            exit;
            
        }else{
            $this->db->trans_commit();
            if(!empty($pDele1) AND file_exists('public/images/link_menu/'.$pDele1)){
                unlink('public/images/link_menu/'.$pDele1);
            }
            $Response = array('action' => 'Y','output' => 'ลบรายการปุ่มลิงค์เมนูเรียบร้อย');
            echo json_encode($Response);
        }

    }

    
    public function linkmenu_status(){
        $l_id=$this->input->POST('l_id');
        $l_status=$this->input->POST('l_status');

        $this->db->trans_begin();
            $data = array(
                'l_status' => $l_status,
            );
            $this->db->where('l_id', $l_id);
            $this->db->update('tb_link_menu', $data);
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

    public function linkmenu_no(){
        $id=$this->input->POST('l_id');
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

            $data = array('l_no' => $list_new,);
            $this->db->where('l_no', $list_old);
            $this->db->update('tb_link_menu', $data);

            $data = array('l_no' => $list_old,);
            $this->db->where('l_id', $id);
            $this->db->update('tb_link_menu', $data);

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
