<?php
class M_Research_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function getSave($data){

        if(isset($data['rs_1_1'])){$rs_1_1=$data['rs_1_1'];}else{$rs_1_1='';}
        if(isset($data['rs_1_2'])){$rs_1_2=$data['rs_1_2'];}else{$rs_1_2='';}
        if(isset($data['rs_1_3'])){$rs_1_3=$data['rs_1_3'];}else{$rs_1_3='';}
        if(isset($data['rs_1_4'])){$rs_1_4=$data['rs_1_4'];}else{$rs_1_4='';}
        if(isset($data['rs_1_5'])){$rs_1_5=$data['rs_1_5'];}else{$rs_1_5='';}
        if(isset($data['rs_1_6'])){$rs_1_6=$data['rs_1_6'];}else{$rs_1_6='';}
        if(isset($data['rs_1_7'])){$rs_1_7=$data['rs_1_7'];}else{$rs_1_7='';}
        if(isset($data['rs_1_8'])){$rs_1_8=$data['rs_1_8'];}else{$rs_1_8='';}
        if(isset($data['rs_1_9'])){$rs_1_9=$data['rs_1_9'];}else{$rs_1_9='';}
        if(isset($data['rs_1_10'])){$rs_1_10=$data['rs_1_10'];}else{$rs_1_10='';}
        if(isset($data['rs_1_11'])){$rs_1_11=$data['rs_1_11'];}else{$rs_1_11='';}
        if(isset($data['rs_1_12'])){$rs_1_12=$data['rs_1_12'];}else{$rs_1_12='';}
        if(isset($data['rs_1_13'])){$rs_1_13=$data['rs_1_13'];}else{$rs_1_13='';}
        if(isset($data['rs_1_14'])){$rs_1_14=$data['rs_1_14'];}else{$rs_1_14='';}
        if(isset($data['rs_1_15'])){$rs_1_15=$data['rs_1_15'];}else{$rs_1_15='';}
        if(isset($data['rs_1_16'])){$rs_1_16=$data['rs_1_16'];}else{$rs_1_16='';}
        if(isset($data['rt_chk_5_1'])){$rt_chk_5_1=$data['rt_chk_5_1'];}else{$rt_chk_5_1='';}
        if(isset($data['rt_chk_5_2'])){$rt_chk_5_2=$data['rt_chk_5_2'];}else{$rt_chk_5_2='';}
        if(isset($data['rt_chk_5_3'])){$rt_chk_5_3=$data['rt_chk_5_3'];}else{$rt_chk_5_3='';}
        if(isset($data['rt_chk_5_4'])){$rt_chk_5_4=$data['rt_chk_5_4'];}else{$rt_chk_5_4='';}
        if(isset($data['rt_chk_5_5'])){$rt_chk_5_5=$data['rt_chk_5_5'];}else{$rt_chk_5_5='';}
        if(isset($data['rt_chk_5_6'])){$rt_chk_5_6=$data['rt_chk_5_6'];}else{$rt_chk_5_6='';}

        $this->db->trans_begin();
        $data1 = array(
            'rs_id' => NULL,
            'rs_name' => $data['rs_name'],
            'rs_add' => $data['rs_add'],
            'rs_tel' => $data['rs_tel'],
            'rs_email' => $data['rs_email'],
            'rs_sex' => $data['sex'],
            'rs_age' => $data['age'],
            'rs_1_1' => $rs_1_1,
            'rs_1_2' => $rs_1_2,
            'rs_1_3' => $rs_1_3,
            'rs_1_4' => $rs_1_4,
            'rs_1_5' => $rs_1_5,
            'rs_1_6' => $rs_1_6,
            'rs_1_7' => $rs_1_7,
            'rs_1_8' => $rs_1_8,
            'rs_1_9' => $rs_1_9,
            'rs_1_10' => $rs_1_10,
            'rs_1_11' => $rs_1_11,
            'rs_1_12' => $rs_1_12,
            'rs_1_13' => $rs_1_13,
            'rs_1_14' => $rs_1_14,
            'rs_1_15' => $rs_1_15,
            'rs_1_16' => $rs_1_16,
            'rs_2_1' => $data['rt_step_2_1'],
            'rs_2_2' => $data['rt_step_2_2'],
            'rs_2_3' => $data['rt_step_2_3'],
            'rs_2_4' => $data['rt_step_2_4'],
            'rs_2_5' => $data['rt_step_2_5'],
            'rs_3_1' => $data['rt_step_3_1'],
            'rs_3_2' => $data['rt_step_3_2'],
            'rs_3_3' => $data['rt_step_3_3'],
            'rs_3_4' => $data['rt_step_3_4'],
            'rs_3_5' => $data['rt_step_3_5'],
            'rs_4_1' => $data['rt_step_4_1'],
            'rs_4_2' => $data['rt_step_4_2'],
            'rs_4_3' => $data['rt_step_4_3'],
            'rs_4_4' => $data['rt_step_4_4'],
            'rs_4_5' => $data['rt_step_4_5'],
            'rs_5_1' => $rt_chk_5_1,
            'rs_5_2' => $rt_chk_5_2,
            'rs_5_3' => $rt_chk_5_3,
            'rs_5_4' => $rt_chk_5_4,
            'rs_5_5' => $rt_chk_5_5,
            'rs_5_6' => $rt_chk_5_6,
            'rs_6' => $data['rs_suggestion'],
            'rs_date' => date("Y-m-d H:i:s"),
        );

        $this->db->insert('tb_research', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกแบบประเมิณความพึงพอใจได้');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'ขอบคุณท่านที่บันทึกแบบประเมิณความพึงพอใจ<br>เราจะนำข้อมูลมาใช้ในการพัฒนาการบริการต่อไป');
            return $Response;
            exit;
        }
    }
}