<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller {
    public function __construct()
{
    parent::__construct();
    $this->load->database();
    $this->load->helper('url');
    $this->load->model('User_model');
}

    public function index() {
        $this->load->view('patient/index');
    }

    public function doctors() {
        $this->load->view('patient/doctors');
    }

    public function schedule() {
        $this->load->view('patient/schedule');
    }   

    public function appointment() {
        $this->load->view('patient/appointment');
    }

    public function settings() {
        $this->load->view('patient/settings');
    }

    public function booking() {
        $this->load->view('patient/booking');
    }

    public function bookingComplete() {
        $this->load->view('patient/booking-complete');
    }

    public function History() {
        // Pastikan user sudah login
        if (!$this->session->has_userdata('user') || $this->session->userdata('usertype') != 'p') {
            redirect('auth/login');
        }
    
        // Ambil data user yang sedang login
        $useremail = $this->session->userdata('user');
        $sqlmain = "SELECT pid, pname FROM patient WHERE pemail = ?";
        $query = $this->db->query($sqlmain, array($useremail));
        $user = $query->row();
    
        // Jika user tidak ditemukan, redirect ke halaman login
        if (!$user) {
            redirect('auth/login');
        }
    
        $userid = $user->pid;
    
        // Panggil function history_appointment untuk mendapatkan data history
        $this->load->model('User_model');
        $historyData = $this->User_model->history_appointment($userid);
    
        // Load view dan kirim data history ke view
        $data['historyData'] = $historyData;
        $this->load->view('patient/history', $data);
    }

    public function cancelAppointment() {
        if(isset($_SESSION["user"])){
            if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
                redirect('auth/login');
            }
        } else {
            redirect('auth/login');
        }
    
        if($this->input->get('id')){
            $id = $this->input->get('id');
            $this->load->model('user_model');
            $this->user_model->cancel_appointment($id);  // Memanggil fungsi dari user_model
            redirect("dashboard_controller/appointment");
        }
    }
    
    public function delete_user() {
        if($this->session->has_userdata('user')){
            if(($this->session->userdata('user'))=="" or $this->session->userdata('usertype')!='p'){
                redirect('auth/login');
            }else{
                $useremail=$this->session->userdata('user');
            }
        }else{
            redirect('auth/login.php');
        }

        if($this->input->get('id')){
            $id = $this->input->get('id');
            $this->load->model('user_model');
            $this->user_model->delete_user($id);
            redirect("auth/logout");
        }
    }

    public function update_user() {
        // Load the User_model
        $this->load->model('User_model');

        // mengambil input user dari $_POST
        
        $id = $_POST['id00'];
        $name = $_POST['name'];
        $nic = $_POST['nic'];
        $oldemail = $_POST["oldemail"];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $tele = $_POST['Tele'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        // Call the update_user function in the User_model
        // You may want to handle errors or perform additional actions based on the result
        // returned by the update_user function
        $result = $this->User_model->update_user($id, $name, $nic, $oldemail, $address, $email, $tele, $password, cpassword);

        // Redirect the user to the appropriate page
        redirect("patient/settings?action=edit&error=" . urlencode($result['error']) . "&id=" . urlencode($result['id']));
    }

    public function status_appointment()
{
    if ($this->input->get('action') == 'drop') {
        // kode untuk membatalkan pemesanan
    } elseif ($this->input->get('action') == 'complete') {
        $id = $this->input->get('id');
        $this->patient_model->complete_appointment($id);
        redirect('patient/appointment');
    }
}
public function update_status() {
    // Load model
$this->load->model('User_model');
$data['appointments'] = $this->User_model->history_appointment($userid);

// Load view dan kirim data history ke view
$this->load->view('patient/history', $data);
}

public function download_record() {
    $appoid = $this->input->get('id');
    $this->db->select('rekam');
    $this->db->where('appoid', $appoid);
    $query = $this->db->get('appointment');
    $record = $query->row()->rekam;
    $fileData = base64_decode($record);
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="Rekam Medik.pdf"');
    echo $fileData;
}

}