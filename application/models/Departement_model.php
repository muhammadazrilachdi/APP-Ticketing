<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Departement_model extends CI_Model
{
    public function departement($departement_id)
    {
        $queryDepartement = "SELECT `departement`.`departement_id`
                       FROM `departement`
                  LEFT JOIN `user` 
                         ON `departement`.`departement_id` = `user`.`departement_id`
                      WHERE `user`.`departement_id` = 1
                   ORDER BY `user`.`departement_id` ASC
                   ";
        $departement_id = $this->db->query($queryDepartement)->result_array();
    }
    public function get_all_departement()
    {
        $this->db->select('departement_id, name');
        $this->db->from('departement');
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function insert($data)
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['created_by'] = $user['user_id'];
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('departement', $data);
    }
    public function update($update_data)
    {
        $this->db->where('departement_id', $update_data['departement_id']);
        return $this->db->update('departement', $update_data);
    }
    public function delete($departement_id)
    {
        $this->db->where('departement_id', $departement_id);
        return $this->db->update('departement', array('is_deleted' => 1));
    }
}
