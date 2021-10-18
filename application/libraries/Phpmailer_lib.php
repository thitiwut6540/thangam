<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Phpmailer_lib
{
    public function __construct()
    {
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load(){
        require APPPATH.'third_party/PHPMailer/src/Exception.php';
        require APPPATH.'third_party/PHPMailer/src/PHPMailer.php';
        require APPPATH.'third_party/PHPMailer/src/SMTP.php';
        $mail = new PHPMailer;
        return $mail;
    }
}