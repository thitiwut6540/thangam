<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backoffice extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper("form", 'url');
        $this->load->model('B_Function_m');
        $this->load->model('B_Dashboard_m');
    }

	public function index(){
        $data['Re_header'] = $this->B_Dashboard_m->getheader();
        $this->load->view('include_backoffice/a_header_login');
        $this->load->view('backoffice/login',$data);
        $this->load->view('include_backoffice/a_footer_login');
    }

    public function login(){
        $this->load->model('B_Login_m');
        $u=$this->input->post('username');
        $p=$this->input->post('password');
        $data = $this->B_Login_m->check($u,$p);
        if($data==true){
            echo "Y";
        }else{
            echo "N";
        }
    }

    public function dashboard(){
        if(!$this->session->userdata('SS_BO_us_name')) {
            redirect('Backoffice', 'refresh');
        }

        $system=$this->uri->segment(2);
        $opr=$this->uri->segment(3);
        $data['system'] = $system;
        $data['pA'] = $opr;
        $data['Re_header'] = $this->B_Dashboard_m->getheader();
        $data['Re_menu'] = $this->B_Dashboard_m->getmenu();
        $this->load->view('include_backoffice/a_header');
        $this->load->view('backoffice/dashboard',$data);
        $this->load->view('include_backoffice/a_footer');
    }

    public function จัดการเว็บไซต์(){
        if(!$this->session->userdata('SS_BO_us_name')) {
            redirect('Backoffice', 'refresh');
        }

        $this->load->model('B_System_m');
        $system=$this->uri->segment(2);
        $opr=$this->uri->segment(3);
        $func=$this->uri->segment(4);
        $data['system'] = $system;
        $data['Re_header'] = $this->B_Dashboard_m->getheader();
        $data['Re_menu'] = $this->B_Dashboard_m->getmenu();

        if($opr == 'ข้อมูลเว็บไซต์'){

            $data['pA'] = $opr;
            $data['jsFile'] = 'b_system_website';
            $data['Re_uc'] = $this->B_System_m->getCompany();
            $this->load->view('include_backoffice/a_header');
            $this->load->view('backoffice/system_website',$data);
            $this->load->view('include_backoffice/a_footer');

        } else if($opr == 'ภาพสไลด์โชว์'){

            $data['jsFile'] = 'b_system_banner';
            $this->load->model('B_Banner_m');

            if(empty($func)){

                $data['pA'] = $opr;
                
                $this->load->view('include_backoffice/a_header');
                $this->load->view('backoffice/system_banner',$data);
                $this->load->view('include_backoffice/a_footer');

            } else if(!empty($func) AND $func == 'เพิ่ม') {

                $data['pA'] = $opr;
                $this->load->view('include_backoffice/a_header');
                $this->load->view('backoffice/system_banner_insert',$data);
                $this->load->view('include_backoffice/a_footer');

            } else if(!empty($func) AND $func == 'แก้ไข') {

                $id=$this->uri->segment(5);
                $data['pA'] = $opr;
                $data['Re_ed'] = $this->B_Banner_m->getEdit($id);
                $this->load->view('include_backoffice/a_header');
                $this->load->view('backoffice/system_banner_edit',$data);
                $this->load->view('include_backoffice/a_footer');

            } 

            

        } else if($opr == 'ผู้ใช้งาน'){

            $data['jsFile'] = 'b_system_user';
            $this->load->model('B_User_m');

            if(empty($func)){

                $data['pA'] = $opr;
                
                $this->load->view('include_backoffice/a_header');
                $this->load->view('backoffice/system_user',$data);
                $this->load->view('include_backoffice/a_footer');

            } else if(!empty($func) AND $func == 'เพิ่ม') {

                $data['pA'] = $opr;
                $this->load->view('include_backoffice/a_header');
                $this->load->view('backoffice/system_user_insert',$data);
                $this->load->view('include_backoffice/a_footer');

            } else if(!empty($func) AND $func == 'แก้ไข') {

                $id=$this->uri->segment(5);
                $data['pA'] = $opr;
                $data['Re_ed'] = $this->B_User_m->getEdit($id);
                $this->load->view('include_backoffice/a_header');
                $this->load->view('backoffice/system_user_edit',$data);
                $this->load->view('include_backoffice/a_footer');

            } 

        } else if($opr == 'เว็บไซต์ที่เกี่ยวข้อง'){

            if(!$this->session->userdata('SS_BO_us_name')) {
                redirect('Backoffice', 'refresh');
            }
    
            $this->load->model('B_Site_m');
            $system=$this->uri->segment(2);
            $topic=$this->uri->segment(3);
            $func=$this->uri->segment(4);
            $data['system'] = $system;
            $data['jsFile'] = 'b_site';
            $data['Re_menu'] = $this->B_Dashboard_m->getmenu();
    
            if(!empty($topic) AND empty($func)){
    
                $data['pA'] = $topic;
                $this->load->view('include_backoffice/a_header');
                $this->load->view('backoffice/site',$data);
                $this->load->view('include_backoffice/a_footer');
    
            } else if(!empty($func) AND $func == 'เพิ่มเว็บที่เกี่ยวข้อง') {
    
                $data['pA'] = $topic;
                $data['Re_sl'] = $this->B_Site_m->getsltopic();
                $this->load->view('include_backoffice/a_header');
                $this->load->view('backoffice/site_insert',$data);
                $this->load->view('include_backoffice/a_footer');
    
            } else if(!empty($func) AND $func == 'เพิ่มหัวข้อเว็บที่เกี่ยวข้อง') {
    
                $data['pA'] = $topic;
                $this->load->view('include_backoffice/a_header');
                $this->load->view('backoffice/site_topic_insert',$data);
                $this->load->view('include_backoffice/a_footer');
    
            } else if(!empty($func) AND $func == 'แก้ไขเว็บที่เกี่ยวข้อง') {
    
                $id=$this->uri->segment(5);
                $data['pA'] = $topic;
                $data['Re_sl'] = $this->B_Site_m->getsltopic();
                $data['Re_ed'] = $this->B_Site_m->getsiteEdit($id);
                $this->load->view('include_backoffice/a_header');
                $this->load->view('backoffice/site_edit',$data);
                $this->load->view('include_backoffice/a_footer');
    
            } else if(!empty($func) AND $func == 'แก้ไขหัวข้อเว็บที่เกี่ยวข้อง') {
    
                $id=$this->uri->segment(5);
                $data['pA'] = $topic;
                $data['Re_ed'] = $this->B_Site_m->getTopicEdit($id);
                $this->load->view('include_backoffice/a_header');
                $this->load->view('backoffice/site_topic_edit',$data);
                $this->load->view('include_backoffice/a_footer');
    
            } 

        }

    }

    public function เพิ่มหัวข้อข่าวสาร(){
        if(!$this->session->userdata('SS_BO_us_name')) {
            redirect('Backoffice', 'refresh');
        }

        $this->load->model('B_Newstype_m');
        $system=$this->uri->segment(2);
        $func=$this->uri->segment(3);
        $data['system'] = $system;
        $data['jsFile'] = 'b_newstype';
        $data['Re_header'] = $this->B_Dashboard_m->getheader();
        $data['Re_menu'] = $this->B_Dashboard_m->getmenu();

        if(empty($func)){

            $data['pA'] = $system;
            
            $this->load->view('include_backoffice/a_header');
            $this->load->view('backoffice/newstype',$data);
            $this->load->view('include_backoffice/a_footer');

        } else if(!empty($func) AND $func == 'เพิ่ม') {

            $data['pA'] = $system;
            $this->load->view('include_backoffice/a_header');
            $this->load->view('backoffice/newstype_insert',$data);
            $this->load->view('include_backoffice/a_footer');

        } else if(!empty($func) AND $func == 'แก้ไข') {

            $id=$this->uri->segment(4);
            $data['pA'] = $system;
            $data['Re_ed'] = $this->B_Newstype_m->getEdit($id);
            $this->load->view('include_backoffice/a_header');
            $this->load->view('backoffice/newstype_edit',$data);
            $this->load->view('include_backoffice/a_footer');

        } 

    }

    public function ข่าวสาร(){
        if(!$this->session->userdata('SS_BO_us_name')) {
            redirect('Backoffice', 'refresh');
        }

        $this->load->model('B_News_m');
        $system=$this->uri->segment(2);
        $topic=$this->uri->segment(3);
        $func=$this->uri->segment(4);
        $data['system'] = $system;
        $data['jsFile'] = 'b_news';
        $data['Re_header'] = $this->B_Dashboard_m->getheader();
        $data['Re_menu'] = $this->B_Dashboard_m->getmenu();

        if(!empty($topic) AND empty($func)){

            $data['pA'] = $topic;
            $data['nt_id'] = $this->B_News_m->getntid($topic);
            $this->load->view('include_backoffice/a_header');
            $this->load->view('backoffice/news',$data);
            $this->load->view('include_backoffice/a_footer');

        } else if(!empty($func) AND $func == 'เพิ่ม') {

            $data['pA'] = $topic;
            $data['nt_id'] = $this->B_News_m->getntid($topic);
            $data['Re_sns'] = $this->B_News_m->getsns($topic);
            $this->load->view('include_backoffice/a_header');
            $this->load->view('backoffice/news_insert',$data);
            $this->load->view('include_backoffice/a_footer');

        } else if(!empty($func) AND $func == 'เพิ่มเมนูย่อย') {

            $data['pA'] = $topic;
            $data['nt_id'] = $this->B_News_m->getntid($topic);
            $this->load->view('include_backoffice/a_header');
            $this->load->view('backoffice/news_sub_insert',$data);
            $this->load->view('include_backoffice/a_footer');

        } else if(!empty($func) AND $func == 'แก้ไข') {

            $id=$this->uri->segment(5);
            $data['pA'] = $topic;
            $data['nt_id'] = $this->B_News_m->getntid($topic);
            $data['Re_sns'] = $this->B_News_m->getsns($topic);
            $data['Re_ed'] = $this->B_News_m->getnewsEdit($id);
            $this->load->view('include_backoffice/a_header');
            $this->load->view('backoffice/news_edit',$data);
            $this->load->view('include_backoffice/a_footer');

        } else if(!empty($func) AND $func == 'แก้ไขเมนูย่อย') {

            $id=$this->uri->segment(5);
            $data['pA'] = $topic;
            $data['nt_id'] = $this->B_News_m->getntid($topic);
            $data['Re_ed'] = $this->B_News_m->getSubEdit($id);
            $this->load->view('include_backoffice/a_header');
            $this->load->view('backoffice/news_sub_edit',$data);
            $this->load->view('include_backoffice/a_footer');

        } 

    }

    
    
}

