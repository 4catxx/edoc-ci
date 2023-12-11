<?php
class Admin_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function delete_doctor($id) {
        //import database
        $result001 = $this->db->query("SELECT * FROM doctor WHERE docid=$id;");
        $email = ($result001->row_array())["docemail"];
        $this->db->query("DELETE FROM webuser WHERE email='$email';");
        $this->db->query("DELETE FROM doctor WHERE docemail='$email';");
    }

    public function add_doctor($data)
    {
        $name = $data['name'];
        $nic = $data['nic'];
        $spec = $data['spec'];
        $email = $data['email'];
        $tele = $data['Tele'];
        $password = $data['password'];
        $cpassword = $data['cpassword'];

        if ($password == $cpassword) {
            $error = '3';
            $result = $this->db->query("SELECT * FROM webuser WHERE email='$email';");
            if ($result->num_rows() == 1) {
                $error = '1';
            } else {
                $sql1 = "INSERT INTO doctor(docemail, docname, docpassword, docnic, doctel, specialties) VALUES('$email', '$name', '$password', '$nic', '$tele', $spec);";
                $sql2 = "INSERT INTO webuser VALUES('$email', 'd')";
                $this->db->query($sql1);
                $this->db->query($sql2);
                $error = '4';
            }
        } else {
            $error = '2';
        }
        return $error;
    }
    public function add_schedule($data)
{
    $title = $data["title"];
    $docid = $data["docid"];
    $nop = $data["nop"];
    $date = $data["date"];
    $time = $data["time"];

    $schedule_data = array(
        'docid' => $docid,
        'title' => $title,
        'scheduledate' => $date,
        'scheduletime' => $time,
        'nop' => $nop
    );
    $this->db->insert('schedule', $schedule_data);
}

public function delete_schedule($id)
{
    $this->db->delete('schedule', array('scheduleid' => $id));
}

public function update_doctor($id, $data)
    {
        $this->db->where('docid', $id);
        return $this->db->update('doctor', $data);
    }

    public function update_webuser_email($old_email, $new_email)
    {
        $this->db->where('email', $old_email);
        return $this->db->update('webuser', array('email' => $new_email));
    }

    public function get_doctor_by_email($email)
    {
        $this->db->select('doctor.docid');
        $this->db->from('doctor');
        $this->db->join('webuser', 'doctor.docemail = webuser.email');
        $this->db->where('webuser.email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }
}
