<?php

class M_sekolah extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('tb_sekolah');
    }

    public function update_pengelola($data, $where, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function update_walas($data, $where, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function update_identitas($data, $where, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
