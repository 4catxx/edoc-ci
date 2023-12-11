<?php
class Dokter_model extends CI_Model {

    public function update_doctor($id, $name, $email, $password, $nic, $tele, $spec) {
        $data = array(
            'docemail' => $email,
            'docname' => $name,
            'docpassword' => $password,
            'docnic' => $nic,
            'doctel' => $tele,
            'specialties' => $spec
        );
        $this->db->where('docid', $id);
        return $this->db->update('doctor', $data);
    }

    public function update_webuser_email($oldemail, $newemail) {
        $data = array(
            'email' => $newemail
        );
        $this->db->where('email', $oldemail);
        return $this->db->update('webuser', $data);
    }

    public function get_doctor_by_email($email) {
        return $this->db->get_where('doctor', array('docemail' => $email))->row_array();
    }

    public function update_status($id)
    {
        $data = array(
            'status' => 'Dibatalkan'
        );

        $this->db->where('scheduleid', $id);
        return $this->db->update('schedule', $data);
    }
    public function update_status_sukses($id)
{
    $data = array(
        'status' => 'Sukses'
    );

    $this->db->where('scheduleid', $id);
    return $this->db->update('schedule', $data);
}

public function get_schedule_data($docid, $scheduledate)
{
    $this->db->select('doctor.docname, schedule.title, schedule.scheduledate, schedule.scheduletime, schedule.nop, schedule.status');
    $this->db->from('schedule');
    $this->db->join('doctor', 'schedule.docid = doctor.docid');
    $this->db->where('schedule.docid', $docid);
    
    if (!empty($scheduledate)) {
        $this->db->where('schedule.scheduledate', $scheduledate);
    }
    
    $query = $this->db->get();
    return $query->result_array();
}

public function accept_appointment($id)
{
    $data = array(
        'status' => 'Diterima'
    );

    $this->db->where('appoid', $id);
    return $this->db->update('appointment', $data);
}
public function delete_appointment($id)
{
    $sql = "delete from appointment where appoid=?";
    $this->db->query($sql, array($id));
}

}
?>