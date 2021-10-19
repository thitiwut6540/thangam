<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Password extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->model('B_Function_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('Backoffice/login', 'refresh');
        }
    }

    public function index(){
        $us_id=$this->input->POST('e_id');
        $password=$this->input->POST('e_us_password');
        $password_new=$this->input->POST('e_us_password_new');
        $pass = password_hash($password_new, PASSWORD_DEFAULT);

        $chk ="SELECT us_pass FROM tb_user WHERE us_id = '$us_id'";
        $Re_chk = $this->db->query($chk);
        $row_Re_chk = $Re_chk->row();
        $total_Re_chk=$Re_chk->num_rows();

        if($total_Re_chk>0){
            if(password_verify($password,$row_Re_chk->us_pass)){
                $data = array(
                    'us_pass' => $pass,
                );
                $this->db->where('us_id', $us_id);
                if($this->db->update('tb_user', $data)){
                    $Response = array('action' => 'Y','output' => 'บันทึกแก้ไข Password เรีนบร้อย');
                    echo json_encode($Response);
                    exit;
                }else{
                    $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกแก้ไขได้');
                    echo json_encode($Response);
                    exit;
                }
            }else{
                $Response = array('action' => 'N','output' => 'Password เดิมไม่ถูกต้อง');
                echo json_encode($Response);
                exit;
            }

        }else{
            $Response = array('action' => 'N','output' => 'ระบบไม่สามารถระบุตัวตนได้');
            echo json_encode($Response);
            exit;
        }
    }

}
