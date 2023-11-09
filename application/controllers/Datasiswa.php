<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datasiswa extends CI_Controller
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
        $data['title'] = 'Data Siswa';
        $data['siswa'] = $this->m_siswa->tampil_data();
        $data['kelas'] = $this->m_kelas->tampil_kelas();
        $data['jurusan'] = $this->m_siswa->tampil_jurusan()->result();
        $data['role'] = $this->db->get_where('tb_role', ['id' => 2])->row_array();
        $data['id_member'] = $this->m_siswa->CreateCode();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/dataSiswa', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_siswa()
    {
        $nama = htmlspecialchars($this->input->post('nama'));
        $email = $this->input->post('email');
        $kelas = $this->input->post('kelas');
        $jk = $this->input->post('jenis_kelamin');
        $jurusan = $this->input->post('jurusan');
        $alamat = htmlspecialchars($this->input->post('alamat'));
        $nohp = $this->input->post('nohp');
        $image = 'default.png';
        $password = password_hash(123456, PASSWORD_DEFAULT);
        $role = $this->input->post('role');
        $id_member = $this->input->post('id_member');

        $data = array(
            'id_jurusan'   => $jurusan,
            'id_kelas'     => $kelas,
            'id_member'     => $id_member,
            'nama'      => $nama,
            'email'      => $email,
            'jenis_kelamin' => $jk,
            'alamat'    => $alamat,
            'no_hp'     => $nohp,
            'password'  => $password,
            'image'     => $image,
            'role_id'   => $role,
            'date_created' => time()

        );

        $this->m_siswa->tambah_siswa($data, 'tb_siswa');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data baru berhasil ditambahkan!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('Datasiswa');
    }

    public function hapus($id)
    {
        $query = $this->db->select("tb_tabungan.id_tabungan, tb_tabungan.id_siswa, SUM(tb_tabungan.setoran) as jst, SUM(tb_tabungan.penarikan) as jpn FROM tb_tabungan WHERE id_siswa = '$id' ")->get()->row_array();
        // $transaksi = $this->db->select("SUM(tb_tabungan.setoran) as jst, SUM(tb_tabungan.penarikan) as jpn FROM tb_tabungan WHERE id_siswa ='$id'")->get()->row_array();
        $saldo = $query['jst'] - $query['jpn'];



        if ($id == $query['id_siswa'] && $saldo != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger mess" role="alert">
        GAGAL !! Siswa ini memiliki tabungan!
        </div>');
            redirect('Datasiswa');
        } elseif ($id != $query['id_siswa']) {
            $this->db->delete('tb_siswa', ['id_siswa' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success mess" role="alert">
            Data berhasil dihapus!
            </div>');
            redirect('Datasiswa');
        } elseif ($id == $query['id_siswa'] && $saldo == 0) {
            $sql = "DELETE tb_siswa, tb_tabungan FROM tb_siswa JOIN tb_tabungan ON tb_siswa.id_siswa = tb_tabungan.id_siswa WHERE tb_siswa.id_siswa = '$id'";
            $del = $this->db->query($sql);
            $data_pengajuan = $this->db->get_where('tb_pengajuan', ['id_siswa' => $id])->row_array();
            if ($del) {

                if ($data_pengajuan) {
                    $this->db->delete('tb_pengajuan', ['id_siswa' => $id]);
                }

                //$this->m_siswa->hapus_siswa($where, 'tb_siswa');
                $this->session->set_flashdata('message', '<div class="alert alert-success mess" role="alert">
            Data berhasil dihapus!
            </div>');
                redirect('Datasiswa');
            }
        }
    }

    public function edit($id)
    {
        $id = $this->input->post('id_siswa');
        $id_jrs = $this->input->post('jurusan');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $kelas = $this->input->post('kelas');
        $jk = $this->input->post('jenis_kelamin');
        $alamat = $this->input->post('alamat');
        $nohp = $this->input->post('nohp');


        $data = array(
            'id_jurusan'    => $id_jrs,
            'id_kelas'      => $kelas,
            'nama'          => $nama,
            'email'          => $email,
            'jenis_kelamin' => $jk,
            'alamat'        => $alamat,
            'no_hp'         => $nohp
        );

        $where = array(
            'id_siswa' => $id
        );

        $this->m_siswa->update_data($where, $data, 'tb_siswa');
        $this->session->set_flashdata('message', '<div class="alert alert-success mess" role="alert">
        Data berhasil di ubah!
        </div>');
        redirect('Datasiswa');
    }

    public function print()
    {
        $data['siswa'] = $this->m_siswa->tampil_data('tb_siswa');
        $this->load->view('admin/print_siswa', $data);
    }
}
