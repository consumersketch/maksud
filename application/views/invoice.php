<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Filter Data</title>
	<!-- Include CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>

<div class="container">
	<!-- Form Start-->
	<?php
		$attributes = array('id' => 'frmInvoice');
		echo form_open('invoice/result', $attributes);
	?>	
	<div class="row">
		<div class="col-sm-12"><h1>Filter Data</h1></div>
	</div>

	<hr>
	
	<div class="row">
		<div class="col-sm-4">
			<div class="form-group">
			    <?php 
			    	echo form_label('Choose Client'); 
			    	echo form_dropdown('client', $clients, '', 'class="form-control"');
			    ?>
		  	</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
			    <?php 
			    	echo form_label('Date'); 
			    	echo form_dropdown('date', $dates, '', 'class="form-control"');
			    ?>
		  	</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
			    <?php 
			    	echo form_label('Product'); 
			    	echo form_dropdown('product', $products, '', 'class="form-control"');
			    ?>
		  	</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12 text-right">
			<?php echo form_button(array(
			    'id' => 'submit',
			    'type' => 'button',
			    'content' => 'Submit',
			    'class' => 'btn btn-info'
			)); ?>
		</div>
	</div>
	<?php echo form_close(); ?>
	<!-- Form End-->

	<hr>
	<!-- Output Result-->
	<div class="row">
		<div class="table-responsive">
			<table class="table table-bordered">
		    	<thead>
	    			<th>Invoice Number</th>
	    			<th>Invoice Date</th>
	    			<th>Product</th>
	    			<th>Qty</th>
	    			<th>Price</th>
	    			<th>Total</th>
		    	</thead>
		    	<tbody id="result">
		    		<tr><td class="text-center" colspan="6">No Record Found</td></tr>
		    	</tbody>
		  	</table>
		</div>
	</div>
	
</div>
<!-- Include JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="assets/js/invoice.js"></script>
</body>
</html>