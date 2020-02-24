<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Admin_Controller {

	public function index()
	{
		redirect('Product/crud');
	}

	// Grocery CRUD - Clients 
	public function crud()
	{
		$crud = $this->generate_crud('product');
     //	$crud->columns('Description', 'Price', 'Group Taxes', 'Is Imported');   
        $crud->set_relation('id_grouptax', 'group_taxes', 'description_group');
        $this->mPageTitle = 'Product Crud';
        $crud->field_type('id_product', 'hidden', $this->mUser->id);

		$this->render_crud();
	}
    public function taxes_crud()
	{
		$crud = $this->generate_crud('group_taxes');
 		$this->mPageTitle = 'Crud Taxes';
		$this->render_crud();
	}
 
}
