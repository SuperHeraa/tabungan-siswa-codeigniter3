<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penarikan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        is_logged_in();
        check_member();
    }

    public function index()
    {
        $data['admin'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Tarik Tunai';
        $data['siswa'] = $this->m_transaksi->tampil_siswa();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/penarikan', $data);
        $this->load->view('templates/footer');
    }

    public function tarik_tunai()
    {
        $id = $this->input->post('id_siswa');
        $tanggal = $this->input->post('tanggal_tarik');
        $saldo = reset_rupiah($this->input->post('saldo'));
        $penarikan = reset_rupiah($this->input->post('penarikan'));
        $petugas = $this->input->post('petugas');
        $keterangan = $this->input->post('keterangan');

        $data = array(
            'id_siswa'      => $id,
            'tanggal'       => $tanggal,
            'penarikan'     => $penarikan,
            'petugas'       => $petugas,
            'keterangan'    => $keterangan
        );

        $this->form_validation->set_rules('id_siswa', 'Id Siswa', 'required');
        $this->form_validation->set_rules('tanggal_tarik', 'Tanggal penarikan', 'required');
        // $this->form_validation->set_rules('penarikan', 'Jumlah penarikan', 'required|less_than_equal_to[' . $saldo . ']');
        $this->form_validation->set_rules('penarikan', 'Jumlah penarikan', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        // $this->form_validation->set_rules('penarikan', 'Jumlah Penarikan', 'greater_than[' . $this->input->post('saldo') . ']');

        if ($this->form_validation->run() == false) {
            $data['admin'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
            $data['title'] = 'Tarik Tunai';
            $data['siswa'] = $this->m_transaksi->tampil_siswa();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/penarikan', $data);
            $this->load->view('templates/footer');
        } else {

            if ($penarikan > $saldo) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show font-weight-bold" role="alert">
                GAGAL! Penarikan melebihi batas saldo!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('Penarikan');
            } elseif ($penarikan == 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show font-weight-bold" role="alert">
                GAGAL! Penarikan Tidak boleh 0!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('Penarikan');
            } else {
                $this->m_transaksi->tarik_tunai($data, 'tb_tabungan');
                $this->session->set_flashdata('message', '<div class="alert alert-success mess" role="alert">
                Tarik Tunai Berhasil!
                </div>');
                redirect('Penarikan');
            }
        }
    }
}
