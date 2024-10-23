<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pic_model extends CI_Model
{
    public function pic($category_id)
    {
        $queryCategory = "SELECT category_pic.category_pic_id, category.category_id, user.user_id, user.name, user.no_hp, user.email, category_pic.is_active
                           FROM category
                          LEFT JOIN category_pic ON category.category_id = category_pic.category_id
                          LEFT JOIN user ON category_pic.user_id = user.user_id
                              WHERE category_pic.category_id = '$category_id' AND category_pic.is_deleted = 0
                           ";
        $category = $this->db->query($queryCategory)->result_array();
        return $category;
    }
    public function get_category_by_id($category_pic_id)
    {
        $this->db->where('category_pic_id', $category_pic_id);
        return $this->db->get('category_pic')->row();
    }
    public function insert($data)
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['created_by'] = $user['user_id'];
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('category_pic', $data);
    }
    public function update($category_pic_id, $update_data)
    {
        $this->db->where('category_pic_id', $category_pic_id);
        return $this->db->update('category_pic', $update_data);
    }

    public function delete($category_pic_id)
    {
        $this->db->where('category_pic_id', $category_pic_id);
        return $this->db->update('category_pic', array('is_deleted' => 1));
    }
    public function aktifkan_pic($category_pic_id)
    {
        $this->db->where('category_pic_id', $category_pic_id);
        $this->db->update('category_pic', array('is_active' => 1));
    }

    public function nonaktifkan_pic($category_pic_id)
    {
        $this->db->where('category_pic_id', $category_pic_id);
        $this->db->update('category_pic', array('is_active' => 0));
    }
}
