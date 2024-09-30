<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Request_model');
        $this->load->model('Category_model');
        $this->load->model('Priority_model');
        $this->load->model('Status_model');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['request'] = $this->Request_model->get_all_request();

        $data['category'] = $this->Category_model->get_all_category();
        $data['priority'] = $this->Priority_model->get_all_priority();
        $data['status'] = $this->Status_model->get_all_status();

        $this->load->view('user/dashboard', $data);
    }

    public function contact()
    {
        $this->load->view('user/contact'); // Ganti dengan nama view sesuai jika berbeda
    }

    public function profile()
    {
        $user_email = $this->session->userdata('email');
        $user = $this->db->get_where('user', ['email' => $user_email])->row_array();

        if ($user) {
            $data['title'] = 'Profile User';
            $data['name'] = $user['name'];
            $data['email'] = $user['email'];
            $data['no_hp'] = $user['no_hp'];
            $this->load->view('user/profile', $data);
        } else {
            show_error('User not found', 404);
        }
    }

    public function change_password()
    {
        $this->form_validation->set_rules('oldPassword', 'Password Lama', 'required');
        $this->form_validation->set_rules('newPassword', 'Password Baru', 'required');
        $this->form_validation->set_rules('confirmPassword', 'Konfirmasi Password', 'required|matches[newPassword]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('user/dashboard/profile');
        } else {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            $userId = $this->session->userdata('user_id');

            $user = $this->User_model->get_user_by_id($userId);
            if (md5($oldPassword) !== $user->password) {
                $this->session->set_flashdata('error', 'Password lama tidak sesuai');
                redirect('user/dashboard/profile');
            } else {
                $this->User_model->update_password($userId, $newPassword);
                $this->session->set_flashdata('success', 'Password berhasil diubah!');
                redirect('user/dashboard/profile');
            }
        }
    }
}
