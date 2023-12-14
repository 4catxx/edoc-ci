<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin_controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('admin_model');
    }

    public function index() {
        $this->load->view('admin/index');
    }

    public function doctors() {
        $this->load->view('admin/doctors');
    }

    
    public function schedule() {
        $this->load->view('admin/schedule');
    }

    public function appointment() {
        $this->load->view('admin/appointment');
    }

    public function patient() {
        $this->load->view('admin/patient');
    }
    public function deleteDoctor() {
        if(isset($_SESSION["user"])){
            if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
                redirect('auth/login');
            }
        }else{
            redirect('auth/login');
        }
        if($this->input->get('id')){
            $id = $this->input->get('id');
            
            $this->admin_model->delete_doctor($id);
            redirect('admin/doctors');
        }
    }

    public function deleteAppointment() {
        if(isset($_SESSION["user"])){
            if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
                redirect('auth/login');
            }
        }else{
            redirect('auth/login');
        }
        if($this->input->get('id')){
            $id = $this->input->get('id');
            
            $this->admin_model->delete_appointment($id);
            redirect('admin/Appointment');
        }
    }
    public function addDoctor() 
    {
        // Check izin
        if (isset($_SESSION["user"])) {
            if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
                redirect('auth/login.php');
            }
        } else {
            redirect('auth/login.php');
        }
        // Ngambil data dari form
        $data = array(
            'name' => $_POST['name'],
            'nic' => $_POST['nic'],
            'spec' => $_POST['spec'],
            'email' => $_POST['email'],
            'Tele' => $_POST['Tele'],
            'password' => $_POST['password'],
            'cpassword' => $_POST['cpassword']
        );

        // Manggil function model
        $error = $this->admin_model->add_doctor($data);
        // Redirect ke page doctor
        if ($error == '4') {
            redirect("admin/doctors");
        // Redirect ke page doctor dengan error
        } else {
        redirect("admin/doctors?action=add&error=" . $error);
    }
        
}
public function addSchedule()
{
    // Check izin
    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
            redirect('auth/login.php');
        }
    } else {
        redirect('auth/login.php');
    }

    // Ngambil data dari form
    $data = array(
        'title' => $this->input->post("title"),
        'docid' => $this->input->post("docid"),
        'nop' => $this->input->post("nop"),
        'date' => $this->input->post("date"),
        'time' => $this->input->post("time")
    );

    // Manggil function model
    $this->admin_model->add_schedule($data);

    // Redirect ke page schedule
    redirect("admin/schedule");
}

public function deleteSchedule()
{
    // Check izin
    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
            redirect('auth/login');
        }
    } else {
        redirect('auth/login');
    }

    // Ngambil data dari URL
    $id = $this->input->get('id');

    // Manggil function model
    $this->admin_model->delete_schedule($id);

    // Redirect ke page schedule
    redirect("admin/schedule");
}

public function updateDoctor()
{
    if ($this->input->post()) {
        // Get POST data
        $name = $this->input->post('name');
        $nic = $this->input->post('nic');
        $oldemail = $this->input->post("oldemail");
        $spec = $this->input->post('spec');
        $email = $this->input->post('email');
        $tele = $this->input->post('Tele');
        $password = $this->input->post('password');
        $cpassword = $this->input->post('cpassword');
        $id = $this->input->post('id00');
        if ($password == $cpassword) {
            // Check kalo dokter ada email yang sama
            if ($doctor = $this->admin_model->get_doctor_by_email($email)) {
                // Ada dokter dengan email yang sama
                redirect("doctors.php?action=edit&error=1&id=$id");
            } else {
                // Update doctor dan webuser data
                if ($this->admin_model->update_doctor($id, array(
                    'docemail' =>  $email,
                    'docname' =>  $name,
                    'docpassword' =>  $password,
                    'docnic' =>  $nic,
                    'doctel' =>  $tele,
                    'specialties' =>  $spec
                ))) {
                    if ($this->admin_model->update_webuser_email($oldemail, $email)) {
                        redirect("doctors.php?action=edit&error=4&id=$id");
                    } else {
                        redirect("doctors.php?action=edit&error=3&id=$id");
                    }
                } else {
                    redirect("doctors.php?action=edit&error=3&id=$id");
                }
            }
        } else {
        
            redirect("doctors.php?action=edit&error=2&id=$id");
        }
    } else {
        redirect("doctors.php?action=edit&error=3&id=$id");
    }
}
}
