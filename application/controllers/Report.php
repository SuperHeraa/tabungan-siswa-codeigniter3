<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        check_member();
    }

    public function cetakSiswa()
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $data['title_pdf'] = 'Laporan Data Siswa';
        $data['siswa'] = $this->m_siswa->tampil_data('tb_siswa');
        $data['sekolah'] = $this->db->get('tb_sekolah')->row_array();
        $data['pengelola'] = $this->db->get('tb_pengelola')->row_array();

        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_siswa';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = $this->load->view('admin/report/laporan_siswa', $data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function cetakTabungan()
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');
        $this->load->model('m_dashboard');

        // title dari pdf
        $data['title_pdf'] = 'Laporan Data Tabungan';
        $data['tabungan'] = $this->m_tabungan->tampil_tabungan('tb_tabungan');
        $data['sekolah'] = $this->db->get('tb_sekolah')->row_array();
        $data['pengelola'] = $this->db->get('tb_pengelola')->row_array();
        $data['total_saldo'] = $this->m_dashboard->totalTabungan();

        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_tabungan';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = $this->load->view('admin/report/laporan_tabungan', $data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function cetakDetail($id)
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');


        // title dari pdf
        $data['title_pdf'] = 'Laporan Data Tabungan';
        $data['sekolah'] = $this->db->get('tb_sekolah')->row_array();
        $data['pengelola'] = $this->db->get('tb_pengelola')->row_array();
        $data['detail'] = $this->m_detail->tampil_report($id);
        $data['riwayat'] = $this->m_detail->tampil_riwayat($id);
        $data['kota'] = $this->m_sekolah->tampil_data()->row_array();

        $data['walas'] = $data['detail']['walas'];

        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_detail';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = $this->load->view('admin/report/laporan_detail', $data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function siswaperkelas()
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $data['title_pdf'] = 'Laporan Data Siswa';
        $data['sekolah'] = $this->db->get('tb_sekolah')->row_array();
        $data['pengelola'] = $this->db->get('tb_pengelola')->row_array();

        $idkelas = $_POST['kelas'];
        $id_jurusan = $_POST['jurusan'];
        $where = array(
            'id' => $idkelas,
            'id_jurusan' => $id_jurusan
        );

        $data['siswa'] = $this->m_siswa->cetakSiswaPerkelas($where, 'tb_siswa');
        $data['kelas'] = $this->db->get_where('tb_kelas', ['id' => $idkelas])->row_array();
        $data['jurusan'] = $this->db->get_where('tb_jurusan', ['id_jurusan' => $id_jurusan])->row_array();

        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_siswa_kelas_' . $data['kelas']['kelas'];
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = $this->load->view('admin/report/laporan_swkelas', $data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function tabunganperkelas()
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $data['title_pdf'] = 'Laporan Data Tabungan';
        $data['sekolah'] = $this->db->get('tb_sekolah')->row_array();
        $data['pengelola'] = $this->db->get('tb_pengelola')->row_array();

        $idkelas = $_POST['kelas'];
        $id_jurusan = $_POST['jurusan'];
        $where = array(
            'id' => $idkelas,
            'id_jurusan' => $id_jurusan
        );

        $data['tabungan'] = $this->m_tabungan->cetakTabunganPerkelas($where, 'tb_tabungan');
        $data['kelas'] = $this->db->get_where('tb_kelas', ['id' => $idkelas])->row_array();
        $data['jurusan'] = $this->db->get_where('tb_jurusan', ['id_jurusan' => $id_jurusan])->row_array();
        $data['jml_tb'] = $this->m_tabungan->jml_tbperkelas($idkelas, $id_jurusan);

        $data['kota'] = $this->m_sekolah->tampil_data()->row_array();

        // $id_walas = $data['kelas']['id_walikelas'];
        // $data['walas'] = $this->db->get_where('tb_walikelas', ['id_walikelas' => $id_walas])->row_array();

        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_tabungan_kelas_' . $data['kelas']['kelas'];
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = $this->load->view('admin/report/laporan_tbkelas', $data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function tbperiodik()
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $data['sekolah'] = $this->db->get('tb_sekolah')->row_array();
        $data['pengelola'] = $this->db->get('tb_pengelola')->row_array();

        $tgl_awal = $_POST['tanggal_1'];
        $tgl_akhir = $_POST['tanggal_2'];

        $data['tanggal_1'] = $_POST['tanggal_1'];
        $data['tanggal_2'] = $_POST['tanggal_2'];
        // $where = array(
        //     'tanggal' => $bulan,
        //     'tanggal' => $tahun
        // );

        $data['tabungan'] = $this->m_tabungan->cetakTabunganPeriodik($tgl_awal, $tgl_akhir);
        $data['jml_tb'] = $this->m_tabungan->jml_periodik($tgl_awal, $tgl_akhir);

        $data['kota'] = $this->m_sekolah->tampil_data()->row_array();

        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_tabungan_periodik';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = $this->load->view('admin/report/laporan_tbperiodik', $data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
