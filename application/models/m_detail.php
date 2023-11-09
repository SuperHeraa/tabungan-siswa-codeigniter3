<?php

class M_detail extends CI_Model
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
            tb_siswa.email,
            tb_siswa.id_kelas,
            tb_siswa.jenis_kelamin,
            tb_siswa.alamat,
            tb_siswa.no_hp,
            tb_siswa.image,
            tb_siswa.date_created,

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
    public function tampil_report($id)
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
            tb_siswa.email,
            tb_siswa.id_kelas,
            tb_siswa.jenis_kelamin,
            tb_siswa.alamat,
            tb_siswa.no_hp,
            tb_siswa.image,
            tb_siswa.date_created,

            tb_kelas.id,
            tb_kelas.kelas,
            tb_kelas.walas,

            tb_jurusan.id_jurusan,
            tb_jurusan.jurusan
            ');
        $this->db->from('tb_tabungan');
        $this->db->join('tb_siswa', 'tb_tabungan.id_siswa = tb_siswa.id_siswa');
        $this->db->join('tb_kelas', 'tb_kelas.id = tb_siswa.id_kelas');
        $this->db->join('tb_jurusan', 'tb_jurusan.id_jurusan = tb_siswa.id_jurusan');
        $this->db->where("tb_siswa.id_siswa ='$id'");

        $query = $this->db->get();
        return $query->row_array();
    }

    public function tampil_riwayat($id)
    {
        $this->db->where("id_siswa = '$id'");
        $query = $this->db->get('tb_tabungan');
        return $query->result();
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function hapus_detrans($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function tampil_jurusan($id)
    {
        $this->db->select('tb_siswa.id_siswa, tb_jurusan.jurusan');
        $this->db->from('tb_siswa');
        $this->db->join('tb_jurusan', 'tb_jurusan.id_jurusan = tb_siswa.id_jurusan');
        $this->db->where("id_siswa = '$id'");
        $query = $this->db->get();
        return $query->row_array();
    }
}
