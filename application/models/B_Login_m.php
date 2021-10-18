<?php
class B_Login_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    public function check($u,$p){

        $this->db->select("*");
        $this->db->from("tb_user");
        $this->db->where("us_user", $u);
        $this->db->where("us_status", "Y");
        $query = $this->db->get();
        $total_Re_chk=$query->num_rows();
        foreach ($query->result() as $row_Re_user);

        if ($total_Re_chk > 0){

            $counter=0;
            $us_login=date("Y-m-d H:i:s");
            if(password_verify($p,$row_Re_user->us_pass)){
                $_SESSION['SS_BO_us_id'] = $row_Re_user->us_id;
                $_SESSION['SS_BO_us_name'] = $row_Re_user->us_name;
                $_SESSION['SS_BO_login_TimeOut'] = ((1000*60)*60)*2;//1hr.

                $us_login=date("Y-m-d H:i:s");
                if($row_Re_user->us_login!=""){
                    $us_login_last=$row_Re_user->us_login;
                }else{
                    $us_login_last=$us_login;
                }
                if($row_Re_user->us_counter=="" OR $row_Re_user->us_counter==null ){
                    $counter=0;
                }else{$counter=$row_Re_user->us_counter;}
                $counter=$row_Re_user->us_counter;
                $us_counter=$counter+1;

                $sql1="UPDATE tb_user SET us_login='$us_login', us_counter='$us_counter' WHERE us_id='".$row_Re_user->us_id."' ";
                $Re_update = $this->db->query($sql1);
                
                return true;
            }else{
                session_unset();
                return false;
            }
        }else{
            session_unset();
            return false;
        }
    }
}