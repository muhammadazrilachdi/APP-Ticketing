<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Status_model extends CI_Model
{
    public function status($status_id)
    {
        $queryStatus = "SELECT `status`.`status_id`
                       FROM `status`
                  LEFT JOIN `request` 
                         ON `status`.`status_id` = `request`.`status`
                      WHERE `request`.`status` = 1
                   ORDER BY `request`.`created_at` ASC
                   ";
        $status_id = $this->db->query($queryStatus)->result_array();
    }
    public function get_all_status()
    {
        $this->db->select('status_id, name');
        $this->db->from('status');
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function insert($data)
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['created_by'] = $user['user_id'];
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('status', $data);
    }
    public function update($update_data)
    {
        $this->db->where('status_id', $update_data['status_id']);
        return $this->db->update('status', $update_data);
    }
    public function delete($status_id)
    {
        $this->db->where('status_id', $status_id);
        return $this->db->update('status', array('is_deleted' => 1));
    }
}
