<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

	public function index()
	{
		$this->load->model('user_model', 'users');
		$query_product = $this->db
		->select('id_product, count(id_product) AS number_product')
 		->get('product', 10);
		 $row = $query_product->row();
		 $total_product = $row->number_product;

		 $query_client= $this->db
		 ->select('id_client, count(id_client) AS number_client')
		  ->get('client', 10);
		  $row_client = $query_client->row();
		  $total_client = $row_client->number_client;
  

		  $query_invoice= $this->db
		  ->select('id_billing, count(id_billing) AS number_invoice')
		   ->get('header_billing', 10);
		   $row_invoice = $query_invoice->row();
		   $total_invoice = $row_invoice->number_invoice;


		$this->mViewData['count'] = array(
			'users' => $this->users->count_all(),
			'product' => $total_product,

			'client' => $total_client,

			'invoices' => $total_invoice,
		);
		$this->render('home');
	}
}
