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
                   ORDER BY `request`.`status` ASC
                   ";
        $status_id = $this->db->query($queryStatus)->result_array();
    }
    public function get_all_status()
    {
        $this->db->select('status_id, name');
        $this->db->from('status');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_status_name($status_id)
    {
        $this->db->where('status_id', $status_id);
        $query = $this->db->get('status');
        $row = $query->row();
        return $row->name;
    }
    public function insert($data)
    {
        $this->db->insert('status', $data);
    }
    public function update($update_data)
    {
        $this->db->where('status_id', $update_data['status_id']);
        $this->db->update('status', $update_data);
    }
    public function delete($status_id)
    {
        $this->db->where('status_id', $status_id);
        $this->db->delete('status');
    }
}
