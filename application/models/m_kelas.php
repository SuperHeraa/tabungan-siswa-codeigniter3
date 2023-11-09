<?php

class M_kelas extends CI_Model
{

    public function tampil_kelas()
    {

        return $this->db->get('tb_kelas')->result();
    }


    public function input_kelas($data, $table)
    {
        $this->db->insert($table, $data);
    }
    public function update_kelas($data, $where, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function hapus_kelas($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function hapus_walas($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
