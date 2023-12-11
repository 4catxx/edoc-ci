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
      
    </style>
    
</head>
<body>
    <?php
    if($this->session->has_userdata('user')){
        if(($this->session->userdata('user'))=="" or $this->session->userdata('usertype')!='p'){
            redirect('auth/login');
        }else{
            $useremail=$this->session->userdata('user');
        }
    }else{
        redirect('auth/login');
    }
    

    $sqlmain= "select * from patient where pemail=?";
    $userrow = $this->db->query($sqlmain, array($useremail));
    $userfetch=$userrow->row_array();

    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];


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
                                    <a href="<?= base_url('auth'); ?>/logout" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row">
    <td class="menu-btn menu-icon-home menu-active menu-icon-home-active" style="background-image: url('<?= base_url('assets/img/icons/home.svg') ?>')">
        <a href="<?= base_url('patient'); ?>/index" class="non-style-link-menu non-style-link-menu-active">
            <div>
                <p class="menu-text">Beranda</p>
            </div>
        </a>
    </td>
</tr>
<tr class="menu-row">
    <td class="menu-btn menu-icon-doctor" style="background-image: url('<?= base_url('assets/img/icons/doctors.svg') ?>')">
        <a href="<?= base_url('patient'); ?>/doctors" class="non-style-link-menu">
            <div>
                <p class="menu-text">Semua Dokter</p>
            </div>
        </a>
    </td>
</tr>

<tr class="menu-row">
    <td class="menu-btn menu-icon-session" style="background-image: url('<?= base_url('assets/img/icons/session.svg') ?>')">
        <a href="<?= base_url('patient'); ?>/schedule" class="non-style-link-menu">
            <div>
                <p class="menu-text">Sesi Terjadwal</p>
            </div>
        </a>
    </td>
</tr>
<tr class="menu-row">
    <td class="menu-btn menu-icon-appoinment" style="background-image: url('<?= base_url('assets/img/icons/book.svg') ?>')">
        <a href="<?= base_url('patient'); ?>/appointment" class="non-style-link-menu">
            <div>
                <p class="menu-text">Pemesanan Saya</p>
            </div>
        </a>
    </td>
</tr>
<tr class="menu-row">
    <td class="menu-btn menu-icon-settings" style="background-image: url('<?= base_url('assets/img/icons/settings.svg') ?>')">
        <a href="<?= base_url('patient'); ?>/settings" class="non-style-link-menu">
            <div>
                <p class="menu-text">Pengaturan</p>
            </div>
        </a>
    </td>
</tr>

                
            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
                        <tr >
                            
                            <td colspan="1" class="nav-bar" >
                            <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">Home</p>
                          
                            </td>
                            <td width="25%">

                            </td>
                            <td width="15%">
                                <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                                    Tanggal hari ini
                                </p>
                                <p class="heading-sub12" style="padding: 0;margin: 0;">
                                    <?php 
                                date_default_timezone_set('Asia/Jakarta');
        
                                $today = mdate('%Y-%m-%d');
                                echo $today;


                                $patientrow = $this->db->query("select * from patient;");
                                $doctorrow = $this->db->query("select * from doctor;");
                                $appointmentrow = $this->db->query("select * from appointment where appodate>='$today';");
                                $schedulerow = $this->db->query("select * from schedule where scheduledate='$today';");


                                ?>
                                </p>
                            </td>
                            <td width="10%">
                                <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="<?= base_url('assets'); ?>/img/calendar.svg" width="100%"></button>
                            </td>
        
        
                        </tr>
                <tr>
                    <td colspan="4" >
                        
                    <center>
                    <table class="filter-container doctor-header patient-header" style="border: none; width: 95%; background-image: url('<?= base_url('assets/img/b3.jpg') ?>')" border="0">
>
                    <tr>
                        <td >
                        <h3>Selamat datang!</h3>
<h1><?php echo $username  ?>.</h1>
<p>Tidak tahu tentang dokter? tidak masalah, mari melompat ke bagian
    <a href="<?= base_url('patient'); ?>/doctors.php" class="non-style-link"><b>"Semua Dokter"</b></a> atau
    <a href="<?= base_url('patient'); ?>/schedule.php" class="non-style-link"><b>"Sesi"</b> </a><br>
    Lacak riwayat janji temu sebelumnya dan seterusnya.<br>Juga cari tahu waktu kedatangan yang diharapkan dari dokter atau konsultan medis Anda.<br><br>
</p>

                            
<h3>Hubungi Dokter di Sini</h3>

                            <form action="<?= base_url('patient');?>/schedule.php" method="post" style="display: flex">

                                <input type="search" name="search" class="input-text "placeholder="Cari Dokter dan Kami Akan Menemukan Sesi yang Tersedia"
 list="doctors" style="width:45%;">&nbsp;&nbsp;
                                
                                <?php
                                    echo '<datalist id="doctors">';
                                    $list11 = $this->db->query("select docname,docemail from doctor;");
    
                                    for ($y=0;$y<$list11->num_rows();$y++){
                                        $row00=$list11->row_array();
                                        $d=$row00["docname"];
                                        
                                        echo "<option value='$d'><br/>";
                                        
                                    };
    
                                echo ' </datalist>';
    ?>
                                
                           
                                <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                            
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
                                                        <?php echo $doctorrow->num_rows() ?>
                                                        </div><br>

                                                        <div class="h3-dashboard">
    Semua Dokter       
</div>
</div>
<div class="btn-icon-back dashboard-icons" style="background-image: url('<?= base_url('assets'); ?>/img/icons/doctors-hover.svg');"></div>
</div>
</td>
<td style="width: 25%;">
    <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex;">
        <div>
            <div class="h1-dashboard">
                <?php echo $patientrow->num_rows() ?>
            </div><br>
            <div class="h3-dashboard">
                Semua Pasien      
            </div>
        </div>
        <div class="btn-icon-back dashboard-icons" style="background-image: url('<?= base_url('assets'); ?>//img/icons/patients-hover.svg');"></div>
    </div>
</td>
</tr>
<tr>
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
            <div class="btn-icon-back dashboard-icons" style="background-image: url('<?= base_url('assets'); ?>/img/icons/book-hover.svg');"></div>
        </div>

    </td>

    <td style="width: 25%;">
        <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex;padding-top:21px;padding-bottom:21px;">
            <div>
                <div class="h1-dashboard">
                    <?php echo $schedulerow->num_rows() ?>
                </div><br>
                <div class="h3-dashboard" style="font-size: 15px">
                    Sesi Hari ini

                                                                </div>
                                                        </div>
                                                                <div class="btn-icon-back dashboard-icons" style="margin-left:70px;background-image: url('<?= base_url('assets'); ?>/img/icons/session-iceblue.svg');"></div>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                        </table>
                                    </center>








                                </td>
                                <td>


                            
                                <p style="font-size: 20px;font-weight:600;padding-left: 40px;" class="anime">Pemesanan Mendatang Anda</p>

                                    <center>
                                        <div class="abc scroll" style="height: 250px;padding: 0;margin: 0;">
                                        <table width="85%" class="sub-table scrolldown" border="0" >
                                        <thead>
                                            
                                        <tr>
                                        <th class="table-headin">
    Nomor Janji
</th>
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
                                            $nextweek=date("Y-m-d",strtotime("+1 week"));
                                            $sqlmain= "select * from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid where patient.pid=$userid and schedule.scheduledate>='$today' order by schedule.scheduledate asc";
                                            $result= $this->db->query($sqlmain);
                
                                            if($result->num_rows()==0){
                                                echo '<tr>
                                                <td colspan="4">
                                                <br><br><br><br>
                                                <center>
                                                <img src="'.base_url('assets').'/img/notfound.svg" width="25%">
                                                
                                                <br>
                                                <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Nothing to show here!</p>
                                                <a class="non-style-link" href="'.base_url('patient').'/schedule"><button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center;margin-left:20px;">  Channel a Doctor  </font></button>
                                                </a>
                                                </center>
                                                <br><br><br><br>
                                                </td>
                                                </tr>';
                                            
                                            
                                                    
                                                }
                                                else{
                                                   foreach ($result->result_array() as $row){
                                                        $scheduleid=$row["scheduleid"];
                                                        $title=$row["title"];
                                                        $apponum=$row["apponum"];
                                                        $docname=$row["docname"];
                                                        $scheduledate=$row["scheduledate"];
                                                        $scheduletime=$row["scheduletime"];
                                                    
                                                    
                                                   
                                                    echo '<tr>
                                                        <td style="padding:30px;font-size:25px;font-weight:700;"> &nbsp;'.
                                                        $apponum
                                                        .'</td>
                                                        <td style="padding:20px;"> &nbsp;'.
                                                        substr($title,0,30)
                                                        .'</td>
                                                        <td>
                                                        '.substr($docname,0,20).'
                                                        </td>
                                                        <td style="text-align:center;">
                                                            '.substr($scheduledate,0,10).' '.substr($scheduletime,0,5).'
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