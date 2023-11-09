<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    // bismillahirrohmanirrohim
    // ==========================================================
    // Aplikasi Tabsis V.1.0 - SMK Citra Mandiri Guranteng
    // ==========================================================
    // Author : Hera Rizki Eristiazhi                           
    // Hobi   : Rebahan, tapi otak stress mikirin masa depan :v 
    // ==========================================================


    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            $data['adm'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
            if ($data['adm']['role_id'] == 1) {
                redirect('admin');
            } else {
                redirect('member');
            }
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'TABSIS SMKCM - LOGIN';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = htmlspecialchars($this->input->post('password', true));

        $user = $this->db->get_where('tb_user', ['email' => $email])->row_array();
        $siswa = $this->db->get_where('tb_siswa', ['email' => $email])->row_array();

        if ($user) {
            //user ada
            // password_verify($password, $user['password'])
            if (password_verify($password, $user['password'])) {
                //pass benar
                $data = [
                    'email' => $user['email'],
                    'role_id' => $user['role_id'],
                    'image' => $user['image']
                ];

                $this->session->set_userdata($data);
                redirect('Admin');
                // if ($user['role_id'] == 1) {
                //     redirect('Admin');
                // } else {
                //     redirect('member');
                // }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
                redirect('auth');
            }
        } elseif ($siswa) {
            if (password_verify($password, $siswa['password'])) {
                //pass benar
                $data = [
                    'email' => $siswa['email'],
                    'id_siswa' => $siswa['id_siswa'],
                    'role_id' => $siswa['role_id']
                ];

                $this->session->set_userdata($data);
                redirect('Member');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil logout!</div>');
        redirect('auth');
    }

    public function block()
    {
        $this->load->view('auth/block');
    }
    public function block_member()
    {
        $this->load->view('auth/block-member');
    }

    public function forgot_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {

            $data['title'] = 'Reset Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $siswa = $this->db->get_where('tb_siswa', ['email' => $email])->row_array();
            $admin = $this->db->get_where('tb_user', ['email' => $email])->row_array();

            if ($siswa || $admin) {

                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('tb_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Cek email anda untuk mereset password!</div>');
                redirect('auth/forgot_password');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');
                redirect('auth/forgot_password');
            }
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'      => 'smtp',
            'smtp_host'     => 'ssl://smtp.googlemail.com',
            'smtp_user'     => 'tabsis.smkcm@gmail.com',
            'smtp_pass'     => 'xfhblkwckbvaqbim',
            'smtp_port'     => 465,
            'mailtype'      => 'html',
            'charset'       => 'utf-8',
            'newline'       => "\r\n"

        ];

        $this->load->library('email', $config);

        $this->email->from('tabsis.smkcm@gmail.com', 'SMK CITRA MANDIRI');
        $this->email->to($this->input->post('email'));


        if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Halo Sobat!! Silahkan klik link berikut ini untuk mereset password anda ( Link Reset Akan Kadaluarsa Dalam 1 Hari ) : 
            <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password Sekarang</a>
            ');
        }


        if ($this->email->send()) {
            return true;
        } else {
            $this->email->print_debugger();
            die;
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $admin = $this->db->get_where('tb_user', ['email' => $email])->row_array();
        $siswa = $this->db->get_where('tb_siswa', ['email' => $email])->row_array();

        if ($admin || $siswa) {
            $user_token = $this->db->get_where('tb_token', ['token' => $token])->row_array();

            if ($user_token) {

                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->session->set_userdata('reset_email', $email);
                    $this->changePassword();
                } else {
                    $this->db->delete('tb_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password Gagal! Token Kadaluarsa.</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password Gagal! Token Salah.</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password Gagal! Email Salah.</div>');
            redirect('auth');
        }
    }

    public function changePassword()
    {

        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'trim|required|min_length[6]|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Ganti Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $admin = $this->db->get_where('tb_user', ['email' => $email])->row_array();
            $siswa = $this->db->get_where('tb_siswa', ['email' => $email])->row_array();

            if ($admin) {

                $this->db->set('password', $password);
                $this->db->where('email', $email);
                $this->db->update('tb_user');

                $this->session->unset_userdata('reset_email');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah! Silahkan Login.</div>');
                redirect('auth');
            } elseif ($siswa) {
                $this->db->set('password', $password);
                $this->db->where('email', $email);
                $this->db->update('tb_siswa');

                $this->session->unset_userdata('reset_email');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah! Silahkan Login.</div>');
                redirect('auth');
            } else {
                $this->session->unset_userdata('reset_email');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password Gagal! Email Tidak Terdaftar.</div>');
                redirect('auth');
            }
        }
    }
}
