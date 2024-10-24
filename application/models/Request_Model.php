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
                          WHERE `request`.`is_deleted` = 0
                       ORDER BY `request`.`created_at` ASC 
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
                        ORDER BY `request`.`created_at` ASC
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
    public function get_request_category_pic($request_id)
    {
        $queryRequest = "SELECT `request`.`request_id`, `category_pic`.`category_pic_id`, GROUP_CONCAT(user_pic.name) AS `pic_name`
                           FROM `request_category_pic`
                      LEFT JOIN `request`
                             ON `request_category_pic`.`request_id` = `request`.`request_id`
                      LEFT JOIN `category_pic`
                             ON `request_category_pic`.`category_pic_id` = `category_pic`.`category_pic_id`
                      LEFT JOIN `user` AS `user_pic` 
                             ON `user_pic`.`user_id` = `category_pic`.`user_id`
                          WHERE `request_category_pic`.`request_id` = $request_id
                   ";
        $request_id = $this->db->query($queryRequest)->result_array();
        return $request_id;
    }
    public function get_last_ticket_number($year)
    {
        $this->db->select('no_ticket');
        $this->db->from('request');
        $this->db->where('YEAR(created_at)', $year);

        $this->db->order_by('SUBSTR(no_ticket, -5, 5) DESC');
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
    public function get_user_id_by_email($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('user');
        $user = $query->row();
        return $user->user_id;
    }
    public function insert($data)
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['created_by'] = $user['user_id'];
        $data['created_at'] = date('Y-m-d H:i:s');

        return $this->db->insert('request', $data);
    }

    public function insert_request_category_pic($data)
    {
        return $this->db->insert('request_category_pic', $data);
    }

    public function get_last_insert_id()
    {
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
        return $this->db->update('request', array('is_deleted' => 1));
    }
    public function get_request_by_id($request_id)
    {
        return $this->db->get_where('request', ['request_id' => $request_id])->row_array();
    }
}
