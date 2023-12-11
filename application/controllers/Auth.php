    <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Auth extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->library('session');
            $this->load->helper('url');
            $this->load->model('create_model'); // Memuat model create_model
            $this->load->model('auth_model'); // Memuat model Auth_model
        }

        public function index()
        {
            $this->load->view('index');
        }

        public function login()
        {
            if ($this->input->post()) {
                $email = $this->input->post('useremail');
                $password = $this->input->post('userpassword');

                $error = '<label for="promter" class="form-label"></label>';

                $result = $this->auth_model->getUserByEmail($email);

                if ($result->num_rows() == 1) {
                    $user = $result->row();
                    $utype = $user->usertype;

                    if ($utype == 'p') {
                        // TODO: Verify patient credentials
                        $checker = $this->auth_model->checkPatientCredentials($email, $password);

                        if ($checker->num_rows() == 1) {
                            // Patient dashboard
                            $patient = $checker->row();
                            $this->session->set_userdata('user', $email);
                            $this->session->set_userdata('usertype', 'p');
                            $this->session->set_userdata('pname', $patient->pname); // ngambil data pname dari hasil query
                            $this->session->set_userdata('pemail', $patient->pemail); // ngambil data pemail dari hasil query
                            
                            
                        } else {
                            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                        }
                    } elseif ($utype == 'a') {
                        // TODO: Verify admin credentials
                        $checker = $this->auth_model->checkAdminCredentials($email, $password);

                        if ($checker->num_rows() == 1) {
                            // Admin dashboard
                            $admin = $checker->row();
                            $this->session->set_userdata('user', $email);
                            $this->session->set_userdata('usertype', 'a');
                            $this->session->set_userdata('aemail', $admin->aemail); // ngambil data aemail dari hasil query
                            
                        } else {
                            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                        }
                    } elseif ($utype == 'd') {
                        // TODO: Verify doctor credentials
                        $checker = $this->auth_model->checkDoctorCredentials($email, $password);

                        if ($checker->num_rows() == 1) {
                            // Doctor dashboard
                            $doctor = $checker->row();
                            $this->session->set_userdata('user', $email);
                            $this->session->set_userdata('usertype', 'd');
                            $this->session->set_userdata('dname', $doctor->docname); // Mengambil data docname dari hasil query
                            $this->session->set_userdata('demail', $doctor->docemail); // Mengambil data docemail dari hasil query
                            $this->session->set_userdata('docid', $doctor->docid);
                            
                        } else {
                            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                        }
                    }
                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We can\'t find any account for this email.</label>';
                }
            } else {
                $error = '<label for="promter" class="form-label">&nbsp;</label>';
            }

            $data['error'] = $error;
            if ($this->session->userdata('usertype') == 'a') {
                redirect('admin/index');
            } elseif ($this->session->userdata('usertype') == 'p') {
                redirect('patient/index');
            } elseif ($this->session->userdata('usertype') == 'd') {
                redirect('dokter/index');
            }
            
            $this->load->view('auth/login', $data);
        }

        public function signup()
        {
            $this->load->model('create_model'); // Memuat model Create_model
            $this->load->model('auth_model'); // Memuat model Auth_model
            $this->load->view('auth/signup');

            if ($this->input->post()) {
                $personalData = array(
                    'pname' => $this->input->post('name'),
                    'paddress' => $this->input->post('address'),
                    'pnic' => $this->input->post('nic'),
                    'pdob' => $this->input->post('dob')
                );

                $this->session->set_userdata('personal', $personalData);

                redirect('auth/create_account'); // alamat create account
            }
        }

        public function create_account()
        {
            $this->load->view('auth/create_account');

            if ($this->input->post()) {
                $data = [
                    'pemail' => $this->input->post('newemail'),
                    'pname' => $this->session->userdata('personal')['pname'],
                    'ppassword' => $this->input->post('newpassword'),
                    'paddress' => $this->session->userdata('personal')['paddress'],
                    'pnic' => $this->session->userdata('personal')['pnic'],
                    'pdob' => $this->session->userdata('personal')['pdob'],
                    'ptel' => $this->input->post('tele')
                ];

                $result = $this->create_model->createAccount($data);

                if ($result) {
                    $this->session->set_userdata('user', $data['pemail']);
                    $this->session->set_userdata('usertype', 'p');
                    $this->session->set_userdata('username', $data['pname']);

                    $dataWebUser = array(
                        'email' => $data['pemail'],
                        'usertype' => 'p' // tipe pengguna
                    );

                    $this->create_model->createWebUser($dataWebUser);

                    redirect('auth/login'); // Ganti dengan alamat yang sesuai
                } else {
                    $data['error'] = 'Terjadi kesalahan saat membuat akun.';
                }
            } else {
                $data['error'] = '';
            }
        }

        public function logout()
        {
            $this->session->sess_destroy();

            // Redirect user ke login
            redirect('auth/login?action=logout');
        }
    }


