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
    public function get_all_departements()
    {
        return $this->db->get('departement')->result_array();
    }
    public function insert($data)
    {
        $this->db->insert('departement', $data);
    }
    public function update($update_data)
    {
        $this->db->where('departement_id', $update_data['departement_id']);
        $this->db->update('departement', $update_data);
    }
    public function delete($departement_id)
    {
        $this->db->where('departement_id', $departement_id);
        $this->db->delete('departement');
    }
}
