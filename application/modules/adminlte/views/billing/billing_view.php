<!doctype html>
<html>
<head>
    <meta charset="utf-8">
     
    <style>
    .invoice-box {
        max-width: 900px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        width: 1800px;
	    height: 100%;
        padding-bottom: 40px;
 
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 2px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 900px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
          <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src=<?php echo $company_path.$company_url; ?> style="width:100%; max-width:300px;">
                            </td>
                            
                            <td>
                                Invoice #: <?php echo $id_billing; ?> <br> 
                                Created: <?php echo $fecha; ?><br> 
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <h3> From: </h3>
                                <?php echo $company_name; ?><br>
                                <?php echo $company_Address; ?><br>
                                <?php echo $company_phone; ?><br>
                                <?php echo $company_email; ?><br>                             
  
                            </td>
                            
                            <td>
                                <h3> To : </h3>
                                <?php echo $name;?> <br>
                                <?php echo $Address;?><br>
                                <?php echo $email;?><br>
                                <?php echo $Phone;?><br>
 
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Payment 
                </td>
                
                <td>
                <?php echo $paid;?><br>
  
                </td>
            </tr>
            
                  
    

            <tr class="heading">
                    <td>
                     Item
                </td>
                <td>
            Qty
                </td>
                <td>
                    Tax
                </td>
                <td>
                    Price
                </td>
                <td>
                    Total
                </td>
            </tr>
                      <?php
  $i=0;
                for($ar=0; $ar<$total_items; $ar++)
                {
                    $i = $i+1;
                    echo "<tr class='item'>";
                    $descri = strval('$descripcion_'.$i)   ;             //saco el valor de cada elemento
                    $price = strval('$items_price_'.$i)   ;     
                    $qty = strval('$qty_'.$i)   ;     
                    $tax = strval('$tax_'.$i)   ;     
                    $total_item = 0;
                    echo "<td name= descripcion_".$i.">";
                     echo eval('echo '. $descri . ';');

                     echo "</td>";
                     echo "<td name= qty_$i id= qty_".$i . ">";

                     echo eval('echo '. $qty . ';');

   
                    echo "</td>";
                    echo "<td>";
                    echo eval('echo '. $tax . ';');
                    echo "</td>";

                    echo "<td  name= precio_$i id= precio_".$i . ">";
                    echo eval('echo '. $price . ';');

    
                    echo "</td>";
 
 
                      echo "<td name= total_item_$i id= total_item_".$i . ">";
                    
                    echo $total_item;
 
              //      echo $items_price_.$i;
                    echo "</td>";
                    echo "</tr>";


                }

            ?>    
                    
                
              
      
            
            <tr class="total">
                 <td>
                   SubTotal: 
                   <?php echo $total_taxes;?><br>
                </td>
                 <td>         
 
                   Total: 
                   <?php echo $total_billing;?>
                 </td>
            </tr>

            <tr class="heading">
                <td>
                    Notes: 
                </td>
                
                <td>
                <?php echo $notes;?><br>
  
                </td>
            </tr>
            
        </table>
    </div>

    <div align="center">
                <input type="button"  style="margin-left: 10px" class="btn btn-danger" value="Go Back"  onclick="window.location.href='/total/admin/Billing/Crud/'">

            </div>
            
 
</body>
</html>
<script>
$(document).ready(function() {

    var id = 0; 

	$("[id^='precio_']").each(function() {
    id = id+1;
        /*	var id = $(this).attr('id');
		id = id.replace("price_",'');
		var price = $('#price_'+id).val();
		var quantity  = $('#quantity_'+id).val();
	 
         */	
        
         var price = (document.getElementById ( "precio_"+id ).innerText);
         var qty =  (document.getElementById ( "qty_"+id ).innerText);
         var total_price = price * qty;
         document.getElementById("total_item_"+id).innerHTML =  Math.round(total_price * 100) / 100;
 

    });
  });
      
      
</script>
