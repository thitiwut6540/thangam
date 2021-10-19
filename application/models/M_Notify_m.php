<?php
class M_Notify_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getLineNotify($message){
        if(!empty(ANW_LINE)){
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            date_default_timezone_set("Asia/Bangkok");
            $sToken = ANW_LINE;
            $sMessage = $message;

            $ch = curl_init(); 
            curl_setopt( $ch, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0); 
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0); 
            curl_setopt( $ch, CURLOPT_POST, 1); 
            curl_setopt( $ch, CURLOPT_POSTFIELDS, "message=".$sMessage); 
            $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1); 
            $result = curl_exec( $ch ); 
            curl_close($ch);  

            if($result == "{}"){
                $fetch['action'] = 'N';
                $fetch['output'] = $result;
            }else{
                $fetch['action'] = 'Y';
                $fetch['output'] = 'Success';
            }
            return $fetch;
        }
    }
}