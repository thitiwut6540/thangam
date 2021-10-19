<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Ita extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->model('B_Function_m');
        $this->load->model('B_Ita_m');

        if($this->session->userdata(''.ANW_SS.'login')!=TRUE  
            OR !$this->session->userdata(''.ANW_SS.'us_name') 
            OR !$this->session->userdata(''.ANW_SS.'usl_id') 
            OR !$this->session->userdata(''.ANW_SS.'usa_num')) {
                redirect('backoffice/login', 'refresh');
        }
        $accesstype_no='307';
        $usa_num = $this->session->userdata(''.ANW_SS.'usa_num') ;
        $chk_accesstype=strpos($usa_num,$accesstype_no);
        if ($chk_accesstype === FALSE){
            redirect('backoffice/accesstype', 'refresh');
        }
    }

    public function ita_year(){
        $data['pA'] =  'm_ita_year';
        $data['Re'] = $this->B_Ita_m->getItaYear();
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/ita_year',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function ita_year_detail(){
        $year = $this->uri->segment(4);
        $data['year'] = $year;
        $data['pA'] =  'm_ita_year';
        $data['Re'] = $this->B_Ita_m->getItaYearDetail($year);
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/ita_year_detail',$data);
        $this->load->view('backoffice/template/a_footer');
    }




    public function ita_new(){
        $data['pA'] =  'm_ita_new';
        $data['Re'] = $this->B_Ita_m->getMasterGroup();
        $this->load->view('backoffice/template/a_header');
        $this->load->view('backoffice/template/_nav');
        $this->load->view('backoffice/ita_new',$data);
        $this->load->view('backoffice/template/a_footer');
    }

    public function ita_master_group_form(){ 
        $output='
            <div class="form-row">
                <div class="form-group col-3">
                    <label>หมายเลข</label> 
                    <input type="text" id="g_no" name="g_no" class="form-control form-control-sm">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12">
                    <label>ชื่อกลุ่มขัอมูล ITA</label> 
                    <input type="text" id="g_name" name="g_name" class="form-control form-control-sm">
                </div>
            </div>';
        echo $output;
        exit;
    }
    public function ita_master_group_save(){ 
        $Re=$this->B_Ita_m->getMasterGroupNew($this->input->POST());
        echo json_encode($Re);
    }
    public function ita_master_group_edit_form(){ 
        $g_id = $this->input->POST('g_id');
        $Re = $this->B_Ita_m->getMasterGroupID($g_id);
        foreach ($Re['Re_g'] as $row_Re_g);
        $output='
            <div class="form-row">
                <div class="form-group col-3">
                    <label>หมายเลข</label> 
                    <input type="text" id="g_no" name="g_no" class="form-control form-control-sm" value="'.$row_Re_g->g_no.'">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12">
                    <label>ชื่อกลุ่มขัอมูล ITA</label> 
                    <input type="text" id="g_name" name="g_name" class="form-control form-control-sm" value="'.$row_Re_g->g_name.'">
                    <input type="hidden" id="g_id" name="g_id" value="'.$row_Re_g->g_id.'">
                </div>
            </div>';
        echo $output;
        exit;
    }
    public function ita_master_group_edit_save(){ 
        $Re=$this->B_Ita_m->getMasterGroupEdit($this->input->POST());
        echo json_encode($Re);
    }
    public function ita_master_group_delete(){
        $this->db->trans_begin();
            $this->db->where('g_id', $this->input->POST('g_id'));
            $this->db->delete('tb_ita_master_group');

            $this->db->where('g_id', $this->input->POST('g_id'));
            $this->db->delete('tb_ita_master_topic');

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


    public function ita_master_topic_form(){ 
        $output='
            <div class="form-row">
                <div class="form-group col-12">
                    <label>ชื่อหัวข้อ ITA</label> 
                    <input type="text" id="t_name" name="t_name" class="form-control form-control-sm">
                    <input type="hidden" id="g_id" name="g_id" value="'.$this->input->POST('g_id').'">
                </div>
            </div>';
        echo $output;
        exit;
    }
    public function ita_master_topic_save(){ 
        $Re=$this->B_Ita_m->getMasterTopicNew($this->input->POST());
        echo json_encode($Re);
    }
    public function ita_master_topic_edit_form(){ 
        $t_id = $this->input->POST('t_id');
        $Re = $this->B_Ita_m->getMasterTopicID($t_id);
        foreach ($Re['Re_t'] as $row_Re_t);
        $output='
            <div class="form-row">
                <div class="form-group col-12">
                    <label>ชื่อหัวข้อ ITA</label> 
                    <input type="text" id="t_name" name="t_name" class="form-control form-control-sm required" value="'.$row_Re_t->t_name.'">
                    <input type="hidden" id="t_id" name="t_id" value="'.$row_Re_t->t_id.'">
                </div>
            </div>';
        echo $output;
        exit;
    }
    public function ita_master_topic_edit_save(){ 
        $Re=$this->B_Ita_m->getMasterTopicEdit($this->input->POST());
        echo json_encode($Re);
    }
    public function ita_master_topic_delete(){
        $this->db->trans_begin();
            $this->db->where('t_id', $this->input->POST('t_id'));
            $this->db->delete('tb_ita_master_topic');

            $this->db->where('t_id', $this->input->POST('t_id'));
            $this->db->delete('tb_ita_master_sub');
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


    public function ita_master_sub_form(){ 
        $t_id = $this->input->POST('t_id');
        $Re = $this->B_Ita_m->getMasterTopicID($t_id);
        foreach ($Re['Re_t'] as $row_Re_t);
        $output='
            <div class="form-row">
                <div class="form-group col-6">
                    <label>หมายเลข</label> 
                    <input type="text" id="t_name" name="t_name" class="form-control form-control-sm" value="'.$row_Re_t->t_name.'" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-3">
                    <label>หมายเลข</label> 
                    <input type="text" id="s_no" name="s_no" class="form-control form-control-sm">
                    <input type="hidden" id="g_id" name="g_id" value="'.$this->input->POST('g_id').'">
                    <input type="hidden" id="t_id" name="t_id" value="'.$row_Re_t->t_id.'">
                </div>
                <div class="form-group col-9">
                    <label>ชื่อรายการ</label> 
                    <input type="text" id="s_name" name="s_name" class="form-control form-control-sm">
                </div>
            </div>';
        echo $output;
        exit;
    }
    public function ita_master_sub_save(){ 
        $Re=$this->B_Ita_m->getMasterSubNew($this->input->POST());
        echo json_encode($Re);
    }
    public function ita_master_sub_edit_form(){ 
        $s_id = $this->input->POST('s_id');
        $Re = $this->B_Ita_m->getMasterSubID($s_id);
        foreach ($Re['Re_s'] as $row_Re_s);
        $output='
            <div class="form-row">
                <div class="form-group col-3">
                    <label>หัวข้อ</label> 
                    <input type="text" id="t_name" name="t_name" class="form-control form-control-sm" value="'.$row_Re_s->t_name.'" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-3">
                    <label>หมายเลข</label> 
                    <input type="text" id="s_no" name="s_no" class="form-control form-control-sm" value="'.$row_Re_s->s_no.'">
                </div>
                <div class="form-group col-9">
                    <label>ชื่อรายการ</label> 
                    <input type="text" id="s_name" name="s_name" class="form-control form-control-sm" value="'.$row_Re_s->s_name.'">
                    <input type="hidden" id="s_id" name="s_id" value="'.$row_Re_s->s_id.'">
                </div>
            </div>';
        echo $output;
        exit;
    }
    public function ita_master_sub_edit_save(){ 
        $Re=$this->B_Ita_m->getMasterSubEdit($this->input->POST());
        echo json_encode($Re);
    }
    public function ita_master_sub_delete(){
        $this->db->trans_begin();
            $this->db->where('s_id', $this->input->POST('s_id'));
            $this->db->delete('tb_ita_master_sub');
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


    public function ita_master_year_save(){ 
        $Re=$this->B_Ita_m->getMasterYearNew($this->input->POST());
        echo json_encode($Re);
    }

    public function ita_year_delete(){
        $this->db->trans_begin();
            $this->db->where('y_id', $this->input->POST('y_id'));
            $this->db->delete('tb_ita_year');

            $this->db->where('y_id', $this->input->POST('y_id'));
            $this->db->delete('tb_ita_year_group');

            $this->db->where('y_id', $this->input->POST('y_id'));
            $this->db->delete('tb_ita_year_topic');

            $this->db->where('y_id', $this->input->POST('y_id'));
            $this->db->delete('tb_ita_year_sub');

            $this->db->where('y_id', $this->input->POST('y_id'));
            $this->db->delete('tb_ita_year_url');

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
    public function ita_year_status(){ 
        $Re=$this->B_Ita_m->getYearStatus($this->input->POST());
        echo json_encode($Re);
    }
    public function ita_year_url_form(){ 
        $y_id = $this->input->POST('y_id');
        $g_id = $this->input->POST('g_id');
        $t_id = $this->input->POST('t_id');
        $s_id = $this->input->POST('s_id');
        $output='
            <div class="form-row">
                <div class="form-group col-12">
                    <label>ชื่อหัวข้อข้อมูล</label> 
                    <input type="text" id="u_name" name="u_name" class="form-control form-control-sm">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12">
                    <label>URL ลิ้งที่อยู่ของข้อมูล (ตัวอย่าง : http://www.chonglom.go.th) ITA</label> 
                    <input type="text" id="u_url" name="u_url" class="form-control form-control-sm">
                    <input type="hidden" id="y_id" name="y_id" value="'.$y_id .'">
                    <input type="hidden" id="g_id" name="g_id" value="'.$g_id .'">
                    <input type="hidden" id="t_id" name="t_id" value="'.$t_id .'">
                    <input type="hidden" id="s_id" name="s_id" value="'.$s_id .'">
                </div>
            </div>';
        echo $output;
        exit;
    }
    public function ita_year_url_save(){ 
        $Re=$this->B_Ita_m->getYearUrlNew($this->input->POST());
        echo json_encode($Re);
    }
    public function ita_year_url_delete(){
        $this->db->trans_begin();
            $this->db->where('u_id', $this->input->POST('u_id'));
            $this->db->delete('tb_ita_year_url');

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

}
