<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Operations extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->model('B_Function_m');
        $this->load->model('B_Operations_m');
        $this->load->library('upload');
        $this->load->library('image_lib');
    }

    public function operations_list(){

        $this->load->library('pagination');
        $search = array(
            'SH_dp_name' => $this->input->post('SH_dp_name'),
        );
		$limit = 20;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Operations/operations_list');
        $config['total_rows'] = $this->B_Operations_m->getOprList($limit, $offset, $search, $count=true);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
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
		$data['Re'] = $this->B_Operations_m->getOprList($limit, $offset, $search, $count=false);
        $data['pagelinks'] = $this->pagination->create_links();
        // print_r($data);
        // exit;
        $this->load->view('backoffice/operations_list_fetch', $data);
    }

    public function insert(){ 
        
        $this->db->trans_begin();
            $data = array(
                'opr_id' => NULL,
                'dp_id' => $this->input->POST('dp_id'),
                'opr_name' => $this->input->POST('opr_name'),
                'opr_date' => date("Y-m-d H:i:s"),
                'opr_counter' => 0,
                'mem_id' => NULL,
            );
            $this->db->insert('tb_opr', $data);
            $id = $this->db->insert_id();

            if($this->B_Operations_m->emptyArray($_FILES['opr_f_file']['name'])){
                $count=count($_FILES['opr_f_file']['name']);
                $files = $_FILES;
                for($i = 0; $i<$count; $i++){
                    if(!empty($_FILES['opr_f_file']['name'][$i])){
                        
                        $_FILES['temp']['name']= $files['opr_f_file']['name'][$i];
                        $_FILES['temp']['type']= $files['opr_f_file']['type'][$i];
                        $_FILES['temp']['tmp_name']= $files['opr_f_file']['tmp_name'][$i];
                        $_FILES['temp']['error']= $files['opr_f_file']['error'][$i];
                        $_FILES['temp']['size']= $files['opr_f_file']['size'][$i];
            
                        if(!empty($_FILES['opr_f_file']['name'][$i])) {
            
                            $config['upload_path'] = './public/file/operations'; 
                            $config['allowed_types'] = 'pdf|jpg|png';
                            $config['max_size'] = 0;
                            $config['file_name'] = "OP".date('ymdhis').rand(1000,9999);
                            $this->upload->initialize($config);
                            
                            if($this->upload->do_upload('temp')){
                                $data=$this->upload->data();
                                $file_ul=$data['file_name'];
                            }
                        }

                        $data = array(
                            'opr_id' => $id,
                            'opr_f_file' => $file_ul,
                        );
            
                        $this->db->insert('tb_opr_f', $data);
                    }
                }
            }
        //exit;
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'บันทึกผลการดำเนินงานเรียบร้อย');
            echo json_encode($Response);
            exit;
        }
            
    }

    public function edit(){ 

        $opr_id = $this->input->post('opr_id');
        $opr_name = $this->input->post('opr_name');

        if($this->input->post('action')=="opr-edit"){

            $chk ="SELECT opr_name FROM tb_opr WHERE opr_name = '$opr_name' AND opr_id != '$opr_id'";
            $Re_chk = $this->db->query($chk);
            $total_Re_chk=$Re_chk->num_rows();
            if($total_Re_chk>0){
                $Response = array('action' => 'D','output' => '<i class="fas fa-exclamation-triangle"></i> ผลการดำเนินงาน : '.$opr_name.' มีในระบบแล้ว');
                echo json_encode($Response);
                exit;
            }else{

                $this->db->trans_begin();
                    //start transaction
                    $data = array(
                        'opr_id' => NULL,
                        'dp_id' => $this->input->POST('dp_id'),
                        'opr_name' => $this->input->POST('opr_name'),
                        'opr_date' => date("Y-m-d H:i:s"),
                        'opr_counter' => 0,
                        'mem_id' => NULL,
                    );

                    $this->db->where('opr_id', $opr_id);
                    $this->db->update('tb_opr', $data);

                    // Photo --
                    if($this->B_Operations_m->emptyArray($_FILES['opr_f_file']['name'])){
                        $count=count($_FILES['opr_f_file']['name']);
                        $files = $_FILES;
                        for($i = 0; $i<$count; $i++){
                            if(!empty($_FILES['opr_f_file']['name'][$i])){
                                
                                $_FILES['temp']['name']= $files['opr_f_file']['name'][$i];
                                $_FILES['temp']['type']= $files['opr_f_file']['type'][$i];
                                $_FILES['temp']['tmp_name']= $files['opr_f_file']['tmp_name'][$i];
                                $_FILES['temp']['error']= $files['opr_f_file']['error'][$i];
                                $_FILES['temp']['size']= $files['opr_f_file']['size'][$i];
                    
                                if(!empty($_FILES['opr_f_file']['name'][$i])) {
                    
                                    $config['upload_path'] = './public/file/operations'; 
                                    $config['allowed_types'] = 'pdf|jpg|png';
                                    $config['max_size'] = 0;
                                    $config['file_name'] = "OP".date('ymdhis').rand(1000,9999);
                                    $this->upload->initialize($config);
                                    
                                    if($this->upload->do_upload('temp')){
                                        $data=$this->upload->data();
                                        $file_ul=$data['file_name'];
                                    }
                                }
        
                                $data = array(
                                    'opr_id' => $opr_id,
                                    'opr_f_file' => $file_ul,
                                );
                    
                                $this->db->insert('tb_opr_f', $data);
                            }
                        }
                    }

                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    $Response = array('action' => 'N','output' => '<i class="fas fa-exclamation-triangle"></i> ไม่สามารถบันทึกแก้ไขข้อมูลได้กรุณาตรวจสอบ');
                    echo json_encode($Response);
                    exit;
                }else{
                    $this->db->trans_commit();
                    $Response = array('action' => 'Y','id' => $opr_id,'output' => '<i class="fas fa-check"></i> บันทึกแก้ไขข้อมูลเรียบร้อย');
                    echo json_encode($Response);
                    exit;
                }
            }

        }
    }

    public function delete(){

        if($this->input->post('action')=="delete"){
            $opr_id=$this->input->post('opr_id');

            $this->db->select("*");
            $this->db->from("tb_opr_f");
            $this->db->where("opr_id", $opr_id);
            $query1 = $this->db->get();
            $total_Re_opr=$query1->num_rows();

            foreach ($query1->result() as $row){
                if(!empty($row->opr_f_file)){$oprf_dele = $row->opr_f_file;}else{$opr_f_file = "";}
            }

            $this->db->trans_begin();

                foreach ($query1->result() as $row2){
                    if(!empty($row2->opr_f_file) AND file_exists('public/file/operations/'.$row2->opr_f_file)){
                        unlink('public/file/operations/'.$row2->opr_f_file);
                    }
                }
                
                //start transaction
                $this->db->where('opr_id', $opr_id);
                $this->db->delete('tb_opr');

                $this->db->where('opr_id', $opr_id);
                $this->db->delete('tb_opr_f');
                //end transaction
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการผลการดำเนินงานได้');
                echo json_encode($Response);
                exit;
                
            }else{
                $this->db->trans_commit();
                $Response = array('action' => 'Y','output' => 'ลบรายการผลการดำเนินงานเรียบร้อย');
                echo json_encode($Response);
            }
        }else{
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการผลการดำเนินงานได้');
            echo json_encode($Response);
            exit;
        }
    }

    public function dele_file(){
        $opr_f_id=$this->input->post('opr_f_id');
        $name=$this->input->post('name');

        $this->db->trans_begin();
            //dele file
            $sql="SELECT * FROM tb_opr_f WHERE opr_f_id='$opr_f_id'";
            $Re_file = $this->db->query($sql);
            foreach ($Re_file->result() as $row);

            if(!empty($row->opr_f_file)){$opr_f_file = $row->opr_f_file;}else{$opr_f_file = "";}

            if($name=='file'){

                if(!empty($opr_f_file) AND file_exists('public/file/operations/'.$opr_f_file)){
                    unlink('public/file/operations/'.$opr_f_file);
                }

                $data = array('opr_f_file' => NULL,);
            }

            $this->db->where('opr_f_id', $opr_f_id);
            $this->db->delete('tb_opr_f');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => '<i class="fas fa-exclamation-triangle"></i> ไม่สามารถลบไฟล์เอกสารได้');
            echo json_encode($Response);
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }

    public function list_file(){
        $opr_id=$this->input->post('opr_id');

        $this->db->select("*");
        $this->db->from("tb_opr_f");
        $this->db->where("opr_id", $opr_id);
        $Re_oprf = $this->db->get();

        $output='<div class="form-row"><div class="form-group col-md-3">';
        foreach ($Re_oprf->result() as $row_Re_oprf){
            if(!empty($row_Re_oprf->opr_f_file)){
                $output.='<button type="button" class="btn_fm btn_red btn_file_dele" id="file" name="'.$row_Re_oprf->opr_f_id.'"><i class="fas fa-times"></i> ลบ</button><br>
                <i class="fas fa-file m-2 p-2 border rounded bg-dark text-white"></i> '.$row_Re_oprf->opr_f_file.'';
            }
            $output.='</div><div class="form-group col-md-3">';
        }
        echo $output;
    }

}
