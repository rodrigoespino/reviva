<div class="row">

 
 
	<div class="col-md-4">
		<?php echo modules::run('adminlte/widget/small_box', 'yellow', $count['product'], 'Product s', 'fa  fa-product-hunt	', 'product/crud'); ?>
	</div>
	<div class="col-md-4">
		<?php echo modules::run('adminlte/widget/small_box', 'green', $count['client'], 'Client s', 'fa fa-users', 'client/crud'); ?>
	</div>
	<div class="col-md-4">
		<?php echo modules::run('adminlte/widget/small_box', 'red', $count['invoices'], 'Invoices', 'fa fa-credit-card', 'billing/crud'); ?>
	</div>
	
</div>
