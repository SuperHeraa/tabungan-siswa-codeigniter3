<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
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
        $data['title'] = 'Profil';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/profil', $data);
        $this->load->view('templates/footer');
    }
    public function edit()
    {
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');

        $this->db->set('nama', $nama);
        $this->db->where('email', $email);
        $this->db->update('tb_user');

        $this->session->set_flashdata('message', '<div class="alert alert-success mess" role="alert">
        Data berhasil di ubah!
        </div>');
        redirect('Profil');
    }


    public function upload()
    {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $old_image = $data['user']['image'];
        $email = $data['user']['email'];

        // if ($old_image != 'default.png') {
        //     unlink(FCPATH . 'assets/img/' . $old_image);
        // }

        if (isset($_POST["image"])) {

            $tempdir = "assets/img/";

            if ($old_image != 'default.png') {
                unlink(FCPATH . 'assets/img/' . $old_image);
            }

            if (!file_exists($tempdir))
                mkdir($tempdir);

            $data = $_POST["image"];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);

            $imageName = $tempdir . time() . '.png';
            $imageDb = time() . '.png';
            file_put_contents($imageName, $data);

            $this->db->set('image', $imageDb);
            $this->db->where('email', $email);
            $this->db->update('tb_user');

            echo '<img src="' . $imageName . '" class="img-fluid rounded img-thumbnail shadow mb-4" width="200" />';
        }
    }
}
