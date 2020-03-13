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
        $this->mPageTitle = 'Billing Control    ';

        $crud->set_relation('id_client', 'client', 'Name');
        $crud->set_relation('id_paid', 'status_paid', 'description_paid');

 		$this->mViewData['crud_note'] = modules::run('adminlte/widget/btn', 'New Order', 'Billing/create');
		$crud->add_action('', 'Report', ' ' ,'fa fa-file-pdf-o',array($this,'report_pdf'));

        $crud->unset_add();
        $crud->unset_delete();
        $this->render_crud();

    }
    function report_pdf($primary_key)


	{
	
	//	return $this->load->view('informe');
	$id = $primary_key;	
	    return site_url('admin/billing/vista/').$id;


   // return site_url('admin/clientes/contactos/add/').$id;
	}
    function vista($id){
        $viewdata['id_billing'] = $id;
        $viewdata['company_name'] = '';
        $viewdata['company_email'] = '';
        $viewdata['company_Address'] = '';
        $viewdata['company_phone'] = '';
        $viewdata['company_url'] = '';
        $viewdata['company_path'] = '';
        $viewdata['fecha'] =  '';
        $viewdata['name'] =  '';
        $viewdata['email'] =  '';
        $viewdata['Address'] = '';
        $viewdata['Phone'] =  '';

        $viewdata['items_description'] = array();
         
        $viewdata['items_price'] = array();
 

        $viewdata['total_billing'] = '';



        $ci =& get_instance();
          $path = base_url();

          $path .= "\assets\uploads\blog_posts\\";
        
        ///* Load Client
        $this->load->database();
        $query = $this->db->query("Select *, DATE_FORMAT(date_billing,'%d/%m/%Y') 
        AS niceDate from header_billing
        inner join client
        on client.id_client = header_billing.id_client 
        left join status_paid 
        on status_paid.id_paid = header_billing.id_paid

        where id_billing=".$id);

        $query_items = $this->db->query("SELECT  *FROM header_billing 
        inner JOIN  billing_items  
        on header_billing.id_billing = billing_items.id_billing
        inner join product
        on billing_items.id_product = product.id_product
        inner join group_taxes
        on group_taxes.id_grouptax = product.id_grouptax
        where billing_items.id_billing=".$id);




        //Load Company
        $query_company = $this->db->query("Select *from Company");
        $row_company = $query_company->row(); 
        $viewdata['company_name'] = $row_company->Name;
        $viewdata['company_email'] = $row_company->email;
        $viewdata['company_Address'] = $row_company->Address;
        $viewdata['company_phone'] = $row_company->phone;
        $viewdata['company_url'] = $row_company->url;
        $viewdata['company_path'] = $path;
     //Load Company
     $query_seteo = $this->db->query("Select *from system_settings");
     $row_seteo = $query_seteo->row(); 
     $smtp_host = $row_seteo->smtp_host;
     $smtp_user	 = $row_seteo->smtp_user;
     $smtp_password		 = $row_seteo->smtp_password	;
     $smtp_port		  	 = $row_seteo->smtp_port		;
     $sendeamail		  	 = $row_seteo->Send_Email			;


        foreach ($query->result() as $row)
        {
                         $viewdata['fecha'] = $row->niceDate;
                        $viewdata['name'] = $row->Name;
                        $viewdata['email'] = $row->email;
                        $viewdata['Address'] = $row->Address;
                        $viewdata['Phone'] = $row->Phone;


                        $viewdata['paid'] = $row->description_paid;
                        $viewdata['notes'] = $row->notes;


                        $viewdata['total_billing'] = $row->total_billing;
                        $viewdata['total_taxes'] = $row->total_taxes;

        }   

         $viewdata['total_items'] =  $query_items->num_rows(); 
           $i = 0;
        foreach ($query_items->result() as $rowitems)
        
       {
 

             $i = $i+1;
             /*
             $viewdata['descripcion_'.$i] = $rowitems['description'];  
             $viewdata['items_price_'.$i] = $rowitems['price'];
             $viewdata['qty_'.$i] = $rowitems['qty'];
             $viewdata['tax_'.$i] = $rowitems['tax_price'];

        */
        $viewdata['descripcion_'.$i] = $rowitems->description;  
        $viewdata['items_price_'.$i] = $rowitems->price;
        $viewdata['qty_'.$i] = $rowitems->qty;
        $viewdata['tax_'.$i] = $rowitems->tax_price;

          }   
 
          /*

               $row_seteo = $seteo->row(); 
     $smtp_host = $row_seteo->smtp_host;
     $smtp_user	 = $row_seteo->smtp_user;
     $smtp_password		 = $row_seteo->smtp_password	;
     $smtp_port		  	 = $row_seteo->smtp_port		;
          */
          $config = Array(    

            'protocol' => 'sendmail',
      
            'smtp_host' => $smtp_host,
      
            'smtp_port' => $smtp_port	,
      
            'smtp_user' => $smtp_user,
      
            'smtp_pass' => $smtp_password,
      
            'smtp_timeout' => '4',
      
            'mailtype' => 'html',
      
            'charset' => 'iso-8859-1'
      
          );
      
          $subject = "Invoice Nro. : " .$id;
          $this->load->library('email', $config);
      
        $this->email->set_newline("\r\n");
      
        
      
          $this->email->from($viewdata['email'], 'Invoice Billing');
      
       
      
        $this->email->to($viewdata['email']); // replace it with receiver mail id
      
        $this->email->subject($subject); // replace it with relevant subject
      
        
      if($sendeamail = 1){
          $body =  $this->load->view('adminlte/billing/billing_view',$viewdata);
 
          //$this->load->view('emails/anillabs.php',$data,TRUE);
      
        $this->email->message($body); 
      
          $this->email->send();
      }else {

            $this->load->view('adminlte/billing/billing_view',$viewdata);
 
          }


    }

    	// Grocery CRUD - Billing  TYPE 
	public function billing_type()
	{
		$crud = $this->generate_crud('status_paid');
         $this->mPageTitle = 'Status Paid /CRUD    ';
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
        $data['id_paid'] = $this->Group_model->get_all_paid();
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
        $id_paid	= $this->input->post('paid',TRUE);
        $notes	= $this->input->post('notes',TRUE);

        $this->db->insert("header_billing", [
			"id_client" => $client,
            "total_billing" => $total_billing,

            "total_taxes" => $total_subtotal,

            "id_paid" => $id_paid,

            "notes" => $notes,
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
       

          redirect('/admin/Billing/vista/'.$id_invoice, 'location');
   
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