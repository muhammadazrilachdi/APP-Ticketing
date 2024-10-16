<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Request_model');
    }

    public function receive_data()
    {
        // Validasi input
        $this->form_validation->set_rules('no_ticket', 'No Ticket', 'required');
        $this->form_validation->set_rules('category_id', 'Kategori', 'required');
        $this->form_validation->set_rules('priority_id', 'Prioritas', 'required');
        $this->form_validation->set_rules('topic', 'Topik', 'required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->output->set_status_header(400);
            $this->output->set_output(json_encode(['error' => 'Gagal menerima data']));
        } else {
            $data = [
                'no_ticket' => $this->input->post('no_ticket'),
                'category_id' => $this->input->post('category_id'),
                'priority_id' => $this->input->post('priority_id'),
                'topic' => $this->input->post('topic'),
                'description' => $this->input->post('description'),
            ];

            // Simpan data ke database
            if ($this->Request_model->insert($data)) {
                $this->output->set_status_header(201);
                $this->output->set_output(json_encode(['success' => 'Data berhasil diterima']));
            } else {
                $this->output->set_status_header(500);
                $this->output->set_output(json_encode(['error' => 'Gagal menyimpan data']));
            }
        }
    }
}
