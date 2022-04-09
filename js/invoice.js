

// --- ROW APPENDS ---

$(document).ready(function () {
	$(document).on('click', '#checkAll', function () {
		$(".itemRow").prop("checked", this.checked);
	});
	$(document).on('click', '.itemRow', function () {
		if ($('.itemRow:checked').length == $('.itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});
	var count = $(".itemRow").length;
	$(document).on('click', '#addRows', function () {
		count++;
		var htmlRows = '';
		htmlRows += '<tr>';
		htmlRows += '<td><input class="itemRow" type="checkbox"></td>';
		htmlRows += '<td> <input type="date" name="date[]" id="sndate_' + count + '" class="form-control" autocomplete="off"></td>'
		htmlRows += '<td><input type="text" name="productName[]" id="productName_' + count + '" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><input type="text" name="productDisc[]" id="productDisc_' + count + '" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><input type="number" name="quantity[]" id="quantity_' + count + '" class="form-control quantity" autocomplete="off"></td>';
		htmlRows += '<td> <select name="uom[]" id="uom_' + count + '" class="form-control"> <option value="PCS">PCS</option> <option value="KG">KG</option> </select> </td>';
		htmlRows += '<td><input type="text" name="price[]" id="price_' + count + '" class="form-control price" autocomplete="off"></td>';
		htmlRows += '<td><input type="text" name="tax[]" id="tax_' + count + '" class="form-control price" autocomplete="off"></td>';
		htmlRows += '<td><input type="text" name="taxtot[]" id="taxtot_' + count + '" class="form-control price" autocomplete="off"></td>';
		htmlRows += '<td><input type="text" name="total[]" id="total_' + count + '" class="form-control total" autocomplete="off"></td>';
		htmlRows += '</tr>';


		$('#invoiceItem').append(htmlRows);
	});
	$(document).on('click', '#removeRows', function () {
		$(".itemRow:checked").each(function () {
			$(this).closest('tr').remove();
		});
		$('#checkAll').prop('checked', false);

		calculateTotal();
	});


	// Nicher field gula te foccus sorale calculate function call korbe every time e 

	$(document).on('keyup', "[id^=quantity_]", function () {
		calculateTotal();
	});
	$(document).on('keyup', "[id^=price_]", function () {
		calculateTotal();
	});
	$(document).on('keyup', "[id^=tax]", function () {
		calculateTotal();
	});




	// -------------------------  


	$(document).on('blur', "#amountPaid", function () {
		var amountPaid = $(this).val();
		var totalAftertax = $('#totalAftertax').val();
		if (amountPaid && totalAftertax) {
			totalAftertax = totalAftertax - amountPaid;
			$('#amountDue').val(totalAftertax);
		} else {
			$('#amountDue').val(totalAftertax);
		}
	});
	$(document).on('click', '.deleteInvoice', function () {
		var id = $(this).attr("id");
		if (confirm("Are you sure you want to remove this?")) {
			$.ajax({
				url: "action.php",
				method: "POST",
				dataType: "json",
				data: { id: id, action: 'delete_invoice' },
				success: function (response) {
					if (response.status == 1) {
						$('#' + id).closest("tr").remove();
					}
				}
			});
		} else {
			return false;
		}
	});
});





// ---- CALCULATION ------


//----------- INDIVIDUAL  PRODUCT ROW TOTAL ------

function calculateTotal() {
	var totalAmount = 0;
	var totalTax = 0;
	var netAmount = 0;

	$("[id^='quantity_']").each(function () {
		var id = $(this).attr('id');
		id = id.replace("quantity_", '');
		// ------ 

		// ======= GETTING QUANTITY ========== 
		var quantity = $('#quantity_' + id).val();
		if (!quantity) {
			quantity = 1;
		}
		// ===========GETTING PRICE=========
		let eachPrice = $('#price_' + id).val();
		if (!eachPrice) {
			eachPrice = 0;
		}
		// ======GETTING TAX-RATE =======
		var taxRate = $('#tax_' + id).val();
		var netTotal = quantity * eachPrice;
		var taxAmount = (quantity * eachPrice) * taxRate / 100;
		console.log(typeof taxAmount);
		let totAmount = (quantity * eachPrice) + taxAmount;
		$('#total_' + id).val(parseFloat(totAmount));

		// global update 

		totalAmount += totAmount;
		totalTax += taxAmount;
		netAmount += netTotal;


	});


// -----------INDIVIDUAL TAX CALCULATION------------

	$("[id^='tax_']").each(function () {
		var id = $(this).attr('id');
		id = id.replace("tax_", '');
		// ---- 
		var taxRate = $('#tax_' + id).val();

		// Getting taxless total amount 
		let eachQty = $('#quantity_' + id).val();
		let eachPrice = $('#price_' + id).val();
		var totalprice = eachQty * eachPrice;

		//if there total price available then calculate tax
		if (totalprice) {
			var taxAmount = totalprice * taxRate / 100;
		}
		//put tax value into field
		$('#taxtot_' + id).val(parseFloat(taxAmount));
		// totalAmount += total;
	});



	// -------------TOTAL HISAB NIKASH ------------


	$('#subTotal').val(parseFloat(totalAmount));
	$('#taxAmount').val(parseFloat(totalTax));
	$('#netAmount').val(parseFloat(netAmount));



}







// ===================  HISAB NIKASH SESH =====================


// -------------GET USER DATA ----------
$(document).ready(function () {
	$('#users').on('change', function () {
		var user_id = $(this).val();
		if (user_id) {
			$.ajax({
				type: 'POST',
				url: 'ajax_userdataload.php',
				data: 'user_id=' + user_id,
				success: function (data) {
					let pdata = JSON.parse(data);
					console.log(pdata);
					// Distributing to field 
					$('#address').val(pdata[0].address);
					$('#email').val(pdata[0].email)
					$('#service_charges').val(pdata[0].serv_charge)
					$('#payment_terms').val(pdata[0].payment_terms)
					$('#company_name').val(pdata[0].name)
				}
			});
		}
	});

});




