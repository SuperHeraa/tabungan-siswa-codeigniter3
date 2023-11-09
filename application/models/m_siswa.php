<?php

class M_siswa extends CI_Model
{

    public function tampil_data()
    {
        // return $this->db->get('tb_siswa');
        $this->db->select(' 
                            tb_siswa.id_siswa,
                            tb_siswa.id_kelas,
                            tb_siswa.id_member,
                            tb_siswa.nama,
                            tb_siswa.email,
                            tb_siswa.id_jurusan,
                            tb_siswa.jenis_kelamin,
                            tb_siswa.alamat,
                            tb_siswa.no_hp,
                            tb_siswa.date_created,
                            
                            tb_kelas.id,
                            tb_kelas.kelas,

                            tb_jurusan.id_jurusan,
                            tb_jurusan.jurusan
                            ');
        $this->db->from('tb_siswa');
        $this->db->join('tb_kelas', 'tb_kelas.id = tb_siswa.id_kelas');
        $this->db->join('tb_jurusan', 'tb_jurusan.id_jurusan = tb_siswa.id_jurusan');
        $this->db->group_by('id_siswa', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function tambah_siswa($data, $table)
    {
        $this->db->insert($table, $data);
    }
    public function hapus_siswa($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function tampil_jurusan()
    {
        return $this->db->get('tb_jurusan');
    }
    public function input_jurusan($data, $table)
    {
        $this->db->insert($table, $data);
    }
    public function update_jurusan($data, $where, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function hapus_jurusan($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function cetakSiswaPerkelas($where)
    {
        $this->db->select(' 
                            tb_siswa.id_siswa,
                            tb_siswa.id_kelas,
                            tb_siswa.nama,
                            tb_siswa.id_jurusan,
                            tb_siswa.jenis_kelamin,
                            tb_siswa.alamat,
                            tb_siswa.no_hp,

                            
                            tb_kelas.id,
                            tb_kelas.kelas
                            ');
        $this->db->from('tb_siswa');
        $this->db->join('tb_kelas', 'tb_kelas.id = tb_siswa.id_kelas');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    public function cetakSiswaPerjurusan($where)
    {
        $this->db->select(' 
                            tb_siswa.id_siswa,
                            tb_siswa.id_kelas,
                            tb_siswa.nama,
                            tb_siswa.id_jurusan,
                            tb_siswa.jenis_kelamin,
                            tb_siswa.alamat,
                            tb_siswa.no_hp,
                            
                            tb_kelas.id,
                            tb_kelas.kelas,

                            ');
        $this->db->from('tb_siswa');
        $this->db->join('tb_kelas', 'tb_kelas.id = tb_siswa.id_kelas');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    public function tambah_pengajuan($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function tampil_pengajuan()
    {
        $ids = $this->session->userdata('id_siswa');
        $this->db->select('*');
        $this->db->from('tb_pengajuan');
        $this->db->where('id_siswa', $ids);
        $this->db->order_by('id_pengajuan', 'DESC');
        return $this->db->get();
    }
    public function tampil_pengajuan_usr()
    {
        $this->db->select('
        tb_pengajuan.id_pengajuan,
        tb_pengajuan.subjek,
        tb_pengajuan.keterangan,
        tb_pengajuan.status,
        tb_pengajuan.petugas,
        tb_pengajuan.date_created,
        tb_pengajuan.saldo,
        tb_pengajuan.nominal,
        tb_pengajuan.catatan,

        tb_siswa.id_siswa,
        tb_siswa.nama,
        tb_siswa.id_kelas,
        tb_siswa.id_jurusan,

        tb_kelas.id,
        tb_kelas.kelas,




        ');
        $this->db->from('tb_pengajuan');
        $this->db->join('tb_siswa', 'tb_siswa.id_siswa=tb_pengajuan.id_siswa');
        $this->db->join('tb_kelas', 'tb_kelas.id=tb_siswa.id_kelas');
        $this->db->group_by('id_pengajuan', 'DESC');
        return $this->db->get();
    }


    public function detail_pengajuan($idp)
    {
        $this->db->select("
        tb_pengajuan.id_pengajuan,
        tb_pengajuan.subjek,
        tb_pengajuan.keterangan,
        tb_pengajuan.status,
        tb_pengajuan.petugas,
        tb_pengajuan.date_created,
        tb_pengajuan.nominal,
        tb_pengajuan.catatan,

        tb_siswa.nama,
        tb_siswa.id_kelas,
        tb_siswa.id_jurusan,

        tb_kelas.id,
        tb_kelas.kelas,

        ");
        $this->db->from('tb_pengajuan');
        $this->db->join('tb_siswa', 'tb_siswa.id_siswa=tb_pengajuan.id_siswa');
        $this->db->join('tb_kelas', 'tb_kelas.id=tb_siswa.id_kelas');
        $this->db->where('id_pengajuan', $idp);
        return $this->db->get()->row_array();
    }

    public function CreateCode()
    {
        $this->db->select('RIGHT(tb_siswa.id_member,5) as id_member', FALSE);
        $this->db->order_by('id_member', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_siswa');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->id_member) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $kodetampil = "TB" . $batas;
        return $kodetampil;
    }

    public function profil_siswa()
    {
        $email = $this->session->userdata('email');
        $this->db->select('
                            tb_siswa.id_siswa,
                            tb_siswa.id_kelas,
                            tb_siswa.nama,
                            tb_siswa.id_jurusan,
                            tb_siswa.jenis_kelamin,
                            tb_siswa.alamat,
                            tb_siswa.no_hp,
                            tb_siswa.email,
                            tb_siswa.image,
                            tb_siswa.date_created,
                            
                            tb_kelas.id,
                            tb_kelas.kelas,

                            tb_jurusan.id_jurusan,
                            tb_jurusan.jurusan
        ');
        $this->db->from('tb_siswa');
        $this->db->join('tb_kelas', 'tb_siswa.id_kelas=tb_kelas.id');
        $this->db->join('tb_jurusan', 'tb_jurusan.id_jurusan = tb_siswa.id_jurusan');
        $this->db->where('email', $email);

        return $this->db->get()->row_array();
    }
}
