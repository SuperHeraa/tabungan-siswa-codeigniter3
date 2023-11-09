<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        check_member();
    }

    public function index()
    {
        $this->load->model('m_dashboard');
        $data['admin'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Dashboard';
        $data['total_siswa'] = $this->m_dashboard->hitungJumlahSiswa();
        $data['persen_siswa'] = $this->m_dashboard->persentaseSiswa();
        $data['total_saldo'] = $this->m_dashboard->totalTabungan();
        $data['pemasukan_harian'] = $this->m_dashboard->pemasukanHarian();
        $data['penarikan_harian'] = $this->m_dashboard->penarikanHarian();
        $data['in_out'] = $this->m_dashboard->in_out_perbulan();
        $data['jml_siswa'] = $this->m_dashboard->jml_siswa();
        $data['siswa_nabung'] = $this->m_dashboard->siswaNabung();
        $data['jml_laki'] = $this->m_dashboard->jml_laki();
        $data['jml_perempuan'] = $this->m_dashboard->jml_perempuan();
        $data['prog_laki'] = $this->m_dashboard->progresbar_jml_Laki();
        $data['prog_perempuan'] = $this->m_dashboard->progresbar_jml_perempuan();
        $data['leaderboard'] = $this->m_dashboard->leaderboard();
        $data['transaksi_mingguan'] = $this->m_dashboard->transaksiMingguan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function getData()
    {
        $this->load->model('m_dashboard');
        $data = $this->m_dashboard->in_out_perbulan();
        echo json_encode($data);

        // print_r($cek);
        // exit();
    }
}
