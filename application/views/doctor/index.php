<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/animations.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/main.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/admin.css">
        
    <title>Dashboard</title>
    <style>
        .dashbord-tables,.doctor-header{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table,#anim{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .doctor-heade{
            animation: transitionIn-Y-over 0.5s;
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
                                    <img src="<?= base_url('assets'); ?>/img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="<?= base_url('auth'); ?>/logout" ><input type="button" value="Keluar" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active" >
                        <a href="<?= base_url('dokter'); ?>/index" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Dashboard</p></a></div></a>
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
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
                        <tr >
                            
                            <td colspan="1" class="nav-bar" >
                            <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">     Dashboard</p>
                          
                            </td>
                            <td width="25%">

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

        $this->load->database();
        $patientrow = $this->db->get('patient');
        $doctorrow = $this->db->get('doctor');
        $appointmentrow = $this->db->get_where('appointment', array('appodate >=' => $today));
        $schedulerow = $this->db->get_where('schedule', array('scheduledate' => $today));
        ?>
    </p>
</td>

                            <td width="10%">
                                <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                            </td>
        
        
                        </tr>
                <tr>
                    <td colspan="4" >
                        
                    <center>
                    <table class="filter-container doctor-header" style="border: none;width:95%" border="0" >
                    <tr>
                        <td >
                            <h3>Selamat Datang!</h3>
                            <h1><?php echo $username  ?>.</h1>
                            <p>Terima kasih telah bergabung bersama kami. Kami selalu berusaha memberikan layanan yang lengkap kepada Anda<br>
Anda dapat melihat jadwal harian Anda, menjangkau janji pasien di rumah!<br><br>
</p>

                            <a href="<?= base_url('dokter'); ?>/appointment" class="non-style-link"><button class="btn-primary btn" style="width:30%">Lihat Jadwal Temuku</button></a>
                            <br>
                            <br>
                        </td>
                    </tr>
                    </table>
                    </center>
                    
                </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table border="0" width="100%"">
                            <tr>
                                <td width="50%">

                                    




                                    <center>
                                        <table class="filter-container" style="border: none;" border="0">
                                            <tr>
                                                <td colspan="4">
                                                    <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Status</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 25%;">
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex">
                                                        <div>
                                                                <div class="h1-dashboard">
                                                                    <?php    echo $doctorrow->num_rows()  ?>
                                                                </div><br>
                                                                <div class="h3-dashboard">
                                                                    Jumlah Dokter &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                </div>
                                                        </div>
                                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/doctors-hover.svg');"></div>
                                                    </div>
                                                </td>
                                                <td style="width: 25%;">
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;">
                                                        <div>
                                                                <div class="h1-dashboard">
                                                                    <?php    echo $patientrow->num_rows()  ?>
                                                                </div><br>
                                                                <div class="h3-dashboard">
                                                                    Jumlah pasien &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                </div>
                                                        </div>
                                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/patients-hover.svg');"></div>
                                                    </div>
                                                </td>
                                                </tr>
                                                <tr>
                                                <td style="width: 25%;">
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex; ">
                                                        <div>
                                                                <div class="h1-dashboard" >
                                                                    <?php    echo $appointmentrow ->num_rows()  ?>
                                                                </div><br>
                                                                <div class="h3-dashboard" >
                                                                    Janji baru &nbsp;&nbsp;
                                                                </div>
                                                        </div>
                                                                <div class="btn-icon-back dashboard-icons" style="margin-left: 0px;background-image: url('../img/icons/book-hover.svg');"></div>
                                                    </div>
                                                    
                                                </td>

                                                <td style="width: 25%;">
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;padding-top:21px;padding-bottom:21px;">
                                                        <div>
                                                                <div class="h1-dashboard">
                                                                    <?php    echo $schedulerow ->num_rows()  ?>
                                                                </div><br>
                                                                <div class="h3-dashboard" style="font-size: 15px">
                                                                    Sesi Hari ini
                                                                </div>
                                                        </div>
                                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/session-iceblue.svg');"></div>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                        </table>
                                    </center>








                                </td>
                                <td>


                            
                                    <p id="anim" style="font-size: 20px;font-weight:600;padding-left: 40px;">Sesi praktek anda hingga minggu depan</p>
                                    <center>
                                        <div class="abc scroll" style="height: 250px;padding: 0;margin: 0;">
                                        <table width="85%" class="sub-table scrolldown" border="0" >
                                        <thead>
                                            
                                        <tr>
                                                <th class="table-headin">
                                                    
                                                
                                                Nama Sesi
                                                
                                                </th>
                                                
                                                <th class="table-headin">
                                                Tanggal
                                                </th>
                                                <th class="table-headin">
                                                    
                                                     Jam
                                                    
                                                </th>
                                                    
                                                </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <?php
$this->load->database();
$nextweek = date("Y-m-d", strtotime("+1 week"));
$this->db->select('schedule.scheduleid, schedule.title, doctor.docname, schedule.scheduledate, schedule.scheduletime, schedule.nop');
$this->db->from('schedule');
$this->db->join('doctor', 'schedule.docid = doctor.docid');
$this->db->where('schedule.scheduledate >=', $today);
$this->db->where('schedule.scheduledate <=', $nextweek);
$this->db->order_by('schedule.scheduledate', 'desc');
$query = $this->db->get();

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
        echo '<tr>
            <td style="padding:20px;">  ' .
            substr($title, 0, 30)
            . '</td>
            <td style="padding:20px;font-size:13px;">
            ' . substr($scheduledate, 0, 10) . '
            </td>
            <td style="text-align:center;">
                ' . substr($scheduletime, 0, 5) . '
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
                    </td>
                <tr>
            </table>
        </div>
    </div>


</body>
</html>