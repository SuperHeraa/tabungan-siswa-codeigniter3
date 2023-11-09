<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
    }
    public function index()
    {
        $people = $this->session->userdata('role_id');
        $data['title'] = 'Pengajuan';

        if ($people == '1') {
            check_member();
            $data['admin'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
            $data['pengajuan'] = $this->m_siswa->tampil_pengajuan_usr()->result();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/pengajuan_usr', $data);
            $this->load->view('templates/footer');
        } else {
            check_admin();
            $data['siswa'] = $this->db->get_where('tb_siswa', ['id_siswa' => $this->session->userdata('id_siswa')])->row_array();
            $data['ri_pengajuan'] = $this->m_siswa->tampil_pengajuan()->result();
            $this->load->view('template_member/header', $data);
            $this->load->view('template_member/sidebar', $data);
            $this->load->view('template_member/topbar', $data);
            $this->load->view('member/pengajuan_m', $data);
            $this->load->view('template_member/footer');
        }
    }

    public function tambah() // pengajuan
    {
        $data['siswa'] = $this->db->get_where('tb_siswa', ['id_siswa' => $this->session->userdata('id_siswa')])->row_array();
        $data['title'] = 'Tambah Pengajuan';
        $this->load->view('template_member/header', $data);
        $this->load->view('template_member/sidebar', $data);
        $this->load->view('template_member/topbar', $data);
        $this->load->view('member/tambah_pengajuan', $data);
        $this->load->view('template_member/footer');
    }

    public function add()
    {
        $subjek = htmlspecialchars($this->input->post('subjek'));
        $ket = htmlspecialchars($this->input->post('keterangan'));
        $ids = $this->session->userdata('id_siswa');
        $nominal = reset_rupiah($this->input->post('penarikan'));

        $this->db->select('SUM(setoran) as jml_setor, SUM(penarikan) as jml_tarik');
        $this->db->from('tb_tabungan');
        $this->db->where('id_siswa', $ids);
        $query = $this->db->get();
        $tabungan = $query->row_array();

        $saldo = $tabungan['jml_setor'] - $tabungan['jml_tarik'];

        $data = array(
            'id_siswa' => $ids,
            'subjek' => $subjek,
            'keterangan' => $ket,
            'status' => '0',
            'date_created' => time(),
            'saldo' => $saldo,
            'petugas' => 'Tidak tersedia',
            'nominal' => $nominal,
            'catatan' => '-'
        );

        $save = $this->m_siswa->tambah_pengajuan($data, 'tb_pengajuan');

        if (!$save) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Pengajuan telah di kirim!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('Pengajuan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Pengajuan gagal dikirim!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('Pengajuan');
        }
    }

    public function acc($idp)
    {
        $usr['admin'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $petugas = $usr['admin']['nama'];
        $check = '1';
        $catatan = htmlspecialchars($this->input->post('catatan'));
        $pengajuan = array(
            'status' => $check,
            'catatan' => $catatan,
            'petugas' => $petugas
        );

        $nominal = $this->input->post('nominal');
        $ids = $this->input->post('id_siswa');
        $keterangan = $this->input->post('keterangan');

        $data = array(
            'id_siswa'      => $ids,
            'tanggal'       => date('Y-m-d'),
            'penarikan'     => $nominal,
            'petugas'       => $petugas,
            'keterangan'    => $keterangan
        );

        $this->db->select('SUM(setoran) as jml_setor, SUM(penarikan) as jml_tarik');
        $this->db->from('tb_tabungan');
        $this->db->where('id_siswa', $ids);
        $query = $this->db->get();
        $saldo = $query->row_array();

        $saldo_now = $saldo['jml_setor'] - $saldo['jml_tarik'];

        if ($nominal > $saldo_now) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show font-weight-bold" role="alert">
                GAGAL! Penarikan Tidak boleh melibihi saldo saat ini!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('Pengajuan');
        } else {
            $this->m_transaksi->tarik_tunai($data, 'tb_tabungan');

            $this->db->set($pengajuan);
            $this->db->where('id_pengajuan', $idp);
            $this->db->update('tb_pengajuan');

            $this->session->set_flashdata('message', '<div class="alert alert-success mess" role="alert">
                    Pengajuan Berhasil Direspon!
                    </div>');

            redirect('Pengajuan');
        }
    }
    public function reject($idp)
    {
        $usr['admin'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $petugas = $usr['admin']['nama'];
        $catatan = htmlspecialchars($this->input->post('catatan'));
        $check = '2';
        $data = array(
            'status' => $check,
            'catatan' => $catatan,
            'petugas' => $petugas
        );
        $this->db->set($data);
        $this->db->where('id_pengajuan', $idp);
        $this->db->update('tb_pengajuan');

        redirect('Pengajuan');
    }

    public function resend($idp)
    {
        $subjek = htmlspecialchars($this->input->post('subjek'));
        $ket = htmlspecialchars($this->input->post('keterangan'));
        $nominal = reset_rupiah($this->input->post('penarikan'));
        $ids = $this->session->userdata('id_siswa');

        $data = array(
            'id_siswa' => $ids,
            'subjek' => $subjek,
            'keterangan' => $ket,
            'status' => '0',
            'date_created' => time(),
            'petugas' => 'Tidak tersedia',
            'nominal' => $nominal,
            'catatan' => '-'
        );
        $this->db->set($data);
        $this->db->where('id_pengajuan', $idp);
        $this->db->update('tb_pengajuan');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Pengajuan berhasil dikirim!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('Detail_p/index/' .  encrypt_url($idp));
    }
}
