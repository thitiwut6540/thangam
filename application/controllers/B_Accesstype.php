<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Accesstype extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->model('B_Function_m');
        $this->load->model('B_Accesstype_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('Backoffice/login', 'refresh');
        }
        $accesstype_no='100';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('/backoffice/accesstype', 'refresh');
        }
    }


    public function index(){
        $data['pA'] = "m_Acc";
        $data['Re'] = $this->B_Accesstype_m->getList();

        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/system_accesstype.php',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function accesstype_edit(){
        $data['pA'] = "m_Acc";
        $id = $this->uri->segment(4);
        $data['Re'] = $this->B_Accesstype_m->getACC($id);

        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/system_accesstype_edit.php',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function accesstype_edit_save(){
        $usl_id=$this->input->post('usl_id');
        $usa_num=$this->input->post('usa_num');
        $usl_name=$this->input->post('usl_name');

        $usa_num = implode(",", $usa_num);
        $ReIN= $this->B_Accesstype_m->getACC_IN($usa_num);

        $usa_name="";
        $x = 0; 
        foreach ($ReIN['Re_in'] as $row_Re_in){
            $x++;
            if($ReIN['total_Re_in']!=$x){$usa_name.=$row_Re_in->usa_name.",";}
            else {$usa_name.= $row_Re_in->usa_name;}
        }

        $this->db->trans_begin();
            $data = array(
                'usl_name' => $usl_name,
                'usa_num' => $usa_num,
                'usa_name' => $usa_name
            );
            $this->db->where('usl_id', $usl_id);
            $this->db->update('tb_user_level', $data);

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
