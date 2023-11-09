<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        check_member();
    }
    public function index($id)
    {
        $decrypt_id = decrypt_url($id);
        $data['admin'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Detail Tabungan';
        $data['detail_siswa'] = $this->m_detail->tampil_detail($decrypt_id);
        $data['ds_image'] = $this->db->get_where('tb_siswa', ['id_siswa' => $decrypt_id])->row_array();
        $data['tmp_riwayat'] = $this->m_detail->tampil_riwayat($decrypt_id);
        $data['jurusan'] = $this->m_detail->tampil_jurusan($decrypt_id);

        if ($data['ds_image']['id_siswa'] != $decrypt_id) {
            $this->load->view('auth/block');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/detail', $data);
            $this->load->view('templates/footer');
        }
    }

    public function edit($id)
    {
        $id = $this->input->post('id_tabungan');
        $idsiswa = $this->input->post('id_siswa');
        $setoran = $this->input->post('setoran');
        $penarikan = $this->input->post('penarikan');
        $keterangan = $this->input->post('keterangan');


        $data = array(
            'setoran'    => $setoran,
            'penarikan'  => $penarikan,
            'keterangan' => $keterangan
        );

        $where = array(
            'id_tabungan' => $id
        );

        $this->m_siswa->update_data($where, $data, 'tb_tabungan');
        $this->session->set_flashdata('message', '<div class="alert alert-success mess" role="alert">
        Data berhasil di ubah!
        </div>');
        redirect('Detail/index/' . encrypt_url($idsiswa));
    }

    public function hapus($id)
    {
        $idsiswa = $this->db->get_where('tb_tabungan', ['id_tabungan' => $id])->row_array();
        $where = array('id_tabungan' => $id);
        $this->m_detail->hapus_detrans($where, 'tb_tabungan');
        $this->session->set_flashdata('message', '<div class="alert alert-success mess" role="alert">
            Data berhasil dihapus!
            </div>');
        redirect('Detail/index/' . encrypt_url($idsiswa['id_siswa']));
    }
}
