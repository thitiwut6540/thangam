<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Document extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Document_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('backoffice/login', 'refresh');
        }
        $accesstype_no='400';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('backoffice/accesstype', 'refresh');
        }
    }

    public function type(){
        $data['ReDTM'] = $this->B_Document_m->getDTM();
        $data['pA'] = "ประเภท";
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/document_type',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function type_list(){
        $data['Re'] = $this->B_Document_m->getTypeList();
        $this->load->view('backoffice/document_type_fetch', $data);
    }

    public function type_insert_form(){ 
        $output='<div class="form-row">
                <div class="form-group col-12">
                    <label>ชื่อประเภทเอกสารบริการประชาชน</label> 
                    <input type="text" id="dt_name" name="dt_name" class="form-control form-control-sm">
                </div>
            </div>';
        echo $output;
        exit;
    }

    public function type_insert_save(){ 
        $Re=$this->B_Document_m->getTypeInsertSave($this->input->POST());
        echo json_encode($Re);
    }

    public function type_edit_form(){ 
        $Re= $this->B_Document_m->getTypeEdit($this->input->POST('dt_id'));
        foreach ($Re['Re_dt'] as $row_Re_dt);
        $output='<div class="form-row">
                <div class="form-group col-12">
                    <label>ชื่อประเภทเอกสารบริการประชาชน</label> 
                    <input type="text" id="dt_name" name="dt_name" class="form-control form-control-sm" value="'.$row_Re_dt->dt_name.'">
                    <input type="hidden" id="dt_id" name="dt_id" value="'.$row_Re_dt->dt_id.'">
                </div>
            </div>';
        echo $output;
        exit;
    }

    public function type_edit_save(){ 
        $Re=$this->B_Document_m->getTypeEditSave($this->input->POST());
        echo json_encode($Re);
    }

    public function type_delete(){
        $this->db->trans_begin();
            $this->db->where('dt_id', $this->input->POST('dt_id'));
            $this->db->delete('tb_document_type');
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


    public function document(){
        $type = $this->uri->segment(3);
        $data['type'] = $type;
        if(!empty($type)){
            $data['type_id'] = $this->B_Document_m->getTypeByName($type);
        }else{
            $data['type_id'] = '';
        }

        $data['ReDTM'] = $this->B_Document_m->getDTM();
        $data['pA'] = $type;
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/document',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function document_insert(){
        $type = $this->uri->segment(3);
        $data['type'] = $type;
        if(!empty($type)){
            $data['type_id'] = $this->B_Document_m->getTypeByName($type);
        }else{
            $data['type_id'] = '';
        }

        $data['ReDTM'] = $this->B_Document_m->getDTM();
        $data['ReDP'] = $this->B_Document_m->getDP();
        $data['pA'] = $type;
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/document_insert',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function document_insert_save(){ 

        $dd =$this->B_Function_m->dateEng($this->input->POST('d_date_post'));
        $dt =$this->input->POST('d_time');
        $d_date=$dd." ".$dt;

        $this->db->trans_begin();
            $data = array(
                'd_id' => NULL,
                'd_approve' => 'N',
                'd_status' => $this->input->POST('d_status'),
                'dt_id' => $this->input->POST('dt_id'),
                'dp_id' => $this->input->POST('dp_id'),
                'd_name' => $this->input->POST('d_name'),
                'd_detail' => $this->input->POST('d_detail'),
                'd_date' => $d_date,
                'us_id' => $_SESSION[''.ANW_SS.'us_id'],
            );
            $this->db->insert('tb_document', $data);
            $d_id=$this->db->insert_id();

            if($this->B_Document_m->emptyArray($_FILES['df_file']['name'])){
                $count=count($_FILES['df_file']['name']);
                $files = $_FILES;
                for($i = 0; $i<$count; $i++){
                    if(!empty($_FILES['df_file']['name'][$i])){
                        $_FILES['temp']['name']= $files['df_file']['name'][$i];
                        $_FILES['temp']['type']= $files['df_file']['type'][$i];
                        $_FILES['temp']['tmp_name']= $files['df_file']['tmp_name'][$i];
                        $_FILES['temp']['error']= $files['df_file']['error'][$i];
                        $_FILES['temp']['size']= $files['df_file']['size'][$i];
            
                        if(!empty($_FILES['df_file']['name'][$i])) {
            
                            $config['upload_path'] = './public/files/document'; 
                            $config['allowed_types'] = 'pdf';
                            $config['max_size'] = 0;
                            $config['file_name'] = "DF".date('ymdhis').rand(1000,9999);
                            $this->upload->initialize($config);
                            
                            if($this->upload->do_upload('temp')){
                                $data=$this->upload->data();
                                $file_ul=$data['file_name'];
                            }
                        }

                        $data = array(
                            'df_id' => NULL,
                            'd_id' => $d_id,
                            'df_file' => $file_ul,
                            'df_name' => $_POST['df_name'][$i],
                        );
                        $this->db->insert('tb_document_file', $data);
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

    public function document_add_file(){ 
        $id="1".rand(1000,9999);
        $output='<div id="'.$id.'" class="form-row"><div class="form-group col-4"><input type="file" name="df_file[]" class="form-control form-control-sm"></div><div class="form-group col-4"><input type="text" name="df_name[]" class="form-control form-control-sm" placeholder="ชื่อเรียกเอกสาร"/></div><div class="form-group col-4"><button type="button" class="btn btn-sm btn-danger btn_dele_file" data-id="'.$id.'"><i class="fas fa-minus"></i></button></div></div>';

        $Response = array('action' => 'Y','output' => $output);
        echo json_encode($Response);
        exit;
    }

    public function document_list(){

        $search = array(
            'type_id' => trim($this->input->POST('SH_type_id')),
            'dp_id' => trim($this->input->POST('SH_dp_id')),
            'd_name' => trim($this->input->post('SH_name')),
        );

        $this->load->library('pagination');
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Document/document_list');
        $config['total_rows'] = $this->B_Document_m->getDcList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->B_Document_m->getDcList($limit, $offset, $search, $count=false);
        $data['type'] = $this->input->POST('SH_type_name');
        $data['depart'] = $this->input->POST('SH_depart_name');
		$data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('backoffice/document_fetch', $data);
    }

    public function document_dele_file(){
        $df_id =$this->input->post('df_id');
        $sql="SELECT * FROM tb_document_file WHERE df_id='$df_id'";
        $Re = $this->db->query($sql);
        foreach ($Re->result() as $row);
        $delFile=$row->df_file;

        $this->db->trans_begin();
            $this->db->where('df_id ', $df_id);
            $this->db->delete('tb_document_file');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบ แนบไฟล์เอกสาร ได้');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            if(!empty($delFile)){
                if(!empty($delFile) AND file_exists('public/files/document/'.$delFile)){
                    unlink('public/files/document/'.$delFile);
                }
            }
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }
 
    public function document_edit(){
        $type = $this->uri->segment(3);
        $data['type'] = $type;
        if(!empty($type)){
            $data['type_id'] = $this->B_Document_m->getTypeByName($type);
        }else{
            $data['type_id'] = '';
        }

        $data['ReDTM'] = $this->B_Document_m->getDTM();
        $data['ReDP'] = $this->B_Document_m->getDP();
        $data['Re'] = $this->B_Document_m->getDcEdit($this->uri->segment(5));
        $data['pA'] = $type;
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/document_edit',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function document_edit_save(){ 

        $d_id =$this->input->post('d_id');
        $dd =$this->B_Function_m->dateEng($this->input->POST('d_date_post'));
        $dt =$this->input->POST('d_time');
        $d_date=$dd." ".$dt;

        $this->db->trans_begin();
            $data = array(
                'd_approve' => 'N',
                'd_status' => $this->input->POST('d_status'),
                'dt_id' => $this->input->POST('dt_id'),
                'dp_id' => $this->input->POST('dp_id'),
                'd_name' => $this->input->POST('d_name'),
                'd_detail' => $this->input->POST('d_detail'),
                'd_date' => $d_date,
                'us_id' => $_SESSION[''.ANW_SS.'us_id'],
            );
            $this->db->where('d_id', $d_id);
            $this->db->update('tb_document', $data);

            if($this->B_Document_m->emptyArray($_FILES['df_file']['name'])){
                $count=count($_FILES['df_file']['name']);
                $files = $_FILES;
                for($i = 0; $i<$count; $i++){
                    if(!empty($_FILES['df_file']['name'][$i])){
                        $_FILES['temp']['name']= $files['df_file']['name'][$i];
                        $_FILES['temp']['type']= $files['df_file']['type'][$i];
                        $_FILES['temp']['tmp_name']= $files['df_file']['tmp_name'][$i];
                        $_FILES['temp']['error']= $files['df_file']['error'][$i];
                        $_FILES['temp']['size']= $files['df_file']['size'][$i];
            
                        if(!empty($_FILES['df_file']['name'][$i])) {
            
                            $config['upload_path'] = './public/files/document'; 
                            $config['allowed_types'] = 'pdf';
                            $config['max_size'] = 0;
                            $config['file_name'] = "DF".date('ymdhis').rand(1000,9999);
                            $this->upload->initialize($config);
                            
                            if($this->upload->do_upload('temp')){
                                $data=$this->upload->data();
                                $file_ul=$data['file_name'];
                            }
                        }

                        $data = array(
                            'df_id' => NULL,
                            'd_id' => $d_id,
                            'df_file' => $file_ul,
                            'df_name' => $_POST['df_name'][$i],
                        );
                        $this->db->insert('tb_document_file', $data);
                    }
                }
            }

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

    public function document_delete(){

        $d_id=$this->input->post('d_id');
        $this->db->select("*");
        $this->db->from("tb_document");
        $this->db->where("d_id", $d_id);
        $Re1 = $this->db->get();
        foreach ($Re1->result() as $row1);

        $this->db->select("*");
        $this->db->from("tb_document_file");
        $this->db->where("d_id", $d_id);
        $Re2 = $this->db->get();
        $total2=$Re2->num_rows();
        foreach ($Re2->result() as $row2);


        $this->db->trans_begin();

            $this->db->where('d_id', $d_id);
            $this->db->delete('tb_document');

            $this->db->where('d_id', $d_id);
            $this->db->delete('tb_document_file');

            $this->db->where('d_id', $d_id);
            $this->db->delete('tb_document_link');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการเอกสารบริการประชาชนได้');
            echo json_encode($Response);
            exit;
            
        }else{
            $this->db->trans_commit();

            if(!empty($row1->d_photo) AND file_exists('public/images/document/'.$row1->d_photo)){
                unlink('public/files/document/'.$row1->d_photo);
            }

            if($total2>0){
                foreach ($Re2->result() as $row2) {
                    if(!empty($row2->df_file) AND file_exists('public/files/document/'.$row2->df_file)){
                        unlink('public/files/document/'.$row2->df_file);
                    }
                }
            }

            $Response = array('action' => 'Y','output' => 'ลบรายการเอกสารบริการประชาชนเรียบร้อย');
            echo json_encode($Response);
        }

    }

    public function document_approve(){ 

        $d_id =$this->input->post('d_id');
        $d_approve =$this->input->post('status');
        if($d_approve=='Y'){
            $tx='อนุมัติ';
        }else{
            $tx='ยกเลิกอนุมัติ';
        }

        $this->db->trans_begin();
            $data = array(
                'd_approve' => $d_approve,
            );
            $this->db->where('d_id', $d_id);
            $this->db->update('tb_document', $data);

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
