<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Priority_model extends CI_Model
{
    public function priority($priority_id)
    {
        $queryPriority = "SELECT `priority`.`priority_id`
                       FROM `priority`
                  LEFT JOIN `request` 
                         ON `priority`.`priority_id` = `request`.`priority_id`
                      WHERE `request`.`priority_id` = 1
                   ORDER BY `request`.`priority_id` ASC
                   ";
        $priority_id = $this->db->query($queryPriority)->result_array();
    }
    public function get_all_priority()
    {
        $this->db->select('priority_id, name');
        $this->db->from('priority');
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function insert($data)
    {
        return $this->db->insert('priority', $data);
    }
    public function update($update_data)
    {
        $this->db->where('priority_id', $update_data['priority_id']);
        return $this->db->update('priority', $update_data);
    }
    public function delete($priority_id)
    {
        $this->db->where('priority_id', $priority_id);
        return $this->db->update('priority', array('is_deleted' => 1));
    }
}
