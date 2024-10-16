<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{
    public function category($category_id)
    {
        $queryCategory = "SELECT `category`.`category_id`
                       FROM `category`
                  LEFT JOIN `request` 
                         ON `category`.`category_id` = `request`.`category_id`
                      WHERE `request`.`category_id` = 1
                   ORDER BY `request`.`category_id` ASC
                   ";
        $category_id = $this->db->query($queryCategory)->result_array();
    }
    public function get_category_by_id($category_id)
    {
        $this->db->where('category_id', $category_id);
        return $this->db->get('category')->row();
    }
    public function get_all_category()
    {
        $this->db->select('category_id, name');
        $this->db->from('category');
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function insert($data)
    {
        return $this->db->insert('category', $data);
    }
    public function update($update_data)
    {
        $this->db->where('category_id', $update_data['category_id']);
        return $this->db->update('category', $update_data);
    }
    public function delete($category_id)
    {
        $this->db->where('category_id', $category_id);
        return $this->db->update('category', array('is_deleted' => 1));
    }
}
