<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends Admin_Controller {

	function __construct()
    {
        parent::__construct();
 
   //     $this->load->library('image_CRUD');    
    }

	public function index()
	{
		redirect('Company/crud');
	}

	// Grocery CRUD - Company 
	public function crud()
	{
		$crud = $this->generate_crud('Company');
		$this->mPageTitle = 'Company Crud';

		$crud->set_field_upload('url', 'assets/uploads/blog_posts');
	//	$this->set_url_field('url');
	//	$this->set_image_path('assets/uploads');
	 
	//	$output = $crud->render();
        $crud->unset_add();
        $crud->unset_delete();

      $this->render_crud();
	}
 
}
