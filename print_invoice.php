<?php
session_start();
include 'Classes/Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_GET['invoice_id']) && $_GET['invoice_id']) {
	echo $_GET['invoice_id'];
	$invoiceValues = $invoice->getInvoice($_GET['invoice_id']);		
	$invoiceItems = $invoice->getInvoiceItems($_GET['invoice_id']);		
}
$invoiceDate = date("d M, Y", strtotime($invoiceValues['order_date']));
$dueDate = date("d M, Y", strtotime($invoiceValues['order_due_date']));
$output = '';
$output .= '<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<td colspan="2" align="center" style="font-size:18px"><b>Invoice</b></td>
	</tr>
	<tr>
	<td colspan="2">
	<table width="100%" cellpadding="5">
	<tr>
	<td width="65%">
	To,<br />
	<b>RECEIVER (BILL TO)</b><br />
	Customer Name :<b> '.$invoiceValues['order_receiver_name'].'</b><br /> 
	Billing Address : '.$invoiceValues['order_receiver_address'].'<br />
	
	</td>
	<td width="35%">         
	Invoice No. : '.$invoiceValues['order_id'].'<br />
	Invoice Date : '.$invoiceDate.'<br />
	<b>Due Date : '.$dueDate.' </b><br />
	</td>
	</tr>
	</table>
	<br />
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<th align="left">Sr No.</th>
	<th align="left">date</th>
	<th align="left">Item Name</th>
	<th align="left">Item Disc</th>
	<th align="left">Quantity</th>
	<th align="left">UOM</th>
	<th align="left">Unit Price</th>
	<th align="left">Tax</th>
	<th align="left">Tax Amount</th>
	<th align="left">Actual Amount</th> 
	</tr>';
$count = 0;   
foreach($invoiceItems as $invoiceItem){
	$count++;
	$output .= '
	<tr>
	<td align="left">'.$count.'</td>
	<td align="left">'.$invoiceItem["date"].'</td>
	<td align="left">'.$invoiceItem["item_name"].'</td>
	<td align="left">'.$invoiceItem["item_disc"].'</td>
	<td align="left">'.$invoiceItem["order_item_quantity"].'</td>
	<td align="left">'.$invoiceItem["uom"].'</td>
	<td align="left">'.$invoiceItem["order_item_price"].'</td>
	<td align="left">'.$invoiceItem["tax_percent"].'%</td>
	<td align="left">'.$invoiceItem["tax_amount"].'</td>
	<td align="left">'.$invoiceItem["order_item_final_amount"].'</td>   
	</tr>';
}
$output .= '
	<tr>
		<td align="right" colspan="9">Net Amount</td>
		<td align="left">'.$invoiceValues['order_total_before_tax'].'</td>
	</tr>
	<tr>
		<td align="right" colspan="9">VAT Amount: </td>	
		<td align="left">'.$invoiceValues['order_total_tax'].'</td>
	</tr>
	<tr>
		<td align="right" colspan="9"><b>Gross Total: </b></td>
		<td align="left"><b> '.$invoiceValues['order_total_after_tax'].'</b></td>
	</tr>

	';
$output .= '
	</table>
	</td>
	</tr>
	</table>';
// create pdf of invoice	
$invoiceFileName = 'Invoice-'.$invoiceValues['order_id'].'.pdf';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
?>   
   