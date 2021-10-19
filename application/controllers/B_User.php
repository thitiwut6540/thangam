<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->model('B_Function_m');
        $this->load->model('B_User_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('Backoffice/login', 'refresh');
        }
        $accesstype_no='101';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('/backoffice/accesstype', 'refresh');
        }
    }

    public function index(){
        $data['pA'] = "m_User";
        $data['Re'] = $this->B_User_m->getUserList();

        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/system_user.php',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function user_insert(){
        $data['pA'] = "m_User";
        $data['Re_ac'] = $this->B_User_m->getUsl();
        $data['Re_dp'] = $this->B_User_m->getDepart();
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/system_user_insert.php',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function user_insert_save(){

        $user=$this->input->POST('us_user');
        $p=$this->input->POST('us_pass');
        $pass = password_hash($p, PASSWORD_DEFAULT);

        $chk ="SELECT us_name FROM tb_user WHERE us_user = '$user' ";
        $Re_chk = $this->db->query($chk);
        $total_Re_chk=$Re_chk->num_rows();
        if($total_Re_chk>0){
            $Response = array('action' => 'D','output' => 'USERNAME : '.$user.' มีในระบบแล้ว');
            echo json_encode($Response);
            exit;
        }

        $data = array(
            'us_id' => NULL,
            'us_status' => $this->input->POST('us_status'),
            'us_approve' => $this->input->POST('us_approve'),
            'usl_id' => $this->input->POST('usl_id'),
            'us_name' => $this->input->POST('us_name'),
            'dp_id' => $this->input->POST('dp_id'),
            'us_user' => $user,
            'us_pass' => $pass,
            'us_counter' => NULL,
            'us_login_last' => NULL,
         );
        if($this->db->insert('tb_user', $data)){
            $Response = array('action' => 'Y','output' => 'บันทึกข้อมูลเรียบร้อย');
            echo json_encode($Response);
            exit;
        }else{
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้');
            echo json_encode($Response);
            exit;
        }
    }

    public function user_edit(){
        $id = $this->uri->segment(4);
        $data['pA'] = "m_User";
        $data['Re_ac'] = $this->B_User_m->getUsl();
        $data['Re_dp'] = $this->B_User_m->getDepart();
        $data['Re'] = $this->B_User_m->getUser($id);
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/system_user_edit.php',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function user_edit_save(){
        $id=$this->input->POST('us_id');
        $user=$this->input->POST('us_user');
        $p=$this->input->POST('us_pass');
        $ph=$this->input->POST('h_us_pass');
        $pass = password_hash($p, PASSWORD_DEFAULT);
        if(empty($p)){$pass=$ph;}

        $chk ="SELECT us_name FROM tb_user WHERE us_id != '$id' AND us_user = '$user' ";
        $Re_chk = $this->db->query($chk);
        $total_Re_chk=$Re_chk->num_rows();
        if($total_Re_chk>0){
            $Response = array('action' => 'D','output' => 'USERNAME : '.$user.' มีในระบบแล้ว');
            echo json_encode($Response);
            exit;
        }

        $data = array(
            'us_status' => $this->input->POST('us_status'),
            'usl_id' => $this->input->POST('usl_id'),
            'dp_id' => $this->input->POST('dp_id'),
            'us_status' => $this->input->POST('us_status'),
            'us_approve' => $this->input->POST('us_approve'),
            'us_name' => $this->input->POST('us_name'),
            'us_user' => $user,
            'us_pass' => $pass,
         );
        $this->db->where('us_id', $this->input->post('us_id'));
        if($this->db->update('tb_user', $data)){
            $Response = array('action' => 'Y','output' => 'บันทึกแก้ไขข้อมูลผู้ใช้งานเรียบร้อย');
            echo json_encode($Response);
            exit;
        }else{
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้');
            echo json_encode($Response);
            exit;
        }
    }

    public function user_delete(){
        $this->db->where('us_id', $this->input->post('us_id'));
        if($this->db->delete('tb_user')){
            $Response = array('action' => 'Y','output' => 'ลบผู้ใช้งานเรียบร้อย');
            echo json_encode($Response);
        exit;
        }else{
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบผู้ใช้งานได้');
            echo json_encode($Response);
            exit;
        }
    }

}
