<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_p extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        check_admin();
    }

    public function index($idp)
    {
        $decrypt_id = decrypt_url($idp);
        $people = $this->session->userdata('role_id');
        $data['title'] = 'Detail Pengajuan';

        if ($people == '1') {
            echo 'laman admin';
        } elseif ($people == '2') {
            $data['siswa'] = $this->db->get_where('tb_siswa', ['id_siswa' => $this->session->userdata('id_siswa')])->row_array();
            $data['detail_pengajuan'] = $this->m_siswa->detail_pengajuan($decrypt_id);

            $this->load->view('template_member/header', $data);
            $this->load->view('template_member/sidebar', $data);
            $this->load->view('template_member/topbar', $data);
            $this->load->view('member/detail_pm', $data);
            $this->load->view('template_member/footer');
        } else {
            redirect('Auth/block_member');
        }
    }
}
