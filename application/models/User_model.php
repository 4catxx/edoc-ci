<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model {

public function __construct()
{
    $this->load->database();
}

public function delete_user($id)
{
    $sqlmain= "select * from patient where pid=?";
    $query = $this->db->query($sqlmain, array($id));
    $email = ($query->row())->pemail;

    $sqlmain= "delete from webuser where email=?;";
    $this->db->query($sqlmain, array($email));

    $sqlmain= "delete from patient where pemail=?";
    $this->db->query($sqlmain, array($email));
}
public function update_user($id, $name, $nic, $oldemail, $address, $email, $tele, $password, $cpassword) {
    if ($password == $cpassword) {
        $error = '3';

        $sqlmain = "SELECT patient.pid FROM patient INNER JOIN webuser ON patient.pemail=webuser.email WHERE webuser.email=?";
        $query = $this->db->query($sqlmain, array($email));
        if ($query->num_rows() == 1) {
            $id2 = $query->row()->pid;
        } else {
            $id2 = $id;
        }

        if ($id2 != $id) {
            $error = '1';
        } else {
            $sql1 = "UPDATE patient SET pemail='$email', pname='$name', ppassword='$password', pnic='$nic', ptel='$tele', paddress='$address' WHERE pid=$id";
            $this->db->query($sql1);
            echo $sql1;
            $sql1 = "UPDATE webuser SET email='$email' WHERE email='$oldemail'";
            $this->db->query($sql1);
            echo $sql1;

            $error = '4';
        }
    } else {
        $error = '2';
    }

    return array(
        'error' => $error,
        'id' => $id
    );
}

public function complete_appointment($id)
{
    $data = array(
        'status' => 'Selesai'
    );

    $this->db->where('appoid', $id);
    return $this->db->update('appointment', $data);
}

public function cancel_appointment($id)
{
    $statusCanceled = 'Dibatalkan';

    $sql = "UPDATE appointment SET status = ? WHERE appoid = ?";
    $this->db->query($sql, array($statusCanceled, $id));
}


public function history_appointment($id)
{
    $sql = "SELECT appointment.appodate, patient.pname, schedule.title AS session_name, doctor.docname 
            FROM appointment
            INNER JOIN patient ON appointment.pid = patient.pid
            INNER JOIN schedule ON appointment.scheduleid = schedule.scheduleid
            INNER JOIN doctor ON schedule.docid = doctor.docid
            WHERE patient.pid = ?
            ORDER BY appointment.appodate DESC";

    $query = $this->db->query($sql, array($id));
    return $query->result_array();
}

public function updateStatus($useremail) {
    // Dapatkan tanggal saat ini berdasarkan timezone 'Asia/Jakarta'
    date_default_timezone_set('Asia/Jakarta');
    $today = date('Y-m-d');

    // Query untuk mendapatkan appointments berdasarkan email pengguna
    $query = $this->db->query("SELECT * FROM appointment WHERE pid IN (SELECT pid FROM patient WHERE pemail = ?)", array($useremail));

    // Ubah status dan kembalikan hasil
    $result = [];
    foreach ($query->result_array() as $row) {
        // Periksa apakah tanggal sudah terlewat
        $isExpired = strtotime($today) > strtotime($row["scheduledate"]);

        // Set status sesuai kondisi
        if ($row["status"] === null) {
            $row["status"] = $isExpired ? "Dibatalkan" : "Sedang Berjalan";
        }

        $result[] = $row;
    }

    return $result;
}

}
