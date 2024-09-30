<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function login()
    {
        if ($this->session->userdata('email')) {
            redirect('user/dashboard');
        } else {
            $this->load->view('auth/login');
        }
    }

    public function process_login()
    {
        $email = trim($this->input->post('email'));
        $password = trim($this->input->post('password'));

        if (empty($email) || empty($password)) {
            $this->session->set_flashdata('error', 'Email dan password harus diisi.');
            redirect('auth/login');
            return;
        }

        $user = $this->User_model->validate_login($email, $password);

        if ($user) {
            $this->session->set_userdata('user_id', $user->user_id);
            $this->session->set_userdata('email', $user->email);

            if ($user->departement_id == 1) {
                redirect('admin/transaksi');
            } else {
                redirect('user/dashboard');
            }
        } else {
            $this->session->set_flashdata('error', 'Email atau password salah.');
            redirect('auth/login');
        }
    }



    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
