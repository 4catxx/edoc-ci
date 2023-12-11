<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getUserByEmail($email)
    {
        return $this->db->get_where('webuser', ['email' => $email]);
    }

    public function checkPatientCredentials($email, $password)
    {
        return $this->db->get_where('patient', ['pemail' => $email, 'ppassword' => $password]);
    }

    public function checkAdminCredentials($email, $password)
    {
        return $this->db->get_where('admin', ['aemail' => $email, 'apassword' => $password]);
    }

    public function checkDoctorCredentials($email, $password)
    {
        return $this->db->get_where('doctor', ['docemail' => $email, 'docpassword' => $password]);
    }
}
