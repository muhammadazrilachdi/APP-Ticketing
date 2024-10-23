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
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('user', $data);
    }

    public function update($user_id, $data)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->update('user', $data);
    }

    public function delete($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('user', array('is_deleted' => 1));
    }
}
