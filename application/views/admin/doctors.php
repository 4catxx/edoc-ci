<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/main.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/admin.css">
        
    <title>Doctors</title>
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
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
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
    <td class="menu-btn menu-icon-doctor  menu-active menu-icon-doctor-active">
        <a href="<?= base_url('admin'); ?>/doctors" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Dokter</p></a></div>
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
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%">
                        <a href="<?= base_url('admin'); ?>/doctors" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
    <form action="" method="post" class="header-search">
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
        <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
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

                        $date = date('Y-m-d');
                        echo $date;
                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
               
                <tr >
    <td colspan="2" style="padding-top:30px;">
        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Tambah Dokter Baru</p>
    </td>
    <td colspan="2">
        <a href="?action=add&id=none&error=0" class="non-style-link"><button class="login-btn btn-primary btn button-icon" style="display: flex;justify-content: center;align-items: center;margin-left:75px;background-image: url('../img/icons/add.svg');">Tambah Baru</font></button>
        </a></td>
</tr>
<tr>
    <td colspan="4" style="padding-top:10px;">
        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Semua Dokter (<?php echo $list11->num_rows(); ?>)</p>
    </td>
</tr>

                <?php
    if ($_POST) {
        $keyword = $_POST["search"];
        $sqlmain = "SELECT * FROM doctor WHERE docemail = '$keyword' OR docname = '$keyword' OR docname LIKE '$keyword%' OR docname LIKE '%$keyword' OR docname LIKE '%$keyword%'";
    } else {
        $sqlmain = "SELECT * FROM doctor ORDER BY docid DESC";
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
        Nama Dokter
    </th>
    <th class="table-headin">
        Email
    </th>
    <th class="table-headin">
        Spesialisasi
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
                        <img src="../img/notfound.svg" width="25%">
                        <br>
                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We couldnt find anything related to your keywords !</p>
                        <a class="non-style-link" href=""'.base_url('admin').'/doctors"><button class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center;margin-left:20px;">  Show all Doctors  </font></button></a>
                    </center>
                    <br><br><br><br>
                </td>
            </tr>';
        } else {
            foreach ($result->result_array() as $row) {
                $docid = $row["docid"];
                $name = $row["docname"];
                $email = $row["docemail"];
                $spe = $row["specialties"];
                $spcil_res = $this->db->select('sname')->where('id', $spe)->get('specialties');
                $spcil_array = $spcil_res->row_array();
                $spcil_name = $spcil_array["sname"];
                echo '<tr>
                    <td>  ' . substr($name, 0, 30) . '</td>
                    <td>' . substr($email, 0, 20) . '</td>
                    <td>' . substr($spcil_name, 0, 20) . '</td>
                    <td>
                        <div style="display:flex;justify-content: center;">
                            <a href="?action=edit&id=' . $docid . '&error=0" class="non-style-link"><button class="btn-primary-soft btn button-icon btn-edit" style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Edit</font></button></a>   
                            <a href="?action=view&id=' . $docid . '" class="non-style-link"><button class="btn-primary-soft btn button-icon btn-view" style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>   
                            <a href="?action=drop&id=' . $docid . '&name=' . $name . '" class="non-style-link"><button class="btn-primary-soft btn button-icon btn-delete" style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Remove</font></button></a>
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
                        <a class="close" href="'.base_url('admin').'/doctors">&times;</a>
                        <div class="content">
                            You want to delete this record<br>('.substr($nameget,0,40).').
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="'.base_url('admin').'/deleteDoctor?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="'.base_url('admin').'/doctors" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        }elseif($this->input->get('action') == 'view'){
            $query = $this->db->get_where('doctor', array('docid' => $id));
            $row = $query->row_array();
            if (isset($row))
            {
                $name = $row['docname'];
                $email = $row['docemail'];
                $spe = $row['specialties'];
                $spcil_res = $this->db->get_where('specialties', array('id' => $spe));
                $spcil_array = $spcil_res->row_array();
                if (isset($spcil_array))
                {
                    $spcil_name = $spcil_array['sname'];
                }
                $nic = $row['docnic'];
                $tele = $row['doctel'];
            }
        
        
        
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="'.base_url('admin').'/doctors">&times;</a>
                        <div class="content">
                            eDoc Web App<br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                        <tr>
                        <td>
                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Lihat Detail.</p><br><br>
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
                            <label for="nic" class="form-label">KTP: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            '.$nic.'<br><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="Tele" class="form-label">Telepon: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            '.$tele.'<br><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="spec" class="form-label">Spesialisasi: </label>
                    
                        </td>
                    </tr>
                    <tr>
                    <td class="label-td" colspan="2">
                    '.$spcil_name.'<br><br>
                    </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href=""'.base_url('admin').'/doctors"><input type="button" value="OK" class="login-btn btn-primary-soft btn"></a>
                    
                        </td>
                    
                    </tr> 
                    
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        }elseif($action=='add'){
                $error_1=$_GET["error"];
                $errorlist= array(
                    '1'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                    '2'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
                    '3'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                    '4'=>"",
                    '0'=>'',

                );
                if($error_1!='4'){
                echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    
                        <a class="close" href="'.base_url('admin').'/doctors">&times;</a> 
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        <tr>
                                <td class="label-td" colspan="2">'.
                                    $errorlist[$error_1]
                                .'</td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding: ;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add New Doctor.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                            <form action="'.base_url('admin').'/addDoctor" method="POST" class="add-new-form">

                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="name" class="input-text" placeholder="Doctor Name" required><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="email" name="email" class="input-text" placeholder="Email Address" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">NIC: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="nic" class="input-text" placeholder="NIC Number" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Choose specialties: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <select name="spec" id="" class="box" >';
                                        
                                    $list11 = $this->db->order_by('sname', 'ASC')->get('specialties');
                                    foreach ($list11->result_array() as $row00) {
                                        $sn = $row00["sname"];
                                        $id00 = $row00["id"];
                                        echo "<option value=" . $id00 . ">$sn</option><br/>";
                                    }                                    
        
        
                                        
                        echo     '       </select><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="password" class="form-label">Password: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="password" class="input-text" placeholder="Defind a Password" required><br>
                                </td>
                            </tr><tr>
                                <td class="label-td" colspan="2">
                                    <label for="cpassword" class="form-label">Conform Password: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="cpassword" class="input-text" placeholder="Conform Password" required><br>
                                </td>
                            </tr>
                            
                
                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                    <input type="submit" value="Add" class="login-btn btn-primary btn">
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

            }else{
                echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                            <br><br><br><br>
                                <h2>New Record Added Successfully!</h2>
                                <a class="close" href="'.base_url('admin').'/doctors">&times;</a>
                                <div class="content">
                                    
                                    
                                </div>
                                <div style="display: flex;justify-content: center;">
                                
                                <a href=""'.base_url('admin').'/doctors" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>

                                </div>
                                <br><br>
                            </center>
                    </div>
                    </div>
        ';
            }
        }elseif($this->input->get('action') == 'edit'){
            $query = $this->db->get_where('doctor', array('docid' => $id));
            $row = $query->row_array();
            if (isset($row))
            {
                $name = $row['docname'];
                $email = $row['docemail'];
                $spe = $row['specialties'];
                $spcil_res = $this->db->get_where('specialties', array('id' => $spe));
                $spcil_array = $spcil_res->row_array();
                if (isset($spcil_array))
                {
                    $spcil_name = $spcil_array['sname'];
                }
                $nic = $row['docnic'];
                $tele = $row['doctel'];
            }
        
            $error_1 = $this->input->get('error');
            $errorlist = array(
                '1' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                '2' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
                '3' => '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                '4' => "",
                '0' => '',
            );
        
        

            if($error_1!='4'){
                    echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                            
                                <a class="close" href="doctors">&times;</a> 
                                <div style="display: flex;justify-content: center;">
                                <div class="abc">
                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr>
                                        <td class="label-td" colspan="2">'.
                                            $errorlist[$error_1]
                                        .'</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Edit Doctor Details.</p>
                                        Doctor ID : '.$id.' (Auto Generated)<br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <form action="'.base_url('admin').'/updateDoctor" method="POST" class="add-new-form">
                                            <label for="Email" class="form-label">Email: </label>
                                            <input type="hidden" value="'.$id.'" name="id00">
                                            <input type="hidden" name="oldemail" value="'.$email.'" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                        <input type="email" name="email" class="input-text" placeholder="Email Address" value="'.$email.'" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td class="label-td" colspan="2">
                                            <label for="name" class="form-label">Name: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="name" class="input-text" placeholder="Doctor Name" value="'.$name.'" required><br>
                                        </td>
                                        
                                    </tr>
                                    
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="nic" class="form-label">NIC: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="nic" class="input-text" placeholder="NIC Number" value="'.$nic.'" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="Tele" class="form-label">Telephone: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" value="'.$tele.'" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="spec" class="form-label">Choose specialties: (Current'.$spcil_name.')</label>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <select name="spec" id="" class="box">';
                                                
                                            $query = $this->db->get('specialties');
                                            foreach ($query->result_array() as $row)
                                            {
                                                $sn = $row['sname'];
                                                $id00 = $row['id'];
                                                echo "<option value=".$id00.">$sn</option><br/>";
                                            }
                                            
                
                                                
                                echo     '       </select><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="password" class="form-label">Password: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="password" class="input-text" placeholder="Defind a Password" required><br>
                                        </td>
                                    </tr><tr>
                                        <td class="label-td" colspan="2">
                                            <label for="cpassword" class="form-label">Conform Password: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="cpassword" class="input-text" placeholder="Conform Password" required><br>
                                        </td>
                                    </tr>
                                    
                        
                                    <tr>
                                        <td colspan="2">
                                            <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        
                                            <input type="submit" value="Save" class="login-btn btn-primary btn">
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
        }else{
            echo '
                <div id="popup1" class="overlay">
                        <div class="popup">
                        <center>
                        <br><br><br><br>
                            <h2>Edit Successfully!</h2>
                            <a class="close" href="'.base_url('admin').'/doctors">&times;</a>
                            <div class="content">
                                
                                
                            </div>
                            <div style="display: flex;justify-content: center;">
                            
                            <a href="'.base_url('admin').'/doctor" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>

                            </div>
                            <br><br>
                        </center>
                </div>
                </div>
    ';



        }; };
    };

?>
</div>

</body>
</html>