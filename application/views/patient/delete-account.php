<?php

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
    

    $this->load->database();
$sqlmain= "select * from patient where pemail=?";
$query = $this->db->query($sqlmain, array($useremail));
$userfetch = $query->row();
if (isset($userfetch))
{
    $userid= $userfetch->pid;
    $username=$userfetch->pname;
}

if($this->input->get('id')){
    $id = $this->input->get('id');
    $sqlmain= "select * from patient where pid=?";
    $query = $this->db->query($sqlmain, array($id));
    $email = ($query->row())->pemail;

    $sqlmain= "delete from webuser where email=?;";
    $this->db->query($sqlmain, array($email));

    $sqlmain= "delete from patient where pemail=?";
    $this->db->query($sqlmain, array($email));

    redirect("auth/logout.php");
}
?>
