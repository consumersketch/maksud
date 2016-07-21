$(function() {

	/**
	 * Change event of client
	 *
	 */
	$(document).on('change', 'select[name="client"]', function(){
		// Reset result data
		$('#result').html('<tr><td class="text-center" colspan="6">No Result Found</td></tr>');

		var dateRange = $('select[name="date"]').val();
		// Ajax call to get products for clients
		$.ajax({
			method: "POST",
		  	url: "invoice/getProducts",
		  	data: {
		  		'client': $(this).val(),
		  		'date': dateRange
		  	},
		  	beforeSend: function() {
			    $('select[name="product"]').html('');
		  	},
		  	success: function(result) {
		  		result = $.parseJSON(result);
		  		$.each(result.products, function(key, value) {
				    $('select[name="product"]').append($("<option/>", {
				        value: key,
				        text: value
				    }));
				});
		  	}
		});
	});

	/**
	 * Click event of submit button
	 *
	 */
	$(document).on('click', '#submit', function(){

		var client = $('select[name="client"]').val();

		if(client) {
			
			var dateRange = $('select[name="date"]').val();
			var product = $('select[name="product"]').val();

			// Ajax call to get filtered result
			$.ajax({
				method: "POST",
			  	url: "invoice/result",
			  	data: {
			  		'client': client,
			  		'date': dateRange,
			  		'product': product
			  	},
			  	beforeSend: function() {
				    $('#result').html('<tr><td class="text-center" colspan="6">Loading...</td></tr>');
			  	},
			  	success: function(result) {
			  		result = $.parseJSON(result);
		  			if(result.data) {
		  				var html = '';
			  			$.each(result.data, function(key, value) {
							html += '<tr><td>'+value.invoice_num+'</td><td>'+value.invoice_date+'</td><td>'+value.product_description+'</td><td>'+value.qty+'</td><td>'+value.price+'</td><td>'+(value.price * value.qty).toFixed(2)+'</td></tr>';
						});
						$('#result').html(html);	
		  			} else {
		  				$('#result').html('<tr><td class="text-center" colspan="6">No Result Found</td></tr>');			
		  			}

			  	}
			});	
		} else {
			$('#result').html('<tr><td class="text-center" colspan="6">No Result Found</td></tr>');
		}
		
	});
	
});