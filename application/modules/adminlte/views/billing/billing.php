 

<title>Demo By: Rodrigo Espino</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<? echo base_url('assets/css/style.css');?>" />

<script type='text/javascript' src="<?php echo base_url('assets/'); ?>js/invoice.js"></script>
  
<div class="container content-invoice">
 
<form action="<?php echo site_url('admin/Billing/save');?>" method="post" enctype="multipart/form-data">
		<div class="load-animate animated fadeInUp">
			<div class="row">
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
  				</div>		    		
			</div>
			<input id="currency" type="hidden" value="$">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<h3>From,</h3>
					<?php foreach($company as $row):?>
						
					<h1>Name: <?php echo $row->Name;?><br></h1>	
					Email:  <?php echo $row->email;?><br>	
					Adress: <?php echo $row->Address;?><br>
					Phone: <?php echo $row->phone;?><br>	
						
					<?php echo $row->Taxes_imported;?><br>	
					
					<input id="taxes_i" name="taxes_i" type="hidden" value="<?php echo $row->Taxes_imported;?>">
       				<?php endforeach;?>

				</div>      		
		<!--  
		
		-->
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
			 
				<div class="form-group">
				    <label><h2>To :</h2> </label>
				    <select class="form-control" name="companyName" id="companyName" required>
						<option value="">No Select</option>
 
				    	<?php foreach($id_client as $row):?>
				    	<option value="<?php echo $row->id_client;?>"><?php echo $row->Name;?></option>
				    	<?php endforeach;?>
				    </select>
				</div>

			 
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<table class="table table-bordered table-hover" id="invoiceItem">	
						<tr>
							<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
							<th width="5%">Item No</th>
							<th width="38%">Item Name</th>
							<th width="15%">Quantity</th>
							<th width="15%">Price</th>	
							<th width="15%">Taxes</th>								
							
							<th width="30%">Total</th>
						</tr>							
						<tr>
							<td><input class="itemRow" type="checkbox"></td>
							<td><input type="text" name="productCode[]" id="productCode_1" class="form-control" autocomplete="off"></td>

					<td>
				<div class="form-group">

				<script> 
				// obtenemos el array de valores mediante la conversion a json del
    			// array de php
				var arrayJS=  <?php echo json_encode($product);?>;
  
				var product_list = [];
				   // Mostramos los valores del array
				  // document.write(arrayJS[0].description)
   				 for(var i=0;i<arrayJS.length;i++)
   				 {
					product_list[i] = arrayJS[i];
	         	//	document.write("<br>"+product_list[i].description);
  			 	 }
				</script>
	 
 				    <select class="form-control" name="productName[]" id="productName_1"  > <required>
				    	<option value="">No Seleccionado</option>
				    	<?php foreach($product as $row):?>
						<option value="<?php echo $row->id_product;?>"><?php echo $row->description;?></option>
							
				    	<?php endforeach;?>
				    </select>
				</div>
						</td>
							
 							<td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
							<td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off" step="any"></td>
							<td><input type="number" name="taxes[]" id="taxes_1" class="form-control price" autocomplete="off" step="any"></td>
							
							<td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off" step="any"></td>
						</tr>						
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-13 col-sm-3 col-md-3 col-lg-3">
					<button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
					<button class="btn btn-success" id="addRows" type="button">+ Add More</button>
				</div>
			</div>
			<div class="row" >	
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
 
					 <div class="form-group">
					 <h3>Notes: </h3>
 
						<textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Your Notes"></textarea>
					</div>

				<div class="form-group">
				    <label><h3>Payment  :</h3> </label>
				    <select class="form-control" name="paid" id="paid" required>
						<option value="">No Select</option>
 
				    	<?php foreach($id_paid as $row):?>
				    	<option value="<?php echo $row->id_paid;?>"><?php echo $row->description_paid;?></option>
				    	<?php endforeach;?>
				    </select>
				</div>
					<br>
					<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">					<div class="panel-body">Invoice Panel</div>
					<div class="form-group">
 						<input data-loading-text="Saving Invoice..." type="submit"  name="invoice_btn" value="Save Invoice" class="btn btn-success submit_btn invoice-save-btm">						
						 <input type="button"  style="margin-left: 10px" class="btn btn-danger" value="Go Back (Do not Save!)"  onclick="window.location.href='/total/admin/Billing/Crud/'">
 
					</div>
 				</div>
						</div>
 				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<span class="form-inline">
						<div class="form-group">
							<label>Subtotal: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal"step="any">
							</div>
						</div>
						<div class="form-group" style="display: none">
							<label>Tax Rate: &nbsp;</label>
							<div class="input-group">
								<input value="" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Tax Rate" step="any">
								<div class="input-group-addon">%</div>
							</div>
						</div>
						<div class="form-group">
							<label>Tax Amount: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax Amount" step="any">
							</div>
						</div>							
						<div class="form-group">
							<label>Total: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total" step="any">
							</div>
						</div>
 						 
						<div class="form-group" style="display: none">
							<label>Amount Paid: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Amount Paid">
							</div>
						</div>
						<div class="form-group" style="display: none">
							<label>Amount Due: &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Amount Due" step="any">
							</div>
						</div>
					</span>
				</div>
			</div>
			<div id="loc"></div>    

			<div class="clearfix"></div>		      	
		</div>
	</form>			
</div>
</div>	
 
<!-- jQuery -->
</html>

 
	<script type="text/javascript">
	function print_invoice() {
  window.print();
}

	$( "#productName_1" ) .change(function () {    
		var  value_combo = "#productName_1";
   $('#productCode_1').val($(value_combo).val());
  value_id_combo = $(value_combo).val();
 
   for(var i in product_list)
   {	
	   
	  var newOption = product_list[i].description;
	  var price_product = product_list[i].price;
	  var id_product = product_list[i].id_product;
	  var taxes = product_list[i].tax_price;
	  var is_imported = product_list[i].is_imported;

		if (id_product == value_id_combo){ 
		
			
			$('#price_1').val(price_product);
		if (is_imported ==1){
			var value_imported = $('#taxes_i').val();
			var totaltaxes  =  parseFloat(taxes )+  parseFloat(value_imported);
			//console.log(parseFloat(totaltaxes));

			$('#taxes_1').val(parseFloat(totaltaxes));
		
		} else {
			$('#taxes_1').val(parseFloat(taxes));

		}

//		console.log(id_product);
		
		
		}
	 }

 
 });  


	</script>
