<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/animations.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/main.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/admin.css">
        
    <title>Patients</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
<?php
    if($this->session->has_userdata('user')){
        if(($this->session->userdata('user'))=="" or $this->session->userdata('usertype')!='d'){
            redirect('auth/login');
        }else{
            $useremail=$this->session->userdata('user');
        }
    }else{
        redirect('auth/login');
    }

    //import database
    
    $query = $this->db->get_where('doctor', array('docemail' => $useremail));
$userfetch = $query->row_array();
$userid = $userfetch["docid"];
$username = $userfetch["docname"];


    //echo $userid;
    //echo $username;
    
    ?>
    <div class="container">
    <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="<?= base_url('auth'); ?>/logout" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord" >
                        <a href="<?= base_url('dokter'); ?>/index" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="<?= base_url('dokter'); ?>/appointment" class="non-style-link-menu"><div><p class="menu-text">Jadwal Temu</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session">
                        <a href="<?= base_url('dokter'); ?>/schedule" class="non-style-link-menu"><div><p class="menu-text">Sesi Praktek</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient  menu-active menu-icon-patient-active">
                        <a href="<?= base_url('dokter'); ?>/patient" class="non-style-link-menu  non-style-link-menu-active"><div><p class="menu-text">Pasien</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="<?= base_url('dokter'); ?>/settings" class="non-style-link-menu"><div><p class="menu-text">Pengaturan</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        <?php
    $selecttype = "My";
    $current = "My patients Only";
    if ($this->input->post()) {
        if ($this->input->post("search")) {
            $keyword = $this->input->post("search12");
            $sqlmain = "select * from patient where pemail='$keyword' or pname='$keyword' or pname like '$keyword%' or pname like '%$keyword' or pname like '%$keyword%' ";
            $selecttype = "my";
        }
        if ($this->input->post("filter")) {
            if ($this->input->post("showonly") == 'all') {
                $sqlmain = "select * from patient";
                $selecttype = "All";
                $current = "All patients";
            } else {
                $sqlmain = "select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid where schedule.docid=$userid;";
                $selecttype = "My";
                $current = "My patients Only";
            }
        }
    } else {
        $sqlmain = "select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid where schedule.docid=$userid;";
        $selecttype = "My";
    }
?>

        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%">

                    <a href="patient.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                        
                    </td>
                    <td>
                        
                    <form action="" method="post" class="header-search">
    <input type="search" name="search12" class="input-text header-searchbar" placeholder="Search Patient name or Email" list="patient">  
    <?php
        echo '<datalist id="patient">';
        $list11 = $this->db->query($sqlmain);
        for ($y=0;$y<$list11->num_rows();$y++){
            $row00=$list11->row_array($y);
            $d=$row00["pname"];
            $c=$row00["pemail"];
            echo "<option value='$d'><br/>";
            echo "<option value='$c'><br/>";
        };
        echo ' </datalist>';
    ?>
    <input type="Submit" value="Search" name="search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
</form>

                        
                    </td>
                    <td width="15%">
    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
        Today's Date
    </p>
    <p class="heading-sub12" style="padding: 0;margin: 0;">
        <?php 
         date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            echo $date;
        ?>
    </p>
</td>
<td width="10%">
    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
</td>



                </tr>
               
                
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)"><?php echo $selecttype." Patients (".$list11->num_rows().")"; ?></p>
                    </td>
                    
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:0px;width: 100%;" >
                        <center>
                        <table class="filter-container" border="0" >
 
                        <form action="" method="post">
                        
                        <td  style="text-align: right;">
                        Show Details About : &nbsp;
                        </td>
                        <td width="30%">
                        <select name="showonly" id="" class="box filter-container-items" style="width:90% ;height: 37px;margin: 0;" >
                                    <option value="" disabled selected hidden><?php echo $current   ?></option><br/>
                                    <option value="my">My Patients Only</option><br/>
                                    <option value="all">All Patients</option><br/>
                                    

                        </select>
                    </td>
                    <td width="12%">
                        <input type="submit"  name="filter" value=" Filter" class=" btn-primary-soft btn button-icon btn-filter"  style="padding: 15px; margin :0;width:100%">
                        </form>
                    </td>

                    </tr>
                            </table>

                        </center>
                    </td>
                    
                </tr>
                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown"  style="border-spacing:0;">
                        <thead>
                        <tr>
                                <th class="table-headin">
                                    
                                
                                Nama
                                
                                </th>
                                <th class="table-headin">
                                    
                                
                                    NIK
                                    
                                </th>
                                <th class="table-headin">
                                
                            
                                Telephone
                                
                                </th>
                                <th class="table-headin">
                                    Email
                                </th>
                                <th class="table-headin">
                                    
                                    Tanggal lahir
                                    
                                </th>
                                <th class="table-headin">
                                    
                                    Events
                                    
                                </tr>
                        </thead>
                        <tbody>
                        
                        <?php
    $result = $this->db->query($sqlmain);
    if($result->num_rows() == 0){
        echo '<tr>
        <td colspan="4">
        <br><br><br><br>
        <center>
        <img src="../img/notfound.svg" width="25%">
        
        <br>
        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldnt find anything related to your keywords !</p>
        <a class="non-style-link" href="patient.php"><button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center;margin-left:20px;">  Show all Patients  </font></button>
        </a>
        </center>
        <br><br><br><br>
        </td>
        </tr>';
    } else {

        for ($x = 0; $x < $result->num_rows(); $x++){
            $row = $result->row_array($x);
            $pid = $row["pid"];
            $name = $row["pname"];
            $email = $row["pemail"];
            $nic = $row["pnic"];
            $dob = $row["pdob"];
            $tel = $row["ptel"];
            
            
            echo '<tr>
                <td>  '.substr($name,0,35).'</td>
                <td>'.substr($nic,0,12).'</td>
                <td>'.substr($tel,0,10).'</td>
                <td>'.substr($email,0,20).'</td>
                <td>'.substr($dob,0,10).'</td>
                
                <td>
                    <div style="display:flex;justify-content: center;">
                        <a href="?action=view&id='.$pid.'" class="non-style-link"><button class="btn-primary-soft btn button-icon btn-view" style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                    </div>
                </td>
            </tr>';
        }
        
                            }
                                 
                            ?>
 
                            </tbody>

                        </table>
                        </div>
                        </center>
                   </td> 
                </tr>
                       
                        
                        
            </table>
        </div>
    </div>
    <?php 
    
    if($this->input->get()){
        $id = $this->input->get("id");
        $action = $this->input->get("action");
        $sqlmain = "select * from patient where pid='$id'";
        $result = $this->db->query($sqlmain);
        $row = $result->row_array();
        $name = $row["pname"];
        $email = $row["pemail"];
        $nic = $row["pnic"];
        $dob = $row["pdob"];
        $tele = $row["ptel"];
        $address = $row["paddress"];
        echo '

            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <a class="close" href="'.base_url('dokter').'/patient">&times;</a>
                        <div class="content">

                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                                </td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Patient ID: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    P-'.$id.'<br><br>
                                </td>
                                
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Nama: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$name.'<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$email.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">NIK: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$nic.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$tele.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Alamat: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                            '.$address.'<br><br>
                            </td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Tanggal lahir: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$dob.'<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="'.base_url('dokter').'/patient"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                
                                    
                                </td>
                
                            </tr>
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        
    };

?>
</div>

</body>
</html>