<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        check_admin();
    }
    public function index()
    {
        $id = $this->session->userdata('id_siswa');

        $data['member'] = $this->db->get_where('tb_siswa', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Transaksi';
        $data['siswa'] = $this->db->get_where('tb_siswa', ['id_siswa' => $this->session->userdata('id_siswa')])->row_array();
        $data['tmp_riwayat'] = $this->m_detail->tampil_riwayat($id);

        $this->load->view('template_member/header', $data);
        $this->load->view('template_member/sidebar', $data);
        $this->load->view('template_member/topbar', $data);
        $this->load->view('member/transaksi', $data);
        $this->load->view('template_member/footer');
    }
}
