<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Statute extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Statute_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('backoffice/login', 'refresh');
        }
        $accesstype_no='303';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('backoffice/accesstype', 'refresh');
        }
    }

    public function type(){
        $data['pA'] = "m_statute";
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/statute_type',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function type_list(){
        $data['Re'] = $this->B_Statute_m->getTypeList();
        $this->load->view('backoffice/statute_type_fetch', $data);
    }

    public function type_insert_form(){ 
        $output='<div class="form-row">
                <div class="form-group col-12">
                    <label>ชื่อประเภท</label> 
                    <input type="text" id="stt_t_name" name="stt_t_name" class="form-control form-control-sm">
                </div>
            </div>';
        echo $output;
        exit;
    }

    public function type_insert_save(){ 
        $Re=$this->B_Statute_m->getTypeInsertSave($this->input->POST());
        echo json_encode($Re);
    }

    public function type_edit_form(){ 
        $Re= $this->B_Statute_m->getTypeEdit($this->input->POST('stt_t_id'));
        foreach ($Re['Re_st'] as $row_Re_st);
        $output='<div class="form-row">
                <div class="form-group col-12">
                    <label>ชื่อประเภท</label> 
                    <input type="text" id="stt_t_name" name="stt_t_name" class="form-control form-control-sm" value="'.$row_Re_st->stt_t_name.'">
                    <input type="hidden" id="stt_t_id" name="stt_t_id" value="'.$row_Re_st->stt_t_id.'">
                </div>
            </div>';
        echo $output;
        exit;
    }

    public function type_edit_save(){ 
        $Re=$this->B_Statute_m->getTypeEditSave($this->input->POST());
        echo json_encode($Re);
    }

    public function type_delete(){
        $this->db->trans_begin();
            $this->db->where('stt_t_id', $this->input->POST('stt_t_id'));
            $this->db->delete('tb_statute_type');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการได้');
            echo json_encode($Response);
            exit;
            
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'ลบรายการเรียบร้อย');
            echo json_encode($Response);
        }
    }


    public function statute(){
        $type = $this->uri->segment(3);
        $data['type'] = $type;
        $data['type_id'] = $this->B_Statute_m->getTypeByName($type);
        $data['pA'] = $type;
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/statute',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function statute_insert(){
        $data['type'] = $this->uri->segment(3);
        $data['type_id'] = $this->B_Statute_m->getTypeByName($this->uri->segment(3));
        $data['pA'] = $this->uri->segment(3);
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/statute_insert',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function statute_insert_save(){ 

        $dd =$this->B_Function_m->dateEng($this->input->POST('stt_date_post'));
        $dt =$this->input->POST('stt_time');
        $stt_date=$dd." ".$dt;

        $this->db->trans_begin();
            $data = array(
                'stt_id' => NULL, 
                'stt_status' => $this->input->POST('stt_status'),
                'stt_approve' => 'N',
                'stt_t_id' => $this->input->POST('stt_t_id'),
                'stt_name' => $this->input->POST('stt_name'),
                'stt_date' => $stt_date,
                'us_id' => $_SESSION[''.ANW_SS.'us_id'],
            );
            $this->db->insert('tb_statute', $data);
            $stt_id=$this->db->insert_id();

            if($this->B_Statute_m->emptyArray($_FILES['stt_f_file']['name'])){
                $count=count($_FILES['stt_f_file']['name']);
                $files = $_FILES;
                for($i = 0; $i<$count; $i++){
                    if(!empty($_FILES['stt_f_file']['name'][$i])){
                        $_FILES['temp']['name']= $files['stt_f_file']['name'][$i];
                        $_FILES['temp']['type']= $files['stt_f_file']['type'][$i];
                        $_FILES['temp']['tmp_name']= $files['stt_f_file']['tmp_name'][$i];
                        $_FILES['temp']['error']= $files['stt_f_file']['error'][$i];
                        $_FILES['temp']['size']= $files['stt_f_file']['size'][$i];
            
                        if(!empty($_FILES['stt_f_file']['name'][$i])) {
            
                            $config['upload_path'] = './public/files/statute'; 
                            $config['allowed_types'] = 'pdf';
                            $config['max_size'] = 0;
                            $config['file_name'] = "SF".date('ymdhis').rand(1000,9999);
                            $this->upload->initialize($config);
                            
                            if($this->upload->do_upload('temp')){
                                $data=$this->upload->data();
                                $file_ul=$data['file_name'];
                            }
                        }

                        $data = array(
                            'stt_f_id' => NULL,
                            'stt_id' => $stt_id,
                            'stt_f_file' => $file_ul,
                            'stt_f_name' => $_POST['stt_f_name'][$i],
                        );
                        $this->db->insert('tb_statute_file', $data);
                    }
                }
            }


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

    public function statute_add_file(){ 
        $id="1".rand(1000,9999);
        $output='<div id="'.$id.'" class="form-row"><div class="form-group col-4"><input type="file" name="stt_f_file[]" class="form-control form-control-sm"></div><div class="form-group col-4"><input type="text" name="stt_f_name[]" class="form-control form-control-sm" placeholder="ชื่อเรียกเอกสาร"/></div><div class="form-group col-4"><button type="button" class="btn btn-sm btn-danger btn_dele_file" data-id="'.$id.'"><i class="fas fa-minus"></i></button></div></div>';

        $Response = array('action' => 'Y','output' => $output);
        echo json_encode($Response);
        exit;
    }

    public function statute_list(){

        $search = array(
            'type_id' => trim($this->input->POST('SH_type_id')),
            'stt_name' => trim($this->input->post('SH_name')),
        );

        $this->load->library('pagination');
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Statute/statute_list');
        $config['total_rows'] = $this->B_Statute_m->getSttList($limit, $offset, $search, $count=true);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 2;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="" class="current_page">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = 'Next <i class="fas fa-angle-right"></i>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="fas fa-angle-left"></i> Previous';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_link'] = '<i class="fas fa-angle-double-left"></i> First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last <i class="fas fa-angle-double-right"></i>';
		$config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);
		$data['Re'] = $this->B_Statute_m->getSttList($limit, $offset, $search, $count=false);
        $data['type'] = $this->input->POST('SH_type_name');
		$data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('backoffice/statute_fetch', $data);
    }

    public function statute_dele_file(){
        $stt_f_id =$this->input->post('stt_f_id');
        $sql="SELECT * FROM tb_statute_file WHERE stt_f_id='$stt_f_id'";
        $Re = $this->db->query($sql);
        foreach ($Re->result() as $row);
        $delFile=$row->stt_f_file;

        $this->db->trans_begin();
            $this->db->where('stt_f_id ', $stt_f_id);
            $this->db->delete('tb_statute_file');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบ แนบไฟล์เอกสาร ได้');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            if(!empty($delFile)){
                if(!empty($delFile) AND file_exists('public/files/statute/'.$delFile)){
                    unlink('public/files/statute/'.$delFile);
                }
            }
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }

    public function statute_edit(){

        $data['type'] = $this->uri->segment(3);
        $data['type_id'] = $this->B_Statute_m->getTypeByName($this->uri->segment(3));
        $data['Re'] = $this->B_Statute_m->getSttEdit($this->uri->segment(5));

        $data['pA'] = $this->uri->segment(4);
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/statute_edit',$data);
        $this->load->view('backoffice/template/a_footer');
    }


    public function statute_edit_save(){ 

        $stt_id =$this->input->post('stt_id');
        $dd =$this->B_Function_m->dateEng($this->input->POST('stt_date_post'));
        $dt =$this->input->POST('stt_time');
        $stt_date=$dd." ".$dt;

        $this->db->trans_begin();
            $data = array(
                'stt_status' => $this->input->POST('stt_status'),
                'stt_approve' => 'N',
                'stt_t_id' => $this->input->POST('stt_t_id'),
                'stt_name' => $this->input->POST('stt_name'),
                'stt_date' => $stt_date,
                'us_id' => $_SESSION[''.ANW_SS.'us_id'],
            );
            $this->db->where('stt_id', $stt_id);
            $this->db->update('tb_statute', $data);

            if($this->B_Statute_m->emptyArray($_FILES['stt_f_file']['name'])){
                $count=count($_FILES['stt_f_file']['name']);
                $files = $_FILES;
                for($i = 0; $i<$count; $i++){
                    if(!empty($_FILES['stt_f_file']['name'][$i])){
                        $_FILES['temp']['name']= $files['stt_f_file']['name'][$i];
                        $_FILES['temp']['type']= $files['stt_f_file']['type'][$i];
                        $_FILES['temp']['tmp_name']= $files['stt_f_file']['tmp_name'][$i];
                        $_FILES['temp']['error']= $files['stt_f_file']['error'][$i];
                        $_FILES['temp']['size']= $files['stt_f_file']['size'][$i];
            
                        if(!empty($_FILES['stt_f_file']['name'][$i])) {
            
                            $config['upload_path'] = './public/files/statute'; 
                            $config['allowed_types'] = 'pdf';
                            $config['max_size'] = 0;
                            $config['file_name'] = "SF".date('ymdhis').rand(1000,9999);
                            $this->upload->initialize($config);
                            
                            if($this->upload->do_upload('temp')){
                                $data=$this->upload->data();
                                $file_ul=$data['file_name'];
                            }
                        }

                        $data = array(
                            'stt_f_id' => NULL,
                            'stt_id' => $stt_id,
                            'stt_f_file' => $file_ul,
                            'stt_f_name' => $_POST['stt_f_name'][$i],
                        );
                        $this->db->insert('tb_statute_file', $data);
                    }
                }
            }

        //exit;
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

    public function statute_delete(){

        $stt_id=$this->input->post('stt_id');
        $this->db->select("*");
        $this->db->from("tb_statute_file");
        $this->db->where("stt_id", $stt_id);
        $Re2 = $this->db->get();
        $total2=$Re2->num_rows();
        foreach ($Re2->result() as $row2);

        $this->db->trans_begin();

            $this->db->where('stt_id', $stt_id);
            $this->db->delete('tb_statute');

            $this->db->where('stt_id', $stt_id);
            $this->db->delete('tb_statute_file');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการระเบียบได้');
            echo json_encode($Response);
            exit;
            
        }else{
            $this->db->trans_commit();
            if($total2>0){
                foreach ($Re2->result() as $row2) {
                    if(!empty($row2->stt_f_file) AND file_exists('public/files/statute/'.$row2->stt_f_file)){
                        unlink('public/files/statute/'.$row2->stt_f_file);
                    }
                }
            }
            $Response = array('action' => 'Y','output' => 'ลบรายการระเบียบเรียบร้อย');
            echo json_encode($Response);
        }

    }

    public function statute_approve(){ 

        $stt_id =$this->input->post('stt_id');
        $stt_approve =$this->input->post('status');
        if($stt_approve=='Y'){
            $tx='อนุมัติ';
        }else{
            $tx='ยกเลิกอนุมัติ';
        }

        $this->db->trans_begin();
            $data = array(
                'stt_approve' => $stt_approve,
            );
            $this->db->where('stt_id', $stt_id);
            $this->db->update('tb_statute', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถ '.$tx.' ได้กรุณาตรวจสอบ');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => ''.$tx.' รายการเรียบร้อย');
            echo json_encode($Response);
            exit;
        }

    }
}
