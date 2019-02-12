<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Suppliers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Supplier_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["suppliers"] = $this->Supplier_model->getAll();
        $this->load->view("admin/Supplier/list", $data);
    }

    public function add()
    {
        $supplier = $this->Supplier_model;
        $validation = $this->form_validation;
        $validation->set_rules($supplier->rules());

        if ($validation->run()) {
            $supplier->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/Supplier/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/Supplier');

        $supplier = $this->Supplier_model;
        $validation = $this->form_validation;
        $validation->set_rules($supplier->rules());

        if ($validation->run()) {
            $supplier->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["supplier"] = $supplier->getById($id);
        if (!$data["supplier"]) show_404();

        $this->load->view("admin/Supplier/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->Supplier_model->delete($id)) {
            redirect(site_url('admin/Suppliers'));
        }
    }
}
