<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Status extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Status_model');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Status Data';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['status_id'] = $this->Status_model->get_all_status();

        $data['status_id'] = $this->db->get('status')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/status', $data);
        $this->load->view('templates/footer_status');
    }
    public function process_tambah()
    {
        $this->form_validation->set_rules('status_id', 'Status ID', 'required');
        $this->form_validation->set_rules('name', 'Nama Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = [
                'status_id' => $this->input->post('status_id'),
                'name' => $this->input->post('name')
            ];
            $this->Status_model->insert($data);
            redirect('admin/status');
        }
    }
    public function process_edit()
    {
        $this->form_validation->set_rules('status_id', 'Status ID', 'required');
        $this->form_validation->set_rules('name', 'Nama Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $status_id = $this->input->post('status_id');
            $name = $this->input->post('name');

            $update_data = array(
                'status_id' => $status_id,
                'name' => $name
            );

            $this->Status_model->update($update_data);
            redirect('admin/status');
        }
    }

    public function delete($status_id)
    {
        $this->Status_model->delete($status_id);
        redirect('admin/status');
    }
}
