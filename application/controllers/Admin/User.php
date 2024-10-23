<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user_model');
        $this->load->model('Departement_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'User Data';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['user'] = $this->M_user_model->get_all_user();
        $data['user'] = $this->db->get_where('user', array('is_deleted' => 0))->result_array();
        $data['departement_id'] = $this->Departement_model->get_all_departement();

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
        $this->form_validation->set_rules('departement_id', 'Departement ID', 'required');
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
                'departement_id' => $this->input->post('departement_id'),
                'created_by' => $this->input->post('user_id'),
            ];
            if ($this->M_user_model->insert($data)) {
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data');
            }
            redirect('admin/user');
        }
    }
    public function process_edit()
    {

        $this->form_validation->set_rules('user_id', 'User ID', 'required|numeric');
        $this->form_validation->set_rules('nik', 'NIK', 'required|numeric');
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('no_hp', 'No Handphone', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/user');
        } else {
            $user_id = $this->input->post('user_id');
            $data = [
                'nik' => $this->input->post('nik'),
                'name' => $this->input->post('name'),
                'no_hp' => $this->input->post('no_hp'),
                'email' => $this->input->post('email'),
                'departement_id' => $this->input->post('departement_id'),
            ];

            $password = $this->input->post('password');
            if (!empty($password)) {
                $data['password'] = md5($password);
            }

            if ($this->M_user_model->update($user_id, $data)) {
                $this->session->set_flashdata('success', 'Data berhasil diupdate');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate data');
            }
            redirect('admin/user');
        }
    }

    public function delete($user_id)
    {
        $this->M_user_model->delete($user_id);
        $this->session->set_flashdata('success', 'User berhasil dihapus');
        redirect('admin/user');
    }
}
