<?php
$page_slug = 'create-invoice';
?>
<?php
include 'includes/header.php';
include 'includes/side-nav.php';
?>

<script src="js/invoice.js"></script>

<?php

$lastinvoiceNumber = $invoice->currentInvoiceNumber();
foreach ($lastinvoiceNumber as $number) {
    $currentNumber = $number['order_id'] + 1;
}





?>



<div class="container-fluid">
    <h2 class="text-center py-3">Create New Envoice</h2>

    <?php

    // SUBMITTING 
    if (isset($_POST['email']) && isset($_POST['subTotal'])) {
        $invoice->saveInvoice($_POST, $currentNumber);
        // header("Location:invoice_list.php");
        echo '
        <div class="alert alert-success" role="alert">
            Invoice Created Successfully!  <a href="all-invoice.php">Check Invoice</a>
        </div>

    ';
    }
    ?>
    <!-- Form Starts  -->
    <form action="" method="post">

        <!-- ---Informations ---  -->

        <div class="row ">
            <div class="col md-6">
                <div class="input-group py-2">
                    <label class="input-group-text col-3" for="inputGroupSelect01">Customer</label>
                    <select name="" class="form-select" id="users">
                        <option selected>Choose...</option>
                        <?php
                        $users = $invoice->allCustomerList();
                        foreach ($users as $user) {
                        ?>
                            <option value="<?php echo $user['id'] ?>"><?php echo $user['name'] ?></option>
                        <?php

                        }
                        ?>

                    </select>
                    <input type="hidden" name="companyName" value="" id="company_name">
                    <input type="hidden" name="userId" value="<?php echo $_SESSION['userid']; ?>">
                </div>

                <div class="input-group py-2">
                    <div class="input-group-prepend col-3">
                        <span class="input-group-text" id="">Address</span>
                    </div>
                    <input type="text" id="address" class="form-control" name="address">
                </div>
                <div class="input-group py-2">
                    <div class="input-group-prepend col-3">
                        <span class="input-group-text" id="">Created by</span>
                    </div>
                    <input type="text" class="form-control" value="<?php echo $_SESSION['user']; ?>">
                </div>
                <div class="input-group py-2">
                    <div class="input-group-prepend col-3">
                        <span class="input-group-text" id="">Email</span>
                    </div>
                    <input type="text" id="email" class="form-control" name="email" required>
                </div>
                <div class="input-group py-2">
                    <div class="input-group-prepend col-3">
                        <span class="input-group-text" id="">Payment Term(Days)</span>
                    </div>
                    <input type="text" id="payment_terms" class="form-control">
                </div>
                <div class="input-group py-2">
                    <div class="input-group-prepend ">
                        <span class="input-group-text" id="">Srv Charge Agreed(%)</span>
                    </div>
                    <input type="text" id="service_charges" class="form-control">
                </div>
                <div class="form-check form-switch py-4">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Vat Included</label>
                </div>


            </div>
            <div class="col md-6">
                <div class="input-group py-2">
                    <div class="input-group-prepend col-3">
                        <span class="input-group-text" id="">Invoice Number</span>
                    </div>
                    <input type="text" class="form-control" value="<?php echo $currentNumber ?>">
                </div>
                <div class="input-group py-2">
                    <div class="input-group-prepend col-3">
                        <span class="input-group-text" id="">Invoice Date</span>
                    </div>
                    <input name="order_date" type="date" class="form-control">
                </div>
                <div class="input-group py-2">
                    <div class="input-group-prepend col-3">
                        <span class="input-group-text" id="">Due Date</span>
                    </div>
                    <input name="due_date" type="date" class="form-control">
                </div>
                <div class="input-group py-2">
                    <div class="input-group-prepend col-3">
                        <span class="input-group-text" id="">Penalty Interest(%)</span>
                    </div>
                    <input type="text" class="form-control">
                </div>
                <div class="input-group py-2">
                    <div class="input-group-prepend col-3">
                        <span class="input-group-text" id="">Invoice Reference</span>
                    </div>
                    <input name="ref" type="text" class="form-control">
                </div>
                <div class="input-group py-2">
                    <div class="input-group-prepend col-3">
                        <span class="input-group-text">Net Amount(EUR)</span>
                    </div>
                    <input type="text" class="form-control" id="netAmount" name="netAmount">
                </div>
                <div class="input-group py-2">
                    <div class="input-group-prepend col-3">
                        <span class="input-group-text">VAT Amount</span>
                    </div>
                    <input type="text" class="form-control" id="taxAmount" name="taxAmount">
                </div>
                <div class="input-group py-2">
                    <div class="input-group-prepend col-3">
                        <span class="input-group-text">Gross Total</span>
                    </div>
                    <input type="text" class="form-control" id="subTotal" name="subTotal" required>
                </div>
            </div>
        </div>

        <!-- ------  -->
        <div class="py-5"></div>
        <!-- Products  -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <table class="table table-bordered table-hover" id="invoiceItem">
                    <tr>
                        <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                        <th width="8%">SNoDate</th>
                        <th width="15%">Item Name</th>
                        <th width="15%">Discription</th>
                        <th width="10%">Quantity</th>
                        <th width="10%">UOM</th>
                        <th width="10%">Unit Price</th>
                        <th width="10%">Tax %</th>
                        <th width="10%">TAX Amount</th>
                        <th width="10%">Total Amount</th>
                    </tr>
                    <tr>
                        <td><input class="itemRow" type="checkbox"></td>
                        <td> <input type="date" name="date[]" id="sndate_1" class="form-control" autocomplete="off"></td>
                        <td><input type="text" name="productName[]" id="productName_1" class="form-control" autocomplete="off"></td>
                        <td><input type="text" name="productDisc[]" id="productDisc_1" class="form-control" autocomplete="off"></td>
                        <td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
                        <td> <select name="uom[]" id="uom_1" class="form-control">
                                <option value="PCS">PCS</option>
                                <option value="KG">KG</option>
                            </select> </td>
                        <td><input type="text" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>
                        <td><input type="text" name="tax[]" id="tax_1" class="form-control price" autocomplete="off"></td>
                        <td><input type="text" name="taxtot[]" id="taxtot_1" class="form-control price" autocomplete="off"></td>
                        <td><input type="text" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
                <button class="btn btn-success" id="addRows" type="button">+ Add More</button>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                <div class="form-group">
                    <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
                    <input data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" value="Save Invoice" class="btn col-12 btn-lg btn-success submit_btn invoice-save-btm">
                </div>

            </div>
        </div>
        <!-- ------ -->
        <div class="py-5"></div>



    </form>
</div>














<?php

include 'includes/footer.php';
?>