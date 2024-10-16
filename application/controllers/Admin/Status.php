<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Status extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Status_model');
        $this->load->library('session');
        $this->load->helper('url');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Status Data';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['status_id'] = $this->Status_model->get_all_status();
        $data['status_id'] = $this->db->get_where('status', array('is_deleted' => 0))->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/status', $data);
        $this->load->view('templates/footer_status');
    }
    public function process_tambah()
    {
        $this->form_validation->set_rules('name', 'Nama Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
            if ($this->Status_model->insert($data)) {
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data');
            }
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

            if ($this->Status_model->update($update_data)) {
                $this->session->set_flashdata('success', 'Data berhasil diupdate');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate data');
            }
            redirect('admin/status');
        }
    }

    public function delete($status_id)
    {
        $this->Status_model->delete($status_id);
        $this->session->set_flashdata('success', 'Status berhasil dihapus');
        redirect('admin/status');
    }
}
