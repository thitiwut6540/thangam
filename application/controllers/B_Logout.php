<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_Logout extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

	public function index(){
        $_SESSION['SS_TS_us_id'] = NULL;
        $_SESSION['SS_TS_us_name'] = NULL;
        $_SESSION['SS_TS_us_level_id'] = NULL;
        $_SESSION['SS_TS_us_level'] = NULL;
        $_SESSION['SS_TS_usa_num'] = NULL;
        $_SESSION['SS_TS_us_action'] = NULL;
        $_SESSION['SS_TS_login_TimeOut'] = NULL;

        unset($_SESSION['SS_TS_us_id']);
        unset($_SESSION['SS_TS_us_name']);
        unset($_SESSION['SS_TS_us_level_id']);
        unset($_SESSION['SS_TS_us_level']);
        unset($_SESSION['SS_TS_usa_num']);
        unset($_SESSION['SS_TS_us_action']);
        unset($_SESSION['SS_TS_login_TimeOut']);

        $this->session->sess_destroy();
        redirect('Backoffice', 'refresh');
    }

    public function timeout(){
        if($this->input->POST('action')=='logout'){
            $_SESSION['SS_TS_us_id'] = NULL;
            $_SESSION['SS_TS_us_name'] = NULL;
            $_SESSION['SS_TS_us_level_id'] = NULL;
            $_SESSION['SS_TS_us_level'] = NULL;
            $_SESSION['SS_TS_usa_num'] = NULL;
            $_SESSION['SS_TS_us_action'] = NULL;
            $_SESSION['SS_TS_login_TimeOut'] = NULL;

            unset($_SESSION['SS_TS_us_id']);
            unset($_SESSION['SS_TS_us_name']);
            unset($_SESSION['SS_TS_us_level_id']);
            unset($_SESSION['SS_TS_us_level']);
            unset($_SESSION['SS_TS_usa_num']);
            unset($_SESSION['SS_TS_us_action']);
            unset($_SESSION['SS_TS_login_TimeOut']);
            echo "Y";
        }else{
            echo "N";
        }
    }
}
