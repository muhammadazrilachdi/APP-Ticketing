<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Priority extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Priority_model');
        $this->load->library('session');
        $this->load->helper('url');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Priority Data';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['priority_id'] = $this->Priority_model->get_all_priority();
        $data['priority_id'] = $this->db->get_where('priority', array('is_deleted' => 0))->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/priority', $data);
        $this->load->view('templates/footer_priority');
    }

    public function process_tambah()
    {
        $this->form_validation->set_rules('name', 'Nama Priority', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = [
                'name' => $this->input->post('name'),
            ];
            if ($this->Priority_model->insert($data)) {
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data');
            }
            redirect('admin/priority');
        }
    }
    public function process_edit()
    {
        $this->form_validation->set_rules('priority_id', 'Priority ID', 'required');
        $this->form_validation->set_rules('name', 'Nama Priority', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $priority_id = $this->input->post('priority_id');
            $name = $this->input->post('name');

            $update_data = array(
                'priority_id' => $priority_id,
                'name' => $name
            );
            if ($this->Priority_model->update($update_data)) {
                $this->session->set_flashdata('success', 'Data berhasil diupdate');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate data');
            }
            redirect('admin/priority');
        }
    }

    public function delete($priority_id)
    {
        $this->Priority_model->delete($priority_id);
        $this->session->set_flashdata('success', 'Priority berhasil dihapus');
        redirect('admin/priority');
    }
}
