<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user_model');
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'User Data';
        $data['user'] = $this->M_user_model->get_all_m_user();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('templates/footer_user');
    }

    public function process_tambah()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required|numeric');
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('no_hp', 'No Handphone', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('departement_id', 'Departement ID', 'required|numeric');
        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {
            $password = $this->input->post('password');
            $hashed_password = md5($password);
            $data = [
                'nik' => $this->input->post('nik'),
                'name' => $this->input->post('name'),
                'no_hp' => $this->input->post('no_hp'),
                'email' => $this->input->post('email'),
                'password' => $hashed_password,
                'departement_id' => $this->input->post('departement_id')
            ];
            if ($this->M_user_model->insert($data)) {
                echo "User added successfully";
            } else {
                echo "Failed to add user";
            }

            redirect('admin/user');
        }
    }
    public function process_edit()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('no_hp', 'No Handphone', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect('admin/user');
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'no_hp' => $this->input->post('no_hp'),
                'email' => $this->input->post('email'),
            ];
            $nik = $this->input->post('nik');
            if ($this->M_user_model->update($nik, $data)) {
                $this->session->set_flashdata('message', 'User updated successfully');
            } else {
                $this->session->set_flashdata('message', 'Failed to update user');
            }
            redirect('admin/user');
        }
    }
    public function delete($nik)
    {
        $this->M_user_model->delete($nik);
        redirect('admin/user');
    }
}
