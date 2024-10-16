<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user_model extends CI_Model
{
    public function get_user_request()
    {
        $this->db
            ->select([
                'user.name as user_name',
                'request.*'
            ])
            ->join('user', 'user.user_id = request.user_id_request', 'LEFT')
            ->from('request');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_all_user()
    {
        $this->db->select('user_id, name');
        $this->db->from('user');
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function insert($data)
    {
        return $this->db->insert('user', $data);
    }

    public function update($nik, $data)
    {
        $this->db->where('nik', $nik);
        return $this->db->update('user', $data);
    }

    public function delete($nik)
    {
        $this->db->where('nik', $nik);
        $this->db->update('user', array('is_deleted' => 1));
    }
}
