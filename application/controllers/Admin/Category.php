<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
        $this->load->model('M_user_model');
        $this->load->model('Category_model');
        $this->load->model('Pic_model');
        $this->load->library('session');
        $this->load->helper('url');
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
        $data['category_id'] = $this->db->get_where('category', array('is_deleted' => 0))->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/category', $data);
        $this->load->view('templates/footer_category');
    }
    public function process_tambah()
    {
        $this->form_validation->set_rules('name', 'Nama Kategory', 'required');
        $this->form_validation->set_rules('prefix', 'Prefix Category', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'prefix' => $this->input->post('prefix'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            if ($this->Category_model->insert($data)) {
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data');
            }
            redirect('admin/category');
        }
    }
    public function process_edit()
    {
        $this->form_validation->set_rules('category_id', 'Kategory ID', 'required');
        $this->form_validation->set_rules('name', 'Nama Kategory', 'required');
        $this->form_validation->set_rules('prefix', 'Prefix Kategory', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $category_id = $this->input->post('category_id');
            $name = $this->input->post('name');
            $prefix = $this->input->post('prefix');

            $update_data = array(
                'category_id' => $category_id,
                'name' => $name,
                'prefix' => $prefix
            );
            if ($this->Category_model->update($update_data)) {
                $this->session->set_flashdata('success', 'Data berhasil diupdate');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate data');
            }
            redirect('admin/category');
        }
    }

    public function delete($category_id)
    {
        $this->Category_model->delete($category_id);
        $this->session->set_flashdata('success', 'Category berhasil dihapus');
        redirect('admin/category');
    }

    public function pic($category_id)
    {
        $category = $this->Category_model->get_category_by_id($category_id);
        $data['title'] = 'PIC' . ' ' . $category->name;;
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['user'] = $this->M_user_model->get_all_user();
        $data['category'] = $this->Category_model->get_all_category();
        $data['category_pic'] = $this->Pic_model->pic($category_id);
        $data['category_pic_id'] = $this->db->get_where('category_pic', array('is_deleted' => 0))->result_array();
        $data['category_id'] = $category_id;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_pic', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/pic', $data);
        $this->load->view('templates/footer_pic');
    }
    public function pic_tambah($category_id)
    {
        $this->form_validation->set_rules('user_id', 'User  ID', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {
            $data = [
                'category_id' => $category_id,
                'user_id' => $this->input->post('user_id'),
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('email')
            ];

            if ($this->db->insert('category_pic', $data)) {
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data');
            }
            redirect('admin/category/pic/' . $category_id);
        }
    }
    public function pic_edit($category_id)
    {
        $this->form_validation->set_rules('user_id', 'User  ID', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Gagal mengupdate data');
            redirect('admin/category/pic/' . $category_id);
        } else {
            $user_id = $this->input->post('user_id');
            $category_pic_id = $this->input->post('category_pic_id');

            $update_data = array(
                'user_id' => $user_id
            );

            if ($this->Pic_model->update($category_pic_id, $update_data)) {
                $this->session->set_flashdata('success', 'Data berhasil diupdate');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate data');
            }
            redirect('admin/category/pic/' . $category_id);
        }
    }
    public function pic_delete($category_pic_id)
    {
        $category_id = $this->input->get('category_id');
        if ($this->Pic_model->delete($category_pic_id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data');
        }
        redirect('admin/category/pic/' . $category_id);
    }
    public function aktifkan_pic($category_pic_id, $category_id)
    {
        $category_id = $this->input->get('category_id');
        $this->Pic_model->aktifkan_pic($category_pic_id);
        $this->session->set_flashdata('success', 'PIC berhasil diaktifkan');
        redirect('admin/category/pic/' . $category_id);
    }

    public function nonaktifkan_pic($category_pic_id, $category_id)
    {
        $category_id = $this->input->get('category_id');
        $this->Pic_model->nonaktifkan_pic($category_pic_id);
        $this->session->set_flashdata('success', 'PIC berhasil dinonaktifkan');
        redirect('admin/category/pic/' . $category_id);
    }
}
