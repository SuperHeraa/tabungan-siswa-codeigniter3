<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setoran extends CI_Controller
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
        $data['title'] = 'Setor Tunai';
        $data['siswa'] = $this->m_siswa->tampil_data();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/setoran', $data);
        $this->load->view('templates/footer');
    }

    public function setor_tunai()
    {
        $id_siswa   = $this->input->post('id_siswa');
        $tanggal    = $this->input->post('tanggal_setor');
        $setoran    = reset_rupiah($this->input->post('setoran'));
        $petugas    = $this->input->post('petugas');
        $keterangan = $this->input->post('keterangan');

        $data = array(
            'id_siswa'     => $id_siswa,
            'tanggal'       => $tanggal,
            'setoran'       => $setoran,
            'petugas'       => $petugas,
            'keterangan'    => $keterangan
        );

        $this->form_validation->set_rules('setoran', 'Setoran', 'required');
        $this->form_validation->set_rules('tanggal_setor', 'Tanggal', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('id_siswa', 'Id Siswa', 'required');

        if ($this->form_validation->run() == false) {
            // $data['admin'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
            // $data['title'] = 'Setor Tunai';
            // $data['siswa'] = $this->m_siswa->tampil_data();

            // $this->load->view('templates/header', $data);
            // $this->load->view('templates/sidebar');
            // $this->load->view('templates/topbar', $data);
            // $this->load->view('admin/setoran', $data);
            // $this->load->view('templates/footer');
            $this->index();
        } else {
            $this->m_transaksi->setoran($data, 'tb_tabungan');
            $this->session->set_flashdata('message', '<div class="alert alert-success mess" role="alert">
                Data tabungan berhasil disetorkan!
                </div>');
            redirect('Setoran');
        }
    }
}
