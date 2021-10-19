<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Info extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Info_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('Backoffice/login', 'refresh');
        }
        $accesstype_no='102';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('/backoffice/accesstype', 'refresh');
        }
    }

    public function index(){
        $data['pA'] = "m_info";
        $data['Re'] = $this->B_Info_m->getCompany();
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/info_company',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function info_company_save(){ 
        $this->db->trans_begin();
            $data = array(
                'c_name' => $this->input->POST('c_name'),
                'c_address' => $this->input->POST('c_address'),
                'c_tel1' => $this->input->POST('c_tel1'),
                'c_tel2' => $this->input->POST('c_tel2'),
                'c_fax' => $this->input->POST('c_fax'),
                'c_email' => $this->input->POST('c_email'),
                'c_web' => $this->input->POST('c_web'),
                'c_facebook' => $this->input->POST('c_facebook'),
                'c_line' => $this->input->POST('c_line'),
            );
            $this->db->where('c_id', '1');
            $this->db->update('tb_company', $data);
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

    public function info_main(){
        $page = $this->uri->segment(2);

        if($page=='เกี่ยวกับเทศบาล'){$pA='m_info_about';}
        else if($page=='สภาพทั่วไป'){$pA='m_info_general';}
        else if($page=='วิสัยทัศน์และพันธกิจ'){$pA='m_info_vision';}
        else if($page=='โครงสร้างองค์กร'){$pA='m_info_structure';}
        else if($page=='อัตรากำลัง'){$pA='m_info_staff';}
        else if($page=='อำนาจหน้าที่'){$pA='m_info_role';}
        else if($page=='การติดต่อ'){$pA='m_info_contact';}
        else if($page=='แผนที่'){$pA='m_info_map';}

        $data['pA'] = $pA;
        $data['topic'] = $page;
        $data['Re'] = $this->B_Info_m->getList($page);
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/info_main',$data);
        $this->load->view('backoffice/template/a_footer');
    }


    public function info_main_save(){ 
        $this->db->trans_begin();
            $data = array(
                'if_header' => $this->input->POST('if_header'),
                'if_detail' => $this->input->POST('if_detail'),
                'if_date' => $this->input->POST('if_date'),
                'if_insert' => $this->input->POST('if_insert'),
            );
            $this->db->where('if_id', $this->input->POST('if_id'));
            $this->db->update('tb_info', $data);
            
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

    // public function list(){

    //     $page = $this->input->POST('page');

    //     $chk_accesstype=is_numeric(strpos($this->session->userdata('SS_TL_usa_num'),'100'));
    //     if ($chk_accesstype != FALSE){
    //         $userAction = $this->B_Function_m->getUserAction($this->session->userdata('SS_TL_us_id'),'100');
    //         foreach ($userAction as $row);
    //         $data['ac_insert_ap'] = $row->ac_insert;
    //         $data['ac_edit_ap'] = $row->ac_edit;
    //         $data['ac_dele_ap'] = $row->ac_dele;
    //         $data['ac_status_ap'] = $row->ac_status;
    //         $data['ac_approve_ap'] = $row->ac_approve;
    //         $data['ac_cancel_ap'] = $row->ac_cancel;
    //         $data['ac_print_ap'] = $row->ac_print;
    //         $data['ac_export_ap'] = $row->ac_export;
    //     }
        
    //     $data['action'] = $this->input->POST('action');
    //     $data['topic'] = $page;
    //     $data['Re'] = $this->B_Info_m->getList($page);
    //     $this->load->view('backoffice/info_main_fetch', $data);
    // }
}
