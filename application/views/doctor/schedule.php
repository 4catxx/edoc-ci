<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/animations.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/main.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/admin.css">
        
    <title>Schedule</title>
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
                    <td class="menu-btn menu-icon-session menu-active menu-icon-session-active">
                        <a href="<?= base_url('dokter'); ?>/schedule" class="non-style-link-menu  non-style-link-menu-active"><div><p class="menu-text">Sesi Praktek</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="<?= base_url('dokter'); ?>/patient" class="non-style-link-menu"><div><p class="menu-text">Pasien</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="<?= base_url('dokter'); ?>/settings" class="non-style-link-menu"><div><p class="menu-text">Pengaturan</p></a></div>
                    </td>
                </tr>
         </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="<?= base_url('dokter'); ?>/schedule" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Sesi Praktek</p>
                                           
                    </td>
                    <td width="15%">
    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
        Tanggal Hari ini
    </p>
    <p class="heading-sub12" style="padding: 0;margin: 0;">
        <?php 
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');
        echo $today;

        $list110 = $this->db->get_where('schedule', array('docid' => $userid));
        ?>
    </p>
</td>
<td width="10%">
    <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
</td>


                </tr>
               
                
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                    
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Praktek ku (<?php echo $list110->num_rows(); ?>) </p>
                    </td>
                    
                </tr>
                
                <tr>
                    <td colspan="4" style="padding-top:0px;width: 100%;" >
                        <center>
                        <table class="filter-container" border="0" >
                        <tr>
                           <td width="10%">

                           </td> 
                        <td width="5%" style="text-align: center;">
                        Date:
                        </td>
                        
                        <td width="30%">
                        <form action="" method="post">
                            
                            <input type="date" name="scheduledate" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">

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
                
                <?php
                
$this->db->select('schedule.scheduleid, schedule.title, doctor.docname, schedule.scheduledate, schedule.scheduletime, schedule.nop, schedule.status');
$this->db->from('schedule');
$this->db->join('doctor', 'schedule.docid = doctor.docid');
$this->db->where('doctor.docid', $userid);

if ($this->input->post()) {
    if (!empty($this->input->post("scheduledate"))) {
        $scheduledate = $this->input->post("scheduledate");
        $this->db->where('schedule.scheduledate', $scheduledate);
    }
}

$query = $this->db->get();

?>

<tr>
    <td colspan="4">
        <div style="text-align: left; margin-left: 30px; margin-bottom: 20px;">
        <?php
    if (isset($scheduledate)) {
        // Tampilkan link untuk export PDF dengan filter tanggal jika $scheduledate telah didefinisikan
        ?>
        <a href="<?= base_url('dokter_controller'); ?>/export_schedule/pdf/<?= $scheduledate; ?>">
            <button class="login-btn btn-primary-soft btn btn-pdf" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                <font class="tn-in-text">PDF</font>
            </button>
        </a>
        <?php
    } else {
        // Tampilkan link untuk export PDF tanpa filter tanggal jika $scheduledate belum didefinisikan
        ?>
        <a href="<?= base_url('dokter_controller'); ?>/export_schedule/pdf">
            <button class="login-btn btn-primary-soft btn btn-pdf" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                <font class="tn-in-text">PDF</font>
            </button>
        </a>
        <?php
    }
?>


        </div>
        <div style="text-align: center; margin-left: 50px;">
            <div class="abc scroll">
                <table width="93%" class="sub-table scrolldown" border="0">
                    <thead>
                        <tr>
                            <th class="table-headin">Nama sesi</th>
                            <th class="table-headin">Jadwal Sesi</th>
                            <th class="table-headin">Maks Pasien</th>
                            <th class="table-headin">Events</th>
                            <th class="table-headin">Status</th>
                        </tr>
                    </thead>
                    <tbody>


                        
                        <?php
if ($query->num_rows() == 0) {
    echo '<tr>
    <td colspan="4">
    <br><br><br><br>
    <center>
    <img src="../img/notfound.svg" width="25%">
    
    <br>
    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
    <a class="non-style-link" href="'.base_url('dokter').'/schedule"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">  Show all Sessions  </font></button>
    </a>
    </center>
    <br><br><br><br>
    </td>
    </tr>';
} else {

    foreach ($query->result_array() as $row) {
        $scheduleid = $row["scheduleid"];
        $title = $row["title"];
        $docname = $row["docname"];
        $scheduledate = $row["scheduledate"];
        $scheduletime = $row["scheduletime"];
        $nop = $row["nop"];
        $status = $row["status"];
    
        echo '<tr>
            <td>  '.
            substr($title,0,30)
            .'</td>
            
            <td style="text-align:center;">
                '.substr($scheduledate,0,10).' '.substr($scheduletime,0,5).'
            </td>
            <td style="text-align:center;">
                '.$nop.'
            </td>
    
            <td>
            <div style="display:flex;justify-content: center;">
            
            <a href="?action=view&id='.$scheduleid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 30px;padding-top: 20px;padding-bottom: 12px;margin-top: 0px;background-image: url(\''.base_url('assets/img/icons/view-iceblue.svg').'\'); background-repeat: no-repeat; background-position: center; background-size: 20px;"><font class="tn-in-text"></font></button></a>';
            
        if ($status != 'Dibatalkan' && $status != 'Sukses') {
            echo '   
            <a href="?action=drop&id='.$scheduleid.'&name='.$title.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon"  style="padding-left: 30px;padding-top: 20px;padding-bottom: 12px;margin-top: 0px; margin-left: 10px; background-image: url(\''.base_url('assets/img/icons/delete-iceblue.svg').'\'); background-repeat: no-repeat; background-position: center; background-size: 20px;"><font class="tn-in-text"></font></button></a>';
            
            echo '<a href="'.base_url('dokter_controller/update_status_sukses/'.$scheduleid).'" class="non-style-link"><button class="btn-primary-soft btn button-icon" style="padding-left: 30px;padding-top: 20px;padding-bottom: 12px;margin-top: 0px; margin-left: 10px;background-image: url(\''.base_url('assets/img/icons/check.png').'\'); background-repeat: no-repeat; background-position: center; background-size: 20px;"><font class="tn-in-text"></font></button></a>';
        }
        
        echo '</div>
            </td>
            <td style="text-align:center;">
            '.$status.'
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
    
    if($_GET){
        $id=$_GET["id"];
        $action=$_GET["action"];
        if($action=='drop'){
            $nameget=$_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="schedule.php">×</a>
                        <div class="content">
                            Apa anda yakin ingin membatalkan sesi praktek ini?<br>('.substr($nameget,0,40).').
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="'.base_url('dokter_controller/update_status/'.$id).'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text"> Yes </font></button></a>   
                        <a href="schedule.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">  No  </font></button></a>
    
                        </div>
                    </center>
            </div>
            </div>
            ';     
        }elseif ($action == 'view') {
            $query = $this->db->select('schedule.scheduleid, schedule.title, doctor.docname, schedule.scheduledate, schedule.scheduletime, schedule.nop')
                ->from('schedule')
                ->join('doctor', 'schedule.docid = doctor.docid')
                ->where('schedule.scheduleid', $id)
                ->get();
            $row = $query->row_array();
            $docname = $row["docname"];
            $scheduleid = $row["scheduleid"];
            $title = $row["title"];
            $scheduledate = $row["scheduledate"];
            $scheduletime = $row["scheduletime"];
            $nop = $row['nop'];
        
            $query12 = $this->db->select('*')
                ->from('appointment')
                ->join('patient', 'patient.pid = appointment.pid')
                ->join('schedule', 'schedule.scheduleid = appointment.scheduleid')
                ->where('schedule.scheduleid', $id)
                ->get();
        
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup" style="width: 70%;">
                    <center>
                        <h2></h2>
                        <a class="close" href="'.base_url('dokter').'/schedule">&times;</a>
                        <div class="content">
                            
                            
                        </div>
                        <div class="abc scroll" style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Detail</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Nama Sesi: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$title.'<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Dokter Praktek: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$docname.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">Tanggal sesi: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$scheduledate.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Jam Sesi: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$scheduletime.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label"><b>Pasien yang sudah mendaftar:</b> ('.$result12->num_rows."/".$nop.')</label>
                                    <br><br>
                                </td>
                            </tr>

                            
                            <tr>
                            <td colspan="4">
                                <center>
                                 <div class="abc scroll">
                                 <table width="100%" class="sub-table scrolldown" border="0">
                                 <thead>
                                 <tr>   
                                        <th class="table-headin">
                                             ID Pasien
                                         </th>
                                         <th class="table-headin">
                                             Nama Pasien
                                         </th>
                                         <th class="table-headin">
                                             
                                             Antrian
                                             
                                         </th>
                                        
                                         
                                         <th class="table-headin">
                                             Telp Pasien
                                         </th>
                                         
                                 </thead>
                                 <tbody>';
                                 
                
                                 if ($query12->num_rows() == 0) {

                                    echo '<tr>
                                    <td colspan="7">
                                        <br><br><br><br>
                                        <center>
                                            <img src="../img/notfound.svg" width="25%">
                                            <br>
                                            <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldn\'t find anything related to your keywords!</p>
                                            <a class="non-style-link" href="'.base_url('dokter/appointment').'"><button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center;margin-left:20px;">  Show all Appointments  </button></a>
                                        </center>
                                        <br><br><br><br>
                                    </td>
                                </tr>';
                                
                                             
                                         }
                                         else {
                                            foreach ($query12->result_array() as $row) {
                                                $apponum = $row["apponum"];
                                                $pid = $row["pid"];
                                                $pname = $row["pname"];
                                                $ptel = $row["ptel"];
                                        
                                             
                                             echo '<tr style="text-align:center;">
                                                <td>
                                                '.substr($pid,0,15).'
                                                </td>
                                                 <td style="font-weight:600;padding:25px">'.
                                                 
                                                 substr($pname,0,25)
                                                 .'</td >
                                                 <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">
                                                 '.$apponum.'
                                                 
                                                 </td>
                                                 <td>
                                                 '.substr($ptel,0,25).'
                                                 </td>
                                                 
                                                 
                
                                                 
                                             </tr>';
                                             
                                         }
                                     }
                                          
                                     
                
                                    echo '</tbody>
                
                                 </table>
                                 </div>
                                 </center>
                            </td> 
                         </tr>

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';  
    }
}

    ?>
    </div>

</body>
</html>