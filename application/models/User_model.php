<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function validate_login($email, $password)
    {
        $hashed_password = md5($password);
        $this->db->where('email', $email);
        $this->db->where('password', $hashed_password);
        $query = $this->db->get('user');


        if ($query->num_rows() > 0) {
            $user = $query->row();

            if (md5($password) === $user->password) {
                return $user;
            }
        }

        return false;
    }

    public function get_user_by_id($userId)
    {
        return $this->db->get_where('user', ['user_id' => $userId])->row();
    }

    public function update_password($userId, $newPassword)
    {
        $hashedPassword = md5($newPassword);

        $data = [
            'password' => $hashedPassword,
        ];

        $this->db->where('user_id', $userId);
        return $this->db->update('user', $data);
    }
}
