
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Request_model');
        $this->load->model('Category_model');
        $this->load->model('Priority_model');
        $this->load->model('Status_model');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Transaksi Data';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['category'] = $this->Category_model->get_all_category();
        $data['priority'] = $this->Priority_model->get_all_priority();
        $data['status'] = $this->Status_model->get_all_status();
        $data['request'] = $this->Request_model->get_transaksi_by_status('Menunggu Antrean');
        $data['request'] = $this->Request_model->get_transaksi_by_status('Sedang Diproses');
        $data['request'] = $this->Request_model->get_transaksi_by_status('Selesai');

        $this->load->model('Request_model');
        $data['request'] = $this->Request_model->get_all_request();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/transaksi', $data);
        $this->load->view('templates/footer_transaksi');
    }

    public function process_tambah()
    {
        $this->form_validation->set_rules('category_id', 'Kategori', 'required');
        $this->form_validation->set_rules('priority_id', 'Prioritas', 'required');
        $this->form_validation->set_rules('status_id', 'Status', 'required');
        $this->form_validation->set_rules('topic', 'Topik', 'required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required');
        $this->form_validation->set_rules('user_id_request', 'ID Request', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Gagal menambahkan data');
            redirect('admin/transaksi');
        } else {
            $data = [
                'category_id' => $this->input->post('category_id'),
                'priority_id' => $this->input->post('priority_id'),
                'status_id' => $this->input->post('status_id'),
                'topic' => $this->input->post('topic'),
                'description' => $this->input->post('description'),
                'user_id_request' => $this->input->post('user_id_request'),
            ];
            if ($this->Request_model->insert($data)) {
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data');
            }
            redirect('admin/transaksi');
        }
    }


    public function process_edit()
    {
        $this->form_validation->set_rules('category_id', 'Kategori', 'required');
        $this->form_validation->set_rules('priority_id', 'Prioritas', 'required');
        $this->form_validation->set_rules('status_id', 'Status', 'required');
        $this->form_validation->set_rules('topic', 'Topik', 'required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Gagal mengupdate data');
            redirect('admin/transaksi');
        } else {
            $update_data = [
                'category_id' => $this->input->post('category_id'),
                'priority_id' => $this->input->post('priority_id'),
                'status_id' => $this->input->post('status_id'),
                'topic' => $this->input->post('topic'),
                'description' => $this->input->post('description'),
            ];
            $request_id = $this->input->post('request_id');
            if ($this->Request_model->update($request_id, $update_data)) {
                $this->session->set_flashdata('success', 'Data berhasil diupdate');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate data');
            }
            redirect('admin/transaksi');
        }
    }

    public function delete($request_id)
    {
        $this->Request_model->delete($request_id);
        redirect('admin/transaksi');
    }
}
