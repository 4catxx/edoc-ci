<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/animations.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/main.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/admin.css">
        
    <title>Sessions</title>
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
     if(($this->session->userdata('user'))=="" or $this->session->userdata('usertype')!='p'){
         redirect('auth/login');
     }else{
         $useremail=$this->session->userdata('user');
     }
 }else{
     redirect('auth/login');
 }
    

    //import database

    $sqlmain= "select * from patient where pemail=?";
$stmt = $this->db->conn_id->prepare($sqlmain);
$stmt->bind_param("s",$useremail);
$stmt->execute();
$result = $stmt->get_result();
$userfetch=$result->fetch_assoc();
$userid= $userfetch["pid"];
$username=$userfetch["pname"];

date_default_timezone_set('Asia/Jakarta');

$today = date('Y-m-d');

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
                                 <a href="<?= base_url('auth'); ?>/logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                             </td>
                         </tr>
                 </table>
                 </td>
             </tr>
             <tr class="menu-row" >
                    <td class="menu-btn menu-icon-home " style="background-image: url('<?= base_url('assets/img/icons/home.svg') ?>')">
                        <a href="<?= base_url('patient'); ?>/index" class="non-style-link-menu "><div><p class="menu-text">Home</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor"style="background-image: url('<?= base_url('assets/img/icons/doctors.svg') ?>')"> 
                        <a href="<?= base_url('patient'); ?>/doctors" class="non-style-link-menu"><div><p class="menu-text">All Doctors</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session menu-active menu-icon-session-active" style="background-image: url('<?= base_url('assets/img/icons/session.svg') ?>')">
                        <a href="<?= base_url('patient'); ?>/schedule" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Scheduled Sessions</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-appoinment" style="background-image: url('<?= base_url('assets/img/icons/book.svg') ?>')">
                        <a href="<?= base_url('patient'); ?>/appointment" class="non-style-link-menu"><div><p class="menu-text">My Bookings</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings" style="background-image: url('<?= base_url('assets/img/icons/settings.svg') ?>')">
                        <a href="<?= base_url('patient'); ?>/settings.php" class="non-style-link-menu"><div><p class="menu-text">Settings</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="schedule.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td >
                    <form action="schedule.php" method="post" class="header-search">
    <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Doctor name or Email or Date (YYYY-MM-DD)" list="doctors" >  
    <?php
        $this->load->database();
        echo '<datalist id="doctors">';
        $list11 = $this->db->query("select DISTINCT * from  doctor;");
        $list12 = $this->db->query("select DISTINCT * from  schedule GROUP BY title;");

        foreach ($list11->result() as $row00)
        {
            $d=$row00->docname;
            echo "<option value='$d'><br/>";
        };

        foreach ($list12->result() as $row00)
        {
            $d=$row00->title;
            echo "<option value='$d'><br/>";
        };
        echo ' </datalist>';
    ?>
    <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
</form>

                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 

                                
                                echo $today;

                                

                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
                
                
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                        <!-- <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49);font-weight:400;">Scheduled Sessions / Booking / <b>Review Booking</b></p> -->
                        
                    </td>
                    
                </tr>
                
                
                
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">
                            
                        <tbody>
    <?php
    if ($this->input->get('id')) {
        $id = $this->input->get('id');
        $this->load->database();
    
        $sqlmain = "SELECT s.*, d.* FROM schedule s 
            INNER JOIN doctor d ON s.docid = d.docid 
            WHERE s.scheduleid = ? 
            ORDER BY s.scheduledate DESC";
    
        $query = $this->db->query($sqlmain, array($id));
        $row = $query->row();
    
        if ($row) {
            $scheduleid = $row->scheduleid;
            $title = $row->title;
            $docname = $row->docname;
            $docemail = $row->docemail;
            $scheduledate = $row->scheduledate;
            $scheduletime = $row->scheduletime;
    
            // Menambahkan kueri untuk mengambil harga dari specialties
            $sqlSpecialty = "SELECT harga FROM doctor WHERE docname = ?";
            $stmt = $this->db->conn_id->prepare($sqlSpecialty);
            $stmt->bind_param("s", $docname);
            $stmt->execute();
            $resultSpecialty = $stmt->get_result();
            $specialtyData = $resultSpecialty->fetch_assoc();
            $channelingFee = $specialtyData["harga"];
    
            $sql2 = "SELECT * FROM appointment WHERE scheduleid = ?";
            $result12 = $this->db->query($sql2, array($id));
            $apponum = $result12->num_rows() + 1;
    
            echo '
                <form action="' . base_url('patient') . '/bookingComplete" method="post">
                    <input type="hidden" name="scheduleid" value="' . $scheduleid . '" >
                    <input type="hidden" name="apponum" value="' . $apponum . '" >
                    <input type="hidden" name="date" value="' . $today . '" >
                ';
            echo '
                <td style="width: 50%;" rowspan="2">
                    <div  class="dashboard-items search-items"  >
                        <div style="width:100%">
                            <div class="h1-search" style="font-size:25px;">
                                Session Details
                            </div><br><br>
                            <div class="h3-search" style="font-size:18px;line-height:30px">
                                Nama Dokter:  &nbsp;&nbsp;<b>' . $docname . '</b><br>
                                Email Dokter:  &nbsp;&nbsp;<b>' . $docemail . '</b> 
                            </div>
                            <div class="h3-search" style="font-size:18px;">
                                Tittle: ' . $title . '<br>
                                Tanggal Konsultasi: ' . $scheduledate . '<br>
                                Mulai Konsultasi : ' . $scheduletime . '<br>
                                Biaya Dokter : <b>RP.' . number_format($channelingFee, 2) . '</b>
                    </div>
                    <br>
                </div>
            </div>
        </td>
        <td style="width: 25%;">
            <div  class="dashboard-items search-items"  >
                <div style="width:100%;padding-top: 15px;padding-bottom: 15px;">
                    <div class="h1-search" style="font-size:20px;line-height: 35px;margin-left:8px;text-align:center;">
                        Nomor Antrian
                    </div>
                    <center>
                        <div class=" dashboard-icons" style="margin-left: 0px;width:90%;font-size:70px;font-weight:800;text-align:center;color:var(--btnnictext);background-color: var(--btnice)">' . $apponum . '</div>
                    </center>
                </div><br><br>
                <br>
                <br>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <input type="Submit" class="login-btn btn-primary btn btn-book" style="margin-left:10px;padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;width:95%;text-align: center;" value="Book now" name="booknow"></button>
        </form>
        </td>
    </tr>
    ';
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
    
    
   
    </div>

</body>
</html>