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
    <td class="menu-btn menu-icon-dashbord" >
        <a href="<?= base_url('admin'); ?>/index" class="non-style-link-menu "><div><p class="menu-text">Beranda</p></a></div></a>
    </td>
</tr>
<tr class="menu-row">
    <td class="menu-btn menu-icon-doctor">
        <a href="<?= base_url('admin'); ?>/doctors" class="non-style-link-menu "><div><p class="menu-text">Dokter</p></a></div>
    </td>
</tr>
<tr class="menu-row" >
    <td class="menu-btn menu-icon-schedule  menu-active menu-icon-schedule-active">
        <a href="<?= base_url('admin'); ?>/schedule" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Jadwal</p></div></a>
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
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="<?= base_url('admin'); ?>schedule" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Manajer Jadwal</p>

                                           
                    </td>
                    <td width="15%">
    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
        Today's Date
    </p>
    <p class="heading-sub12" style="padding: 0;margin: 0;">
        <?php
            date_default_timezone_set('Asia/Jakarta');
            $today = date('Y-m-d');
            echo $today;
            $list110 = $this->db->get('schedule');
        ?>
    </p>
</td>
<td width="10%">
    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
</td>



                </tr>
               
                <tr>
                    <td colspan="4" >
                        <div style="display: flex;margin-top: 40px;">
                        <div class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49);margin-top: 5px;">Jadwalkan Sesi</div>
<a href="?action=add-session&id=none&error=0" class="non-style-link"><button class="login-btn btn-primary btn button-icon" style="margin-left:25px;background-image: url('../img/icons/add.svg');">Tambah Sesi</font></button>

                        </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                    
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Sessions (<?php echo $list110->num_rows(); ?>)</p>
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
                            
                            <input type="date" name="sheduledate" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">

                        </td>
                        <td width="5%" style="text-align: center;">
    Doctor:
</td>
<td width="30%">
    <select name="docid" id="" class="box filter-container-items" style="width:90% ;height: 37px;margin: 0;">
    <option value="" disabled selected hidden>Pilih Nama Dokter dari daftar</option><br/>

        <?php
            $list11 = $this->db->order_by('docname', 'ASC')->get('doctor');
            foreach ($list11->result_array() as $row00) {
                $sn = $row00["docname"];
                $id00 = $row00["docid"];
                echo "<option value=" . $id00 . ">$sn</option><br/>";
            }
        ?>
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
                
                <?php
    if ($_POST) {
        $sqlpt1 = "";
        if (!empty($_POST["sheduledate"])) {
            $sheduledate = $_POST["sheduledate"];
            $sqlpt1 = " schedule.scheduledate='$sheduledate' ";
        }
        $sqlpt2 = "";
        if (!empty($_POST["docid"])) {
            $docid = $_POST["docid"];
            $sqlpt2 = " doctor.docid=$docid ";
        }
        $sqlmain = "SELECT schedule.scheduleid, schedule.title, doctor.docname, schedule.scheduledate, schedule.scheduletime, schedule.nop FROM schedule INNER JOIN doctor ON schedule.docid=doctor.docid";
        $sqllist = array($sqlpt1, $sqlpt2);
        $sqlkeywords = array(" WHERE ", " AND ");
        $key2 = 0;
        foreach ($sqllist as $key) {
            if (!empty($key)) {
                $sqlmain .= $sqlkeywords[$key2] . $key;
                $key2++;
            }
        }
    } else {
        $sqlmain = "SELECT schedule.scheduleid, schedule.title, doctor.docname, schedule.scheduledate, schedule.scheduletime, schedule.nop FROM schedule INNER JOIN doctor ON schedule.docid=doctor.docid ORDER BY schedule.scheduledate DESC";
    }
?>

                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0">
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
    <th class="table-headin">
        Jumlah Maksimum yang Dapat Dipesan
    </th>
    <th class="table-headin">
        Aksi
</tr>

                        </thead>
                        <tbody>
    <?php
        $result = $this->db->query($sqlmain);
        if ($result->num_rows() == 0) {
            echo '<tr>
                <td colspan="4">
                    <br><br><br><br>
                    <center>
                        <img src="'.base_url('assets').'/img/notfound.svg" width="25%">
                        <br>
                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldnt find anything related to your keywords !</p>
                        <a class="non-style-link" href="'.base_url('admin').'/schedule"><button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center;margin-left:20px;">  Show all Sessions  </font></button></a>
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
                    <td> ' . substr($title, 0, 30) . '</td>
                    <td>' . substr($docname, 0, 20) . '</td>
                    <td style="text-align:center;">' . substr($scheduledate, 0, 10) . ' ' . substr($scheduletime, 0, 5) . '</td>
                    <td style="text-align:center;">' . $nop . '</td>
                    <td>
                        <div style="display:flex;justify-content: center;">
                            <a href="'.base_url('admin').'/schedule/?action=view&id=' . $scheduleid . '" class="non-style-link"><button class="btn-primary-soft btn button-icon btn-view" style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>   
                            <a href="'.base_url('admin').'/deleteSchedule?action=drop&id=' . $scheduleid . '&name=' . $title . '" class="non-style-link"><button class="btn-primary-soft btn button-icon btn-delete" style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Remove</font></button></a>
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
    if ($_GET) {
        $id = $_GET["id"];
        $action = $_GET["action"];
        if ($action == 'add-session') {
            echo '
            <div id="popup1" class="overlay">
                <div class="popup">
                    <center>
                    <a class="close" href="'.base_url('admin').'/schedule">&times;</a> 
                        <div style="display: flex;justify-content: center;">
                            <div class="abc">
                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                    <tr>
                                        <td class="label-td" colspan="2">' . "" . '</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add New Session.</p><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <form action="'.base_url('admin').'/addSchedule" method="POST" class="add-new-form">
                                                <label for="title" class="form-label">Session Title : </label>
                                        </td>
                                    </tr>
                                    <tr>
                                    <td class="label-td" colspan="2">
                                    <input type="text" name="title" class="input-text" placeholder="Nama Sesi Ini" required><br>
                                </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="docid" class="form-label">Pilih Dokter: </label>
                                    </td>
                                
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <select name="docid" id="" class="box">
                                                <option value="" disabled selected hidden>Pilih Nama Dokter dari daftar</option><br/>';
            $list11 = $this->db->order_by('docname', 'ASC')->get('doctor');
            foreach ($list11->result_array() as $row00) {
                $sn = $row00["docname"];
                $id00 = $row00["docid"];
                echo "<option value=".$id00.">$sn</option><br/>";
            }
            echo '       </select><br><br>
            </td>
        </tr>
        <tr>
        <td class="label-td" colspan="2">
        <label for="nop" class="form-label">Jumlah Pasien/Nomor Janji: </label>
    </td>
    </tr>
    <tr>
        <td class="label-td" colspan="2">
            <input type="number" name="nop" class="input-text" min="0" placeholder="Nomor janji terakhir untuk sesi ini tergantung pada jumlah ini" required><br>
        </td>
    </tr>
    <tr>
        <td class="label-td" colspan="2">
            <label for="date" class="form-label">Tanggal Sesi: </label>
        </td>
    
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <input type="date" name="date" class="input-text" min="' . date('Y-m-d') . '" required><br>
            </td>
        </tr>
        <tr>
        <td class="label-td" colspan="2">
        <label for="time" class="form-label">Waktu Jadwal: </label>
    </td>
    
        </tr>
        <tr>
            <td class="label-td" colspan="2">
                <input type="time" name="time" class="input-text" placeholder="Time" required><br>
            </td>
        </tr>
        
        <tr>
        <td colspan="2">
        <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">     
        <input type="submit" value="Place this Session" class="login-btn btn-primary btn" name="shedulesubmit">
    </td>
    
        
        </tr>
        
        </form>
        </tr>
        </table >
        </div >
        </div >
        </center >
        <br ><br >
        </div >
        </div >';
    } elseif ($action == 'session-added') {
        $titleget = $_GET["title"];
        echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <br><br>
                    <h2>Session Placed.</h2>
                    <a class="close" href=""'.base_url('admin').'/schedule">&times;</a>
                    <div class="content">' . substr($titleget, 0, 40) . ' was scheduled.<br><br></div>
                    <div style="display: flex;justify-content: center;">
                        <a href="'.base_url('admin').'/schedule" class="non-style-link"><button class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
                        <br><br><br><br>
                    </div>
                </center>
            </div>
        </div>';
    } elseif ($action == 'drop') {
        $nameget = $_GET["name"];
        echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <h2>Are you sure?</h2>
                    <a class="close" href="'.base_url('admin').'/schedule">&times;</a>
                    <div class="content">You want to delete this record<br>(' . substr($nameget, 0, 40) . ').</div>
                    <div style="display: flex;justify-content: center;">
                        <a href="'.base_url('admin').'/deleteSchedule?id=' . $id . '" class="non-style-link"><button class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="'.base_url('admin').'/schedule" class="non-style-link"><button class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>
                    </div>
                </center>
            </div>
        </div>';
    } elseif ($action == 'view') {
        $sqlmain = "SELECT schedule.scheduleid, schedule.title, doctor.docname, schedule.scheduledate, schedule.scheduletime, schedule.nop FROM schedule INNER JOIN doctor ON schedule.docid = doctor.docid WHERE schedule.scheduleid = $id";
        $result = $this->db->query($sqlmain);
        $row = $result->row_array();
        $docname = $row["docname"];
        $scheduleid = $row["scheduleid"];
        $title = $row["title"];
        $scheduledate = $row["scheduledate"];
        $scheduletime = $row["scheduletime"];
        $nop = $row['nop'];
        $sqlmain12 = "SELECT * FROM appointment INNER JOIN patient ON patient.pid = appointment.pid INNER JOIN schedule ON schedule.scheduleid = appointment.scheduleid WHERE schedule.scheduleid = $id";
        $result12 = $this->db->query($sqlmain12);
        echo '
        <div id="popup1" class="overlay">
            <div class="popup" style="width: 70%;">
                <center>
                    <h2></h2>
                    <a class="close" href="'.base_url('admin').'/schedule">×</a>
                    <div class="content"></div>
                    <div class="abc scroll" style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        <tr>
                        <td>
                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Lihat Detail.</p><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="name" class="form-label">Judul Sesi: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">' . $title . '<br><br></td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="Email" class="form-label">Dokter sesi ini: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            '.$docname.'<br><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="nic" class="form-label">Tanggal Terjadwal: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            '.$scheduledate.'<br><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="Tele" class="form-label">Waktu Terjadwal: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            '.$scheduletime.'<br><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="spec" class="form-label"><b>Pasien yang Sudah Terdaftar untuk Sesi Ini:</b> ('.$result12->num_rows()."/".$nop.')</label><br><br> 
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
                                 Nomor Janji
                             </th>
                             <th class="table-headin">
                                 Telepon Pasien
                             </th>
                             
                                         
                                 </thead>
                                 <tbody>';
$result = $this->db->query($sqlmain12);
if ($result->num_rows() == 0) {
    echo '<tr>
        <td colspan="7">
            <br><br><br><br>
            <center>
                <img src="'.base_url('assets').'/img/notfound.svg" width="25%">
                <br>
                <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldnt find anything related to your keywords !</p>
                <a class="non-style-link" href="'.base_url('admin').'/appointment"><button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center;margin-left:20px;">  Show all Appointments  </font></button></a>
            </center>
            <br><br><br><br>
        </td>
    </tr>';
} else {
    foreach ($result->result_array() as $row) {
        $apponum = $row["apponum"];
        $pid = $row["pid"];
        $pname = $row["pname"];
        $ptel = $row["ptel"];
        echo '<tr style="text-align:center;">
            <td>' . substr($pid, 0, 15) . '</td>
            <td style="font-weight:600;padding:25px">' . substr($pname, 0, 25) . '</td >
            <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">' . $apponum . '</td>
            <td>' . substr($ptel, 0, 25) . '</td>
        </tr>';
    }
}
echo '</tbody></table></div></center></td></tr></table></div></center><br><br></div></div>';
}

}
        
    ?>
    </div>

</body>
</html>