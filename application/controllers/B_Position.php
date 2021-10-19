<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Position extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Position_m');

        if(!$this->session->userdata('SS_TL_us_name') 
        OR !$this->session->userdata('SS_TL_usa_num') 
        OR !$this->session->userdata('SS_TL_us_level')) {
            redirect('Backoffice', 'refresh');
        }
        
        $accesstype_no='100';
        $usa_num = $this->session->userdata('SS_TL_usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('Backoffice/accesstype', 'refresh');
        }
    }

    public function list(){

        $page = $this->input->POST('topic');

        $chk_accesstype=is_numeric(strpos($this->session->userdata('SS_TL_usa_num'),'100'));
        if ($chk_accesstype != FALSE){
            $userAction = $this->B_Function_m->getUserAction($this->session->userdata('SS_TL_us_id'),'100');
            foreach ($userAction as $row);
            $data['ac_insert_ap'] = $row->ac_insert;
            $data['ac_edit_ap'] = $row->ac_edit;
            $data['ac_dele_ap'] = $row->ac_dele;
            $data['ac_status_ap'] = $row->ac_status;
            $data['ac_approve_ap'] = $row->ac_approve;
            $data['ac_cancel_ap'] = $row->ac_cancel;
            $data['ac_print_ap'] = $row->ac_print;
            $data['ac_export_ap'] = $row->ac_export;
        }
        
        $data['action'] = $this->input->POST('action');
        $data['Re'] = $this->B_Position_m->getList($page);
        $this->load->view('backoffice/position_fetch', $data);
    }

    public function insert(){ 

        if($this->input->post('action')=="position-insert"){

            $this->db->select_max('position_no', 'ps_no_max');
            $this->db->where('memtype_id', $this->input->POST('memtype_id'));
            $Re_m = $this->db->get('tb_position');

            foreach ($Re_m->result() as $row){
                if($row->ps_no_max==0){$position_no=1;}
                else{$position_no=$row->ps_no_max+1;}
            }

            $this->db->trans_begin();
            $data = array(
                'memtype_id' => $this->input->POST('memtype_id'),
                'dp_id' => $this->input->POST('dp_id'),
                'position_name' => $this->input->POST('pst_name'),
                'position_no' => $position_no,
            );

            $this->db->insert('tb_position', $data);
            $pst_id=$this->db->insert_id();

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $Response = array('action' => 'N','output' => '<i class="fas fa-exclamation-triangle"></i> ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
                echo json_encode($Response);
                exit;
            }else{
                $this->db->trans_commit();
                $Response = array('action' => 'Y','output' => '<i class="fas fa-check"></i> บันทึกข้อมูลเรียบร้อย');
                echo json_encode($Response);
                exit;
            }
            
        }

    }

    public function edit(){ 

        if($this->input->post('action')=="position-edit"){

            $this->db->trans_begin();
            $data = array(
                'memtype_id' => $this->input->POST('memtype_id'),
                'dp_id' => $this->input->POST('dp_id'),
                'position_name' => $this->input->POST('pst_name'),
            );

            $this->db->where('position_id', $this->input->POST('pst_id'));
            $this->db->update('tb_position', $data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $Response = array('action' => 'N','output' => '<i class="fas fa-exclamation-triangle"></i> ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
                echo json_encode($Response);
                exit;
            }else{
                $this->db->trans_commit();
                $dataLog = array(
                    'log_id'=>NULL,
                    'log_name' => $_SESSION["SS_TL_us_name"],
                    'log_date' => date("Y-m-d H:i:s"),
                    'log_action' => "Insert",
                    'log_data' => $this->input->POST('topic')." : ID".$this->input->POST('pst_id'),
                );
                $this->db->insert('tb_user_log', $dataLog);
                $Response = array('action' => 'Y','output' => '<i class="fas fa-check"></i> บันทึกข้อมูลเรียบร้อย');
                echo json_encode($Response);
                exit;
            }
            
        }

    }

    public function delete(){

        $pst_id = $this->input->POST('pst_id');

        if($this->input->post('action')=="delete"){
            
            $this->db->trans_begin();
                //start transaction
                $this->db->where('position_id', $pst_id);
                $this->db->delete('tb_position');
                //end transaction
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการ'.$this->input->POST('pst_name'));
                echo json_encode($Response);
                exit;
                
            }else{
                $this->db->trans_commit();
                $dataLog = array(
                    'log_id'=>NULL,
                    'log_name' => $_SESSION["SS_TL_us_name"],
                    'log_date' => date("Y-m-d H:i:s"),
                    'log_action' => "delete",
                    'log_data' => $this->input->POST('topic')." : ".$this->input->post('pst_id')."/".$this->input->post('pst_name'),
                );
                $this->db->insert('tb_user_log', $dataLog);
                $Response = array('action' => 'Y','output' => 'ลบรายการ'.$this->input->POST('pst_name').'เรียบร้อย');
                echo json_encode($Response);
            }
        }else{
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการ'.$this->input->POST('pst_name').'ได้');
            echo json_encode($Response);
            exit;
        }
    }

    public function no(){
        $id=$this->input->POST('ps_id');
        $list_new=$this->input->POST('list');
        $status=$this->input->POST('status');
        $mt_id=$this->input->POST('mt_id');

        $this->db->trans_begin();
            //start transaction

            if($status=="down"){
                $list_old=1+$list_new;
                $list_new=$list_new;
            }else if($status=="up"){
                $list_old=$list_new-1;
                $list_new=$list_new;
                if($list_old<1){$list_old=1;}
            }

            $data = array('position_no' => $list_new,);
            $this->db->where('position_no', $list_old);
            $this->db->where('memtype_id', $mt_id);
            $this->db->update('tb_position', $data);

            $data = array('position_no' => $list_old,);
            $this->db->where('position_id', $id);
            $this->db->where('memtype_id', $mt_id);
            $this->db->update('tb_position', $data);

            //end transaction
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
