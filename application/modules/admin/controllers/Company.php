<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends Admin_Controller {

	public function index()
	{
		redirect('Company/crud');
	}

	// Grocery CRUD - Company 
	public function crud()
	{
		$crud = $this->generate_crud('Company');
        $this->mPageTitle = 'Company Crud';
        $crud->unset_add();
        $crud->unset_delete();

        $this->render_crud();
	}
 
}
