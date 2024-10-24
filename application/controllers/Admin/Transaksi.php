
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
        $this->load->model('M_user_model');
        $this->load->model('Detail_Model');
        $this->load->model('Pic_model');
        $this->load->library('session');
        $this->load->helper('url');
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
        $data['user'] = $this->M_user_model->get_all_user();

        $data['request'] = $this->M_user_model->get_user_request();
        $data['request'] = $this->Request_model->get_all_request();

        $data['bulan_indonesia'] = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
        $this->load->helper('tanggal');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/transaksi', $data);
        $this->load->view('templates/footer_transaksi');
    }

    public function process_tambah()
    {

        $this->form_validation->set_rules('category_id', 'Category ID', 'required');
        $this->form_validation->set_rules('priority_id', 'Priority ID', 'required');
        $this->form_validation->set_rules('topic', 'Topic', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/transaksi');
        }

        $category = $this->Category_model->get_category_by_id($this->input->post('category_id'));
        $prefix = $category->prefix;
        $year = date('Y');
        $month = date('m');
        $sequence_number = $this->Request_model->get_last_ticket_number($year);
        $no_ticket = $prefix . '.' . $year . '.' . $month . '.' . str_pad($sequence_number, 5, '0', STR_PAD_LEFT);

        $data = [
            'no_ticket' => $no_ticket,
            'user_id_request' => $this->input->post('user_id_request'),
            'category_id' => $this->input->post('category_id'),
            'priority_id' => $this->input->post('priority_id'),
            'topic' => $this->input->post('topic'),
            'description' => $this->input->post('description'),
            'status_id' => '1',
            'feedback' => $this->input->post('feedback'),
            'resource' => 'Ticketing'

        ];


        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
        $config['max_size'] = 2048;
        $config['file_name'] = 'lampiran_' . time();

        $this->load->library('upload', $config);

        if (!empty($_FILES['lampiran']['name'])) {
            if ($this->upload->do_upload('lampiran')) {
                $upload_data = $this->upload->data();
                $data['lampiran'] = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/transaksi');
            }
        }

        if ($this->Request_model->insert($data)) {
            $request_id = $this->db->insert_id();

            // $category_pic_id = $this->input->post('category_pic_id');
            // cari ke model where karegori apa , dapet pic_id , kmudian di save pic id dan request_id ke request_category_pic
            $get_pic_category = $this->Pic_model->pic($this->input->post('category_id'));
            // pre($get_pic_category);

            foreach ($get_pic_category as $key => $pic_category) {
                $data_request_category_pic = [
                    'category_pic_id'   => $pic_category['category_pic_id'],
                    'request_id'        => $request_id
                ];

                $this->Request_model->insert_request_category_pic($data_request_category_pic);
            }

            $this->session->set_flashdata('success', 'Transaksi berhasil dibuat!');
        } else {
            $this->session->set_flashdata('error', 'Gagal membuat Transaksi. Silakan coba lagi');
        }

        redirect('admin/transaksi');
    }
    public function process_edit()
    {
        $this->form_validation->set_rules('no_ticket', 'No Ticket', 'required');
        $this->form_validation->set_rules('category_id', 'Kategori', 'required');
        $this->form_validation->set_rules('priority_id', 'Prioritas', 'required');
        $this->form_validation->set_rules('status_id', 'Status', 'required');
        $this->form_validation->set_rules('topic', 'Topik', 'required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required');
        $this->form_validation->set_rules('feedback', 'Feedback');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Gagal mengupdate data');
            redirect('admin/transaksi');
        } else {
            $update_data = [
                'no_ticket' => $this->input->post('no_ticket'),
                'category_id' => $this->input->post('category_id'),
                'priority_id' => $this->input->post('priority_id'),
                'status_id' => $this->input->post('status_id'),
                'topic' => $this->input->post('topic'),
                'description' => $this->input->post('description'),
                'feedback' => $this->input->post('feedback'),
                'created_at' => date('Y-m-d H:i:s')
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
        $this->load->model('Request_model');

        $request = $this->Request_model->get_request_by_id($request_id);

        if ($request) {
            if (!empty($request['lampiran'])) {
                $file_path = FCPATH . 'uploads/' . $request['lampiran'];
                if (file_exists($file_path)) {
                    if (!unlink($file_path)) {
                        log_message('error', 'Gagal menghapus file: ' . $file_path);
                    }
                }
            }

            // Hapus data dari database
            if ($this->Request_model->delete($request_id)) {
                $this->session->set_flashdata('success', 'Data request berhasil dihapus');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus data request');
            }
        } else {
            $this->session->set_flashdata('error', 'Data request tidak ditemukan');
        }

        redirect('admin/transaksi');
    }

    public function detail($no_ticket)
    {
        $data['title'] = 'Detail Transaksi';
        $data['ticket'] = $this->Detail_Model->Detail_Ticket($no_ticket);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_detail', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/transaksi_detail', $data);
        $this->load->view('templates/footer');
    }
}
