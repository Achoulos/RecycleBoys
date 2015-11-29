<?php 
	session_start();// Start the session before you write your HTML page
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
		 error_reporting(E_ALL);
	    $db_host = "localhost";
	    $db_user = "root";
	    $db_pass = "root";
	    $db_name = "mysql";
	    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	    // Check connection
	    if (mysqli_connect_errno()) {
	        echo "Failed to connect to MySQL: " . mysqli_connect_error();
	     }
	     $sql = "select * from members where Email='$email'";
	     $result = $con->query($sql);
	      if (!$result) {
		        die('Error: ' . mysqli_error($con));
		  }
		 $numResults = 0;
		 while($row = mysqli_fetch_assoc($result)) {
		 	$numResults ++;
		 }
		 if ($numResults > 0) {
		 	echo "Email is already in use, please use a different one.<br>";
		 } else {
		      $sql="INSERT INTO Members VALUES(0, '$address', '$email', '$phone');";

		      $result = $con->query($sql);
		      if (!$result)
		      {
		        die('Error: ' . mysqli_error($con));
		      } 
		  
			 $result = $con->query("SELECT * FROM MEMBERS WHERE Email='$email'");
		     if (!$result)
		     {
		        die('Error: ' . mysqli_error($con));
		     } 
		     $row = mysqli_fetch_assoc($result);
			if ($row){
				$_SESSION['memberId'] = $row['id'];
			}	
			echo "Successfully Registered: $address, $phone, $email <br>";
			mysql_close($con);
		}
	} else {
		echo "Invalid input <br>"; 
	}
} else {
	echo "Empty input. Please input some data.<br>";
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