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
                         `category_pic`.`user_id` AS `pic`,
                          GROUP_CONCAT(user_pic.name) AS `pic_name`
                    FROM `request`
               LEFT JOIN `status` ON `request`.`status_id` = `status`.`status_id`
               LEFT JOIN `category` ON `request`.`category_id` = `category`.`category_id`
               LEFT JOIN `priority` ON `request`.`priority_id` = `priority`.`priority_id`
               LEFT JOIN `user` ON `request`.`user_id_request` = `user`.`user_id`
               LEFT JOIN `category_pic` ON `category`.`category_id` = `category_pic`.`category_id`
               LEFT JOIN `user` AS user_pic ON user_pic.user_id = category_pic.user_id
                   WHERE `request`.`no_ticket` = '$no_ticket' AND category_pic.is_active = 1 GROUP BY `request`.`request_id`";
        $ticket = $this->db->query($query)->row_array();
        return $ticket;
    }
}
