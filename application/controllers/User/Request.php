<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Request_model');
        $this->load->model('Category_model');
        $this->load->model('Priority_model');
    }

    public function index()
    {
        $categories = $this->Category_model->get_all_category();
        $priorities = $this->Priority_model->get_all_priority();
        $data = array('categories' => $categories, 'priorities' => $priorities);
        $this->load->view('request_view', $data);
    }

    public function create_request()
    {
        $this->form_validation->set_rules('category_id', 'Category ID', 'required');
        $this->form_validation->set_rules('priority_id', 'Priority ID', 'required');
        $this->form_validation->set_rules('topic', 'Topic', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('user/dashboard');
        }

        $user_email = $this->session->userdata('email');
        $user_id_request = $this->Request_model->get_user_id_by_email($user_email);

        $data = [
            'user_id_request' => $user_id_request,
            'category_id' => $this->input->post('category_id'),
            'priority_id' => $this->input->post('priority_id'),
            'topic' => $this->input->post('topic'),
            'description' => $this->input->post('description'),
            'status_id' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $user_email
        ];

        // Simpan tiket
        if ($this->Request_model->insert_request($data)) {
            $this->session->set_flashdata('success', 'Request berhasil dibuat!');
        } else {
            $this->session->set_flashdata('error', 'Gagal membuat Request. Silakan coba lagi');
        }

        redirect('user/dashboard');
    }

    public function view_requests()
    {
        $user_email = $this->session->userdata('email');
        $user_id_request = $this->Request_model->get_user_id_by_email($user_email);
        $data['request'] = $this->Request_model->get_request_by_user($user_id_request);
        $this->load->view('user/dashboard', $data);
    }
}
