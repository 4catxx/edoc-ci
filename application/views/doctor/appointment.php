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
.popup{
animation: transitionIn-Y-bottom 0.5s;
}.sub-table{
animation: transitionIn-Y-bottom 0.5s;
}
</style>
<!-- Tambahkan jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
<a href="<?= base_url('auth'); ?>/logout" ><input type="button" value="Keluar" class="logout-btn btn-primary-soft btn"></a>
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
<td class="menu-btn menu-icon-appoinment  menu-active menu-icon-appoinment-active">
<a href="<?= base_url('dokter'); ?>/appointment" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Jadwal Temu</p></a></div>
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
<a href="<?= base_url('dokter'); ?>/settings" class="non-style-link-menu"><div><p class="menu-text">Pengaturan</p></div></a>
</td>
</tr>

</table>
</div>
<div class="dash-body">
<table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
<tr >
<td width="13%" >
<a href="appointment.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
</td>
<td>
<p style="font-size: 23px;padding-left:12px;font-weight: 600;">Pengelola Janji Temu</p>

</td>
<td width="15%">
<p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
Tanggal hari ini
</p>
<p class="heading-sub12" style="padding: 0;margin: 0;">
<?php
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
echo $today;
$this->load->database();
$this->db->select('*');
$this->db->from('schedule');
$this->db->join('appointment', 'schedule.scheduleid = appointment.scheduleid');
$this->db->join('patient', 'patient.pid = appointment.pid');
$this->db->join('doctor', 'schedule.docid = doctor.docid');
$this->db->where('doctor.docid', $userid);
$list110 = $this->db->get();
?>
</p>
</td>
<td width="10%">
<button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
</td>


</tr>

<!-- <tr>
<td colspan="4" >
<div style="display: flex;margin-top: 40px;">
<div class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49);margin-top: 5px;">Schedule a Session</div>
<a href="?action=add-session&id=none&error=0" class="non-style-link"><button  class="login-btn btn-primary btn button-icon"  style="margin-left:25px;background-image: url('../img/icons/add.svg');">Add a Session</font></button>
</a>
</div>
</td>
</tr> -->
<tr>
<td colspan="4" style="padding-top:10px;width: 100%;" >

<p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Janji Temu (<?php echo $list110->num_rows(); ?>)</p>
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
Tanggal:
</td>
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

<?php
$this->db->select('appointment.appoid, schedule.scheduleid, schedule.title, doctor.docname, patient.pname, schedule.scheduledate, schedule.scheduletime, appointment.apponum, appointment.appodate, appointment.status');
$this->db->from('schedule');
$this->db->join('appointment', 'schedule.scheduleid = appointment.scheduleid');
$this->db->join('patient', 'patient.pid = appointment.pid');
$this->db->join('doctor', 'schedule.docid = doctor.docid');
$this->db->where('doctor.docid', $userid);
if ($this->input->post()) {
if (!empty($this->input->post("sheduledate"))) {
$sheduledate = $this->input->post("sheduledate");
$this->db->where('schedule.scheduledate', $sheduledate);
}
}
$query = $this->db->get();
?>
<tr>
<td colspan="4">
<center>

<div class="abc scroll">
<table width="93%" class="sub-table scrolldown" border="0">
<thead>
<tr>
<th class="table-headin">
Nama Pasien
</th>
<th class="table-headin">

Antrian

</th>

<th class="table-headin">


Sesi Praktek

</th>

<th class="table-headin" >

Tanggal sesi

</th>

<th class="table-headin">

Tanggal janji

</th>

<th class="table-headin">

Events

</tr>
</thead>
<tbody>
<?php
if ($query->num_rows() == 0) {
echo '<tr>
<td colspan="7">
<br><br><br><br>
<center>
<img src="../img/notfound.svg" width="25%">

<br>
<p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb49, 49, 49)">We  couldnt find anything related to your keywords !</p>
<a class="non-style-link"
href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;
justify-content: center;align-items: center;margin-left:20px;">  Show all Appointments  </font></button>
</a>
</center>
<br><br><br><br>
</td>
</tr>';
} else {
foreach ($query->result_array() as $row) {
    $appoid = $row["appoid"];
    $scheduleid = $row["scheduleid"];
    $title = $row["title"];
    $docname = $row["docname"];
    $scheduledate = $row["scheduledate"];
    $scheduletime = $row["scheduletime"];
    $pname = $row["pname"];
    $apponum = $row["apponum"];
    $appodate = $row["appodate"];
    $status = $row["status"];

    echo '<tr >
    <td style="font-weight:600;">  '.
    substr($pname,0,25)
    .'</td >
    <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">
    '.$apponum.'
    </td>
    <td>
    '.substr($title,0,15).'
    </td>
    <td style="text-align:center;;">
    '.substr($scheduledate,0,10).' @'.substr($scheduletime,0,5).'
    </td>
    <td style="text-align:center;">
    '.$appodate.'
    </td>
    <td>
    <div style="display:flex;justify-content: center;">';
    if ($status != "Selesai") {
        echo '
        <button id="finishButton'.$appoid.'" class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;">Selesai</button>
        <div id="uploadPopup'.$appoid.'" class="overlay" style="display: none; width: 60%; margin: auto;">
            <div class="popup">
                <center>
                    <h2>Upload Hasil Rekam Medis</h2>
                    <a class="close" href="#" onclick="$("#uploadPopup'.$appoid.'").hide();">×</a>
                    <div class="content">
                        <form action="'.base_url('dokter').'/finishAppointment" method="post" enctype="multipart/form-data" style="margin-top: 20px;">
                            <input type="hidden" name="appoid" value="'.$appoid.'">
                            <input type="file" id="pdfFile'.$appoid.'" name="pdfFile" accept=".pdf" required style="display: none;" onchange="document.getElementById(\'fileName'.$appoid.'\').textContent = this.files[0].name;">
                            <div id="fileName'.$appoid.'" style="border: 1px solid #ccc; padding: 10px; cursor: pointer;" onclick="document.getElementById(\'pdfFile'.$appoid.'\').click();">Pilih file...</div>
                            <input type="submit" value="Upload" class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin-top:20px;padding:10px;">
                        </form>
                    </div>
                </center>
            </div>
        </div>
        <script>
        $(document).ready(function() {
            $("#finishButton'.$appoid.'").click(function() {
                $("#uploadPopup'.$appoid.'").show();
            });
        });
        </script>';
    }
    
    if ($status != "Selesai") {
        echo '<a href="?action=drop&id='.$appoid.'&name='.$pname.'&session='.$title.'&apponum='.$apponum.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Cancel</font></button></a>';
    }
    echo '</div>
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
if($action=='add-session'){

echo '
<div id="popup1" class="overlay">
<div class="popup">
<center>


<a class="close" href="schedule.php">×</a>
<div style="display: flex;justify-content: center;">
<div class="abc">
<table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
<tr>
<td class="label-td" colspan="2">'.
""

.'</td>
</tr>

<tr>
<td>
<p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add New Session.</p><br>
</td>
</tr>
<tr>
<td class="label-td" colspan="2">
<form action="add-session.php" method="POST" class="add-new-form">
<label for="title" class="form-label">Session Title : </label>
</td>
</tr>
<tr>
<td class="label-td" colspan="2">
<input type="text" name="title" class="input-text" placeholder="Name of this Session" required><br>
</td>
</tr>
<tr>

<td class="label-td" colspan="2">
<label for="docid" class="form-label">Select Doctor: </label>
</td>
</tr>
<tr>
<td class="label-td" colspan="2">
<select name="docid" id="" class="box" >
<option value="" disabled selected hidden>Choose Doctor Name from the list</option><br/>';
$query = $this->db->get('doctor');
foreach ($query->result_array() as $row) {
$sn = $row["docname"];
$id00 = $row["docid"];
echo "<option value=" . $id00 . ">$sn</option><br/>";
}



echo     '       </select><br><br>
</td>
</tr>
<tr>
<td class="label-td" colspan="2">
<label for="nop" class="form-label">Number of Patients/Appointment Numbers : </label>
</td>
</tr>
<tr>
<td class="label-td" colspan="2">
<input type="number" name="nop" class="input-text" min="0"  placeholder="The final appointment number for this session depends on this number" required><br>
</td>
</tr>
<tr>
<td class="label-td" colspan="2">
<label for="date" class="form-label">Session Date: </label>
</td>
</tr>
<tr>
<td class="label-td" colspan="2">
<input type="date" name="date" class="input-text" min="'.date('Y-m-d').'" required><br>
</td>
</tr>
<tr>
<td class="label-td" colspan="2">
<label for="time" class="form-label">Schedule Time: </label>
</td>
</tr>
<tr>
<td class="label-td" colspan="2">
<input type="time" name="time" class="input-text" placeholder="Time" required><br>
</td>
</tr>

<tr>
<td colspan="2">
<input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >     

<input type="submit" value="Place this Session" class="login-btn btn-primary btn" name="shedulesubmit">
</td>

</tr>

</form>
</tr>
</table>
</div>
</div>
</center>
<br><br>
</div>
</div>
';
}elseif($action=='session-added'){
$titleget=$_GET["title"];
echo '
<div id="popup1" class="overlay">
<div class="popup">
<center>
<br><br>
<h2>Session Placed.</h2>
<a class="close" href="schedule.php">×</a>
<div class="content">
'.substr($titleget,0,40).' was scheduled.<br><br>

</div>
<div style="display: flex;justify-content: center;">

<a href="schedule.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">  OK  </font></button></a>
<br><br><br><br>
</div>
</center>
</div>
</div>
';
}elseif($action=='drop'){
$nameget=$_GET["name"];
$session=$_GET["session"];
$apponum=$_GET["apponum"];
echo '
<div id="popup1" class="overlay">
<div class="popup">
<center>
<h2>Are you sure?</h2>
<a class="close" href="appointment.php">×</a>
<div class="content">
You want to delete this record<br><br>
Patient Name:  <b>'.substr($nameget,0,40).'</b><br>
Appointment number   : <b>'.substr($apponum,0,40).'</b><br><br>

</div>
<div style="display: flex;justify-content: center;">
<a href="'.base_url('dokter').'/deleteAppointment?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text"> Yes </font></button></a>   
<a href="'.base_url('dokter').'/appointment" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">  No  </font></button></a>

</div>
</center>
</div>
</div>
';
}elseif ($action == 'view') {
$query =$this->db->get_where('doctor', array('docid' => $id));
$row = $query->row_array();
$name = $row["docname"];
$email = $row["docemail"];
$spe = $row["specialties"];

$spcil_res = $this->db->get_where('specialties', array('id' => $spe));
$spcil_array = $spcil_res->row_array();
$spcil_name = $spcil_array["pname"];
$nic = $row['pnic'];
$tele = $row['ptel'];

echo '
<div id="popup1" class="overlay">
<div class="popup">
<center>
<h2>Are you sure?</h2>
<a class="close" href="doctors.php">×</a>
<div class="content">
eDoc Web App<br>

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
<label for="name" class="form-label">Name: </label>
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
<label for="nic" class="form-label">NIC: </label>
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
<label for="spec" class="form-label">Specialties: </label>

</td>
</tr>
<tr>
<td class="label-td" colspan="2">
'.$spcil_name.'<br><br>
</td>
</tr>
<tr>
<td colspan="2">
<a href="doctors.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
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
