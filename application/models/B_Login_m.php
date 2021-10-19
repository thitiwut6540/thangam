<?php
class B_Login_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    public function check($u,$p){

        $sql ="SELECT a.*, b.usl_id, b.usl_name, b.usa_num FROM tb_user a ";
        $sql.="LEFT JOIN tb_user_level b ON(a.usl_id=b.usl_id) ";
        $sql.="WHERE a.us_user = '$u' AND a.us_status = '1'";
        $Re_user = $this->db->query($sql);
        $row_Re_user = $Re_user->row();

        if ($Re_user->num_rows() < 1){
            $fetch = array(
                'action'=>'N',
                'output'=>'ไม่พบ Username : '.$u.' นี้กรุณาติดต่อผู้ดูแล',
            );
            return $fetch;
            exit;
        }else{
            $counter=0;
            if(password_verify($p,$row_Re_user->us_pass)){
                $_SESSION[''.ANW_SS.'us_id'] = $row_Re_user->us_id;
                $_SESSION[''.ANW_SS.'us_approve'] = $row_Re_user->us_approve;
                $_SESSION[''.ANW_SS.'us_name'] = $row_Re_user->us_name;
                $_SESSION[''.ANW_SS.'dp_id'] = $row_Re_user->dp_id;
                $_SESSION[''.ANW_SS.'usl_id'] = $row_Re_user->usl_id;
                $_SESSION[''.ANW_SS.'usl_name'] = $row_Re_user->usl_name;
                $_SESSION[''.ANW_SS.'usa_num'] = $row_Re_user->usa_num;
                $_SESSION[''.ANW_SS.'login'] = TRUE;

                $us_login_last=date("Y-m-d H:i:s");
                if($row_Re_user->us_counter=="" OR $row_Re_user->us_counter==null ){
                    $counter=0;
                }else{$counter=$row_Re_user->us_counter;}
                $counter=$row_Re_user->us_counter;
                $us_counter=$counter+1;

                $sql1="UPDATE tb_user SET us_login_last='$us_login_last' , us_counter='$us_counter' WHERE us_id='".$row_Re_user->us_id."' ";
                $Re_update = $this->db->query($sql1);

                $fetch = array(
                    'action'=>'Y',
                    'output'=>'',
                );
                return $fetch;
                exit;

            }else{
                $fetch = array(
                    'action'=>'P',
                    'output'=>'Password ไม่ถูกต้องกรุณาตรวจสอบ',
                );
                return $fetch;
                exit;
            }
        }
    }
}