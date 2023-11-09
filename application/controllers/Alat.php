<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Alat extends CI_Controller
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
        $data['title'] = 'Menu Alat';
        $data['kelas'] = $this->m_kelas->tampil_kelas();
        $data['jurusan'] = $this->m_siswa->tampil_jurusan()->result();
        $data['data_tabungan'] = $this->m_tabungan->tampil_tabungan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/alat', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_kelas()
    {
        $kelas = $this->input->post('kelas');
        $walas = $this->input->post('walas');
        $data = array(
            'kelas' => $kelas,
            'walas' => $walas
        );

        $this->m_kelas->input_kelas($data, 'tb_kelas');
        $this->session->set_flashdata('message', '<div class="alert alert-success mess" role="alert">
        Kelas Baru Berhasil Ditambahkan!
        </div>');
        redirect('Alat');
    }

    public function edit_kelas($id)
    {
        $idkelas = $this->input->post('kelas');
        $walas = $this->input->post('walikelas');
        $data = array(
            'kelas' => $idkelas,
            'walas' => $walas
        );
        $where = array(
            'id' => $id
        );

        $this->m_kelas->update_kelas($data, $where, 'tb_kelas');
        $this->session->set_flashdata('message', '<div class="alert alert-success mess" role="alert">
        Kelas Berhasil Di Update!
        </div>');
        redirect('Alat');
    }

    public function hapus_kelas($id)
    {

        $query = $this->db->get_where('tb_siswa', ['id_kelas' => $id])->row_array();

        if ($id == $query['id_kelas']) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger mess" role="alert">
            GAGAL !! Kelas ini dipakai di data siswa!
            </div>');
            redirect('Alat');
        } else {
            $where = array('id' => $id);
            $this->m_kelas->hapus_kelas($where, 'tb_kelas');
            $this->session->set_flashdata('message', '<div class="alert alert-success mess" role="alert">
        Kelas Berhasil Di Hapus!
        </div>');
            redirect('Alat');
        }
    }

    public function tambah_jurusan()
    {
        $idjurusan = $this->input->post('id_jurusan');
        $jurusan = $this->input->post('jurusan');
        $data = array(
            'id_jurusan' => $idjurusan,
            'jurusan'    => $jurusan
        );

        $this->m_siswa->input_jurusan($data, 'tb_jurusan');
        $this->session->set_flashdata('message_jrs', '<div class="alert alert-success mess" role="alert">
        Jurusan Baru Berhasil Ditambahkan!
        </div>');
        redirect('Alat');
    }

    public function edit_jurusan($id)
    {
        $idjurusan = $this->input->post('id_jurusan');
        $jurusan = $this->input->post('jurusan');

        $data = array(
            'id_jurusan' => $idjurusan,
            'jurusan'    => $jurusan
        );
        $where = array('id_jurusan' => $id);

        $this->m_siswa->update_jurusan($data, $where, 'tb_jurusan');
        $this->db->set('id_jurusan', $data['id_jurusan']);
        $this->db->where($where);
        $this->db->update('tb_siswa');
        $this->session->set_flashdata('message_jrs', '<div class="alert alert-success mess" role="alert">
        Jurusan Berhasil Diubah!
        </div>');
        redirect('Alat');
    }

    public function hapus_jurusan($id)
    {
        $query = $this->db->get_where('tb_siswa', ['id_jurusan' => $id])->row_array();

        if ($id == $query['id_jurusan']) {
            $this->session->set_flashdata('message_jrs', '<div class="alert alert-danger mess" role="alert">
            GAGAL !! Terdapat siswa yang masih terdaftar di jurusan ini!
            </div>');
            redirect('Alat');
        } else {
            $where = array('id_jurusan' => $id);
            $this->m_siswa->hapus_jurusan($where, 'tb_jurusan');
            $this->session->set_flashdata('message_jrs', '<div class="alert alert-success mess" role="alert">
        Jurusan Berhasil Di Hapus!
        </div>');
            redirect('Alat');
        }
    }

    public function remove()
    {
        if (isset($_POST['hapusSemua'])) {
            if (!empty($this->input->post('isi_checkbox'))) {
                $checked = $this->input->post('isi_checkbox');
                $checked_id = [];
                foreach ($checked as $row) {
                    array_push($checked_id, $row);
                }

                $this->m_tabungan->remove_selected($checked_id);
                $this->m_tabungan->remove_selected_siswa($checked_id);
                $this->session->set_flashdata('message_mg_tb', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Data Siswa & Tabungan Berhasil Dihapus!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('Alat');
            } else {
                $this->session->set_flashdata('message_mg_tb', '<div class="alert alert-danger mess" role="alert">
                GAGAL ! Tidak ada data yang dipilih!
                </div>');
                redirect('Alat');
            }
        }
    }

    public function backup_db()
    {
        // load  class utilitas database
        $this->load->dbutil();

        // aturan ketika file terdownload
        $aturan = array(
            'format' => 'zip',
            'filename'  => 'db_tbsmkcm'
        );

        $backup = &$this->dbutil->backup($aturan);

        // memberikan tanggal backup
        $nama_database = 'Tabsis_Backup_' . date("d-m-Y") . '.zip';
        $simpan = '/backup' . $nama_database;

        $this->load->helper('file');
        write_file($simpan, $backup);

        $this->load->helper('download');
        force_download($nama_database, $backup);

        $this->session->set_flashdata('message_mg_tb', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Database berhasil di backup!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
        redirect('Alat');
    }

    public function reset_apl()
    {
        $data = 'Tidak ada data';

        $this->db->set('jenjang', $data);
        $this->db->set('nama_sekolah', $data);
        $this->db->set('alamat_sekolah', $data);
        $this->db->set('alamat_2', $data);
        $this->db->set('kota', $data);
        $this->db->set('kontak_sekolah', $data);
        $this->db->set('situs_sekolah', $data);
        $this->db->set('jumlah_siswa', 1);

        $old_image['img'] = $this->db->get('tb_sekolah')->row_array();
        $hapus_logo = $old_image['img']['logo'];
        unlink(FCPATH . 'assets/img/' . $hapus_logo);
        $logo = 'default.png';
        $this->db->set('logo', $logo);
        $this->db->update('tb_sekolah');

        $this->db->set('nama_pengelola', $data);
        $this->db->update('tb_pengelola');

        $this->db->truncate('tb_kelas');
        $this->db->empty_table('tb_jurusan');
        $this->db->truncate('tb_siswa');
        $this->db->truncate('tb_tabungan');
        $this->db->truncate('tb_pengajuan');
        $this->db->truncate('tb_user');

        $pw = 'admin';
        $password = password_hash($pw, PASSWORD_DEFAULT);
        $new_user = array(
            'email' => 'admin@tabsis.com',
            'nama' => 'administrator',
            'role_id' => 1,
            'image' => 'default.png',
            'password' => $password,
            'date_created' => time()
        );

        $this->m_user->add_pengguna($new_user, 'tb_user');

        $this->session->set_flashdata('message_reset', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Aplikasi Berhasil Di reset!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('Auth/logout');
    }
}
