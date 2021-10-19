<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_News extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_News_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('backoffice/login', 'refresh');
        }
        $accesstype_no='301';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('backoffice/accesstype', 'refresh');
        }
    }

    public function type(){
        $data['pA'] = "m_news";
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/news_type',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function type_list(){
        $data['Re'] = $this->B_News_m->getTypeList();
        $this->load->view('backoffice/news_type_fetch', $data);
    }

    public function type_insert_form(){ 
        $output='<div class="form-row">
                <div class="form-group col-12">
                    <label>ชื่อประเภทข่าวสาร</label> 
                    <input type="text" id="newstype_name" name="newstype_name" class="form-control form-control-sm">
                </div>
            </div>';
        echo $output;
        exit;
    }

    public function type_insert_save(){ 
        $Re=$this->B_News_m->getTypeInsertSave($this->input->POST());
        echo json_encode($Re);
    }

    public function type_edit_form(){ 
        $Re= $this->B_News_m->getTypeEdit($this->input->POST('newstype_id'));
        foreach ($Re['Re_nt'] as $row_Re_nt);
        $output='<div class="form-row">
                <div class="form-group col-12">
                    <label>ชื่อประเภทข่าวสาร</label> 
                    <input type="text" id="newstype_name" name="newstype_name" class="form-control form-control-sm" value="'.$row_Re_nt->newstype_name.'">
                    <input type="hidden" id="newstype_id" name="newstype_id" value="'.$row_Re_nt->newstype_id.'">
                </div>
            </div>';
        echo $output;
        exit;
    }

    public function type_edit_save(){ 
        $Re=$this->B_News_m->getTypeEditSave($this->input->POST());
        echo json_encode($Re);
    }

    public function type_delete(){
        $this->db->trans_begin();
            $this->db->where('newstype_id', $this->input->POST('newstype_id'));
            $this->db->delete('tb_news_type');
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

    public function news(){
        $type = $this->uri->segment(3);
        $depart = $this->uri->segment(4);

        $data['type'] = $type;
        $data['type_id'] = $this->B_News_m->getTypeByName($type);
        $data['depart'] = $depart;
        if(!empty($depart)){
            $data['depart_id'] = $this->B_News_m->getDepartByName($depart);
        }else{
            $data['depart_id'] = '';
        }

        $data['ReDPT'] = $this->B_News_m->getDPT();
    
        $data['pA'] = $depart;
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/news',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function news_insert(){
        $data['type'] = $this->uri->segment(3);
        $data['type_id'] = $this->B_News_m->getTypeByName($this->uri->segment(3));
        $data['depart'] = $this->uri->segment(4);
        $data['ReDPT'] = $this->B_News_m->getDPT();
        $data['ReDepart'] = $this->B_News_m->getDepart();

        $data['pA'] = $this->uri->segment(4);
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/news_insert',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function news_insert_save(){ 

        $dd =$this->B_Function_m->dateEng($this->input->POST('news_date_post'));
        $dt =$this->input->POST('news_time');
        $news_date=$dd." ".$dt;

        if(!empty($_FILES['news_photo']['name'])) {
            $config['upload_path'] ='./public/images/news';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 0;
            $config['file_name'] = "NP".date('YmdHis').rand(1000,9999);
            $this->upload->initialize($config);
            if($this->upload->do_upload('news_photo')){
                $data=$this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = './public/images/news/'.$data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width']         = 920;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $news_p=$data['file_name'];
            }else{$news_p='';}
        }else{$news_p='';}

        $this->db->trans_begin();
            $data = array(
                'news_id' => NULL,
                'news_approve' => 'N',
                'news_status' => $this->input->POST('news_status'),
                'newstype_id' => $this->input->POST('newstype_id'),
                'dp_id' => $this->input->POST('dp_id'),
                'news_name' => $this->input->POST('news_name'),
                'news_detail' => $this->input->POST('news_detail'),
                'news_photo' => $news_p,
                'news_date' => $news_date,
                'news_user' => $_SESSION[''.ANW_SS.'us_id'],
            );
            $this->db->insert('tb_news', $data);
            $news_id=$this->db->insert_id();

            if($this->B_News_m->emptyArray($_FILES['newsf_name']['name'])){
                $count=count($_FILES['newsf_name']['name']);
                $files = $_FILES;
                for($i = 0; $i<$count; $i++){
                    if(!empty($_FILES['newsf_name']['name'][$i])){
                        $_FILES['temp']['name']= $files['newsf_name']['name'][$i];
                        $_FILES['temp']['type']= $files['newsf_name']['type'][$i];
                        $_FILES['temp']['tmp_name']= $files['newsf_name']['tmp_name'][$i];
                        $_FILES['temp']['error']= $files['newsf_name']['error'][$i];
                        $_FILES['temp']['size']= $files['newsf_name']['size'][$i];
            
                        if(!empty($_FILES['newsf_name']['name'][$i])) {
            
                            $config['upload_path'] = './public/files/news'; 
                            $config['allowed_types'] = 'pdf';
                            $config['max_size'] = 0;
                            $config['file_name'] = "NF".date('ymdhis').rand(1000,9999);
                            $this->upload->initialize($config);
                            
                            if($this->upload->do_upload('temp')){
                                $data=$this->upload->data();
                                $file_ul=$data['file_name'];
                            }
                        }

                        $data = array(
                            'newsf_id' => NULL,
                            'news_id' => $news_id,
                            'newsf_name' => $file_ul,
                            'newsf_detail' => $_POST['newsf_detail'][$i],
                        );
                        $this->db->insert('tb_news_file', $data);
                    }
                }
            }

            if($this->B_News_m->emptyArray($_POST['nl_link'])){
                $count2=count($_POST['nl_link']);
                for($ii = 0; $ii<$count2; $ii++){
                    if(!empty($_POST['nl_link'][$ii])){
                        $data2 = array(
                            'nl_id' => NULL,
                            'news_id' => $news_id,
                            'nl_link' => $_POST['nl_link'][$ii],
                        );
                        $this->db->insert('tb_news_link', $data2);
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

    public function news_add_file(){ 
        $id="1".rand(1000,9999);
        $output='<div id="'.$id.'" class="form-row"><div class="form-group col-4"><input type="file" name="newsf_name[]" class="form-control form-control-sm"></div><div class="form-group col-4"><input type="text" name="newsf_detail[]" class="form-control form-control-sm" placeholder="ชื่อเรียกเอกสาร"/></div><div class="form-group col-4"><button type="button" class="btn btn-sm btn-danger btn_dele_file" data-id="'.$id.'"><i class="fas fa-minus"></i></button></div></div>';

        $Response = array('action' => 'Y','output' => $output);
        echo json_encode($Response);
        exit;
    }

    public function news_add_youtube(){ 
        $id="2".rand(1000,9999);
        $output='<div id="'.$id.'" class="form-row"><div class="form-group col-md-8"><input type="text" name="nl_link[]" class="form-control form-control-sm" placeholder="วางลิงค์ Youtube"></div><div class="form-group col-4"><button type="button" class="btn btn-sm btn-danger btn_dele_youtube" data-id="'.$id.'"><i class="fas fa-minus"></i></button></div></div>';

        $Response = array('action' => 'Y','output' => $output);
        echo json_encode($Response);
        exit;
    }

    public function news_list(){

        $search = array(
            'type_id' => trim($this->input->POST('SH_type_id')),
            'dp_id' => trim($this->input->POST('SH_dp_id')),
            'news_name' => trim($this->input->post('SH_name')),
        );

        $this->load->library('pagination');
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_News/news_list');
        $config['total_rows'] = $this->B_News_m->getNewsList($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->B_News_m->getNewsList($limit, $offset, $search, $count=false);
        $data['type'] = $this->input->POST('SH_type_name');
        $data['depart'] = $this->input->POST('SH_depart_name');
		$data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('backoffice/news_fetch', $data);
    }


    public function news_dele_photo(){
        $news_id =$this->input->post('news_id');
        $sql="SELECT * FROM tb_news WHERE news_id='$news_id'";
        $Re = $this->db->query($sql);
        foreach ($Re->result() as $row);
        $delFile=$row->news_photo;

        $this->db->trans_begin();
            $data = array(
                'news_photo' => '',
            );
            $this->db->where('news_id ', $news_id);
            $this->db->update('tb_news',$data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบ ภาพข่าวสาร ได้');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            if(!empty($delFile)){
                if(!empty($delFile) AND file_exists('public/images/news/'.$delFile)){
                    unlink('public/images/news/'.$delFile);
                }
            }
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }

    public function news_dele_file(){
        $newsf_id =$this->input->post('newsf_id');
        $sql="SELECT * FROM tb_news_file WHERE newsf_id='$newsf_id'";
        $Re = $this->db->query($sql);
        foreach ($Re->result() as $row);
        $delFile=$row->newsf_name;

        $this->db->trans_begin();
            $this->db->where('newsf_id ', $newsf_id);
            $this->db->delete('tb_news_file');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบ แนบไฟล์เอกสาร ได้');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            if(!empty($delFile)){
                if(!empty($delFile) AND file_exists('public/files/news/'.$delFile)){
                    unlink('public/files/news/'.$delFile);
                }
            }
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }
    
    public function news_dele_youtube(){
        $nl_id =$this->input->post('nl_id');
        $this->db->trans_begin();
            $this->db->where('nl_id ', $nl_id);
            $this->db->delete('tb_news_link');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบ Youtube ได้');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }

    public function news_edit(){

        $data['type'] = $this->uri->segment(3);
        $data['type_id'] = $this->B_News_m->getTypeByName($this->uri->segment(3));
        $data['depart'] = $this->uri->segment(4);
        $data['ReDPT'] = $this->B_News_m->getDPT();
        $data['ReDepart'] = $this->B_News_m->getDepart();
        $data['Re'] = $this->B_News_m->getNewsEdit($this->uri->segment(5));

        $data['pA'] = $this->uri->segment(4);
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/news_edit',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function news_edit_save(){ 

        $news_id =$this->input->post('news_id');
        $dd =$this->B_Function_m->dateEng($this->input->POST('news_date_post'));
        $dt =$this->input->POST('news_time');
        $news_date=$dd." ".$dt;

        if(!empty($_FILES['news_photo']['name'])) {
            
            $sql="SELECT * FROM tb_news WHERE news_id='$news_id'";
            $Re = $this->db->query($sql);
            foreach ($Re->result() as $row);
            $delFile=$row->news_photo;
            if(!empty($delFile)){
                if(!empty($delFile) AND file_exists('public/images/news/'.$delFile)){
                    unlink('public/images/news/'.$delFile);
                }
            }

            $config['upload_path'] ='./public/images/news';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 0;
            $config['file_name'] = "NP".date('YmdHis').rand(1000,9999);
            $this->upload->initialize($config);
            if($this->upload->do_upload('news_photo')){
                $data=$this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = './public/images/news/'.$data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width']         = 920;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $news_p=$data['file_name'];
            }else{$news_p=$this->input->post('h_news_photo');}
        }else{$news_p=$this->input->post('h_news_photo');}

        $this->db->trans_begin();
            $data = array(
                'news_approve' => 'N',
                'news_status' => $this->input->POST('news_status'),
                'newstype_id' => $this->input->POST('newstype_id'),
                'dp_id' => $this->input->POST('dp_id'),
                'news_name' => $this->input->POST('news_name'),
                'news_detail' => $this->input->POST('news_detail'),
                'news_photo' => $news_p,
                'news_date' => $news_date,
                'news_user' => $_SESSION[''.ANW_SS.'us_id'],
            );
            $this->db->where('news_id', $news_id);
            $this->db->update('tb_news', $data);

            if($this->B_News_m->emptyArray($_FILES['newsf_name']['name'])){
                $count=count($_FILES['newsf_name']['name']);
                $files = $_FILES;
                for($i = 0; $i<$count; $i++){
                    if(!empty($_FILES['newsf_name']['name'][$i])){
                        $_FILES['temp']['name']= $files['newsf_name']['name'][$i];
                        $_FILES['temp']['type']= $files['newsf_name']['type'][$i];
                        $_FILES['temp']['tmp_name']= $files['newsf_name']['tmp_name'][$i];
                        $_FILES['temp']['error']= $files['newsf_name']['error'][$i];
                        $_FILES['temp']['size']= $files['newsf_name']['size'][$i];
            
                        if(!empty($_FILES['newsf_name']['name'][$i])) {
            
                            $config['upload_path'] = './public/files/news'; 
                            $config['allowed_types'] = 'pdf';
                            $config['max_size'] = 0;
                            $config['file_name'] = "NF".date('ymdhis').rand(1000,9999);
                            $this->upload->initialize($config);
                            
                            if($this->upload->do_upload('temp')){
                                $data=$this->upload->data();
                                $file_ul=$data['file_name'];
                            }
                        }

                        $data = array(
                            'newsf_id' => NULL,
                            'news_id' => $news_id,
                            'newsf_name' => $file_ul,
                            'newsf_detail' => $_POST['newsf_detail'][$i],
                        );
                        $this->db->insert('tb_news_file', $data);
                    }
                }
            }

            if($this->B_News_m->emptyArray($_POST['nl_link'])){
                $count2=count($_POST['nl_link']);
                for($ii = 0; $ii<$count2; $ii++){
                    if(!empty($_POST['nl_link'][$ii])){
                        $data2 = array(
                            'nl_id' => NULL,
                            'news_id' => $news_id,
                            'nl_link' => $_POST['nl_link'][$ii],
                        );
                        $this->db->insert('tb_news_link', $data2);
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

    public function news_delete(){

        $news_id=$this->input->post('news_id');
        $this->db->select("*");
        $this->db->from("tb_news");
        $this->db->where("news_id", $news_id);
        $Re1 = $this->db->get();
        foreach ($Re1->result() as $row1);

        $this->db->select("*");
        $this->db->from("tb_news_file");
        $this->db->where("news_id", $news_id);
        $Re2 = $this->db->get();
        $total2=$Re2->num_rows();

        $this->db->trans_begin();

            $this->db->where('news_id', $news_id);
            $this->db->delete('tb_news');

            $this->db->where('news_id', $news_id);
            $this->db->delete('tb_news_file');

            $this->db->where('news_id', $news_id);
            $this->db->delete('tb_news_link');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการข่าวสารได้');
            echo json_encode($Response);
            exit;
            
        }else{
            $this->db->trans_commit();

            if(!empty($row1->news_photo) AND file_exists('public/images/news/'.$row1->news_photo)){
                unlink('public/files/news/'.$row1->news_photo);
            }

            if($total2>0){
                foreach ($Re2->result() as $row2) {
                    if(!empty($row2->newsf_name) AND file_exists('public/files/news/'.$row2->newsf_name)){
                        unlink('public/files/news/'.$row2->newsf_name);
                    }
                }
            }

            $Response = array('action' => 'Y','output' => 'ลบรายการข่าวสารเรียบร้อย');
            echo json_encode($Response);
        }

    }

    public function news_approve(){ 

        $news_id =$this->input->post('news_id');
        $news_approve =$this->input->post('status');
        if($news_approve=='Y'){
            $tx='อนุมัติ';
        }else{
            $tx='ยกเลิกอนุมัติ';
        }

        $this->db->trans_begin();
            $data = array(
                'news_approve' => $news_approve,
            );
            $this->db->where('news_id', $news_id);
            $this->db->update('tb_news', $data);

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
