<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        check_member();
    }
    public function index()
    {
        $data['admin'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Pengguna';
        $data['user'] = $this->db->get('tb_user')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/pengguna', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_pengguna()
    {
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $d_pw = 'admin123456';
        $password = password_hash($d_pw, PASSWORD_DEFAULT);

        $data = array(
            'nama'  => $nama,
            'email' => $email,
            'password' => $password,
            'image'    => 'default.png',
            'role_id' => 1,
            'date_created' => time()
        );

        $this->m_user->add_pengguna($data, 'tb_user');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data baru berhasil ditambahkan!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('Pengguna');
    }

    public function edit()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');

        $data = array(
            'nama'  => $nama,
            'email' => $email,
        );

        $where = array(
            'id'    => $id
        );

        $this->m_user->edit_user($data, $where, 'tb_user');
        $this->session->set_flashdata('message', '<div class="alert alert-success mess" role="alert">
        Data berhasil di ubah, Silahkan login kembali!
        </div>');
        redirect('Auth/logout');
    }

    public function hapus($id)
    {
        $where = array('id' => $id);
        // $usr_admin = $this->db->get_where('tb_user', ['id' => $id])->row_array();
        // if ($id == $usr_admin['id']) {
        //     $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        // User Admin tidak dapat dihapus!
        // <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        // <span aria-hidden="true">&times;</span>
        // </button>
        // </div>');
        //     redirect('Pengguna');
        // }
        $query = $this->db->get('tb_user');
        if ($query->num_rows() == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Tidak dapat menghapus semua pengguna!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
            redirect('Pengguna');
        } else {

            $user['img'] = $this->db->get_where('tb_user', ['id' => $id])->row_array();
            $old_image = $user['img']['image'];

            if ($old_image != 'default.png') {
                unlink(FCPATH . 'assets/img/' . $old_image);
            }

            $this->m_user->hapus_user($where, 'tb_user');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Pengguna berhasil dihapus!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
            redirect('Pengguna');
        }
        // $this->m_user->hapus_user($where, 'tb_user');
        // $this->session->set_flashdata('message', '<div class="alert alert-success mess" role="alert">
        // Data berhasil dihapus!
        // </div>');
        // redirect('Pengguna');
    }
}
