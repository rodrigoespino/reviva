 $(document).ready(function(){
 
	$(document).on('click', '#checkAll', function() {          	
		$(".itemRow").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow', function() {  	
		if ($('.itemRow:checked').length == $('.itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});  
	var count = $(".itemRow").length;
	$(document).on('click', '#addRows', function() { 
		count++;
		var htmlRows = '';
		htmlRows += '<tr>';

 
 
	htmlRows += '<td><input class="itemRow" type="checkbox"></td>';          
		 htmlRows += '<td><input type="text" name="productCode[]" id="productCode_'+count+'" class="form-control" autocomplete="off"></td>';  
	//	 htmlRows += '<td><select class="form-control" name="productName[]"  id="productName_'+count+'  "<required>';
	//	 htmlRows +='<td>  <select name="combo" id="combo"  <option value="audi">Audi</option> </select> </td>'
		 
	htmlRows += '<td>	<select class="form-control" name="productName" id="productName_'+count+'" onchange="ShowSelected('+count+');"> <option> No Selected </option></select> </td>';
 	
	//<option value='+product_list[i].description+'> '+product_list[i].description+ '  </option>     </select>  </td>';

	
	 
	//	htmlRows += '<td><input type="text" name="productName[]" id="productName_'+count+'" class="form-control" autocomplete="off"></td>';	
		htmlRows += '<td><input type="number" name="quantity[]" id="quantity_'+count+'" class="form-control quantity"  autocomplete="off"></td>';   		
		htmlRows += '<td><input type="number" name="price[]" id="price_'+count+'" class="form-control price" step = "any" autocomplete="off"></td>';		 
		htmlRows += '<td><input type="number" name="taxes[]" id="taxes_'+count+'" class="form-control price" autocomplete="off"></td>';		 

		htmlRows += '<td><input type="number" name="total[]" id="total_'+count+'" class="form-control total" step = "any" autocomplete="off"></td>';          
		htmlRows += '</tr>';
		$('#invoiceItem').append(htmlRows);
 
		add_combo(count);

	}); 
 
	$(document).on('click', '#removeRows', function(){
		$(".itemRow:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll').prop('checked', false);
		calculateTotal();
	});		
	$(document).on('blur', "[id^=quantity_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "[id^=price_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "#taxRate", function(){		
		calculateTotal();
	});	
	$(document).on('blur', "#amountPaid", function(){
		var amountPaid = $(this).val();
		var totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {
			$('#amountDue').val(totalAftertax);
		}	
	});	
	$(document).on('click', '.deleteInvoice', function(){
		var id = $(this).attr("id");
		if(confirm("Are you sure you want to remove this?")){
			$.ajax({
				url:"action.php",
				method:"POST",
				dataType: "json",
				data:{id:id, action:'delete_invoice'},				
				success:function(response) {
					if(response.status == 1) {
						$('#'+id).closest("tr").remove();
					}
				}
			});
		} else {
			return false;
		}
	});
});	
function ShowSelected(id_combo){
   var  value_combo = "#productName_" + id_combo;
   $('#productCode_'+id_combo).val($(value_combo).val());
  value_id_combo = $(value_combo).val();
 
   for(var i in product_list)
   {	
	   
	  var newOption = product_list[i].description;
	  var price_product = product_list[i].price;
	  var id_product = product_list[i].id_product;
	  var taxes = product_list[i].tax_price;
	  var is_imported = product_list[i].is_imported;

		if (id_product == value_id_combo){ 
		
			
			$('#price_'+id_combo).val(price_product);
		if (is_imported ==1){
			var value_imported = $('#taxes_i').val();
			var totaltaxes  =  parseFloat(taxes )+  parseFloat(value_imported);
//			console.log(parseFloat(totaltaxes));

			$('#taxes_'+id_combo).val(parseFloat(totaltaxes));
		
		} else {
			$('#taxes_'+id_combo).val(taxes);

		}

//		console.log(id_product);
		
		
		}
	 }
	
 

}
function add_combo(number_id){
 
 
   var id_nuevo = "#productName_"+number_id;
  	  var id_price = "#price_"+number_id;

 		  for(var i in product_list)
	  {
		 var newOption = product_list[i].description;
		 var price_product = product_list[i].price;
		 var id_product = product_list[i].id_product;
       	$(id_nuevo).append("<option value=" + id_product + ">" + newOption + "</option>");
	   	$(id_price).val(price_product);
			$('#amountDue').val(totalAftertax);

		}
	   
	   
 
 };


function calculateTotal(){
	var totalAmount = 0; 
	var totalAmount_notaxes = 0;
	var totalTaxes = 0; 

	$("[id^='price_']").each(function() {
		var id = $(this).attr('id');
		id = id.replace("price_",'');
		var price = $('#price_'+id).val();
		var taxes_product = $('#taxes_'+id).val();
		var total_tax ;
		var quantity  = $('#quantity_'+id).val();
		if(!quantity) {
			quantity = 1;
		}
		//var total_tax;
		var subtotal_product = redondear(price*quantity,2);
/*
		var taxAmount_product = redondear(parseFloat(subtotal_product)*parseFloat(taxes_product)/100,2);
		var total_tax = redondear(parseFloat(taxAmount_product),2);
		var total = redondear(parseFloat(subtotal_product)+parseFloat(taxAmount_product),2);
		var total_notaxes = redondear(parseFloat(subtotal_product),2);
  */

  
 var taxAmount_product = redondear(subtotal_product*taxes_product/100,2);
 var total_tax = redondear(taxAmount_product,2);
 var total = redondear(subtotal_product+taxAmount_product,2);
 var total_notaxes = redondear(subtotal_product,2);

		//var total_round= Math.round(total*100)/100;
var total_round  = redondear(total,2);
		$('#total_'+id).val(total_round);
  
		  totalAmount += Math.round(total*100)/100; //Rounded			
		  totalAmount_notaxes += Math.round(total_notaxes*100)/100; //Rounded			
		
		  totalTaxes += Math.round(total_tax*100)/100; //Rounded			
 	});
//		$('#subTotal').val(parseFloat(totalAmount));	
	$('#subTotal').val(parseFloat(totalAmount_notaxes));	

	var taxRate = $("#taxRate").val();
	var subTotal = $('#subTotal').val();	
	if(subTotal) {
		var taxAmount = subTotal*taxRate/100;
		$('#taxAmount').val(totalTaxes);
	//	$('#taxAmount').val(taxAmount_product);
		
		subTotal = parseFloat(subTotal)+parseFloat(taxAmount);
		$('#totalAftertax').val(totalAmount);		
		var amountPaid = $('#amountPaid').val();
		var totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {		
			$('#amountDue').val(subTotal);
		}
	}
	function redondear(numero, digitos){
		let base = Math.pow(10, digitos);
		let entero = redondearLejosDeCero(numero * base);
		return entero / base;
	}
	function redondearLejosDeCero(numero){
		return Math.sign(numero) * Math.floor(Math.abs(numero) + 0.5);
	}
}

 