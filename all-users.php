<?php
$page_slug = 'all-user';
?>

<?php
include 'includes/header.php';
include 'includes/side-nav.php';

?>



<h2 class="p-3 text-center">All Customers</h2>
<div class="table-responsive">
    <table class="table  table-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Customer #ID</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Email Address</th>
                <th scope="col"> Address</th>
                <th scope="col">Service Charge Agred</th>
                <th scope="col">Payment Terms</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $users = $invoice->allCustomerList();
            foreach ($users as $user) {
            ?>
                <tr>
                    <td>#<?php echo $user['id'] ?></td>
                    <td><?php echo $user['name'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['address'] ?></td>
                    <td><?php echo $user['serv_charge'] ?> %</td>
                    <td><?php echo $user['payment_terms'] ?> Days</td>
                </tr>

            <?php

            }
            ?>
            <!-- <a href="edit_invoice.php?update_id=' . $invoiceDetails["order_id"] . '"  title="Edit Invoice" class="btn btn-warning m-2">Edit</a> -->
        </tbody>



    </table>
</div>















<?php

include 'includes/footer.php';
?>