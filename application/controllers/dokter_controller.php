<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter_controller extends CI_Controller {
    public function __construct()
{
    parent::__construct();
    $this->load->database();
    $this->load->helper('url');
    $this->load->model('dokter_model');

}

    public function index() {
        $this->load->view('doctor/index');
    }

    public function appointment() {
        $this->load->view('doctor/appointment');
    }

    public function schedule() {
        $this->load->view('doctor/schedule');
    }

    public function patient() {
        $this->load->view('doctor/patient');
    }

    public function settings() {
        $this->load->view('doctor/settings');
    }

    public function update() {
        if ($this->input->post()) {
            // Get input data
            $name = $this->input->post('name');
            $oldemail = $this->input->post("oldemail");
            $nic = $this->input->post('nic');
            $spec = $this->input->post('spec');
            $email = $this->input->post('email');
            $tele = $this->input->post('Tele');
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');
            $id = intval($this->input->post('id00'));

            if ($password == $cpassword) {
                // Check jika sudah ada email tersebut
                if ($doctor = $this->dokter_model->get_doctor_by_email($email)) {
                    if ($doctor['docid'] !=$id) {
                        // Email sudah ada
                        redirect("dokter/settings?action=edit&error=1&id=".$id);
                    }
                }

                // Update dokter dan data webuser
                if ($this->dokter_model->update_doctor($id, $name, $email, $password, $nic, $tele, $spec) &&
                    $this->dokter_model->update_webuser_email($oldemail, $email)) {
                    redirect("dokter/settings?action=edit&error=4&id=".$id);
                } else {
                    // Update gagal
                    redirect("dokter/settings?action=edit&error=3&id=".$id);
                }
            } else {
                // Konfirmasi Password Error
                redirect("dokter/settings?action=edit&error=2&id=".$id);
            }
        } else {
            redirect("auth/signup");
        }
    }

    public function update_status($id)
    {
        $this->dokter_model->update_status($id);
        redirect('dokter/schedule');
    }
    public function update_status_sukses($id)
{
    $this->dokter_model->update_status_sukses($id);
    redirect('dokter/schedule');
}

public function export_schedule($format, $scheduledate = NULL)
{
    // Ambil nilai docid dari sesi pengguna
    $docid = $this->session->userdata('docid');

    // Teruskan docid ke fungsi get_schedule_data()
    $data = $this->dokter_model->get_schedule_data($docid, $scheduledate);
    
    if ($format == 'pdf') {
        // Load library dompdf
        $this->load->library('dompdf_gen');

        // Ambil instance dari objek CI
        $CI =& get_instance();

        // Buat HTML untuk PDF
        $html = '<style>
                    table {
                        border-collapse: collapse;
                        width: 100%;
                    }
                    th, td {
                        border: 1px solid #dddddd;
                        text-align: center;
                        padding: 8px;
                    }
                    tr:nth-child(even) {
                        background-color: #f2f2f2;
                    }
                </style>';
        $html .= '<h1>Data Schedule</h1>';
        $html .= '<table>';
        $html .= '<tr><th>Nama Dokter</th><th>Nama Sesi</th><th>Tanggal Sesi</th><th>Jam Sesi</th><th>Maks Pasien</th><th>Status</th></tr>';
        foreach ($data as $row) {
            $html .= '<tr><td>'.$row['docname'].'</td><td>'.$row['title'].'</td><td>'.$row['scheduledate'].'</td><td>'.$row['scheduletime'].'</td><td>'.$row['nop'].'</td><td>'.$row['status'].'</td></tr>';
        }
        $html .= '</table>';

        // Tambahkan HTML ke dompdf
        $CI->dompdf->load_html($html);

        // Render PDF
        $CI->dompdf->render();

        // Output file PDF
        $CI->dompdf->stream('schedule.pdf', array('Attachment' => 0));
    } elseif ($format == 'excel') {
        // Export ke format Excel menggunakan library PHPExcel
    } elseif ($format == 'print') {
        // Tampilkan halaman untuk print menggunakan window.print()
    }
}

public function statuspatient()
{
    if ($this->input->get('action') == 'accept') {
        $id = $this->input->get('id');
        $this->dokter_model->accept_appointment($id);
        redirect('doctor/patient');
    }
}

public function deleteAppointment() {
    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='d'){
            redirect('auth/login');
        }
    }else{
        redirect('auth/login');
    }

    if($this->input->get('id')){
        $id = $this->input->get('id');
        $this->load->model('dokter_model');
        $this->dokter_model->delete_appointment($id);
        redirect("dokter_controller/appointment");
    }
}

public function finishAppointment() {
    $appoid = $this->input->post('appoid');
    if (isset($_FILES['pdfFile']) && $_FILES['pdfFile']['error'] === UPLOAD_ERR_OK) {
        // File berhasil diupload, ubah file menjadi string base64
        $pdfData = base64_encode(file_get_contents($_FILES['pdfFile']['tmp_name']));
        // Simpan string base64 ke kolom 'rekam'
        $this->db->set('rekam', $pdfData);
        $this->db->set('status', 'Selesai');
        $this->db->where('appoid', $appoid);
        $this->db->update('appointment');
    }
    redirect('dokter/appointment');
}



}