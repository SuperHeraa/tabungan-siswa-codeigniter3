<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sekolah extends CI_Controller
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
        $data['title'] = 'Data Sekolah';
        $data['sekolah'] = $this->m_sekolah->tampil_data()->result();
        $data['pengelola'] = $this->db->get('tb_pengelola')->row_array();
        $data['logo'] = $this->db->get('tb_sekolah')->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/sekolah', $data);
        $this->load->view('templates/footer');
    }

    public function edit_pengelola()
    {
        $id = $this->input->post('id_pengelola');
        $nama = $this->input->post('nama_pengelola');

        $data = array(
            'nama_pengelola'   => $nama

        );

        $where = array(
            'id'    => $id
        );

        $this->m_sekolah->update_pengelola($data, $where, 'tb_pengelola');
        $this->session->set_flashdata('message', '<div class="alert alert-success mess" role="alert">
        Data berhasil di ubah!
        </div>');
        redirect('Sekolah');
    }

    public function edit_identitas()
    {
        $id = $this->input->post('id');
        $jenjang = $this->input->post('jenjang');
        $nama = $this->input->post('nama_sekolah');
        $alamat = $this->input->post('alamat');
        $alamat2 = $this->input->post('alamat2');
        $kota = $this->input->post('kota');
        $kontak = $this->input->post('kontak');
        $situs = $this->input->post('situs');
        $jmlsiswa = $this->input->post('jumlah_siswa');

        $data = array(
            'jenjang'           => $jenjang,
            'nama_sekolah'      => $nama,
            'alamat_sekolah'    => $alamat,
            'alamat_2'          => $alamat2,
            'kota'              => $kota,
            'kontak_sekolah'    => $kontak,
            'situs_sekolah'     => $situs,
            'jumlah_siswa'      => $jmlsiswa
        );

        $where = array(
            'id'    => $id
        );

        $this->m_sekolah->update_identitas($data, $where, 'tb_sekolah');
        $this->session->set_flashdata('message', '<div class="alert alert-success mess" role="alert">
        Data berhasil di ubah!
        </div>');
        redirect('Sekolah');
    }
    public function logo()
    {
        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {
            $config['upload_path'] = './assets/img/';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $data['sekolah'] = $this->db->get('tb_sekolah')->row_array();

                $old_image = $data['sekolah']['logo'];
                if ($old_image != 'default.png') {
                    unlink(FCPATH . 'assets/img/' . $old_image);
                }

                $new_image = $this->upload->data('file_name');
                $this->db->set('logo', $new_image);
                $this->db->where('id', $data['sekolah']['id']);
                $this->db->update('tb_sekolah');

                $this->session->set_flashdata('message-logo', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Logo berhasil di ganti!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('Sekolah');
            } else {
                $this->session->set_flashdata('message-logo', '<div class="alert alert-danger alert-dismissible fade show font-weight-bold" role="alert">
                GAGAL! Periksa Ketentuan Upload!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('Sekolah');
            }
        } else {
            $this->session->set_flashdata('message-logo', '<div class="alert alert-danger alert-dismissible fade show font-weight-bold" role="alert">
                Tidak ada logo yang dipilih!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('Sekolah');
        }
    }
}
