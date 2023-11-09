<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tabungan extends CI_Controller
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
        $data['title'] = 'Transaksi Tabungan';
        $data['data_tabungan'] = $this->m_tabungan->tampil_tabungan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/tabungan', $data);
        $this->load->view('templates/footer');
    }
}
