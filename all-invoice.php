<?php
$page_slug = 'all-invoice';
?>

<?php
include 'includes/header.php';
include 'includes/side-nav.php';

?>








<h2 class="p-3 text-center">All Invoices</h2>
<div class="table-responsive">
  <table class="table  table-sm">
    <thead  class="thead-dark">
      <tr>
        <th scope="col">Invoice #ID</th>
        <th scope="col">Invoice Created at</th>
        <th scope="col">Customer Name</th>
        <th scope="col">Total Amount</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $invoiceList = $invoice->getInvoiceList();
      foreach ($invoiceList as $invoiceDetails) {
        $invoiceDate = date("d M, Y", strtotime($invoiceDetails["order_date"]));
        echo '
              <tr>
                <td>#' . $invoiceDetails["order_id"] . '</td>
                <td>' . $invoiceDate . '</td>
                <td>' . $invoiceDetails["order_receiver_name"] . '</td>
                <td>' . $invoiceDetails["order_total_after_tax"] . ' €</td>
                <td>
                    <a href="print_invoice.php?invoice_id=' . $invoiceDetails["order_id"] . '" title="Print Invoice" class="btn btn-success m-2">Print</a>
                 
                    <a href="action.php?delete_invoice='.$invoiceDetails["order_id"].'" class="deleteInvoice btn btn-danger m-2"  title="Delete Invoice">Delete</a>
                </td>
               
              </tr>
            ';
      }
      ?>
         <!-- <a href="edit_invoice.php?update_id=' . $invoiceDetails["order_id"] . '"  title="Edit Invoice" class="btn btn-warning m-2">Edit</a> -->
    </tbody>



  </table>
</div>















<?php

include 'includes/footer.php';
?>