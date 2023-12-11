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
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
    
    
</head>
<body>
<?php
    if($this->session->has_userdata('user')){
        if(($this->session->userdata('user'))=="" or $this->session->userdata('usertype')!='a'){
            redirect('auth/login');
        }else{
            $useremail=$this->session->userdata('user');
        }
    }else{
        redirect('auth/login');
    }
    

    
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
                                    <p class="profile-title">Administrator</p>
                                    <p class="profile-subtitle">admin@edoc.com</p>
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
    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active" >
        <a href="<?= base_url('admin'); ?>/index" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Dasbor</p></a></div></a>
    </td>
</tr>
<tr class="menu-row">
    <td class="menu-btn menu-icon-doctor ">
        <a href="<?= base_url('admin'); ?>/doctors" class="non-style-link-menu "><div><p class="menu-text">Dokter</p></a></div>
    </td>
</tr>
<tr class="menu-row" >
    <td class="menu-btn menu-icon-schedule">
        <a href="<?= base_url('admin'); ?>/schedule" class="non-style-link-menu"><div><p class="menu-text">Jadwal</p></div></a>
    </td>
</tr>
<tr class="menu-row">
    <td class="menu-btn menu-icon-appoinment">
        <a href="<?= base_url('admin'); ?>/appointment" class="non-style-link-menu"><div><p class="menu-text">Janji</p></a></div>
    </td>
</tr>
<tr class="menu-row" >
    <td class="menu-btn menu-icon-patient">
        <a href="<?= base_url('admin'); ?>/patient" class="non-style-link-menu"><div><p class="menu-text">Pasien</p></a></div>
    </td>
</tr>

            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
            <tr>
    <td colspan="2" class="nav-bar">
        <form action="<?= base_url('assets'); ?>/doctors" method="post" class="header-search">
            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Doctor name or Email" list="doctors">  
            <?php
                echo '<datalist id="doctors">';
                $list11 = $this->db->select('docname, docemail')->get('doctor');
                foreach ($list11->result_array() as $row00) {
                    $d = $row00["docname"];
                    $c = $row00["docemail"];
                    echo "<option value='$d'><br/>";
                    echo "<option value='$c'><br/>";
                }
                echo ' </datalist>';
            ?>
            <input type="Submit" value="Search" class="login-btn btn-primary-soft btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
        </form>
    </td>
    <td width="15%">
        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
            Today's Date
        </p>
        <p class="heading-sub12" style="padding: 0;margin: 0;">
            <?php 
            $nama_hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
                date_default_timezone_set('Asia/Jakarta');
                $today = date('Y-m-d');
                echo $today;
                $patientrow = $this->db->get('patient');
                $doctorrow = $this->db->get('doctor');
                $appointmentrow = $this->db->where('appodate >=', $today)->get('appointment');
                $schedulerow = $this->db->where('scheduledate', $today)->get('schedule');
            ?>
        </p>
    </td>
    <td width="10%">
        <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
    </td>
</tr>

                <tr>
                    <td colspan="4">
                        
                        <center>
                        <table class="filter-container" style="border: none;" border="0">
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Status</p>
                                </td>
                            </tr>
                            <tr>
                            <td style="width: 25%;">
    <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex;">
        <div>
            <div class="h1-dashboard">
                <?php echo $doctorrow->num_rows()?>
            </div><br>
            <div class="h3-dashboard">
                Dokter       
            </div>
        </div>
        <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/doctors-hover.svg');"></div>
    </div>
</td>
<td style="width: 25%;">
    <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex;">
        <div>
            <div class="h1-dashboard">
                <?php echo $patientrow->num_rows()?>
            </div><br>
            <div class="h3-dashboard">
                Pasien      
            </div>
        </div>
        <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/patients-hover.svg');"></div>
    </div>
</td>
<td style="width: 25%;">
    <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex; ">
        <div>
            <div class="h1-dashboard">
                <?php echo $appointmentrow->num_rows() ?>
            </div><br>
            <div class="h3-dashboard">
                Pemesanan Baru   
            </div>
        </div>
        <div class="btn-icon-back dashboard-icons" style="margin-left: 0px;background-image: url('../img/icons/book-hover.svg');"></div>
    </div>
</td>
<td style="width: 25%;">
    <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex;padding-top:26px;padding-bottom:26px;">
        <div>
            <div class="h1-dashboard">
                <?php echo $schedulerow->num_rows() ?>
            </div><br>
            <div class="h3-dashboard" style="font-size: 15px">
                Sesi Hari Ini
            </div>
        </div>
        <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/session-iceblue.svg');"></div>
    </div>
</td>

                                
                            </tr>
                        </table>
                    </center>
                    </td>
                </tr>






                <tr>
                    <td colspan="4">
                        <table width="100%" border="0" class="dashbord-tables">
                            <tr>
                                <td>
                                <p style="padding:10px;padding-left:48px;padding-bottom:0;font-size:23px;font-weight:700;color:var(--primarycolor);">
    Janji Mendatang sampai Minggu Depan <?php
$index_hari = date("w", strtotime("+1 week"));
echo $nama_hari[$index_hari];
?>

</p>
<p style="padding-bottom:19px;padding-left:50px;font-size:15px;font-weight:500;color:#212529e3;line-height: 20px;">
    Berikut adalah Akses Cepat ke Janji Mendatang sampai 7 hari<br>
    Detail lebih lanjut tersedia di bagian @Appointment.
</p>

</td>
<td>
    <p style="text-align:right;padding:10px;padding-right:48px;padding-bottom:0;font-size:23px;font-weight:700;color:var(--primarycolor);">
        Sesi Mendatang sampai Minggu Depan <?php  
        $index_hari = date("w", strtotime("+1 week"));
        echo $nama_hari[$index_hari];
        ?>
    </p>
    <p style="padding-bottom:19px;text-align:right;padding-right:50px;font-size:15px;font-weight:500;color:#212529e3;line-height: 20px;">
        Berikut adalah Akses Cepat ke Sesi Mendatang yang Dijadwalkan sampai 7 hari<br>
        Tambah, Hapus dan Banyak fitur tersedia di bagian @Schedule.
    </p>

                                </td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    <center>
                                        <div class="abc scroll" style="height: 200px;">
                                        <table width="85%" class="sub-table scrolldown" border="0">
                                        <thead>
                                        <tr>    
    <th class="table-headin" style="font-size: 12px;">
        Nomor Janji
    </th>
    <th class="table-headin">
        Nama Pasien
    </th>
    <th class="table-headin">
        Dokter
    </th>
    <th class="table-headin">
        Sesi
    </th>
</tr>

                                        </thead>
                                        <tbody>
    <?php
        $nextweek = date("Y-m-d", strtotime("+1 week"));
        $sqlmain = "SELECT appointment.appoid, schedule.scheduleid, schedule.title, doctor.docname, patient.pname, schedule.scheduledate, schedule.scheduletime, appointment.apponum, appointment.appodate FROM schedule INNER JOIN appointment ON schedule.scheduleid = appointment.scheduleid INNER JOIN patient ON patient.pid = appointment.pid INNER JOIN doctor ON schedule.docid = doctor.docid WHERE schedule.scheduledate >= '$today' AND schedule.scheduledate <= '$nextweek' ORDER BY schedule.scheduledate DESC";
        $result = $this->db->query($sqlmain);
        if ($result->num_rows() == 0) {
            echo '<tr>
                <td colspan="3">
                    <br><br><br><br>
                    <center>
                        <img src="../img/notfound.svg" width="25%">
                        <br>
                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldnt find anything related to your keywords !</p>
                        <a class="non-style-link" href="appointment.php"><button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center;margin-left:20px;">  Show all Appointments  </font></button></a>
                    </center>
                    <br><br><br><br>
                </td>
            </tr>';
        } else {
            foreach ($result->result_array() as $row) {
                $appoid = $row["appoid"];
                $scheduleid = $row["scheduleid"];
                $title = $row["title"];
                $docname = $row["docname"];
                $scheduledate = $row["scheduledate"];
                $scheduletime = $row["scheduletime"];
                $pname = $row["pname"];
                $apponum = $row["apponum"];
                $appodate = $row["appodate"];
                echo '<tr>
                    <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);padding:20px;">' . $apponum . '</td>
                    <td style="font-weight:600;">  ' . substr($pname, 0, 25) . '</td>';
            }
        }
    ?>
</tbody>

                
                                        </table>
                                        </div>
                                        </center>
                                </td>
                                <td width="50%" style="padding: 0;">
                                    <center>
                                        <div class="abc scroll" style="height: 200px;padding: 0;margin: 0;">
                                        <table width="85%" class="sub-table scrolldown" border="0" >
                                        <thead>
                                        <tr>
                                        <th class="table-headin">
    Judul Sesi
</th>
<th class="table-headin">
    Dokter
</th>
<th class="table-headin">
    Tanggal & Waktu Terjadwal
</th>

                                                    
                                                </tr>
                                        </thead>
                                        <tbody>
    <?php
        $nextweek = date("Y-m-d", strtotime("+1 week"));
        $sqlmain = "SELECT schedule.scheduleid, schedule.title, doctor.docname, schedule.scheduledate, schedule.scheduletime, schedule.nop FROM schedule INNER JOIN doctor ON schedule.docid = doctor.docid WHERE schedule.scheduledate >= '$today' AND schedule.scheduledate <= '$nextweek' ORDER BY schedule.scheduledate DESC";
        $result = $this->db->query($sqlmain);
        if ($result->num_rows() == 0) {
            echo '<tr>
                <td colspan="4">
                    <br><br><br><br>
                    <center>
                        <img src="../img/notfound.svg" width="25%">
                        <br>
                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldnt find anything related to your keywords !</p>
                        <a class="non-style-link" href="schedule.php"><button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center;margin-left:20px;">  Show all Sessions  </font></button></a>
                    </center>
                    <br><br><br><br>
                </td>
            </tr>';
        } else {
            foreach ($result->result_array() as $row) {
                $scheduleid = $row["scheduleid"];
                $title = $row["title"];
                $docname = $row["docname"];
                $scheduledate = $row["scheduledate"];
                $scheduletime = $row["scheduletime"];
                $nop = $row["nop"];
                echo '<tr>
                    <td style="padding:20px;">  ' . substr($title, 0, 30) . '</td>
                    <td>' . substr($docname, 0, 20) . '</td>
                    <td style="text-align:center;">' . substr($scheduledate, 0, 10) . ' ' . substr($scheduletime, 0, 5) . '</td>
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
                            <tr>
                                <td>
                                    <center>
                                        <a href="<?= base_url('admin'); ?>/appointment" class="non-style-link"><button class="btn-primary btn" style="width:85%">Show all Appointments</button></a>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <a href="<?= base_url('admin'); ?>/schedule" class="non-style-link"><button class="btn-primary btn" style="width:85%">Show all Sessions</button></a>
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
                        </table>
                        </center>
                        </td>
                </tr>
            </table>
        </div>
    </div>


</body>
</html>