<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model
{
    private $_table = "supplier";

    public $Supplier_id;
    public $Supplier_name;
    public $Supplier_addres;

    public function rules()
    {
        return [
            ['field' => 'name',
            'label' => 'Name',
            'rules' => 'required'],

            ['field' => 'addres',
            'label' => 'Addres',
            'rules' => 'required'],


        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["Supplier_id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->Supplier_id = $post["id"];
        $this->Supplier_name = $post["name"];
		$this->Supplier_addres = $post["addres"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->Supplier_id = $post["id"];
        $this->Supplier_name = $post["name"];
		$this->Supplier_addres = $post["addres"];


        $this->db->update($this->_table, $this, array('Supplier_id' => $post['id']));


    }
    public function delete($id)
    {

        return $this->db->delete($this->_table, array("Supplier_id" => $id));
    }


}
