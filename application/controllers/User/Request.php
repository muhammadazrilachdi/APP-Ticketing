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
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_rules('priority_id', 'Priority', 'required');
        $this->form_validation->set_rules('topic', 'Topic', 'required|max_length[100]');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('user/dashboard');
        }

        $user_email = $this->session->userdata('email');
        $user_id_request = $this->Request_model->get_user_id_by_email($user_email);

        $category = $this->Category_model->get_category_by_id($this->input->post('category_id'));
        $prefix = $category->prefix;
        $year = date('Y');
        $month = date('m');
        $sequence_number = $this->Request_model->get_last_ticket_number($year);
        $no_ticket = $prefix . '.' . $year . '.' . $month . '.' . str_pad($sequence_number, 5, '0', STR_PAD_LEFT);

        $data = [
            'no_ticket' => $no_ticket,
            'user_id_request' => $user_id_request,
            'category_id' => $this->input->post('category_id'),
            'priority_id' => $this->input->post('priority_id'),
            'status_id' => 1, // Assuming 1 is the initial status (e.g., 'Open' or 'Pending')
            'topic' => $this->input->post('topic'),
            'description' => $this->input->post('description'),
            'resource' => 'Ticketing',
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $user_email
        ];

        // Handle file upload
        if (!empty($_FILES['lampiran']['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
            $config['max_size'] = 2048; // 2MB
            $config['file_name'] = 'lampiran_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('lampiran')) {
                $upload_data = $this->upload->data();
                $data['lampiran'] = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('user/dashboard');
            }
        }

        if ($this->Request_model->insert($data)) {
            $this->session->set_flashdata('success', 'Ticket berhasil dibuat dengan nomor: ' . $no_ticket);
        } else {
            $this->session->set_flashdata('error', 'Gagal membuat ticket. Silakan coba lagi.');
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

    public function detail_ticket($no_ticket)
    {
        $this->load->model('Detail_Model'); // Memuat model detail tiket
        $data['ticket'] = $this->Detail_Model->Detail_Ticket($no_ticket);

        // Cek apakah tiket ditemukan
        if (!$data['ticket']) {
            show_404(); // Tampilkan halaman 404 jika tiket tidak ditemukan
        }

        // Muat tampilan detail tiket
        $this->load->view('user/detail_ticket', $data);
    }
}
