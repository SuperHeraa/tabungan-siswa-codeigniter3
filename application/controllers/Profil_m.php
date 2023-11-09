<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil_m extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();


        is_logged_in();
        check_admin();
    }
    public function index()
    {
        // $data['siswa'] = $this->db->get_where('tb_siswa', ['email' => $this->session->userdata('email')])->row_array();
        $data['siswa'] = $this->m_siswa->profil_siswa();
        $data['title'] = 'Profil';

        $this->load->view('templates/header', $data);
        $this->load->view('template_member/sidebar', $data);
        $this->load->view('template_member/topbar', $data);
        $this->load->view('member/profil', $data);
        $this->load->view('template_member/footer');
    }

    public function edit()
    {
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $ids = $this->input->post('id_siswa');

        $this->db->set('nama', $nama);
        $this->db->where('id_siswa', $ids);
        $this->db->update('tb_siswa');

        $row = $this->db->get_where('tb_siswa', ['id_siswa' => $this->session->userdata('id_siswa')])->row_array();
        $email_old = $row['email'];

        if ($email != $email_old) {

            $this->db->set('email', $email);
            $this->db->where('id_siswa', $ids);
            $this->db->update('tb_siswa');

            $this->session->unset_userdata('email');
            $this->session->unset_userdata('role_id');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Email berhasil diganti, silahkan login kembali!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('Auth');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success mess" role="alert">
            Data berhasil di ubah!
            </div>');
            redirect('Profil_m');
        }
    }

    public function upload()
    {
        $data['user'] = $this->db->get_where('tb_siswa', ['email' => $this->session->userdata('email')])->row_array();
        $old_image = $data['user']['image'];
        $email = $data['user']['email'];

        // if ($old_image != 'default.png') {
        //     unlink(FCPATH . 'assets/img/' . $old_image);
        // }

        if (isset($_POST["image"])) {

            $tempdir = "assets/img/";

            if ($old_image != 'default.png') {
                unlink(FCPATH . 'assets/img/' . $old_image);
            }

            if (!file_exists($tempdir))
                mkdir($tempdir);

            $data = $_POST["image"];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);

            $imageName = $tempdir . time() . '.png';
            $imageDb = time() . '.png';
            file_put_contents($imageName, $data);

            $this->db->set('image', $imageDb);
            $this->db->where('email', $email);
            $this->db->update('tb_siswa');

            echo '<img src="' . $imageName . '" class="img-fluid rounded img-thumbnail shadow mb-4" width="200" />';
        }
    }

    public function change()
    {
        $data['siswa'] = $this->db->get_where('tb_siswa', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Ubah Password';


        $this->load->library('form_validation');

        $this->form_validation->set_rules('current_password', 'Password Saat Ini', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'Password Baru', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Konfirmasi Password Baru', 'required|trim|min_length[4]|matches[new_password1]');

        if ($this->form_validation->run() == false) {

            $this->load->view('template_member/header', $data);
            $this->load->view('template_member/sidebar', $data);
            $this->load->view('template_member/topbar', $data);
            $this->load->view('member/e_pass_m', $data);
            $this->load->view('template_member/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($current_password, $data['siswa']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Password Saat Ini Salah!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('Profil_m/change');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Password Baru Tidak Boleh Sama Dengan Yang Lama!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('Profil_m/change');
                } else {
                    // jika password benar
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('tb_siswa');

                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Password Berhasil Di Ubah!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('Profil_m/change');
                }
            }
        }
    }
}
