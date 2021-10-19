<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('M_Notify_m');
    }

    public function line(){

        $msg = "Test line notify";
        $this->M_Notify_m->getLineNotify($msg);
        
    }

}
