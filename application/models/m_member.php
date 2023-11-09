<?php

class M_member extends CI_Model
{

    public function tampil_detail($id)
    {
        $this->db->select('
            tb_tabungan.id_tabungan,
            tb_tabungan.id_siswa,
            tb_tabungan.tanggal,
            sum(tb_tabungan.setoran) as jml_setoran,
            sum(tb_tabungan.penarikan) as jml_penarikan,
            tb_tabungan.petugas,
            tb_tabungan.keterangan,

            tb_siswa.id_siswa AS idsiswa,
            tb_siswa.id_jurusan,
            tb_siswa.nama,
            tb_siswa.id_kelas,
            tb_siswa.jenis_kelamin,
            tb_siswa.alamat,
            tb_siswa.no_hp,
            tb_siswa.image,

            tb_kelas.id,
            tb_kelas.kelas
            ');
        $this->db->from('tb_tabungan');
        $this->db->join('tb_siswa', 'tb_tabungan.id_siswa = tb_siswa.id_siswa');
        $this->db->join('tb_kelas', 'tb_kelas.id = tb_siswa.id_kelas');
        $this->db->where("tb_siswa.id_siswa ='$id'");

        $query = $this->db->get();
        return $query->result();
    }

    public function hitungSaldo()
    {
        $this->db->select('SUM(setoran) as total_setoran');
        $this->db->select('SUM(penarikan) as total_penarikan');
        $this->db->from('tb_tabungan');
        $this->db->where('id_siswa', $this->session->userdata('id_siswa'));
        return $this->db->get()->row_array();
    }

    public function transaksiBulanan()
    {
        $tanggal = date('Y-m-d');
        $id = $this->session->userdata('id_siswa');
        $this->db->select(
            "* FROM tb_tabungan WHERE MONTH(tanggal)=MONTH(NOW()) AND id_siswa='$id' ORDER BY id_tabungan DESC;"
        );
        return $this->db->get()->Result();
    }

    public function setoranHarian()
    {
        $tgl = date('Y-m-d');
        $ids = $this->session->userdata('id_siswa');

        $where = array(
            'tanggal' => $tgl,
            'id_siswa' => $ids
        );

        $this->db->select('SUM(setoran) as total_setoran');
        $this->db->where($where);
        $this->db->from('tb_tabungan');
        return $this->db->get()->row_array();
    }

    public function penarikanHarian()
    {
        $tgl = date('Y-m-d');
        $ids = $this->session->userdata('id_siswa');

        $where = array(
            'tanggal' => $tgl,
            'id_siswa' => $ids
        );

        $this->db->select('SUM(penarikan) as total_penarikan');
        $this->db->where($where);
        $this->db->from('tb_tabungan');
        return $this->db->get()->row_array();
    }
}
