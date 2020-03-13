<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seteo  extends Admin_Controller {

	public function index()
	{
		redirect('Seteo/crud');
	}

	// Grocery CRUD - Clients 
	public function crud()
	{
		$crud = $this->generate_crud('system_settings');
	//	$crud->columns('author_id', 'category_id', 'title', 'image_url', 'tags', 'publish_time', 'status');   
		$this->mPageTitle = 'Crud System Settings';
		$crud->unset_add();
        $crud->unset_delete();
		$this->render_crud();
    }
    
  
 
}
