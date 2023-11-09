<?php

use LDAP\Result;

class M_dashboard extends CI_Model
{
    public function hitungJumlahSiswa()
    {
        $query = $this->db->get('tb_siswa');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function jml_siswa()
    {
        $query = $this->db->get('tb_sekolah');
        return $query->row_array();
    }

    public function persentaseSiswa()
    {
        $sekolah = $this->db->get('tb_sekolah')->row_array();
        $query = $this->db->get('tb_siswa');
        $jml_siswa = $query->num_rows();
        if ($jml_siswa != null) {
            $psn_siswa = $jml_siswa / $sekolah['jumlah_siswa'] * 100;
            return number_format($psn_siswa);
        }
    }
    public function siswaNabung()
    {
        $query = $this->db->get('tb_siswa');
        $jml_siswa = $query->num_rows();
        return number_format($jml_siswa);
    }
    public function jml_Laki()
    {
        $query = $this->db->get_where('tb_siswa', ['jenis_kelamin' => 'L']);
        $jml_siswa = $query->num_rows();
        return number_format($jml_siswa);
    }
    public function jml_perempuan()
    {
        $query = $this->db->get_where('tb_siswa', ['jenis_kelamin' => 'P']);
        $jml_siswa = $query->num_rows();
        return number_format($jml_siswa);
    }
    public function progresbar_jml_Laki()
    {
        $query = $this->db->get('tb_siswa');
        $jml_siswa = $query->num_rows();
        $query2 = $this->db->get_where('tb_siswa', ['jenis_kelamin' => 'L']);
        $jml_laki = $query2->num_rows();
        if ($jml_laki != null) {
            $progres_laki = $jml_laki / $jml_siswa * 100;
            return number_format($progres_laki);
        }
    }
    public function progresbar_jml_perempuan()
    {
        $query = $this->db->get('tb_siswa');
        $jml_siswa = $query->num_rows();
        $query2 = $this->db->get_where('tb_siswa', ['jenis_kelamin' => 'P']);
        $jml_laki = $query2->num_rows();
        if ($jml_laki != null) {
            $progres_laki = $jml_laki / $jml_siswa * 100;
            return number_format($progres_laki);
        }
    }


    public function totalTabungan()
    {
        $this->db->select('SUM(setoran) as total_setoran');
        $this->db->select('SUM(penarikan) as total_penarikan');
        $this->db->from('tb_tabungan');
        return $this->db->get()->row_array();
    }

    public function pemasukanHarian()
    {
        $tgl = date('Y-m-d');
        $this->db->select('SUM(setoran) as total_setoran');
        $this->db->where('tanggal', $tgl);
        $this->db->from('tb_tabungan');
        return $this->db->get()->row_array();
    }
    public function penarikanHarian()
    {
        $tgl = date('Y-m-d');
        $this->db->select('SUM(penarikan) as total_penarikan');
        $this->db->where('tanggal', $tgl);
        $this->db->from('tb_tabungan');
        return $this->db->get()->row_array();
    }

    public function in_out_perbulan()
    {
        $qy = "SELECT DATE_FORMAT(tanggal, '%M %Y') as monthname,
        SUM(setoran) as jml_setoran, SUM(penarikan) as jml_penarikan from tb_tabungan group by monthname DESC";
        return $this->db->query($qy)->result();
    }

    public function leaderboard()
    {
        $qy = 'SELECT tb_tabungan.id_siswa ,sum(setoran) as jml_setoran, sum(penarikan) as jml_penarikan, tb_siswa.nama, tb_siswa.image FROM tb_tabungan JOIN tb_siswa ON tb_siswa.id_siswa = tb_tabungan.id_siswa GROUP by id_siswa ORDER BY SUM(setoran)-SUM(penarikan) DESC LIMIT 5';
        $x = $this->db->query($qy);
        return $x->result();
    }
    public function transaksiMingguan()
    {
        $tanggal = date('Y-m-d');
        $this->db->select(
            //     'tb_tabungan.setoran, tb_tabungan.penarikan, tb_tabungan.tanggal,
            //     tb_siswa.nama'
            // );
            // $this->db->from('tb_tabungan');
            // $this->db->where('tanggal', $tanggal);
            // $this->db->join('tb_siswa', 'tb_tabungan.id_siswa = tb_siswa.id_siswa');
            // $this->db->order_by('id_tabungan', 'DESC'
            "tb_tabungan.tanggal, tb_tabungan.setoran, tb_tabungan.penarikan, tb_siswa.nama FROM `tb_tabungan` JOIN tb_siswa ON tb_tabungan.id_siswa=tb_siswa.id_siswa WHERE YEARWEEK(tanggal)=YEARWEEK(NOW()) ORDER BY id_tabungan DESC;"

        );
        return $this->db->get()->Result();
    }
}
