<?php

if(isset($_SESSION["user"])){
    if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
        redirect('auth/login.php');
    }
}else{
    redirect('auth/login.php');
}

if($this->input->get('id')){
    $id = $this->input->get('id');
    $this->load->database();
    $sql = "delete from appointment where appoid=?";
    $this->db->query($sql, array($id));
    redirect("dashboard_controller/appointment");
}


?>