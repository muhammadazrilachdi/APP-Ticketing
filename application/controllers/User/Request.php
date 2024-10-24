<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Request_model');
        $this->load->model('Category_model');
        $this->load->model('Pic_model');
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
            'request_id' => $this->input->post('request_id'),
            'user_id_request' => $user_id_request,
            'category_id' => $this->input->post('category_id'),
            'priority_id' => $this->input->post('priority_id'),
            'status_id' => 1,
            'topic' => $this->input->post('topic'),
            'description' => $this->input->post('description'),
            'resource' => 'Ticketing',
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $user_email
        ];


        if (!empty($_FILES['lampiran']['name'])) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
            $config['max_size'] = 2048;
            $config['file_name'] = 'lampiran_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('lampiran')) {
                $upload_data = $this->upload->data();
                $data['lampiran'] = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', 'Upload File Gagal. Perhatikan Tipe File Dan Ukuran File');
                redirect('user/dashboard');
            }
        }

        if ($this->Request_model->insert($data)) {
            $request_id = $this->db->insert_id();

            $get_pic_category = $this->Pic_model->pic($this->input->post('category_id'));

            foreach ($get_pic_category as $key => $pic_category) {
                $data_request_category_pic = [
                    'category_pic_id'   => $pic_category['category_pic_id'],
                    'request_id'        => $request_id
                ];

                $this->Request_model->insert_request_category_pic($data_request_category_pic);
            }

            $this->session->set_flashdata('success', 'Ticket berhasil dibuat dengan nomor: ' . $data['no_ticket']);
        } else {
            $this->session->set_flashdata('error', 'Gagal membuat ticket. Silakan coba lagi.');
        }

        redirect('user/dashboard');
    }

    public function create_request_api()
    {
        // Cek jika request berasal dari API
        if ($this->input->is_ajax_request() || $this->input->method() === 'post') {
            // Mengambil data dari request API
            $data = json_decode(file_get_contents('php://input'), true);

            // Cek jika data adalah null
            if (is_null($data)) {
                $this->output->set_status_header(400);
                echo json_encode(['error' => 'Invalid JSON input.']);
                return;
            }

            // Validasi data
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('category_id', 'Category', 'required');
            $this->form_validation->set_rules('priority_id', 'Priority', 'required');
            $this->form_validation->set_rules('topic', 'Topic', 'required|max_length[100]');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->output->set_status_header(400);
                echo json_encode(['error' => validation_errors()]);
                return;
            }

            // Mengambil user_id_request berdasarkan input lain, misalnya user_id
            $user_id_request = $data['user_id']; // Pastikan user_id ada di input

            // Menyusun nomor tiket
            $category = $this->Category_model->get_category_by_id($data['category_id']);
            $prefix = $category->prefix;
            $year = date('Y');
            $month = date('m');
            $sequence_number = $this->Request_model->get_last_ticket_number($year);
            $no_ticket = $prefix . '.' . $year . '.' . $month . '.' . str_pad($sequence_number, 5, '0', STR_PAD_LEFT);

            // Mengambil sumber request dari header
            $resource_source = $this->input->get_request_header('X-Source', TRUE);

            // Debugging untuk memastikan header diterima
            log_message('debug', 'X-Source header value: ' . ($resource_source ? $resource_source : 'Not received'));

            // Menyusun data tiket
            $ticket_data = [
                'no_ticket' => $no_ticket,
                'user_id_request' => $user_id_request,
                'category_id' => $data['category_id'],
                'priority_id' => $data['priority_id'],
                'status_id' => 1, // Status awal
                'topic' => $data['topic'],
                'description' => $data['description'],
                'resource' => $resource_source ? $resource_source : 'Default', // Default jika tidak ada
                'created_at' => date('Y-m-d H:i:s'),
            ];

            // Handle file lampiran dalam format base64
            if (!empty($data['lampiran'])) {
                $data_parts = explode(';', $data['lampiran']);
                if (count($data_parts) < 2) {
                    $this->output->set_status_header(400);
                    echo json_encode(['error' => 'Invalid lampiran format.']);
                    return;
                }
                $extension = explode('/', $data_parts[0])[1];
                $base64_data = explode(',', $data_parts[1])[1];

                // Mendapatkan nama file
                $file_name = 'lampiran_' . time() . '.' . $extension;
                $file_path = './uploads/' . $file_name;

                // Menyimpan file
                if (file_put_contents($file_path, base64_decode($base64_data)) === false) {
                    $this->output->set_status_header(500);
                    echo json_encode(['error' => 'Gagal menyimpan lampiran.']);
                    return;
                }
                $ticket_data['lampiran'] = $file_name;
            }

            // Simpan data tiket
            $insert_result = $this->Request_model->insert($ticket_data);
            $request_id = $this->db->insert_id(); // Mendapatkan ID terakhir yang dimasukkan

            if ($insert_result) {
                // Ambil PIC berdasarkan category_id
                $get_pic_category = $this->Pic_model->pic($data['category_id']); // Ganti this->input->post menjadi $data

                foreach ($get_pic_category as $pic_category) {
                    $data_request_category_pic = [
                        'category_pic_id' => $pic_category['category_pic_id'],
                        'request_id'      => $request_id,
                    ];

                    // Insert data ke request_category_pic
                    $this->Request_model->insert_request_category_pic($data_request_category_pic);
                }

                echo json_encode(['success' => 'Ticket berhasil dibuat dengan nomor: ' . $no_ticket]);
            } else {
                $this->output->set_status_header(500);
                echo json_encode(['error' => 'Gagal membuat ticket. Silakan coba lagi.']);
            }
        } else {
            $this->output->set_status_header(405);
            echo json_encode(['error' => 'Method not allowed.']);
        }
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

        // Ambil request_id dari detail tiket
        $request_id = $data['ticket']['request_id']; // Ganti dengan nama kolom yang sesuai

        // Ambil kategori gambar terkait dengan tiket
        $data['request_category_pic'] = $this->Request_model->get_request_category_pic($request_id);

        // Muat tampilan detail tiket
        $this->load->view('user/detail_ticket', $data);
    }
}
