<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request_model extends CI_Model
{
    public function get_all_request()
    {
        $this->db
            ->select([
                'status.name as status_name',
                'category.name as category_name',
                'priority.name as priority_name',
                'user.name as user_name',
                'request.*'
            ])
            ->join('priority', 'priority.priority_id = request.priority_id', 'LEFT')
            ->join('status', 'status.status_id = request.status_id', 'LEFT')
            ->join('category', 'category.category_id = request.category_id', 'LEFT')
            ->join('user', 'user.user_id = request.user_id_request', 'LEFT')
            ->from('request');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_request_by_user($user_id)
    {
        $this->db->where('user_id_request', $user_id);
        $query = $this->db->get('request');
        return $query->result_array();
    }
    public function get_user_id_by_email($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('user');
        $user = $query->row();
        return $user->user_id;
    }
    public function get_transaksi_by_status($status)
    {
        $this->db
            ->select([
                'status.name as status_name',
                'category.name as category_name',
                'priority.name as priority_name',
                'user.name as user_name',
                'request.*'
            ])
            ->join('priority', 'priority.priority_id = request.priority_id', 'LEFT')
            ->join('status', 'status.status_id = request.status_id', 'LEFT')
            ->join('category', 'category.category_id = request.category_id', 'LEFT')
            ->join('user', 'user.user_id = request.user_id_request', 'LEFT')
            ->from('request');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function insert($data)
    {
        $this->db->insert('request', $data);
        return $this->db->insert_id();
    }
    public function insert_request($data)
    {
        $this->db->insert('request', $data);
        return $this->db->insert_id();
    }
    public function update($request_id, $update_data)
    {
        $this->db->where('request_id', $request_id);
        $this->db->update('request', $update_data);
        return $this->db->affected_rows() > 0;
    }
    public function delete($request_id)
    {
        $this->db->where('request_id', $request_id);
        $this->db->delete('request');
    }
}
