<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/animations.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/main.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/admin.css">
        
    <title>Appointments</title>
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
    

    //import database
    $sqlmain = "select * from patient where pemail=?";
    $stmt = $this->db->conn_id->prepare($sqlmain);
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $result = $stmt->get_result();
    $userfetch = $result->fetch_assoc();
    $userid = $userfetch["pid"];
    $username = $userfetch["pname"];

    //TODO
    $sqlmain = "select appointment.appoid, schedule.scheduleid, schedule.title, doctor.docname, patient.pname, schedule.scheduledate, schedule.scheduletime, appointment.status,appointment.apponum, appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid  where  patient.pid=$userid ";

    if($this->input->post()){
        if(!empty($this->input->post("sheduledate"))){
            $sheduledate = $this->input->post("sheduledate");
            $sqlmain .= " and schedule.scheduledate='$sheduledate' ";
        }
    }
    
    $sqlmain .= "order by appointment.appodate  asc";
    $result = $this->db->query($sqlmain);
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
    <td class="menu-btn menu-icon-home" style="background-image: url('<?= base_url('assets/img/icons/home.svg') ?>')">
        <a href="<?= base_url('patient'); ?>/index" class="non-style-link-menu">
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
    <td class="menu-btn menu-icon-appoinment menu-active menu-icon-home-active" style="background-image: url('<?= base_url('assets/img/icons/book.svg') ?>')">
        <a href="<?= base_url('patient'); ?>/appointment" class="non-style-link-menu non-style-link-menu-active">
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
    <div class="dash-body">
        <table border="0" width="100%" style="border-spacing: 0; margin:0;padding:0;margin-top:25px;">
            <tr>
                <td width="13%">
                    <a href="<?= base_url('patient'); ?>/appointment" >
                        <button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Back</font>
                        </button>
                    </a>
                </td>
                <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;">History pemesananku</p>           
                </td>
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">Today's Date</p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php 
                            date_default_timezone_set('Asia/Jakarta');
                            $today = date('Y-m-d');
                            echo $today;
                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;">
                        <img src="../img/calendar.svg" width="100%">
                    </button>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-top:10px;width: 100%;">
                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Pesanan ku (<?php echo $result->num_rows(); ?>)</p>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-top:0px;width: 100%;">
                    <center>
                        <table class="filter-container" border="0">
                            <tr>
                                <td width="10%"></td> 
                                <td width="5%" style="text-align: center;">Date:</td>
                                <td width="30%">
                                    <form action="" method="post">
                                        <input type="date" name="sheduledate" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">
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
                        <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
    
    <!--<th class="table-headin">
        Reference Number
    </th> -->
    <th class="table-headin">
        Tittle
    </th>
    <th class="table-headin">
        Nama Dokter
    </th>
    <th class="table-headin">
        Tanggal Pemesanan
    </th>
    <th class="table-headin">
        Waktu Konsultasi
    </th>
    <th class="table-headin">
        Jam
    </th>
    <th class="table-headin">
        Status
    </th>
    <th class="table-headin">
        Action
    </th>
</tr>
                                    
                                </thead>
                                <?php
$printerImageWhite = base_url('assets') . '/img/icons/printer-putih.png';
$printerImageBlue = base_url('assets') . '/img/icons/printer-biru.png';
?>

<?php
$allStatusNull = true;

while ($row = $result->unbuffered_row('array')) {
    $scheduleid = $row["scheduleid"];
    $title = $row["title"];
    $docname = $row["docname"];
    $scheduledate = $row["scheduledate"];
    $scheduletime = $row["scheduletime"];
    $apponum = $row["apponum"];
    $appodate = $row["appodate"];
    $appoid = $row["appoid"];
    $status = $row["status"];

    if ($scheduleid == "") {
        break;
    }

    // Tambahkan kondisi di sini
    if ($status !== null && $status !== '') {
        $allStatusNull = false;
        echo '<tr>';

        echo '<td style="text-align: center;">' . substr($title, 0, 21) . '</td>';
        echo '<td style="text-align: center;">' . substr($docname, 0, 30) . '</td>';
        echo '<td style="text-align: center;">' . substr($appodate, 0, 30) . '</td>';
        echo '<td style="text-align: center;">' . $scheduledate . '</td>';
        echo '<td style="text-align: center;">' . substr($scheduletime, 0, 5) . '</td>';
        echo '<td style="text-align: center;">' . $status . '</td>';
        echo '<td style="text-align: center;">';

        // Tambahkan kondisi untuk menampilkan tombol "Invoice"
        if ($status === 'Selesai') {
            echo '<a href="' . base_url('patient/download_record?id=' . $appoid) . '" class="non-style-link">
                <button class="btn-primary-soft btn button-icon" style="padding: 5px; margin-top: 10px;" onmouseover="changeImage(this)" onmouseout="restoreImage(this)">
                    <img src="' . $printerImageBlue . '" alt="Print" width="30" style="padding: 1px; vertical-align: middle;" id="printerImage">
                    <font class="tn-in-text" style="margin-left: 5px;">Unduh Rekam</font>
                </button>
            </a>';
        }

        echo '</td>';
        echo '</tr>';
    }
}

// Tempatkan JavaScript di luar dari loop
?>
<script>
    function changeImage(button) {
        document.getElementById("printerImage").src = "<?php echo $printerImageWhite; ?>";
    }

    function restoreImage(button) {
        document.getElementById("printerImage").src = "<?php echo $printerImageBlue; ?>";
    }
</script>

<?php
if ($allStatusNull || $result->num_rows() == 0) {
    echo '<tr>
        <td colspan="8">
            <br><br><br><br>
            <center>
                <img src="' . base_url('assets') . '/img/notfound.svg" width="25%">

                <br>
                <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldnt find anything related to your keywords !</p>

                <a class="non-style-link" href="' . base_url('patient') . '/appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">  Show all Appointments  </font></button>
                </a>
            </center>
            <br><br><br><br>
        </td>
    </tr>';
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
</body>
</html>