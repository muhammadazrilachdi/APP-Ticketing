<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_Model extends CI_Model
{
    public function Detail_Ticket($no_ticket)
    {
        $query = "SELECT `request`.*,
                         `status`.`name` AS `status_name`,
                         `category`.`name` AS `category_name`,
                         `priority`.`name` AS `priority_name`,
                         `user`.`name` AS `user_name`,
                         `user`.`email`,
                         `user`.`no_hp`, 
                          GROUP_CONCAT(user_pic.name) AS `pic_name`
                    FROM `request`
               LEFT JOIN `request_category_pic` ON `request_category_pic`.`request_id` = `request`.`request_id`
               LEFT JOIN `category_pic` ON `category_pic`.`category_pic_id` = `request_category_pic`.`category_pic_id`
               LEFT JOIN `user` AS user_pic ON user_pic.user_id = category_pic.user_id
               LEFT JOIN `status` ON `request`.`status_id` = `status`.`status_id`
               LEFT JOIN `category` ON `request`.`category_id` = `category`.`category_id`
               LEFT JOIN `priority` ON `request`.`priority_id` = `priority`.`priority_id`
               LEFT JOIN `user` ON `request`.`user_id_request` = `user`.`user_id`
                   WHERE `request`.`no_ticket` = '$no_ticket' GROUP BY `request`.`request_id`";
        $ticket = $this->db->query($query)->row_array();
        return $ticket;
    }
}
