<?php
class Invoice{
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "php_invoice";   
	private $invoiceUserTable = 'invoice_user';	
    private $invoiceOrderTable = 'invoice_order';
	private $invoiceOrderItemTable = 'invoice_order_item';
	private $customerTable = 'customer';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}
	public function loginUsers($email, $password){
		$sqlQuery = "
			SELECT id, email, first_name, last_name, address, mobile 
			FROM ".$this->invoiceUserTable." 
			WHERE email='".$email."' AND password='".$password."'";
        return  $this->getData($sqlQuery);
	}	
	public function checkLoggedIn(){
		if(!$_SESSION['userid']) {
			
			?>
			<script>window.location.replace("login.php");</script>
			<?php 
		}
	}	
	
	


	// --------------  SAVE INVOICE ---------------


	public function saveInvoice($POST,$currentNumber) {		
		$sqlInsert = "
			INSERT INTO ".$this->invoiceOrderTable."(user_id, order_receiver_name, order_receiver_address, order_total_before_tax, order_total_tax,order_due_date, order_date, inv_ref, order_total_after_tax) 
			VALUES ('".$POST['userId']."', '".$POST['companyName']."', '".$POST['address']."', '".$POST['netAmount']."', '".$POST['taxAmount']."','".$POST['due_date']."','".$POST['order_date']."','".$POST['ref']."', '".$POST['subTotal']."')";		
		mysqli_query($this->dbConnect, $sqlInsert);


		$lastInsertId = mysqli_insert_id($this->dbConnect);
		for ($i = 0; $i < count($POST['productName']); $i++) {
			$sqlInsertItem = "
			INSERT INTO ".$this->invoiceOrderItemTable."(order_id, item_disc, item_name, order_item_quantity,uom, order_item_price,tax_percent,tax_amount, order_item_final_amount,date) 
			VALUES ('".$currentNumber."', '".$POST['productDisc'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."', '".$POST['uom'][$i]."', '".$POST['price'][$i]."','".$POST['tax'][$i]."', '".$POST['taxtot'][$i]."',  '".$POST['total'][$i]."',  '".$POST['date'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);
		}   
		
		// echo $currentNumber;
	}	


/*
	public function updateInvoice($POST) {
		if($POST['invoiceId']) {	
			$sqlInsert = "
				UPDATE ".$this->invoiceOrderTable." 
				SET order_receiver_name = '".$POST['companyName']."', order_receiver_address= '".$POST['address']."', order_total_before_tax = '".$POST['subTotal']."', order_total_tax = '".$POST['taxAmount']."', order_tax_per = '".$POST['taxRate']."', order_total_after_tax = '".$POST['totalAftertax']."', order_amount_paid = '".$POST['amountPaid']."', order_total_amount_due = '".$POST['amountDue']."', note = '".$POST['notes']."' 
				WHERE user_id = '".$POST['userId']."' AND order_id = '".$POST['invoiceId']."'";		
			mysqli_query($this->dbConnect, $sqlInsert);	
		}		
		$this->deleteInvoiceItems($POST['invoiceId']);
		for ($i = 0; $i < count($POST['productCode']); $i++) {			
			$sqlInsertItem = "
				INSERT INTO ".$this->invoiceOrderItemTable."(order_id, item_disc, item_name, order_item_quantity, order_item_price, order_item_final_amount) 
				VALUES ('".$POST['invoiceId']."', '".$POST['productCode'][$i]."', '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['total'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);			
		}       	
	}	

	*/
	public function getInvoiceList(){
		$sqlQuery = "
			SELECT * FROM ".$this->invoiceOrderTable." 
			WHERE user_id = '".$_SESSION['userid']."'";
		return  $this->getData($sqlQuery);
	}	
	public function getInvoice($invoiceId){
		$sqlQuery = "
			SELECT * FROM ".$this->invoiceOrderTable." 
			WHERE user_id = '".$_SESSION['userid']."' AND order_id = '$invoiceId'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}	
	public function getInvoiceItems($invoiceId){
		$sqlQuery = "
			SELECT * FROM ".$this->invoiceOrderItemTable." 
			WHERE order_id = '$invoiceId'";
		return  $this->getData($sqlQuery);	
	}


	// ---------------- DELETING PROCESS -------------
	public function deleteInvoiceItems($invoiceId){
		$sqlQuery = "
			DELETE FROM ".$this->invoiceOrderItemTable." 
			WHERE order_id = '".$invoiceId."'";
		mysqli_query($this->dbConnect, $sqlQuery);				
	}
	public function deleteInvoice($invoiceId){
		$sqlQuery = "
			DELETE FROM ".$this->invoiceOrderTable." 
			WHERE order_id = '".$invoiceId."'";
		mysqli_query($this->dbConnect, $sqlQuery);	
		$this->deleteInvoiceItems($invoiceId);	
		return 1;
	}



	// ---------------------------------------AFTER THE HELL -------------------------------------

	public function allCustomerList (){ 
		$sqlQuery = "SELECT * FROM ".$this->customerTable."";
		return  $this->getData($sqlQuery);

	}
	public function customerData ($c_id){ 
		$sqlQuery = "SELECT * FROM ".$this->customerTable." WHERE `id` = $c_id";
		return  $this->getData($sqlQuery);

	}

	public function currentInvoiceNumber(){
		$sqlQuery = "SELECT * FROM ".$this->invoiceOrderTable." ORDER BY order_id DESC LIMIT 1";
		return  $this->getData($sqlQuery);
	}
}
?>