<?php

class M_transaksi extends CI_Model
{
    public function setoran($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function tampil_siswa()
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
            tb_siswa.id_kelas
            ');
        $this->db->from('tb_tabungan');
        $this->db->join('tb_siswa', 'tb_tabungan.id_siswa = tb_siswa.id_siswa');
        $this->db->group_by('tb_siswa.id_siswa');

        $query = $this->db->get();
        return $query->result();
    }

    public function tarik_tunai($data, $table)
    {
        $this->db->insert($table, $data);
    }
}
