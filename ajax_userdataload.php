<?php
include 'Classes/Invoice.php';
$invoice = new Invoice();
// echo $_REQUEST['user_id'];

if (!empty($_REQUEST["user_id"])) {
    // Fetch customer data based on the specific id
    
    $get_user = $invoice->customerData($_REQUEST['user_id']);
    echo json_encode($get_user);
  
    // foreach ($get_user as $user) {
    //     echo $user['address'];
    // }

}
