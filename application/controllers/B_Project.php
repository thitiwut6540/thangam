<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Project extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Project_m');

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

    public function insert(){ 

        if($this->input->post('action')=="project-insert"){

            if(!empty($_FILES['dp_photo']['name'])) {
                $config['upload_path'] ='./public/images/department';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = "DP".date('YmdHis').rand(1000,9999);
                $this->upload->initialize($config);
                if($this->upload->do_upload('dp_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/dp_photo/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 1920;
                    $config['height']       = 473;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $dp_p=$data['file_name'];
                }else{$dp_p=NULL;}
            }else{$dp_p=NULL;}

            $this->db->trans_begin();
            $data = array(
                'dp_id' => NULL,
                'dp_name' => $this->input->POST('dp_name'),
                'dp_add' => $this->input->POST('dp_add'),
                'dp_tel' => $this->input->POST('dp_tel'),
                'dp_fax' => $this->input->POST('dp_fax'),
                'dp_detail' => $this->input->POST('dp_detail'),
                'dp_photo' => $dp_p,
                'admin_id' => $_SESSION["SS_TL_us_id"],
                'dptype_id' => $this->input->POST('dptype_id'),
                'dp_date' => date("Y-m-d H:i:s"),
            );

            $this->db->insert('tb_depart', $data);
            $dp_id=$this->db->insert_id();

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
                    'log_data' => $this->input->POST('topic')." : ID".$dp_id,
                );
                $this->db->insert('tb_user_log', $dataLog);
                $Response = array('action' => 'Y','output' => '<i class="fas fa-check"></i> บันทึกข้อมูลเรียบร้อย');
                echo json_encode($Response);
                exit;
            }
            
        }

    }

    public function edit(){
        $dp_id=$this->input->POST('dp_id');
        $dp_name=$this->input->POST('dp_name');
        $dp_add=$this->input->POST('dp_add');
        $dp_tel=$this->input->POST('dp_tel');
        $dp_fax=$this->input->POST('dp_fax');
        $dp_detail=$this->input->POST('dp_detail');
        $dp_h_photo=$this->input->POST('dp_photo');

        if($this->input->post('action')=="project-edit"){

            $chk ="SELECT dp_name FROM tb_depart WHERE dp_name = '$dp_name' AND dp_id != '$dp_id'";
            $Re_chk = $this->db->query($chk);
            $total_Re_chk=$Re_chk->num_rows();
            if($total_Re_chk>0){
                $Response = array('action' => 'D','output' => '<i class="fas fa-exclamation-triangle"></i> รายการหน่วยงานหรือโครงการ : '.$dp_name.' มีในระบบแล้ว');
                echo json_encode($Response);
                exit;
            }else{
                $sql="SELECT * FROM tb_depart WHERE dp_id='$dp_id'";
                $Re_dp = $this->db->query($sql);
                foreach ($Re_dp->result() as $row_Re_dp);

                if(!empty($_FILES['dp_photo']['name'])) {
                    if(!empty($row_Re_dp->dp_photo) AND file_exists('public/images/department/'.$row_Re_dp->dp_photo)){
                        unlink('public/images/department/'.$row_Re_dp->dp_photo);
                    }

                    $config['upload_path'] ='./public/images/department';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size'] = 0;
                    $config['file_name'] = "DP".date('YmdHis').rand(1000,9999);
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('dp_photo')){
                        $data=$this->upload->data();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './public/images/department/'.$data['file_name'];
                        $config['create_thumb'] = FALSE;
                        $config['maintain_ratio'] = TRUE;
                        $config['width']         = 480;
                        $config['height']       = 640;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $dp_photo=$data['file_name'];
                    }else{$dp_photo=$dp_h_photo;}
                }else{$dp_photo=$dp_h_photo;}

                $this->db->trans_begin();
                    //start transaction
                    $data = array(
                        'dp_name' => $this->input->POST('dp_name'),
                        'dp_add' => $this->input->POST('dp_add'),
                        'dp_tel' => $this->input->POST('dp_tel'),
                        'dp_fax' => $this->input->POST('dp_fax'),
                        'dp_detail' => $this->input->POST('dp_detail'),
                        'dp_photo' => $dp_photo,
                        'dp_date' => date("Y-m-d H:i:s"),
                        'admin_id' => $_SESSION["SS_TL_us_id"],
                        );

                    $this->db->where('dp_id', $dp_id);
                    $this->db->update('tb_depart', $data);

                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    $Response = array('action' => 'N','output' => '<i class="fas fa-exclamation-triangle"></i> ไม่สามารถบันทึกแก้ไขข้อมูลได้กรุณาตรวจสอบ');
                    echo json_encode($Response);
                    exit;
                }else{
                    $this->db->trans_commit();
                    $dataLog = array(
                        'log_id'=>NULL,
                        'log_name' => $_SESSION["SS_TL_us_name"],
                        'log_date' => date("Y-m-d H:i:s"),
                        'log_action' => "Edit",
                        'log_data' => $this->input->POST('dp_topic')." : ID".$dp_id."/".$this->input->POST('dp_name'),
                    );
                    $this->db->insert('tb_user_log', $dataLog);
                    $Response = array('action' => 'Y','id' => $dp_id,'output' => '<i class="fas fa-check"></i> บันทึกแก้ไขข้อมูลเรียบร้อย');
                    echo json_encode($Response);
                    exit;
                }
            }

        }
    }

    public function delete(){

        if($this->input->post('action')=="delete"){
            $dp_id=$this->input->post('dp_id');
            $sql="SELECT * FROM tb_depart WHERE dp_id='$dp_id'";
            $Re_dele = $this->db->query($sql);
            foreach ($Re_dele->result() as $row_Re_dele);
            $dpDele=$row_Re_dele->dp_photo;

            $this->db->trans_begin();
                //start transaction
                $this->db->where('dp_id', $dp_id);
                $this->db->delete('tb_depart');
                //end transaction
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการ'.$this->input->POST('dp_topic'));
                echo json_encode($Response);
                exit;
                
            }else{
                $this->db->trans_commit();
                if(!empty($pDele1) AND file_exists('public/images/department/'.$dpDele)){
                    unlink('public/images/department/'.$dpDele);
                }

                $dataLog = array(
                    'log_id'=>NULL,
                    'log_name' => $_SESSION["SS_TL_us_name"],
                    'log_date' => date("Y-m-d H:i:s"),
                    'log_action' => "delete",
                    'log_data' => $this->input->POST('dp_topic')." : ".$this->input->post('dp_id')."/".$this->input->post('dp_name'),
                );
                $this->db->insert('tb_user_log', $dataLog);
                $Response = array('action' => 'Y','output' => 'ลบรายการ'.$this->input->POST('dp_topic').'เรียบร้อย');
                echo json_encode($Response);
            }
        }else{
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการ'.$this->input->POST('dp_topic').'ได้');
            echo json_encode($Response);
            exit;
        }
    }

    public function dele_photo(){
        $dp_id=$this->input->post('dp_id');
        $name=$this->input->post('name');

        $this->db->trans_begin();
            //dele photo
            $sql="SELECT * FROM tb_depart WHERE dp_id='$dp_id'";
            $Re_dp = $this->db->query($sql);
            foreach ($Re_dp->result() as $row_Re_dp);

            if($name=='photo'){
                if(!empty($row_Re_dp->p_photo) AND file_exists('public/images/department/'.$row_Re_dp->dp_photo)){
                    unlink('public/images/department/'.$row_Re_dp->dp_photo);
                }
                $data = array('dp_photo' => NULL,);
            }

            $this->db->where('dp_id', $this->input->post('dp_id'));
            $this->db->update('tb_depart', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => '<i class="fas fa-exclamation-triangle"></i> ไม่สามารถลบรูปภาพได้');
            echo json_encode($Response);
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }

    public function list(){

        $dptype = $this->input->POST('dptype');
        $pA = $this->input->POST('pA');

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
        $data['pA'] = $pA;
        $data['Re'] = $this->B_Role_m->getList($dptype);
        $this->load->view('backoffice/project_fetch', $data);
    }

    //photo show
    public function list_photo(){
        $dp_id=$this->input->post('dp_id');

        $sql="SELECT * FROM tb_depart WHERE dp_id='$dp_id'";
        $Re_dp = $this->db->query($sql);
        foreach ($Re_dp->result() as $row_Re_dp);

        $output='<div class="form-row"><div class="form-group col-md-3">';
        if(!empty($row_Re_dp->dp_photo)){
            $output.='<button type="button" class="btn_fm btn_red btn_photo_dele" id="photo" name="'.$row_Re_dp->dp_id.'"><i class="fas fa-times"></i> ลบ</button><br><img class="img-fluid w-100" src="'.base_url('public/images/department/'.$row_Re_dp->dp_photo).'">';
        }else{
            $output.='<button type="button" class="btn_fm btn_red" disabled><i class="fas fa-times"></i> ลบ</button><br><img class="img-fluid w-100" src="'.base_url('public/images/nophoto.png').'">';
        }
        $output.='<br>ตัวอย่างภาพหน่วยงาน</div><div class="form-group col-md-3">';

        echo $output;
    }
}
