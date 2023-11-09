<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        check_admin();
    }

    public function index()
    {
        $this->load->model('m_dashboard');
        // $data['member'] = $this->db->get_where('tb_member', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Beranda';
        $data['siswa'] = $this->db->get_where('tb_siswa', ['id_siswa' => $this->session->userdata('id_siswa')])->row_array();
        $data['saldo'] = $this->m_member->hitungSaldo();
        $data['transaksi_bulanan'] = $this->m_member->transaksiBulanan();
        $data['leaderboard'] = $this->m_dashboard->leaderboard();
        $data['setoran_harian'] = $this->m_member->setoranHarian();
        $data['penarikan_harian'] = $this->m_member->penarikanHarian();

        $this->load->view('templates/header', $data);
        $this->load->view('template_member/sidebar', $data);
        $this->load->view('template_member/topbar', $data);
        $this->load->view('member/beranda', $data);
        $this->load->view('templates/footer');
    }
}
