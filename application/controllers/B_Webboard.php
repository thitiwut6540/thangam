<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Webboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Webboard_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE
            OR !$this->session->userdata(''.ANW_SS.'us_name')
            OR !$this->session->userdata(''.ANW_SS.'usl_id')
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('backoffice/login', 'refresh');
        }
        $accesstype_no='405';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('backoffice/accesstype', 'refresh');
        }
    }

    //webboard
    public function webboard(){
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/webboard');
        $this->load->view('backoffice/template/a_footer');
    }
    public function webboard_list(){
        $this->load->library('pagination');
        $search= '';
		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config['base_url'] = base_url('B_Webboard/webboard_list');
        $config['total_rows'] = $this->B_Webboard_m->getWB($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->B_Webboard_m->getWB($limit, $offset, $search, $count=false);
        $data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('backoffice/webboard_fetch', $data);
    }

    //topic
    public function webboard_topic_new(){
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/webboard_topic_new');
        $this->load->view('backoffice/template/a_footer');
    }
    public function webboard_topic_new_save(){

        if(!empty($_FILES['wb_t_photo']['name'])) {
            $filename = $_FILES['wb_t_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="WP".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName="";
        }
        $Re=$this->B_Webboard_m->getTopicNewSave($this->input->POST(),$photoName);

        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['wb_t_photo']['name'])) {
                $config['upload_path'] ='./public/images/webboard';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('wb_t_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/webboard/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 420;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
        }
        echo json_encode($Re);
    }
    public function webboard_topic_edit(){
        $wb_t_id = $this->uri->segment(4);
        $data['Re'] = $this->B_Webboard_m->getTopicEdit($wb_t_id);
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/webboard_topic_edit',$data);
        $this->load->view('backoffice/template/a_footer');
    }
    public function webboard_topic_edit_save(){

        if(!empty($_FILES['wb_t_photo']['name'])) {
            $filename = $_FILES['wb_t_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="WP".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName=$this->input->POST('h_wb_t_photo');
        }
        $Re=$this->B_Webboard_m->getTopicEditSave($this->input->POST(),$photoName);

        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['wb_t_photo']['name'])) {
                $config['upload_path'] ='./public/images/webboard';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('wb_t_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/webboard/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 420;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
        }
        echo json_encode($Re);
    }
    public function webboard_topic_delete_photo(){
        $wb_t_id=$this->input->post('wb_t_id');
        $wb_t_photo=$this->input->post('photo');
        $this->db->trans_begin();
            $data = array('wb_t_photo' => '',);
            $this->db->where('wb_t_id', $wb_t_id);
            $this->db->update('tb_wb_topic', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรูปภาพได้');
            echo json_encode($Response);
        }else{
            $this->db->trans_commit();
            if($wb_t_photo!=''){
                if(!empty($wb_t_photo) AND file_exists('public/images/webboard/'.$wb_t_photo)){
                    unlink('public/images/webboard/'.$wb_t_photo);
                }
            }
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }
    public function webboard_topic_delete(){

        $wb_t_id=$this->input->post('wb_t_id');

        $this->db->select("*");
        $this->db->from("tb_wb_topic");
        $this->db->where("wb_t_id", $wb_t_id);
        $query1 = $this->db->get();
        foreach ($query1->result() as $row);

        $this->db->select("*");
        $this->db->from("tb_wb_sub");
        $this->db->where("wb_t_id", $wb_t_id);
        $query2 = $this->db->get();

        $this->db->trans_begin();
            $this->db->where('wb_t_id', $wb_t_id);
            $this->db->delete('tb_wb_topic');

            $this->db->where('wb_t_id', $wb_t_id);
            $this->db->delete('tb_wb_sub');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการหัวข้อได้');
            echo json_encode($Response);
            exit;

        }else{
            $this->db->trans_commit();
            if(!empty($row->wb_t_photo) AND file_exists('public/images/webboard/'.$row->wb_t_photo)){
                unlink('public/images/webboard/'.$row->wb_t_photo);
            }

            foreach ($query2->result() as $row2){
                if(!empty($row2->wb_s_photo) AND file_exists('public/images/webboard/'.$row2->wb_s_photo)){
                    unlink('public/images/webboard/'.$row2->wb_s_photo);
                }
            }
            $Response = array('action' => 'Y','output' => 'ลบรายการหัวข้อเรียบร้อย');
            echo json_encode($Response);
        }

    }


    //sub topics
    public function webboard_sub_new(){
        $wb_t_id = $this->uri->segment(4);
        $data['Re'] = $this->B_Webboard_m->getTopicEdit($wb_t_id);
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/webboard_sub_new',$data);
        $this->load->view('backoffice/template/a_footer');
    }
    public function webboard_sub_new_save(){

        if(!empty($_FILES['wb_s_photo']['name'])) {
            $filename = $_FILES['wb_s_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="WP".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName="";
        }
        $Re=$this->B_Webboard_m->getSubNewSave($this->input->POST(),$photoName);

        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['wb_s_photo']['name'])) {
                $config['upload_path'] ='./public/images/webboard';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('wb_s_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/webboard/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 420;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
        }
        echo json_encode($Re);
    }
    public function webboard_sub_edit(){
        $wb_t_id = $this->uri->segment(6);
        $data['Re'] = $this->B_Webboard_m->getSubEdit($wb_t_id);
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/webboard_sub_edit',$data);
        $this->load->view('backoffice/template/a_footer');
    }
    public function webboard_sub_edit_save(){

        if(!empty($_FILES['wb_s_photo']['name'])) {
            $filename = $_FILES['wb_s_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="WP".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName=$this->input->POST('h_wb_s_photo');
        }
        $Re=$this->B_Webboard_m->getSubEditSave($this->input->POST(),$photoName);

        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['wb_s_photo']['name'])) {
                $config['upload_path'] ='./public/images/webboard';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('wb_s_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/webboard/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 420;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
        }
        echo json_encode($Re);
    }
    public function webboard_sub_delete_photo(){
        $wb_s_id=$this->input->post('wb_s_id');
        $wb_s_photo=$this->input->post('photo');
        $this->db->trans_begin();
            $data = array('wb_s_photo' => '',);
            $this->db->where('wb_s_id', $wb_s_id);
            $this->db->update('tb_wb_sub', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรูปภาพได้');
            echo json_encode($Response);
        }else{
            $this->db->trans_commit();
            if($wb_s_photo!=''){
                if(!empty($wb_s_photo) AND file_exists('public/images/webboard/'.$wb_s_photo)){
                    unlink('public/images/webboard/'.$wb_s_photo);
                }
            }
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }
    public function webboard_sub_delete(){

        $wb_s_id=$this->input->post('wb_s_id');

        $this->db->select("*");
        $this->db->from("tb_wb_sub");
        $this->db->where("wb_s_id", $wb_s_id);
        $query1 = $this->db->get();
        foreach ($query1->result() as $row);

        $this->db->trans_begin();

            $this->db->where('wb_s_id', $wb_s_id);
            $this->db->delete('tb_wb_sub');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรายการหัวข้อย่อยได้');
            echo json_encode($Response);
            exit;

        }else{
            $this->db->trans_commit();
            if(!empty($row->wb_s_photo) AND file_exists('public/images/webboard/'.$row->wb_s_photo)){
                unlink('public/images/webboard/'.$row->wb_s_photo);
            }
            $Response = array('action' => 'Y','output' => 'ลบรายการหัวข้อย่อยเรียบร้อย');
            echo json_encode($Response);
        }

    }
    public function webboard_sub_list(){
        $wb_t_id=$this->input->post('wb_t_id');
		$Re_s_topic = $this->B_Webboard_m->getSubTopic($wb_t_id);

        $output='<table class="table table-sm table-bordered mb-0" width="100%"><thead><tr class="table-secondary"><th class="text-center" width="60">ลำดับ</th><th width="">ชื่อหัวข้อ</th><th class="text-center" width="50">แก้ไข</th><th class="text-center" width="50">ลบ</th></tr></thead><tbody>';

                if ($Re_s_topic['total_Re_stp'] > 0){
                    $s_no=0;
                    foreach ($Re_s_topic['Re_stp'] as $row_Re_stp){
                    $output.='<tr>
                        <td align="center">'.($s_no+=1).'</td>
                        <td align="left">'.$row_Re_stp->wb_s_title.'</td>
                        <td align="center"><a class="btn btn-sm" href="'.base_url('backoffice/webboard/topic/'.$row_Re_stp->wb_t_id.'/แก้ไขหัวข้อย่อย/'.$row_Re_stp->wb_s_id.'').'"><i class="fas fa-pencil-alt"></i></a></td><td align="center">
                            <button class="btn btn-sm btn_sub_dele" data-id="'.$row_Re_stp->wb_s_id.'" data-name="'.$row_Re_stp->wb_s_title.'" data-topic="'.$row_Re_stp->wb_t_id.'" data-url="ajax_wb_sub_'.$row_Re_stp->wb_t_id.'"><i class="fas fa-trash-alt"></i></button></td></tr>';
                }} else {
                    $output.='<tr><td colspan="5"><div class="alert alert-danger mb-0" role="alert"><i class="fas fa-exclamation-triangle"></i> ไม่มีหัวข้อย่อย</div></td></tr>';
                }
                $output.='</tbody></table>';

        $Response = array('action' => 'Y','output' => $output);
        echo json_encode($Response);
        exit;

    }


    //page
    public function webboard_detail(){
        $wb_t_id = $this->uri->segment(4);
        $data['Re'] = $this->B_Webboard_m->getTopic($wb_t_id);
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/webboard_detail',$data);
        $this->load->view('backoffice/template/a_footer');
    }
    public function comment_topic_list(){ 

        $this->load->library('pagination');
        $search = array(
            'wb_t_id' => trim($this->input->POST('wb_t_id')),
        );

		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Webboard/comment_topic_list');
        $config['total_rows'] = $this->B_Webboard_m->getCommentTopic($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->B_Webboard_m->getCommentTopic($limit, $offset, $search, $count=false);
        $data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('backoffice/webboard_detail_topic_fetch', $data);
    }
    public function comment_topic_save(){

        if(!empty($_FILES['wb_p_photo']['name'])) {
            $filename = $_FILES['wb_p_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="WP".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName="";
        }
        $Re=$this->B_Webboard_m->getCommentSave($this->input->POST(),$photoName);

        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['wb_p_photo']['name'])) {
                $config['upload_path'] ='./public/images/webboard';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('wb_p_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/webboard/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 820;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
        }
        echo json_encode($Re);
    }
    public function comment_topic_delete(){

        $wb_p_id=$this->input->post('wb_p_id');

        $this->db->select("*");
        $this->db->from("tb_wb_post");
        $this->db->where("wb_p_id", $wb_p_id);
        $query1 = $this->db->get();
        foreach ($query1->result() as $row);

        $this->db->trans_begin();

            $this->db->where('wb_p_id', $wb_p_id);
            $this->db->delete('tb_wb_post');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบโพสต์ได้');
            echo json_encode($Response);
            exit;

        }else{
            $this->db->trans_commit();
            if(!empty($row->wb_p_photo) AND file_exists('public/images/webboard/'.$row->wb_p_photo)){
                unlink('public/images/webboard/'.$row->wb_p_photo);
            }
            $Response = array('action' => 'Y','output' => 'ลบรายการโพสต์เรียบร้อย');
            echo json_encode($Response);
        }

    }
    public function comment_topic_edit(){
        $wb_p_id = $this->input->POST('wb_p_id');
        $data['Re'] = $this->B_Webboard_m->getComment($wb_p_id);
        $this->load->view('backoffice/webboard_detail_topic_edit.php',$data);
    }
    public function comment_topic_edit_save(){
        if(!empty($_FILES['wb_p_photo']['name'])) {
            $filename = $_FILES['wb_p_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="WP".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName=$this->input->POST('h_wb_p_photo');;
        }
        $Re=$this->B_Webboard_m->getCommentEditSave($this->input->POST(),$photoName);

        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['wb_p_photo']['name'])) {
                $config['upload_path'] ='./public/images/webboard';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('wb_p_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/webboard/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 820;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
        }
        echo json_encode($Re);
    }
    public function comment_topic_delete_photo(){
        $wb_p_id=$this->input->post('wb_p_id');
        $wb_p_photo=$this->input->post('photo');
        $this->db->trans_begin();
            $data = array('wb_p_photo' => '',);
            $this->db->where('wb_p_id', $wb_p_id);
            $this->db->update('tb_wb_post', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรูปภาพได้');
            echo json_encode($Response);
        }else{
            $this->db->trans_commit();
            if($wb_p_photo!=''){
                if(!empty($wb_p_photo) AND file_exists('public/images/webboard/'.$wb_p_photo)){
                    unlink('public/images/webboard/'.$wb_p_photo);
                }
            }
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }
    

    public function webboard_detail_sub(){
        $wb_t_id = $this->uri->segment(4);
        $wb_s_id = $this->uri->segment(6);
        $data['Re'] = $this->B_Webboard_m->getSub($wb_t_id,$wb_s_id);
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/webboard_detail_sub',$data);
        $this->load->view('backoffice/template/a_footer');
    }
    public function comment_sub_list(){ 

        $this->load->library('pagination');
        $search = array(
            'wb_t_id' => trim($this->input->POST('wb_t_id')),
            'wb_s_id' => trim($this->input->POST('wb_s_id')),
        );

		$limit = 50;
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $config['base_url'] = base_url('B_Webboard/comment_sub_list');
        $config['total_rows'] = $this->B_Webboard_m->getCommentSub($limit, $offset, $search, $count=true);
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
		$data['Re'] = $this->B_Webboard_m->getCommentSub($limit, $offset, $search, $count=false);
        $data['pagelinks'] = $this->pagination->create_links();
        $this->load->view('backoffice/webboard_detail_sub_fetch', $data);
    }
    public function comment_sub_save(){

        if(!empty($_FILES['wb_p_photo']['name'])) {
            $filename = $_FILES['wb_p_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="WP".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName="";
        }
        $Re=$this->B_Webboard_m->getCommentSave($this->input->POST(),$photoName);

        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['wb_p_photo']['name'])) {
                $config['upload_path'] ='./public/images/webboard';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('wb_p_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/webboard/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 820;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
        }
        echo json_encode($Re);
    }
    public function comment_sub_delete(){

        $wb_p_id=$this->input->post('wb_p_id');

        $this->db->select("*");
        $this->db->from("tb_wb_post");
        $this->db->where("wb_p_id", $wb_p_id);
        $query1 = $this->db->get();
        foreach ($query1->result() as $row);

        $this->db->trans_begin();

            $this->db->where('wb_p_id', $wb_p_id);
            $this->db->delete('tb_wb_post');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบโพสต์ได้');
            echo json_encode($Response);
            exit;

        }else{
            $this->db->trans_commit();
            if(!empty($row->wb_p_photo) AND file_exists('public/images/webboard/'.$row->wb_p_photo)){
                unlink('public/images/webboard/'.$row->wb_p_photo);
            }
            $Response = array('action' => 'Y','output' => 'ลบรายการโพสต์เรียบร้อย');
            echo json_encode($Response);
        }

    }
    public function comment_sub_edit(){
        $wb_p_id = $this->input->POST('wb_p_id');
        $data['Re'] = $this->B_Webboard_m->getComment($wb_p_id);
        $this->load->view('backoffice/webboard_detail_sub_edit.php',$data);
    }
    public function comment_sub_edit_save(){
        if(!empty($_FILES['wb_p_photo']['name'])) {
            $filename = $_FILES['wb_p_photo']['name'];
            $exp = explode('.' , $filename);
            $photoName="WP".date('YmdHis').rand(1000,9999).".".$exp[1];
        }else{
            $photoName=$this->input->POST('h_wb_p_photo');;
        }
        $Re=$this->B_Webboard_m->getCommentEditSave($this->input->POST(),$photoName);

        if($Re AND $Re['action']=='Y'){
            if(!empty($_FILES['wb_p_photo']['name'])) {
                $config['upload_path'] ='./public/images/webboard';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 0;
                $config['file_name'] = $photoName;
                $this->upload->initialize($config);
                if($this->upload->do_upload('wb_p_photo')){
                    $data=$this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './public/images/webboard/'.$data['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 820;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
        }
        echo json_encode($Re);
    }
    public function comment_sub_delete_photo(){
        $wb_p_id=$this->input->post('wb_p_id');
        $wb_p_photo=$this->input->post('photo');
        $this->db->trans_begin();
            $data = array('wb_p_photo' => '',);
            $this->db->where('wb_p_id', $wb_p_id);
            $this->db->update('tb_wb_post', $data);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถลบรูปภาพได้');
            echo json_encode($Response);
        }else{
            $this->db->trans_commit();
            if($wb_p_photo!=''){
                if(!empty($wb_p_photo) AND file_exists('public/images/webboard/'.$wb_p_photo)){
                    unlink('public/images/webboard/'.$wb_p_photo);
                }
            }
            $Response = array('action' => 'Y');
            echo json_encode($Response);
        }
    }
}
