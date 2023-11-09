<?php

class M_user extends CI_Model
{

    public function add_pengguna($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function edit_user($data, $where, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function hapus_user($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
