<?php

class M_tabungan extends CI_Model
{

    public function tampil_tabungan()
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
            tb_siswa.nama,
            tb_siswa.id_member,
            tb_siswa.id_kelas,
            tb_siswa.id_jurusan,

            tb_kelas.id,
            tb_kelas.kelas
            ');
        $this->db->from('tb_tabungan');
        $this->db->join('tb_siswa', 'tb_tabungan.id_siswa = tb_siswa.id_siswa');
        $this->db->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id');
        $this->db->group_by('tb_siswa.id_siswa');

        $query = $this->db->get();
        return $query->result();
    }

    public function remove_selected($checked_id)
    {
        $this->db->where_in('id_siswa', $checked_id);
        return $this->db->delete('tb_tabungan');
    }
    public function remove_selected_siswa($checked_id)
    {
        $this->db->where_in('id_siswa', $checked_id);
        return $this->db->delete('tb_siswa');
    }

    public function cetakTabunganPerkelas($where)
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
        tb_siswa.nama,
        tb_siswa.id_kelas,
        tb_siswa.id_jurusan,

        tb_kelas.id,
        tb_kelas.kelas
        ');
        $this->db->from('tb_tabungan');
        $this->db->join('tb_siswa', 'tb_tabungan.id_siswa = tb_siswa.id_siswa');
        $this->db->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id');
        $this->db->where($where);
        $this->db->group_by('tb_siswa.id_siswa');

        $query = $this->db->get();
        return $query->result();
    }

    public function jml_tbperkelas($idk, $idj)
    {
        $this->db->select("
        tb_tabungan.id_tabungan,
        tb_tabungan.id_siswa,
        tb_tabungan.tanggal,
        sum(tb_tabungan.setoran) as jml_setoran,
        sum(tb_tabungan.penarikan) as jml_penarikan,
        tb_tabungan.petugas,
        tb_tabungan.keterangan,

        tb_siswa.id_siswa,
        tb_siswa.nama,
        tb_siswa.id_kelas,
        tb_siswa.id_jurusan

        FROM tb_tabungan JOIN tb_siswa ON tb_tabungan.id_siswa=tb_siswa.id_siswa WHERE tb_siswa.id_kelas='$idk' AND tb_siswa.id_jurusan='$idj'
        ");

        $query = $this->db->get();
        return $query->row_array();
    }

    public function cetakTabunganPeriodik($tgl_awal, $tgl_akhir)
    {
        $this->db->select(
            "
            tb_tabungan.id_tabungan,
            tb_tabungan.id_siswa,
            tb_tabungan.tanggal,
            SUM(tb_tabungan.setoran) as jml_setoran,
            SUM(tb_tabungan.penarikan) as jml_penarikan,
            tb_tabungan.petugas,
            tb_tabungan.keterangan,
            tb_siswa.id_siswa,
            tb_siswa.nama,
            tb_siswa.id_kelas,
            tb_siswa.id_jurusan,
            tb_kelas.id,
            tb_kelas.kelas FROM tb_tabungan JOIN tb_siswa ON tb_tabungan.id_siswa=tb_siswa.id_siswa JOIN tb_kelas ON tb_siswa.id_kelas=tb_kelas.id WHERE tb_tabungan.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' GROUP BY tb_tabungan.id_siswa
            "
        );
        $query = $this->db->get();
        return $query->result();
    }

    public function jml_periodik($tgl_awal, $tgl_akhir)
    {
        $this->db->select("
        tb_tabungan.id_tabungan,
        tb_tabungan.tanggal,
        SUM(tb_tabungan.setoran) as jml_setoran,
        SUM(tb_tabungan.penarikan) as jml_penarikan

        FROM tb_tabungan WHERE tb_tabungan.tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY tb_tabungan.id_tabungan
        ");

        $query = $this->db->get();
        return $query->row_array();
    }
}
