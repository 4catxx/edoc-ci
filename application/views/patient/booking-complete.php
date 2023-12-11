<?php

    //learn from w3schools.com

    session_start();

    if($this->session->has_userdata('user')){
        if(($this->session->userdata('user'))=="" or $this->session->userdata('usertype')!='p'){
            redirect('auth/login.php');
        }else{
            $useremail=$this->session->userdata('user');
        }
    }else{
        redirect('auth/login.php');
    }
    

    //import database
    $sqlmain= "select * from patient where pemail=?";
$stmt = $this->db->conn_id->prepare($sqlmain);
$stmt->bind_param("s",$useremail);
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch=$userrow->fetch_assoc();
$userid= $userfetch["pid"];
$username=$userfetch["pname"];

if($_POST){
    if(isset($_POST["booknow"])){
        $apponum=$_POST["apponum"];
        $scheduleid=$_POST["scheduleid"];
        $date=$_POST["date"];
        $scheduleid=$_POST["scheduleid"];
        $sql2="insert into appointment(pid,apponum,scheduleid,appodate) values ($userid,$apponum,$scheduleid,'$date')";
        $result= $this->db->query($sql2);
        redirect('patient/appointment?action=booking-added&id='.$apponum.'&titleget=none');

    }
}
?>