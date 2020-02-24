<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing extends Admin_Controller {

	public function index()
	{
        parent::__construct();
		$this->load->library('form_builder');
		redirect('Billing/crud');
	}

	// Grocery CRUD - Billing 
	public function crud()
	{
		$crud = $this->generate_crud('header_billing');
        $crud->set_relation('id_client', 'client', 'Name');
        $this->mPageTitle = 'Billing Control    ';
		$this->mViewData['crud_note'] = modules::run('adminlte/widget/btn', 'New Order', 'Billing/create');

        $crud->unset_add();
        $crud->unset_delete();
        $this->render_crud();

    }
    public function savehead($client,$total){
        

     }
    public function get_allproduct()
	{
        $this->load->model('Group_model');
        $data['product'] = $this->Group_model->get_all_products();

		echo json_encode($data);
  
    }
    public function create(){
  
        $this->load->model('Group_model');
        $data['id_client'] = $this->Group_model->get_all_clients();
        $data['company'] = $this->Group_model->get_all_company();
        $data['product'] = $this->Group_model->get_all_products();

        
    $this->load->view('adminlte/billing/billing', $data);
     
    }

    public function save(){

        // Header Invoice 
        $client	= $this->input->post('companyName',TRUE);
        $total_billing	= $this->input->post('totalAftertax',TRUE);
        $total_subtotal	= $this->input->post('subTotal',TRUE);

        $this->db->insert("header_billing", [
			"id_client" => $client,
            "total_billing" => $total_billing,

            "total_taxes" => $total_subtotal,
		]);
        
        $id_invoice = $this->db->insert_id();


        // Invoice Detail
         $id_product	= $this->input->post('productCode[]',TRUE);
         $price	= $this->input->post('price[]',TRUE);
         $quantity= $this->input->post('quantity[]',TRUE);
    
         $taxes	= $this->input->post('taxes[]',TRUE);
         $total	= $this->input->post('total[]',TRUE);
                  
         $long = count( $id_product);
 
         //For add Items.
         for($i=0; $i<$long; $i++)
         {

            $this->db->insert("billing_items", [
                "id_billing" => $id_invoice,
                "id_product" => $id_product[$i] ,
                "price_unity" => $price[$i] ,
                "qty" => $quantity[$i] ,
                "price_total" => $total[$i] ,
                "taxes" => $taxes[$i] ,


            ]);
            
         
         }
         
        // $this->load->view('adminlte/billing/billing_view');
        }

 
}

function view_invoice(){
    $ci =& get_instance();
    $this->load->view('adminlte/billing/billing_view');

    echo "jasdasda";
 /* $data =1;

    $this->load->view('adminlte/billing/billing_view', $data);

    //$this->load->database();
  //  $query = $this->db->query("SELECT");
return $data;
*/
}