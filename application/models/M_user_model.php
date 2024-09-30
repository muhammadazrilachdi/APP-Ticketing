<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user_model extends CI_Model
{
    // Mengambil semua data pengguna
    public function get_all_m_user()
    {
        return $this->db->get('user')->result_array();
    }

    // Menambahkan pengguna baru
    public function insert($data)
    {
        return $this->db->insert('user', $data);
    }

    // Memperbarui data pengguna
    public function update($nik, $data)
    {
        $this->db->where('nik', $nik);
        $this->db->update('user', $data);
        return $this->db->affected_rows() > 0;
    }

    // Menghapus pengguna
    public function delete($nik)
    {
        $this->db->where('nik', $nik); // Menggunakan 'nik' untuk mengidentifikasi pengguna
        return $this->db->delete('user');
    }
}
