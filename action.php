<?php
session_start();
include 'Classes/Invoice.php';
$invoice = new Invoice();
if ($_REQUEST['delete_invoice'] ) {
    $invoice->deleteInvoice($_REQUEST['delete_invoice']);
    header("Location:all-invoice.php");
 
}

if (isset($_REQUEST['action'])) {
    # code...
    if ($_GET['action'] == 'logout') {
        session_unset();
        session_destroy();
        header("Location:login.php");
    }
}


