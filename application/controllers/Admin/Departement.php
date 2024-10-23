<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Departement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Departement_model');
        $this->load->library('session');
        $this->load->helper('url');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Departement Data';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['departement_id'] = $this->Departement_model->get_all_departement();
        $data['departement_id'] = $this->db->get_where('departement', array('is_deleted' => 0))->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/departement', $data);
        $this->load->view('templates/footer_departement');
    }

    public function process_tambah()
    {
        $this->form_validation->set_rules('name', 'Nama Departement', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = [
                'name' => $this->input->post('name'),
            ];
            if ($this->Departement_model->insert($data)) {
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data');
            }
            redirect('admin/departement');
        }
    }
    public function process_edit()
    {
        $this->form_validation->set_rules('departement_id', 'Departement ID', 'required');
        $this->form_validation->set_rules('name', 'Nama Departement', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $departement_id = $this->input->post('departement_id');
            $name = $this->input->post('name');

            $update_data = array(
                'departement_id' => $departement_id,
                'name' => $name
            );
            if ($this->Departement_model->update($update_data)) {
                $this->session->set_flashdata('success', 'Data berhasil diupdate');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate data');
            }
            redirect('admin/departement');
        }
    }
    public function delete($departement_id)
    {
        $this->Departement_model->delete($departement_id);
        $this->session->set_flashdata('success', 'Departement berhasil dihapus');
        redirect('admin/departement');
    }
}
