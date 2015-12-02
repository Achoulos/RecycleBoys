<?php 
	session_start();// Start the session before you write your HTML page
?>
<?php include ("../general/header.php");
?>
<?php
function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}
// If they're already logged in, they don't need to fill this out. 
if (isset($_SESSION['memberId'])) {
	 redirect("viewCart.php?checkout");
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Address: <input type="text" name="address" id="address">
  Email: <input type="text" name="email" id="email">
  Phone: <input type="text" name="phone" id="phone">
  <input type="submit">
 </form>

<p>
	<a href="catalog.php">Back</a>
</p>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # collect input data
     $address = $_POST['address'];
     $email = $_POST['email'];
     $phone = $_POST['phone'];
     if (!empty($address) && !empty($phone) && !empty($email)){
		$address = prepareInput($address);
		$email = prepareInput($email);
	    $phone = prepareInput($phone);

		if (checkAddress($address) && checkPhone($phone) && checkEmail($email)){
			 $_SESSION['guestId'] = true;
			 echo "Successfully Registered: $address, $phone, $email <br>";
			 echo "<a href='viewCart.php?checkout'>Click here to continue to checkout.</a><br>";
			}
	} else {
		echo "Invalid input <br>"; 
	}
} 
function prepareInput($inputData){
	$inputData = trim($inputData);
 	$inputData = stripslashes($inputData);
  	$inputData  = htmlspecialchars($inputData);
  	return $inputData;
}
function checkAddress($address){
	if (preg_match('/^.{1,30}$/',$address)){
		echo "Address ok <br>";
		return true;
	}
	else {
		echo "Invalid Address <br>";
		return false;
	}
}
function checkPhone($phone){
	if (preg_match('/^[2-9]\d{9}$/',$phone)){		
		echo "Phone ok <br>";
		return true;
	}
	else {
		echo "Invalid Phone <br>";
		return false;
	}
}
function checkEmail($email){

	if (preg_match('/^(?!.{30,})(\S+@\S+\.\S+)$/',$email)){
		echo "email ok <br>";
		return true;
	}
	else{
		echo "Invalid email <br>";
		return false;
	}
}

?>
<?php 
    include ("../general/footer.php");
  ?>