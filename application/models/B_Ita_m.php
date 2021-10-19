<?php
class B_Ita_m extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function emptyArray($array){
        $no=0;
        for($i=0;$i<count($array);$i++){
            if(!empty($array[$i])){
                $no+=1;
            }else{
                $no+=0;
            }
        }
        if($no==0){return false;}else{return true;}
    }

    function getMasterGroup(){
        $this->db->select("*");
        $this->db->from("tb_ita_master_group");
        $this->db->order_by("g_no", "ASC");
        $query = $this->db->get();
        $fetch = array(
            'total_Re_g'=>$query->num_rows(),
            'Re_g'=>$query->result(),
        );
        return $fetch;
    }
    function getMasterGroupID($g_id){
        $this->db->select("*");
        $this->db->from("tb_ita_master_group");
        $this->db->where("g_id", $g_id);
        $query = $this->db->get();
        $fetch = array(
            'Re_g'=>$query->result(),
        );
        return $fetch;
    }
    function getMasterGroupNew($data){

        $this->db->trans_begin();
            $data1 = array(
                'g_id' => NULL,
                'g_no' => $data['g_no'],
                'g_name' => $data['g_name'],
            );
            $this->db->insert('tb_ita_master_group', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'เพิ่มข้อมูลเรียบร้อย');
            return $Response;
            exit;
        }
    }
    function getMasterGroupEdit($data){

        $this->db->trans_begin();
            $data1 = array(
                'g_no' => $data['g_no'],
                'g_name' => $data['g_name'],
            );
            $this->db->where('g_id', $data['g_id']);
            $this->db->update('tb_ita_master_group', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถแก้ไขข้อมูลได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => ' แก้ไขข้อมูลเรียบร้อย');
            return $Response;
            exit;
        }
    }


    function getMasterTopic($g_id){
        $this->db->select("*");
        $this->db->from("tb_ita_master_topic");
        $this->db->where("g_id", $g_id);
        $this->db->order_by("t_id", "ASC");
        $query = $this->db->get();
        $fetch = array(
            'total_Re_t'=>$query->num_rows(),
            'Re_t'=>$query->result(),
        );
        return $fetch;
    }
    function getMasterTopicID($t_id){
        $this->db->select("*");
        $this->db->from("tb_ita_master_topic");
        $this->db->where("t_id", $t_id);
        $query = $this->db->get();
        $fetch = array(
            'Re_t'=>$query->result(),
        );
        return $fetch;
    }
    function getMasterTopicNew($data){

        $this->db->trans_begin();
            $data1 = array(
                't_id' => NULL,
                'g_id' => $data['g_id'],
                't_name' => $data['t_name'],
            );
            $this->db->insert('tb_ita_master_topic', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'เพิ่มข้อมูลเรียบร้อย');
            return $Response;
            exit;
        }
    }
    function getMasterTopicEdit($data){

        $this->db->trans_begin();
            $data1 = array(
                't_name' => $data['t_name'],
            );
            $this->db->where('t_id', $data['t_id']);
            $this->db->update('tb_ita_master_topic', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถแก้ไขข้อมูลได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => ' แก้ไขข้อมูลเรียบร้อย');
            return $Response;
            exit;
        }
    }


    function getMasterSub($t_id){
        $this->db->select("*");
        $this->db->from("tb_ita_master_sub");
        $this->db->where("t_id", $t_id);
        $this->db->order_by("s_no", "ASC");
        $query = $this->db->get();
        $fetch = array(
            'total_Re_s'=>$query->num_rows(),
            'Re_s'=>$query->result(),
        );
        return $fetch;
    }
    function getMasterSubID($s_id){
        $this->db->select("a.*,b.t_name");
        $this->db->from("tb_ita_master_sub a");
        $this->db->join("tb_ita_master_topic b", "a.t_id=b.t_id", "LEFT");
        $this->db->where("a.s_id", $s_id);
        $query = $this->db->get();
        $fetch = array(
            'Re_s'=>$query->result(),
        );
        return $fetch;
    }
    function getMasterSubNew($data){

        $this->db->trans_begin();
            $data1 = array(
                's_id' => NULL,
                'g_id' => $data['g_id'],
                't_id' => $data['t_id'],
                's_no' => $data['s_no'],
                's_name' => $data['s_name'],
            );
            $this->db->insert('tb_ita_master_sub', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'เพิ่มข้อมูลเรียบร้อย');
            return $Response;
            exit;
        }
    }
    function getMasterSubEdit($data){

        $this->db->trans_begin();
            $data1 = array(
                's_no' => $data['s_no'],
                's_name' => $data['s_name'],
            );
            $this->db->where('s_id', $data['s_id']);
            $this->db->update('tb_ita_master_sub', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถแก้ไขข้อมูลได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => ' แก้ไขข้อมูลเรียบร้อย');
            return $Response;
            exit;
        }
    }

    function getMasterYearNew($data){

        $ita_year = $_POST['ita_year'];
        $chk ="SELECT y_name FROM tb_ita_year WHERE y_name = '$ita_year' ";
        $Re_chk = $this->db->query($chk);
        $total_Re_chk=$Re_chk->num_rows();
        if($total_Re_chk>0){
            $Response = array('action' => 'D','output' => 'พ.ศ. : '.$ita_year.' มีในระบบแล้ว');
            echo json_encode($Response);
            exit;
        }else{
            $this->db->trans_begin();

                $d1 = array(
                    'y_id' => NULL,
                    'y_status' => 'N',
                    'y_name' => $_POST['ita_year'],
                );
                $this->db->insert('tb_ita_year', $d1);
                $y_id=$this->db->insert_id();

                if($this->B_Ita_m->emptyArray($data['tx_g_id'])){
                    $count=count($data['tx_g_id']);
                    for($i = 0; $i<$count; $i++){
                        if(!empty($data['tx_g_id'][$i]) AND !empty($data['tx_g_no'][$i]) AND !empty($data['tx_g_name'][$i])){
                            $d2 = array(
                                'id' => NULL,
                                'y_id' => $y_id,
                                'g_id' => $_POST['tx_g_id'][$i],
                                'g_no' => $_POST['tx_g_no'][$i],
                                'g_name' => $_POST['tx_g_name'][$i],
                            );
                            $this->db->insert('tb_ita_year_group', $d2);
                        }
                    }
                }

                if($this->B_Ita_m->emptyArray($data['tx_t_g_id'])){
                    $count=count($data['tx_t_id']);
                    for($i = 0; $i<$count; $i++){
                        if(!empty($data['tx_t_id'][$i]) AND !empty($data['tx_t_g_id'][$i]) AND !empty($data['tx_t_name'][$i])){
                            $d3 = array(
                                'id' => NULL,
                                'y_id' => $y_id,
                                't_id' => $_POST['tx_t_id'][$i],
                                'g_id' => $_POST['tx_t_g_id'][$i],
                                't_name' => $_POST['tx_t_name'][$i],
                            );
                            $this->db->insert('tb_ita_year_topic', $d3);
                        }
                    }
                }

                if($this->B_Ita_m->emptyArray($data['tx_s_id'])){
                    $count=count($data['tx_s_id']);
                    for($i = 0; $i<$count; $i++){
                        if(!empty($data['tx_s_id'][$i]) AND !empty($data['tx_s_g_id'][$i]) AND !empty($data['tx_s_t_id'][$i]) AND !empty($data['tx_s_no'][$i]) AND !empty($data['tx_s_name'][$i])){
                            $d4 = array(
                                'id' => NULL,
                                'y_id' => $y_id,
                                's_id' => $_POST['tx_s_id'][$i],
                                'g_id' => $_POST['tx_s_g_id'][$i],
                                't_id' => $_POST['tx_s_t_id'][$i],
                                's_no' => $_POST['tx_s_no'][$i],
                                's_name' => $_POST['tx_s_name'][$i],
                            );
                            $this->db->insert('tb_ita_year_sub', $d4);
                        }
                    }
                }

            //exit;
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $Response = array('action' => 'N','output' => 'ไม่สามารถสร้างแบบประเมินประจำปีได้');
                return $Response;
                exit;
            }else{
                $this->db->trans_commit();
                $Response = array('action' => 'Y','output' => 'สร้างแบบประเมินประจำปีเรียบร้อย');
                return $Response;
                exit;
            }
        }
    }

    function getYearStatus($data){

        $this->db->trans_begin();
            $d1 = array(
                'y_status' => $data['y_status'],
            );
            $this->db->where('y_id', $data['y_id']);
            $this->db->update('tb_ita_year', $d1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถแก้ไขข้อมูลได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => ' แก้ไขข้อมูลเรียบร้อย');
            return $Response;
            exit;
        }
    }

    function getItaYear(){
        $this->db->select("*");
        $this->db->from("tb_ita_year");
        $this->db->order_by("Y_name", "DESC");
        $query = $this->db->get();
        $fetch = array(
            'total_Re_y'=>$query->num_rows(),
            'Re_y'=>$query->result(),
        );
        return $fetch;
    }

    function getItaYearDetail($year){

        $this->db->select("*");
        $this->db->from("tb_ita_year");
        $this->db->where("y_name", $year);
        $query1 = $this->db->get();
        foreach ($query1->result() as $row_Re_g);
        $y_id=$row_Re_g->y_id;

        $this->db->select("*");
        $this->db->from("tb_ita_year_group");
        $this->db->where("y_id", $y_id);
        $this->db->order_by("g_no", "ASC");
        $query2 = $this->db->get();
        
        $fetch = array(
            'total_Re_g'=>$query2->num_rows(),
            'Re_g'=>$query2->result(),
        );
        return $fetch;
    }

    function getYearTopic($g_id){
        $this->db->select("*");
        $this->db->from("tb_ita_year_topic");
        $this->db->where("g_id", $g_id);
        $this->db->order_by("t_id", "ASC");
        $query = $this->db->get();
        $fetch = array(
            'total_Re_t'=>$query->num_rows(),
            'Re_t'=>$query->result(),
        );
        return $fetch;
    }

    function getYearSub($t_id){
        $this->db->select("*");
        $this->db->from("tb_ita_year_sub");
        $this->db->where("t_id", $t_id);
        $this->db->order_by("s_no", "ASC");
        $query = $this->db->get();
        $fetch = array(
            'total_Re_s'=>$query->num_rows(),
            'Re_s'=>$query->result(),
        );
        return $fetch;
    }

    function getYearUrl($s_id){
        $this->db->select("*");
        $this->db->from("tb_ita_year_url");
        $this->db->where("s_id", $s_id);
        $this->db->order_by("u_id", "ASC");
        $query = $this->db->get();
        $fetch = array(
            'total_Re_u'=>$query->num_rows(),
            'Re_u'=>$query->result(),
        );
        return $fetch;
    }

    function getYearUrlNew($data){

        $this->db->trans_begin();
            $data1 = array(
                'u_id' => NULL,
                'y_id' => $data['y_id'],
                'g_id' => $data['g_id'],
                't_id' => $data['t_id'],
                's_id' => $data['s_id'],
                'u_name' => $data['u_name'],
                'u_url' => $data['u_url']
            );
            $this->db->insert('tb_ita_year_url', $data1);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $Response = array('action' => 'N','output' => 'ไม่สามารถบันทึกข้อมูลได้กรุณาตรวจสอบ');
            return $Response;
            exit;
        }else{
            $this->db->trans_commit();
            $Response = array('action' => 'Y','output' => 'เพิ่มข้อมูลเรียบร้อย');
            return $Response;
            exit;
        }
    }

}