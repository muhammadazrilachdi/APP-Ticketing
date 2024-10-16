<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request_model extends CI_Model
{
    public function get_all_request()
    {
        $queryRequest = "SELECT `request`.*,
                           `status`.`name` AS `status_name`,
                           `category`.`name` AS `category_name`,
                           `priority`.`name` AS `priority_name`,
                           `user`.`name` AS `user_name`
                           FROM `request`
                      LEFT JOIN `status` 
                             ON `request`.`status_id` = `status`.`status_id`
                      LEFT JOIN `category` 
                             ON `request`.`category_id` = `category`.`category_id`
                      LEFT JOIN `priority` 
                             ON `request`.`priority_id` = `priority`.`priority_id`
                      LEFT JOIN `user` 
                             ON `request`.`user_id_request` = `user`.`user_id`
                       ORDER BY `request`.`request_id` ASC
                       ";
        $request = $this->db->query($queryRequest)->result_array();
        return $request;
    }
    public function get_request_by_user($user_id)
    {
        $queryRequest = "SELECT `request`.*,
                            `status`.`name` AS `status_name`, 
                            `category`.`name` AS `category_name`, 
                            `priority`.`name` AS `priority_name`, 
                            `user`.`name` AS `user_name`
                            FROM `request`
                       LEFT JOIN `status` ON `request`.`status_id` = `status`.`status_id`
                       LEFT JOIN `category` ON `request`.`category_id` = `category`.`category_id`
                       LEFT JOIN `priority` ON `request`.`priority_id` = `priority`.`priority_id`
                       LEFT JOIN `user` ON `request`.`user_id_request` = `user`.`user_id`
                       WHERE `request`.`user_id_request` = $user_id
                       ORDER BY `request`.`request_id` ASC
                       ";
        $request = $this->db->query($queryRequest)->result_array();
        return $request;
    }
    public function get_transaksi_by_status($status)
    {
        $queryStatus = "SELECT request.*
                           FROM request
                           LEFT JOIN status
                           ON request.status_id = status.status_id
                           WHERE request.status_id = $status
                           ORDER BY request.status_id ASC";
        $status = $this->db->query($queryStatus)->result_array();
        return $status;
    }
    public function get_user_id_by_email($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('user');
        $user = $query->row();
        return $user->user_id;
    }
    public function get_last_ticket_number($year)
    {
        $this->db->select('no_ticket');
        $this->db->from('request');
        $this->db->where('YEAR(created_at)', $year);

        $this->db->order_by('no_ticket', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $last_ticket = $query->row()->no_ticket;
            $ticket_year = substr($last_ticket, strpos($last_ticket, '.') + 1, 4);

            if ($ticket_year == $year) {
                $sequence_number = (int) substr($last_ticket, -5);
                return $sequence_number + 1;
            } else {
                return 1;
            }
        } else {
            return 1;
        }
    }
    public function insert($data)
    {
        $this->db->insert('request', $data);
        return $this->db->insert_id();
    }
    public function insert_request($data)
    {
        if (!isset($data['lampiran'])) {
            $data['lampiran'] = null;
        }

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
        return $this->db->delete('request');
    }
    public function get_request_by_id($request_id)
    {
        return $this->db->get_where('request', ['request_id' => $request_id])->row_array();
    }
}
