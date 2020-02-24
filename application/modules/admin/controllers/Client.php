<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends Admin_Controller {

	public function index()
	{
		redirect('Client/crud');
	}

	// Grocery CRUD - Clients 
	public function crud()
	{
		$crud = $this->generate_crud('client');
	//	$crud->columns('author_id', 'category_id', 'title', 'image_url', 'tags', 'publish_time', 'status');   
		$this->mPageTitle = 'Crud Client';
		$this->render_crud();
    }
    
  
 
}
