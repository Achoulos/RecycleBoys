<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Full Name: <input type="text" name="fname" id="fname">
  Customer Id: <input type="text" name="custid" id="custid">
  Email	: <input type="text" name="email" id="email">
  <input type="submit">
 </form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # collect input data
     $custName = $_POST['fname'];
     $custId = $_POST['custid'];
     $email = $_POST['email'];
     if (!empty($custName) && !empty($custId) && !empty($email)){
	$custName = prepareInput($custName);
	$custId = prepareInput($custId);
    $email = prepareInput($email);

	if (checkCustomerName($custName) && checkCustomerId($custId) && checkEmail($email)){
		echo "$custName, $custId,$email <br>"; 		
	}
	else
		echo "Invalid input <br>"; 
     }
} 
function prepareInput($inputData){
	$inputData = trim($inputData);
 	$inputData = stripslashes($inputData);
  	$inputData  = htmlspecialchars($inputData);
  	return $inputData;
}
function checkCustomerName($custName){
	if (preg_match('/^[A-Za-z][A-Za-z0-9]{3,15}$/',$custName)){
		echo "Name ok <br>";
		return true;
	}
	else {
		echo "Invalid Name <br>";
		return false;
	}
}
function checkCustomerId($customerId){
	if (preg_match('/^[A-Za-z][0-9]{4}$/',$customerId)){		
		echo "Id ok <br>";
		return true;
	}
	else {
		echo "Invalid Id <br>";
		return false;
	}
}
function checkEmail($email){

	if (preg_match('/^\S+@\S+\.\S+$/',$email)){
		echo "email ok <br>";
		return true;
	}
	else{
		echo "Invalid email <br>";
		return false;
	}
}

?>