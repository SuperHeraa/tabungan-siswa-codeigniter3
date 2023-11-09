<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
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
        $data['title'] = 'Laporan';
        $data['kelas'] = $this->m_kelas->tampil_kelas();
        $data['jurusan'] = $this->m_siswa->tampil_jurusan()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/laporan');
        $this->load->view('templates/footer');
    }
}
