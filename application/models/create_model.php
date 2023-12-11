<?php
defined('BASEPATH') or exit('No direct script access allowed');

class create_model extends CI_Model
{
    public function createAccount($data)
    {
        return $this->db->insert('patient', $data);
    }
    public function createWebUser($data)
    {
        return $this->db->insert('webuser', $data);
    }
}
