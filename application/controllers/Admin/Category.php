<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Category Data';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Category_model');

        $this->Category_model->category('category_id');
        $data['category_id'] = $this->Category_model->get_all_category();

        $data['category_id'] = $this->db->get('category')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/category', $data);
        $this->load->view('templates/footer_category');
    }
    public function process_tambah()
    {
        $this->form_validation->set_rules('category_id', 'Kategory ID', 'required');
        $this->form_validation->set_rules('name', 'Nama Kategory', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = [
                'category_id' => $this->input->post('category_id'),
                'name' => $this->input->post('name')
            ];
            $this->Category_model->insert($data);
            redirect('admin/category');
        }
    }

    public function process_edit()
    {
        $this->form_validation->set_rules('category_id', 'Kategory ID', 'required');
        $this->form_validation->set_rules('name', 'Nama Kategory', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $category_id = $this->input->post('category_id');
            $name = $this->input->post('name');

            $update_data = array(
                'category_id' => $category_id,
                'name' => $name
            );

            $this->Category_model->update($update_data);
            redirect('admin/category');
        }
    }

    public function delete($category_id)
    {
        $this->Category_model->delete($category_id);
        redirect('admin/category');
    }
}
