<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Customer_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["customers"] = $this->Customer_model->getAll();
        $this->load->view("admin/customer/list", $data);
    }

    public function add()
    {
        $customer = $this->Customer_model;
        $validation = $this->form_validation;
        $validation->set_rules($customer->rules());

        if ($validation->run()) {
            $customer->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/Customer/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/Customer');

        $customer = $this->Customer_model;
        $validation = $this->form_validation;
        $validation->set_rules($customer->rules());

        if ($validation->run()) {
            $customer->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["customer"] = $customer->getById($id);
        if (!$data["customer"]) show_404();

        $this->load->view("admin/Customer/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->Customer_model->delete($id)) {
            redirect(site_url('admin/Customers'));
        }
    }
}
